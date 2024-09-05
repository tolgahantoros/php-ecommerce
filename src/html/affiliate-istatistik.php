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
							<h3 class="card-title">UYARI!</h3> 
							<p>
								Müşteri ödeme işlemini gerçekleştirildikten sonra ortak bakiyesi otomatik olarak artar. Ürünlerde iade olma ihtimaline karşı önce siparişler kısmına tüm iade siparişleri güncelleyin böylece iade edilen ürünün ortaklık payını vermiş olmazsınız.
							</p>
							<h3 class="card-title">Affiliate nedir ve nasıl kullanılır?</h3><br><br>
							<p>
								Affiliate sistemi ortaklarınızın sitenize yönlendirdiği kullanıcılar sayesinde hem sizin hemde ortağınızın para kazanma sistemidir.<br><br>
								Ortağınızın sitenize yönlendirdiği her kullanıcının kullandığı telefona veya bilgisayara çerez ekleyerek kullanıcının 30 gün içerisinde yaptığı alışverişlerden ortağınızın pay almasını sağlarız. <br><br>
							</p>
							<h3 class="card-title">Ortaklık linke nereden ulaşabilirim ve nasıl kullanılır?</h3><br> 
							<p>
								Sol taraftaki menüde Affiliate menüsü altında Ortaklıklar sayfasına girin. Ortaklık linkine erişmek istediğiniz kullanıcının tabloda bulunduğu satırdaki <b>DÜZENLE</b> butonuna tıklayın. Açılan sekmede üst kısımda <b>Bu ortağın ortaklık linki:</b> yazısının devamındaki yazıyı soru işaretinden itibaren kopyalayın. <br><br>
								Örnek olarak <b>?affiliate=1</b> ortaklığını kullanalım. <br>
								Ortağınız bu GET değerini sitenizin istediği linkine kullanabilir. Bu değeri kullanmak istediği linkin sonuna yapıştırması gerekmektedir. Örneğin : <br>
								www.siteadresiniz.com/?affiliate=1 <br>
								www.siteadresiniz.com/(ORTAĞINIZIN SİTENİZDEN SEÇTİĞİ HERHANGİ BİR KATEGORİNİN LİNKİ)?affiliate=1 <br>
								www.siteadresiniz.com/(ORTAĞINIZIN SİTENİZDEN SEÇTİĞİ HERHANGİ BİR ÜRÜNÜN LİNKİ)?affiliate=1 <br><br>
							</p>
							<h3 class="card-title">Ek</h3><br> 
							<p>
								Ortaklıklar sayfasından ortağınızın sitenize getirdiği ziyaretçi sayısını, alışveriş sayısını görebilirsiniz.
								Anlaşmanıza göre ortağınıza ödemenizi yaptıktan sonra düzenle butonuna basarak ortağınızın bakiye ve diğer istatistiklerini sıfırlamanız gerekir.
							</p>
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