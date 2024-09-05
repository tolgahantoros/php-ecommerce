<?php   
error_reporting(E_ALL ^ E_WARNING);
ini_set('log_errors', 'On'); 
ini_set('display_errors', 'Off'); 
ini_set('error_reporting', E_ALL );
ob_start();
session_start(); 
setlocale(LC_TIME, 'tr_TR');  

require_once 'src/netting/class.crud.php';
require_once 'src/netting/mail.php';
$db = new crud();  
$mail = new mail();

// affiliate
if ($_GET['affiliate']) {
	require_once 'affiliate.php';
}

// arama
if (isset($_POST['search'])) {
	$aranan_kelimeler_arama_cubugu = explode(" ", $_POST['search']);
	$seo_link = $aranan_kelimeler_arama_cubugu[0];
	for ($i=1; $i < count($aranan_kelimeler_arama_cubugu) ; $i++) {  
		$seo_link = $seo_link."-ve-".$aranan_kelimeler_arama_cubugu[$i];
	}
	$seo_link = $db->seo($seo_link);
	header("location:$seo_link");
	exit;
}

$ayar_sor = $db->read("settings");
$ayar_cek = $ayar_sor->fetchAll(PDO::FETCH_ASSOC);

foreach ($ayar_cek as $key ) {
	$settings[$key['settings_key']]=$key['settings_value'];
} 


$urun = $db->wread("urun","urun_seourl",$_GET['urun']);  
$kategori = $db->wread("kategori","kategori_seourl",$_GET['kategori']);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../countdown/countdown.css">
	<!--===============================================================================================-->
	<script src="../vendor/sweetalert/sweetalert.min.js" type="text/javascript"></script>
</head>

<!-- body class="animsition" -->
<body class="animsition"> 

	<!-- Header -->
	<header class="header-v4">
		<?php 

		// mail onay
		if (isset($_GET['mail_onay'])) {
			$onay_sor = $db->wread2("users","users_mail_status",$_GET['mail_onay']);
			$onay_sor = $onay_sor->fetch(PDO::FETCH_ASSOC);

			if (isset($onay_sor['users_id'])) { 
				unset($_POST);
				$_POST['users_id'] = $onay_sor['users_id'];
				$_POST['users_mail_status'] = 1;
				$mail_onayla = $db->update("users",$_POST,[
					"columns" => "users_id"
					]);
				if ($mail_onayla['status']) {
					echo '<script type="text/javascript">swal("Mail Adresiniz Onaylandı!","Sisteme kayıtlı email adresiniz onaylandı.", "success",{button:"Tamam"}); </script>';
				}else{
					echo '<script type="text/javascript">swal("Mail Adresiniz Onaylanmadı!","Sisteme kayıtlı email adresiniz onaylanmadı. Lütfen bilgilerinizi kontrol edip site yönetimiyle iletişime geçin.", "error",{button:"Tamam"}); </script>';
				}
			}else{
				echo '<script type="text/javascript">swal("Mail Adresiniz Onaylanmadı!","Sisteme kayıtlı email adresiniz onaylanmadı. Lütfen bilgilerinizi kontrol edip site yönetimiyle iletişime geçin.", "error",{button:"Tamam"}); </script>';
			}
			unset($_POST);
		} 
		?>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						<?php 
						$sol_taraf = $db->wread("tema_header_ustu","ad","sol");
						echo $sol_taraf['baslik'];
						?>
					</div>

					<div class="right-top-bar flex-w h-full">
						<?php 
						$sag_taraf = $db->wread2("tema_header_ustu","ad","sag");
						$say=0;
						while ($sag_taraf_cek=$sag_taraf->fetch(PDO::FETCH_ASSOC)) { 
							$header_ustu_butonlar[$say] = $sag_taraf_cek;
							$say++;
							?> 
							<a href="../<?php echo $sag_taraf_cek['url'] ?>" class="flex-c-m trans-04 p-lr-25">
								<?php echo $sag_taraf_cek['baslik'] ?>
							</a> 
							<?php } 

							if (empty($_SESSION['users']['users_id'])) {
								?>
								<a href="giris-yap.php" class="flex-c-m trans-04 p-lr-25">
									Giriş Yap
								</a>
								<a href="uye-ol.php" class="flex-c-m trans-04 p-lr-25">
									Üye Ol
								</a>
								<?php 
							}else{  ?>
							<a href="profil.php" class="flex-c-m trans-04 p-lr-25">
								Hesabım
							</a>
							<a href="cikis.php" class="flex-c-m trans-04 p-lr-25">
							Çıkış
							</a>
							<?php } ?> 
						</a>

					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->		
					<a href="../#" class="logo">
						<img src="../src/dimg/settings/<?php echo $settings['logo'] ?>" alt="">
					</a>

					<!-- Menu desktop -->
					<?php require_once 'pcmenu.php'; ?>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo count($_COOKIE['siteurlmiz']) ?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<a href="../<?php if (empty($_SESSION['users']['users_id'])) {
							echo "giris-yap";
						}else{
							echo "profil";
						} 
						?>" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
						<i class="zmdi zmdi-account-circle"></i>
					</a>
				</div>
			</nav>
		</div>	
	</div>

	<!-- Header Mobile -->
	<div class="wrap-header-mobile">
		<!-- Logo moblie -->		
		<div class="logo-mobile">
			<a href="../index.html"><img src="../src/dimg/settings/<?php echo $settings['logo'] ?>" alt=""></a>
		</div>

		<!-- Icon header -->
		<div class="wrap-icon-header flex-w flex-r-m m-r-15">
			<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
				<i class="zmdi zmdi-search"></i>
			</div>

			<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo count($_COOKIE['siteurlmiz']) ?>">
				<i class="zmdi zmdi-shopping-cart"></i>
			</div>

			<a href="../<?php if (empty($_SESSION['users']['users_id'])) {
				echo "giris-yap";
			}else{
				echo "profil";
			} 
			?>" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
			<i class="zmdi zmdi-account-circle"></i>
		</a>
	</div>

	<!-- Button show menu -->
	<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
		<span class="hamburger-box">
			<span class="hamburger-inner"></span>
		</span>
	</div>
