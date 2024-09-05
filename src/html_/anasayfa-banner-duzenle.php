<?php 
if (!isset($_GET['banner_id'])) {
	header("location:anasayfa-banner.php");
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
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
	<title>OG - Admin Paneli</title>
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
							<h3 class="card-title">Banner Düzenle</h3><br> 
							<?php 
							if(isset($_POST['bannerguncelle'])){   
								$bannerguncelle=$db->update("anasayfa_banner",$_POST,[
									"form_name" => "bannerguncelle",
									"columns" => "id",
									"dir" => "banner",
									"file_name" => "banner_file",
									"file_delete" => "delete_file"
									]); 
								if ($bannerguncelle) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> Banner Başarıyla Güncellendi.
									</div>
									<?php
								}else{
									?>
									<div class="alert alert-error" role="alert">
										<strong>HATA - </strong> Banner Güncellenirken Bir Sorun Oluştu.
									</div>
									<?php
								}
							}
							$uruncek=$db->wread2("anasayfa_banner","id",$_GET['banner_id']);
							$satir=$uruncek->fetch(PDO::FETCH_ASSOC); 
							?>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="container-fluid">
									<div class="row">
										<div class="card-body">  
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Banner Başlık</label></div>
													<input type="text" required="" name="baslik" value="<?php echo $satir['baslik'] ?>" placeholder="Banner Başlığı" class="form-control">
												</div>
											</div>  
											<div align="center">
												<label>Boyut (1200x1486) Olmalı</label>
											</div>

											<div align="center" class="form-group">

												<img  width="250px;" src="../dimg/banner/<?php echo $satir['banner_file']; ?>">
											</div>
											<div style="position:relative;left: 37%;">
												<fieldset class="form-group">
													<input type="file" name="banner_file" class="form-control-file" id="exampleInputFiles">
												</fieldset>
											</div> 

											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Banner Açıklaması</label></div>
													<input type="text" required="" value="<?php echo $satir['aciklama'] ?>"  name="aciklama" placeholder="Banner Açıklaması" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Banner Buton Adı</label></div>
													<input type="text" required="" value="<?php echo $satir['buton'] ?>"  name="buton" placeholder="Banner Buton Adı" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Banner URL</label></div>
													<input type="text" required="" value="<?php echo $satir['url'] ?>"  name="url" placeholder="Banner URL" class="form-control">
												</div>
											</div>

											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Banner Durumu</label></div>
													<div class="col-md-8 m-auto">
														<div class="custom-control custom-radio">
															<input type="radio" id="customRadio3<?php echo $satir['id']; ?>" name="durum" value="1" 
															class="custom-control-input" <?php if ($satir['durum']==1) {
																echo "checked";
															} ?>>
															<label class="custom-control-label" for="customRadio3<?php echo $satir['id']; ?>">Aktif</label>
														</div>
														<div class="custom-control custom-radio">
															<input type="radio" id="customRadio4<?php echo $satir['id']; ?>" name="durum" value="0" 
															class="custom-control-input" <?php if ($satir['durum']==0) {
																echo "checked";
															} ?>>
															<label class="custom-control-label" for="customRadio4<?php echo $satir['id']; ?>">Pasif</label>
														</div>
													</div>
												</div>
											</div>
											<div align="center" class="box-footer">
												<input type="hidden" name="id" value="<?php echo $satir['id'];?>">
												<input type="hidden" value="<?php if(isset($satir['banner_file'])){
													echo $satir['banner_file'];
												}else{echo "null";}?>" name="delete_file">
												<input type="submit" class="btn btn-success" name="bannerguncelle" value="Güncelle">
												<a href="urunler.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
												</a>
											</div>
										</div>
									</div>
								</div> 
							</form>
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