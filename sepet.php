<?php require_once 'tema/header.php'; ?>

<?php 

if ($_GET['durum']=="sepete-eklendi") {
	echo '<script type="text/javascript">swal("Ürün Sepetinize Eklendi!","Ürün sepetinize başarıyla eklendi. Siparişinizi sepetinizden onaylayabilirsiniz.", "success",{button:"Tamam"});
</script>';
}elseif ($_GET['durum']=="urun-cikarildi") {
	echo '<script type="text/javascript">swal("Ürün Sepetinizden Çıkarıldı!","Ürün sepetinizden çıkarıldı.", "success",{button:"Tamam"});
</script>';
}elseif ($_GET['durum']=="guncelleme-basarili"){
	echo '<script type="text/javascript">swal("Sepetiniz Güncellendi!","Sepetiniz başarıyla güncellendi.", "success",{button:"Tamam"});
</script>';
}elseif ($_GET['kupon_kodu']=="kod-sayisi-tukendi"){
	echo '<script type="text/javascript">swal("Bu Kupon Kodu Tükendi!","Girdiğiniz kupon kodunun stoğu malesef tükenmiştir. Lütfen başka bir kod girin.", "error",{button:"Tamam"});
</script>';
}
elseif ($_GET['kupon_kodu']=="bir-kod-kullaniyorsunuz"){
	echo '<script type="text/javascript">swal("Şuan zaten bir kod kullanıyorsunuz!","Şuan sepetinize tanımlı zaten tanımlı olan bir kupon kodu kullanıyorsunuz. Aynı anda 1 den fazla kupon kodu kullanamazsınız", "error",{button:"Tamam"});
</script>';
}elseif ($_GET['kupon_kodu']=="kod-bulunamadi"){
	echo '<script type="text/javascript">swal("Kod bulunamadı!","Girdiğiniz kupon kodu kullanılabilir değil. Başka kodunuz var ise lütfen girin.", "error",{button:"Tamam"});
</script>';
}elseif ($_GET['kupon_kodu']=="kod-uygulandi"){
	echo '<script type="text/javascript">swal("Şimdi Satın Alma Zamanı!","Girdiğiniz kupon kodu sepetinize tanımlandı. Hadi hemen kuponun süresi dolmadan sepetinizi onaylayın!", "success",{button:"Tamam"});
</script>';
}
elseif ($_GET['durum']=="odeme_basarisiz"){
	echo '<script type="text/javascript">swal("Ödeme İşlemi Başarısız!","Ödeme işlemi başarısız. Lütfen bilgilerinizi kontrol edip tekrar deneyin.", "error",{button:"Tamam"});
</script>';
}




?>

<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="#" class="stext-109 cl8 hov-cl1 trans-04">
			Ana sayfa
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>
		<a href="shop.php" class="stext-109 cl8 hov-cl1 trans-04">
			Alışveriş
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			Sepet
		</span>
	</div>
</div>

