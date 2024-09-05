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
	<?php require_once 'sidebar.php'; ?>
	<div class="page-wrapper"> 
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h3 class="card-title">Sayfa Başına Gösterilecek Ürün Sayıları</h3><br>
							<b>AnaSayfa ve Alışveriş sayfasında sayfa yapısının bozulmaması için 6'nın katı değerleri girin.</b>
							<br><br>
							<?php 
							if (isset($_POST['iceriksayisiguncelle'])) { 
								$iceriksayisiguncelle = $db->update("icerik_sayilari",$_POST,[
									"form_name" => "iceriksayisiguncelle",
									"columns" => "id"
									]);
								if ($iceriksayisiguncelle['status']) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> İçerik Sayısı Başarıyla Güncellendi.
									</div>
									<?php
								}else{
									?>
									<div class="alert alert-danger" role="alert">
										<strong>Hata - </strong> <?php echo $iceriksayisiguncelle['error']; ?>
									</div>
									<?php
								}
							}
							$icerik_sayisi_sor = $db->read("icerik_sayilari"); 
							?>
							<div align="center">
								<?php while ($icerik_sayisi_cek = $icerik_sayisi_sor->fetch(PDO::FETCH_ASSOC)) { ?>
									<form method="POST" action="">  
										<div class="form-group">
											<div class="col-md-12 m-auto">
												<div align="center"><label><?php echo $icerik_sayisi_cek['Ad'] ?> Sayfa Başına Gösterilecek Ürün Sayısı</label></div>
												<input type="number" min="1" max="50" required="" name="sayi" value="<?php echo $icerik_sayisi_cek['sayi'] ?>" placeholder="<?php echo $icerik_sayisi_cek['Ad'] ?> Sayfa Başına Gösterilecek Ürün Sayısını Giriniz." class="form-control">
											</div>
										</div> 
										<input type="hidden" name="id" value="<?php echo $icerik_sayisi_cek['id'] ?>">
										<button type="submit" name="iceriksayisiguncelle" class="btn btn-outline-success">Güncelle</button>  
									</form><br>
									<?php } ?>
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