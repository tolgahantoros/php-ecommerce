<?php require_once 'tema/header.php'; ?> 
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		Hoş Geldiniz
	</h2>
</section>	

<?php 
 

//şifre unutma işlemi
$uyeler = $db->wread2("users","users_mail",$_POST['users_mail']);
$uyeler = $uyeler->fetch(PDO::FETCH_ASSOC);

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
				<h4>Şifrenizi unuttuysanız sisteme kayıtlı eposta adresinizi girin size şifreninizi sıfırlama bağlantısı göndereceğiz.</h4>
				<br>
				<?php 
				if (isset($_POST['sifremi_unuttum'])) { 
					$uyeler = $db->wread2("users","users_mail",$_POST['users_mail']);
					$uyeler = $uyeler->fetch(PDO::FETCH_ASSOC);

					if (empty($uyeler)) {
						echo "<h4>Girdiğiniz eposta adresi sisteme kayıtlı değil. Lütfen Başka eposta adresinizi girin.</h4><br>";
					}else{

						// daha önceden sıfırlama isteği yapmışsa yeniden kod yazmaya ve insert etmeye gerek yok eski kodu mail olarak gönder.
						$kod_var_mi = $db->wread2("reset_pw","users_id",$uyeler['users_id']);
						$kod_var_mi = $kod_var_mi->fetch(PDO::FETCH_ASSOC);

						if (empty($kod_var_mi['id'])) { 
							function kod_olustur($length = 10) {
								return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
							}



							unset($_POST);  


							while (true) {
								$kod_olustur = kod_olustur(255);
								$kod_onay = $db->wread2("reset_pw","reset_pw",$kod_olustur);
								$kod_onay = $kod_onay->fetch(PDO::FETCH_ASSOC);
								if (empty($kod_onay['id'])) {
									$_POST['reset_pw'] = $kod_olustur; // kod yok ise oluştur var ise yeni kod oluştur	 
									break;
								}
							}
 
							$_POST['users_id'] = $uyeler['users_id'];
							$reset_pw = $db->insert("reset_pw",$_POST); 
							if ($reset_pw['status']) {
							// mail gönder
								$icerik = 'Merhabalar '.$uyeler['users_namesurname'].'<br> Şifrenizi sıfırlamak için <a href="eticaret.altingrami.net/sifirla.php?sifirla='.$_POST['reset_pw'].'"">Buraya Tıklayın</a>';
								$mail->mail_gonder($uyeler['users_mail'],"Şifrenizi Sıfırlayın",$icerik);
								echo "<h4>".$uyeler['users_mail']." adresinize şifre sıfırlama bağlantısı gönderildi.</h4><br>";
								unset($_POST); 
							}else{
								echo "Hata. Tekrar deneyin veya site yönetimiyle iletişime geçin.";
								unset($_POST); 
							}
						}else{  
							$icerik = 'Merhabalar '.$uyeler['users_namesurname'].'<br> Şifrenizi sıfırlamak için <a href="eticaret.altingrami.net/sifirla.php?sifirla='.$kod_var_mi['reset_pw'].'"">Buraya Tıklayın</a>';
							$mail->mail_gonder($uyeler['users_mail'],"Şifrenizi Sıfırlayın",$icerik);
							echo "<h4>".$uyeler['users_mail']." adresinize şifre sıfırlama bağlantısı gönderildi.</h4><br>";
						} 

					}
				}
				?>
				<form method="POST" action="">
					<?php 
					if ($_GET['basari']=="uye-oldunuz") {
						echo "<b>Tebrikler, başarıyla üye oldunuz. Giriş yapınız.</b><br><br>";
					}
					?>
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="email" name="users_mail" placeholder="Kayıtlı Email Adresiniz">
					</div> 
					<input type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="sifremi_unuttum" value="ŞİFREMİ UNUTTUM"> 
				</form>  
			</div>
		</div>
	</div>
</section>

<?php require_once 'tema/footer.php'; ?>