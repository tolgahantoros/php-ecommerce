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
    											<h3 class="card-title">Menüler</h3>
    											<div style="position: relative;top: 3%;left: 75%;">
    												<a  data-toggle="collapse" href="#menuekle"
    												aria-expanded="false" aria-controls="menuekle">
    												<button type="button" class="btn btn-outline-success"><i
    													class="fa fa-plus"></i> Menü Ekle</button>
    												</a>
    											</div>
    										</div> <?php 
    										if (isset($_POST['menuinsert'])) { 
    											// echo "<pre>";
    											// print_r($_POST);
    											$menuekle=$db->insert("menu",$_POST,[
    												"form_name" => "menuinsert"
    												]);
    										}
    										if (isset($_POST['menuupdate'])) {
    											$menuguncelle=$db->update("menu",$_POST,[
    												"form_name" => "menuupdate",
    												"columns" => "menu_id"
    												]);
    										}
    										if ($_GET['menu_sil']=="True") {
    											$menusil = $db->delete("menu","menu_id",$_GET['menu_id']);
    											if ($menusil) {
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Menü Başarıyla Silindi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-error" role="alert">
    													<strong>HATA - </strong> Menü Silinirken Bir Sorun Oluştu.
    												</div>
    												<?php
    											}
    										}
    										?>
    										<div class="collapse" id="menuekle">
    											<div class="card card-body">

    												<form action="" method="POST" enctype="multipart/form-data">
    													<div class="container-fluid">
    														<div class="row">
    															<div class="card-body"> 
    																<div class="form-group">
    																	<div class="col-md-4 m-auto">
    																		<div align="center"><label>Menü adı</label></div>
    																		<input type="text" required="" name="menu_ad" placeholder="Menü Adı" class="form-control">
    																	</div>
    																</div> 
    																<div class="form-group">
    																	<div class="col-md-4 m-auto">
    																		<div align="center"><label>Üst Menü</label></div>
    																		<select name="menu_ust" class="form-control">
    																			<option value="0">Yok</option>
    																			<?php 
    																			$ustmenusor = $db->wread2("menu","menu_ust",0);
    																			while($ustmenucek=$ustmenusor->fetch(PDO::FETCH_ASSOC)){
    																				?>
    																				<option value="<?php echo $ustmenucek['menu_id'] ?>"><?php echo $ustmenucek['menu_ad']; ?></option>
    																				<?php } ?>
    																			</select>
    																		</div>
    																	</div> 
    																	<div class="form-group">
    																		<div class="col-md-4 m-auto">
    																			<div align="center"><label>Menü Üstü Yazı</label></div>
    																			<input type="text" name="menu_icon" placeholder="Menü Üstü Yazı" class="form-control">
    																		</div>
    																	</div> 
    																	<div class="form-group">
    																		<div class="col-md-4 m-auto">
    																			<div align="center"><label>Menü URL</label></div>
    																			<input type="text" name="menu_url" placeholder="Menü URL" class="form-control">
    																		</div>
    																	</div> 
    																	<div class="form-group">
    																		<div class="col-md-4 m-auto">
    																			<div align="center"><label>Menü Sıra</label></div>
    																			<input type="number" required="" name="menu_sira" placeholder="Menü Sıra" class="form-control">
    																		</div>
    																	</div> 
    																	<div class="form-group">
    																		<div class="col-md-4 m-auto">
    																			<div align="center"><label>Menü Durumu</label></div>
    																			<div class="col-md-4 m-auto">
    																				<div class="custom-control custom-radio">
    																					<input type="radio" id="customRadio3" name="menu_durum" value="1" 
    																					class="custom-control-input" checked>
    																					<label class="custom-control-label" for="customRadio3">Aktif</label>
    																				</div>
    																				<div class="custom-control custom-radio">
    																					<input type="radio" id="customRadio4" name="menu_durum" value="0" 
    																					class="custom-control-input">
    																					<label class="custom-control-label" for="customRadio4">Pasif</label>
    																				</div>
    																			</div>
    																		</div>
    																	</div>
    																	<div align="center" class="box-footer">
    																		<input type="submit" class="btn btn-success" name="menuinsert" value="Kaydet">
    																		<a href="menu.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
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
    															<th>#</th>
    															<th>Menü Adı</th>
    															<th>Menü Sırası</th>
    															<th>Durum</th>
    															<th>Düzenle</th>
    															<th>Sil</th>
    														</tr>
    													</thead>
    													<tbody> 
    														<?php 
    														$menucek=$db->read("menu",[
    															"columns_name" => "menu_id",
    															"columns_sort" => "ASC"
    															]);
    														$say = 1;
    														while ($satir=$menucek->fetch(PDO::FETCH_ASSOC)) {
    															?>
    															<tr>
    																<td><?php echo $say++; ?></td>
    																<td><?php echo $satir['menu_ad']; ?></td>
    																<td align="center"><?php echo $satir['menu_sira']; ?></td>
    																<td align="center">
    																	<?php 
    																	if ($satir['menu_durum']==1) {
    																		?> 
    																		<button type="button" class="btn btn-success btn-rounded">Aktif</button>
    																		<?php
    																	}else{
    																		?> 
    																		<button type="button" class="btn btn-danger btn-rounded">Pasif</button>
    																		<?php } ?>
    																	</td>
    																	<td align="center"><a  data-toggle="collapse" href="#duzenle<?php echo $say?>"
    																		aria-expanded="false" aria-controls="duzenle<?php echo $say?>">
    																		<button type="button" class="btn btn-outline-success" data-toggle="modal"
    																		data-target="#duzenle<?php echo $say ?>"><i class="fas fa-cogs"></i></button>
    																	</a>
    																	<div id="duzenle<?php echo $say ?>" class="modal fade" tabindex="-1" role="dialog"
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
    																						<form action="" method="POST" enctype="multipart/form-data">
    																							<div class="container-fluid">
    																								<div class="row">
    																									<div class="card-body"> 
    																										<div class="form-group">
    																											<div class="col-md-6 m-auto">
    																												<div align="center"><label>Menü Ad</label></div>
    																												<input type="text" required="" name="menu_ad" value="<?php echo $satir['menu_ad'] ?>" placeholder="Menü Adı" class="form-control">
    																											</div>
    																										</div>

    																										<div class="form-group">
    																											<div class="col-md-6 m-auto">
    																												<div align="center"><label>Üst Menü</label></div>
    																												<select class="form-control" name="menu_ust">
    																													<option value="<?php 
    																													if ($satir['menu_ust']==0) {
    																														echo 0;
    																													}else{
    																														echo $satir['menu_ust'];
    																													}
    																													?>">
    																													<?php 
    																													if ($satir['menu_ust']==0) {
    																														echo "Yok";
    																													}else{
    																														$ustmenuisim=$db->wread("menu","menu_ust",$satir['menu_ust']);
    																														echo $ustmenuisim['menu_ad'];
    																													}
    																													?>
    																												</option>
    																												<?php 
    																												$ustmenusor = $db->wread2("menu","menu_ust",0);
    																												while($ustmenucek=$ustmenusor->fetch(PDO::FETCH_ASSOC)){
    																													// Menü kendi adının altında olamaz bu yüzden kendi id'si ile eşleştiğinde bu döngüden sonrakiş döngüye geç
    																													if ($ustmenucek['menu_id']==$satir['menu_id']) {
    																														continue;
    																													}
    																													?>
    																													<option value="<?php echo $ustmenucek['menu_id'] ?>"><?php echo $ustmenucek['menu_ad']; ?></option>
    																													<?php } ?>
    																												</select>
    																											</div>
    																										</div>

    																										<div class="form-group">
    																											<div class="col-md-6 m-auto">
    																												<div align="center"><label>Menü Üstü Yazı</label></div>
    																												<input type="text"  name="menu_icon" value="<?php echo $satir['menu_icon'] ?>" placeholder="Menü Üstü Yazı" class="form-control">
    																											</div>
    																										</div> 

    																										<div class="form-group">
    																											<div class="col-md-6 m-auto">
    																												<div align="center"><label>Menü URL</label></div>
    																												<input type="text" name="menu_url" value="<?php echo $satir['menu_url'] ?>" placeholder="Menü URL" class="form-control">
    																											</div>
    																										</div> 

    																										<div class="form-group">
    																											<div class="col-md-6 m-auto">
    																												<div align="center"><label>Menü Sıra</label></div>
    																												<input type="number" required="" name="menu_sira" value="<?php echo $satir['menu_sira'] ?>" placeholder="Menü Sırası" class="form-control">
    																											</div>
    																										</div>  


    																										<div class="form-group">
    																											<div class="col-md-6 m-auto">
    																												<label>Menü Durumu</label>
    																												<div class="col-md-4 m-auto">
    																													<div class="custom-control custom-radio">
    																														<input type="radio" id="customRadio7<?php echo $satir['menu_id'];?>" name="menu_durum" value="1" 
    																														class="custom-control-input" checked>
    																														<label class="custom-control-label" for="customRadio7<?php echo $satir['menu_id'];?>">Aktif</label>
    																													</div>
    																													<div class="custom-control custom-radio">
    																														<input type="radio" id="customRadio8<?php echo $satir['menu_id'];?>" name="menu_durum" value="0" 
    																														class="custom-control-input">
    																														<label class="custom-control-label" for="customRadio8<?php echo $satir['menu_id'];?>">Pasif</label>
    																													</div>
    																												</div>
    																											</div>
    																										</div>


    																										<div align="center" class="box-footer">
    																											<input type="hidden" name="menu_id" value="<?php echo $satir['menu_id'];?>">
    																											<input type="submit" class="btn btn-success" name="menuupdate" value="Güncelle">
    																											<a href="menu.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
    																											</a>
    																										</div>
    																									</div>
    																								</div>
    																							</div>
    																							<td align="center"><a class="btn btn-outline-danger" href="?menu_sil=True&menu_id=<?php echo $satir['menu_id'];?>">
    																								<i class="far fa-trash-alt"></i></a>
    																							</td>
    																						</form>
    																					</div>
    																				</div><!-- /.modal-content -->
    																			</div><!-- /.modal-dialog -->
    																		</div><!-- /.modal -->
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