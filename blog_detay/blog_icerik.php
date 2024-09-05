<?php 
if (empty($blogcek['blogs_title'])) { 
	header("location:http://localhost/scriptpanel/blog?durum=blog-bulunamadi");
	exit;
} 
?>
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
			Ana Sayfa
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<a href="blog.html" class="stext-109 cl8 hov-cl1 trans-04">
			Bloglar
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			<?php echo $blogcek['blogs_title']; ?>
		</span>
	</div>
</div>

<?php 


if (!empty($_POST['yorum_yap'])) {
	$yorum_ekle = $db->insert("blog_yorum",$_POST,[
		"form_name" => "yorum_yap"
		]);
	if ($yorum_ekle['status']) {
		echo '<script type="text/javascript">swal("Yorumunuz Gönderildi!","Yorumunuz şuan onay aşamasında. Herhangi bir hakaret içermediği sürece yorumunuz editörlerimiz tarafından onaylandıktan sonra yayımlanılacaktır.", "success",{button:"Tamam"});</script>';
	}else{
		echo '<script type="text/javascript">swal("Hata!","Yorumunuz gönderilemedi. Lütfen daha sonra tekrar deneyiniz.", "error",{button:"Tamam"});</script>';
	}
}

?>

<section class="bg0 p-t-52 p-b-20">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-9 p-b-80">
				<div class="p-r-45 p-r-0-lg">
					<!--  -->
					<div class="wrap-pic-w how-pos5-parent">
						<img src="../src/dimg/blogs/<?php echo $blogcek['blogs_file'] ?>" alt="<?php echo $blogcek['blogs_title'] ?>">

						<div class="flex-col-c-m size-123 bg9 how-pos5">
							<span class="ltext-107 cl2 txt-center">
								<?php echo substr($blogcek['blogs_tarih'], 8,2) ?>
							</span>

							<span class="stext-109 cl3 txt-center">
								<?php echo substr($blogcek['blogs_tarih'], 5,2)."/".substr($blogcek['blogs_tarih'], 0,4) ?>
							</span>
						</div>
					</div>

					<div class="p-t-32">
						<span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
							<span>
								<span class="cl4">Yazar</span> <?php echo $blogcek['blogs_yazar'] ?>  
								<span class="cl12 m-l-4 m-r-6">|</span>
							</span>

							<span>
								<?php echo $blogcek['blogs_kategori'] ?>
								<span class="cl12 m-l-4 m-r-6">|</span>
							</span>

							<span>
								<?php echo $blogcek['blogs_etiket'] ?>
							</span>
						</span>

						<?php 

						echo htmlspecialchars_decode($blogcek['blogs_makale']);

						?>
					</div>

					<div class="flex-w flex-t p-t-16">
						<span class="size-216 stext-116 cl8 p-t-4">
							TAGS
						</span>

						<div class="flex-w size-217">
							<?php 

							$etiketler = explode(" ", $blogcek['blogs_etiket']);

							foreach ($etiketler as $a) {
								echo '<a class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">';
								echo $a;
								echo '</a>';
							}

							?> 
						</div>
					</div>

					<!-- YORUMLAR -->
					<?php require_once 'blog_yorumlar.php' ?>
				</div>
			</div>

			<div class="col-md-4 col-lg-3 p-b-80">
				<div class="side-menu">
					<div class="bor17 of-hidden pos-relative">
						<form method="post" action="">
							<input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="ara" placeholder="Ara...">

							<button type="submit" class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
								<i class="zmdi zmdi-search"></i>
							</button>
						</form>
					</div>


					<?php require_once 'C:/AppServ/www/scriptpanel/blog_dosyalar/blog_onecikar.php' ?>

					<?php require_once 'C:/AppServ/www/scriptpanel/blog_dosyalar/blog_arsiv.php' ?>

					<div class="p-t-50">
						<h4 class="mtext-112 cl2 p-b-27">
							Etiketler
						</h4> 

						<div class="flex-w size-217">
							<?php 

							$etiketler = explode(" ", $blogcek['blogs_etiket']);

							foreach ($etiketler as $a) {
								echo '<a class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">';
								echo $a;
								echo '</a>';
							}

							?> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>	