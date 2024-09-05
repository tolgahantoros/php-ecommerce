<?php require_once 'tema/header.php'; ?> 
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		Aramıza Katılın
	</h2>
</section>	
<?php
if (isset($_POST['uyeol'])) {
	function kod_olustur($length = 10) {
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}

	

	while (true) {
		$mail_onay = kod_olustur(255);
		$kod_onay = $db->wread2("users","users_mail_status",$mail_onay);
		$kod_onay = $kod_onay->fetch(PDO::FETCH_ASSOC);
		if (empty($kod_onay['users_id'])) {
			$_POST['users_mail_status'] = $mail_onay; // db ye eklenecek mail onay değeri
			break;
		}
	}




	$uyeol = $db->insert("users",$_POST,[
		"form_name" => "uyeol",
		"pass" => "users_pass"
		]);
	if ($uyeol['status']==TRUE AND $uyeol['error'][0]=="00000") {
		// mail gönder
		$icerik = 'Merhabalar. Mail adresinizi onaylamak için <a href="eticaret.altingrami.net?mail_onay='.$_POST["users_mail_status"].'">Buraya Tıklayın</a>';
		$mail_gonder = $mail->mail_gonder($_POST['users_mail'],"Mail Onayı",$icerik);
		header("location:giris-yap?durum=uye-oldunuz");
		exit;
	}else{
		$hata_durum = 1;
	}
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
					<?php if ($hata_durum==1) { ?>

					<p>HATA! BU MAİL VE TELEFON NUMARASINA KAYITLI ÜYE VAR. LÜTFEN YENİDEN DENEYİN.</p>

					<?php } ?>

				</h4>
				<form method="POST" action="">
					
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-10" type="text" name="users_namesurname" placeholder="Ad Soyadınız">
					</div>
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="email" name="users_mail" placeholder="Mail Adresiniz">
					</div>
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" id="phone-input" type="tel" value="" name="users_phone" aria-label="Lütfen telefon numaranızı girin." placeholder="Örnek : 0(555)-555-5555">
					</div>
					<div class="bor8 m-b-20 how-pos4-parent">
						<select name="users_gender" class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30">
							<option value="kadin">Kadın</option>
							<option value="erkek">Erkek</option>
							<option value="unisex">Belirtmek İstemiyorum</option>
						</select>
					</div>
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="password" name="users_pass" placeholder="Şifreniz">
					</div>
					<div class="bor8 m-b-20 how-pos4-parent">
						<label for="checkbox">Üyelik Sözleşmesini kabul ediyorum.</label>
						<input required="" type="checkbox" id="checkbox">
					</div>
					<input type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="uyeol" value="ÜYE OL"> 
				</form>  
			</div>
		</div>
	</div>
</section>

<?php require_once 'tema/footer.php'; ?>
<script type="text/javascript">
	function users_phone() { 
		var num = $(this).val().replace(/\D/g,''); 
		$(this).val(num.substring(0,1) + '(' + num.substring(1,4) + ')-' + num.substring(4,7) + '-' + num.substring(7,11)); 
	}
	$('[type="tel"]').keyup(users_phone);
</script>