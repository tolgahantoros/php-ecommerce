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
    						<div class="d-flex align-items-center mb-4">
    							<h3 class="card-title">Tüm Ürün yorumları</h3>

    						</div>
    						<?php  
    						if (isset($_GET['urun_yorum_sil'])) {
    							$urun_yorum_sil = $db->delete("urun_yorumlar","id",$_GET['urun_yorum_sil']);
    							if ($urun_yorum_sil['status']) {
    								?>
    								<div class="alert alert-success" role="alert">
    									<strong>Tebrikler - </strong> Yorum başarıyla silindi.
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
    						<div class="table-responsive">
    							<table id="zero_config" class="table table-striped table-bordered no-wrap">
    								<thead>
    									<tr> 
    										<th>Kullanıcı</th>
    										<th>Ürün</th>
    										<th>Puan</th>
    										<th>Tarih</th>
    										<th>Durum</th>
    										<th>Düzenle</th>
    										<th>Sil</th>
    									</tr>
    								</thead>
    								<tbody> 
    									<?php 
    									$urun_yorumsor = $db->read("urun_yorumlar","id",[
    										"columns" => "id",
    										"columns_sort" => "DESC"
    										]);
    									while ($urun_yorumcek=$urun_yorumsor->Fetch(PDO::FETCH_ASSOC)) {

    										$urun_sor = $db->wread2("urun","urun_id",$urun_yorumcek['urun_id']);
    										$urun_sor = $urun_sor->fetch(PDO::FETCH_ASSOC); 

    										$kullanici_sor = $db->wread2("users","users_id",$urun_yorumcek['users_id']);
    										$kullanici_sor = $kullanici_sor->fetch(PDO::FETCH_ASSOC);
    										?> 
    										<tr>
    											<td><?php echo $kullanici_sor['users_namesurname']; ?></td>
    											<td><?php echo $urun_sor['urun_ad'] ?></td>
    											<td><?php echo $urun_yorumcek['puan'] ?></td> 
    											<td><?php echo $urun_yorumcek['yorum_tarih'] ?></td> 
    											<td align="center">
    												<?php 
    												if ($urun_yorumcek['yorum_durumu']==1) {
    													?> 
    													<button type="button" class="btn btn-success btn-rounded">Aktif</button>
    													<?php
    												}else{
    													?> 
    													<button type="button" class="btn btn-danger btn-rounded">Pasif</button>
    													<?php } ?>
    												</td>
    												<td align="center"><a href="<?php echo "urun-yorum-detay.php?id=".$urun_yorumcek['id']; ?>" class="btn btn-outline-success"><i class="fas fa-cogs"></i></a></td>
    												<td align="center"><a class="btn btn-outline-danger" href="?urun_yorum_sil=<?php echo $urun_yorumcek['id'] ?>"><i class="far fa-trash-alt"></i></a></td>
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