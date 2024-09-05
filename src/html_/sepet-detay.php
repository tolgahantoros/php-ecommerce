<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
	<title>OG - Admin Paneli</title>
	<link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
	<link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
	<link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<link href="../dist/css/style.min.css" rel="stylesheet">
	<link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
</head>

<body>
	<!-- <div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div> -->
	<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
	data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
	<?php require_once 'header.php'; ?>
	<?php require_once 'sidebar.php'; 
	if (empty($_GET['siparis'])) {
		header("location:siparisler.php");
		exit;
	}
	?>
	<div class="page-wrapper"> 
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h3 class="card-title">Müşterinin Sepet Detayı</h3><br> 
							<?php 


							$siparis_cek = $db->wread2("sepet","id",$_GET['siparis']);
							$siparis_cek = $siparis_cek->fetch(PDO::FETCH_ASSOC);

							$musteri_cek = $db->wread2("users","users_id",$siparis_cek['users_id']);
							$musteri_cek = $musteri_cek->fetch(PDO::FETCH_ASSOC);
							?>
							<div align="center">
								<h4 class="card-title">Müşteri Bilgileri: </h4><br> 
								Adı : <?php echo $musteri_cek['users_namesurname'] ?><br>
								Telefon : <?php echo $musteri_cek['users_phone'] ?><br>
								Mail : <?php echo $musteri_cek['users_mail'] ?><br>
								Cinsiyet : <?php echo $musteri_cek['users_gender'] ?><br><br><br>
								<h4 class="card-title">Sipariş Bilgileri: </h4><br> 
								<?php 

								$urunler = htmlspecialchars_decode($siparis_cek['urunler_id']);
								$urunler = json_decode($urunler); 
								$sayac=1;
								foreach ($urunler as $key => $value) {
									echo $sayac.". Ürünün Detayları : <br>";
									$uruncek = $db->wread2("urun","urun_id",$key);
									$uruncek = $uruncek->fetch(PDO::FETCH_ASSOC); 
									$kategoricek = $db->wread2("kategori","kategori_id",$uruncek['kategori_id']);
									$kategoricek = $kategoricek->fetch(PDO::FETCH_ASSOC);
									echo "Ürün adı : ".$uruncek['urun_ad']."<br>"; 
									echo "Ürün Fiyatı : ".$uruncek['urun_fiyat']."<br>"; 
									$indirimli_fiyat = $uruncek['urun_fiyat']*(100-$uruncek['urun_indirim'])/100;
									echo "Ürün <b>İndirimli</b> : ".$indirimli_fiyat."<br>"; 
									echo "Sipariş Adeti : ".$value."<br>";  
									echo "Ürün URL: <a href=".$_SERVER['HTTP_HOST']."/".$kategoricek['kategori_seourl']."/".$uruncek['urun_seourl'].">ÜRÜNÜ GÖRMEK İÇİN TIKLAYIN</a> "; 
									echo "<br><br>";
									$sayac++;
								}
								?> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require_once 'footer.php'; ?>
	</div>
</div>

<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<!-- apps -->
<script src="../dist/js/app-style-switcher.js"></script>
<script src="../dist/js/feather.min.js"></script>
<script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="../dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="../dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="../assets/extra-libs/c3/d3.min.js"></script>
<script src="../assets/extra-libs/c3/c3.min.js"></script>
<script src="../assets/libs/chartist/dist/chartist.min.js"></script>
<script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>
<script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>

</body>

</html>