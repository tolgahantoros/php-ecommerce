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
	<script src="../dropzone-5.7.0/dist/min/dropzone.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../dropzone-5.7.0/dist/min/dropzone.min.css">
	<style>
		.center {
			text-align: center;
		}

		.pagination {
			display: inline-block;
		}

		.pagination a {
			color: black;
			float: left;
			padding: 8px 16px;
			text-decoration: none;
			transition: background-color .3s;
			border: 1px solid #ddd;
			margin: 0 4px;
		}

		.pagination a.active {
			background-color: #5f76e8;
			color: white;
			border: 1px solid #4CAF50;
		}

		.pagination a:hover:not(.active) {background-color: #ddd;}
	</style>
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
							<h3 class="card-title">Video Galerisi</h3>
							<div class="card-body">
								<?php 
								if (isset($_POST['video_sil'])) {
									// echo "<pre>";
									// print_r($_POST);
									$sayac = count($_POST['video_id']);
									for ($i=0; $i < $sayac ; $i++) { 
										$videosil = $db->delete("videogaleri","id",$_POST['video_id'][$i]);
									}
									if ($videosil) {
										?>
										<div class="alert alert-success" role="alert">
											<strong>Tebrikler - </strong> Video Başarıyla Silindi.
										</div>
										<?php
									}else{
										?>
										<div class="alert alert-error" role="alert">
											<strong>HATA - </strong> Video Silinirken Bir Sorun Oluştu.
										</div>
										<?php
									}
								} 
								?>
								<form method="POST" action="">
									<div align="right"> 
										<input type="submit" class="btn btn-outline-danger" name="video_sil" value="Seçilenleri Sil">
										<a class="btn btn-outline-success" href="videoyukle.php"> Video Yükle</a>
									</div><br><br>
									<div align="center" class="form-group"> 
										<?php 
										$sayfada = 16; //4 ün katı olmalı
										$sorgu=$db->read("videogaleri");
										$toplam_icerik=$sorgu->rowCount();
										$toplam_sayfa = ceil($toplam_icerik / $sayfada);
										$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
										if($sayfa < 1) $sayfa = 1; 
										if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
										$limit = ($sayfa - 1) * $sayfada ;
										// limiti belirledik

										$videogaleri=$db->read("videogaleri",[
											"columns_name" => "id",
											"columns_sort" => "DESC",
											"limit" =>  $limit.",".$sayfada
											]);
										while($videogalericek=$videogaleri->fetch(PDO::FETCH_ASSOC)){
											?>	
											<label>
												<iframe width="280" height="200"
												src="https://www.youtube.com/embed/<?php echo $videogalericek['video_url'] ?>?playlist=<?php echo $videogalericek['video_url'] ?>&loop=1">
											</iframe>
											<div class="mask">
												<div align="center">
													<input type="checkbox" name="video_id[]" value="<?php echo $videogalericek['id']; ?>">
												</div>
											</div>
										</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!-- boşluk sınırı bu -->
										<?php } ?>
									</div>
								</form>
								<div class="center">
									<div class="pagination">
										<a href="http://localhost/scriptpanel/src/html/resimgaleri.php?sayfa=1">&laquo;</a>
										<?php 
                                				$sayfa_goster = 3; // gösterilecek sayfa sayısı

                                				$en_az_orta = ceil($sayfa_goster/2);
                                				$en_fazla_orta = ($toplam_sayfa+1) - $en_az_orta;

                                				$sayfa_orta = $sayfa;
                                				if($sayfa_orta < $en_az_orta) $sayfa_orta = $en_az_orta;
                                				if($sayfa_orta > $en_fazla_orta) $sayfa_orta = $en_fazla_orta;

                                				$sol_sayfalar = round($sayfa_orta - (($sayfa_goster-1) / 2));
                                				$sag_sayfalar = round((($sayfa_goster-1) / 2) + $sayfa_orta); 

                                				if($sol_sayfalar < 1) $sol_sayfalar = 1;
                                				if($sag_sayfalar > $toplam_sayfa) $sag_sayfalar = $toplam_sayfa;

                                				for($s = $sol_sayfalar; $s <= $sag_sayfalar; $s++) {
                                					if($sayfa == $s) {
                                						if (!isset($_GET['sayfa'])) {
                                							?>
                                							<a class="active" href="http://localhost/scriptpanel/src/html/resimgaleri.php?sayfa=1">1</a>
                                							<?php
                                						}else{
                                							?>
                                							<a class="active" href="<?php echo $_GET['sayfa']; ?>"><?php echo $_GET['sayfa']; ?></a>
                                							<?php
                                						}
                                					} else {
                                						echo '<a href="?sayfa='.$s.'">'.$s.'</a> ';
                                					}
                                				}

                                				?>
                                				<a href="http://localhost/scriptpanel/src/html/resimgaleri.php?sayfa=<?php echo $toplam_sayfa; ?>">&raquo;</a>
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