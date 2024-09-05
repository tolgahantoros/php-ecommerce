<?php 
if (!isset($_GET['id'])) {
	header("location:kupon-kodlari.php");
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
							<h3 class="card-title">Kupon Kodu Düzenle</h3><br> 
							<?php  
							if (isset($_POST['kuponguncelle'])) { 
								$kupon_guncelle = $db->update("kupon_kodu",$_POST,[
									"columns" => "id",
									"form_name" => "kuponguncelle"
									]);
								if ($kupon_guncelle['status']) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> Kupon kodu başarıyla güncellendi.
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
							$kupon_kodu = $db->wread("kupon_kodu","id",$_GET['id']);
							?>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="container-fluid">
									<div class="row">
										<div class="card-body"> 
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Kupon Kodu</label></div>
													<input class="form-control" type="text" value="<?php echo $kupon_kodu['kupon_kodu'] ?>" name="kupon_kodu" placeholder="Kupon Kodu" required="">
												</div>
											</div> 
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>İndirim Oranı</label></div>
													<input type="number" required="" value="<?php echo $kupon_kodu['indirim_orani'] ?>" min="0" max="100" name="indirim_orani" placeholder="İndirim Oranı" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>İndirim Koşulu (Bu fiyattan yukarısı için sepet indirimi yap)</label></div>
													<input type="number" required="" min="0" value="<?php echo $kupon_kodu['indirim_kosulu'] ?>" name="indirim_kosulu" placeholder="İndirim Koşulu" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Kupon Kodu Sayısı</label></div>
													<input type="number" required="" min="0" value="<?php echo $kupon_kodu['kupon_sayisi'] ?>" name="kupon_sayisi" placeholder="Kupon Kodu Sayısı" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center">
														<label>Kupon Kodu Son Tarihi</label><br>
														<label><?php echo $kupon_kodu['kupon_sontarih'] ?></label>
													</div>
													<input type="datetime-local" required="" value="<?php echo $kupon_kodu['kupon_sontarih'] ?>" name="kupon_sontarih" placeholder="Kupon Kodu Sayısı" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>İndirimde Olan ürünlere ek olarak kod indirimi uygulansın mı?</label>
														<div class="col-md-8 m-auto">
															<div class="custom-control custom-radio">
																<input type="radio" id="customRadio33" name="indirim_kosulu2" value="1" 
																class="custom-control-input" <?php 
																if ($kupon_kodu['indirim_kosulu2']==1) {
																	echo "checked";
																}
																?>>
																<label class="custom-control-label" for="customRadio33">Evet</label>
															</div>
															<div class="custom-control custom-radio">
																<input type="radio" id="customRadio44" name="indirim_kosulu2" value="0" 
																class="custom-control-input" <?php 
																if ($kupon_kodu['indirim_kosulu2']==0) {
																	echo "checked";
																}
																?>>
																<label class="custom-control-label" for="customRadio44">Hayır</label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Kupon Kodu Durumu</label>
														<div class="col-md-8 m-auto">
															<div class="custom-control custom-radio">
																<input type="radio" id="customRadio3" name="kupon_durum" value="1" 
																class="custom-control-input" <?php 
																if ($kupon_kodu['kupon_durum']==1) {
																	echo "checked";
																}
																?>>
																<label class="custom-control-label" for="customRadio3">Aktif</label>
															</div>
															<div class="custom-control custom-radio">
																<input type="radio" id="customRadio4" name="kupon_durum" value="0" 
																class="custom-control-input" <?php 
																if ($kupon_kodu['kupon_durum']==0) {
																	echo "checked";
																}
																?>>
																<label class="custom-control-label" for="customRadio4">Pasif</label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div align="right" class="box-footer">
												<input type="hidden" name="id" value="<?php echo $kupon_kodu['id'] ?>">
												<input type="submit" class="btn btn-success" name="kuponguncelle" value="Kaydet">
												<a href="kupon-kodlari.php"><button type="button" class="btn btn-secondary">Geri Dön</button>
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