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
            <form action="" id="form1" method="post" class="align-items-center">
            <a type="button" class="align-self-center text-decoration-none top_btn " data-bs-toggle="modal" data-bs-target="#staticBackdrop">Aloqa uchun</a>
            <div class="modal fade" id="staticBackdrop"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"   aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class=" fs-5 modal_title text-center mx-auto" id="staticBackdropLabel">Biz bilan aloqa</h1>
                    <button type="button" class="btn-close close_btn" data-bs-dismiss="modal" aria-label="Close" style="margin-left:0;"></button>
                  </div>
                  <div class="modal-body d-flex align-items-center">
                    <label for="phone" ata-error="wrong" data-success="right" class="modal_label">Telefon kiriting:</label>
                    <input name="number" value="" class="form-control modal-inputt" type="number" id="phone" placeholder="+998">
                  </div>
                  <div class="modal-footer">
                    <button type="submit" id="btnSave" name="call_modal" value="yuborish" class="btn modal_btn text-decoration-none" data-bs-dismiss="modal">Yuborish</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
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




<style>
  .pdfFile {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>


  
<div class="pdfFile">
  <table cellspacing="0" border="0">
  <colgroup width="21"></colgroup>
  <colgroup width="214"></colgroup>
  <colgroup width="70"></colgroup>
  <colgroup width="112"></colgroup>
  <colgroup width="122"></colgroup>
  <colgroup width="129"></colgroup>
  <tr>
    <td height="21" align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td colspan=3 align="center" valign=bottom><b><font face="Times New Roman" size=3>&quot;&#1058; &#1040; &#1057; &#1044; &#1048; &#1178; &#1051; &#1040; &#1053; &#1044; &#1048;&quot;</font></b></td>
    </tr>
  <tr>
    <td height="20" align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td colspan=3 align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    </tr>
  <tr>
    <td height="20" align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td colspan=3 align="center" valign=bottom><font face="Times New Roman">&quot;&#1052;&#1040;&#1058;&#1041;&#1059;&#1054;&#1058;&#1043;&#1040; &#1050;&#1038;&#1052;&#1040;&#1050;&#1063;&#1048;&quot; &#1052;&#1063;&#1046;</font></td>
    </tr>
  <tr>
    <td height="20" align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td colspan=3 align="center" valign=bottom><font face="Times New Roman">&#1076;&#1080;&#1088;&#1077;&#1082;&#1090;&#1086;&#1088;&#1080;_______________&#1055;.&#1061;.&#1047;&#1072;&#1088;&#1084;&#1072;&#1089;&#1086;&#1074;</font></td>
    </tr>
  <tr>
    <td height="20" align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td colspan=3 align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    </tr>
  <tr>
    <td height="20" align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td colspan=3 align="center" valign=bottom><font face="Times New Roman">2023 &#1081;&#1080;&#1083; &quot;27 &quot; &#1076;&#1077;&#1082;&#1072;&#1073;&#1088;&#1100;</font></td>
    </tr>
  <tr>
    <td height="17" align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="right" valign=bottom><b><font face="Times New Roman"><br></font></b></td>
    <td align="right" valign=bottom><b><font face="Times New Roman"><br></font></b></td>
    <td align="center" valign=bottom><b><font face="Times New Roman"><br></font></b></td>
  </tr>
  <tr>
    <td height="20" align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><b><font face="Times New Roman"><br></font></b></td>
    <td align="left" valign=bottom><b><font face="Times New Roman"><br></font></b></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
  </tr>
  <tr>
    <td colspan=6 height="22" align="center" valign=bottom><b><font face="Times New Roman" size=3>&quot;&#1052;&#1040;&#1058;&#1041;&#1059;&#1054;&#1058;&#1043;&#1040; &#1050;&#1038;&#1052;&#1040;&#1050;&#1063;&#1048;&quot; &#1052;&#1063;&#1046; &#1053;&#1048;&#1053;&#1043;</font></b></td>
    </tr>
  <tr>
    <td colspan=6 height="22" align="center" valign=bottom><b><font face="Times New Roman" size=3>&#1061;&#1040;&#1058; &#1042;&#1040; &#1061;&#1059;&#1046;&#1046;&#1040;&#1058;&#1051;&#1040;&#1056;&#1053;&#1048; &#1045;&#1058;&#1050;&#1040;&#1047;&#1048;&#1041; &#1041;&#1045;&#1056;&#1048;&#1064; </font></b></td>
    </tr>
  <tr>
    <td colspan=6 height="21" align="center" valign=bottom><b><font face="Times New Roman" size=3>&#1061;&#1048;&#1047;&#1052;&#1040;&#1058;&#1051;&#1040;&#1056;&#1048;&#1053;&#1048; &#1050;&#1038;&#1056;&#1057;&#1040;&#1058;&#1048;&#1064; &#1041;&#1038;&#1049;&#1048;&#1063;&#1040;</font></b></td>
    </tr>
  <tr>
    <td height="6" align="center" valign=bottom><b><font face="Times New Roman" size=3><br></font></b></td>
    <td align="center" valign=bottom><b><font face="Times New Roman" size=3><br></font></b></td>
    <td align="center" valign=bottom><b><font face="Times New Roman" size=3><br></font></b></td>
    <td align="center" valign=bottom><b><font face="Times New Roman" size=3><br></font></b></td>
    <td align="center" valign=bottom><b><font face="Times New Roman" size=3><br></font></b></td>
    <td align="center" valign=bottom><b><font face="Times New Roman" size=3><br></font></b></td>
  </tr>
  <tr>
    <td colspan=6 height="34" align="center" valign=bottom><b><font face="Times New Roman" size=5>&#1058;&#1040;&#1056;&#1048;&#1060;&#1051;&#1040;&#1056; &#1044;&#1040;&#1056;&#1040;&#1046;&#1040;&#1057;&#1048;</font></b></td>
    </tr>
  <tr>
    <td height="18" align="center" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
  </tr>
  <tr>
    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000" height="94" align="center" valign=middle><b><font face="Times New Roman">&#8470;</font></b></td>
    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b><font face="Times New Roman" size=4>&#1061;&#1080;&#1079;&#1084;&#1072;&#1090; &#1090;&#1091;&#1088;&#1083;&#1072;&#1088;&#1080;</font></b></td>
    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b><font face="Times New Roman">&#1052;&#1080;&#1179;&#1076;&#1086;&#1088;&#1080; (&#1075;&#1088;&#1072;&#1084;&#1084;, &#1076;&#1086;&#1085;&#1072;, &#1077;&#1090;&#1082;&#1072;&#1079;&#1080;&#1096;)</font></b></td>
    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b><font face="Times New Roman">&#1042;&#1080;&#1083;&#1086;&#1103;&#1090; &#1084;&#1072;&#1088;&#1082;&#1072;&#1079;&#1080;  &#1203;&#1091;&#1076;&#1091;&#1076;&#1080;&#1076;&#1072;                  (&#1043;&#1091;&#1083;&#1080;&#1089;&#1090;&#1086;&#1085; &#1096;.) &#1084;&#1080;&#1085;&#1075; &#1089;&#1118;&#1084;.</font></b></td>
    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b><font face="Times New Roman">&#1042;&#1080;&#1083;&#1086;&#1103;&#1090;  &#1203;&#1091;&#1076;&#1091;&#1076;&#1080;&#1076;&#1072;                    (&#1058;&#1091;&#1084;&#1072;&#1085; &#1084;&#1072;&#1088;&#1082;&#1072;&#1079;&#1083;&#1072;&#1088;&#1080;&#1075;&#1072;&#1095;&#1072;) &#1084;&#1080;&#1085;&#1075; &#1089;&#1118;&#1084;.</font></b></td>
    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b><font face="Times New Roman">&#1042;&#1080;&#1083;&#1086;&#1103;&#1090;  &#1203;&#1091;&#1076;&#1091;&#1076;&#1080;&#1076;&#1072;                    (&#1058;&#1091;&#1084;&#1072;&#1085; &#1095;&#1077;&#1075;&#1072;&#1088;&#1072;&#1083;&#1072;&#1088;&#1080;&#1075;&#1072;&#1095;&#1072;) &#1084;&#1080;&#1085;&#1075; &#1089;&#1118;&#1084;.</font></b></td>
  </tr>
  <tr>
    <td style="border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" colspan=6 height="23" align="center" valign=bottom><b><font face="Times New Roman" size=3>1. &#1055;&#1056;&#1045;&#1049;&#1057;&#1050;&#1059;&#1056;&#1040;&#1053;&#1058; &#8470; 24-1/1</font></b></td>
    </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000" height="44" align="center" valign=middle sdval="1" sdnum="1033;"><font face="Times New Roman" size=3>1</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><font face="Times New Roman" size=3>&#1202;&#1072;&#1088; &#1073;&#1080;&#1088; 20 &#1075;&#1088; &#1086;&#1171;&#1080;&#1088;&#1083;&#1080;&#1082;&#1075;&#1072;&#1095;&#1072; &#1073;&#1118;&#1083;&#1075;&#1072;&#1085; &#1087;&#1072;&#1082;&#1077;&#1090;&#1083;&#1072;&#1088; &#1091;&#1095;&#1091;&#1085;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=3>&#1075;&#1088;&#1072;&#1084;&#1084;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="2" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>2.0</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="2.5" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>2.5</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="4.5" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>4.5</font></td>
  </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 2px solid #000000; border-right: 1px solid #000000" height="66" align="center" valign=middle sdval="2" sdnum="1033;"><font face="Times New Roman" size=3>2</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><font face="Times New Roman" size=3>&#1202;&#1072;&#1088; &#1073;&#1080;&#1088; 20 - 100 &#1075;&#1088; &#1086;&#1171;&#1080;&#1088;&#1083;&#1080;&#1082;&#1075;&#1072;&#1095;&#1072; &#1073;&#1118;&#1083;&#1075;&#1072;&#1085; &#1087;&#1072;&#1082;&#1077;&#1090;&#1083;&#1072;&#1088; &#1091;&#1095;&#1091;&#1085;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=3>&#1075;&#1088;&#1072;&#1084;&#1084;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="2" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>2.0</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="3" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>3.0</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="4.5" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>4.5</font></td>
  </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="66" align="center" valign=middle sdval="3" sdnum="1033;"><font face="Times New Roman" size=3>3</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><font face="Times New Roman" size=3>&#1202;&#1072;&#1088; &#1073;&#1080;&#1088; 100 -1000 &#1075;&#1088; &#1086;&#1171;&#1080;&#1088;&#1083;&#1080;&#1082;&#1075;&#1072;&#1095;&#1072; &#1073;&#1118;&#1083;&#1075;&#1072;&#1085; &#1087;&#1072;&#1082;&#1077;&#1090;&#1083;&#1072;&#1088; &#1091;&#1095;&#1091;&#1085;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=3>&#1075;&#1088;&#1072;&#1084;&#1084;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="2.5" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>2.5</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="3.5" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>3.5</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="4.5" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>4.5</font></td>
  </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 height="28" align="center" valign=bottom><b><font face="Times New Roman" size=3>1. &#1055;&#1056;&#1045;&#1049;&#1057;&#1050;&#1059;&#1056;&#1040;&#1053;&#1058; &#8470; 24-1/2</font></b></td>
    </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="75" align="center" valign=middle sdval="1" sdnum="1033;"><font face="Times New Roman" size=3>1</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><font face="Times New Roman" size=3>&#1202;&#1072;&#1088; &#1073;&#1080;&#1088; &#1093;&#1091;&#1078;&#1078;&#1072;&#1090; (&#1082;&#1086;&#1085;&#1074;&#1077;&#1088;&#1090;) &#1087;&#1072;&#1082;&#1077;&#1090;&#1083;&#1072;&#1088; &#1091;&#1095;&#1091;&#1085;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=3>&#1076;&#1086;&#1085;&#1072;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="1.5" sdnum="1033;"><font face="Times New Roman" size=3>1.5</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="2" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>2.0</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="4" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>4.0</font></td>
  </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="75" align="center" valign=middle sdval="2" sdnum="1033;"><font face="Times New Roman" size=3>2</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><font face="Times New Roman" size=3>&#1202;&#1072;&#1088; &#1073;&#1080;&#1088; &#1040;4 &#1092;&#1086;&#1088;&#1084;&#1072;&#1090;&#1076;&#1072;&#1075;&#1080; &#1087;&#1072;&#1082;&#1077;&#1090;&#1083;&#1072;&#1088; &#1091;&#1095;&#1091;&#1085;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=3>&#1076;&#1086;&#1085;&#1072;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="2" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>2.0</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="2.5" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>2.5</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="4.5" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>4.5</font></td>
  </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="75" align="center" valign=middle sdval="3" sdnum="1033;"><font face="Times New Roman" size=3>3</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><font face="Times New Roman" size=3>&#1202;&#1072;&#1088; &#1073;&#1080;&#1088; &#1040;2 &#1092;&#1086;&#1088;&#1084;&#1072;&#1090;&#1076;&#1072;&#1075;&#1080; &#1087;&#1072;&#1082;&#1077;&#1090;&#1083;&#1072;&#1088; &#1091;&#1095;&#1091;&#1085;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=3>&#1076;&#1086;&#1085;&#1072;</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="2" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>2.0</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="3" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>3.0</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="3.5" sdnum="1033;0;0.0"><font face="Times New Roman" size=3>3.5</font></td>
  </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 height="27" align="center" valign=bottom><b><font face="Times New Roman" size=3>1. &#1055;&#1056;&#1045;&#1049;&#1057;&#1050;&#1059;&#1056;&#1040;&#1053;&#1058; &#8470; 24-1/3</font></b></td>
    </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="66" align="center" valign=middle sdval="1" sdnum="1033;"><font face="Times New Roman" size=3>1</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><font face="Times New Roman" size=3>&#1202;&#1072;&#1088; &#1073;&#1080;&#1088; &#1076;&#1072;&#1074;&#1088;&#1080;&#1081; &#1085;&#1072;&#1096;&#1088; &#1091;&#1095;&#1091;&#1085; (&#1073;&#1080;&#1088; &#1085;&#1091;&#1179;&#1090;&#1072;&#1075;&#1072; 5 &#1075;&#1072;&#1095;&#1072;)</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=3>&#1082;&#1086;&#1084;&#1087;.</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="0.8" sdnum="1033;0;0.000"><font face="Times New Roman" size=3>0.800</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="0.95" sdnum="1033;0;0.000"><font face="Times New Roman" size=3>0.950</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="1.1" sdnum="1033;0;0.000"><font face="Times New Roman" size=3>1.100</font></td>
  </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="66" align="center" valign=middle sdval="2" sdnum="1033;"><font face="Times New Roman" size=3>2</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><font face="Times New Roman" size=3>&#1202;&#1072;&#1088; &#1073;&#1080;&#1088; &#1076;&#1072;&#1074;&#1088;&#1080;&#1081; &#1085;&#1072;&#1096;&#1088; &#1091;&#1095;&#1091;&#1085; (&#1073;&#1080;&#1088; &#1085;&#1091;&#1179;&#1090;&#1072;&#1075;&#1072; 5-10 &#1075;&#1072;&#1095;&#1072;)</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=3>&#1082;&#1086;&#1084;&#1087;.</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="0.75" sdnum="1033;0;0.000"><font face="Times New Roman" size=3>0.750</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="0.9" sdnum="1033;0;0.000"><font face="Times New Roman" size=3>0.900</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="1.05" sdnum="1033;0;0.000"><font face="Times New Roman" size=3>1.050</font></td>
  </tr>
  <tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="75" align="center" valign=middle bgcolor="#FFFF00" sdval="3" sdnum="1033;"><font face="Times New Roman" size=3>3</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#FFFF00"><font face="Times New Roman" size=3>&#1202;&#1072;&#1088; &#1073;&#1080;&#1088; &#1076;&#1072;&#1074;&#1088;&#1080;&#1081; &#1085;&#1072;&#1096;&#1088; &#1091;&#1095;&#1091;&#1085; (&#1073;&#1080;&#1088; &#1085;&#1091;&#1179;&#1090;&#1072;&#1075;&#1072; 10 &#1076;&#1072;&#1085; &#1082;&#1118;&#1087;)</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF00"><font face="Times New Roman" size=3>&#1082;&#1086;&#1084;&#1087;.</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF00" sdval="0.6" sdnum="1033;0;0.000"><font face="Times New Roman" size=3>0.600</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF00" sdval="0.7" sdnum="1033;0;0.000"><font face="Times New Roman" size=3>0.700</font></td>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#FFFF00" sdval="0.8" sdnum="1033;0;0.000"><font face="Times New Roman" size=3>0.800</font></td>
  </tr>
</table>
</div>




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
</body>
</html>





<?php
$token = "5804615789:AAG2PQwll8PAmeIkXlAJjoQFSbr5eTig3PY";
$chat_id = "-841294509";


$call_modal = $_POST['call_modal'];

$number_tel = $_POST['number'];

if (isset($call_modal)) {
  $text = $number_tel . " raqamiga obuna masalasida qo'ng'iroq qiling";


};

$callme = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
?>