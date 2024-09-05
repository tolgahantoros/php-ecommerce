<?php 
error_reporting(E_ALL ^ E_WARNING);
ini_set('log_errors', 'On'); 
ini_set('display_errors', 'Off'); 
ini_set('error_reporting', E_ALL );
ob_start();
session_start(); 
setlocale(LC_TIME, 'tr_TR');  




if (empty($_SESSION['users']['users_id'])) {
	header("location:giris-yap?durum=oturum-ac");
	exit;
}
// oturum açık mı kontrollerini yap

require_once 'src/netting/class.crud.php';
$db = new crud();  


// Siparişi oluştur ödeme durumunu 0 yap

$siparis['users_id'] = $_SESSION['users']['users_id'];
$siparis['urunler_id'] = json_encode($_COOKIE['siteurlmiz'],JSON_PRETTY_PRINT);
$siparis['siparis_indirim_miktari'] = $_POST['indirim_miktari'];
$siparis['siparis_toplam'] = $_POST['sepet_toplam'];
$siparis['siparis_ip'] = $_POST['ip_adresi'];
$siparis['siparis_adres'] = $_POST['siparis_adres'];
$siparis['siparis_tarih'] = date("Y-m-d H:i:s");
$siparis['siparis_odeme'] = 0;
$siparis['affiliate_id'] = $_COOKIE['siteurlmiz_affiliate'];

$siparis_ver = $db->insert("siparisler",$siparis);


$kullanici_bilgileri = $db->wread2("users","users_id",$_SESSION['users']['users_id']);
$kullanici_bilgileri = $kullanici_bilgileri->fetch(PDO::FETCH_ASSOC);

// kullanıcının son sipariş id sini alıyoruz
$siparis_bilgileri = $db->wread2("siparisler","users_id",$siparis['users_id'],[
	"columns_name" => "id",
	"columns_sort" => "DESC"
	]);

$siparis_bilgileri = $siparis_bilgileri->fetch(PDO::FETCH_ASSOC);



$kullanici_id = $_SESSION['users']['users_id'];
$kullanici_ad = $_POST['users_name'];
$kullanici_soyad = $_POST['users_surname'];
$kullanici_soyadp = $_POST['users_surname'];
$kullanici_gsm = $kullanici_bilgileri['users_phone'];
$kullanici_mail = $kullanici_bilgileri['users_mail'];
$kullanici_zaman = $siparis['siparis_tarih'];
$kullanici_adresiyaz = $_POST['siparis_adres'];
$kullanici_il = $_POST['siparis_adres'];
$kullanici_ip = $_POST['ip_adresi'] ;
$siparis_no = $siparis_bilgileri['id'];
$sepettoplam = $_POST['sepet_toplam'];
require_once 'iyzico/buyer.php';
?>