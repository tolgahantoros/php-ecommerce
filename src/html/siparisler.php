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
    											<h3 class="card-title">Onay Bekleyen Siparişler</h3> 
    										</div>
    										<?php 
                                         
    										if (isset($_GET['siparis_sil'])) {
    											$siparis_sil = $db->delete("siparis","id",$_GET['siparis_sil']);
    											if ($siparis_sil['status']){
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Ürün Türü Başarıyla Silindi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $siparisekle['error']; ?>
    												</div>
    												<?php 
    											} 
    										}
    										?> 
    										<div class="table-responsive">
    											<table id="zero_config" class="table table-striped table-bordered no-wrap">
    												<thead>
    													<tr> 
    														<th>id</th>
    														<th>Müşteri Adı</th> 
    														<th>Sipariş Toplamı</th>
    														<th>Sipariş Tarihi</th>
    														<th>Sipariş Durumu</th>
    														<th>Detay</th> 
    													</tr>
    												</thead>
    												<tbody> 
    													<?php 
    													$siparissor = $db->wread2("siparisler","siparis_durum",0);
    													while ($sipariscek=$siparissor->Fetch(PDO::FETCH_ASSOC)) {
    														?> 
    														<tr>
    															<td><?php echo $sipariscek['id']; ?></td>
    															<td>
    																<?php  $kullanici = $sipariscek['users_id'];
    																$kullanici_cek = $db->wread2("users","users_id",$kullanici);
    																$kullanici_cek = $kullanici_cek->fetch(PDO::FETCH_ASSOC);
    																echo $kullanici_cek['users_namesurname'];
    																?> 
    															</td>
    															<td><?php echo $sipariscek['siparis_toplam'] ?></td>
    															<td><?php echo $sipariscek['siparis_tarih'] ?></td> 
    															<td align="center">
    																<?php 
    																if($sipariscek['durum']==1){
    																	?>
    																	<a href="#">
    																		<button type="button" class="btn btn-success btn-rounded">Onaylandı</button>
    																	</a>
    																	<?php
    																}else{
    																	?> 
    																	<a href="#">
    																		<button type="button" class="btn btn-danger btn-rounded">Beklemede</button>
    																	</a>
    																	<?php } ?>
    																</td> 
    																<td align="center"><a href="siparis-detay?siparis=<?php echo $sipariscek['id']; ?>"><button type="button" class="btn btn-outline-success" ><i class="fas fa-cogs"></i></button></a></td> 
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