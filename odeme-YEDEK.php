<?php require_once 'tema/header.php'; 

if (empty($_SESSION['users']['users_id'])) {
	header("location:uye-ol?durum=odeme-icin-uye-olun");
	exit;
}

$odeme_durumu = 1;  
if ($odeme_durumu==0) {
	header("location:sepet.php?durum=odeme_basarisiz");
	exit;
} 

if (isset($_POST['siparis_olustur'])) { 




	// DB ye siparişin girişi 
	$sepet_toplam = $_POST['sepet_toplam'];
	$_POST['siparis_toplam'] = $_POST['sepet_toplam'];
	unset($_POST['siparis_olustur']);
	unset($_POST['sepet_toplam']);
	$siparisler = json_encode($_COOKIE['siteurlmiz'],JSON_PRETTY_PRINT);
	$_POST['urunler_id'] = $siparisler; 
	$_POST['users_id'] = $_SESSION['users']['users_id']; 
	$siparis_ekle = $db->insert("siparisler",$_POST);
	// siparişi aldıktan sonra mail at ve sepette çerezi boşalt 
	if ($siparis_ekle['status']) {
		$sayac=1;
		foreach ($_COOKIE['siteurlmiz'] as $key => $value) {
			$urun_no = $sayac.". Ürünün Detayları : <br>";
			$uruncek = $db->wread2("urun","urun_id",$key);
			$uruncek = $uruncek->fetch(PDO::FETCH_ASSOC); 
			$kategoricek = $db->wread2("kategori","kategori_id",$uruncek['kategori_id']);
			$kategoricek = $kategoricek->fetch(PDO::FETCH_ASSOC);
			$urun_ad = "Ürün adı : ".$uruncek['urun_ad']."<br>"; 
			$urun_fiyat = "Ürün Fiyatı : ".$uruncek['urun_fiyat']."<br>"; 
			$siparis_adeti = "Sipariş Adeti : ".$value."<br>"; 

			$urun_url = "Ürün URL: <a href=".$_SERVER['HTTP_HOST']."/".$kategoricek['kategori_seourl']."/".$uruncek['urun_seourl'].">ÜRÜNÜ GÖRMEK İÇİN TIKLAYIN</a> "; 
			$mail_icerigi = $mail_icerigi.$urun_no.$urun_ad.$urun_fiyat.$siparis_adeti.$urun_url."<br><br>";
			$sayac++;
		}
		$mail_gonder = $mail->mail_gonder($_SESSION['users']['users_mail'],"Siparişinizi aldık!",$mail_icerigi);
		require_once 'sepet-bosalt.php';
	}


	// Affiliate Sorgusu
	if (!empty($_COOKIE['siteurlmiz_affiliate'])) {
		// var ise db de sipariş satırında affiliate kısmına affiliate id sini yazdıracak.
		$ortak = $_COOKIE['siteurlmiz_affiliate'];
		$_POST['affiliate'] = $ortak;

		// classlardaki metodlarımıza göre update işlemlerini post değişkeniyle yapıyoruz
		// bu yüzden postun yedeğini alıp affiliate updatesini yapacağız daha sonra yedeği gerçek posta alacağız.
		$post_yedek = $_POST;
		unset($_POST);

		$ortak_payini_sor = $db->wread2("affiliate","id",$ortak);
		$ortak_payini_sor = $ortak_payini_sor->fetch(PDO::FETCH_ASSOC);


		$_POST['bakiye'] = $ortak_payini_sor['bakiye'] + ($sepet_toplam*$ortak_payini_sor['oran'])/100;
		$_POST['referans'] = $ortak_payini_sor['referans'] + 1;
		$_POST['id'] = $ortak;

		$ortak_payini_ver = $db->update("affiliate",$_POST,[
			"columns" => "id"
			]);
		// Ortağın değerleri güncellendi.
	}



}
?>

<section class="bg0 p-t-23 p-b-140">
	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div align="center"> 
				<h1>Ödeme işleminiz başarıyla tamamlandı.</h1> 
				<h3>Affiliate : </h3>
				<p>
					<?php 
					if (!empty($_COOKIE['siteurlmiz_affiliate'])) {
						echo "Senin affiliaten : ".$_COOKIE['siteurlmiz_affiliate'];
					}
					?>
				</p><br>
				<h3>Beklemede olan siparişleriniz : </h3> 
				<p>
					<?php  
					// Sipariş durumu 1 olanları almayacak şekilde sorgu koy
					$siparis_sor = $db->wread2("siparisler","users_id",$_SESSION['users']['users_id']);
					$siparis_cek = $siparis_sor->fetchAll(PDO::FETCH_ASSOC);
					print_r($siparis_cek);
					?>
				</p>
			</div>
		</div>
	</div>
</section>




<?php require_once 'tema/footer.php'; ?>