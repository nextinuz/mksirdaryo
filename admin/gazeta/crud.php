<?
// CRUD operatsiyalari (Create, Read, Update, Delete)
require_once '../../config.php';
require_once '../auth_check.php';

// Faqat POST so'rovlarni qabul qilish
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die('Method not allowed');
}

function allowed_table($name) {
    $allowed = ['gazeta', 'jurnal'];
    return in_array($name, $allowed, true) ? $name : null;
}

// JSON response
header('Content-Type: application/json');

$action = $_POST['action'] ?? '';
$response = ['success' => false, 'message' => ''];

try {
    switch ($action) {
        case 'create':
            // Nashr qo'shish
            $nashr_type = allowed_table($_POST['nashr_type'] ?? '');
            $nomi = sanitize_str($_POST['login'] ?? '');
            $indeks = sanitize_str($_POST['index'] ?? '');
            $narx = (float)($_POST['price'] ?? 0);
            
            if (!$nashr_type || empty($nomi) || empty($indeks) || $narx <= 0) {
                $response['message'] = 'Barcha maydonlarni to\'ldiring!';
                break;
            }
            
            $stmt = $db->prepare("INSERT INTO {$nashr_type} (`nomi`, `indeks`, `butun`) VALUES (?, ?, ?)");
            $stmt->bind_param('ssd', $nomi, $indeks, $narx);
            
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Yangi nashr qo\'shildi!';
            } else {
                $response['message'] = 'Bu nashr mavjud yoki xatolik!';
            }
            $stmt->close();
            break;
            
        case 'update':
            // Nashr narxini yangilash
            $nashr_turi = allowed_table($_POST['nashr_turi'] ?? '');
            $nashr_nomi = str_replace('_', ' ', sanitize_str($_POST['nashr_nomi'] ?? ''));
            $yangi_narx = (float)($_POST['change_name'] ?? 0);
            
            if (!$nashr_turi || empty($nashr_nomi) || $yangi_narx <= 0) {
                $response['message'] = 'Barcha maydonlarni to\'ldiring!';
                break;
            }
            
            $stmt = $db->prepare("UPDATE {$nashr_turi} SET `butun` = ? WHERE `nomi` = ?");
            $stmt->bind_param('ds', $yangi_narx, $nashr_nomi);
            
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Nashr narxi yangilandi!';
            } else {
                $response['message'] = 'Xatolik yuz berdi!';
            }
            $stmt->close();
            break;
            
        case 'delete':
            // Nashrni o'chirish
            $nashr_type = allowed_table($_POST['nashr_type'] ?? '');
            $nashr_nomi_value = sanitize_str($_POST['del_name'] ?? '');
            
            if (!$nashr_type || empty($nashr_nomi_value)) {
                $response['message'] = 'Nashr nomini tanlang!';
                break;
            }
            
            // Value dan asl nomni olish (_ ni bo'sh joyga almashtirish)
            $nashr_nomi = str_replace('_', ' ', $nashr_nomi_value);
            
            $stmt = $db->prepare("DELETE FROM {$nashr_type} WHERE `nomi` = ?");
            $stmt->bind_param('s', $nashr_nomi);
            
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $response['success'] = true;
                    $response['message'] = 'Nashr muvaffaqiyatli o\'chirildi!';
                } else {
                    $response['message'] = 'Bunday nashr topilmadi!';
                }
            } else {
                $response['message'] = 'Xatolik yuz berdi!';
            }
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
