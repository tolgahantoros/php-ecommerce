<br><br><br>
<?php 
$yorum_sor = $db->wread2("blog_yorum","blogs_id",$blogcek['blogs_id'],[
	"columns_name" => "id",
	"columns_sort" => "DESC"
	]);
$yorum_sayisi=0;
while ($yorum_cek=$yorum_sor->fetch(PDO::FETCH_ASSOC)) {
	if ($yorum_cek['durum']==0) {
		continue;
	} 
	?>
	<div class="flex-w flex-t p-b-68">

		<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
			<img src="../images/avatar.png" alt="AVATAR">
		</div> 
		


		<div class="size-207">
			<div class="flex-w flex-sb-m p-b-17">
				<span class="mtext-107 cl2 p-r-20">
					<?php echo $yorum_cek['ad'] ?>
				</span>  
				<span class="mtext-107 cl2 p-r-20">
					<?php echo $yorum_cek['yorum_tarih'] ?>
				</span> 
			</div>

			<p class="stext-102 cl6">
				<?php echo $yorum_cek['yorum'] ?>
			</p>
		</div>
	</div>
	<?php $yorum_sayisi++; }
	if ($yorum_sayisi==0) {
		echo '<h5 align="center" class="mtext-108 cl2 p-b-7"> Henüz Yorum Yok! İlk Yorumu Sen Yapabilirsin. </h5><br><br>';
	}
	?>
	<div class="p-t-40">
		<h5 class="mtext-113 cl2 p-b-12">
			Yorum Yap
		</h5>

		<p class="stext-107 cl6 p-b-40"> 
			Email adresiniz yayınlanmayacak.
		</p>

		<form method="POST" action="">
			<?php 
			if (isset($_SESSION['users']['users_id'])) {
				$kullanici = $db->wread("users","users_id",$_SESSION['users']['users_id']); 
			} 
			?>
			<div class="bor19 m-b-20">
				<textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" required="" name="yorum" placeholder="Yorumunuz..."></textarea>
			</div>

			<div class="bor19 size-218 m-b-20">
				<input class="stext-111 cl2 plh3 size-116 p-lr-18" required="" type="text" name="ad" placeholder="Ad *">
			</div>

			<div class="bor19 size-218 m-b-20">
				<input class="stext-111 cl2 plh3 size-116 p-lr-18" required="" value="<?php if (isset($kullanici)) {
					echo $kullanici['users_mail'];
				} ?>" type="email" name="email" placeholder="Email *" > 
			</div>
			<?php 
			if (isset($kullanici)) {
				echo '<input type="hidden" name="users_id" value="'.$kullanici['users_id'].'">';
			}
			?>
			<input type="hidden" name="ip_adresi" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
			<input type="hidden" name="blogs_id" value="<?php echo $blogcek['blogs_id']; ?>">
			<input type="submit" name="yorum_yap" value="Yorumu Gönder" class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04"> 
		</form>
	</div>