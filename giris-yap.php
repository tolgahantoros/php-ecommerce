<?php require_once 'tema/header.php'; ?> 
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		Hoş Geldiniz
	</h2>
</section>	

<?php 
if (isset($_POST['girisyap'])) {
	$sonuc = $db->usersLogin(htmlspecialchars($_POST['users_mail']),htmlspecialchars($_POST['users_pass']));
	if ($sonuc['status']) {
		// DB'de sepeti var ise şuanki çerezleri silinecek
		$sepet_sor = $db->wread2("sepet","users_id",$_SESSION['users']['users_id']);
		$sepet_sor = $sepet_sor->fetch(PDO::FETCH_ASSOC);
		if (!empty($sepet_sor['id'])) {
			// Sepetteki çerezleri boşalt daha sonra DB deki ürünleri çereze at
			if (isset($_COOKIE['siteurlmiz'])) {
				require_once 'sepet-bosalt.php';
			}
			
			$sepet_decode = json_decode(htmlspecialchars_decode($sepet_sor['urunler_id']));
			foreach ($sepet_decode as $key => $value) {
				setcookie("siteurlmiz[".$key."]",$value,strtotime('+2 day'));
			} 
		}  
		header("location:index.php?durum=giris-basarili");
		exit;
	}else{
		header("location:giris-yap?durum=giris-basarisiz");
		exit;
	}
}

if ($_GET['durum']=="sifreniz-guncellendi") {
	echo '<script type="text/javascript">swal("Şifreniz Güncellendi!","Şifreniz güncellendi. Yeni şifreniz ile sisteme giriş yapabilirsiniz.", "success",{button:"Tamam"}); </script>';
}

if ($_GET['durum']=="hata" OR $_GET['durum']=="sifirlama-gecersiz") {
	echo '<script type="text/javascript">swal("Şifreniz Güncellenemedi!","İşlemi tekrar deneyin veya site yönetimiyle iletişime geçin.", "error",{button:"Tamam"}); </script>';
}


if ($_GET['durum']=="sifreleriniz-farkli") {
	echo '<script type="text/javascript">swal("Şifreler uyuşmuyor!","Girdiğiniz yeni şifreler birbirine uyuşmuyor lütfen tekrar deneyin.", "error",{button:"Tamam"}); </script>';
}

if ($_GET['durum']=="kupon-icin-giris-yapin") {
	echo '<script type="text/javascript">swal("Giriş Yapmalısınız!","Kupon kodu kullanmak için giriş yapmış olmalısınız.", "error",{button:"Tamam"}); </script>';
}

if ($_GET['durum']=="uye-oldunuz") {
	echo '<script type="text/javascript">swal("Aramıza Hoş Geldiniz!","Üyeliğinizi oluşturduk. Sisteme bilgilerinizle giriş yapabilirsiniz.", "success",{button:"Tamam"}); </script>';
}

?>

<section class="bg0 p-t-75 p-b-120">
	<div align="center" class="container"> 
		<div class="col-md-7 col-lg-8">
			<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md"> 
				<h4 class="mtext-105 cl2 txt-center p-b-30">
					<a href="giris-yap.php"><button>GİRİŞ YAP</button></a>
					<span> / </span>
					<a href="uye-ol.php"><button>ÜYE OL</button></a>
				</h4>
				<form method="POST" action="">
					<?php 
					if ($_GET['basari']=="uye-oldunuz") {
						echo '<script type="text/javascript">swal("Hoş Geldiniz!","Hesabınız oluşturuldu giriş yapabilirsiniz. Lütfen eposta adresinize gönderdiğimiz bağlantıyı onaylayın.", "success",{button:"Tamam"});
					</script>';
				}
				?>
				<div class="bor8 m-b-20 how-pos4-parent">
					<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="email" name="users_mail" placeholder="Mail Adresiniz">
				</div>
				<div class="bor8 m-b-20 how-pos4-parent">
					<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="password" name="users_pass" placeholder="Şifreniz">
				</div>
				<div align="right" class="plh3 size-116 p-l-12 p-r-30">
					<a href="sifremi-unuttum.php">Şifremi Unuttum</a>
				</div>
				<input type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="girisyap" value="GİRİŞ YAP"> 
			</form>  
		</div>
	</div>
</div>
</section>


<?php require_once 'tema/footer.php'; ?>