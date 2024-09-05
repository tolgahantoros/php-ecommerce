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
	<script src="../dropzone-5.7.0/dist/dropzone.js"></script>
	<link rel="stylesheet" type="text/css" href="../dropzone-5.7.0/dist/min/dropzone.min.css">
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
							<h3 class="card-title">Video Ekle</h3><br>
							<?php 
							if (isset($_POST['videoekle'])) {
								$videoekle = $db->insert("videogaleri",$_POST,[
									"form_name" => "videoekle"
									]);
								if ($videoekle) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> Video Başarıyla eklendi.
									</div>
									<?php
								}else{
									?>
									<div class="alert alert-error" role="alert">
										<strong>HATA - </strong> Video Eklenirken Bir Sorun Oluştu.
									</div>
									<?php
								}
							}
							?>
							<form action="" method="POST">
								<div class="container-fluid">
									<div class="row">
										<div class="card-body"> 
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Video Kodu</label></div><p>Video kodu youtube video linkinde bulnan koddur. Örnek verecek olursak https://www.youtube.com/watch?v=bKDdT_nyP54&list=LL&index=3&ab_channel=AkonVEVO Linkinin video kodu watch?v= değerinden sonra gelen ve &list değerine kadar olan yazıdır. yani bu videonun kodu bKDdT_nyP54 değeridir.</p>
													<div align="center">
														<input type="text" name="video_url" placeholder="Video Kodu">
													</div>
												</div>
											</div>  
											<div align="center">
												<input type="submit" class="btn btn-success" name="videoekle">
												<a href="videogaleri.php"><button type="button" class="btn btn-secondary">Video Galerisine Dön</button>
												</a>
											</div>
										</div>
									</div>
								</div>
							</form><br>

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