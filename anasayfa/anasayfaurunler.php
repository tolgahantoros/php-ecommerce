<!-- her ürünün kategorisini data-filtere yazdır ve ürün sayfasında da gerekli kısıma kategoriyi yazdır ( baştaki divin son değişkeni ) -->
<?php 
$gosterilecek_urun_sayisi = $db->wread2("icerik_sayilari","alan","ana_sayfa");
$gosterilecek_urun_sayisi = $gosterilecek_urun_sayisi->fetch(PDO::FETCH_ASSOC);
$sayfada = $gosterilecek_urun_sayisi['sayi'];
$sorgu = $db->read("urun");
$toplam_icerik=$sorgu->rowCount();
$toplam_sayfa = ceil($toplam_icerik / $sayfada);
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
if($sayfa < 1) $sayfa = 1; 
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
$limit = ($sayfa - 1) * $sayfada ;


switch ($_GET['sirala']) {
	case 'otomatik':
	$urunsor=$db->wread2("urun","urun_onecikar",1,[
		"columns_name" => "urun_id",
		"columns_sort" => "DESC",
		"limit" => $limit.",".$sayfada
		]);
	break;
	case 'yeniler':
	$urunsor=$db->wread2("urun","urun_onecikar",1,[
		"columns_name" => "urun_id",
		"columns_sort" => "DESC",
		"limit" => $limit.",".$sayfada
		]);
	break;
	case 'azalanfiyat':
	$urunsor=$db->wread2("urun","urun_onecikar",1,[
		"columns_name" => "urun_fiyat",
		"columns_sort" => "DESC",
		"limit" => $limit.",".$sayfada
		]);
	break;
	case 'artanfiyat':
	$urunsor=$db->wread2("urun","urun_onecikar",1,[
		"columns_name" => "urun_fiyat",
		"columns_sort" => "ASC",
		"limit" => $limit.",".$sayfada
		]);
	break;
	default: 
	$urunsor=$db->wread2("urun","urun_onecikar",1,[
		"columns_name" => "urun_id",
		"columns_sort" => "DESC",
		"limit" => $limit.",".$sayfada
		]);
	break;
}
while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
<div class="urun isotope-item <?php echo $uruncek['urun_tur'] ?> ">
	<!-- Block2 -->
	<div class="block2">

		<div class="block2-pic hov-img0">

			<?php $kategoricek = $db->wread("kategori","kategori_id",$uruncek['kategori_id']); ?>


			<?php if (!empty($uruncek['urun_indirim'])) { ?> 
			<div style="position: absolute;width: 160px;" class="flex-col-c-m size-60 bg1 how-pos2">
				<span class="ltext-55 cl13 txt-left">
					%<?php echo $uruncek['urun_indirim'] ?> İNDİRİM!
				</span>
			</div>
			<?php } ?>



			<a href="<?php echo $kategoricek['kategori_seourl'] ?>/<?php echo $uruncek['urun_seourl'] ?>"> 
				<img src="src/dimg/urun/<?php echo $uruncek['urun_file'] ?>" alt="IMG-PRODUCT">
			</a>
			<a href="sepete-ekle?sepete-ekle=<?php echo $uruncek['urun_id'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1>">
				Sepete Ekle
			</a>
		</div>

		<div class="block2-txt flex-w flex-t p-t-14">
			<div class="block2-txt-child1 flex-col-l ">
				<?php 
				// Puan sorgula

				$puan_sor = $db->qSql2("SELECT COUNT(id),SUM(puan) FROM urun_yorumlar WHERE urun_id=".$uruncek['urun_id']); 
				$puan_sor = $puan_sor->fetch(PDO::FETCH_ASSOC);

				// sadece oylaması olan ürünlerde göster
				if (!empty($puan_sor['COUNT(id)'])) {

					echo '<span class="wrap-rating fs-18 cl11 pointer">';

					// yıldız hesapla  
					$yildiz_sayisi = $puan_sor['SUM(puan)']/$puan_sor['COUNT(id)']; 
					$boyanan_yildiz_sayisi = floor($yildiz_sayisi);
					$kalan_yildiz = 5-$yildiz_sayisi;
					for ($i=0; $i < $boyanan_yildiz_sayisi; $i++) { 
						echo '<i class="pointer zmdi zmdi-star"></i>'; 
					} 
					if ($kalan_yildiz>1) { 
						for ($i=1; $i <= $kalan_yildiz; $i++) { 
							echo '<i class="pointer zmdi zmdi-star-outline"></i> '; 
						}
					}else if($kalan_yildiz!=0){
						echo '<i class="pointer zmdi zmdi-star-half"></i> '; 
					}
					echo " ".$yildiz_sayisi;
					echo '</span>';
				} 
				?>

				
				<a href="<?php echo $kategoricek['kategori_seourl'] ?>/<?php echo $uruncek['urun_seourl'] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
					<?php echo $uruncek['urun_ad']; ?>
				</a>

				<span class="stext-105 cl3">
					<?php 
					if (!empty($uruncek['urun_indirim'])) { 
						$indirimli_fiyat = $uruncek['urun_fiyat']-$uruncek['urun_fiyat']*$uruncek['urun_indirim']/100;
						echo "<b>".$indirimli_fiyat."₺</b> ";
						echo "<del> ".$uruncek['urun_fiyat']."₺</del>";
					}else{
						echo "<b> ".$uruncek['urun_fiyat']."₺</b>";
					}
					?>
				</span>
			</div>

			<!-- <div class="block2-txt-child2 flex-r p-t-3">
				<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
					<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
					<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
				</a>
			</div> -->
		</div>
	</div>
</div>  
<?php } ?>