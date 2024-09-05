<?php require_once 'tema/header.php'; ?> 
	<!-- Başlık -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Şartlar Ve Koşullar
		</h2>
	</section>	 
	<!-- İçerik -->
	<section class="bg0 p-t-75 p-b-120">
		<div align="center" class="container"> 
			  <?php $hakkimizdacek = $db->wread("hakkimizda","id",3);
			  echo $hakkimizdacek['icerik'];
			   ?>
		</div>
	</section>	
	
	
		

<?php require_once 'tema/footer.php'; ?>