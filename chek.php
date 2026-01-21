<?php
require_once 'config.php';

// Formadan kelgan ma'lumotlarni sanitizatsiya qilish
$hudud          = sanitize_str($_POST['hudud'] ?? '');
$mfy            = sanitize_str($_POST['mfy'] ?? '');
$manzil         = sanitize_str($_POST['manzil'] ?? '');
$fish           = sanitize_str($_POST['fish'] ?? '');
$toifa          = sanitize_str($_POST['toifa'] ?? '');
$tashkilot      = sanitize_str($_POST['tashkilot'] ?? '');
$number_raqam   = sanitize_str($_POST['number_raqam'] ?? '');
$nashr_turi     = sanitize_str($_POST['nashr_turi'] ?? '');
$nashr_nomi     = sanitize_str($_POST['nashr_nomi'] ?? '');
$obuna_davri    = sanitize_str($_POST['obuna_davri'] ?? '');
// Agar obuna davri tanlanmagan bo'lsa, 12 oyga o'rnatish
if (empty($obuna_davri) || $obuna_davri === '') {
    $obuna_davri = '12';
    $_POST['obuna_davri'] = '12';
}
$btn            = $_POST['btn'] ?? null;

// Sessiondagi vaqtinchalik qiymatlar
$komplektlar_soni = $_SESSION['komplektlar_soni'] ?? 0;
$final_narx        = $_SESSION['final_narx'] ?? 0;
$nashr_index       = $_SESSION['nashr_index'] ?? '';

