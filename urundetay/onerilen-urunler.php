<section class="sec-relate-product bg0 p-t-45 p-b-105">
	<div class="container">
		<div class="p-b-45">
			<h3 class="ltext-106 cl5 txt-center">
				Önerilen Ürünler
			</h3>
		</div>

		<!-- Slide2 -->
		<div class="wrap-slick2">
			<div class="slick2">
				<?php 
				$onerilen_urun_sayisi_db = $db->wread2("icerik_sayilari","alan","onerilen_urun");
				$onerilen_urun_sayisi_db = $onerilen_urun_sayisi_db->fetch(PDO::FETCH_ASSOC); 
				$onerilen_urun_sayisi = $onerilen_urun_sayisi_db['sayi'];


				$onerilenurun=$db->wread2("urun","kategori_id",$kategori['kategori_id'],[
					'columns_name' => "urun_id",
					'columns_sort' => "DESC"
					]);
				
				$sayac = 0;
				while ($onerilenuruncek=$onerilenurun->fetch(PDO::FETCH_ASSOC)) { 
					if ($onerilenuruncek['urun_id']==$urun['urun_id']) {
						continue;
					}
					$sayac++;
					?>
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<a href="<?php echo $suanki_domain.'/'.$_GET['kategori'].'/'.$onerilenuruncek['urun_seourl']; ?>">
							<div class="block2">
								<div class="block2-pic hov-img0">
									<img src="../src/dimg/urun/<?php echo $onerilenuruncek['urun_file'] ?>" alt="IMG-PRODUCT">

									<a href="<?php echo $suanki_domain.'/'.$_GET['kategori'].'/'.$onerilenuruncek['urun_seourl']; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
										Hızlı incele
									</a>
								</div>

								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="<?php echo $suanki_domain.'/'.$_GET['kategori'].'/'.$onerilenuruncek['urun_seourl']; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											<?php echo $onerilenuruncek['urun_ad']; ?>
										</a>

										<span class="stext-105 cl3">
											<?php echo $onerilenuruncek['urun_fiyat'] ?>
										</span>
									</div>

									<div class="block2-txt-child2 flex-r p-t-3">
										<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
											<img class="icon-heart1 dis-block trans-04" src="../images/icons/icon-heart-01.png" alt="ICON">
											<img class="icon-heart2 dis-block trans-04 ab-t-l" src="../images/icons/icon-heart-02.png" alt="ICON">
										</a>
									</div>
								</div>
							</div>
						</a>
					</div>
					<?php 
					if ($sayac==$onerilen_urun_sayisi) {
					// döngüden çık
						break;
					}
				}
				?>
			</div>
		</div>
	</div>
</section>