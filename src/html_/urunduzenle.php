<?php 
if (!isset($_GET['urun_id'])) {
	header("location:urunler.php");
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
							<h3 class="card-title">Ürün Düzenle</h3><br> 
							<?php 
							if(isset($_POST['urunguncelle'])){ 
								if (strstr($_POST['urun_ad'],".")) {
									?>
									<div class="alert alert-danger" role="alert">
										<strong>HATA - </strong> Ürün adında ' . '(Nokta) bulunamaz.
									</div>
									<?php 
								}else{
									
									if (!empty($_FILES['urun_file']['name'])) { 
										$ext=strtolower(substr($_FILES['urun_file']['name'], strpos($_FILES['urun_file']['name'],'.')));
										$_FILES['urun_file']['name'] = $_POST['urun_ad'].$ext;  
									}

									if ($_POST['urun_seourl']!=$_POST['urun_eski_seourl']) {
										// seo url değiştirildiyse güncelle 
										$_POST['urun_seourl'] = $_POST['urun_seourl']."-p-".rand("10000000","99999999"); 
									}else{
										// seo url değiştirilmediyse değişkeni sil
										unset($_POST['urun_seourl']);
									}

									unset($_POST['urun_eski_seourl']);
									
									$urunguncelle=$db->update("urun",$_POST,[
										"form_name" => "urunguncelle",
										"columns" => "urun_id",
										"dir" => "urun",
										"file_name" => "urun_file",
										"file_delete" => "delete_file"
										]);
									
								}
								if ($urunguncelle) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> Ürün Başarıyla Güncellendi.
									</div>
									<?php
								}else{
									?>
									<div class="alert alert-error" role="alert">
										<strong>HATA - </strong> Ürün Güncellenirken Bir Sorun Oluştu.
									</div>
									<?php
								}
							}
							$uruncek=$db->wread2("urun","urun_id",$_GET['urun_id']);
							$satir=$uruncek->fetch(PDO::FETCH_ASSOC); 
							?>
							<form action="" method="POST" enctype="multipart/form-data">
								<div class="container-fluid">
									<div class="row">
										<div class="card-body"> 
											<div class="form-group">
												<div class="col-md-8 m-auto">
													<div align="center"><label>Ürün Kategorisi</label></div>
													<select class="form-control" name="kategori_id">
														<?php 
														$kategorisor=$db->read("kategori",[
															"columns_name" => "kategori_ad",
															"columns_sort" => "ASC"
															]);
														while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { 
															?>
															<option <?php if($kategoricek['kategori_id']==$satir['kategori_id']){ echo "selected ";} ?> value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-8 m-auto">
														<div align="center"><label>Ürün Türü</label></div>
														<select class="form-control" name="urun_tur">
															<?php 
															$urunturusor=$db->read("urun_turleri",[
																"columns_name" => "urun_turu",
																"columns_sort" => "ASC"
																]);
															while ($urunturucek=$urunturusor->fetch(PDO::FETCH_ASSOC)) { 
																?>
																<option <?php if($urunturucek['id']==$satir['urun_tur']){ echo "selected ";} ?> value="<?php echo $urunturucek['id'] ?>"><?php echo $urunturucek['urun_turu'] ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-8 m-auto">
															<div align="center"><label>Ürünün Sayfa Başlığı</label></div>
															<input type="text" required="" name="urun_title" value="<?php echo $satir['urun_title'] ?>" placeholder="Ürünün Sayfa Başlığı" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-8 m-auto">
															<div align="center"><label>Ürünün Sayfa Açıklaması</label></div>
															<input type="text" required="" name="urun_description" value="<?php echo $satir['urun_description'] ?>" placeholder="Ürünün Sayfa Açıklaması" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-8 m-auto">
															<div align="center"><label>Ürünün SEO URL'si(Güncellenmesini istiyorsanız-p- ve sonrasını silmelisiniz)</label></div>
															<input type="text" required="" name="urun_seourl" value="<?php echo $satir['urun_seourl'] ?>" placeholder="Ürünün SEO URL'si" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-8 m-auto">
															<div align="center"><label>Ürün Adı</label></div>
															<input type="text" required="" name="urun_ad" value="<?php echo $satir['urun_ad'] ?>" placeholder="Ürün adı" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-8 m-auto">
															<div align="center"><label>Ürün Cinsiyeti</label></div>
															<select name="urun_cinsiyet" class="form-control">
																<option <?php if ($satir['urun_cinsiyet']=="erkek") {
																	echo "selected";
																} ?> value="erkek">Erkek</option> 
																<option <?php if ($satir['urun_cinsiyet']=="kadın") {
																	echo "selected";
																} ?> value="kadın">Kadın</option> 
																<option <?php if ($satir['urun_cinsiyet']=="unisex") {
																	echo "selected";
																} ?> value="unisex">Unisex</option> 
															</select>
														</div>
													</div>

													<div class="form-group">
														<div class="col-md-12 m-auto">
															<div align="center"><label>Ürün Detayı</label></div>
															<textarea required="" name="urun_detay"><?php echo htmlspecialchars_decode($satir['urun_detay']); ?></textarea>
															<script>
																CKEDITOR.replace( 'urun_detay' );
															</script>
														</div>
													</div>
													<div align="center">
														<label>Boyut (1200x1486) Olmalı</label>
													</div>

													<div align="center" class="form-group">

														<img  width="250px;" src="../dimg/urun/<?php echo $satir['urun_file']; ?>">
													</div>
													<div style="position:relative;left: 37%;">
														<fieldset class="form-group">
															<input type="file" name="urun_file" class="form-control-file" id="exampleInputFiles">
														</fieldset>
													</div>
													<div class="form-group">
														<div class="col-md-6 m-auto">
															<div align="center"><label>Ürün Fiyatı</label></div>
															<input type="number" required="" value="<?php echo $satir['urun_fiyat'] ?>" min="0" name="urun_fiyat" placeholder="Ürün Fiyatı" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6 m-auto">
															<div align="center"><label>Ürün indirim Oranı (Yoksa 0)</label></div>
															<input type="number" required="" value="<?php echo $satir['urun_indirim'] ?>" value="0" max="99" min="0" name="urun_indirim" placeholder="Ürün İndirim Oranı" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6 m-auto">
															<div align="center"><label>Ürün Anahtar Kelimeler (Kelimeleri virgül ile ayırın.)</label></div>
															<input type="text" value="<?php echo $satir['urun_keyword'] ?>" name="urun_keyword" placeholder="Ürün Anahtar Kelimeleri" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6 m-auto">
															<div align="center"><label>Ürün Barkod</label></div>
															<input type="text" value="<?php echo $satir['urun_barkod'] ?>" name="urun_barkod" placeholder="Ürün Barkodu" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-6 m-auto">
															<div align="center"><label>Ürün Stok</label></div>
															<input type="number" required="" value="<?php echo $satir['urun_stok'] ?>" min="1" name="urun_stok" placeholder="Ürün stok sayısı" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-8 m-auto">
															<div align="center"><label>Ürünü Ana Sayfaya Çıkar</label></div>
															<div class="col-md-8 m-auto">
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio5<?php echo $satir['urun_id']; ?>" name="urun_onecikar" value="1" 
																	class="custom-control-input" <?php if ($satir['urun_onecikar']==1) {
																		echo "checked";
																	} ?> >
																	<label class="custom-control-label" for="customRadio5<?php echo $satir['urun_id']; ?>">Evet</label>
																</div>
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio6<?php echo $satir['urun_id']; ?>" name="urun_onecikar" value="0" 
																	class="custom-control-input" <?php if ($satir['urun_onecikar']==0) {
																		echo "checked";
																	} ?>>
																	<label class="custom-control-label" for="customRadio6<?php echo $satir['urun_id']; ?>">Hayır</label>
																</div>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-8 m-auto">
															<div align="center"><label>Ürün Durumu</label></div>
															<div class="col-md-8 m-auto">
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio3<?php echo $satir['urun_id']; ?>" name="urun_durum" value="1" 
																	class="custom-control-input" <?php if ($satir['urun_durum']==1) {
																		echo "checked";
																	} ?>>
																	<label class="custom-control-label" for="customRadio3<?php echo $satir['urun_id']; ?>">Aktif</label>
																</div>
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio4<?php echo $satir['urun_id']; ?>" name="urun_durum" value="0" 
																	class="custom-control-input" <?php if ($satir['urun_durum']==0) {
																		echo "checked";
																	} ?>>
																	<label class="custom-control-label" for="customRadio4<?php echo $satir['urun_id']; ?>">Pasif</label>
																</div>
															</div>
														</div>
													</div>
													<div align="center" class="box-footer">
														<input type="hidden" name="urun_eski_seourl" value="<?php echo $satir['urun_seourl'] ?>">
														<input type="hidden" name="urun_id" value="<?php echo $satir['urun_id'];?>">
														<input type="hidden" value="<?php if(isset($satir['urun_file'])){
															echo $satir['urun_file'];
														}else{echo "null";}?>" name="delete_file">
														<input type="submit" class="btn btn-success" name="urunguncelle" value="Güncelle">
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