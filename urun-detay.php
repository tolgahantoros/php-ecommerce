<?php require_once 'urundetay/header.php'; ?> 
<!-- breadcrumb -->
<br>
<div class="container">
	<?php require_once 'urundetay/urun-yolu.php'; ?>
</div>


<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
	<div class="container">
		<div class="row">
			<?php require_once 'urundetay/urunfotolar.php'; ?>

			<?php require_once 'urundetay/urunaciklama.php'; ?>
		</div>

		<?php require_once 'urundetay/urun-detay-yorum.php'; ?>
	</div>

	<?php require_once 'urundetay/urun-barkod-kategori.php'; ?>
</section>



<!-- Related Products -->
<?php require_once 'urundetay/onerilen-urunler.php'; ?>

<?php require_once 'urundetay/footer.php' ;?> 