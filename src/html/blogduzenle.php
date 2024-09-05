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
							<h3 class="card-title">Blog Düzenle</h3><br> 
							<?php 
							if(isset($_POST['blogupdate'])){ 
								$sonuc = $db->update("blogs",$_POST,[
									"form_name" => "blogupdate",
									"columns" => "blogs_id",
									"dir" => "blogs",
									"file_name" => "blogs_file",
									"file_delete" => "delete_file" 
									]);
								if ($sonuc['status']) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> Blog Başarıyla Güncellendi.
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
							$blogcek=$db->wread2("blogs","blogs_id",$_GET['blogs_id']);
							$satir=$blogcek->fetch(PDO::FETCH_ASSOC);

							?>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="container-fluid">
									<div class="row">
										<div class="card-body"> 
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Blog Title</label></div>
													<input type="text" required="" name="blogs_title" value="<?php echo $satir['blogs_title'] ?>" placeholder="Blog title'i" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Blog Keywords</label></div>
													<input type="text" required="" name="blogs_keywords" value="<?php echo $satir['blogs_keywords'] ?>" placeholder="Blog Keywords" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Blog Description(Max. 255)</label></div>
													<textarea maxlength="255" rows="6" class="form-control" name="blogs_description"><?php echo $satir['blogs_description'] ?></textarea>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-12 m-auto">
													<div align="center"><label>Blog Yazısı</label></div>
													<textarea name="blogs_makale"><?php echo $satir['blogs_makale']; ?></textarea>
													<script>
														CKEDITOR.replace( 'blogs_makale' );
													</script>
												</div>
											</div>
											<div align="center" class="form-group">
												<img  width="250px;" src="../dimg/blogs/<?php echo $satir['blogs_file']; ?>">
											</div>
											<div style="position:relative;left: 37%;">
												<fieldset class="form-group">
													<input type="file" name="blogs_file" class="form-control-file" id="exampleInputFile">
												</fieldset>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Blog Kategorisi</label></div>
													<input type="text" required="" value="<?php echo $satir['blogs_kategori']; ?>" name="blogs_kategori" placeholder="Yazının kategorisini girin." class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Blog Etiketleri</label></div>
													<input type="text" required="" name="blogs_etiket" value="<?php echo $satir['blogs_etiket']; ?>" placeholder="Blog için etiketler girin." class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Blog Yazarı</label></div>
													<input type="text" required="" value="<?php echo $satir['blogs_yazar']; ?>" name="blogs_yazar" placeholder="Yazının kategorisini girin." class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Blog Öne Çıkar</label></div>
													<div class="col-md-8 m-auto">
														<div class="custom-control custom-radio">
															<input type="radio" id="customRadio5<?php echo $satir['blogs_id']; ?>" name="blogs_onecikar" value="1" 
															class="custom-control-input" <?php if ($satir['blogs_onecikar']==1) {
																echo "checked";
															} ?> >
															<label class="custom-control-label" for="customRadio5<?php echo $satir['blogs_id']; ?>">Evet</label>
														</div>
														<div class="custom-control custom-radio">
															<input type="radio" id="customRadio6<?php echo $satir['blogs_id']; ?>" name="blogs_onecikar" value="0" 
															class="custom-control-input" <?php if ($satir['blogs_onecikar']==0) {
																echo "checked";
															} ?>>
															<label class="custom-control-label" for="customRadio6<?php echo $satir['blogs_id']; ?>">Hayır</label>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Blog Durumu</label></div>
													<div class="col-md-8 m-auto">
														<div class="custom-control custom-radio">
															<input type="radio" id="customRadio3<?php echo $satir['blogs_id']; ?>" name="blogs_status" value="1" 
															class="custom-control-input" <?php if ($satir['blogs_status']==1) {
																echo "checked";
															} ?>>
															<label class="custom-control-label" for="customRadio3<?php echo $satir['blogs_id']; ?>">Aktif</label>
														</div>
														<div class="custom-control custom-radio">
															<input type="radio" id="customRadio4<?php echo $satir['blogs_id']; ?>" name="blogs_status" value="0" 
															class="custom-control-input" <?php if ($satir['blogs_status']==0) {
																echo "checked";
															} ?>>
															<label class="custom-control-label" for="customRadio4<?php echo $satir['blogs_id']; ?>">Pasif</label>
														</div>
													</div>
												</div>
											</div>
											<div align="center" class="box-footer">
												<input type="hidden" name="blogs_id" value="<?php echo $satir['blogs_id'];?>">
												<input type="hidden" value="<?php if(isset($satir['blogs_file'])){
													echo $satir['blogs_file'];
												}else{echo "null";}?>" name="delete_file">
												<input type="submit" class="btn btn-success" name="blogupdate" value="Güncelle">
												<a href="blogs.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
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