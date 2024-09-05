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
							<h3 class="card-title">Ürün Seo</h3><br>
							<?php 
							if (isset($_POST['urunseoguncelle'])) {
								// print_r($_POST);
								$urunseoguncelle=$db->update("urun_seo",$_POST,[
									"form_name" => "urunseoguncelle",
									"columns" => "id"
									]);
								if ($urunseoguncelle) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> Başarıyla Güncellendi.
									</div>
									<?php
								}else{
									?>
									<div class="alert alert-error" role="alert">
										<strong>HATA - </strong> Güncellenirken Bir Sorun Oluştu.
									</div>
									<?php
								}
							}
							?>
							<p class="container-fluid" >
								Tüm ürün title ve descriptionlarınıza eklenecek olan kelimeleri buradan ekleyebilirsiniz. Title ve descriptiona gireceğiniz kelime tüm ürünlerinizin sayfadaki title ve description meta etiketinin sonuna eklenecektir. Trendyol,Hepsiburada ve n11 gibi büyük mağazalar bu yöntemi kullanmaktadır. <br><br>Title örneği : Örneğin hepsiburada title olarak ürünün tam adı ve sonuna <b>'Fiyatı'</b> kelimesini ekliyor. Trendyol ise <b> boş bırakarak </b>title'a sadece ürün adını yazdırıyor. N11 ise title'a ürün adı ve sonuna <b>'Fiyatı ve Özellikleri'</b> kelimesini ekliyor. Sizde bu sayfadan ürün title'inizin sonuna eklenecek olan kelimeleri girebilirsiniz.<br><br>
								Description Örneği: Örneğin trendyol description olarak ürün adı ve sonuna <b>'indirimlerle sahip olabilecek ve alışveriş alışkanlıklarınızı değiştireceksiniz.'</b> cümlesini ekliyor.<br> Hepsiburada ise ürün adı ve sonuna <b>'en iyi fiyatla Hepsiburada'dan satın alın! Şimdi indirimli fiyatla sipariş verin, ayağınıza gelsin!'</b> cümlesini ekliyor<br><br>
								N11 ise <b>en iyi özellikleri ve gerçek kullanıcı yorumları en ucuz fiyatlarla n11.com'da. Kampanyalı ve indirimli fiyatlarla satın al.</b> cümlesini kullanıyor.
							</p>
							<div align="center">
								<form method="POST" action=""> 
									<label>Ürün Title</label><br>
									<?php 
									$seocek = $db->wread("urun_seo","id",1);
									?>
									<div class="col-md-8 m-auto">
										<input class="form-control" value="<?php echo $seocek['urun_title'] ?>" type="text" maxlength="100" name="urun_title" placeholder="Title"><br>
									</div>
									
									<label>Ürün Description</label><br>
									<div class="col-md-8 m-auto">
										<input class="form-control" value="<?php echo $seocek['urun_description'] ?>" type="text" maxlength="100" name="urun_description" placeholder="Description"><br>
									</div>
									<input type="hidden" name="id" value="1">
									<button type="submit" name="urunseoguncelle" class="btn btn-outline-success">Güncelle</button>
									<a class="btn btn-outline-secondary" href="mailmarketing.php">Geri Dön</a>
								</form>
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

</html>s