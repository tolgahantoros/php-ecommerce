 

<?php require_once 'tema/header.php'; ?> 
<!-- Slider -->
<?php require_once 'anasayfa/anasayfaslider.php'; ?>
<!-- Countdown -->
<?php require_once 'anasayfa/anasayfacountdown.php'; ?>
<!-- Banner -->
<?php require_once 'anasayfa/anasayfabannerler.php'; ?>

<!-- Ürünler -->
<section id="urunler" class="bg0 p-t-23 p-b-140">
	<div class="container">
		<div class="p-b-10">
			<h3 class="ltext-103 cl5">
				Ürünler
			</h3>
		</div>

		<div class="flex-w flex-sb-m p-b-52">
			<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				<?php require_once 'anasayfa/anasayfakategoriler.php'; ?>
			</div>

			<div class="flex-w flex-c-m m-tb-10">
				<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
					<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
					<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
					Filtre
				</div>

				<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
					<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
					<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
					Ara
				</div>
			</div>

			<!-- Search product -->
			<div class="dis-none panel-search w-full p-t-10 p-b-15">
				<div class="bor8 dis-flex p-l-15">

					<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<form method="POST" action="shop" style="width: 2000px;">
						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="Ara...">
					</form>
				</div>	
			</div>

			<?php require_once 'tema/filtre.php'; ?>

			<div class="row isotope-grid">
				<!-- ürün -->
				<?php require_once 'anasayfa/anasayfaurunler.php'; ?>
			</div>
			
			<?php require_once 'anasayfa/anasayfapagination.php'; ?>
		</div>
	</section>
	

	<?php require_once 'anasayfa/anasayfablog.php'; ?>


	<?php require_once 'tema/footer.php'; ?>