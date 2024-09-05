<div class="row">
	<div class="col-md-6 col-lg-3 col-xlg-3">
		<div class="card card-hover">
			<div class="p-2 bg-secondary text-center">
				<h1 class="font-light text-white"> 
					<?php  
					$mesajlar = $db->wread2("mesajlar","mesaj_durum",0);
					$mesajlar = $mesajlar->fetchAll(PDO::FETCH_ASSOC); 
					echo count($mesajlar); 
					?> 
				</h1>
				<h6 class="text-white">Okunmamış Mesaj</h6>
			</div>
		</div>
	</div> 

	<div class="col-md-6 col-lg-3 col-xlg-3">
		<div class="card card-hover">
			<div class="p-2 bg-success text-center">
				<h1 class="font-light text-white"><?php  
					$users = $db->wread2("users","users_status",1);
					$users = $users->fetchAll(PDO::FETCH_ASSOC); 
					echo count($users); 
					?> 
				</h1>
				<h6 class="text-white">Üye Sayısı</h6>
			</div>
		</div>
	</div> 

	<div class="col-md-6 col-lg-3 col-xlg-3">
		<div class="card card-hover">
			<div class="p-2 bg-danger text-center">
				<h1 class="font-light text-white"><?php  
					$urun = $db->wread2("urun","urun_durum",1);
					$urun = $urun->fetchAll(PDO::FETCH_ASSOC); 
					echo count($urun); 
					?> 
				</h1>
				<h6 class="text-white">Aktif Ürün Sayısı</h6>
			</div>
		</div>
	</div> 

	<div class="col-md-6 col-lg-3 col-xlg-3">
		<div class="card card-hover">
			<div class="p-2 bg-primary text-center">
				<h1 class="font-light text-white"><?php  
					$affiliate = $db->wread2("affiliate","durum",1);
					$affiliate = $affiliate->fetchAll(PDO::FETCH_ASSOC); 
					echo count($affiliate); 
					?> 
				</h1>
				<h6 class="text-white">Affiliate Ortağı</h6>
			</div>
		</div>
	</div> 


	<p id="bekleyen" hidden>11</p>
	<p id="onaylanan" hidden>19</p>
	<p id="iade" hidden>1</p>
	<div id="chartContainer" style="height: 400px; width: 100%;"></div>	


	<div class="col-md-6 col-lg-3 col-xlg-3">
		<div class="card card-hover">
			<div class="p-2 bg-secondary text-center">
				<h1 class="font-light text-white"><?php  
					$siparisler = $db->read("siparisler");
					$siparisler = $siparisler->fetchAll(PDO::FETCH_ASSOC); 
					echo count($siparisler); 
					?> 
				</h1>
				<h6 class="text-white">Toplam Sipariş Sayısı</h6>
			</div>
		</div>
	</div> 

	<div class="col-md-6 col-lg-3 col-xlg-3">
		<div class="card card-hover">
			<div class="p-2 bg-success text-center">
				<h1 class="font-light text-white"><?php  
					$siparisler = $db->qSql("SELECT SUM(siparis_toplam) toplam FROM siparisler;"); 
					echo $siparisler['toplam'];
					?> 
				</h1>
				<h6 class="text-white">Tüm Gelir</h6>
			</div>
		</div>
	</div> 

	<div class="col-md-6 col-lg-3 col-xlg-3">
		<div class="card card-hover">
			<div class="p-2 bg-danger text-center">
				<h1 class="font-light text-white"><?php  
					$affiliate = $db->qSql("SELECT SUM(bakiye) toplam FROM affiliate;"); 
					echo $affiliate['toplam'];
					?> 
				</h1>
				<h6 class="text-white">Tüm Affiliate Ödeneği</h6>
			</div>
		</div>
	</div> 

	<div class="col-md-6 col-lg-3 col-xlg-3">
		<div class="card card-hover">
			<div class="p-2 bg-primary text-center">
				<h1 class="font-light text-white"><?php  
					$affiliate = $db->qSql("SELECT SUM(ziyaret) toplam FROM affiliate;"); 
					echo $affiliate['toplam'];
					?> 
				</h1>
				<h6 class="text-white">Tüm Affiliate Ziyaretçisi</h6>
			</div>
		</div>
	</div> 

</div>  