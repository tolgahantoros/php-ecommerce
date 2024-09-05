<?php require_once 'tema/header.php'; ?>
<?php  
if (empty($_SESSION['users']['users_id'])) {
	header("location:giris-yap?durum=oturum-ac");
	exit;
}

$users = $db->wread("users","users_id",$_SESSION['users']['users_id']);
?> 
<section class="bg0 p-t-75 p-b-220">
	<div class="container bootstrap snippet">
		<div class="row">
			<div class="col-sm-10"><h1><?php echo $users['users_namesurname'] ?></h1></div> 
		</div>
		<div class="row">
			<div class="col-sm-3"><!--left col-->


				<div class="text-center">
					<img src="images/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
					<h6>Fotoğrafınızı değiştirmek istiyorsanız yeni fotoğraf yükleyin.</h6>
					<form method="POST" action="" enctype="multipart/form-data">
						<input type="file" name="users_file" class="text-center center-block file-upload"><br>
						<button class="btn btn-lg btn-success pull-center" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Resmi Güncelle</button><br><br> 
					</form>
				</div></hr><br>

				<ul class="list-group">
					<li class="list-group-item text-muted">Aktiviteler <i class="fa fa-dashboard fa-1x"></i></li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Toplam Sipariş</strong></span> 50</li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Gönderimdeki Siparişler</strong></span> 8</li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Üyelik Günü</strong></span> 12</li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Beğenilen Ürün Sayısı</strong></span> 78</li>
				</ul> 

			</div><!--/col-3-->
			<div class="col-sm-9">
				<ul class="main-menu">
					<li class="active"><a data-toggle="tab" href="#ayarlar">Hesap Ayarları</a></li>
					<li><a data-toggle="tab" href="#bekleyen-siparisler">Bekleyen Siparişlerim</a></li>
					<li><a data-toggle="tab" href="#eski-siparisler">Tamamlanmış Siparişlerim</a></li>
					<li><a data-toggle="tab" href="#iade-siparisler">İade Alınan Siparişlerim</a></li>
				</ul>


				<div class="tab-content">
					<div class="tab-pane active" id="ayarlar">
						<h2>Hesap Ayarları</h2>
						<hr>
						<form class="form" action="##" method="post" id="registrationForm">

							<div class="form-group"> 
								<div class="col-xs-6">
									<label for="phone"><h4>Telefon numaranız</h4></label>
									<input type="tel" class="form-control" name="users_phone" id="phone-input" type="tel" value="<?php echo $users['users_phone'] ?>" placeholder="Telefon numaranızı girin" title="Telefon numaranızı girin.">
								</div>
							</div>

							<div class="form-group">

								<div class="col-xs-6">
									<label for="email"><h4>Email adresiniz</h4></label>
									<input type="email" class="form-control" name="users_mail" value="<?php echo $users['users_mail'] ?>" id="email" placeholder="Email adresinizi girin" title="Email adresinizi girin">
								</div>
							</div>
							<div class="form-group">

								<div class="col-xs-6">
									<label for="text"><h4>Kargo Adresiniz</h4></label>
									<input type="text" class="form-control" name="users_address" value="<?php echo $users['users_address'] ?>" id="location" placeholder="Adresinizi girin." title="Adresinizi girin">
								</div>
							</div>
							<div class="form-group">

								<div class="col-xs-6">
									<label for="text"><h4>Doğum Tarihiniz</h4></label>
									<input type="date" class="form-control" name="users_birth" value="<?php echo $users['users_birth'] ?>" id="location" placeholder="Adresinizi girin." title="Adresinizi girin">
								</div>
							</div>
							<div class="form-group">

								<div class="col-xs-6"> 
									<label><h4>Cinsiyetiniz</h4></label>
									<select name="users_gender" class="stext-111 cl2 plh3 size-116 p-l-12 p-r-30">
										<option <?php if ($users['users_gender']=='kadin') {
											echo "selected";
										} ?> value="kadin">Kadın</option>
										<option <?php if ($users['users_gender']=='erkek') {
											echo "selected";
										} ?> value="erkek">Erkek</option>
										<option <?php if ($users['users_gender']=='unisex') {
											echo "selected";
										} ?> value="unisex">Belirtmek İstemiyorum</option>
									</select> 
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-xs-12">
									<br>
									<button class="btn btn-lg btn-success" name="hesap_ayar_guncelle" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Güncelle</button>
									<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Vazgeç</button>
								</div>
							</div>
						</form>

						<hr>

					</div><!--/tab-pane--> 
					<?php require_once 'bekleyen-siparisler.php'; ?>
					<?php require_once 'eski-siparisler.php'; ?>
					<?php require_once 'iade-siparisler.php'; ?>

				</div><!--/tab-pane-->
			</div><!--/tab-content-->

		</div><!--/col-9-->
	</div><!--/row-->
</section>
<?php require_once 'tema/footer.php'; ?> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {


		var readURL = function(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('.avatar').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}


		$(".file-upload").on('change', function(){
			readURL(this);
		});
	});
</script>
<script type="text/javascript">
	function users_phone() { 
		var num = $(this).val().replace(/\D/g,''); 
		$(this).val(num.substring(0,1) + '(' + num.substring(1,4) + ')-' + num.substring(4,7) + '-' + num.substring(7,11)); 
	}
	$('[type="tel"]').keyup(users_phone);
</script>