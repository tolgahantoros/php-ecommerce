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
							<h3 class="card-title">Email Marketing</h3><br>
							<?php 
							if ($_GET['gorev']=="aktifet") {
								$karalisteguncelle=$db->update("mailmarketing",[
									"id" => $_GET['karaliste'],
									"durum" => 1
									],[
									"columns" => "id"
									]);
							}
							if ($_GET['gorev']=="pasifet") {
								$karalisteguncelle=$db->update("mailmarketing",[
									"id" => $_GET['karaliste'],
									"durum" => 0
									],[
									"columns" => "id"
									]);
							}
							?>
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered no-wrap">
									<thead>
										<tr>
											<th>#</th>
											<th>Ad Soyad</th>
											<th>Kullanıcı Mail</th>
											<th>Durum</th>
										</tr>
									</thead>
									<tbody> 
										<?php 
										$mailcek=$db->read("mailmarketing");
										$say = 0;
										while ($satir=$mailcek->fetch(PDO::FETCH_ASSOC)) {
											$say++;
											?>
											<tr>
												<td><?php echo $say ?></td>
												<td><?php echo $satir['ad_soyad'] ?></td>
												<td><?php echo $satir['mail'] ?></td>
												<td align="center">
													<?php 
													if($satir['durum']==1){
														?>
														<a href="?karaliste=<?php echo $satir['id']; ?>&gorev=pasifet">
															<button type="button" class="btn btn-success btn-rounded">İletilecek</button>
														</a>
														<?php
													}else{
														?> 
														<a href="?karaliste=<?php echo $satir['id']; ?>&gorev=aktifet">
															<button type="button" class="btn btn-danger btn-rounded">İletilmeyecek</button>
														</a>
														<?php } ?>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
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