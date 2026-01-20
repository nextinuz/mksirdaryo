<?
require_once '../config.php';

// Xavfsizlik funksiyalari
function generateCSRFToken() {
    if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

function verifyCSRFToken($token) {
    return isset($_SESSION[CSRF_TOKEN_NAME]) && hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

function getClientIP() {
    $ipkeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    foreach ($ipkeys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function checkLoginAttempts($db, $ip) {
    // Login attempts jadvalini yaratish
    $db->query("CREATE TABLE IF NOT EXISTS login_attempts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ip_address VARCHAR(45) NOT NULL,
        attempts INT DEFAULT 1,
        last_attempt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        locked_until TIMESTAMP NULL,
        INDEX idx_ip (ip_address),
        INDEX idx_locked (locked_until)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    
    $ip_escaped = $db->real_escape_string($ip);
    $result = $db->query("SELECT attempts, locked_until FROM login_attempts WHERE ip_address = '$ip_escaped' LIMIT 1");
    
    if ($result && $row = $result->fetch_assoc()) {
        // Agar bloklangan bo'lsa
        if ($row['locked_until'] && strtotime($row['locked_until']) > time()) {
            $remaining = strtotime($row['locked_until']) - time();
            return ['locked' => true, 'remaining' => $remaining];
        }
        // Agar bloklanish vaqti o'tgan bo'lsa, qayta tiklash
        if ($row['locked_until'] && strtotime($row['locked_until']) <= time()) {
            $db->query("UPDATE login_attempts SET attempts = 0, locked_until = NULL WHERE ip_address = '$ip_escaped'");
        }
        return ['locked' => false, 'attempts' => (int)$row['attempts']];
    }
    
    return ['locked' => false, 'attempts' => 0];
}

function recordFailedAttempt($db, $ip) {
    $ip_escaped = $db->real_escape_string($ip);
    $result = $db->query("SELECT attempts FROM login_attempts WHERE ip_address = '$ip_escaped' LIMIT 1");
    
    if ($result && $row = $result->fetch_assoc()) {
        $new_attempts = (int)$row['attempts'] + 1;
        $lock_until = null;
        
        if ($new_attempts >= MAX_LOGIN_ATTEMPTS) {
            $lock_until = date('Y-m-d H:i:s', time() + LOGIN_LOCKOUT_TIME);
        }
        
        if ($lock_until) {
            $db->query("UPDATE login_attempts SET attempts = $new_attempts, locked_until = '$lock_until' WHERE ip_address = '$ip_escaped'");
        } else {
            $db->query("UPDATE login_attempts SET attempts = $new_attempts WHERE ip_address = '$ip_escaped'");
        }
    } else {
        $db->query("INSERT INTO login_attempts (ip_address, attempts) VALUES ('$ip_escaped', 1)");
    }
}

function clearLoginAttempts($db, $ip) {
    $ip_escaped = $db->real_escape_string($ip);
    $db->query("DELETE FROM login_attempts WHERE ip_address = '$ip_escaped'");
}

// Agar allaqachon kirgan bo'lsa, admin panelga yo'naltirish
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    if (isset($_SESSION['admin_last_activity']) && (time() - $_SESSION['admin_last_activity'] > SESSION_TIMEOUT)) {
        // Session muddati o'tgan
        session_destroy();
        header('Location: index.php');
        exit;
    }
    $_SESSION['admin_last_activity'] = time();
    header('Location: gazeta/');
    exit;
}

// Logout (GET parametri orqali)
if (isset($_GET['logout'])) {
    // Logout faylga yo'naltirish
    header('Location: logout.php');
    exit;
}

$sbm = $_POST['sbm'] ?? null;
$login = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$csrf_token = $_POST['csrf_token'] ?? '';
$error = '';
$success_msg = '';

if (isset($_GET['logged_out'])) {
    $success_msg = 'Siz muvaffaqiyatli chiqdingiz!';
}

if (isset($sbm)) {
    // CSRF token tekshirish
    if (!verifyCSRFToken($csrf_token)) {
        $error = 'Xavfsizlik xatosi. Sahifani yangilab qayta urinib ko\'ring.';
    } else {
        $ip = getClientIP();
        
        // Login attempts tekshirish
        $attempt_check = checkLoginAttempts($db, $ip);
        
        if ($attempt_check['locked']) {
            $minutes = ceil($attempt_check['remaining'] / 60);
            $error = "Juda ko'p noto'g'ri urinishlar. Iltimos, $minutes daqiqadan keyin qayta urinib ko'ring.";
        } else {
            // Input sanitization (login uchun faqat trim, parol uchun hech narsa)
            $login = trim($login);
            
            // Login va parol tekshirish
            if (empty($login) || empty($password)) {
                $error = 'Login va parolni kiriting!';
                recordFailedAttempt($db, $ip);
            } else {
                // Login va parolni MD5 hash qilish
                $login_md5 = md5($login);
                $password_md5 = md5($password);
                
                // Ma'lumotlar bazasidan foydalanuvchini MD5 hash orqali topish
                $stmt = $db->prepare("SELECT id, username FROM admin_users WHERE username_md5 = ? AND password_md5 = ? AND is_active = 1 LIMIT 1");
                $stmt->bind_param('ss', $login_md5, $password_md5);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result && $user = $result->fetch_assoc()) {
                    // Muvaffaqiyatli kirish
                    clearLoginAttempts($db, $ip);
                    
                    // Last login yangilash
                    $update_stmt = $db->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?");
                    $update_stmt->bind_param('i', $user['id']);
                    $update_stmt->execute();
                    $update_stmt->close();
                    
                    // Xavfsiz session yaratish
                    session_regenerate_id(true);
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_user'] = $user['username'];
                    $_SESSION['admin_user_id'] = $user['id'];
                    $_SESSION['admin_ip'] = $ip;
                    $_SESSION['admin_last_activity'] = time();
                    $_SESSION['admin_login_time'] = time();
                    
                    // CSRF token yangilash
                    generateCSRFToken();
                    
                    $stmt->close();
                    header('Location: gazeta/index.php');
                    exit;
                } else {
                    // Login yoki parol noto'g'ri
                    $error = 'Login yoki parol noto\'g\'ri!';
                    recordFailedAttempt($db, $ip);
                    
                    // Qolgan urinishlar sonini ko'rsatish
                    $remaining = MAX_LOGIN_ATTEMPTS - ($attempt_check['attempts'] + 1);
                    if ($remaining > 0) {
                        $error .= " Qolgan urinishlar: $remaining";
                    }
                }
                
                if (isset($stmt)) {
                    $stmt->close();
                }
            }
        }
    }
}

$csrf_token = generateCSRFToken();
?>
<!DOCTYPE html>
<html lang="uz">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex, nofollow">
	<title>Admin panelga kirish</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		
		body {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			padding: 20px;
		}
		
		#wrapper {
			width: 100%;
			max-width: 400px;
		}
		
		.login-form {
			background: #fff;
			border-radius: 15px;
			box-shadow: 0 10px 40px rgba(0,0,0,0.2);
			overflow: hidden;
		}
		
		.login-form .header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			padding: 40px 30px;
			text-align: center;
		}
		
		.login-form .header h1 {
			font-size: 28px;
			margin-bottom: 10px;
			font-weight: 300;
		}
		
		.login-form .header span {
			font-size: 14px;
			opacity: 0.9;
		}
		
		.login-form .content {
			padding: 30px;
		}
		
		.alert {
			padding: 12px 15px;
			border-radius: 8px;
			margin-bottom: 20px;
			font-size: 14px;
		}
		
		.alert-error {
			background: #fee;
			color: #c33;
			border: 1px solid #fcc;
		}
		
		.alert-success {
			background: #efe;
			color: #3c3;
			border: 1px solid #cfc;
		}
		
		.form-group {
			margin-bottom: 20px;
		}
		
		.form-group label {
			display: block;
			margin-bottom: 8px;
			color: #333;
			font-weight: 500;
			font-size: 14px;
		}
		
		.form-group input {
			width: 100%;
			padding: 12px 15px;
			border: 2px solid #e0e0e0;
			border-radius: 8px;
			font-size: 15px;
			transition: all 0.3s;
		}
		
		.form-group input:focus {
			outline: none;
			border-color: #667eea;
			box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
		}
		
		.login-form .footer {
			padding: 0 30px 30px;
		}
		
		.button {
			width: 100%;
			padding: 14px;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			border: none;
			border-radius: 8px;
			font-size: 16px;
			font-weight: 600;
			cursor: pointer;
			transition: transform 0.2s, box-shadow 0.2s;
		}
		
		.button:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
		}
		
		.button:active {
			transform: translateY(0);
		}
		
		.security-info {
			margin-top: 20px;
			padding: 15px;
			background: #f8f9fa;
			border-radius: 8px;
			font-size: 12px;
			color: #666;
			text-align: center;
		}
	</style>
