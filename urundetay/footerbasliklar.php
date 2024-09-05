<?php 
$footer_baslik_sor = $db->wread2("footerbaslik","footer_durum",1);
while ($footer_baslik_cek = $footer_baslik_sor->fetch(PDO::FETCH_ASSOC)) { ?>

<div class="col-sm-6 col-lg-3 p-b-50">
	<h4 class="stext-301 cl0 p-b-30">
		<?php echo $footer_baslik_cek['footer_baslik'] ?>
	</h4>

	<ul>
		<?php 
		$footer_altbaslik_sor = $db->wread2("footer","footer_baslik",$footer_baslik_cek['footer_baslik']);
		while ($footer_altbaslik_cek = $footer_altbaslik_sor->fetch(PDO::FETCH_ASSOC)) { 
			if ($footer_altbaslik_cek['footer_durum']==0) {
				continue;
			}
			?>
			<li class="p-b-10">
			<a href="<?php echo $footer_altbaslik_cek['footer_url']; ?>" class="stext-107 cl7 hov-cl1 trans-04">
					<?php echo $footer_altbaslik_cek['footer_ad']; ?>
				</a>
			</li> 
			<?php } ?>
		</ul>
	</div>

	<?php } ?>