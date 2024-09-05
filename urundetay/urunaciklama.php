<?php 

if ($_GET['durum']=="sepete-eklendi") { ?> 
<script type="text/javascript">swal("Ürün Sepetinize Eklendi!","<?php echo $urun['urun_ad']?> isimli ürün sepetinize başarıyla eklendi. Siparişinizi sepetinizden onaylayabilirsiniz.", "success",{button:"Tamam"});
</script>
<?php  }elseif ($_GET['durum']=="yetersiz-stok") { ?> 
<script type="text/javascript">swal("Tüm stoğu sepetinize eklediniz.!","<?php echo $urun['urun_ad']?> isimli ürünün tüm stoğunu sepetinize eklediniz. Şimdi sepetinize gidip siparişinizi onaylamanız gerekiyor.", "error",{button:"Tamam"});
</script>
<?php } ?>
<div class="col-md-6 col-lg-5 p-b-30">
	<div class="p-r-50 p-t-5 p-lr-0-lg">
		<h1 class="mtext-105 cl2 js-name-detail p-b-14">
			<?php
			if (empty($urun['urun_ad'])) { 
				header("location:http://localhost/scriptpanel/shop?durum=urun-bulunamadi");
				exit;
			} 
			echo $urun['urun_ad']; ?>
		</h1>

		<span class="mtext-106 cl2">
			<?php 
			if ($urun['urun_indirim']==0) {
				echo $urun['urun_fiyat'];
			}else{
				echo "<strike>".$urun['urun_fiyat']." ₺ </strike><br> İndirimli Fırsatıyla ";
				$indirimli_fiyat = $urun['urun_fiyat']-$urun['urun_fiyat']*$urun['urun_indirim']/100;
				echo $indirimli_fiyat;
			} 
			?> ₺
		</span>

		<p class="stext-102 cl3 p-t-23"> 
			<?php echo htmlspecialchars_decode($urun['urun_detay']);?> 
		</p>
		<div class="stext-102 cl3 p-t-23 cl8 trans-04 flex-c-m">
			STOK ADETİ : <?php echo $urun['urun_stok']; ?>
		</div> 
		<form method="post" action="../sepete-ekle.php">
			<div class="p-t-33"> 
				<div class="flex-w flex-r-m p-b-10">
					<div class="size-204 flex-w flex-m respon6-next">
						<div class="wrap-num-product flex-w m-r-20 m-tb-10">

							<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
								<i class="fs-16 zmdi zmdi-minus"></i>
							</div> 
							

							<input class="mtext-104 cl3 txt-center num-product" type="number" required="" name="adet" min="1" max="<?php echo $urun['urun_stok'] ?>" value="1"> 

							<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
								<i class="fs-16 zmdi zmdi-plus"></i>
							</div>
						</div>
						<input type="hidden" name="urun_id" value="<?php echo $urun['urun_id'] ?>">
						<input type="hidden" name="url" value="<?php echo $kategori['kategori_seourl']."/".$urun['urun_seourl'] ?>">
						<button name="sepete-ekle" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
							Sepete Ekle
						</button>
					</div>
				</div>	
			</div>
		</form>
		<!--  -->
		<div class="flex-w flex-m p-l-100 p-t-40 respon7"> 

			<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
				<i class="fa fa-facebook"></i>
			</a>

			<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
				<i class="fa fa-twitter"></i>
			</a>

			<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
				<i class="fa fa-google-plus"></i>
			</a>
		</div>
	</div>
</div>