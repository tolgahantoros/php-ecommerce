<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

?>
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
	<?php require_once 'sidebar.php'; 
	if (empty($_GET['siparis'])) {
		header("location:siparisler.php");
		exit;
	}
	?>
	<div class="page-wrapper"> 
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h3 class="card-title">Sipariş Detayı</h3><br> 
							<?php 
							    $siparis_cek = $db->wread2("siparisler","id",$_GET['siparis']);
							    $siparis_cek = $siparis_cek->fetch(PDO::FETCH_ASSOC);
							if (isset($_POST['siparis_onayla'])) { 
							    
							
								$siparis_onayla = $db->update("siparisler",$_POST,[
									"form_name" => "siparis_onayla",
									"columns" => "id"
									]);
								if ($siparis_onayla['status']){
								        $urunler = htmlspecialchars_decode($siparis_cek['urunler_id']);
								        $urunler = json_decode($urunler); 
								        foreach($urunler as $key => $value) {
								            $uruncek = $db->wread2("urun","urun_id",$key);
									        $uruncek = $uruncek->fetch(PDO::FETCH_ASSOC); 
								            $update = $db->db->prepare("UPDATE urun SET urun_stok = :stok WHERE urun_id = :urun_id");
								            $stok = $urun['urun_stok'] - $siparis_cek['siparis_toplam'];
                                		    $up = $update->execute(['stok' => $stok < 0 ? 0 : $stok, 'urun_id' => $uruncek['urun_id']]);
								        }
									?>
									<div class="alert alert-success" role="alert">
									<strong>Tebrikler - </strong> Sipariş Onaylandı.
									</div>
									<?php
								}else{
									?>
									<div class="alert alert-danger" role="alert">
										<strong>Hata - </strong> <?php echo $siparis_onayla['error']; ?>
									</div>
									<?php 
								} 
							}



							$musteri_cek = $db->wread2("users","users_id",$siparis_cek['users_id']);
							$musteri_cek = $musteri_cek->fetch(PDO::FETCH_ASSOC);
							?>
							<div align="center">
								<h4 class="card-title">Müşteri Bilgileri: </h4><br> 
								Adı : <?php echo $musteri_cek['users_namesurname'] ?><br>
								Telefon : <?php echo $musteri_cek['users_phone'] ?><br>
								Mail : <?php echo $musteri_cek['users_mail'] ?><br>
								Cinsiyet : <?php echo $musteri_cek['users_gender'] ?><br><br><br>
								<h4 class="card-title">Sipariş Bilgileri: </h4><br> 
								<?php 

								$urunler = htmlspecialchars_decode($siparis_cek['urunler_id']);
								$urunler = json_decode($urunler); 
								$sayac=1;
								foreach ($urunler as $key => $value) {
									echo $sayac.". Ürünün Detayları : <br>";
									$uruncek = $db->wread2("urun","urun_id",$key);
									$uruncek = $uruncek->fetch(PDO::FETCH_ASSOC); 
									$kategoricek = $db->wread2("kategori","kategori_id",$uruncek['kategori_id']);
									$kategoricek = $kategoricek->fetch(PDO::FETCH_ASSOC);
									echo "Ürün adı : ".$uruncek['urun_ad']."<br>"; 
									echo "Ürün Fiyatı : ".$uruncek['urun_fiyat']."<br>"; 
									$indirimli_fiyat = $uruncek['urun_fiyat']*(100-$uruncek['urun_indirim'])/100;
									echo "Ürün <b>İndirimli</b> : ".$indirimli_fiyat."<br>"; 
									echo "Sipariş Adeti : ".$value."<br>"; 

									echo "Ürün URL: <a target=_blank href=https://".$_SERVER['HTTP_HOST']."/".$kategoricek['kategori_seourl']."/".$uruncek['urun_seourl'].">ÜRÜNÜ GÖRMEK İÇİN TIKLAYIN</a> "; 
									echo "<br><br>";
									$sayac++;
								}
								?>
								<hr>
								<form method="POST" action="">
									<div class="form-group">
										<div class="col-md-6 m-auto">
											<h4 class="card-title">Siparişi onaylamak için kargo takip numarasını girin:</h4>
											<div align="center"><label>Kargo Takip Numarası<br>(Boş bırakırsanız onaylanmış siparişler kısmından güncelleyebilirsiniz.)</label></div>
											<input type="text" name="kargo_takip" placeholder="Kargo Takip Numarası" class="form-control">
										</div>
									</div> 
									<input type="hidden" name="siparis_durum" value="1">
									<input type="hidden" name="id" value="<?php echo $siparis_cek['id']; ?>">
									<input type="submit" class="btn btn-success" name="siparis_onayla" value="Siparişi Onayla">
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