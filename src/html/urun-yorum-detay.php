<?php 
if (!isset($_GET['id'])) {
	header("location:urun-yorumlari.php");
	exit;
} ?>
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
	<script src="../dist/ckeditor/ckeditor.js"></script>
</head>

<body>

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
							<h3 class="card-title">Yorum detayları</h3><br> 
							<?php  
							if (isset($_POST['yorumguncelle'])) { 
								$yorumguncelle = $db->update("urun_yorumlar",$_POST,[
									"columns" => "id",
									"form_name" => "yorumguncelle"
									]);
								if ($yorumguncelle['status']) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> Yorum başarıyla güncellendi.
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
							$urun_yorum = $db->wread("urun_yorumlar","id",$_GET['id']);
							$kullanici = $db->wread("users","users_id",$urun_yorum['users_id']);
							$urun = $db->wread("urun","urun_id",$urun_yorum['urun_id']);
							$kategori = $db->wread("kategori","kategori_id",$urun['kategori_id']);  
							?>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="container-fluid">
									<div class="row">
										<div class="card-body"> 
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Ad Soyad</label></div>
													<input class="form-control" disabled="" type="text" value="<?php echo $kullanici['users_namesurname'] ?>">
												</div>
											</div>  
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Yorum Tarihi</label></div>
													<input class="form-control" disabled="" type="text" value="<?php echo $urun_yorum['yorum_tarih'] ?>" >
												</div>
											</div> 
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>İP Adresi</label></div>
													<input class="form-control" disabled="" type="text" value="<?php echo $urun_yorum['ip_adresi'] ?>" >
												</div>
											</div>  
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Ürün linki</label></div>
													<div align="center">
														<a href="<?php echo $_SERVER['SERVER_NAME'].'/'.$kategori['kategori_seourl'].'/'.$urun['urun_seourl'] ?>">Ürün Linki</a>
													</div>
												</div>
											</div>  
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Yorum</label></div>
													<textarea disabled="" class="form-control"><?php echo $urun_yorum['yorum']; ?></textarea>
												</div>
											</div>    
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Yorum Durumu</label>
														<div class="col-md-8 m-auto">
															<div class="custom-control custom-radio">
																<input type="radio" id="customRadio3" name="yorum_durumu" value="1" 
																class="custom-control-input" <?php 
																if ($urun_yorum['yorum_durumu']==1) {
																	echo "checked";
																}
																?>>
																<label class="custom-control-label" for="customRadio3">Aktif</label>
															</div>
															<div class="custom-control custom-radio">
																<input type="radio" id="customRadio4" name="yorum_durumu" value="0" 
																class="custom-control-input" <?php 
																if ($urun_yorum['yorum_durumu']==0) {
																	echo "checked";
																}
																?>>
																<label class="custom-control-label" for="customRadio4">Pasif</label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div align="center" class="box-footer">
												<input type="hidden" name="id" value="<?php echo $urun_yorum['id'] ?>">
												<input type="submit" class="btn btn-success" name="yorumguncelle" value="Kaydet">
												<a href="urun-yorumlari.php?urun_yorum_sil=<?php echo $urun_yorum['id']; ?>"><button type="button" class="btn btn-danger">Yorumu Sil</button>
												</a>
											</div>
										</div>
									</div>
								</div>
							</form> 
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