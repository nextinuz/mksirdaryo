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

// Admin foydalanuvchilar jadvalini yaratish va default admin qo'shish
function initAdminUsersTable($db) {
    // Jadvalni yaratish
    $create_table = "CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        username_md5 VARCHAR(32) NOT NULL,
        password_md5 VARCHAR(32) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_login TIMESTAMP NULL,
        is_active TINYINT(1) DEFAULT 1,
        INDEX idx_username (username),
        INDEX idx_username_md5 (username_md5),
        INDEX idx_active (is_active)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $db->query($create_table);
    
    // Default admin mavjudligini tekshirish
    $check = $db->query("SELECT id FROM admin_users WHERE username = 'admin' LIMIT 1");
    
    if (!$check || $check->num_rows == 0) {
        // Default admin yaratish (login: admin, parol: admin123)
        // Login va parolni MD5 hash qilish
        $default_username = 'admin';
        $default_password = 'admin123';
        $username_md5 = md5($default_username);
        $password_md5 = md5($default_password);
        
        $stmt = $db->prepare("INSERT INTO admin_users (username, username_md5, password_md5) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $default_username, $username_md5, $password_md5);
        $stmt->execute();
        $stmt->close();
    }
}

// Admin jadvalini ishga tushirish
initAdminUsersTable($db);

// MFY jadvalini yaratish va ma'lumotlarni yozish
function initMfyTable($db) {
    // Jadvalni yaratish
    $create_table = "CREATE TABLE IF NOT EXISTS mfy (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tuman_nomi VARCHAR(100) NOT NULL,
        mfy_nomi VARCHAR(200) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_tuman (tuman_nomi)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $db->query($create_table);
    
    // Ma'lumotlar mavjudligini tekshirish
    $check = $db->query("SELECT COUNT(*) as count FROM mfy LIMIT 1");
    $row = $check->fetch_assoc();
    
    if ($row['count'] == 0) {
        // Barcha MFY ma'lumotlarini yozish
        $mfy_data = [
            'Гулистон шахри' => ['"Ахиллик" МФЙ','"Дўстлик" МФЙ','"Навбахор" МФЙ','"Нурафшон" МФЙ','"Сохил" МФЙ','"Шодлик" МФЙ','"Янги хаёт" МФЙ','"Бахт" МФЙ','"Бўстон" МФЙ','"Буюк келажак" МФЙ','"Истиқлол" МФЙ','"Улуғобод" МФЙ','"Боғишамол" МФЙ','"Намуна" МФЙ','"Обод юрт" МФЙ','"Сайқал" МФЙ','"Тараққиёт" МФЙ','"Бахор" МФЙ','"Ибратли" МФЙ','"Маданият" МФЙ','"Маънавият" МФЙ','"Нихол" МФЙ','"Улуғ йўл" МФЙ','"Юксалиш" МФЙ'],
            'Ширин шахри' => ['"Дўстлик"  МФЙ', 'Амир Темур  МФЙ', 'Мирзо Улуғбек  МФЙ','"Бунёдкор" МФЙ','"Фарҳод"  МФЙ','"Нуробод"  МФЙ','"Ватанпарвар"  МФЙ'],
            'Янгиер шахри' => ['З.Бобур номли МФЙ','Т.Малик номли МФЙ','А.Жомий номли МФЙ','Шукрона МФЙ','Фазилат МФЙ','Давлатобод МФЙ','Шодиёна МФЙ','Маърифат МФЙ','Юксалиш МФЙ','Бинокор МФЙ','Наврўзобод МФЙ'],
            'Гулистон тумани' => ['Бахмал МФЙ','Зарбдор МФЙ','Ишонч МФЙ','Мевазор МФЙ','Оқ олтин МФЙ','Сойибобод ҚФЙ','Тажрибакор МФЙ','Х. Олимжон номли МФЙ','Юлдуз МФЙ','Боёвут МФЙ','Олтин водий МФЙ','Сохил МФЙ','Сохилобод ҚФЙ','Теракзор  МФЙ','Фурқат номли МФЙ','Шарқ хақиқати МФЙ','Бешбулоқ ҚФЙ','Мустақиллик МФЙ','Чортоқ ҚФЙ','А.Навоий номли МФЙ','А.Яссавий номли МФЙ','Ахиллик МФЙ','Бирлашган МФЙ','Дўстлик МФЙ','Ибрат МФЙ'],
            'Сирдарё тумани' => ['"Бахмал" МФЙ','"Бунёдкор" МФЙ','"Камолат" МФЙ','"Тараққиёт" МФЙ','Улуғбек номли МФЙ','"Ҳикматли" МФЙ','"Адолат" МФЙ','"Дўстлик" МФЙ','"Ишонч" МФЙ','"Тадбиркор" МФЙ','"Ахиллик" МФЙ','"Истиқбол" МФЙ','"Орзу" МФЙ','"Тинчлик" МФЙ','"Туркистон" МФЙ','"Хазина" МФЙ','"Янгиобод" МФЙ','"Дехқонобод" МФЙ','Навоий номли МФЙ','"Заршунос" МФЙ','"Илғор" МФЙ','"Интилиш" МФЙ','"Қуёш" МФЙ','"Наврўз" МФЙ','"Оқ йўл" МФЙ','"Фаравон" МФЙ','"Фурқат" МФЙ','"Шоликор" МФЙ','"Элобод" МФЙ','"Ширин" МФЙ','"Ёшлик" МФЙ','"Бахор" МФЙ','"Бешбулоқ" МФЙ','"Зиёкор" МФЙ','"Исломобод" МФЙ','"Матонат" МФЙ','"Пахтакор" МФЙ','"Оқибат" МФЙ'],
            'Боёвут тумани' => ['"Фарход" МФЙ','"Наврўз" МФЙ','"Анорзор" МФЙ','"Бекат" МФЙ','"Қарапчи" МФЙ','"Лайлаккўл" МФЙ','Мукумий  МФЙ','"Бобоюрт" МФЙ','"Марказ"  МФЙ','"Пахтакор" МФЙ','"Ўзбекистон" МФЙ','"Озодлик" МФЙ','"Истиқлол" МФЙ','"Гулбог" МФЙ','"Ифтихор" МФЙ','"Янги авлод" МФЙ','"Ижодкор"  МФЙ','"Учтургон"  МФЙ','"Маънавият"  МФЙ','"Сармич"  МФЙ','"Жўлангар"  МФЙ','А.Навоий номли МФЙ','"Тинчлик"  МФЙ','"Маданият" МФЙ','"Сохил" МФЙ','"Миришкор" МФЙ','"Бунёдкор" МФЙ','У.Юсупов номли МФЙ','"Янги бўстон" МФЙ','"Дўстлик" МФЙ','С.Айний номли МФЙ','А.Темур номли МФЙ','"Янгиобод" МФЙ','Беруний номли МФЙ','"Олмазор" МФЙ','"Совотобод" МФЙ','"Зиёкор" МФЙ','"Навбахор" МФЙ','"Ширин" МФЙ'],
            'Ховос тумани' => ['Чаманзор  МФЙ','Истиқлол  МФЙ','Дўстлик  МФЙ','Тинчлик  МФЙ','Бунёдкор  МФЙ','Янгиер МФЙ','Пахтакор МФЙ','Фарход МФЙ','Обод турмуш  МФЙ','Гулбаҳор  МФЙ','Мустақилликнинг 25 йиллиги  МФЙ','Қайирма  МФЙ','Шарқобод  МФЙ','Соҳибкор МФЙ','Қорақум МФЙ','Нурли келажак МФЙ','Мустақиллик  МФЙ','Оқчангал МФЙ','Афросиёб МФЙ','Ўзбекистон тўкинчилиги МФЙ','Ҳавособод  МФЙ','Карвонсарой   МФЙ','Етти гузар  МФЙ','Қаҳрамон МФЙ','Ҳуснобод МФЙ','Бўстон МФЙ','Бинокор МФЙ'],
            'Сардоба тумани' => ['"Юртдош" МФЙ','"Дўстлик" МФЙ','"Қўрғонтепа" МФЙ','"Отаюрт" МФЙ','"Бирлик" МФЙ','"Янгиқишлоқ" МФЙ','"Халқаобод" МФЙ','"Қуйитош" МФЙ','"Файзлиобод" МФЙ','"Наврўз" МФЙ','"Пахтакор" МФЙ','"Бирлашган" МФЙ','"Зомин" МФЙ','"Ровот" МФЙ','"Бўстон" МФЙ'],
            'Сайхунобод тумани' => ['Бахмалсой МФЙ','Нурли йўл МФЙ','Паймард МФЙ','Ўзбекистон МФЙ','Фаровон МФЙ','Иттифоқ МФЙ','Нуробод МФЙ','Олғабос МФЙ','Пахтаобод МФЙ','Шодлик МФЙ','Турон МФЙ','Гулбулоқ МФЙ','Пахтакон МФЙ','Дўстлик МФЙ','Синтоб МФЙ','Гулистон МФЙ','Мустақиллик МФЙ','Ўрикзор МФЙ','Янги ҳаёт МФЙ'],
            'Околтин тумани' => ['А.Навоий номли МФЙ','"Саҳоват" МФЙ','"Шодлик" МФЙ','"Кўркам диёр" МФЙ','"Аҳиллик" МФЙ','"Бўстон" МФЙ','"Обод" МФЙ','"Янги хаёт" МФЙ','"Тошкент" МФЙ','"Мустақиллик" МФЙ','"Янги давр" МФЙ','"Андижон" МФЙ','"Янги Тошкент" МФЙ'],
            'Мирзобод тумани' => ['"Бахористон" МФЙ','"Йўлдошобод" МФЙ','"Навбахор" МФЙ','"Ҳақиқат" МФЙ','"Янги Ўзбекистон" МФЙ','"Боғистон" МФЙ','"Дўнгариқ" МФЙ','"Наврўз" МФЙ','"Нурарафшон" МФЙ','"Мирзачўл" МФЙ','"Дехқонобод" МФЙ','"Ойдин" МФЙ','"Оқолтин" МФЙ','Т.Ахмедов номли МФЙ','"Тинчлик" МФЙ','"Тошкент" МФЙ','М.Улуғбек номли МФЙ','"Янгихаёт" МФЙ']
        ];
        
        $stmt = $db->prepare("INSERT INTO mfy (tuman_nomi, mfy_nomi) VALUES (?, ?)");
        
        foreach ($mfy_data as $tuman => $mfy_list) {
            foreach ($mfy_list as $mfy) {
                $stmt->bind_param('ss', $tuman, $mfy);
                $stmt->execute();
            }
        }
        
        $stmt->close();
    }
}

// MFY jadvalini ishga tushirish
initMfyTable($db);

// Xavfsizlik sozlamalari
define('MAX_LOGIN_ATTEMPTS', 5); // Maksimal urinishlar soni
define('LOGIN_LOCKOUT_TIME', 900); // 15 daqiqa (sekundlarda)
define('SESSION_TIMEOUT', 3600); // 1 soat (sekundlarda)
define('CSRF_TOKEN_NAME', 'csrf_token');

// Telegram sozlamalari
define('TELEGRAM_BOT_TOKEN', env_or_default('TELEGRAM_BOT_TOKEN', ''));
define('TELEGRAM_CHAT_ID', env_or_default('TELEGRAM_CHAT_ID', ''));

// Foydali filtr funksiyasi
function sanitize_str($value) {
    return htmlspecialchars(trim((string)$value), ENT_QUOTES, 'UTF-8');
}
?>