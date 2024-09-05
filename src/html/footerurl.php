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
		$footerurlekle=$db->insert("footer",$_POST,[
			"form_name" => "ekle"
			]);
	}
	?>
	<form action="" method="POST">
		<select name="footer_baslik">
			<?php
			$baslikoku=$db->read("footerbaslik");
			while ($baslikcek=$baslikoku->fetch(PDO::FETCH_ASSOC)) {
				?>
				<option value="<?php echo $baslikcek['footer_baslik'] ?>"><?php echo $baslikcek['footer_baslik']?></option>
				<?php
			}
			?>
		</select><br>
		<input type="text" name="footer_ad" placeholder="footer ad"><br>
		<input type="text" name="footer_url" placeholder="url gir"><br>
		<input type="submit" name="ekle"><br>
	</form>
</body>
</html>