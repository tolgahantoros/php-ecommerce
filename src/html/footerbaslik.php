<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	require_once '../netting/class.crud.php';
	require_once 'setconfig.php';
	$db = new crud();
	if (isset($_POST['ekle'])) {
		$footerbaslikekle=$db->insert("footerbaslik",$_POST,[
			"form_name" => "ekle"
			]);
	} 
	?>
	<form action="" method="POST">
		Başlık ekle<input type="text" name="footer_baslik">
		<input type="submit" name="ekle">
	</form>
</body>
</html>