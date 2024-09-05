<!-- her ürünün kategorisini data-filtere yazdır ve ürün sayfasında da gerekli kısıma kategoriyi yazdır ( baştaki divin son değişkeni) -->
<?php  
$shop_sayfa_basi_urun_sayisi = $db->wread2("icerik_sayilari","alan","shop");
$shop_sayfa_basi_urun_sayisi = $shop_sayfa_basi_urun_sayisi->fetch(PDO::FETCH_ASSOC);
// CİNSİYET İÇİNDE ARAMA KOŞULU KOY.
if ($_GET['kategori']=="indirim") {
	// Sadece indirimli ürünleri yazdır
	$urunsor = $db->qSql2("SELECT * FROM urun WHERE urun_indirim <> 0"); 
	$sayfada = $shop_sayfa_basi_urun_sayisi['sayi'];
	$sorgu = $db->qSql2($sql_kodu);
	$toplam_icerik=$sorgu->rowCount();
	$toplam_sayfa = ceil($toplam_icerik / $sayfada);
	$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
	if($sayfa < 1) $sayfa = 1; 
	if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
	$limit = ($sayfa - 1) * $sayfada ;



}else if (!empty($_GET['kategori'])) { 

	$h1_basligi = "";
	$ife_girdi_mi = 1; // h1 başlığı için if kontrolü

	$_GET['kategori'] = strtolower($_GET['kategori']);
	// gette indirim kontrolü varsa indirim_durumu değerini 1 yap
	// daha sonra str_replace ile sil o değer yokmuş gibi arasın

	if (strstr($_GET['kategori'], "indirim")) {
		$indirim_durumu=1;
		$_GET['kategori'] = str_replace("-ve-indirim", "", $_GET['kategori']);
	}


	$arananlar = explode("-ve-", $_GET['kategori']);  


	// ÜRÜN TÜRLERİ İÇİN ARAMALAR
	$tum_urun_turleri = $db->read("urun_turleri");
	$tum_urun_turleri = $tum_urun_turleri->fetchAll(PDO::FETCH_ASSOC); 
	$j=0;
	for ($i=0; $i < count($tum_urun_turleri); $i++) { 
		if (in_array($tum_urun_turleri[$i]['urun_turu_seourl'], $arananlar,true)) {
			$arananlar_turler_id[$j]=$tum_urun_turleri[$i]['id'];
			$h1_basligi = $h1_basligi.",".$tum_urun_turleri[$i]['urun_turu'];
			$j++;
		} 
	}

	// KATEGORİLER İÇİN ARAMALAR
	$tum_kategoriler = $db->read("kategori");
	$tum_kategoriler = $tum_kategoriler->fetchAll(PDO::FETCH_ASSOC); 
	$j=0;
	
	for ($i=0; $i < count($tum_kategoriler); $i++) { 
		if (in_array($tum_kategoriler[$i]['kategori_seourl'], $arananlar,true)) {
			$arananlar_kategori_id[$j]=$tum_kategoriler[$i]['kategori_id'];
			$h1_basligi = $h1_basligi.",".$tum_kategoriler[$i]['kategori_ad'];
			$j++;
		} 
	}



	$sql_kodu = "SELECT * FROM urun WHERE ";


	// indirim koşulu varsa sql koduna ekle ve sadece indirim ise sql koduna direkt sadece indirimliler araması yaptır
	if ($indirim_durumu==1) { 
		$sql_kodu = $sql_kodu." urun_indirim <> '0' AND";  
	}


	for ($i=0; $i < count($arananlar_turler_id) ; $i++) { 
		$sql_kodu = $sql_kodu."urun_tur=".$arananlar_turler_id[$i];
		if ($i==count($arananlar_turler_id)-1) {
			break;
		}else{
			$sql_kodu = $sql_kodu." OR ";

		}
	}
	if (!empty($arananlar_turler_id) AND !empty($arananlar_kategori_id)) {
		$sql_kodu = $sql_kodu." OR ";
	}
	for ($i=0; $i < count($arananlar_kategori_id) ; $i++) { 
		$sql_kodu = $sql_kodu."kategori_id=".$arananlar_kategori_id[$i];
		if ($i==count($arananlar_kategori_id)-1) {
			break;
		}else{
			$sql_kodu = $sql_kodu." OR ";
		}
	}

	// KELİMELER İÇİN ARAMALAR (SEARCH OLACAK ŞEKİLDE)

	// gelen cümle içerisinde ürün türü ve kategori yoksa kelime araması yapacağız.

	if (empty($arananlar_kategori_id) AND empty($arananlar_turler_id)) {
	// detay ve ad kısmında aramak için seo url yi kelimeye çeviriyoruz
		$detayda_ara = str_replace("-"," ",$_GET['kategori']); 
		$sql_kodu = $sql_kodu." urun_seourl LIKE '%".$_GET['kategori']."%' OR urun_detay LIKE '%".$detayda_ara."%' OR urun_detay LIKE '%".$detayda_ara."%'";
	} 

	
	// sadece erkek ve kadın filtresi yap boş ise tüm ürünleri yaz
	// OR değil AND kullan
	$sql_kodu_yedek = $sql_kodu;
	if (in_array("erkek", $arananlar) AND in_array("kadin", $arananlar)==FALSE) { 
		$sql_kodu = $sql_kodu." AND urun_cinsiyet='erkek'";
	}
	if (in_array("kadin", $arananlar) AND in_array("erkek", $arananlar)==FALSE) {
		$sql_kodu = $sql_kodu." AND urun_cinsiyet='kadın'";
	}


	// SQL kodumuzun sonuna sıralama işlemi varsa bunu yazdırıyoruz.
	if ($_GET['sirala']) {
		if ($_GET['sirala']=="artanfiyat") {
			$sql_kodu = $sql_kodu." ORDER BY urun_fiyat ASC";
		}elseif ($_GET['sirala']=="azalanfiyat") {
			$sql_kodu = $sql_kodu." ORDER BY urun_fiyat DESC";
		}
	}

	$urunsor = $db->qSql2($sql_kodu);

	$sayfada = $shop_sayfa_basi_urun_sayisi['sayi'];
	$sorgu = $db->qSql2($sql_kodu);
	$toplam_icerik=$sorgu->rowCount();
	$toplam_sayfa = ceil($toplam_icerik / $sayfada);
	$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
	if($sayfa < 1) $sayfa = 1; 
	if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
	$limit = ($sayfa - 1) * $sayfada ;

}else{

	$sayfada = $shop_sayfa_basi_urun_sayisi['sayi'];
	$sorgu = $db->read("urun");
	$toplam_icerik=$sorgu->rowCount();
	$toplam_sayfa = ceil($toplam_icerik / $sayfada);
	$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
	if($sayfa < 1) $sayfa = 1; 
	if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
	$limit = ($sayfa - 1) * $sayfada ;

	// GET değeri boşsa ürünleri sondan başa doğru çekiyoruz
	switch ($_GET['sirala']) {
		case 'otomatik':
		$urunsor=$db->wread2("urun","urun_durum",1,[
			"columns_name" => "urun_id",
			"columns_sort" => "DESC",
			"limit" => $limit.",".$sayfada
			]);
		break;
		case 'yeniler':
		$urunsor=$db->wread2("urun","urun_durum",1,[
			"columns_name" => "urun_id",
			"columns_sort" => "DESC",
			"limit" => $limit.",".$sayfada
			]);
		break;
		case 'azalanfiyat':
		$urunsor=$db->wread2("urun","urun_durum",1,[
			"columns_name" => "urun_fiyat",
			"columns_sort" => "DESC",
			"limit" => $limit.",".$sayfada
			]);
		break;
		case 'artanfiyat':
		$urunsor=$db->wread2("urun","urun_durum",1,[
			"columns_name" => "urun_fiyat",
			"columns_sort" => "ASC",
			"limit" => $limit.",".$sayfada
			]);
		break;
		default: 
		$urunsor=$db->wread2("urun","urun_durum",1,[
			"columns_name" => "urun_id",
			"columns_sort" => "DESC",
			"limit" => $limit.",".$sayfada
			]);
		break;
	}
}?>
<h1 class="mtext-105 cl2 js-name-detail p-b-41"><?php  

	if ($ife_girdi_mi==1) {
		$h1_kelimeler = explode(",", $h1_basligi);
		for ($i=1; $i < count($h1_kelimeler); $i++) {  
			$sonraki_adim = $i+1; 
			$iki_adim_sonra = $i+2;
			if($sonraki_adim==count($h1_kelimeler) AND count($h1_kelimeler)!=2){
				$cinsiyet_kontrol=1;
				// Eğer bu son adim ise son kelimeye VE ekliyoruz değil ise aralara virgül koyuyoruz. Türkçe kuralı.
				echo " ve ".$h1_kelimeler[$i]." ürünleri";
			}else{
				$cinsiyet_kontrol=1;
				if ($iki_adim_sonra==count($h1_kelimeler)) {
					// Eğer VE den önceki kelimeyse virgül koymuyoruz değil ise koyuyoruz
					echo $h1_kelimeler[$i];
				}else{
					if (count($h1_kelimeler)==2) {
						echo $h1_kelimeler[$i]." ürünleri";
					}else{
						echo $h1_kelimeler[$i].",";
					}
					
				}
				
			} 
		}

		// Sadece Cinsiyet Başlığı için

		if ($cinsiyet_kontrol!=1) {
			if (in_array("erkek", $arananlar) AND in_array("kadin", $arananlar)) { 
				echo " Erkek ve Kadın Ürünleri ";
			} else if (in_array("erkek", $arananlar)) {
				echo " Erkek Ürünleri ";
			} else if (in_array("kadin", $arananlar)) {
				echo " Kadın Ürünleri ";
			}
		}

	}else{
		echo "Tüm Ürünlerimiz.";
	}
	?>
</h1>
<div class="row isotope-grid">
	<?php
	while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { 
		?>
		<div class="urun isotope-item <?php echo $uruncek['urun_tur'] ?>">
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
						<img src="src/dimg/urun/<?php echo $uruncek['urun_file'] ?>" alt="<?php echo $uruncek['urun_ad']; ?>">
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