<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" tent="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gazetaga obuna bo'lish. Guliston obuna. Jurnal obuna. Sirdaryo obuna. Matbuotga komakchi. ">
    <meta name="keywords" content="Gazetaga obuna bo'lish. Guliston obuna. Jurnal obuna. Sirdaryo obuna. Matbuotga komakchi. Darakchi. Obuna. Guliston gazeta. Yangi sirdaryo gazetasi. Xalq so'zi guliston. Sirdaryo Obuna.">
    <title>Matbuotga ko'makchi - Sirdaryo viloyat obuna xizmati</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="icon" href="img/icon.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="./css/style.css">
</head>
<body onload="setStates();">


<? require_once('config.php'); ?>

<section class="top_img">

    <div class="top-box">
      <div class="row">
        <div class="box d-flex justify-content-around">
            <!-- Logo  -->
          <div class="">
            <a href="index.php"><img class="logo-img" src="./img/logo.png" alt="nextin_logo"></a>
          </div>
            <!-- Modal -->

          <div class="align-items-center">
            <!-- aloqa uchun modul -->
            <a type="button" class="align-self-center text-decoration-none top_btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Aloqa uchun</a>
            <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="fs-5 modal_title text-center mx-auto" id="staticBackdropLabel">Biz bilan aloqa</h1>
                    <button type="button" class="btn-close close_btn" data-bs-dismiss="modal" aria-label="Close" style="margin-left:0;"></button>
                  </div>
                  <div class="modal-body">
                    <div id="contactForm">
                      <div class="mb-3">
                        <label for="phone" class="form-label">Telefon kiriting:</label>
                        <input name="number" value="+998(__)___-__-__" class="form-control modal-inputt" type="text" id="phone" placeholder="+998(__)___-__-__" required>
                      </div>
                      <div id="contactMessage" class="mt-3"></div>
                    </div>
                    <div id="contactSuccess" style="display: none;">
                      <div class="alert alert-success text-center">
                        <i class="fas fa-check-circle" style="font-size: 48px; color: #28a745;"></i>
                        <h5 class="mt-3">Ma'lumot yuborildi!</h5>
                        <p class="mb-0">Tez orada siz bilan bog'lanamiz.</p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModalBtn">Yopish</button>
                    <button type="button" id="btnSave" class="btn modal_btn text-decoration-none">Yuborish</button>
                  </div>
                </div>
              </div>
            </div>
          <!-- Aloqa uchun modul end -->
          </div>



            <!-- Menuuu  -->
            <button class="navbar-toggler navbar-toggler-but custom-toggler" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
          <div class="offcanvas offcanvas-end" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width: 320px;">
            <div class="offcanvas-header bg-light">
              <a href="#" class="offcanvas-title "><img src="" alt=""></a>
              <button type="button" class="btn-close text-reset close-but flex-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body bg-light">
              <ul class="nav-pills navbar-nav justify-content-end">
                <li class="nav-item">
                  <a class="sitenav-item-link" style="text-align: center;" href="delivery.php">YETKAZIB BERISH SHARTLARI</a>
                </li>
                <li class="nav-item">
                  <a class="sitenav-item-link" href="#">QO'SHIMCHA MA'LUMOTLAR</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="main_titles text-center justify-content-center pt-2">
          <h2>2026-YIL UCHUN DAVRIY NASHRLARGA OBUNA BO'LISH</h2>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <form action="chek.php" id="form2" method="post" onsubmit="validateForm(event)">
            <!-- FIO -->
            <div>
              <label class="form-label my_class">FIO</label>
              <input class="form-control" type="text" placeholder="F.I.SH" name="fish" id="fish">
            </div>
            <!-- Toifa -->
            <div>
              <label class="form-label my_class">Toifa</label>
              <select name="toifa" class="form-select selects" id="tashk" aria-label="Default select example">
                <option value="Jismoniy shahs">Jismoniy shahs</option>
                <option value="Yuridik shahs">Yuridik shahs</option>
              </select>
              <input name="tashkilot" value="" class="form-control" id="tashk_input" placeholder="Tashkilotni yozing">
            </div>
            <!-- Telefon raqamingiz -->
            <div>
              <label class="form-label my_class">Telefon raqamingiz</label>
              <input id="leister" class="form-control" type="phone" name="number_raqam" name="leister" value="+998(__)___-__-__"  for="telefon" required  class="form-control">
            </div>
            <!-- Tumanlar -->
            <div>
              <label for="form-select_selects" class="form-label my_class">Siz qaysi tumandansiz?</label>
              <select name="hudud" id="form-select_selects" class="form-select selects" aria-label="Default select example">
                <option selected hidden name = 'hudud'>-- Hudud tanlang --</option>
                <option value="Гулистон шахри">Гулистон шахри</option>
                <option value="Янгиер шахри">Янгиер шахри</option>
                <option value="Ширин шахри">Ширин шахри</option>
                <option value="Боёвут тумани">Боёвут тумани</option>
                <option value="Гулистон тумани">Гулистон тумани</option>
                <option value="Мирзобод тумани">Мирзобод тумани</option>
                <option value="Околтин тумани">Околтин тумани</option>
                <option value="Сайхунобод тумани">Сайхунобод тумани</option>
                <option value="Сардоба тумани">Сардоба тумани</option>
                <option value="Сирдарё тумани">Сирдарё тумани</option>
                <option value="Ховос тумани">Ховос тумани</option>
              </select>
            </div>
            <!-- MFY -->
            <div id="modal_mfy" style="display: none;">
              <label for="form-control" class="form-label my_class">MFY nomi</label>
              <input class="form-control" id="form-control" type="text" placeholder="-- nomini kiriting --" value="" name='mfy'>
              <select class="form-select selects " style="display: none;" id="oblact" name = 'mfy'></select>
            </div>
            <!-- Manzil -->
            <div>
              <label class="form-label my_class">Manzilingiz</label>
              <input class="form-control manzil" name="manzil" value="" type="text" placeholder="Masalan: Eshonxo'jayev 56A.">
            </div>
            <!-- Nashr turi -->
            <div>
              <label class="form-label my_class">Nashr turini tanlang</label>
              <select class="form-select selects" id="nashr_turi" onchange="NashrBosilganda(this.value)" aria-label="Default select example" name="nashr_turi">
                <option selected hidden>-- tanlang --</option>
                <option value="gazeta">Gazeta</option>
                <option value="jurnal">Jurnal</option>
              </select>
            </div>
            <!-- Nashr nomlari -->
            <div id="modal_nashr" style="display: none;">
              <label class="form-label my_class">Nashr nomidan tanlang</label>
                <select class="form-select selects" id="nashr"  onchange="Nashr(this.value)" aria-label="Default select example" name="nashr_nomi">
                </select>
            </div>
            <!-- Index, Obuna davri, To'plam va Narx -->
            <div id="chek" class="mt-4 px-3">
              <!-- Index -->
              <p class="my_class">Indeks raqami:<span class="my_span" id="nashr_index"></span></p>
              <!-- Obuna davri -->
              <label class="form-label my_class">Obuna davri</label>
              <select class="form-select selects" aria-label="Default select example" name="obuna_davri" id="obuna_davri"  onchange="Obuna(this.value)">
                <option selected disabled value="">-- tanlang --</option>
                <option value="12">12 oy</option>
                <option value="6">6 oy</option>
              </select>
              <!-- To'plamlar soni -->
              <div id="komplektlar_container" style="display: none;">
              <label class="form-label my_class">Komplektlar soni</label>
              <input type="number" class="form-control" name="komplektlar_soni" id="komplektlar_soni" value="" onkeyup="Komplect(this.value)" placeholder="1">
              </div>
              <!-- Narx -->
              <p class="my_class mt-2">Obunaning bahosi: <span class="my_span" id="nashr_narxi"></span> so'm <span id="obuna_davri_text" style="font-weight: normal; color: #666;"></span></p>
            </div>
            <div class="text-center mt-2">
              <button type="submit" name="btn" id="knopka" class="btn btn-primary btn-lg">Yuborish</button>
            </div>
          </form>
       </div>
       <div class="col-md-8 text-center ">
         <h2 class="mt-5" style="font-size: 100px; color: red;">2026 <br> OBUNA UCHUN</h2>
