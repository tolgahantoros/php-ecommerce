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
    											<h3 class="card-title">Sorular</h3>
    											<div style="position: relative;top: 3%;left: 75%;">
    												<a  data-toggle="collapse" href="#soruekle"
    												aria-expanded="false" aria-controls="soruekle">
    												<button type="button" class="btn btn-outline-success"><i
    													class="fa fa-plus"></i> Soru Ekle</button>
    												</a>
    											</div>
    										</div>
    										<?php 
    										if (isset($_POST['soruinsert'])) {

    											$sonuc = $db->insert("sss",$_POST,[
    												"form_name" => "soruinsert"
    												]);
    											if ($sonuc['status']) {
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> Yeni soru Başarıyla Oluşturuldu.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $sonuc['error']; ?>
    												</div>
    												<?php
    											}
    										}elseif(isset($_POST['soruupdate'])){ 

    											/*
												CKEDİTÖR TOPLU LİSTELEMEDE NAME DEĞERLERİNİN AYNI OLMASI SEBEBİYLE SORUN ÇIKARIYORDU BU YÜZDEN TÜM SATIRLARDAKİ NAME DEĞERLERİNİN SONUNA $SAY DEĞERİNİ EKLEDİK. ANCAK BUNU VERİTABANINA YAZARKEN NAME ATTIRIBUTUNUN SONUNA EKLEDİĞİMİZ $SAY DEĞERİNİ KALDIRMAMIZ LAZIM Kİ VERİTABANINDA DOĞRU SATIRDA GÜNCELLEME YAPABİLELİM. BUNUN İÇİN FORMDA GÖNDERDİMİZ SAYAC DEĞERİ SAYESİNDE $SAY DEĞERİNİ BULUP POST DİZİSİNE UNSET İLE GEREKLİ DÜZENLEMEYİ YAPIYORUZ
    											*/
    											$silinecek = $_POST['sayac'];
    											$_POST["cevap"] = $_POST[$silinecek];
    											unset($_POST[$silinecek]);
    											unset($_POST['sayac']);

    											$sonuc = $db->update("sss",$_POST,[
    												"form_name" => "soruupdate",
    												"columns" => "id"
    												]);
    											if ($sonuc['status']) {
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> soru Başarıyla Güncellendi.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $sonuc['error']; ?>
    												</div>
    												<?php
    											}
    										}elseif(isset($_GET['soru_sil'])){
    											if ($_GET['sorus_id']==$_SESSION['sorus']['sorus_id']) {
    												header("Location:sorus.php?hata=kendiHesabiniziSilemezsiniz");
    												exit;
    											}
    											$harfsayisi=strlen($_GET['delete_file']);
    											$_GET['delete_file'] = substr($_GET['delete_file'], 4,$harfsayisi);
    											$sonuc = $db->delete("sorus",
    												"sorus_id",
    												$_GET['sorus_id'],
    												base64_decode($_GET['delete_file'])
    												);
    											if ($sonuc['status']) {
    												?>
    												<div class="alert alert-success" role="alert">
    													<strong>Tebrikler - </strong> soruyi başarıyla sildiniz.
    												</div>
    												<?php
    											}else{
    												?>
    												<div class="alert alert-danger" role="alert">
    													<strong>Hata - </strong> <?php echo $sonuc['error']; ?>
    												</div>
    												<?php
    											}
    										}elseif($_GET['hata']=="kendiHesabiniziSilemezsiniz"){
    											?> 
    											<div class="alert alert-danger" role="alert">
    												<strong>Hata - </strong> LÜTFEN KENDİ HESABINIZI SİLMEYE ÇALIŞMAYIN!
    											</div>
    											<?php } ?>
    											<div class="collapse" id="soruekle">
    												<div class="card card-body">
    													<form action="" method="POST" enctype="multipart/form-data">
    														<div class="container-fluid">
    															<div class="row">
    																<div class="card-body">   
    																	<div class="form-group">
    																		<div class="col-md-4 m-auto">
    																			<div align="center"><label>Soru</label></div>
    																			<textarea rows="3" cols="25" name="soru">1000 Harfi geçmesin.</textarea>
    																		</div>
    																	</div>
    																	<div class="form-group">
    																		<div class="col-md-12 m-auto">
    																			<div align="center"><label>Cevap</label></div>
    																			<textarea name="cevap"></textarea>
    																			<script>
    																				CKEDITOR.replace( 'cevap' );
    																			</script>
    																		</div>
    																	</div> 

    																	<div align="right" class="box-footer">
    																		<input type="submit" class="btn btn-success" name="soruinsert" value="Kaydet">
    																		<a href="sorus.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
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
    															<th>Soru</th>
    															<th>Cevap</th>
    															<th>Düzenle</th>
    															<th>Sil</th>
    														</tr>
    													</thead>
    													<tbody> 
    														<?php 
    														$sorucek=$db->read("sss",[
    															"columns_name" => "id",
    															"columns_sort" => "ASC"
    															]);
    														$say = 1;
    														while ($satir=$sorucek->fetch(PDO::FETCH_ASSOC)) {
    															?>
    															<tr>
    																<td><?php echo $say++; ?></td>
    																<td><?php echo $satir['soru']; ?></td>
    																<td><?php echo htmlspecialchars_decode($satir['cevap']); ?></td>
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
    																										<div class="col-md-4 m-auto">
    																											<div align="center"><label>Soru</label></div>
    																											<textarea rows="3" cols="15" name="soru"><?php echo $satir['soru'] ?></textarea>
    																										</div>
    																									</div>
    																									<div class="form-group">
    																										<div class="col-md-12 m-auto">
    																											<div align="center"><label>Cevap</label></div>
    																											<textarea name="cevap<?php echo $say?>"><?php echo $satir['cevap']; ?></textarea>
    																											<script>
    																												CKEDITOR.replace( "cevap<?php echo $say?>" );
    																											</script>
    																										</div>
    																									</div>  
    																									<div align="center" class="box-footer">
    																										<input type="hidden" name="id" value="<?php echo $satir['id'];?>">
    																										<input type="hidden" value="cevap<?php echo $say?>" name="sayac">
    																										<input type="submit" class="btn btn-success" name="soruupdate" value="Güncelle">
    																										<a href="sss.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
    																										</a>
    																									</div>
    																								</div>
    																							</div>
    																						</div>
    																						<td align="center"><a class="btn btn-outline-danger" href="?soru_sil=True&sorus_id=<?php echo $satir['sorus_id'];
    																							if($satir['sorus_file']!='Array'){
    																								echo "&delete_file=".rand(1000,9999).base64_encode($satir['sorus_file']);
    																							} ?>">
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