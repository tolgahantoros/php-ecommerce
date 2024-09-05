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
							<h3 class="card-title">Head Tagları Arası</h3><br>
							<div class="form-group" align="center">
							<?php 
							if (isset($_POST['guncelle'])) {
								$guncelle=$db->update("kodekle",$_POST,[
									"form_name" => "guncelle",
									"columns" => "id",
									"kod" => "kod"
									]);
								if ($guncelle['status']) {
										?>
										<div class="alert alert-success" role="alert">
											<strong>Tebrikler - </strong> Head Tagları Arasındaki kodlar güncellendi.
										</div>
										<?php
									}else{
										?>
										<div class="alert alert-danger" role="alert">
											<strong>Hata - </strong> <?php echo $sonuc['error']; ?>
										</div>
										<?php
									}
							}
							$kodcek=$db->wread("kodekle","id","header");
							 ?>
							<p>Head tagları arasına eklemek istediğiniz meta,cdn,script,google-yandex onay vb. kodları aşağıdaki metine ekleyebilirsiniz.(Maksimum 5 bin karakter.)</p><br>
							<form method="POST" action="">
								<textarea name="kod" rows="10" style="width: 80%;"><?php echo $kodcek['kod'] ?></textarea><br><br>
								<input type="hidden" name="id" value="header">
								<input type="submit" class="btn btn-success" name="guncelle" value="Kodları Güncelle">
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