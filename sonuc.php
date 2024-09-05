<?php
ob_start();
session_start();
require_once 'tema/header.php';
require_once('iyzico/config.php');

$token=$_POST['token'];
$siparis_no=$_GET['siparis_no'];


$request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setConversationId("$siparis_no");
$request->setToken("$token");
$checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, Config::options());

//print_r($checkoutForm->getStatus());
$odeme_durum=$checkoutForm->getPaymentStatus(); 
$islem_no=$checkoutForm->getpaymentId();

?> 


<section class="bg0 p-t-75 p-b-120">
	<?php


	if ($odeme_durum=="FAILURE") {

		?> 
		<div class="sec-banner bg0 p-t-80 p-b-50">
			<div class="container">
				<div align="center"> 
					<h1>Hata! Ödeme işleminiz başarısız. Lütfen siparişi tekrar deneyin.✖️</h1> 
				</div>
			</div>
		</div> 
		<?php


	} elseif ($odeme_durum=="SUCCESS") {


		$siparis = $db->wread2("siparisler","users_id",$_SESSION['users']['users_id'],[
			"columns_name" => "id",
			"columns_sort" => "DESC"
			]);
		$siparis = $siparis->fetch(PDO::FETCH_ASSOC);
		$siparis['siparis_islem_no'] = $islem_no;
		$siparis['siparis_odeme'] = 1;
		$guncelle = $db->update("siparisler",$siparis,[
			"columns" => "id"
			]); 


		if ($guncelle['status']) { 
			// ürünlerin stoklarınıda azalt.
			// ürünleri mail gönder ve sepeti boşalt - ödeme başarısızsa sepet boşalmamış olur
			$sayac=1;
			foreach ($_COOKIE['siteurlmiz'] as $key => $value) {



				// Ürün detayları
				$urun_no = $sayac.". Ürünün Detayları : <br>";
				$uruncek = $db->wread2("urun","urun_id",$key);
				$uruncek = $uruncek->fetch(PDO::FETCH_ASSOC); 
				$kategoricek = $db->wread2("kategori","kategori_id",$uruncek['kategori_id']);
				$kategoricek = $kategoricek->fetch(PDO::FETCH_ASSOC);
				$resim = '<img width="150" src="src/dimg/urun/'.$uruncek["urun_file"].'">'."<br>";
				$urun_ad = "Ürün adı : ".$uruncek['urun_ad']."<br>"; 
				$urun_fiyat = "Ürün Fiyatı : ".$uruncek['urun_fiyat']."<br>"; 
				$siparis_adeti = "Sipariş Adeti : ".$value."<br>"; 
				$urun_url = "Ürün URL: <a href=".$_SERVER['HTTP_HOST']."/".$kategoricek['kategori_seourl']."/".$uruncek['urun_seourl'].">ÜRÜNÜ GÖRMEK İÇİN TIKLAYIN</a> "; 
				// Mail içeriği
				$mail_icerigi = $mail_icerigi.$urun_no.$urun_ad.$urun_fiyat.$siparis_adeti.$urun_url."<br><br>";
				$siparis_icerigi = $siparis_icerigi.$urun_no.$resim.$urun_ad.$urun_fiyat.$siparis_adeti.$urun_url."<br><br>";

				// Sipariş kadar stokları azalt

				$yeni_stok['urun_id'] = $uruncek['urun_id'];
				$yeni_stok['urun_stok'] = $uruncek['urun_stok']-$value; // value sipariş adeti
				$stok_guncelle = $db->update("urun",$yeni_stok,[
					"columns" => "urun_id"
					]);
				if ($stok_guncelle['status']) {
					$sayac++;
				}else{
					header("location:index.php?durum=hata-stok-guncellenemedi-mail-gonderilmedi");
					exit;
				}

				
			}
			$mail_gonder = $mail->mail_gonder($_SESSION['users']['users_mail'],"Siparişinizi aldık!",$mail_icerigi);
			?>
			<div class="sec-banner bg0 p-t-80 p-b-50">
				<div class="container">
					<div align="center"> 
						<h1>Tebrikler! Ödeme işleminiz başarıyla tamamlandı.✔️</h1>
						<h2>Siparişiniz :</h2>
						<p><?php echo $siparis_icerigi; ?></p>
						<h3>Tüm siparişlerinizi profilinizden takip edebilirsiniz.</h3>
					</div>
				</div>
			</div>
			<?php
			require_once 'sepet-bosalt.php';
		}
	}  
	?>

</section>
<?php 


require_once 'tema/footer.php';

?>