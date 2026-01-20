<?
// Nashrlar ro'yxatini olish (AJAX)
require_once '../../config.php';
require_once '../auth_check.php';

header('Content-Type: text/html; charset=utf-8');

function allowed_table($name) {
    $allowed = ['gazeta', 'jurnal'];
    return in_array($name, $allowed, true) ? $name : null;
}

if (isset($_POST['nashr_turi'])) {
    $nashr_turi = sanitize_str($_POST['nashr_turi']);
    $table = allowed_table($nashr_turi);
    
    if ($table) {
        $stmt = $db->prepare("SELECT nomi FROM {$table} ORDER BY nomi ASC");
        $stmt->execute();
        $result = $stmt->get_result();
        
        echo '<option selected disabled> -- Nashrni tanlang -- </option>';
        while ($row = $result->fetch_assoc()) {
            $nomi = htmlspecialchars($row['nomi'], ENT_QUOTES, 'UTF-8');
            $value = str_replace(' ', '_', $row['nomi']);
            echo '<option value="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '">' . $nomi . '</option>';
        }
        $stmt->close();
    } else {
        echo '<option>Noto\'g\'ri nashr turi!</option>';
    }
}
?>
