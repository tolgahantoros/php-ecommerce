	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<?php 

				require_once 'footerbasliklar.php';

				$footer_abone_sor = $db->read("footer_abone");
				$footer_abone_cek = $footer_abone_sor->fetch(PDO::FETCH_ASSOC);
				if ($footer_abone_cek['durum']==1) {
					?>
					<div class="col-sm-6 col-lg-3 p-b-50">
						<h4 class="stext-301 cl0 p-b-30">
							<?php echo $footer_abone_cek['baslik'] ?>
						</h4>
						<?php 

						if (isset($_POST['abone_ol'])) {
							$abone_ol = $db->insert("aboneler",$_POST,[
								"form_name" => "abone_ol"
								]);
							if ($abone_ol['status']) {
								?> 
								<script type="text/javascript">swal("Abone Oldunuz!","E-Posta bültenimize abone oldunuz. Tüm yenilik ve indirimlerden ilk siz haberdar olacaksınız!", "success",{button:"Tamam"});
								</script>
								<?php
							}else{?>
							<script type="text/javascript">swal("Abone Olamadınız!","Abone olunurken bir sorun oluştu. Lütfen daha sonra tekrar deneyin.", "error",{button:"Tamam"});
							</script>
							<? }
						}

						?>
						<form method="POST" action="">
							<div class="wrap-input1 w-full p-b-4">
								<input class="input1 bg-none plh1 stext-107 cl7" type="email" name="abone_mail" placeholder="<?php echo $footer_abone_cek['icerik'] ?>">
								<div class="focus-input1 trans-04"></div>
							</div>
							<input type="hidden" name="abone_ip" value="<?php
							function GetIP(){
								if(getenv("HTTP_CLIENT_IP")) {
									$ip = getenv("HTTP_CLIENT_IP");
								} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
									$ip = getenv("HTTP_X_FORWARDED_FOR");
									if (strstr($ip, ',')) {
										$tmp = explode (',', $ip);
										$ip = trim($tmp[0]);
									}
								} else {
									$ip = getenv("REMOTE_ADDR");
								}
								return $ip;
							}
							echo $ip_adresi = GetIP();
							?>">
							<div class="p-t-18">
								<button name="abone_ol" type="submit" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									<?php echo $footer_abone_cek['buton']; ?>
								</button>
							</div>
						</form>
					</div>
					<?php } ?>
				</div>

				<div class="p-t-40">
					<p class="stext-107 cl6 txt-center"> 
						&copy;<script>document.write(new Date().getFullYear());</script> Telif Hakları ve Tüm Hakları Gizlidir | Bu e-Ticaret Scripti <i class="aria-hidden="true"></i><a href="https://www.tolgahantoros.com.tr/" target="_blank">Tolgahan Toros</a> tarafından oluşturulmuştur. 

					</p>
				</div>
			</div>
		</footer>


		<!-- Back to top -->
		<div class="btn-back-to-top" id="myBtn">
			<span class="symbol-btn-back-to-top">
				<i class="zmdi zmdi-chevron-up"></i>
			</span>
		</div>

		<?php //require_once 'urunmodal.php'; FİXLE ?>

		<!--===============================================================================================-->	
		<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script src="../vendor/animsition/js/animsition.min.js"></script>
		<!--===============================================================================================-->
		<script src="../vendor/bootstrap/js/popper.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
		<script src="../vendor/select2/select2.min.js"></script>
		<script>
			$(".js-select2").each(function(){
				$(this).select2({
					minimumResultsForSearch: 20,
					dropdownParent: $(this).next('.dropDownSelect2')
				});
			})
		</script>
		<!--===============================================================================================-->
		<script src="../vendor/daterangepicker/moment.min.js"></script>
		<script src="../vendor/daterangepicker/daterangepicker.js"></script>
		<!--===============================================================================================-->
		<script src="../vendor/slick/slick.min.js"></script>
		<script src="../js/slick-custom.js"></script>
		<!--===============================================================================================-->
		<script src="../vendor/parallax100/parallax100.js"></script>
		<script>
			$('.parallax100').parallax100();
		</script>
		<!--===============================================================================================-->
		<script src="../vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
		<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
	
	<script src="../countdown/countdown.js" type="text/javascript"></script>
	<!--===============================================================================================-->
	<script src="../vendor/isotope/isotope.pkgd.min.js"></script>
	<!--===============================================================================================-->
	<script src="../vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
		
	</script>
	<!--===============================================================================================-->
	<script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
	<!--===============================================================================================-->
	<script src="../js/main.js"></script>
	<!--===============================================================================================--> 
</body>
</html>