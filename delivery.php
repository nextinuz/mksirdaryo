<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Yetkazib berish shartlari. Matbuotga ko'makchi - Sirdaryo viloyat obuna xizmati">
    <meta name="keywords" content="Yetkazib berish shartlari, Guliston obuna, Sirdaryo obuna, Matbuotga komakchi">
    <title>Yetkazib berish shartlari - Matbuotga ko'makchi</title>
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
    <style>
        .delivery-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
        }
        .delivery-title {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }
        .delivery-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: block;
            margin: 0 auto;
        }
        @media (max-width: 768px) {
            .delivery-title {
                font-size: 24px;
            }
            .delivery-container {
                padding: 15px;
                margin: 20px auto;
            }
        }
        @media (max-width: 480px) {
            .delivery-title {
                font-size: 20px;
            }
            .delivery-container {
                padding: 10px;
            }
        }
    </style>
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
</section>

<!-- Delivery Image Section -->
<div class="delivery-container">
    <h1 class="delivery-title">YETKAZIB BERISH SHARTLARI</h1>
    <?php
    // PDF fayl nomini tekshirish (ikkala variantni ham qo'llab-quvvatlash)
    $image_file = null;
    if (file_exists('./delivery/delivery.jpg')) {
        $image_file = './delivery/delivery.jpg';
    } elseif (file_exists('./delivery/delivery.JPG')) {
        $image_file = './delivery/delivery.JPG';
    } elseif (file_exists('./delivery/Delivery.jpg')) {
        $image_file = './delivery/Delivery.jpg';
    } elseif (file_exists('./delivery/Delivery.JPG')) {
        $image_file = './delivery/Delivery.JPG';
    }
    ?>
    <?php if ($image_file): ?>
        <img src="<?php echo htmlspecialchars($image_file); ?>" alt="Yetkazib berish shartlari" class="delivery-image">
    <?php else: ?>
        <div class="alert alert-warning text-center">
            <p>Rasm topilmadi. Iltimos, <code>delivery/delivery.jpg</code> faylini tekshiring.</p>
        </div>
    <?php endif; ?>
</div>

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
