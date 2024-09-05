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
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-12">
    				<div class="card">
    					<div class="card-body">
    						<?php 
    						
    						if ($_POST['tema_sol_ust_guncelle']) {
    							$tema_sol_ust_guncelle = $db->update("tema_header_ustu",$_POST,[
    								"form_name" => "tema_sol_ust_guncelle",
    								"columns" => "ad"
    								]);
    						}

    						$tema_sol_ust = $db->wread("tema_header_ustu","ad","sol");

    						?>
    						<div class="col-12">
    							<div class="card card-body">
    								<h3 class="card-title">Header üstü sol köşe yazısı : </h3>
    								<form method="POST" action=""> 
    									<input class="form-control" type="text" name="baslik" value="<?php echo $tema_sol_ust['baslik'] ?>"><br>
    									<input type="hidden" name="ad" value="sol">
    									<input type="submit" name="tema_sol_ust_guncelle" class="btn btn-success"  value="Güncelle">
    								</form>
    							</div>
    						</div>

    						<div class="col-12"> 
    							<div class="card card-body">
    								<div class="d-flex align-items-center mb-4">
    									<h3 class="card-title">Header üstü sağ butonlar : </h3>
    									<div style="position: relative;top: 3%;left: 50%;">
    										<a  data-toggle="collapse" href="#blogekle"
    										aria-expanded="false" aria-controls="blogekle">
    										<button type="button" class="btn btn-outline-success"><i
    											class="fa fa-plus"></i> Buton Ekle</button>
    										</a>
    									</div>
    								</div>
    								<?php 
    								if ($_POST['butonekle']) {

    									$butonekle=$db->insert("tema_header_ustu",$_POST,[
    										"form_name" => "butonekle"
    										]);
    									if ($butonekle['status']){
    										?>
    										<div class="alert alert-success" role="alert">
    											<strong>Tebrikler - </strong> Yeni Buton Başarıyla Eklendi.
    										</div>
    										<?php
    									}else{
    										?>
    										<div class="alert alert-danger" role="alert">
    											<strong>Hata - </strong> <?php echo $butonekle['error']; ?>
    										</div>
    										<?php 
    									} 
    								}
    								if ($_POST['butonguncelle']) {
    									$butonguncelle=$db->update("tema_header_ustu",$_POST,[
    										"form_name" => 'butonguncelle',
    										"columns" => "id"
    										]);
    									if ($butonguncelle['status']){
    										?>
    										<div class="alert alert-success" role="alert">
    											<strong>Tebrikler - </strong> Buton Başarıyla Güncellendi.
    										</div>
    										<?php
    									}else{
    										?>
    										<div class="alert alert-danger" role="alert">
    											<strong>Hata - </strong> <?php echo $butonguncelle['error']; ?>
    										</div>
    										<?php 
    									} 
    								}
    								if ($_GET['buton_sil']) {
    									$butonsil=$db->delete("tema_header_ustu","id",$_GET['buton_sil']);
    									if ($butonsil['status']){
    										?>
    										<div class="alert alert-success" role="alert">
    											<strong>Tebrikler - </strong> Buton Başarıyla Silindi.
    										</div>
    										<?php
    									}else{
    										?>
    										<div class="alert alert-danger" role="alert">
    											<strong>Hata - </strong> <?php echo $butonsil['error']; ?>
    										</div>
    										<?php 
    									} 
    								}
    								?>
    								<div class="collapse" id="blogekle">
    									<div class="card card-body">
    										<form action="" method="POST">
    											<div class="container-fluid">
    												<div class="row">
    													<div class="card-body"> 
    														<div class="form-group">
    															<div class="col-md-8 m-auto">
    																<div align="center"><label>Buton adı</label></div>
    																<input class="form-control" type="text" name="baslik" placeholder="Buton Adı" required="">
    															</div>
    														</div> 
    														<div class="form-group">
    															<div class="col-md-8 m-auto">
    																<div align="center"><label>Buton URL'si</label></div>
    																<input type="text" required="" value="" name="url" placeholder="Buton URL'si" class="form-control">
    															</div>
    														</div>  
    														<div align="right" class="box-footer">
    															<input type="hidden" name="ad" value="sag">
    															<input type="submit" class="btn btn-success" name="butonekle" value="Kaydet">
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
    												<th>Buton Adı</th>
    												<th>Buton URL</th> 
    												<th>Düzenle</th>
    												<th>Sil</th>
    											</tr>
    										</thead>
    										<tbody> 
    											<?php 
    											$butonsor = $db->wread2("tema_header_ustu","ad","sag");
    											while ($butoncek=$butonsor->Fetch(PDO::FETCH_ASSOC)) {
    												?> 
    												<tr>
    													<td><?php echo $butoncek['baslik'] ?></td>
    													<td><?php echo $butoncek['url'] ?></td> 
    													<td align="center"><a  data-toggle="collapse" href="#duzenle<?php echo $butoncek['id']?>"
    														aria-expanded="false" aria-controls="duzenle<?php echo $butoncek['id']?>">
    													</div> 
    													<button type="button" class="btn btn-outline-success" data-toggle="modal"
    													data-target="#duzenle<?php echo $butoncek['id'] ?>"><i class="fas fa-cogs"></i></button>
    												</div>
    											</a> 
    											<div id="duzenle<?php echo $butoncek['id'] ?>" class="modal fade" tabindex="-1" role="dialog"
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
    																	<div class="container-fluid">
    																		<div class="row">
    																			<div class="card-body"> 
    																				<div class="form-group">
    																					<div class="col-md-8 m-auto">
    																						<div align="center"><label>Buton adı</label></div>
    																						<input class="form-control" type="text" name="baslik" placeholder="Buton Adı" required="" value="<?php echo $butoncek['baslik'] ?>">
    																					</div>
    																				</div> 
    																				<div class="form-group">
    																					<div class="col-md-8 m-auto">
    																						<div align="center"><label>Buton URL'si</label></div>
    																						<input type="text" required="" value="<?php echo $butoncek['url'] ?>" name="url" placeholder="Buton URL'si" class="form-control">
    																					</div>
    																				</div>  
    																				<div align="right" class="box-footer">
    																					<input type="hidden" name="id" value="<?php echo $butoncek['id']; ?>">
    																					<input type="hidden" name="ad" value="sag">
    																					<input type="submit" class="btn btn-success" name="butonguncelle" value="Kaydet">
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
    												</div></td> 
    												<td align="center"><a class="btn btn-outline-danger" href="?buton_sil=<?php echo $butoncek['id'] ?>"><i class="far fa-trash-alt"></i></a></td>
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