</head>
<body>
<div id="wrapper">
	<form name="login-form" class="login-form" action="" method="post">
		<div class="header">
			<h1>🔐 Admin Panel</h1>
			<span>Xavfsiz kirish tizimi</span>
		</div>
		
		<div class="content">
			<?php if ($error): ?>
				<div class="alert alert-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
			<?php endif; ?>
			
			<?php if ($success_msg): ?>
				<div class="alert alert-success"><?= htmlspecialchars($success_msg, ENT_QUOTES, 'UTF-8') ?></div>
			<?php endif; ?>
			
			<input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8') ?>">
			
			<div class="form-group">
				<label for="username">Login</label>
				<input 
					type="text" 
					id="username" 
					name="username" 
					placeholder="Login kiriting" 
					required 
					autocomplete="username"
					value="<?= htmlspecialchars($login, ENT_QUOTES, 'UTF-8') ?>"
				>
			</div>
			
			<div class="form-group">
				<label for="password">Parol</label>
				<input 
					type="password" 
					id="password" 
					name="password" 
					placeholder="Parol kiriting" 
					required 
					autocomplete="current-password"
				>
			</div>
			
			<div class="footer">
				<button type="submit" name="sbm" value="1" class="button">Kirish</button>
			</div>
			
			<div class="security-info">
				🔒 Xavfsizlik: <?= MAX_LOGIN_ATTEMPTS ?> ta noto'g'ri urinishdan keyin bloklanadi
			</div>
		</div>
	</form>
</div>
</body>
</html>