// Agar final_narx 0 bo'lsa yoki mavjud bo'lmasa, obuna davri narxini hisoblash
if ($final_narx == 0 || empty($final_narx)) {
    $nashr_turi_session = $_SESSION['nashr_turi'] ?? '';
    $nashr_nomi_session = $_SESSION['nashr_nomi'] ?? '';
    
    // Jadval nomini xavfsiz tekshirish
    $allowed_tables = ['gazeta', 'jurnal'];
    $nashr_turi = in_array($nashr_turi_session, $allowed_tables, true) ? $nashr_turi_session : '';
    
    if (!empty($nashr_turi) && !empty($nashr_nomi_session)) {
        // Nashr nomini tozalash
        $nashr_nomi_clean = str_replace('_', ' ', $nashr_nomi_session);
        
        // Obuna davri narxini bazadan olish
        $stmt = $db->prepare("SELECT butun FROM {$nashr_turi} WHERE nomi = ?");
        $stmt->bind_param('s', $nashr_nomi_clean);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $basePrice = (float)$row['butun'];
            // Obuna davri bo'yicha narxni hisoblash
            if ($obuna_davri === "6") {
                $final_narx = round($basePrice / 2);
            } else {
                $final_narx = $basePrice;
            }
            
            // Komplektlar soni bo'yicha ko'paytirish
            if ($komplektlar_soni > 0) {
                $final_narx = $final_narx * $komplektlar_soni;
            }
            
            $_SESSION['final_narx'] = $final_narx;
        }
        $stmt->close();
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
      <meta name="author" content="Администратор" />
      <meta name="company" content="Matbuotga Ko'makchi" />
    <style type="text/css">
      html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:11pt; background-color:white }
      a.comment-indicator:hover + div.comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em }
      a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em }
      div.comment { display:none }
      table { border-collapse:collapse; page-break-after:always; width: 100%; }
      .gridlines td { border:1px dotted black }
      .gridlines th { border:1px dotted black }
      .b { text-align:center }
      .e { text-align:center }
      .f { text-align:right }
      .inlineStr { text-align:left }
      .n { text-align:right }
      .s { text-align:left }
      td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial Cyr'; font-size:10pt; background-color:white }
      th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Arial Cyr'; font-size:10pt; background-color:white }
      td.style1 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style1 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style2 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:white }
      th.style2 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:white }
      td.style3 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:white }
      th.style3 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:8pt; background-color:white }
      td.style4 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style4 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style5 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style5 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style6 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:20pt; background-color:white }
      th.style6 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:20pt; background-color:white }
      td.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:20pt; background-color:white }
      th.style7 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:20pt; background-color:white }
      td.style8 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style8 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style9 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; text-decoration:underline; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style9 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; text-decoration:underline; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style10 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; text-decoration:underline; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style10 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; text-decoration:underline; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style11 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style11 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style12 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style12 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style13 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:20pt; background-color:white }
      th.style13 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:20pt; background-color:white }
      td.style14 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:20pt; background-color:white }
      th.style14 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:20pt; background-color:white }
      td.style15 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:20pt; background-color:white }
      th.style15 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:20pt; background-color:white }
      td.style16 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style16 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style17 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-style:italic; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style17 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-style:italic; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style18 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style18 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style19 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style19 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style20 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style20 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style21 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style21 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style22 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style22 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style23 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style23 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style24 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style24 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style25 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style25 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style26 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style26 { vertical-align:middle; text-align:right; padding-right:0px; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style27 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:10pt; background-color:white }
      th.style27 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:10pt; background-color:white }
      td.style28 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style28 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style29 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style29 { vertical-align:middle; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style30 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style30 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style31 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style31 { vertical-align:middle; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style32 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:10pt; background-color:white }
      th.style32 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:none #000000; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Times New Roman'; font-size:10pt; background-color:white }
      td.style33 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-style:italic; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style33 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-style:italic; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style34 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-style:italic; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style34 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-style:italic; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      td.style35 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-style:italic; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      th.style35 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-style:italic; color:#000000; font-family:'Times New Roman'; font-size:12pt; background-color:white }
      table.sheet0 col.col0 { width:96.92222111pt }
      table.sheet0 col.col1 { width:28.46666634pt }
      table.sheet0 col.col2 { width:28.46666634pt }
      table.sheet0 col.col3 { width:28.46666634pt }
      table.sheet0 col.col4 { width:28.46666634pt }
      table.sheet0 col.col5 { width:28.46666634pt }
      table.sheet0 col.col6 { width:28.46666634pt }
      table.sheet0 col.col7 { width:28.46666634pt }
      table.sheet0 col.col8 { width:28.46666634pt }
      table.sheet0 col.col9 { width:28.46666634pt }
      table.sheet0 col.col10 { width:28.46666634pt }
      table.sheet0 col.col11 { width:28.46666634pt }
      table.sheet0 col.col12 { width:28.46666634pt }
      table.sheet0 col.col13 { width:39.31111066pt }
      table.sheet0 tr { height:13.636363636364pt }
      table.sheet0 tr.row1 { height:22.5pt }
      table.sheet0 tr.row2 { height:24pt }
      table.sheet0 tr.row5 { height:13.636363636364pt }
      table.sheet0 tr.row6 { height:13.636363636364pt }
      table.sheet0 tr.row7 { height:13.636363636364pt }
      table.sheet0 tr.row8 { height:16.5pt }
      table.sheet0 tr.row9 { height:15.75pt }
      table.sheet0 tr.row10 { height:29.25pt }
      table.sheet0 tr.row11 { height:15.75pt }
      table.sheet0 tr.row12 { height:15.75pt }
      table.sheet0 tr.row13 { height:22.5pt }
      table.sheet0 tr.row14 { height:24pt }
      table.sheet0 tr.row15 { height:15.75pt }
      table.sheet0 tr.row16 { height:15.75pt }
      table.sheet0 tr.row17 { height:15.75pt }
      table.sheet0 tr.row18 { height:13.636363636364pt }
      table.sheet0 tr.row19 { height:13.636363636364pt }
      table.sheet0 tr.row20 { height:16.5pt }
      table.sheet0 tr.row21 { height:15.75pt }
      table.sheet0 tr.row22 { height:16.5pt }
      table.sheet0 tr.row23 { height:15.75pt }
    </style>
  </head>

  <body>
<style>
@page { margin-left: 0.26in; margin-right: 0.19in; margin-top: 0.21in; margin-bottom: 0.22in; }
body { margin-left: 0.26in; margin-right: 0.19in; margin-top: 0.21in; margin-bottom: 0.22in; }
</style>
    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <col class="col5">
        <col class="col6">
        <col class="col7">
        <col class="col8">
        <col class="col9">
        <col class="col10">
        <col class="col11">
        <col class="col12">
        <col class="col13">
        <tbody>
          <tr class="row0">
            <td class="column0 style1 s style5" rowspan="3">МТ-1   шакл</td>
            <td class="column1 style2 s style3" colspan="12">&quot;МАТБУОТГА КЎМАКЧИ&quot; МЧЖ  телефонлар: 67 225-33-83, 90 255-33-83.</td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row1">
            <td class="column1 style6 s style7" colspan="5">АБОНОМЕНТ</td>
            <td class="column6 style8 null"></td>
            <td class="column7 style8 null"></td>
            <td class="column8 style9 s style10" colspan="3">нашр индекси</td>
            <td class="column11 style11 null style12" colspan="2"><? echo $nashr_index; ?></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row2">
            <td class="column1 style13 null style15" colspan="12"><? echo str_replace('_', ' ', $nashr_nomi) ; ?></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row3">
            <td class="column0 style16 null"></td>
            <td class="column1 style8 null"></td>
            <td class="column2 style8 null"></td>
            <td class="column3 style8 null"></td>
            <td class="column4 style17 s style17" colspan="6">(нашр номи)</td>
            <td class="column10 style8 null"></td>
            <td class="column11 style8 null"></td>
            <td class="column12 style18 null"></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row4">
            <td class="column0 style16 null"></td>
            <td class="column1 style19 s style19" colspan="4">2024 йил обунаси учун </td>
            <td class="column5 style8 null"></td>
            <td class="column6 style8 null"></td>
            <td class="column7 style8 null"></td>
            <td class="column8 style19 s style20" colspan="3">Комплектлар сони</td>
            <td class="column11 style11 null style12" colspan="2"><?  echo $komplektlar_soni; ?></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row5">
            <td class="column0 style16 null"></td>
            <td class="column1 style19 s style20" colspan="12">Обуна етказиб бериш муддати (ойлар бўйича)</td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row6">
            <td class="column0 style16 s">сана</td>
            <td class="column1 style21 n">1</td>
            <td class="column2 style22 n">2</td>
            <td class="column3 style22 n">3</td>
            <td class="column4 style22 n">4</td>
            <td class="column5 style22 n">5</td>
            <td class="column6 style22 n">6</td>
            <td class="column7 style22 n">7</td>
            <td class="column8 style22 n">8</td>
            <td class="column9 style22 n">9</td>
            <td class="column10 style22 n">10</td>
            <td class="column11 style22 n">11</td>
            <td class="column12 style22 n">12</td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row7">
<? if ($_POST['obuna_davri'] == "6") { ?>
            <td class="column0 style16 null"><? echo date('d.m.Y'); ?></td>
            <td class="column1 style21 null">x</td>
            <td class="column2 style22 null">x</td>
            <td class="column3 style22 null">x</td>
            <td class="column4 style22 null">x</td>
            <td class="column5 style22 null">x</td>
            <td class="column6 style22 null">x</td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <!-- <td class="column13">&nbsp;</td> -->
            <? } else { ?>
            <!-- Agar obuna davri 12 oy yoki tanlanmagan bo'lsa, 12 oy uchun to'ldirish -->
            <td class="column0 style16 null"><? echo date('d.m.Y'); ?></td>
            <td class="column1 style21 null">x</td>
            <td class="column2 style22 null">x</td>
            <td class="column3 style22 null">x</td>
            <td class="column4 style22 null">x</td>
            <td class="column5 style22 null">x</td>
            <td class="column6 style22 null">x</td>
            <td class="column7 style22 null">x</td>
            <td class="column8 style22 null">x</td>
            <td class="column9 style22 null">x</td>
            <td class="column10 style22 null">x</td>
            <td class="column11 style22 null">x</td>
            <td class="column12 style22 null">x</td>
            <!-- <td class="column13">&nbsp;</td> -->
            <? } ?>
          </tr>
          <tr class="row8">
            <td class="column0 style16 null"></td>
            <td class="column1 style23 s style24" colspan="3">Обуна баҳоси</td>
            <td class="column4 style25 s style26" colspan="3"><? echo $final_narx; ?> сўм.</td>
            <td class="column7 style24 null style24" colspan="6"><?   echo $hudud .",". $mfy;     ?></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row9">
            <td class="column0 style27 s style32" rowspan="3">Обуна уюштирувчининг махсус муҳри</td>
            <td class="column1 style8 null"></td>
            <td class="column2 style8 null"></td>
            <td class="column3 style8 null"></td>
            <td class="column4 style8 null"></td>
            <td class="column5 style8 null"></td>
            <td class="column6 style8 null"></td>
            <td class="column7 style19 s style20" colspan="6">(манзил: шаҳар, туман, МФЙ.)</td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row10">
            <td class="column1 style28 s style29" colspan="2">Қаерга: </td>
            <td class="column3 style30 null style31" colspan="10"><? if (!empty($tashkilot)) { echo "Ташкилот: ". $tashkilot; } echo " Манзил: ". $manzil .", Тел: ". $number_raqam . ", ФИО: " . $fish; ?></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row11">
            <td class="column1 style33 s style35" colspan="12">(почта индекси, ташкилот номи, обуначининг Ф.И.Ш.)</td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row12">
            <td class="column0 style1 s style5" rowspan="3">МТ-1   шакл</td>
            <td class="column1 style2 s style3" colspan="12">&quot;МАТБУОТГА КЎМАКЧИ&quot; МЧЖ  телефонлар: 67 225-33-83, 90 255-33-83.</td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row13">
            <td class="column1 style6 s style7" colspan="5">АБОНОМЕНТ</td>
            <td class="column6 style8 null"></td>
            <td class="column7 style8 null"></td>
            <td class="column8 style9 s style10" colspan="3">нашр индекси</td>
            <td class="column11 style11 null style12" colspan="2"><? echo $nashr_index; ?></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row14">
            <td class="column1 style13 null style15" colspan="12"><? echo str_replace('_', ' ', $nashr_nomi) ; ?></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row15">
            <td class="column0 style16 null"></td>
            <td class="column1 style8 null"></td>
            <td class="column2 style8 null"></td>
            <td class="column3 style8 null"></td>
            <td class="column4 style17 s style17" colspan="6">(нашр номи)</td>
            <td class="column10 style8 null"></td>
            <td class="column11 style8 null"></td>
            <td class="column12 style18 null"></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row16">
            <td class="column0 style16 null"></td>
            <td class="column1 style19 s style19" colspan="4">2024 йил обунаси учун </td>
            <td class="column5 style8 null"></td>
            <td class="column6 style8 null"></td>
            <td class="column7 style8 null"></td>
            <td class="column8 style19 s style20" colspan="3">Комплектлар сони</td>
            <td class="column11 style11 null style12" colspan="2"><?  echo $komplektlar_soni; ?></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row17">
            <td class="column0 style16 null"></td>
            <td class="column1 style19 s style20" colspan="12">Обуна етказиб бериш муддати (ойлар бўйича)</td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row18">
            <td class="column0 style16 s">сана</td>
            <td class="column1 style21 n">1</td>
            <td class="column2 style22 n">2</td>
            <td class="column3 style22 n">3</td>
            <td class="column4 style22 n">4</td>
            <td class="column5 style22 n">5</td>
            <td class="column6 style22 n">6</td>
            <td class="column7 style22 n">7</td>
            <td class="column8 style22 n">8</td>
            <td class="column9 style22 n">9</td>
            <td class="column10 style22 n">10</td>
            <td class="column11 style22 n">11</td>
            <td class="column12 style22 n">12</td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row19">
<? if ($_POST['obuna_davri'] == "6") { ?>
            <td class="column0 style16 null"><? echo date('d.m.Y'); ?></td>
            <td class="column1 style21 null">x</td>
            <td class="column2 style22 null">x</td>
            <td class="column3 style22 null">x</td>
            <td class="column4 style22 null">x</td>
            <td class="column5 style22 null">x</td>
            <td class="column6 style22 null">x</td>
            <td class="column7 style22 null"></td>
            <td class="column8 style22 null"></td>
            <td class="column9 style22 null"></td>
            <td class="column10 style22 null"></td>
            <td class="column11 style22 null"></td>
            <td class="column12 style22 null"></td>
            <!-- <td class="column13">&nbsp;</td> -->
            <? } else { ?>
            <!-- Agar obuna davri 12 oy yoki tanlanmagan bo'lsa, 12 oy uchun to'ldirish -->
            <td class="column0 style16 null"><? echo date('d.m.Y'); ?></td>
            <td class="column1 style21 null">x</td>
            <td class="column2 style22 null">x</td>
            <td class="column3 style22 null">x</td>
            <td class="column4 style22 null">x</td>
            <td class="column5 style22 null">x</td>
            <td class="column6 style22 null">x</td>
            <td class="column7 style22 null">x</td>
            <td class="column8 style22 null">x</td>
            <td class="column9 style22 null">x</td>
            <td class="column10 style22 null">x</td>
            <td class="column11 style22 null">x</td>
            <td class="column12 style22 null">x</td>
            <!-- <td class="column13">&nbsp;</td> -->
            <? } ?>
          </tr>
          <tr class="row20">
            <td class="column0 style16 null"></td>
            <td class="column1 style23 s style24" colspan="3">Обуна баҳоси</td>
            <td class="column4 style25 s style26" colspan="3"><? echo $final_narx; ?> сўм.</td>
            <td class="column7 style24 null style24" colspan="6"><?   echo $hudud .",". $mfy;     ?></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row21">
            <td class="column0 style27 s style32" rowspan="3">Обуначининг имзоси</td>
            <td class="column1 style8 null"></td>
            <td class="column2 style8 null"></td>
            <td class="column3 style8 null"></td>
            <td class="column4 style8 null"></td>
            <td class="column5 style8 null"></td>
            <td class="column6 style8 null"></td>
            <td class="column7 style19 s style20" colspan="6">(манзил: шаҳар, туман, МФЙ.)</td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row22">
            <td class="column1 style28 s style29" colspan="2">Қаерга: </td>
            <td class="column3 style30 null style31" colspan="10"><? if (!empty($tashkilot)) { echo "Ташкилот: ". $tashkilot; } echo " Манзил: ". $manzil .", Тел: ". $number_raqam . ", ФИО: " . $fish; ?></td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
          <tr class="row23">
            <td class="column1 style33 s style35" colspan="12">(почта индекси, ташкилот номи, обуначининг Ф.И.Ш.)</td>
            <!-- <td class="column13">&nbsp;</td> -->
          </tr>
        </tbody>
    </table>


      <div style="margin-top: 40px; display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <p style="padding: 5px 10px; border: 1px solid black; width: 150px; border-radius: 10px; background-color: blue; text-align: center; margin: 0;">
          <a href="https://mk-sirdaryo.uz" style="text-decoration: none; font-size: 16px; color: white;">Orqaga qaytish</a>
        </p>
        <p style="padding: 5px 10px; border: 1px solid black; width: 150px; border-radius: 10px; background-color: #28a745; text-align: center; margin: 0; cursor: pointer;" id="downloadPdfBtn">
          <a href="#" onclick="downloadPDF(); return false;" style="text-decoration: none; font-size: 16px; color: white;">Yuklab olish (PDF)</a>
        </p>
      </div>

  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script>
    // PHP dan JavaScript ga ma'lumotlarni o'tkazish
    const pdfFileName = 'abonement_<?php echo date("Y-m-d"); ?>_<?php echo preg_replace("/[^a-zA-Z0-9_-]/", "_", $fish); ?>.pdf';
    
    function downloadPDF() {
      // Yuklab olish tugmasini yashirish
      const downloadBtn = document.getElementById('downloadPdfBtn');
      if (downloadBtn) {
        downloadBtn.style.display = 'none';
      }
      
      // PDF yaratish uchun element (faqat jadval va kerakli qismlar)
      const element = document.querySelector('table.sheet0');
      if (!element) {
        element = document.body;
      }
      
      // PDF sozlamalari
      const opt = {
        margin: [10, 10, 10, 10],
        filename: pdfFileName,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { 
          scale: 2,
          useCORS: true,
          letterRendering: true,
          logging: false
        },
        jsPDF: { 
          unit: 'mm', 
          format: 'a4', 
          orientation: 'portrait',
          compress: true
        }
      };
      
      // PDF yaratish va yuklab olish
      html2pdf().set(opt).from(element).save().then(function() {
        // PDF yaratilgandan keyin tugmani qayta ko'rsatish
        if (downloadBtn) {
          downloadBtn.style.display = 'block';
        }
      }).catch(function(error) {
        console.error('PDF yaratishda xatolik:', error);
        alert('PDF yaratishda xatolik yuz berdi. Iltimos, qayta urinib ko\'ring.');
        if (downloadBtn) {
          downloadBtn.style.display = 'block';
        }
      });
    }
  </script>
</html>



<?
// Telegramga buyurtmani yuborish
if (isset($btn) && TELEGRAM_BOT_TOKEN && TELEGRAM_CHAT_ID) {
    // Barcha ma'lumotlarni to'plash
    $arr = array();
    
    // Asosiy ma'lumotlar
    if (!empty($fish)) {
        $arr[] = 'F.I.Sh: ' . $fish;
    }
    if (!empty($toifa)) {
        $arr[] = 'Toifa: ' . $toifa;
    }
    if (!empty($number_raqam)) {
        $arr[] = 'Telefon raqami: ' . $number_raqam;
    }
    if (!empty($hudud)) {
        $arr[] = 'Hudud: ' . $hudud;
    }
    if (!empty($mfy)) {
        $arr[] = 'MFY: ' . $mfy;
    }
    if (!empty($manzil)) {
        $arr[] = 'Manzil: ' . $manzil;
    }
    // Tashkilot nomi - agar mavjud bo'lsa, ko'rsatiladi
    // Toifa "Yuridik shahs" bo'lsa, tashkilot nomi ko'rsatiladi
    // To'g'ridan-to'g'ri POST dan olish (sanitize_str() ba'zida bo'sh qilishi mumkin)
    $tashkilot_raw = $_POST['tashkilot'] ?? '';
    $tashkilot_clean = trim($tashkilot_raw);
    if (!empty($tashkilot_clean)) {
        $arr[] = 'Tashkilot nomi: ' . $tashkilot_clean;
    }
    
    // Nashr ma'lumotlari
    if (!empty($nashr_turi)) {
        $arr[] = 'Nashr turi: ' . $nashr_turi;
    }
    if (!empty($nashr_nomi)) {
        $arr[] = 'Nashr nomi: ' . str_replace('_', ' ', $nashr_nomi);
    }
    if (!empty($nashr_index)) {
        $arr[] = 'Indeks raqami: ' . $nashr_index;
    }
    
    // Obuna ma'lumotlari
    if (!empty($obuna_davri)) {
        $arr[] = 'Obuna davri (Oy): ' . $obuna_davri;
    }
    if (!empty($komplektlar_soni) && $komplektlar_soni > 0) {
        $arr[] = 'Komplekt soni (Шт): ' . $komplektlar_soni;
    }
    if (!empty($final_narx) && $final_narx > 0) {
        $arr[] = 'Umumiy narxi (Som) : ' . number_format($final_narx, 0, '.', '');
    }
    
    // Xabarni yaratish (barcha matnlarni to'g'ri encode qilish)
    $txt = '';
    foreach($arr as $line) {
        $txt .= $line . "\n";
    }
    
    // Telegram API ga POST so'rov yuborish (yaxshiroq usul)
    $url = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage";
    $data = array(
        'chat_id' => TELEGRAM_CHAT_ID,
        'text' => $txt,
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
        error_log("Telegram xabar yuborishda xatolik. HTTP Code: " . $httpCode . ", Error: " . $error);
    }
}