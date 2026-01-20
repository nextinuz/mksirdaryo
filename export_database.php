<?php
require_once 'config.php';

// Agar command line dan ishga tushirilgan bo'lsa
if (php_sapi_name() === 'cli') {
    $filename = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';
    $file = fopen($filename, 'w');
} else {
    // Brauzer orqali ishga tushirilgan bo'lsa
    $filename = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $file = fopen('php://output', 'w');
}

function write_sql($file, $content) {
    fwrite($file, $content);
}

// SQL header
write_sql($file, "-- MySQL Database Export\n");
write_sql($file, "-- Date: " . date('Y-m-d H:i:s') . "\n");
write_sql($file, "-- Database: " . $db_name . "\n\n");
write_sql($file, "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n");
write_sql($file, "SET AUTOCOMMIT = 0;\n");
write_sql($file, "START TRANSACTION;\n");
write_sql($file, "SET time_zone = \"+00:00\";\n\n");

// Barcha jadvallarni olish
$tables = $db->query("SHOW TABLES");
if ($tables) {
    while ($row = $tables->fetch_array()) {
        $table = $row[0];
        
        // Jadval strukturasini olish
        write_sql($file, "\n-- --------------------------------------------------------\n");
        write_sql($file, "-- Table structure for table `$table`\n");
        write_sql($file, "-- --------------------------------------------------------\n\n");
        write_sql($file, "DROP TABLE IF EXISTS `$table`;\n");
        
        $create_table = $db->query("SHOW CREATE TABLE `$table`");
        if ($create_table) {
            $create_row = $create_table->fetch_array();
            write_sql($file, $create_row[1] . ";\n\n");
        }
        
        // Jadval ma'lumotlarini olish
        write_sql($file, "-- Dumping data for table `$table`\n\n");
        $data = $db->query("SELECT * FROM `$table`");
        if ($data && $data->num_rows > 0) {
            $columns = [];
            $result = $db->query("SHOW COLUMNS FROM `$table`");
            while ($col = $result->fetch_assoc()) {
                $columns[] = "`" . $col['Field'] . "`";
            }
            $columns_str = implode(', ', $columns);
            
            write_sql($file, "INSERT INTO `$table` ($columns_str) VALUES\n");
            $values = [];
            while ($row_data = $data->fetch_assoc()) {
                $row_values = [];
                foreach ($row_data as $value) {
                    if ($value === null) {
                        $row_values[] = 'NULL';
                    } else {
                        $row_values[] = "'" . $db->real_escape_string($value) . "'";
                    }
                }
                $values[] = "(" . implode(', ', $row_values) . ")";
            }
            write_sql($file, implode(",\n", $values) . ";\n\n");
        }
    }
}

write_sql($file, "COMMIT;\n");
$db->close();
fclose($file);

if (php_sapi_name() === 'cli') {
    echo "Database exported to: $filename\n";
} else {
    echo "Database export completed. File will download automatically.\n";
}
?>
