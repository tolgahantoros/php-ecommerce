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
    							<h3 class="card-title">Tüm Blog yorumları</h3>
    						</div>
    						<?php  
    						if (isset($_GET['blog_yorum_sil'])) {
    							$blog_yorum_sil = $db->delete("blog_yorum","id",$_GET['blog_yorum_sil']);
    							if ($blog_yorum_sil['status']) {
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
    										<th>Ad</th>
    										<th>Blog</th>     										
    										<th>Tarih</th>
    										<th>Durum</th>
    										<th>Düzenle</th>
    										<th>Sil</th>
    									</tr>
    								</thead>
    								<tbody> 
    									<?php 
    									$blog_yorumsor = $db->read("blog_yorum","id",[
    										"columns" => "id",
    										"columns_sort" => "DESC"
    										]);
    									while ($blog_yorumcek=$blog_yorumsor->Fetch(PDO::FETCH_ASSOC)) {

    										$blog_sor = $db->wread2("blogs","blogs_id",$blog_yorumcek['blogs_id']);
    										$blog_sor = $blog_sor->fetch(PDO::FETCH_ASSOC);  
    										?> 
    										<tr>
    											<td><?php echo $blog_yorumcek['ad']; ?></td>
    											<td><?php echo $blog_sor['blogs_title'] ?></td> 
    											<td><?php echo $blog_yorumcek['yorum_tarih'] ?></td> 
    											<td align="center">
    												<?php 
    												if ($blog_yorumcek['durum']==1) {
    													?> 
    													<button type="button" class="btn btn-success btn-rounded">Aktif</button>
    													<?php
    												}else{
    													?> 
    													<button type="button" class="btn btn-danger btn-rounded">Pasif</button>
    													<?php } ?>
    												</td>
    												<td align="center"><a href="<?php echo "blog-yorum-detay.php?id=".$blog_yorumcek['id']; ?>" class="btn btn-outline-success"><i class="fas fa-cogs"></i></a></td>
    												<td align="center"><a class="btn btn-outline-danger" href="?blog_yorum_sil=<?php echo $blog_yorumcek['id'] ?>"><i class="far fa-trash-alt"></i></a></td>
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