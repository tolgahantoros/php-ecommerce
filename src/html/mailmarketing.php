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
	<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
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
	<?php // Gelen posta göre while ile mail durumu 1 olanlara mail gönder. ?>
	<div class="page-wrapper"> 
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h3 class="card-title">Email Marketing</h3><br>
							<div align="center">
								<p>Hazırladığınız mail sitenizin mail bültenine abone olan ve mail veritabanında bulunan adreslere gönderilecektir. İstiyorsanız aşağıdaki bağlantıdan veritabanınıza mail adresi ekleyebilirsiniz. Bu mailin gönderilmesini istemediğiniz kişileri <strong>karaliste</strong>'ye ekleyip mail gönderimini yaptıktan sonra karalisteden çıkarabilirsiniz.</p>
								<a href="mailekle.php">
									<button class="btn btn-outline-success waves-effect waves-light" type="button"><span
										class="btn-label"><i class="far fa-envelope"></i></span>
										Mail Ekle</button>
									</a>
									<a href="mailkaraliste.php">
										<button class="btn btn-outline-dark waves-effect waves-light" type="button"><span
											class="btn-label"><i class="fa fa-times"></i></span>
											Kara Liste</button>
										</a><br><br>
										<form method="POST" action="test.php"> 
											<p>Mail Adresiniz</p>
											<input type="text" name="from" placeholder="gorunen@mail.com"><br><br>
											<p>Mail Şifresi</p>
											<input type="password" name="pass" placeholder="******"><br><br>
											<p>SMTP PORT(Default 587)</p>
											<input type="text" name="smtp" value="587" placeholder="Default 587"><br><br>
											<p>Mail Konusu</p>
											<input type="text" name="konu" placeholder="Mailin Konusu"><br><br>
											<p>MAİL İÇERİĞİNİZ</p>
											<textarea name="icerik" cols="100" rows="6" align="center">Mail İçeriğiniz.</textarea>
											<script>
												CKEDITOR.replace( 'icerik' );
											</script><br>
											<button type="submit" class="btn btn-success"><i class="fas fa-check"></i>
												Mail'i Gönder</button>
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
