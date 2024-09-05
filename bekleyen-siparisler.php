<div class="tab-pane" id="bekleyen-siparisler">

	<h2>Beklemedeki Siparişleriniz</h2>

	<hr> 
	<div class="form-group"> 
		<div class="col-xs-6">
			<?php  
			echo "<pre>";
			$sorgu = 0;
			$siparis_sor = $db->wread2("siparisler","users_id",$_SESSION['users']['users_id']);
			$sayac = 1;
			while ($siparis_cek = $siparis_sor->fetch(PDO::FETCH_ASSOC)) {
				if ($siparis_cek['siparis_durum']==0) {
					$sorgu++;
					echo $sayac.". SİPARİŞİNİZ : <br><br><br>";
					// Decodeleri unutma!
					$urunler = json_decode(htmlspecialchars_decode($siparis_cek['urunler_id'])); 
					$urun_sayaci = 1;
					foreach ($urunler as $key => $value) {
						// siparişteki ürünleri yazdır. 
						$urun_cek = $db->wread2("urun","urun_id",$key);
						$urun_cek = $urun_cek->fetch(PDO::FETCH_ASSOC);
						$kategori_cek = $db->wread2("kategori","kategori_id",$urun_cek['kategori_id']);
						$kategori_cek = $kategori_cek->fetch(PDO::FETCH_ASSOC);
						echo "Ürün No : ".$urun_sayaci."<br>";
						echo "Ürün Resimi : <br>";
						echo '<img width="150" src="src/dimg/urun/'.$urun_cek['urun_file'].'">'."<br>";
						echo "Ürün Adı : ".$urun_cek['urun_ad']."<br>";
						echo "Ürün Kategori : ".$kategori_cek['kategori_ad']."<br>";
						echo "Ürün Fiyatı : ".$urun_cek['urun_fiyat']." ₺<br>";
						echo "Ürün Sipariş Adeti : ".$value."<br>";
						echo 'Ürün Linki : <a href = "'.$_SERVER['SERVER_NAME']."/".$kategori_cek['kategori_seourl']."/".$urun_cek['urun_seourl'].'">Görmek için tıklayın</a>';
						echo "<br><br><br>";
						$urun_sayaci++;
					}
					if (!empty($siparis_cek['siparis_indirim_miktari'])) {
						echo $sayac.". SİPARİŞİNİZDEKİ YAPILAN İNDİRİM MİKTARI: ".$siparis_cek['siparis_indirim_miktari']."<br>";
					}
					echo $sayac.". SİPARİŞİNİZİN TOPLAMI : ".$siparis_cek['siparis_toplam']."<br>";
					
					$sayac++;
					echo "<hr>";
				}
				
			}

			if ($sorgu==0) {
				echo "<h2>Bekleyen siparişiniz yok &#128553;</h2>";
			}
			?> 

		</div>
	</div>  

</div> 