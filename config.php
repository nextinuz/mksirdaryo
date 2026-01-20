<?
// Umumiy konfiguratsiya va xavfsiz sozlamalar
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}

function env_or_default($key, $default = '') {
    $value = getenv($key);
    return ($value === false || $value === null || $value === '') ? $default : $value;
}

// Ma'lumotlar bazasi
$host = env_or_default('DB_HOST', 'MySQL-8.4');
$username = env_or_default('DB_USER', 'root');
$pass = env_or_default('DB_PASS', '');
$db_name = env_or_default('DB_NAME', 'nextin_mk');

$db = new mysqli($host, $username, $pass, $db_name);
if ($db->connect_error) {
    die('DB ulanish xatosi: ' . $db->connect_error);
}
$db->set_charset('utf8mb4');

// Admin autentifikatsiya (login + hashed parol)
define('ADMIN_USER', env_or_default('ADMIN_USER', 'mk'));
define('ADMIN_PASS_HASH', env_or_default('ADMIN_PASS_HASH', password_hash('change_me_now', PASSWORD_BCRYPT)));

// Telegram sozlamalari
define('TELEGRAM_BOT_TOKEN', env_or_default('TELEGRAM_BOT_TOKEN', ''));
define('TELEGRAM_CHAT_ID', env_or_default('TELEGRAM_CHAT_ID', ''));

// Foydali filtr funksiyasi
function sanitize_str($value) {
    return htmlspecialchars(trim((string)$value), ENT_QUOTES, 'UTF-8');
}
?>