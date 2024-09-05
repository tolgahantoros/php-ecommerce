<div class="p-t-65">
	<h4 class="mtext-112 cl2 p-b-33">
		Öne Çıkanlar
	</h4>


	<ul>
		<?php 
		$onecikanlar = $db->wread2("blogs","blogs_must",1);
		$sayac = 0;
		while ($onecikanlar_cek=$onecikanlar->fetch(PDO::FETCH_ASSOC)) { ?>
		<li class="flex-w flex-t p-b-30">
			<a href="<?php 
			// BLOG dizininde ilse 
			if (empty($_GET['icerik'])) {
				echo "blog/";
			}
			?><?php echo $onecikanlar_cek['blogs_seourl'] ?>" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
			<img width="90" src="<?php 
			if (!empty($_GET['icerik'])) {
			// BLOG içerik dizininde ise
				echo "../";
			}
			?>src/dimg/blogs/<?php echo $onecikanlar_cek['blogs_file'] ?>" alt="<?php echo $onecikanlar_cek['blogs_title'] ?>">
		</a>

		<div class="size-215 flex-col-t p-t-8">
			<a href="<?php echo $onecikanlar_cek['blogs_seourl'] ?>" class="stext-116 cl8 hov-cl1 trans-04">
				<?php echo $onecikanlar_cek['blogs_title'] ?>
			</a>
		</div>
	</li> 
	<?php 
	$sayac++;
	if ($sayac==4) {
		break;
	}
} ?>
</ul>
</div>
