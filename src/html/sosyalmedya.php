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
							<h3 class="card-title">Sosyal Medya Hesapları</h3><br>
							<?php 
							if (isset($_POST['guncelle'])) {
								for ($i=1; $i < 8; $i++) { 
									$array = [
									"id" => $i,
									"url" => $_POST[$i]
									];
									$sosyalmedyaguncelle=$db->update("sosyalmedya",$array,[
										"form_name" => "guncelle",
										"columns" => "id"
										]);
								}
							}
							?>
							<div align="center">
								<form method="POST" action=""> 
									<?php 
									$urlsor = $db->read("sosyalmedya",[
										"columns_name" => "id"
										]); 
									$say = 1;
									while($urlcek=$urlsor->fetch(PDO::FETCH_ASSOC)){
										$dizi[$say] = $urlcek;
										$say++;
									}
									?>
									
									<div class="col-md-8 m-auto">
										<i class="fab fa-facebook-f"></i><br>
										<input class="form-control" type="text" name="1" value="<?php echo $dizi[1]["url"];?>" placeholder="facebook">
									</div>
									<div class="col-md-8 m-auto">
										<i class="fab fa-instagram"></i><br>
										<input class="form-control" type="text" name="2" value="<?php echo $dizi[2]["url"];?>" placeholder="instagram">
									</div>

									<div class="col-md-8 m-auto">
										<i class="fab fa-youtube"></i><br>
										<input class="form-control" type="text" name="3" value="<?php echo $dizi[3]["url"];?>" placeholder="youtube">
									</div>

									<div class="col-md-8 m-auto">
										<i class="fab fa-google-plus-g"></i><br>
										<input class="form-control" type="text" name="4" value="<?php echo $dizi[4]["url"];?>" placeholder="googleplus">
									</div>

									<div class="col-md-8 m-auto">
										<i class="fab fa-pinterest-p"></i><br>
										<input class="form-control" type="text" name="5" value="<?php echo $dizi[5]["url"];?>" placeholder="pinterest">
									</div>

									<div class="col-md-8 m-auto">
										<i class="fab fa-twitter"></i><br>
										<input class="form-control" type="text" name="6" value="<?php echo $dizi[6]["url"];?>" placeholder="twitter">
									</div>

									<div class="col-md-8 m-auto">
										<i class="fab fa-linkedin-in"></i><br>
										<input class="form-control" type="text" name="7" value="<?php echo $dizi[7]["url"];?>" placeholder="linkedin">
									</div>
									<br>
									<button type="submit" name="guncelle" class="btn btn-outline-success">Güncelle</button>
									<a class="btn btn-outline-secondary" href="mailmarketing.php">Geri Dön</a>
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