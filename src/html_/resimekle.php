<?php 
ob_start();
session_start(); 

require_once '../netting/class.crud.php';
require_once 'setconfig.php';
$db = new crud();


if (!empty($_FILES)) {
	
	/*$temp=$_FILES['file']['tmp_name'];
	$dir_separator = DIRECTORY_SEPARATOR;
	$folder ="uploads";
	$destination_path=dirname(__FILE__).$dir_separator.$folder.$dir_separator;
	$target_path=$destination_path.$_FILES['file']['name'];
	move_uploaded_file($temp, $target_path);

	*/


	// DOSYA ISMINI PARCALA DOSYA ADI RANDOM SAYILARDAN ÖNCE GELSİN
	// UZANTIYI RESİM DOSYASINDA RESİM VİDEO DOSYASINDA VİDEO OLARAK AYIRT

	$uploads_dir = '../dimg/resimgaleri';
	@$tmp_name = $_FILES['file']["tmp_name"];
	@$name = $_FILES['file']["name"];
	$dosya_adi = strstr($name,".",true);
	$dosya_uzanti = strstr($name,".",false);
	$benzersizsayi1=rand(100000,999999);
	$benzersizad=$benzersizsayi1;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$dosya_adi-$benzersizad$dosya_uzanti");


	$_POST['resim_ad'] = $dosya_adi."-".$benzersizad.$dosya_uzanti;

	$resimekle = $db->insert("resimgaleri",$_POST);

}


?>