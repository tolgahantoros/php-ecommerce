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
    						<div class="row">
    							<div class="col-12">
    								<div class="card">
    									<div class="card-body">
    										<div class="d-flex align-items-center mb-4">
    											<h3 class="card-title">Banka Hesapları</h3>
    											<div style="position: relative;top: 3%;left: 60%;">
    												<a  data-toggle="collapse" href="#blogekle"
    												aria-expanded="false" aria-controls="blogekle">
    												<button type="button" class="btn btn-outline-success"><i
    													class="fa fa-plus"></i> Banka Hesabı Ekle</button>
    												</a>
    											</div>
    										</div>
    										<?php 
    										if ($_POST['bankaekle']) {

    											$bankaekle=$db->insert("banka",$_POST,[
    												"form_name" => "bankaekle"
    												]);
    											if ($bankaekle['status']){
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Yeni Banka Hesabı Başarıyla Eklendi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $bankaekle['error']; ?>
    												</div>
    												<?php 
    											} 
    										}
    										if ($_POST['bankaguncelle']) {
    											$bankaguncelle=$db->update("banka",$_POST,[
    												"form_name" => 'bankaguncelle',
    												"columns" => "banka_id"
    												]);
    											if ($bankaguncelle['status']){
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Banka Hesabı Başarıyla Güncellendi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $kategoriekle['error']; ?>
    												</div>
    												<?php 
    											} 
    										}
    										if ($_GET['banka_sil']) {
    											$bankasil=$db->delete("banka","banka_id",$_GET['banka_sil']);
    											if ($bankasil['status']){
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Banka Hesabı Başarıyla Silindi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $kategoriekle['error']; ?>
    												</div>
    												<?php 
    											} 
    										}
    										?>
    										<div class="collapse" id="blogekle">
    											<div class="card card-body">
    												<form action="" method="POST" enctype="multipart/form-data">
    													<div class="container-fluid">
    														<div class="row">
    															<div class="card-body"> 
    																<div class="form-group">
    																	<div class="col-md-8 m-auto">
    																		<div align="center"><label>Banka Adı</label></div>
    																		<input class="form-control" type="text" name="banka_ad" placeholder="Banka Adı" required="">
    																	</div>
    																</div> 
    																<div class="form-group">
    																	<div class="col-md-8 m-auto">
    																		<div align="center"><label>IBAN Numara</label></div>
    																		<input type="text" required="" value="TR" name="banka_iban" placeholder="İban Numaranız" class="form-control">
    																	</div>
    																</div>
    																<div class="form-group">
    																	<div class="col-md-8 m-auto">
    																		<div align="center"><label>Hesap Sahibi Ad Soyadı</label></div>
    																		<input type="text" required="" name="banka_hesapadsoyad" placeholder="Hesap Sahibi Ad Soyadı" class="form-control">
    																	</div>
    																</div>
    																<div class="form-group">
    																	<div class="col-md-8 m-auto">
    																		<div align="center"><label>Hesap Durumu</label>
    																			<div class="col-md-8 m-auto">
    																				<div class="custom-control custom-radio">
    																					<input type="radio" id="customRadio3" name="banka_durum" value="1" 
    																					class="custom-control-input" checked>
    																					<label class="custom-control-label" for="customRadio3">Aktif</label>
    																				</div>
    																				<div class="custom-control custom-radio">
    																					<input type="radio" id="customRadio4" name="banka_durum" value="0" 
    																					class="custom-control-input">
    																					<label class="custom-control-label" for="customRadio4">Pasif</label>
    																				</div>
    																			</div>
    																		</div>
    																	</div>
    																</div>
    																<div align="right" class="box-footer">
    																	<input type="submit" class="btn btn-success" name="bankaekle" value="Kaydet">
    																	<a href="blogs.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
    																	</a>
    																</div>
    															</div>
    														</div>
    													</div>
    												</form>
    											</div>
    										</div>
    										<div class="table-responsive">
    											<table id="zero_config" class="table table-striped table-bordered no-wrap">
    												<thead>
    													<tr> 
    														<th>Banka Adı</th>
    														<th>Ad Soyad</th>
    														<th>IBAN</th>
    														<th>Düzenle</th>
    														<th>Sil</th>
    													</tr>
    												</thead>
    												<tbody> 
    													<?php 
    													$bankasor = $db->read("banka","banka_id",[
    														"columns" => "banka_id",
    														"columns_sort" => "ASC"
    														]);
    													while ($bankacek=$bankasor->Fetch(PDO::FETCH_ASSOC)) {
    														?> 
    														<tr>
    															<td><?php echo $bankacek['banka_ad'] ?></td>
    															<td><?php echo $bankacek['banka_hesapadsoyad'] ?></td>
    															<td><?php echo $bankacek['banka_iban'] ?></td> 
    															<td align="center"><a  data-toggle="collapse" href="#duzenle<?php echo $bankacek['banka_id']?>"
    																aria-expanded="false" aria-controls="duzenle<?php echo $bankacek['banka_id']?>">
    															</div> 
    															<button type="button" class="btn btn-outline-success" data-toggle="modal"
    															data-target="#duzenle<?php echo $bankacek['banka_id'] ?>"><i class="fas fa-cogs"></i></button>
    														</div>
    													</a> 
    													<div id="duzenle<?php echo $bankacek['banka_id'] ?>" class="modal fade" tabindex="-1" role="dialog"
    														aria-hidden="true">
    														<div class="modal-dialog">
    															<div class="modal-content">
    																<div class="modal-body">
    																	<div class="text-center mt-2 mb-4">
    																		<a href="index.html" class="text-success">
    																			<span><img class="mr-2" src="../assets/images/logo-icon.png"
    																				alt="" height="18"><img
    																				src="../assets/images/logo-text.png" alt=""
    																				height="18"></span>
    																			</a>
    																		</div>
    																		<form method="POST" action="">
    																			<div class="form-group">
    																				<div class="col-md-8 m-auto">
    																					<div align="center"><label>Banka Adı</label></div>
    																					<input class="form-control" type="text" name="banka_ad" placeholder="Banka Adı" value="<?php echo $bankacek['banka_ad'] ?>" required="">
    																				</div>
    																			</div> 
    																			<div class="form-group">
    																				<div class="col-md-8 m-auto">
    																					<div align="center"><label>IBAN Numara</label></div>
    																					<input type="text" required="" value="<?php echo $bankacek['banka_iban'] ?>" name="banka_iban" placeholder="İban Numaranız" class="form-control">
    																				</div>
    																			</div>
    																			<div class="form-group">
    																				<div class="col-md-8 m-auto">
    																					<div align="center"><label>Hesap Sahibi Ad Soyadı</label></div>
    																					<input type="text" required="" value="<?php echo $bankacek['banka_hesapadsoyad'] ?>" name="banka_hesapadsoyad" placeholder="Hesap Sahibi Ad Soyadı" class="form-control">
    																				</div>
    																			</div>
    																			<div class="form-group">
    																				<div class="col-md-8 m-auto">
    																					<div align="center"><label>Hesap Durumu</label></div>
    																					<div class="col-md-8 m-auto">
    																						<div class="custom-control custom-radio">
    																							<input type="radio" <?php 
    																							if ($bankacek['banka_durum']==1) {
    																								echo "checked";
    																							}
    																							?> id="customRadio13<?php echo $bankacek['banka_id']?>" name="banka_durum" value="1" 
    																							class="custom-control-input">
    																							<label class="custom-control-label" for="customRadio13<?php echo $bankacek['banka_id']?>">Aktif</label>
    																						</div>
    																						<div class="custom-control custom-radio">
    																							<input <?php 
    																							if ($bankacek['banka_durum']==0) {
    																								echo "checked";
    																							}
    																							?> type="radio" id="customRadio14<?php echo $bankacek['banka_id']?>"  name="banka_durum" value="0"  
    																							class="custom-control-input">
    																							<label class="custom-control-label" for="customRadio14<?php echo $bankacek['banka_id']?>">Pasif</label>
    																						</div>
    																					</div>
    																				</div>
    																			</div>
    																			<div align="right" class="box-footer">
    																				<input type="hidden" name="banka_id" value="<?php echo $bankacek['banka_id'] ?>">
    																				<input type="submit" class="btn btn-success" name="bankaguncelle" value="Kaydet">
    																				<a href="blogs.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
    																				</a>
    																			</div>
    																		</form>
    																	</div>
    																</div>
    															</div>
    														</div></td> 
    														<td align="center"><a class="btn btn-outline-danger" href="?banka_sil=<?php echo $bankacek['banka_id'] ?>"><i class="far fa-trash-alt"></i></a></td>
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