<!-- Shoping Cart -->
<div class="bg0 p-t-75 p-b-85">
	<div class="container">
		<div class="row">  
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<form method="POST" action="sepete-ekle.php">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">ÜRÜN</th>
									<th class="column-2"></th>
									<th class="column-3">FİYAT</th>
									<th class="column-4">Adet</th> 
									<th class="column-5">Toplam</th>
									<th class="column-6">SİL</th>
									<th class="column-7">&emsp;</th>
								</tr>

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
								$aratoplam=0;
								while ($sepet=$sepet_sor->fetch(PDO::FETCH_ASSOC)) { 
									$aratoplam += $sepet['urun_fiyat']*$_COOKIE['siteurlmiz'][$sepet['urun_id']];
									?>
									<tr class="table_row">
										<td class="column-1">
											<a href="<?php echo $sepet_kategori['kategori_seourl'] ?>/<?php echo $sepet['urun_seourl'] ?>">
												<div class="how-itemcart1">
													<img src="src/dimg/urun/<?php echo $sepet['urun_file']; ?>" alt="<?php echo $sepet['urun_ad'] ?>">
												</div>
											</a>
										</td>
										<td class="column-2"><?php echo $sepet['urun_ad'] ?></td>
										<td class="column-3"><?php 
											if ($sepet['urun_indirim']==0) {
												echo $sepet['urun_fiyat'];
												$sepet_fiyati = $sepet['urun_fiyat'];
											}else{
												echo "<del>".$sepet['urun_fiyat']."</del> ";
												echo $sepet['urun_fiyat']*(100-$sepet['urun_indirim'])/100;
												$sepet_fiyati = $sepet['urun_fiyat']*(100-$sepet['urun_indirim'])/100;
												$indirimli_urunler[$sepet['urun_id']] = $sepet['urun_fiyat']-$sepet_fiyati;
											} ?> ₺</td>
											<td class="column-4">
												<div class="wrap-num-product flex-w m-l-auto m-r-0">
													<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
														<i class="fs-16 zmdi zmdi-minus"></i>
													</div>

													<input class="mtext-104 cl3 txt-center num-product" type="number" min="1" max="<?php echo $sepet['urun_stok']; ?>" name="<?php echo $sepet['urun_id'] ?>" value="<?php echo $_COOKIE['siteurlmiz'][$sepet['urun_id']] ?>">

													<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
														<i class="fs-16 zmdi zmdi-plus"></i>
													</div>
												</div>
											</td>
											<td class="column-5"><?php echo $sepet_fiyati*$_COOKIE['siteurlmiz'][$sepet['urun_id']]; ?>₺</td>
											<td class="column-6"><a style="color:red;" href="sepete-ekle.php?sepet-sil=<?php echo $sepet['urun_id'] ?>">X</a></td>
											<td class="column-7">&emsp;</td>
										</tr>  
										<?php 
									}
									if (empty($_COOKIE['siteurlmiz'])) {
										?>
										<tr class="table_row">
											<td></td>
											<td></td>
											<td>SEPETİNİZ BOŞ</td>
										</tr>  
										<?php
									}
									?>
								</table>
							</div>

							<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm"> 

								<div class="flex-w flex-m m-r-20 m-tb-5">
									<button class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-10 trans-04 pointer m-tb-5" type="submit" name="sepet-guncelle" >
										<?php 
										if (empty($_COOKIE['siteurlmiz'])) {
											echo "<a href='shop.php'>ALIŞVERİŞE BAŞLA</a>";
										}else{
											echo "SEPETİ GÜNCELLE";
										}
										?> 
									</button>
								</div>
							</div>
						</form>
					</div>
				</div> 

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Sepet Toplamı
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Aratoplam:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									<?php echo $aratoplam; ?> ₺
								</span>
							</div>
						</div>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Kupon kodu:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									Kupon kodunuz mu var? Hemen kupon kodunuzu girip indiriminizi kazanabilirsiniz.
								</p>

								<div class="p-t-15">
									<span class="stext-112 cl8">
										KUPON KODUNUZU GİRİN
									</span>

									<form action="sepete-ekle.php" method="POST">
										<div class="bor8 bg0 m-b-22">
											<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="kupon_kodu" placeholder="Kupon kodunuz.">
										</div>

										<div class="flex-w">
											<input type="submit" class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer" value="KODU GÖNDER" name="kupongonder">
										</div>
									</form>
								</div>
							</div>
						</div>

						<?php 
						if (!empty($indirimli_urunler)) { ?>
						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									İndirimli ürünler:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									<?php 
									$urunler = array_keys($indirimli_urunler);
									for ($i=0; $i < count($indirimli_urunler) ; $i++) { 
										$indirimler = $db->wread("urun","urun_id",$urunler[$i]);
										echo $indirimler['urun_ad']." ürününde ".$indirimli_urunler[$indirimler['urun_id']]."₺ indirim.<br>";
									}

									?>
								</span>
							</div>
						</div>
						<?php } ?>

						<?php 
						if (isset($_COOKIE['siteurlmizkupon']['indirim_orani'])) { ?>
						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Kupon İndirim Miktarı:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									<?php echo $sepet_toplam-$indirimli_toplam ?> ₺
								</span>
							</div>
						</div>
						<?php } ?>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Toplam:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									<?php 
									if (!empty($indirimli_toplam )) {
										echo $sepet_sonuc_fiyati = $indirimli_toplam ;
									}else{
										echo $sepet_sonuc_fiyati = $sepet_toplam;
									} ?> ₺
								</span>
							</div>
						</div>
						<form method="POST" action="sepet-onay.php">
							<input type="hidden" name="indirim_miktari" value="<?php echo $aratoplam-$sepet_sonuc_fiyati ?>">
							<input type="hidden" name="sepet_toplam" value="<?php echo $sepet_sonuc_fiyati; ?>"> 
							<button name="siparis_olustur" type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"> 
								SEPETİ ONAYLA
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>





	<div id="iyzipay-checkout-form" class="responsive">
		
	</div>






	
	<?php require_once 'tema/footer.php'; ?>