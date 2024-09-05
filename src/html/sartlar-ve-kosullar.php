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
	<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>

<body>

	<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
	data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
	<?php require_once 'header.php'; ?>
	<?php require_once 'sidebar.php'; ?>
	<div class="page-wrapper"><?php 
		if (isset($_POST['hakkimizdaupdate'])) { 
			$guncelle = $db->update("hakkimizda",$_POST,[
				"form_name" => "hakkimizdaupdate",
				"columns" => "id"
				]);

		}
		?>
		<form action="" method="POST">

			<div class="form-group">
				<div class="col-md-12 m-auto">
					<div align="center"><label>Şartlar Ve Koşullar Yazısı</label></div>
					<textarea name="icerik"><?php $hakkimizdacek=$db->wread("hakkimizda","id",3);
						echo $hakkimizdacek['icerik'];
						?></textarea>
						<script>
							CKEDITOR.replace( 'icerik' );
						</script>
					</div>
				</div>
				<div align="center" class="box-footer">
				<input type="hidden" name="id" value="3">
					<input type="submit" class="btn btn-success" name="hakkimizdaupdate" value="Güncelle">
					<a href="blogs.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
					</a>
				</div>
			</form>
			<?php require_once 'footer.php'; ?>
		</div>
	</div>
	<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
	<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="../dist/js/app-style-switcher.js"></script>
	<script src="../dist/js/feather.min.js"></script>
	<script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
	<script src="../dist/js/sidebarmenu.js"></script>
	<script src="../dist/js/custom.min.js"></script>
	<script src="../assets/extra-libs/c3/d3.min.js"></script>
	<script src="../assets/extra-libs/c3/c3.min.js"></script>
	<script src="../assets/libs/chartist/dist/chartist.min.js"></script>
	<script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
	<script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
	<script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>
</body>

</html>