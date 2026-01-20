<?
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Sozlamalar - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">⚙️ Sozlamalar</h3>
                    </div>
                    <div class="card-body">
                        <!-- Foydalanuvchi ma'lumotlari -->
                        <div class="mb-4">
                            <h5>Foydalanuvchi ma'lumotlari</h5>
                            <p><strong>Login:</strong> <?= htmlspecialchars($_SESSION['admin_user'] ?? 'Admin', ENT_QUOTES, 'UTF-8') ?></p>
                            <p><strong>Kirish vaqti:</strong> <?= date('d.m.Y H:i', $_SESSION['admin_login_time'] ?? time()) ?></p>
                        </div>
                        
                        <hr>
                        
                        <!-- Parol o'zgartirish -->
                        <div class="mb-4">
                            <h5>Parol o'zgartirish</h5>
                            <form id="changePasswordForm" method="post">
                                <input type="hidden" name="action" value="change_password">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Joriy parol</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Yangi parol</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" required minlength="6">
                                    <div class="form-text">Parol kamida 6 ta belgidan iborat bo'lishi kerak</div>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Yangi parolni tasdiqlash</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Parolni o'zgartirish</button>
                                <div id="passwordMessage" class="mt-3"></div>
                            </form>
                        </div>
                        
                        <hr>
                        
                        <!-- Navigatsiya -->
                        <div class="d-flex justify-content-between">
                            <a href="gazeta/index.php" class="btn btn-secondary">← Orqaga</a>
                            <a href="logout.php" class="btn btn-danger">Chiqish</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $('#changePasswordForm').on('submit', function(e) {
            e.preventDefault();
            
            var newPassword = $('#new_password').val();
            var confirmPassword = $('#confirm_password').val();
            
            // Parol mosligini tekshirish
            if (newPassword !== confirmPassword) {
                $('#passwordMessage').html('<div class="alert alert-danger">Yangi parollar mos kelmaydi!</div>');
                return;
            }
            
            // Parol uzunligini tekshirish
            if (newPassword.length < 6) {
                $('#passwordMessage').html('<div class="alert alert-danger">Parol kamida 6 ta belgidan iborat bo\'lishi kerak!</div>');
                return;
            }
            
            // AJAX orqali yuborish
            $.ajax({
                url: 'settings_action.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    var msgClass = response.success ? 'alert-success' : 'alert-danger';
                    $('#passwordMessage').html('<div class="alert ' + msgClass + '">' + response.message + '</div>');
                    if (response.success) {
                        $('#changePasswordForm')[0].reset();
                        setTimeout(function() {
                            $('#passwordMessage').html('');
                        }, 3000);
                    }
                },
                error: function() {
                    $('#passwordMessage').html('<div class="alert alert-danger">Xatolik yuz berdi!</div>');
                }
            });
        });
    });
    </script>
</body>
</html>
