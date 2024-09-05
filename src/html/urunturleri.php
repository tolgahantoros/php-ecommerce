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
    	<div class="page-breadcrumb">
    		<div class="row">
    			<div class="col-5 align-self-center">
    			</div>
    		</div>
    	</div>
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
    											<h3 class="card-title">Ürün Türleri</h3>
    											<div style="position: relative;top: 3%;left: 75%;">
    												<a  data-toggle="collapse" href="#blogekle"
    												aria-expanded="false" aria-controls="blogekle">
    												<button type="button" class="btn btn-outline-success"><i
    													class="fa fa-plus"></i> Ürün türü Ekle</button>
    												</a>
    											</div>
    										</div>
    										<?php 
    										if (isset($_POST['urun_turuekle'])) {
                                                $_POST['urun_turu_seourl'] = $db->seo($_POST['urun_turu']);
    											$urun_turuekle = $db->insert("urun_turleri",$_POST,[
    												"form_name" => "urun_turuekle"
    												]);

    											if ($urun_turuekle['status']){
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Yeni Ürün Türü Başarıyla Oluşturuldu.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $urun_turuekle['error']; ?>
    												</div>
    												<?php 
    											} 
    										}
    										if (isset($_POST['urun_turuguncelle'])) { 
                                                $_POST['urun_turu_seourl'] = $db->seo($_POST['urun_turu']);
    											$urun_turuguncelle=$db->update("urun_turleri",$_POST,[
    												"form_name" => "urun_turuguncelle",
    												"columns" => "id"
    												]);
    											if ($urun_turuguncelle['status']){
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Ürün Türü Başarıyla Güncellendi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $urun_turuekle['error']; ?>
    												</div>
    												<?php 
    											} 
    										}
    										if (isset($_GET['urun_turu_sil'])) {
    											$urun_turu_sil = $db->delete("urun_turleri","id",$_GET['urun_turu_sil']);
    											if ($urun_turu_sil['status']){
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Ürün Türü Başarıyla Silindi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $urun_turuekle['error']; ?>
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
    																	<div class="col-md-6 m-auto">
    																		<div align="center"><label>Ürün türü adı</label></div>
    																		<input type="text" required="" name="urun_turu" placeholder="Ürün türü Adı" class="form-control">
    																	</div>
    																</div> 
    																<div class="form-group">
    																	<div align="center" class="col-md-6 m-auto">
    																		<div align="center"><label>Ürün Türü Durumu</label></div>
    																		<div class="col-md-6 m-auto">
    																			<div class="custom-control custom-radio">
    																				<input type="radio" id="customRadio3" name="urun_turu_durum" value="1" 
    																				class="custom-control-input" checked>
    																				<label class="custom-control-label" for="customRadio3">Aktif</label>
    																			</div>
    																			<div class="custom-control custom-radio">
    																				<input type="radio" id="customRadio4" name="urun_turu_durum" value="0" 
    																				class="custom-control-input">
    																				<label class="custom-control-label" for="customRadio4">Pasif</label>
    																			</div>
    																		</div>
    																	</div>
    																</div>
    																<div align="right" class="box-footer">
    																	<input type="submit" class="btn btn-success" name="urun_turuekle" value="Kaydet">
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
    														<th>Ürün Türü</th> 
    														<th>Ürün Türü Durumu</th>
    														<th>Düzenle</th>
    														<th>Sil</th>
    													</tr>
    												</thead>
    												<tbody> 
    													<?php 
    													$urun_turusor = $db->read("urun_turleri","urun_turu",[
    														"columns" => "urun_turu",
    														"columns_sort" => "ASC"
    														]);
    													while ($urun_turucek=$urun_turusor->Fetch(PDO::FETCH_ASSOC)) {
    														?> 
    														<tr>
    															<td><?php echo $urun_turucek['urun_turu'] ?></td>
    															<td align="center">
    																<?php 
    																if($urun_turucek['urun_turu_durum']==1){
    																	?>
    																	<a href="#">
    																		<button type="button" class="btn btn-success btn-rounded">Aktif</button>
    																	</a>
    																	<?php
    																}else{
    																	?> 
    																	<a href="#">
    																		<button type="button" class="btn btn-danger btn-rounded">Pasif</button>
    																	</a>
    																	<?php } ?>
    																</td> 
    																<td align="center"><a  data-toggle="collapse" href="#duzenle<?php echo $say?>"
    																	aria-expanded="false" aria-controls="duzenle<?php echo $urun_turucek['id']?>">
    																</div> 
    																<button type="button" class="btn btn-outline-success" data-toggle="modal"
    																data-target="#duzenle<?php echo $urun_turucek['id'] ?>"><i class="fas fa-cogs"></i></button>
    															</div>
    														</a> 
    														<div id="duzenle<?php echo $urun_turucek['id'] ?>" class="modal fade" tabindex="-1" role="dialog"
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
    																					<div class="col-md-6 m-auto">
    																						<div align="center"><label>Ürün Türü Adı</label></div>
    																						<input type="text" required="" name="urun_turu" placeholder="Ürün Türü Adı" value="<?php echo $urun_turucek['urun_turu'] ?>" class="form-control">
    																					</div>
    																				</div> 
    																				<div class="form-group">
    																					<div class="col-md-6 m-auto">
    																						<div align="center"><label>Ürün Türü Durumu</label></div>
    																						<div class="col-md-6 m-auto">
    																							<div class="custom-control custom-radio">
    																								<input type="radio" id="customRadio3<?php echo $urun_turucek['id']?>" name="urun_turu_durum" value="1" 
    																								class="custom-control-input" 
    																								<?php if ($urun_turucek['urun_turu_durum']==1) {
    																									echo "checked";
    																								} ?>>
    																								<label class="custom-control-label" for="customRadio3<?php echo $urun_turucek['id']?>">Aktif</label>
    																							</div>
    																							<div class="custom-control custom-radio">
    																								<input type="radio" id="customRadio4<?php echo $urun_turucek['id']?>" name="urun_turu_durum" value="0" 
    																								<?php if ($urun_turucek['urun_turu_durum']==0) {
    																									echo "checked";
    																								} ?> 
    																								class="custom-control-input">
    																								<label class="custom-control-label" for="customRadio4<?php echo $urun_turucek['id']?>">Pasif</label>
    																							</div>
    																						</div>
    																					</div>
    																				</div>
    																				<div align="align" class="box-footer">
    																					<input type="hidden" name="id" value="<?php echo $urun_turucek['id'] ?>">
    																					<input type="submit" class="btn btn-success" name="urun_turuguncelle" value="Kaydet">
    																					<a href="blogs.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
    																					</a>
    																				</div>
    																			</form>
    																		</div>
    																	</div>
    																</div>
    															</div></td> 
    															<td align="center"><a class="btn btn-outline-danger" href="?urun_turu_sil=<?php echo $urun_turucek['id'] ?>"><i class="far fa-trash-alt"></i></a></td>
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