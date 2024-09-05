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
							<h3 class="card-title">Toplu Fiyat İşlemleri</h3><br>
							<?php 

							if (isset($_POST['guncelle'])) {

								if ($_POST['islem']=="yuzde_arttir") {
									$urunler = $db->read("urun");
									$sayac=0;
									while ($urun_bilgisi=$urunler->fetch(PDO::FETCH_ASSOC)) {
										$guncelle['urun_id'] = $urun_bilgisi['urun_id'];
										$guncelle['urun_fiyat'] = $urun_bilgisi['urun_fiyat']*(100+$_POST['islem_orani'])/100;
										$yeni_fiyatlar = $db->update("urun",$guncelle,[
											"columns" => "urun_id"
											]);
										if ($yeni_fiyatlar['status']!=1) {
											echo "HATA!!!";
										}else{
											$sayac++;
										}
									}
									echo '<div class="alert alert-success" role="alert">
									<strong>Tebrikler - </strong> '.$sayac.' ürünün fiyatı güncellendi.</div>';
								}
								if ($_POST['islem']=="yuzde_dusur") {
									$urunler = $db->read("urun");
									$sayac=0;
									while ($urun_bilgisi=$urunler->fetch(PDO::FETCH_ASSOC)) {
										$guncelle['urun_id'] = $urun_bilgisi['urun_id'];
										$guncelle['urun_fiyat'] = $urun_bilgisi['urun_fiyat']*(100-$_POST['islem_orani'])/100;
										$yeni_fiyatlar = $db->update("urun",$guncelle,[
											"columns" => "urun_id"
											]);
										if ($yeni_fiyatlar['status']!=1) {
											echo "HATA!!!";
										}else{
											$sayac++;
										}
									}
									echo '<div class="alert alert-success" role="alert">
									<strong>Tebrikler - </strong> '.$sayac.' ürünün fiyatı güncellendi.</div>';
								}
								if ($_POST['islem']=="birim_arttir") {
									$urunler = $db->read("urun");
									$sayac=0;
									while ($urun_bilgisi=$urunler->fetch(PDO::FETCH_ASSOC)) {
										$guncelle['urun_id'] = $urun_bilgisi['urun_id'];
										$guncelle['urun_fiyat'] = $urun_bilgisi['urun_fiyat']+$_POST['islem_orani'];
										$yeni_fiyatlar = $db->update("urun",$guncelle,[
											"columns" => "urun_id"
											]);
										if ($yeni_fiyatlar['status']!=1) {
											echo "HATA!!!";
										}else{
											$sayac++;
										}
									}
									echo '<div class="alert alert-success" role="alert">
									<strong>Tebrikler - </strong> '.$sayac.' ürünün fiyatı güncellendi.</div>';
								}
								if ($_POST['islem']=="birim_dusur") {
									$urunler = $db->read("urun");
									$sayac=0;
									while ($urun_bilgisi=$urunler->fetch(PDO::FETCH_ASSOC)) {
										$guncelle['urun_id'] = $urun_bilgisi['urun_id'];
										$guncelle['urun_fiyat'] = $urun_bilgisi['urun_fiyat']-$_POST['islem_orani'];
										$yeni_fiyatlar = $db->update("urun",$guncelle,[
											"columns" => "urun_id"
											]);
										if ($yeni_fiyatlar['status']!=1) {
											echo "HATA!!!";
										}else{
											$sayac++;
										}
									}
									echo '<div class="alert alert-success" role="alert">
									<strong>Tebrikler - </strong> '.$sayac.' ürünün fiyatı güncellendi.</div>';
								}

							}

							?>
							<div align="center">
								<form method="POST" action=""> 
									<div class="form-group">
										<div class="col-md-6 m-auto">
											<div align="center"><label>İşlem seçeneği</label></div>
											<select name="islem" class="form-control">
												<option value="yuzde_arttir">Tüm fiyatları % yüzdesel olarak arttır</option>
												<option value="yuzde_dusur">Tüm fiyatları % yüzdesel olarak düşür</option>
												<option value="birim_arttir">Tüm fiyatları birim olarak arttır</option>
												<option value="birim_dusur">Tüm fiyatları birim olarak düşür</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 m-auto">
											<div align="center"><label>İşlem oranı veya birimi</label></div>
											<input type="numbber" required="" min="0" max="100" name="islem_orani" placeholder="İşlem oranı veya birimi." class="form-control">
										</div>
									</div>
									<input type="hidden" name="id" value="1">
									<h5>Sitenizdeki ürün sayısına göre bu işlem biraz zaman alabilir. Lütfen güncelleye bastıktan sonra sayfayı kapatmayınız.</h5>
									<button type="submit" name="guncelle" class="btn btn-outline-success">Güncelle</button> 
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

</html>