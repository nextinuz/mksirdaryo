<?
require_once '../auth_check.php';
// CRUD operatsiyalari alohida faylda
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Ma'lumotlar bazasiga nashrlar qo'shish</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Open+Sans:ital,wght@0,500;1,300;1,500&family=Roboto&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        .action-selector {
            margin-bottom: 20px;
        }
        .action-content {
            display: none;
        }
        .action-content.active {
            display: block;
        }
        @media (max-width: 768px) {
            .action-selector select {
                font-size: 16px; /* iOS da zoom oldini olish */
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-4">
                <h2>MA'LUMOTLAR OMBORIDAN FOYDALANISH!</h2>
                    <div class="mt-2 mb-3">
                        <span class="badge bg-success">Kirilgan: <?= htmlspecialchars($_SESSION['admin_user'] ?? 'Admin', ENT_QUOTES, 'UTF-8') ?></span>
                        <a href="../settings.php" class="btn btn-sm btn-info ms-2">⚙️ Sozlamalar</a>
                        <a href="../logout.php" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Rostdan ham chiqmoqchimisiz?')">Chiqish</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 mx-auto">
                <!-- Amal tanlash -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <label for="actionSelect" class="form-label fw-bold">Amalni tanlang:</label>
                        <select class="form-select form-select-lg" id="actionSelect">
                            <option value="">-- Amalni tanlang --</option>
                            <option value="create">➕ Nashr qo'shish</option>
                            <option value="delete">🗑️ Nashrni o'chirish</option>
                            <option value="update">💰 Nashr narxini o'zgartirish</option>
                        </select>
                    </div>
                </div>
                
                <!-- Nashr qo'shish -->
                <div id="createContent" class="action-content card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">➕ Nashr qo'shish</h4>
                    </div>
                    <div class="card-body">
                        <form id="createForm" method="post">
                            <input type="hidden" name="action" value="create">
                            <div class="mb-3">
                                <label class="form-label">Nashr turini tanlang:</label>
                                <select class="form-select" id="nashr_type" name="nashr_type" required>
                        <option selected disabled> -- Nashr turini -- </option>
                        <option value="gazeta">Gazeta</option>
                        <option value="jurnal">Jurnal</option>
                    </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nashr nomini kiriting:</label>
                                <input type="text" required id="login" name="login" placeholder="Nomi" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nashr indeksni kiriting:</label>
                                <input type="text" required id="index" name="index" placeholder="Indeks" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nashr narxini kiriting:</label>
                                <input type="number" step="0.01" required id="price" name="price" placeholder="Narxi" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Qo'shish</button>
                            <div id="createMessage" class="mt-3"></div>
                        </form>
                    </div>
                </div>
                
                <!-- Nashrni o'chirish -->
                <div id="deleteContent" class="action-content card shadow-sm">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">🗑️ Nashrni o'chirish</h4>
                    </div>
                    <div class="card-body">
                        <form id="deleteForm" method="post">
                            <input type="hidden" name="action" value="delete">
                            <div class="mb-3">
                                <label class="form-label">Nashr turini tanlang:</label>
                                <select class="form-select" id="del_nashr_type" name="nashr_type" required onchange="loadNashrForDelete(this.value)">
                        <option selected disabled> -- Nashr turini -- </option>
                        <option value="gazeta">Gazeta</option>
                        <option value="jurnal">Jurnal</option>
                    </select>
                            </div>
                            <div class="mb-3" id="deleteNashrSelect" style="display: none;">
                                <label class="form-label">Nashr nomini tanlang:</label>
                                <select class="form-select" id="del_nashr_name" name="del_name" required>
                                    <option selected disabled> -- Nashrni tanlang -- </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger w-100">O'chirish</button>
                            <div id="deleteMessage" class="mt-3"></div>
                        </form>
                    </div>
                </div>
                
                <!-- Nashr narxini o'zgartirish -->
                <div id="updateContent" class="action-content card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">💰 Nashr narxini o'zgartirish</h4>
                    </div>
                    <div class="card-body">
                        <form id="updateForm" method="post">
                            <input type="hidden" name="action" value="update">
                            <div class="mb-3">
                                <label class="form-label">Nashr turini tanlang:</label>
                                <select class="form-select" id="nashr_turi" name="nashr_turi" onchange="NashrBosilganda(this.value)" required>
                        <option selected disabled> -- Nashr turini -- </option>
                        <option value="gazeta">Gazeta</option>
                        <option value="jurnal">Jurnal</option>
                    </select>
                            </div>
                            <div class="mb-3" id="modal_nashr" style="display: none;">
                                <label class="form-label">Nashr nomidan tanlang:</label>
                                <select class="form-select" id="nashr" onchange="Nashr(this.value)" name="nashr_nomi" required></select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Yangi narxni kiriting:</label>
                                <input type="number" step="0.01" required id="change_name" name="change_name" placeholder="Yillik obuna narxi" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-warning w-100">O'zgartirish</button>
                            <div id="updateMessage" class="mt-3"></div>
                        </form>
                    </div>
                    </div>
            </div>
        </div>
    </div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
    // Amal tanlash
    $(document).ready(function() {
        $('#actionSelect').on('change', function() {
            var selectedAction = $(this).val();
            
            // Barcha contentlarni yashirish
            $('.action-content').removeClass('active');
            
            // Tanlangan contentni ko'rsatish
            if (selectedAction) {
                $('#' + selectedAction + 'Content').addClass('active');
                
                // Scroll qilish (mobile uchun)
                $('html, body').animate({
                    scrollTop: $('#' + selectedAction + 'Content').offset().top - 20
                }, 300);
            }
        });
        
        // Nashr turi tanlanganda
        let nashr_turi = document.querySelector('#nashr_turi');
        let modal_nashr = document.querySelector('#modal_nashr');
        if (nashr_turi) {
    nashr_turi.addEventListener('change', function() {
                if (this.value && this.value !== '-- tanlang --') {
                    modal_nashr.style.display = "block";
                } else {
                    modal_nashr.style.display = "none";
        }
            });
        }
        
        // Nashr ro'yxatini yuklash (Update uchun)
        function NashrBosilganda(id) {
            if (!id) return;
      $.ajax({
                type: 'post',
        url: 'testajax.php',
                data: { nashr_turi: id },
                success: function(data) {
           $('#nashr').html(data);
                    $('#modal_nashr').show();
        }
            });
    }

        window.NashrBosilganda = NashrBosilganda;
        
        // Nashr ro'yxatini yuklash (Delete uchun)
        function loadNashrForDelete(nashr_turi) {
            if (!nashr_turi) {
                $('#deleteNashrSelect').hide();
                return;
            }
            
            $.ajax({
                type: 'post',
                url: 'testajax.php',
                data: { nashr_turi: nashr_turi },
                success: function(data) {
                    $('#del_nashr_name').html(data);
                    $('#deleteNashrSelect').show();
                },
                error: function() {
                    $('#deleteNashrSelect').hide();
                    alert('Xatolik yuz berdi!');
                }
            });
        }
        
        window.loadNashrForDelete = loadNashrForDelete;
        
        function Nashr(id) {
            // Bu funksiya kerak bo'lsa, bu yerga kod qo'shish mumkin
        }
        window.Nashr = Nashr;
        
        // Create form
        $('#createForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'crud.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    var msgClass = response.success ? 'alert-success' : 'alert-danger';
                    $('#createMessage').html('<div class="alert ' + msgClass + '">' + response.message + '</div>');
                    if (response.success) {
                        $('#createForm')[0].reset();
                        setTimeout(function() {
                            $('#createMessage').html('');
                        }, 3000);
                    }
                }
            });
        });
        
        // Update form
        $('#updateForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'crud.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    var msgClass = response.success ? 'alert-success' : 'alert-danger';
                    $('#updateMessage').html('<div class="alert ' + msgClass + '">' + response.message + '</div>');
                    if (response.success) {
                        setTimeout(function() {
                            $('#updateMessage').html('');
                        }, 3000);
                    }
                }
            });
        });
        
        // Delete form
        $('#deleteForm').on('submit', function(e) {
            e.preventDefault();
            if (!confirm('Rostdan ham o\'chirmoqchimisiz?')) {
                return;
            }
            $.ajax({
                url: 'crud.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    var msgClass = response.success ? 'alert-success' : 'alert-danger';
                    $('#deleteMessage').html('<div class="alert ' + msgClass + '">' + response.message + '</div>');
                    if (response.success) {
                        $('#deleteForm')[0].reset();
                        setTimeout(function() {
                            $('#deleteMessage').html('');
                        }, 3000);
                    }
                }
            });
        });
    });
</script>
  </body>
</html>
