<?php 

$affiliate = $db->wread2("affiliate","id",$_GET['affiliate']);
$affiliate = $affiliate->fetch(PDO::FETCH_ASSOC);
// gelen ortaklık linki var mı ve geçerli mi  ?
if (!empty($affiliate) AND $affiliate['durum']==1) {
	setcookie("siteurlmiz_affiliate",$_GET['affiliate'],strtotime('+30 day'));
	// çerezi yaptın şimdide ziyaretçi mevzusunu yap çerezde varsa arttırma çerez yoksa arttır
	if (empty($_COOKIE['siteurlmiz_affiliate']) OR $_COOKIE['siteurlmiz_affiliate']!=$_GET['affiliate']) {
		// Çerez yok ise veya çerezdeki affiliate başka birisinin affiliatesi ise kullanıcının ziyaretçi sayısını arttır.
		unset($_POST);
		$_POST['ziyaret'] = $affiliate['ziyaret'] + 1;
		$_POST['id'] = $affiliate['id'];
		
		$affiliate_update = $db->update("affiliate",$_POST,[
			"columns" => "id"
			]);
			

	}
}


?>