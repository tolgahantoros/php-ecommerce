<?php require_once 'tema/header.php'; ?> 


<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		Bize Ulaşın
	</h2>
</section>	

<?php 
if (isset($_POST['mesajgonder'])) {
	$mesajekle = $db->insert("mesajlar",$_POST,[
		"form_name" => "mesajgonder"
		]);
	if ($mesajekle['status']) {
		?> 
		<script type="text/javascript">swal("Mesajınız Gönderildi!","Merhabalar <?php echo $_POST['mesaj_adsoyad'] ?>. Mesajınızı aldık ve en kısa sürede size geri dönüş yapacağız. Bizimle iletişime geçtiğiniz için teşekkür ederiz.", "error",{button:"Tamam"});
		</script>
		<?php
	}else{?>
	<script type="text/javascript">swal("Mesajınız Gönderilemedi!","Merhabalar, mesajınız gönderilirken bir sorun oluştu lütfen yan taraftaki iletişim bilgilerinden bize ulaşın.", "error",{button:"Tamam"});
	</script>
	<? }
} 
?>
<!-- İçerik Sayfası -->
<section class="bg0 p-t-104 p-b-116">
	<div class="container">
		<div class="flex-w flex-tr">

			<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
				<form method="POST" action="">
					<h4 class="mtext-105 cl2 txt-center p-b-30">
						Bize mesaj bırakın.
					</h4>
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="text" name="mesaj_adsoyad" placeholder="Ad ve Soyadınız">
					</div>
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="email" name="mesaj_email" placeholder="Email Adresiniz"> 
					</div>
					<div class="bor8 m-b-20 how-pos4-parent">
						<input class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30" type="text" name="mesaj_telefon" placeholder="Telefon Numaranız">
					</div> 
					<div class="bor8 m-b-30">
						<textarea class="stext-111 cl2 plh3 size-120 p-lr-12 p-tb-25" name="mesaj_icerik" placeholder="Size nasıl yardımcı olabiliriz?"></textarea>
					</div>
					<input type="hidden" name="mesaj_ip" value="<?php echo $_SERVER['REMOTE_ADDR'] ?>">
					<input type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="mesajgonder" value="Gönder"> 
				</form>
			</div>
			<?php 
			$adressor = $db->read("settings");
			$adrescek = $adressor->fetchAll(PDO::FETCH_ASSOC);  
			foreach ($adrescek as $key ) {
				$settings[$key['settings_key']]=$key['settings_value'];
			}
			?>
			<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
				<div class="flex-w w-full p-b-42">
					<span class="fs-18 cl5 txt-center size-211">
						<span class="lnr lnr-map-marker"></span>
					</span>

					<div class="size-212 p-t-2">
						<span class="mtext-110 cl2">
							Adres
						</span>

						<p class="stext-115 cl6 size-213 p-t-18">
							<?php 
							echo $settings['adres']." ".$settings['ilce']."/".$settings['il'];
							?>
						</p>
					</div>
				</div>

				<div class="flex-w w-full p-b-42">
					<span class="fs-18 cl5 txt-center size-211">
						<span class="lnr lnr-phone-handset"></span>
					</span>

					<div class="size-212 p-t-2">
						<span class="mtext-110 cl2">
							Telefon
						</span>

						<p class="stext-115 cl1 size-213 p-t-18">
							<?php echo $settings['phone'] ?>
						</p>
					</div>
				</div>

				<div class="flex-w w-full">
					<span class="fs-18 cl5 txt-center size-211">
						<span class="lnr lnr-envelope"></span>
					</span>

					<div class="size-212 p-t-2">
						<span class="mtext-110 cl2">
							Satış Desteği
						</span>

						<p class="stext-115 cl1 size-213 p-t-18">
							<?php echo $settings['email'] ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	 


<?php require_once 'tema/footer.php'; ?>