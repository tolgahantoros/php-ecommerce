<?php 
session_start();
require_once '../netting/class.crud.php';
if (isset($_SESSION['admins'])) {
    header("Location:index.php");
}
$db=new crud();
?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    
    <title>Meü Ceng Admin</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
        style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
        <div class="auth-box row">
            <div align="center" class="col-lg-12 col-md-12 bg-white">
                <div class="p-3">
                    <div class="text-center">
                        <img src="../assets/images/big/icon.png" alt="wrapkit">
                    </div>
                    <h2 class="mt-3 text-center">Giriş Yap</h2>
                    <p class="text-center">Kullanıcı adınız ve şifreniz ile giriş yapın.</p>
                <?php
                if (isset($_POST['admins_Login'])) {
                    $sonuc = $db->adminsLogin(htmlspecialchars($_POST['admins_username']),htmlspecialchars($_POST['admins_pass']));
                    if ($sonuc['status']) {
                        header("Location:index.php");
                        exit;
                    }else{
                        ?> 
                        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                        role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>HATA - </strong> Bilgilerinizi Kontrol Edin. Lütfen Tekrar deneyin.
                    </div>
                    <?php
                }
            }
            ?>
            <form action="" method="POST" class="mt-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="uname">Kullanıcı adı</label>
                            <input class="form-control" name="admins_username" id="uname" type="text"
                            placeholder="Kullanıcı Adınız">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="pwd">Şifre</label>
                            <input class="form-control" name="admins_pass" id="pwd" type="password"
                            placeholder="Şifreniz">
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" name="admins_Login" class="btn btn-block btn-dark">Giriş Yap</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- ============================================================== -->
<!-- Login box.scss -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="../assets/libs/jquery/dist/jquery.min.js "></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/libs/popper.js/dist/umd/popper.min.js "></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    $(".preloader ").fadeOut();
</script>
</body>

</html>