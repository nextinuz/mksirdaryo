<?
// Aloqa modali uchun AJAX handler
require_once 'config.php';

header('Content-Type: application/json; charset=utf-8');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Noto\'g\'ri so\'rov!';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

if (isset($_POST['call_modal']) && !empty($_POST['number'])) {
    $number_tel = sanitize_str($_POST['number']);
    
    // Telefon raqamini tekshirish
    if (strpos($number_tel, '_') !== false) {
        $response['message'] = 'Iltimos, to\'liq telefon raqamini kiriting!';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // Telegramga yuborish (agar token mavjud bo'lsa)
    if (TELEGRAM_BOT_TOKEN && TELEGRAM_CHAT_ID) {
        $text = $number_tel . " raqamiga obuna masalasida qo'ng'iroq qiling";
        $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage?chat_id=" . TELEGRAM_CHAT_ID . "&parse_mode=html&text=" . urlencode($text);
        @fopen($url, "r");
    }
    
    $response['success'] = true;
    $response['message'] = 'Ma\'lumot muvaffaqiyatli yuborildi!';
} else {
    $response['message'] = 'Telefon raqamini kiriting!';
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
exit;
?>
