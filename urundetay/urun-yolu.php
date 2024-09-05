<?php 

if (!empty($_POST['yorumyap'])) {
	$yorumekle = $db->insert("urun_yorumlar",$_POST,[
		"form_name" => "yorumyap"
		]);
	if ($yorumekle['status']) {
		echo '<script type="text/javascript">swal("Yorumunuz Gönderildi!","Yorumunuz şuan onay aşamasında. Herhangi bir hakaret içermediği sürece yorumunuz editörlerimiz tarafından onaylandıktan sonra yayımlanılacaktır.", "success",{button:"Tamam"});</script>';
	}else{
		echo '<script type="text/javascript">swal("Hata!","Yorumunuz gönderilemedi. Lütfen daha sonra tekrar deneyiniz.", "error",{button:"Tamam"});</script>';
	}
}

?>
<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
	<a href="<?php echo $suanki_domain = 'http://'.$_SERVER['SERVER_NAME'].'/scriptpanel' ?>" class="stext-109 cl8 hov-cl1 trans-04">
		Ana Sayfa
		<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
	</a>

	<a href="<?php echo $suanki_domain.'/'.$kategori['kategori_seourl'] ?>" class="stext-109 cl8 hov-cl1 trans-04">
		<?php echo $kategori['kategori_ad'] ?>
		<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
	</a>

	<span class="stext-109 cl4">
		<?php echo $urun['urun_ad']; ?>
	</span>
</div>