
<div class="bor10 m-t-50 p-t-43 p-b-40">
	<!-- Tab01 -->
	<div class="tab01">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li class="nav-item p-b-10">
				<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Açıklama</a>
			</li>

			<li class="nav-item p-b-10">
				<a class="nav-link" data-toggle="tab" href="#information" role="tab">Garanti/İade</a>
			</li>

			<li class="nav-item p-b-10">
				<?php 
				$urun_id = $urun['urun_id'];
				$yorum_sayisi = $db->wread2("urun_yorumlar","urun_id",$urun_id);
				$yorum_sayisi = $yorum_sayisi->fetchAll(PDO::FETCH_ASSOC);
				?>
				<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Yorumlar (<?php echo count($yorum_sayisi) ?>)</a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content p-t-43">
			<!-- - -->
			<div class="tab-pane fade show active" id="description" role="tabpanel">
				<div class="how-pos2 p-lr-15-md">
					<p class="stext-102 cl6">
						<?php echo htmlspecialchars_decode($urun['urun_detay']); ?>
					</p>
				</div>
			</div>

			<!-- - -->
			<div class="tab-pane fade" id="information" role="tabpanel">
				<div class="row">
					<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
						Garanti koşulları falan filan
					</div>
				</div>
			</div>

			<!-- - -->
			<div class="tab-pane fade" id="reviews" role="tabpanel">
				<div class="row">
					<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
						<div class="p-b-30 m-lr-15-sm">
							<!-- Review -->
							<?php  
							$yorum_sor=$db->wread2("urun_yorumlar","urun_id",$urun_id,[
								"columns_name" => "yorum_tarih",
								"columns_sort" => "DESC"
								]);
							$sayac = 0;
							while ($yorumlar=$yorum_sor->fetch(PDO::FETCH_ASSOC)) { 
								if ($yorumlar['yorum_durumu']!=1) {
									// Yorum onaylanmadıysa.
									continue;
								}
								$yorum_yapan_kullanici = $db->wread("users","users_id",$yorumlar['users_id']);
								?>
								<div class="flex-w flex-t p-b-68">
									<?php 
									if (empty($yorum_yapan_kullanici['users_file'])) { ?>
									<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
										<img src="../images/avatar.png" alt="AVATAR">
									</div>
									<?php }else{ ?>
									<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
										<img src="../src/dimg/users/<?php echo $yorum_yapan_kullanici['users_file'] ?>" alt="<?php echo $yorum_yapan_kullanici['users_namesurname'] ?>">
									</div>
									<?php } ?>
									

									<div class="size-207">
										<div class="flex-w flex-sb-m p-b-17">
											<span class="mtext-107 cl2 p-r-20">
												<?php echo $yorum_yapan_kullanici['users_namesurname'] ?>
											</span> 
											<span class="fs-18 cl11">
												<?php if ($yorumlar['puan']!=0) {
													$verilen_puan=0;
													for ($i=0; $i < $yorumlar['puan'] ; $i++) { 
														echo '<i class="zmdi zmdi-star"></i>';
														$verilen_puan++;
													}
													$verilmeyen_puan = 5 - $verilen_puan;
													for ($i=0; $i < $verilmeyen_puan ; $i++) { 
														echo '<i class="zmdi zmdi-star-outline"></i>';
													}
												}else{
													echo "Puan Verilmedi.";
												}
												?>
											</span>
										</div>

										<p class="stext-102 cl6">
											<?php echo $yorumlar['yorum'] ?>
										</p>
									</div>
								</div>
								<?php $sayac++; } ?>
								<?php 
								if ($sayac==0) {
									echo '<h5 align="center" class="mtext-108 cl2 p-b-7"> Henüz Yorum Yok! İlk Yorumu Sen Yapabilirsin. </h5><br><br>';
								}
								?> 
								<h5 class="mtext-108 cl2 p-b-7">
									Yorum Yap
								</h5>
								<!-- Add review -->
								<?php if (!empty($_SESSION['users']['users_id'])) { ?>
								<form method="POST" action="" class="w-full">


									<div class="flex-w flex-m p-t-50 p-b-23">
										<span class="stext-102 cl3 m-r-16">
											Puan:
										</span>

										<span class="wrap-rating fs-18 cl11 pointer">
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<input class="dis-none" type="number" name="puan">
										</span>
									</div>

									<div class="row p-b-25">
										<div class="col-12 p-b-5">
											<label class="stext-102 cl3" for="review">Yorumunuz</label>
											<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="yorum"></textarea>
										</div> 
									</div>
									<input type="hidden" name="ip_adresi" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
									<input type="hidden" name="users_id" value="<?php echo $_SESSION['users']['users_id'] ?>">
									<input type="hidden" name="urun_id" value="<?php echo $urun['urun_id'] ?>">
									<input type="submit" name="yorumyap" value="Gönder" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10"> 
								</form>
								<?php }else{
									?>
									<div align="center">
										Ürüne yorum yapmak için giriş yapmalısınız. <br><br>
										<a href="<?php echo $suanki_domain ?>/giris-yap" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">GİRİŞ YAP</a>
										<br>
										Hesabınız yok mu? Hemen bir hesap oluşturun
										<br><br>
										<a href="<?php echo $suanki_domain ?>/uye-ol" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">ÜYE OL</a>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>