<?
include_once 'config.php';

// Whitelist bo'yicha jadval nomi
function allowed_table($name) {
    $allowed = ['gazeta', 'jurnal'];
    return in_array($name, $allowed, true) ? $name : null;
}

// Nashr turini olish
if (isset($_POST['nashr_turi'])) {
    $nashr_turi = allowed_table(sanitize_str($_POST['nashr_turi']));
    if (!$nashr_turi) {
        echo '<option>Xato: noto‘g‘ri nashr turi</option>';
        exit;
    }

    $result = $db->query("SELECT nomi FROM {$nashr_turi}");
    if (!$result) {
        echo '<option>Xato</option>';
        exit;
    }

    $_SESSION['nashr_turi'] = $nashr_turi;
    unset($_SESSION['narx'], $_SESSION['obuna_davri'], $_SESSION['final_narx'], $_SESSION['komplektlar_soni'], $_SESSION['nashr_index'], $_SESSION['nashr_nomi']);

    echo '<option selected disabled> -- tanlang -- </option>';
		 while ($row = $result->fetch_assoc()) {
        $value = str_replace(' ', '_', $row['nomi']);
        echo '<option value="' . $value . '">' . htmlspecialchars($row['nomi'], ENT_QUOTES, 'UTF-8') . '</option>';
	}
} 

// Nashr nomini tanlash
if (isset($_POST['nashr'])) {
    $nashr_turi = $_SESSION['nashr_turi'] ?? null;
    $table = allowed_table($nashr_turi);
    if (!$table) {
        echo json_encode([]);
        exit;
    }

    $nashr = sanitize_str(str_replace('_', ' ', $_POST['nashr']));
    if ($nashr === '') {
        echo json_encode([]);
        exit;
    }

    $stmt = $db->prepare("SELECT * FROM {$table} WHERE nomi = ?");
    $stmt->bind_param('s', $nashr);
    $stmt->execute();
    $result = $stmt->get_result();

	$data = [];
    if ($row = $result->fetch_assoc()) {
		$data = $row;
        $_SESSION['narx'] = (float)$row['butun'];
        $_SESSION['nashr_index'] = $row['indeks'];
        $_SESSION['nashr_nomi'] = $nashr;
	}

	echo json_encode($data);
}

// Obuna davri hisoblash
if (isset($_POST['obuna_davri'])) {
    $nashr_turi = $_SESSION['nashr_turi'] ?? null;
    $table = allowed_table($nashr_turi);
    $nashr = $_SESSION['nashr_nomi'] ?? null;
    $obuna_davri = sanitize_str($_POST['obuna_davri']);

    if (!$table || !$nashr) {
        echo '0';
        exit;
    }

    $stmt = $db->prepare("SELECT butun FROM {$table} WHERE nomi = ?");
    $stmt->bind_param('s', $nashr);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$row = $result->fetch_assoc()) {
        echo '0';
        exit;
    }

    $basePrice = (float)$row['butun'];
    $price = ($obuna_davri === "6") ? round($basePrice / 2) : $basePrice;

    $_SESSION['obuna_davri'] = $obuna_davri;
    $_SESSION['narx'] = $basePrice;
    echo $price;
}

// Komplektlar soni
if (isset($_POST['komplektlar_soni'])) {
    $nashr_turi = $_SESSION['nashr_turi'] ?? null;
    $table = allowed_table($nashr_turi);
    $nashr = $_SESSION['nashr_nomi'] ?? null;
    $obuna_davri = $_SESSION['obuna_davri'] ?? '12';
    $komplektlar_soni = (int)$_POST['komplektlar_soni'];

    if (!$table || !$nashr || $komplektlar_soni <= 0) {
        echo '0';
        exit;
    }

    $stmt = $db->prepare("SELECT butun FROM {$table} WHERE nomi = ?");
    $stmt->bind_param('s', $nashr);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$row = $result->fetch_assoc()) {
        echo '0';
        exit;
    }

    $basePrice = (float)$row['butun'];
    $unitPrice = ($obuna_davri === "6") ? round($basePrice / 2) : $basePrice;
    $final = $unitPrice * $komplektlar_soni;

    $_SESSION['narx'] = $basePrice;
    $_SESSION['komplektlar_soni'] = $komplektlar_soni;
    $_SESSION['final_narx'] = $final;

    echo $final;
}

// MFY ro'yxatini olish (tuman nomi bo'yicha)
if (isset($_POST['tuman_nomi'])) {
    $tuman_nomi = sanitize_str($_POST['tuman_nomi']);
    
    if (empty($tuman_nomi)) {
        echo '<option>-- MFY tanlang --</option>';
        exit;
    }
    
    $stmt = $db->prepare("SELECT mfy_nomi FROM mfy WHERE tuman_nomi = ? ORDER BY mfy_nomi ASC");
    $stmt->bind_param('s', $tuman_nomi);
    $stmt->execute();
    $result = $stmt->get_result();
    
    echo '<option value="" selected disabled>-- MFY tanlang --</option>';
    while ($row = $result->fetch_assoc()) {
        $mfy_nomi = htmlspecialchars($row['mfy_nomi'], ENT_QUOTES, 'UTF-8');
        echo '<option value="' . htmlspecialchars($row['mfy_nomi'], ENT_QUOTES, 'UTF-8') . '">' . $mfy_nomi . '</option>';
    }
    
    $stmt->close();
}