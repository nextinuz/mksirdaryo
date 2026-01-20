<?
// Sozlamalar uchun AJAX handler
require_once 'auth_check.php';

// Faqat POST so'rovlarni qabul qilish
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['success' => false, 'message' => 'Method not allowed']));
}

header('Content-Type: application/json');

$action = $_POST['action'] ?? '';
$response = ['success' => false, 'message' => ''];

try {
    switch ($action) {
        case 'change_password':
            // Parol o'zgartirish
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            
            if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
                $response['message'] = 'Barcha maydonlarni to\'ldiring!';
                break;
            }
            
            if ($new_password !== $confirm_password) {
                $response['message'] = 'Yangi parollar mos kelmaydi!';
                break;
            }
            
            if (strlen($new_password) < 6) {
                $response['message'] = 'Parol kamida 6 ta belgidan iborat bo\'lishi kerak!';
                break;
            }
            
            // Joriy parolni tekshirish
            $current_username = $_SESSION['admin_user'];
            $current_username_md5 = md5($current_username);
            $current_password_md5 = md5($current_password);
            
            $stmt = $db->prepare("SELECT id FROM admin_users WHERE username_md5 = ? AND password_md5 = ? AND is_active = 1 LIMIT 1");
            $stmt->bind_param('ss', $current_username_md5, $current_password_md5);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if (!$result || $result->num_rows == 0) {
                $response['message'] = 'Joriy parol noto\'g\'ri!';
                $stmt->close();
                break;
            }
            
            // Yangi parolni MD5 hash qilish
            $new_password_md5 = md5($new_password);
            
            // Parolni yangilash
            $update_stmt = $db->prepare("UPDATE admin_users SET password_md5 = ? WHERE username_md5 = ?");
            $update_stmt->bind_param('ss', $new_password_md5, $current_username_md5);
            
            if ($update_stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Parol muvaffaqiyatli o\'zgartirildi!';
            } else {
                $response['message'] = 'Xatolik yuz berdi!';
            }
            
            $update_stmt->close();
            $stmt->close();
            break;
            
        default:
            $response['message'] = 'Noto\'g\'ri amal!';
    }
} catch (Exception $e) {
    $response['message'] = 'Xatolik: ' . $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
exit;
?>
