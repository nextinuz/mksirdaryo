<?
// Admin panel uchun xavfsizlik tekshiruvi
// Yo'lni to'g'ri aniqlash
$config_path = __DIR__ . '/../config.php';
if (!file_exists($config_path)) {
    die('Config fayli topilmadi: ' . $config_path);
}
require_once $config_path;

// Session tekshirish
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../admin/index.php');
    exit;
}

// Session timeout tekshirish
if (isset($_SESSION['admin_last_activity']) && (time() - $_SESSION['admin_last_activity'] > SESSION_TIMEOUT)) {
    session_destroy();
    header('Location: ../admin/index.php?timeout=1');
    exit;
}

// IP o'zgarishini tekshirish (session hijacking himoyasi)
if (isset($_SESSION['admin_ip'])) {
    $current_ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    if ($_SESSION['admin_ip'] !== $current_ip) {
        session_destroy();
        header('Location: ../admin/index.php?security=1');
        exit;
    }
}

// Session yangilash
$_SESSION['admin_last_activity'] = time();

// CSRF token generatsiya (agar mavjud bo'lmasa)
if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
    $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
}

function verifyAdminCSRF($token) {
    return isset($_SESSION[CSRF_TOKEN_NAME]) && hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

function getAdminCSRFToken() {
    return $_SESSION[CSRF_TOKEN_NAME] ?? '';
}
?>
