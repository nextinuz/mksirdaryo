<?
// Parol hashini test qilish
require_once '../config.php';

$test_password = 'admin123';
$test_hash = ADMIN_PASS_HASH;

echo "Test parol: $test_password\n";
echo "Hash: $test_hash\n";
echo "\nTekshirish:\n";

if (password_verify($test_password, $test_hash)) {
    echo "✓ Parol to'g'ri!\n";
} else {
    echo "✗ Parol noto'g'ri!\n";
    echo "\nYangi hash yaratish:\n";
    $new_hash = password_hash($test_password, PASSWORD_BCRYPT);
    echo "Yangi hash: $new_hash\n";
    echo "\nBu hashni config.php ga qo'yish kerak:\n";
    echo "define('ADMIN_PASS_HASH', '$new_hash');\n";
}
?>
