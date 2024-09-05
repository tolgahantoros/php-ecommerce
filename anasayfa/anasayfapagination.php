<!-- Sayfalama  -->
<div class="flex-c-m flex-w w-full p-t-38">
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