<!--          <p>Ushbu dastur <a class="nextin" href="https://nextin.uz">"Nextin Web Studio"</a> tomonidan obuna xizmatiga yordamlashish maqsadida ishlab chiqildi. Dasturdan maqsad obunachilarga qulayliklar yaratish, ularga gazeta va jurnallarni o'z vaqtida yetkazib berish va obuna davridan ularni xabardor qilib turish. Dasturimiz undan tashqari sizga quydagi qulayliklarni yaratib beradi!</p>
<ul  class="list-unstyled text-start">
  <li>1) Har obuna davridan sizni xabardor qilib turish;</li>
  <li>2) Obuna bo'lgan nashrlar soni to'lovlar va boshqa kerakli ma'lumotlarni shahasiy kabinetda kuzatib borish;</li>
  <li>3) Obunaning yetkazib berish vaqt yoki kechikish sabablarini muntazam kuzatib borish;</li>
  <li>4) Davlat korxonalari uchun xisobotlarni online topshirish;</li>
  <li>5) Har qanday gadjetdan foydalanish mumkinligi, zamonaviy bo'lmagan (Eski tugmali telefonlar, internetsiz) uyali aloqa vositalarida yuqoridagi barcha imkoniyatlarni qisqa buyruqlar yordamida amalga oshirish;</li>
</ul>
<p>Dastur ayni vaqtda test ko'rinishida ishlamoqda. Ushbu sanalgan qulaykiklar tez orada ishga tushuriladi!</p> -->
       </div>
      </div>
    </div>

