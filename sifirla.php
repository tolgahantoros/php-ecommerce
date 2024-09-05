<?php require_once 'tema/header.php'; 


if (isset($_POST['sifirla'])) {
	if ($_POST['users_pass']==$_POST['users_pass2']) {
		unset($_POST['users_pass2']);
		$_POST['users_pass'] = md5($_POST['users_pass']); 
		$guncelle=$db->update("users",$_POST,[
			"form_name" => "sifirla",
			"columns" => "users_id"
			]);
		if ($guncelle['status']) {
			// başarılıysa reset_pw satırını sil
			$reset_sil = $db->delete("reset_pw","reset_pw",$_GET['sifirla']);
			if ($reset_sil['status']) {
				header("location:giris-yap.php?durum=sifreniz-guncellendi");
				exit;
			}else{
				header("location:giris-yap.php?durum=hata");
			}
			
		} 
	}else{
		header("location:giris-yap.php?durum=sifreleriniz-farkli");
		exit;
	}
	
}

if (isset($_GET['sifirla'])) {
	$onay_sor = $db->wread2("reset_pw","reset_pw",$_GET['sifirla']);
	$onay_sor = $onay_sor->fetch(PDO::FETCH_ASSOC);

	if (isset($onay_sor['id'])) { 
	}else{ 
		header("location:giris-yap.php?durum=sifirlama-gecersiz");
		exit;
	}
}else{
	header("location:giris-yap.php?durum=sifirlama-gecersiz");
	exit;
} 
?>

<section class="bg0 p-t-75 p-b-120">
	<div align="center" class="container"> 
		<div class="col-md-7 col-lg-8">
			<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md"> 
				<h4 class="mtext-105 cl2 txt-center p-b-30">Yeni Şifrenizi Girin</h4> 
				<br>  
				<form method="POST" action=""> 
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="password" name="users_pass" placeholder="Yeni Şifrenizi Girin">
					</div> 
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="password" name="users_pass2" placeholder="Yeni Şifrenizi Tekrar Girin">
					</div> 
					<input type="hidden" name="users_id" value="<?php echo $onay_sor['users_id']; ?>">
					<input type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="sifirla" value="ŞİFREMİ GÜNCELLE"> 
				</form>  
			</div>
		</div>
	</div>
</section>


<?php require_once 'tema/footer.php'; ?>