</div>


<!-- Menu Mobile -->
<?php require_once 'mobilmenu.php'; ?>

<!-- Modal Search -->
<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
	<div class="container-search-header">
		<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
			<img src="../images/icons/icon-close2.png" alt="CLOSE">
		</button>

		<form method="POST" action="shop.php" class="wrap-search-header flex-w p-l-15">
			<button class="flex-c-m trans-04">
				<i class="zmdi zmdi-search"></i>
			</button>
			<input class="plh3" type="text" name="search" placeholder="Ara...">
		</form>
	</div>
</div>
</header>


<!-- Sepet -->
<div class="wrap-header-cart js-panel-cart">
	<div class="s-full js-hide-cart"></div>

	<div class="header-cart flex-col-l p-l-65 p-r-25">
		<div class="header-cart-title flex-w flex-sb-m p-b-8">
			<span class="mtext-103 cl2">
				SEPETİNİZ
			</span>

			<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
				<i class="zmdi zmdi-close"></i>
			</div>
		</div>

		<div class="header-cart-content flex-w js-pscroll">
			<ul class="header-cart-wrapitem w-full">
				<?php 
				$sql_kodu = "SELECT * FROM urun WHERE ";
				$urun_idler = array_keys($_COOKIE['siteurlmiz']);
				for ($i=0; $i < count($urun_idler); $i++) { 
					$sql_kodu = $sql_kodu."urun_id=".$urun_idler[$i];
					if (count($urun_idler)==$i+1) {
						break;
					}else{
						$sql_kodu = $sql_kodu." OR ";
					}
				}
				$sepet_sor = $db->qSql2($sql_kodu); 
				$sepet_toplam = 0;
				$indirimsiz_urunler_toplami=0;
				$indirimli_urunler_toplami=0;
				$sayac = 0;
				while ($sepet=$sepet_sor->fetch(PDO::FETCH_ASSOC)) {
					$sayac++; 
					if ($sepet['urun_indirim']==0) {
						$sepet_toplam = $sepet_toplam + $_COOKIE['siteurlmiz'][$sepet['urun_id']]*$sepet['urun_fiyat'];
						$indirimsiz_urunler_toplami = $indirimsiz_urunler_toplami + $sepet['urun_fiyat']*$_COOKIE['siteurlmiz'][$sepet['urun_id']];
					}else{
						$sepet_toplam = $sepet_toplam + $_COOKIE['siteurlmiz'][$sepet['urun_id']]*$sepet['urun_fiyat']*(100-$sepet['urun_indirim'])/100;
						$indirimli_urunler_toplami = $indirimli_urunler_toplami +$_COOKIE['siteurlmiz'][$sepet['urun_id']]*$sepet['urun_fiyat']*(100-$sepet['urun_indirim'])/100;
					} 
					$sepet_kategori = $db->wread("kategori","kategori_id",$sepet['kategori_id']); 
					?>
					<li class="header-cart-item flex-w flex-t m-b-12">
						<a href="../<?php echo $sepet_kategori['kategori_seourl'] ?>/<?php echo $sepet['urun_seourl'] ?>">
							<div class="header-cart-item-img">
								<img src="../src/dimg/urun/<?php echo $sepet['urun_file'] ?>" alt="<?php echo $sepet['urun_ad'] ?>">
							</div>
						</a>
						<div class="header-cart-item-txt p-t-8">
							<a href="../<?php echo $sepet_kategori['kategori_seourl'] ?>/<?php echo $sepet['urun_seourl'] ?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?php echo $sepet['urun_ad']; ?>
							</a>

							<span class="header-cart-item-info">
								<?php echo $_COOKIE['siteurlmiz'][$sepet['urun_id']]; ?> x ₺<?php echo $sepet['urun_fiyat']; ?>
							</span>
						</div>
					</li> 
					<?php }
					if ($sayac==0) {
						?>  
						<div class="flex-w flex-m m-r-20 m-tb-5">
							<h2 class="swal-title">Sepetiniz Boş. Hadi! Hemen</h2>
							
							<button class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-10 trans-04 pointer m-tb-5" type="submit" name="alisverise-basla">
								<a href='shop.php'>ALIŞVERİŞE BAŞLA</a>
							</button>
							
						</div> 
						<?php
					}
					?>
				</ul>

				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						<?php  
						// Sepet döngüsünde indirimli ve indirimsiz ürünlerin fiyatlarını topladık.
						// Ve indirim koşuluna göre sepetteki kupon indirimini yaptık.
						if ($sepet_toplam>=$_COOKIE['siteurlmizkupon']['indirim_kosulu'] AND date()<$_COOKIE['siteurlmizkupon']['kupon_sontarih'] AND $_COOKIE['siteurlmizkupon']['indirim_kosulu2']==1) { 
							$indirimli_toplam = ($indirimsiz_urunler_toplami+$indirimli_urunler_toplami)*(100-$_COOKIE['siteurlmizkupon']['indirim_orani'])/100;
							echo "Toplam : ".$indirimli_toplam;
						}elseif ($sepet_toplam>=$_COOKIE['siteurlmizkupon']['indirim_kosulu'] AND date()<$_COOKIE['siteurlmizkupon']['kupon_sontarih'] AND $_COOKIE['siteurlmizkupon']['indirim_kosulu2']==0) {
							$indirimli_toplam = $indirimli_urunler_toplami+$indirimsiz_urunler_toplami*(100-$_COOKIE['siteurlmizkupon']['indirim_orani'])/100;
							echo "Toplam : ".$indirimli_toplam;
						} 
						?>
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="../sepet" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							SEPETE GİT
						</a>

						<a href="../odeme" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							SEPETİ ONAYLA
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>