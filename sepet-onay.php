<?php require_once 'tema/header.php'; ?> 
<section class="bg0 p-t-75 p-b-120">
	<div align="center" class="container">  
		<?php if (!isset($_POST['sepet_toplam'])) {
			header("location:sepet");
			exit;
		} ?>
		<form method="POST" action="odeme"> 
			<label>Teslim Alıcı Adı</label>
			<div class="col-md-7 col-lg-8 bor8 m-b-20 how-pos4-parent">
				<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="text" name="users_name" placeholder="Adınız"> 
			</div> 

			<label>Teslim Alıcı Soyadı</label>
			<div class="col-md-7 col-lg-8 bor8 m-b-20 how-pos4-parent">
				<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="text" name="users_surname" placeholder="Soyadınız"> 
			</div> 

			<label>Sipariş Adresi</label>
			<div class="col-md-7 col-lg-8 bor8 m-b-20 how-pos4-parent"> 
				<textarea row="50" class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" name="siparis_adres" placeholder="Sipariş adresini girin."></textarea> 
			</div> 
			<input type="hidden" name="indirim_miktari" value="<?php echo $_POST['indirim_miktari'] ?>">
			<input type="hidden" name="sepet_toplam" value="<?php echo $_POST['sepet_toplam']; ?>">
			<input type="hidden" name="ip_adresi" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
			<div class="col-md-7 col-lg-8 bor8 m-b-20 how-pos4-parent"> 
				<input type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="ode" value="ÖDEME YAP"> 
			</div>
		</form>  
		
	</div>
</section>
<?php require_once 'tema/footer.php'; ?> 