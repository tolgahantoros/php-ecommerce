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
    											<h3 class="card-title">Ana Sayfa Bannerlar</h3>
    											<div style="position: relative;top: 3%;left: 60%;">
    												<a  data-toggle="collapse" href="#blogekle"
    												aria-expanded="false" aria-controls="blogekle">
    												<button type="button" class="btn btn-outline-success"><i
    													class="fa fa-plus"></i> Banner Ekle</button>
    												</a>
    											</div>
    										</div>
    										<?php 
    										if ($_POST['bannerekle']) { 
    											$bannerekle=$db->insert("anasayfa_banner",$_POST,[
    												"form_name" => "bannerekle",
    												"dir" => "banner",
    												"file_name" => "file"
    												]);
    											if ($bannerekle['status']){
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Yeni Banner Başarıyla Eklendi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $bannerekle['error']; ?>
    												</div>
    												<?php 
    											} 
    										}
    										if ($_POST['bannerguncelle']) { 
    											print_r($_POST);
    											print_r($_FILES);
    											$bannerguncelle=$db->update("anasayfa_banner",$_POST,[
    												"form_name" => "bannerguncelle",
    												"columns" => "id",
    												"dir" => "banner",
    												"file_name" => "file",
    												"file_delete" => "delete_file"
    												]);
    											if ($bannerguncelle['status']){
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Banner Başarıyla Güncellendi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $bannerguncelle['error']; ?>
    												</div>
    												<?php 
    											} 
    										}
    										if ($_GET['banka_sil']) {
    											$bankasil=$db->delete("banka","id",$_GET['banka_sil']);
    											if ($bankasil['status']){
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Banner Başarıyla Silindi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $bankasil['error']; ?>
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
    																		<div align="center"><label>Banner Başlığı</label></div>
    																		<input class="form-control" type="text" name="baslik" placeholder="Banner Başlığı" required="">
    																	</div>
    																</div> 
    																<div class="form-group">
    																	<div class="col-md-4 m-auto">
    																		<fieldset class="form-group">
    																			<div align="center">Banner Resim (Boyut 1200X809 olmalı)</div><br>
    																			<input type="file" name="file" class="form-control-file"  required=""  id="exampleInputFile">
    																		</fieldset>
    																	</div>   
    																</div>
    																<div class="form-group">
    																	<div class="col-md-8 m-auto">
    																		<div align="center"><label>Banner Açıklaması</label></div>
    																		<input type="text" required="" name="aciklama" placeholder="Banner Açıklaması" class="form-control">
    																	</div>
    																</div>
    																<div class="form-group">
    																	<div class="col-md-8 m-auto">
    																		<div align="center"><label>Banner Buton Adı</label></div>
    																		<input type="text" required="" name="buton" placeholder="Banner Buton Adı" class="form-control">
    																	</div>
    																</div>
    																<div class="form-group">
    																	<div class="col-md-8 m-auto">
    																		<div align="center"><label>Banner URL</label></div>
    																		<input type="text" required="" name="url" placeholder="Banner URL" class="form-control">
    																	</div>
    																</div>
    																<div class="form-group">
    																	<div class="col-md-8 m-auto">
    																		<div align="center"><label>Banner Durumu</label>
    																			<div class="col-md-8 m-auto">
    																				<div class="custom-control custom-radio">
    																					<input type="radio" id="customRadio3" name="durum" value="1" 
    																					class="custom-control-input" checked>
    																					<label class="custom-control-label" for="customRadio3">Aktif</label>
    																				</div>
    																				<div class="custom-control custom-radio">
    																					<input type="radio" id="customRadio4" name="durum" value="0" 
    																					class="custom-control-input">
    																					<label class="custom-control-label" for="customRadio4">Pasif</label>
    																				</div>
    																			</div>
    																		</div>
    																	</div>
    																</div>
    																<div align="right" class="box-footer">
    																	<input type="submit" class="btn btn-success" name="bannerekle" value="Kaydet">
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
    														<th>Banner Başlık</th>
    														<th>Banner Buton</th> 
    														<th>Düzenle</th>
    														<th>Sil</th>
    													</tr>
    												</thead>
    												<tbody> 
    													<?php 
    													$bannersor = $db->read("anasayfa_banner","id",[
    														"columns" => "id",
    														"columns_sort" => "ASC"
    														]);
    													while ($bannercek=$bannersor->Fetch(PDO::FETCH_ASSOC)) {
    														?> 
    														<tr>
    															<td><?php echo $bannercek['baslik'] ?></td>
    															<td><?php echo $bannercek['buton'] ?></td> 
    															<td align="center"><a type="button" class="btn btn-outline-success" href="anasayfa-banner-duzenle.php?banner_id=<?php echo $bannercek['id'] ?>" ><i class="fas fa-cogs"></i></a></td>
                                                             <td align="center"><a class="btn btn-outline-danger" href="?banner_sil=True&banner_id=<?php echo $bannercek['id']; if($bannercek['file']!='Array'){
                                                                echo "&delete_file=".rand(1000,9999).base64_encode($bannercek['file']);
                                                            }?>">
                                                            <i class="far fa-trash-alt"></i></a>
                                                        </td>
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