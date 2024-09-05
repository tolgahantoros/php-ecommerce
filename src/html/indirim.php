<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Meü Ceng Admin</title>
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
							<h3 class="card-title">Ana Sayfa Indirim Kartı</h3><br>
							<?php
							if (isset($_POST['kartguncelle'])) {
								$kartguncelle = $db->update("indirim",$_POST,[
									"form_name" => "kartguncelle",
									"columns" => "id"
									]); 
								if ($kartguncelle['status']) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> İndirim Kartı Başarıyla Güncellendi.
									</div>
									<?php
								}else{
									?>
									<div class="alert alert-danger" role="alert">
										<strong>Hata - </strong> <?php echo $kartguncelle['error']; ?>
									</div>
									<?php
								}
							}
							if ($_GET['kart_sifirla']==1) {
								unset($_POST);
								$_POST['aciklama'] = "";
								$_POST['sure'] = "0000-00-00 00:00:00";
								$_POST['buton_adi'] = "";
								$_POST['buton_link'] = "";
								$_POST['durum'] = 0;
								$_POST['id'] = 1;
								$kartguncelle = $db->update("indirim",$_POST,[ 
									"columns" => "id"
									]); 
								if ($kartguncelle['status']) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> İndirim Kartı Başarıyla Sıfırlandı.
									</div>
									<?php
								}else{
									?>
									<div class="alert alert-danger" role="alert">
										<strong>Hata - </strong> <?php echo $kartguncelle['error']; ?>
									</div>
									<?php
								}
							}




							$countdown_sor = $db->read("indirim");
							$countdown_cek = $countdown_sor->fetch(PDO::FETCH_ASSOC); 

							?>
							<div align="center">
								<form method="POST" action=""> 
									<div class="form-group">
										<div class="col-md-12 m-auto">
											<div align="center"><label>Kart Başlığı</label></div>
											<input type="text" required="" name="aciklama" value="<?php echo $countdown_cek['aciklama'] ?>" placeholder="Kart Başlığını Giriniz." class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12 m-auto">
											<div align="center"><label>İndirim Bitiş Süresi</label></div>
											<input type="datetime-local" step="1" required="" value="<?php echo $countdown_cek['sure'] ?>" name="sure" placeholder="İndirim Bitiş Süresini Giriniz." class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12 m-auto">
											<div align="center"><label>Buton Adı</label></div>
											<input type="text" required="" value="<?php echo $countdown_cek['buton_adi'] ?>" name="buton_adi" placeholder="Buton Adını Giriniz." class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12 m-auto">
											<div align="center"><label>Buton Linki</label></div>
											<input type="text" required="" value="<?php echo $countdown_cek['buton_link'] ?>" name="buton_link" placeholder="Buton Linkini Giriniz." class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12 m-auto">
											<div align="center"><label>Kart Durumu</label></div>
											<select name="durum" class="form-control">
												<?php 
												if ($countdown_cek['durum']=="1") { ?>
												<option selected value="1">Aktif</option>
												<option value="0">Pasif</option>
												<?php }else{ ?>
												<option value="1">Aktif</option>
												<option selected value="0">Pasif</option>
												<?php } ?>
											</select>
										</div>
									</div>
									<input type="hidden" name="id" value="1">
									<button type="submit" name="kartguncelle" class="btn btn-outline-success">Güncelle</button>
									<a class="btn btn-outline-danger" href="?kart_sifirla=1">Kartı Sıfırla</a> 
								</form>
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