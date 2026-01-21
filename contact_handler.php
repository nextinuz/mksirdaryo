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
        $text = "📞 <b>YANGI MUROJAAT</b>\n\n";
        $text .= "Telefon raqami: " . $number_tel . "\n";
        $text .= "Vaqt: " . date('d.m.Y H:i:s') . "\n\n";
        $text .= "Raqamiga obuna masalasida qo'ng'iroq qiling.";
        
        // Telegram API ga POST so'rov yuborish (yaxshiroq usul)
        $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage";
        $data = array(
            'chat_id' => TELEGRAM_CHAT_ID,
            'text' => $text,
            'parse_mode' => 'HTML'
        );
        
        // cURL orqali yuborish (eng ishonchli usul)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        // Xatolikni tekshirish (agar kerak bo'lsa)
        if ($result === false || $httpCode !== 200) {
            error_log("Telegram murojaat xabar yuborishda xatolik. HTTP Code: " . $httpCode . ", Error: " . $error);
        }
    }
    
    $response['success'] = true;
    $response['message'] = 'Ma\'lumot muvaffaqiyatli yuborildi!';
} else {
    $response['message'] = 'Telefon raqamini kiriting!';
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
exit;
?>
