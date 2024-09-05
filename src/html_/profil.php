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
							<h3 class="card-title">Profiliniz</h3>
							
							<div align="center"> 
								<?php 
								if (isset($_POST['adminupdate'])){
									$sonuc = $db->update("admins",$_POST,[
										"form_name" => "adminupdate",
										"columns" => "admins_id",
										"dir" => "admins",
										"file_name" => "admins_file",
										"file_delete" => "delete_file", 
										"pass" => "admins_pass"
										]);
									if ($sonuc['status']) {
										?>
										<div class="alert alert-success" role="alert">
											<strong>Tebrikler - </strong> Hesabınız Başarıyla Güncellendi.
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
								?>
								<?php 
								$satir = $db->wread("admins","admins_id",$_SESSION['admins']['admins_id']);
								?>
								<form action="" method="POST" enctype="multipart/form-data">
									<div class="container-fluid">
										<div class="row">
											<div class="card-body">
												<p>Güncellemek istemediğiniz<br>alanları boş bırakabilirsiniz!</p>
												<div class="form-group">
													<img style="width: 20%;height: 20%;" src="../dimg/admins/<?php echo $satir['admins_file']?>">
												</div>
												<div class="form-group">
													<div class="col-md-12 m-auto">
														<div align="center"><label>Ad Soyad</label></div>
														<input type="text" required=""  name="admins_namesurname" placeholder="Ad ve Soyad Giriniz." value="<?php echo $satir['admins_namesurname']; ?>" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12 m-auto">
														<div align="center"><label>Yönetici Yönetici Adı</label></div>
														<input type="text" name="admins_username" placeholder="Yönetici Adını Giriniz." value="<?php echo $satir['admins_username']; ?>" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12 m-auto">
														<div align="center"><label>Yönetici Yeni Şifre</label></div>
														<input type="password" name="admins_pass" placeholder="Yönetici Yeni Şifresini Giriniz." class="form-control">
													</div>
												</div>
												<div style="position:relative;left: 37%;">
													<fieldset class="form-group">
														<input type="file" name="admins_file" class="form-control-file" id="exampleInputFile">
													</fieldset>
												</div>
												<div class="form-group">
													<div class="col-md-4 m-auto">
														<div align="center"><label>
															<br>Hesabınızın Durumu<br>(Hesabınızı kapattıktan sonra sadece mevcut bir yönetici tarafından açılabilir.)</label></div>
															<div class="col-md-4 m-auto">
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio3<?php echo $say ?>" name="admins_status" value="1" <?php 
																	if ($satir['admins_status']==1) {
																		?> 
																		checked
																		<?php
																	}
																	?> 
																	class="custom-control-input" >
																	<label class="custom-control-label" for="customRadio3<?php echo $say ?>">Aktif</label>
																</div>
																<div class="custom-control custom-radio">
																	<input type="radio" id="customRadio4<?php echo $say ?>" name="admins_status" value="0" <?php 
																	if ($satir['admins_status']==0) {
																		?> 
																		checked
																		<?php
																	}
																	?> 
																	class="custom-control-input">
																	<label class="custom-control-label" for="customRadio4<?php echo $say ?>">Pasif</label>
																</div>
															</div>
														</div>
													</div>
													<div align="center" class="box-footer">
														<input type="hidden" name="admins_id" value="<?php echo $satir['admins_id'];?>"> 
														<input type="hidden" value="<?php if(isset($satir['admins_file'])){
															echo $satir['admins_file'];
														}else{echo "null";}?>" name="delete_file">
														<input type="submit" class="btn btn-success" name="adminupdate" value="Güncelle">
														<a href="index.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</td> 
						</tr>
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