</section>

  <!-- Footer section  -->

<footer id="footere">
  <div class="container footer_pastga">
    <div class="row ">
      <!-- Contacts -->
      <div class="col-lg-6 col-md-6 col-xs-6 p-4 text-center  footer_linkss">
        <li class="mt-2">  <a class="text-decoration-none footer-phone" href="tel:+998933245666">+998 93 324 56 66</a> </li>
        <li class="mt-2"> <a class="text-decoration-none" href="mailto:info@nextin.uz">info@mk-sirdaryo.uz</a> </li>
      </div>
  <!-- Adress -->
      <div class="p-4 text-center col-md-6 col-xs-6 col-lg-6 align-items-center">
        <p class="footer-address">Sirdaryo viloyati, Guliston shahri<br>
          Eshonxo'jayev ko'chasi, 56A
        </p>
      </div>
    </div>
     <!-- Доп инфо  -->
    <div class="row">
      <div class="col-lg-10  mx-auto text-center pb-4">
        <a href="#" target="_blank" class="text-link text-decoration-none">Matbuotga Ko'makchi Sirdaryo <br>© Все права защищены 2011-<? echo date('Y'); ?></a>
      </div>
    </div>
 </div>
 
 
 
 
 <?php
// Foydalanuvchilar sonini ma'lumotlar bazasida saqlash
if (!isset($_SESSION['visited'])) {
    $_SESSION['visited'] = true;

    // Jadvallarni yaratish (agar mavjud bo'lmasa)
    $create_table = "CREATE TABLE IF NOT EXISTS site_stats (
        id INT AUTO_INCREMENT PRIMARY KEY,
        visit_count INT DEFAULT 0,
        last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $db->query($create_table);
    
    // Agar jadval bo'sh bo'lsa, birinchi qatorni yaratish
    $check = $db->query("SELECT visit_count FROM site_stats LIMIT 1");
    if ($check->num_rows == 0) {
        $db->query("INSERT INTO site_stats (visit_count) VALUES (0)");
    }
    
    // Sonni oshirish (atomic operation)
    $db->query("UPDATE site_stats SET visit_count = visit_count + 1 WHERE id = 1");
    }

// Joriy sonni olish
$result = $db->query("SELECT visit_count FROM site_stats WHERE id = 1 LIMIT 1");
$display_count = 0;
if ($result && $row = $result->fetch_assoc()) {
    $display_count = (int)$row['visit_count'];
}
echo "<div style='padding-left: 50px; padding-bottom: 20px; font-size: 18px; '>Saytni kuzatuvchilar soni: {$display_count}</div>";
?>

 
</footer>
   
    <script src="./js/main.js"></script>
    <script src="./js/js.js"></script>
    <script src="./js/click.js"></script>
    <script>
    // Aloqa modali uchun AJAX
    $(document).ready(function() {
        $('#btnSave').on('click', function(e) {
            e.preventDefault();
            
            var phone = $('#phone').val();
            
            // Telefon raqamini tekshirish
            if (!phone || phone.indexOf('_') !== -1) {
                $('#contactMessage').html('<div class="alert alert-danger">Iltimos, to\'liq telefon raqamini kiriting!</div>');
                return;
            }
            
            // Yuborish tugmasini o'chirish
            $(this).prop('disabled', true).text('Yuborilmoqda...');
            
            // AJAX orqali yuborish
            $.ajax({
                url: 'contact_handler.php',
                type: 'POST',
                data: {
                    call_modal: 'yuborish',
                    number: phone
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Formani yashirish, muvaffaqiyat xabarini ko'rsatish
                        $('#contactForm').hide();
                        $('#contactSuccess').show();
                        $('#btnSave').hide();
                        $('#closeModalBtn').text('Yopish').removeClass('btn-secondary').addClass('btn-primary');
                        
                        // 3 soniyadan keyin modalni yopish
                        setTimeout(function() {
                            $('#staticBackdrop').modal('hide');
                        }, 3000);
                    } else {
                        $('#contactMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                        $('#btnSave').prop('disabled', false).text('Yuborish');
                    }
                },
                error: function() {
                    $('#contactMessage').html('<div class="alert alert-danger">Xatolik yuz berdi. Iltimos, qayta urinib ko\'ring.</div>');
                    $('#btnSave').prop('disabled', false).text('Yuborish');
                }
            });
        });
        
        // Modal yopilganda formani tozalash
        $('#staticBackdrop').on('hidden.bs.modal', function() {
            $('#contactForm').show();
            $('#contactSuccess').hide();
            $('#phone').val('+998(__)___-__-__');
            $('#btnSave').prop('disabled', false).text('Yuborish').show();
            $('#closeModalBtn').text('Yopish').removeClass('btn-primary').addClass('btn-secondary');
            $('#contactMessage').html('');
        });
    });
    </script>
</body>
</html>





