<?php 


$countdown_sor = $db->read("indirim");
$countdown_cek = $countdown_sor->fetch(PDO::FETCH_ASSOC);
if ($countdown_cek['durum']=="1") { ?>
<section>
	<div align="center" class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="border">
				<p id="title"><?php echo $countdown_cek['aciklama'] ?></p>
				<p hidden id="countdown_sure_sonu"><?php echo $countdown_cek['sure']; ?></p>
				<div id="timer">ACELE ET!!!</div> <br>
				<a style="width: 150px;" class="flex-c-m stext-101 cl0 size-55 bg1 bor1 hov-btn2 p-lr-15 trans-04" href="<?php echo $countdown_cek['buton_link'] ?>"><?php echo $countdown_cek['buton_adi'] ?></a>
			</div>
		</div>
	</div>
</section>
<?php } ?>