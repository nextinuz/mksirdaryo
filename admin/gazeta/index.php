<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma'lumotlar bazasiga nashrlar qo'shish</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Open+Sans:ital,wght@0,500;1,300;1,500&family=Roboto&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="text-center justify-content-center pt-2 mt-4">
                <h2>MA'LUMOTLAR OMBORIDAN FOYDALANISH!</h2>
            </div>
            <div class="col">
                <div class="text-center mt-5">
                    <h3>Nashr qo'shish</h3>
                </div>
                <form method="post">
                    <label class="form-label my_type mt-4">Nashr turini tanlang: </label>
                    <select class="form-select selects my_w text-center" id="nashr_type" name="nashr_type">
                        <option selected disabled> -- Nashr turini -- </option>
                        <option value="gazeta">Gazeta</option>
                        <option value="jurnal">Jurnal</option>
                    </select>
                    <label class="form-label my_type mt-4">Nashr nomini kiriting: </label>
                    <input type="text" required id="login" name="login" placeholder="Nomi" class="form-control custom_inputs1 my_w">
                    <label class="form-label my_type mt-4">Nashr indeksni kiriting: </label>
                    <input type="text" required id="index" name="index" placeholder="Indeks" class="form-control  custom_inputs1 my_w">
                    <label class="form-label my_type mt-4">Nashr narxini kiriting: </label>
                    <input type="text" required id="price" name="price" placeholder="Narxi" class="form-control custom_inputs1 my_w">
                    <div class="col-4 mt-2">
                        <input type="submit" value="Qoshish" id="btn" name="btn" class="btn border btn-info btn_hover">
                    </div>
                </form>                
            </div>
            <div class="col">
                <div class="text-center mt-5">
                    <h3>Nashrni o'chirish</h3>
                </div>
                <form method="post">
                    <label class="form-label my_type mt-4">Nashr turini tanlang: </label>
                    <select class="form-select selects my_w text-center" id="nashr_type" name="nashr_type">
                        <option selected disabled> -- Nashr turini -- </option>
                        <option value="gazeta">Gazeta</option>
                        <option value="jurnal">Jurnal</option>
                    </select>
                    <label class="form-label my_type mt-4">Nashr nomini kiriting: </label>
                    <input type="text" required='' id="del_name" name="del_name" placeholder="Gazeta o'chirish" class="form-control custom_inputs2 custom_inputs1 my_w">
                    <div class="col-4 mt-2 mb-5">
                        <input type="submit" id="delete" name="delete" value="O'chirish" class="btn border btn-info btn_hover">
                    </div>
                </form>
            </div>
                        <div class="col">
                <div class="text-center mt-5">
                    <h3>Nashrni Narxini O'zgartirish</h3>
                </div>
                <form method="post">
                    <label class="form-label my_type mt-4">Nashr turini tanlang: </label>
                    <select class="form-select selects my_w text-center" id="nashr_turi" name="nashr_turi" onchange="NashrBosilganda(this.value)">
                        <option selected disabled> -- Nashr turini -- </option>
                        <option value="gazeta">Gazeta</option>
                        <option value="jurnal">Jurnal</option>
                    </select>
                    <div id="modal_nashr" style="display: none;">
                      <label class="form-label my_class">Nashr nomidan tanlang</label>
                        <select class="form-select selects my_w text-center" id="nashr"  onchange="Nashr(this.value)" name="nashr_nomi"></select>
                    </div>
                    <label class="form-label my_type mt-4">Nashr narxini kiriting: </label>
                    <input type="text" required='' id="change_name" name="change_name" placeholder="Yillik obuna narxi" class="form-control custom_inputs2 custom_inputs1 my_w">
                    <div class="col-4 mt-2 mb-5">
                        <input type="submit" id="change" name="change" value="O'zgartirish" class="btn border btn-info btn_hover">
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>



<script>

    let nashr_turi = document.querySelector('#nashr_turi')
    let modal_nashr = document.querySelector('#modal_nashr')
    nashr_turi.addEventListener('change', function() {
        if (this.value != '-- tanlang --') {
            modal_nashr.style.display = "block"
        }
    })

    
    function NashrBosilganda(id){
      $.ajax({
        type:'post',
        url: 'testajax.php',
        data : { nashr_turi : id},
        success : function(data){
           $('#nashr').html(data);
        }
      })
    }

</script>
  </body>
</html>

<?
require_once '../../config.php';

function allowed_table($name) {
    $allowed = ['gazeta', 'jurnal'];
    return in_array($name, $allowed, true) ? $name : null;
}

$login = sanitize_str($_POST['login'] ?? '');
$price = sanitize_str($_POST['price'] ?? '');
$priceVal = (float)$price;
$index = sanitize_str($_POST['index'] ?? '');
$btn = $_POST['btn'] ?? null;
$delete = $_POST['delete'] ?? null;
$del_name = sanitize_str($_POST['del_name'] ?? '');
$change_name = sanitize_str($_POST['change_name'] ?? '');
$change = $_POST['change'] ?? null;
$nashr_nomi = str_replace('_' , ' ', sanitize_str($_POST['nashr_nomi'] ?? ''));
$getFile = sanitize_str($_POST['nashr_turi'] ?? '');
$nashr_type = allowed_table($_POST['nashr_type'] ?? '');

if(isset($btn) && $nashr_type){
    $stmt = $db->prepare("INSERT INTO {$nashr_type} (`nomi`,`indeks`,`butun`) VALUES (?,?,?)");
    $stmt->bind_param('ssd', $login, $index, $priceVal);
    if($stmt->execute()){
        echo 'Yangi nashr qo‘shildi!';
    }else{
        echo 'Bu nashr mavjud yoki xatolik!';
    }
}

if (isset($change) && $getFile && allowed_table($getFile)) {
    $table = allowed_table($getFile);
    $stmt = $db->prepare("UPDATE {$table} SET `butun` = ? WHERE `nomi` = ?");
    $stmt->bind_param('ds', $change_name, $nashr_nomi);
    $stmt->execute();
}

if(isset($delete) && $nashr_type){
    $stmt = $db->prepare("DELETE FROM {$nashr_type} WHERE `nomi` = ?");
    $stmt->bind_param('s', $del_name);
    $stmt->execute();
}
?>
