<?
// Logout funksiyasi
session_start();

// Session ma'lumotlarini tozalash
$_SESSION = array();

// Session cookie ni o'chirish
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Session ni yo'q qilish
session_destroy();

// Login sahifasiga qaytish
header('Location: index.php?logged_out=1');
exit;
?>
