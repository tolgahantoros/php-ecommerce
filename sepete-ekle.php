<?php  
error_reporting(E_ALL ^ E_WARNING);
ini_set('log_errors', 'On'); 
ini_set('display_errors', 'Off'); 
ini_set('error_reporting', E_ALL );
ob_start();
session_start(); 
setlocale(LC_TIME, 'tr_TR');  
require_once 'src/netting/class.crud.php';
$db = new crud(); 
function stok_sor($url){ 
	$db = new crud(); 
	$urun_sor = $db->wread("urun","urun_id",$_POST['urun_id']);
	$toplam_stok = $urun_sor['urun_stok'];
	$istenen_stok = $_POST['adet'] + $_COOKIE['siteurlmiz'][$_POST['urun_id']];
	if ($toplam_stok<$istenen_stok) { 
		$fazla_istek = $istenen_stok - $toplam_stok;
		header("location:$url?durum=yetersiz-stok&fazla_istek=$fazla_istek");
		exit;
	}
}



if (isset($_POST['sepete-ekle'])) {  
	$url = $_POST['url'];
	$urun_id = $_POST['urun_id'];
	stok_sor($url);
	if (empty($_COOKIE['siteurlmiz'][$_POST['urun_id']])) {
		setcookie("siteurlmiz[".$_POST['urun_id']."]",$_POST['adet'],strtotime('+2 day'));

		// Çerezler sayfa yenilenmeden güncellenmediği için veritabanına hem çerez hemde o anki post değerlerini ekleyeceğimiz diziyi oluşturuyoruz.
		$db_urunler_cerezi = $_COOKIE['siteurlmiz'];
		$db_urunler_cerezi[$_POST['urun_id']] = $_POST['adet'];
	}else{
		
		$eskiden_olan_urun_sayisi = $_COOKIE['siteurlmiz'][$urun_id];
		$toplam = $_POST['adet'] + $eskiden_olan_urun_sayisi;
		setcookie("siteurlmiz[".$_POST['urun_id']."]",$toplam,strtotime('+2 day'));
		// Çerezler sayfa yenilenmeden güncellenmediği için veritabanına hem çerez hemde o anki post değerlerini ekleyeceğimiz diziyi oluşturuyoruz.
		$db_urunler_cerezi = $_COOKIE['siteurlmiz'];
		$db_urunler_cerezi[$_POST['urun_id']] = $_POST['adet'];
	}
	
	if (!empty($_SESSION['users']['users_id'])) {
		// VERİTABANI SEPET İŞLEMİ
		$db_sepet_sor = $db->wread2("sepet","users_id",$_SESSION['users']['users_id']);
		$db_sepet_sor = $db_sepet_sor->fetch(PDO::FETCH_ASSOC);
		if (!empty($db_sepet_sor['id'])) {
			// BOŞ DEĞİLSE UPDATE BOŞ İSE İNSERT YAP.
			$db_yeni_sepet['id'] = $db_sepet_sor['id'];
			// oluşturduğumuz değişkenı db ye ekliyoruz
			$db_yeni_sepet['urunler_id'] = json_encode($db_urunler_cerezi,JSON_PRETTY_PRINT);
			$db_yeni_sepet['sepet_tarih'] = date("Y-m-d H:i:s");
			$db_sepet_guncelle = $db->update("sepet",$db_yeni_sepet,[
				"columns" => "id"
				]);
			if ($db_sepet_guncelle['status']==FALSE) {
				header("location:index.php?durum=veritabani-sepet-hatasi");
				exit;
			}
		}else{ 
			// insert yaptır
			$db_insert[$_POST['urun_id']] = $_POST['adet'];
			$db_yeni_sepet['urunler_id'] = json_encode($db_insert,JSON_PRETTY_PRINT);
			$db_yeni_sepet['users_id'] = $_SESSION['users']['users_id']; 
			$db_sepet_ekle = $db->insert("sepet",$db_yeni_sepet);
			if ($db_sepet_ekle['status']==FALSE) {
				header("location:index.php?durum=veritabani-sepet-hatasi");
				exit;
			}
			
		}
	}
	// hata yoksa sepete git
	header("location:$url?durum=sepete-eklendi");
	exit;
}else if (isset($_GET['sepete-ekle'])) {
	$urunsayisi = 1;
	setcookie('siteurlmiz['.$_GET['sepete-ekle'].']',$urunsayisi,strtotime('+2 day'));


	// Çerezler sayfa yenilenmeden güncellenmediği için veritabanına hem çerez hemde o anki post değerlerini ekleyeceğimiz diziyi oluşturuyoruz.
	$db_urunler_cerezi = $_COOKIE['siteurlmiz'];
	$db_urunler_cerezi[$_GET['sepete-ekle']] = 1;



	// veritabanı sepet işlemleri
	if (!empty($_SESSION['users']['users_id'])) {
		// VERİTABANI SEPET İŞLEMİ
		$db_sepet_sor = $db->wread2("sepet","users_id",$_SESSION['users']['users_id']);
		$db_sepet_sor = $db_sepet_sor->fetch(PDO::FETCH_ASSOC);
		if (!empty($db_sepet_sor['id'])) {
			// BOŞ DEĞİLSE UPDATE BOŞ İSE İNSERT YAP.
			$db_yeni_sepet['id'] = $db_sepet_sor['id'];
			$db_yeni_sepet['urunler_id'] = json_encode($db_urunler_cerezi,JSON_PRETTY_PRINT);
			$db_yeni_sepet['sepet_tarih'] = date("Y-m-d H:i:s");
			$db_sepet_guncelle = $db->update("sepet",$db_yeni_sepet,[
				"columns" => "id"
				]);
			if ($db_sepet_guncelle['status']==FALSE) {
				header("location:index.php?durum=veritabani-sepet-hatasi");
				exit;
			}
		}else{ 
			// insert yaptır
			$db_insert[$_GET['sepete-ekle']] = 1;
			$db_yeni_sepet['urunler_id'] = json_encode($db_insert,JSON_PRETTY_PRINT);
			$db_yeni_sepet['users_id'] = $_SESSION['users']['users_id']; 
			$db_sepet_ekle = $db->insert("sepet",$db_yeni_sepet);
			if ($db_sepet_ekle['status']==FALSE) {
				header("location:index.php?durum=veritabani-sepet-hatasi");
				exit;
			}
			
			
		}
	}

	// hata yoksa sepete git
	header("Location:sepet?durum=sepete-eklendi");
	exit;
}
else if (!empty($_GET['sepet-sil'])) {


	setcookie('siteurlmiz['.$_GET['sepet-sil'].']',1,strtotime('-2 day'));


	
	// Çerezler sayfa yenilenmeden güncellenmediği için veritabanına hem çerez hemde o anki post değerlerini ekleyeceğimiz diziyi oluşturuyoruz.
	// veritabanı değişkenindende siliyoruz
	$db_urunler_cerezi = $_COOKIE['siteurlmiz']; 
	unset($db_urunler_cerezi[$_GET['sepet-sil']]);



	// veritabanı işlemleri

	if (!empty($_SESSION['users']['users_id'])) {
		// VERİTABANI SEPET İŞLEMİ
		$db_sepet_sor = $db->wread2("sepet","users_id",$_SESSION['users']['users_id']);
		$db_sepet_sor = $db_sepet_sor->fetch(PDO::FETCH_ASSOC);
		if (!empty($db_sepet_sor['id'])) {
			// BOŞ DEĞİLSE UPDATE YAP
			$db_yeni_sepet['id'] = $db_sepet_sor['id'];
			$db_yeni_sepet['urunler_id'] = json_encode($db_urunler_cerezi,JSON_PRETTY_PRINT);
			$db_yeni_sepet['sepet_tarih'] = date("Y-m-d H:i:s");
			$db_sepet_guncelle = $db->update("sepet",$db_yeni_sepet,[
				"columns" => "id"
				]);
			if ($db_sepet_guncelle['status']==FALSE) {
				header("location:index.php?durum=veritabani-sepet-hatasi");
				exit;
			}
		} 
	}



	header("Location:sepet?durum=urun-cikarildi");
	exit;
}
else if(isset($_POST['sepet-guncelle'])){ 
	// cookie yeni değerler eklersek buraya güncelleme gelebilir.
	unset($_POST['sepet-guncelle']);
	unset($_POST['coupon']);
	print_r($_POST); 
	$sepet_guncelle = array_keys($_POST); 
	for ($i=0; $i < count($sepet_guncelle) ; $i++) { 
		setcookie('siteurlmiz['.$sepet_guncelle[$i].']',$_POST[$sepet_guncelle[$i]],strtotime('+2 day'));
		// Çerezler sayfa yenilenmeden güncellenmediği için veritabanına hem çerez hemde o anki post değerlerini ekleyeceğimiz diziyi oluşturuyoruz.
		$db_urunler_cerezi[$sepet_guncelle[$i]] = $_POST[$sepet_guncelle[$i]];
	} 


	if (!empty($_SESSION['users']['users_id'])) {
		// VERİTABANI SEPET İŞLEMİ
		$db_sepet_sor = $db->wread2("sepet","users_id",$_SESSION['users']['users_id']);
		$db_sepet_sor = $db_sepet_sor->fetch(PDO::FETCH_ASSOC);
		if (!empty($db_sepet_sor['id'])) {
			// BOŞ DEĞİLSE UPDATE YAP.
			$db_yeni_sepet['id'] = $db_sepet_sor['id'];
			$db_yeni_sepet['urunler_id'] = json_encode($db_urunler_cerezi,JSON_PRETTY_PRINT);
			$db_yeni_sepet['sepet_tarih'] = date("Y-m-d H:i:s");
			$db_sepet_guncelle = $db->update("sepet",$db_yeni_sepet,[
				"columns" => "id"
				]);
			if ($db_sepet_guncelle['status']==FALSE) {
				header("location:index.php?durum=veritabani-sepet-hatasi");
				exit;
			}
		} 
	}




	header("Location:sepet?durum=guncelleme-basarili");
	exit;
}elseif (isset($_POST['kupongonder'])) { 
	if (empty($_SESSION['users']['users_id'])) {
		// Oturum açarken DB'de sepeti var ise kupon kodunun
		// boşa gitmemesi için giriş yapmadan kupon kodu kullanılamaz.
		header("location:giris-yap?durum=kupon-icin-giris-yapin");
		exit;
	}
	if (!empty($_COOKIE['siteurlmizkupon'])) {
		header("location:sepet?kupon_kodu=bir-kod-kullaniyorsunuz");
		exit;
	}
	$kupon_kodu = $db-> wread("kupon_kodu","kupon_kodu",$_POST['kupon_kodu']);
	if ($kupon_kodu['kupon_sayisi']<1) {
		header("location:sepet?kupon_kodu=kod-sayisi-tukendi");
		exit;
	}
	if (empty($kupon_kodu['indirim_orani'])) {
		header("location:sepet?kupon_kodu=kod-bulunamadi");
		exit;
	}else{
		setcookie("siteurlmizkupon[kod]",$_POST['kupon_kodu'],strtotime('+2 day'));
		setcookie("siteurlmizkupon[indirim_orani]",$kupon_kodu['indirim_orani'],strtotime('+2 day'));
		setcookie("siteurlmizkupon[kupon_sontarih]",$kupon_kodu['kupon_sontarih'],strtotime('+2 day'));
		setcookie("siteurlmizkupon[indirim_kosulu]",$kupon_kodu['indirim_kosulu'],strtotime('+2 day'));
		setcookie("siteurlmizkupon[indirim_kosulu2]",$kupon_kodu['indirim_kosulu2'],strtotime('+2 day'));
		$kupon_guncelle['id'] = $kupon_kodu['id'];
		$kupon_guncelle['kupon_sayisi'] = $kupon_kodu['kupon_sayisi'] - 1;
		$guncelle=$db->update("kupon_kodu",$kupon_guncelle,[
			"columns" => "id"
			]);
		if ($guncelle['status']) {
			header("location:sepet?kupon_kodu=kod-uygulandi");
			exit;
		}
	}
	
}else{
	header("location:shop.php");
	exit;
}

?>