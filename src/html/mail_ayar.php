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
							<h3 class="card-title">Email Ayarları</h3><br>
							<?php 
							if (isset($_POST['guncelle'])) {
								$guncelle = $db->update("mail_ayar",$_POST,[
									"form_name" => "guncelle",
									"columns" => "id"
									]);
								if ($guncelle['status']) {
									?>
									<div class="alert alert-success" role="alert">
										<strong>Tebrikler - </strong> Mail Ayarları Başarıyla Güncellendi.
									</div>
									<?php
								}else{
									?>
									<div class="alert alert-danger" role="alert">
										<strong>Hata - </strong> <?php echo $guncelle['error']; ?>
									</div>
									<?php
								}
							}


							$mail_ayarlar = $db->read("mail_ayar");
							$mail_ayarlar = $mail_ayarlar->fetch(PDO::FETCH_ASSOC);  
							?>
							<div align="center">
								<form method="POST" action=""> 
									<div class="form-group">
										<div class="col-md-6 m-auto">
											<div align="center"><label>Otomatik Maillerin Gönderileceği Adres</label></div>
											<input type="email" required="" value="<?php echo $mail_ayarlar['mail_adres']; ?>" name="mail_adres" placeholder="Otomatik Maillerin Gönderileceği Adresi Giriniz." class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 m-auto">
											<div align="center"><label>Maillerde Yazılacak Ad Soyad(Şirketinizin adı)</label></div>
											<input type="text" required="" value="<?php echo $mail_ayarlar['mail_adsoyad']; ?>" name="mail_adsoyad" placeholder="Maillerde Yazılacak Ad Soyadı Giriniz." class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 m-auto">
											<div align="center"><label>Mail Host</label></div>
											<input type="text" required="" value="<?php echo $mail_ayarlar['mail_host']; ?>" name="mail_host" placeholder="Mail Host'u Giriniz." class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 m-auto">
											<div align="center"><label>Mail Şifresi</label></div>
											<input type="password" required="" value="<?php echo $mail_ayarlar['mail_pass']; ?>" name="mail_pass" placeholder="Mail Şifresini Giriniz." class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 m-auto">
											<div align="center"><label>SMTP PORT DEĞERİ(Default 587)</label></div>
											<input type="text" required="" value="<?php echo $mail_ayarlar['mail_smtp']; ?>" name="mail_smtp" placeholder="SMTP Değerini Giriniz." class="form-control">
										</div>
									</div>
									<input type="hidden" name="id" value="1">
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