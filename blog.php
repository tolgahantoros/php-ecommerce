<?php require_once 'tema/header.php'; ?>

<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-02.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		Blog
	</h2>
</section>	
<section class="bg0 p-t-62 p-b-60">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-9 p-b-80">
				<div class="p-r-45 p-r-0-lg">
					<!-- item blog -->
					<?php require_once 'blog_dosyalar/blog_icerik.php' ?>
					<!-- Pagination -->
					<div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
						<a href="?sayfa=1" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
							<<
						</a>
						<?php 
						
						 
						$sayfa_goster = 5;  

						$en_az_orta = ceil($sayfa_goster/2);
						$en_fazla_orta = ($toplam_sayfa+1) - $en_az_orta;

						$sayfa_orta = $sayfa;
						if($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
						if($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;

						$sol_sayfalar = round($sayfa_orta - (($sayfa_goster-1) / 2));
						$sag_sayfalar = round((($sayfa_goster-1) / 2) + $sayfa_orta); 

						if($sol_sayfalar < 1) $sol_sayfalar = 1;
						if($sag_sayfalar > $toplam_sayfa) $sag_sayfalar = $toplam_sayfa;

						for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
							if($sayfa == $s) {
								if (!isset($_GET['sayfa'])) {
									?>
									<a class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1" href="#">1</a>
									<?php
								}else{
									?>
									<a class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1" href="<?php echo $_GET['sayfa']; ?>"><?php echo $_GET['sayfa']; ?></a>
									<?php
								}
							} else {
								if (isset($_GET['sirala'])) {
									echo '<a class="flex-c-m how-pagination1 trans-04 m-all-7" href="?sirala='.$_GET['sirala'].'&sayfa='.$s.'">'.$s.'</a> ';
								}else{
									echo '<a class="flex-c-m how-pagination1 trans-04 m-all-7" href="?sayfa='.$s.'">'.$s.'</a> ';
								}

							}
						}

						?>
						<a href="?sayfa=<?php echo $toplam_sayfa; ?>" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
							>>
						</a>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-lg-3 p-b-80">
				<div class="side-menu">
					<div class="bor17 of-hidden pos-relative">
						<form method="POST" action="">
							<input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Ara...">

							<button type="submit" name="" class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
								<i class="zmdi zmdi-search"></i>
							</button>
						</form>
					</div>
					
					<?php require_once 'blog_dosyalar/blog_onecikar.php'; ?>
					
				
				</div>
			</div>
		</div>
	</div>
</section>	

<?php require_once 'tema/footer.php'; ?>