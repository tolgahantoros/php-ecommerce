<?php 
$blog_sayfa_basi_icerik_sayisi = $db->wread2("icerik_sayilari","alan","blog");
$blog_sayfa_basi_icerik_sayisi = $blog_sayfa_basi_icerik_sayisi->fetch(PDO::FETCH_ASSOC);
$sayfada = $blog_sayfa_basi_icerik_sayisi['sayi'];
$sorgu = $db->read("blogs");
$toplam_icerik=$sorgu->rowCount();
$toplam_sayfa = ceil($toplam_icerik / $sayfada);
$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
if($sayfa < 1) $sayfa = 1; 
if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
$limit = ($sayfa - 1) * $sayfada ;



$blogsor = $db->wread2("blogs","blogs_status",1,[
	"columns_name" => "blogs_id",
	"columns_sort" => "DESC",
	"limit" => $limit.",".$sayfada
	]);
	while ($blogcek=$blogsor->fetch(PDO::FETCH_ASSOC)) { ?>
	<div class="p-b-63">
		<a href="blog/<?php echo $blogcek['blogs_seourl'] ?>" class="hov-img0 how-pos5-parent">
			<img src="src/dimg/blogs/<?php echo $blogcek['blogs_file'] ?>" alt="IMG-BLOG">

			<div class="flex-col-c-m size-123 bg9 how-pos5">
				<span class="ltext-107 cl2 txt-center">
					<?php echo substr($blogcek['blogs_tarih'], 8,2) ?>
				</span>

				<span class="stext-109 cl3 txt-center">
					<?php echo substr($blogcek['blogs_tarih'], 5,2)."/".substr($blogcek['blogs_tarih'], 0,4) ?>
				</span>
			</div>
		</a>

		<div class="p-t-32">
			<h4 class="p-b-15">
				<a href="blog/<?php echo $blogcek['blogs_seourl'] ?>" class="ltext-108 cl2 hov-cl1 trans-04">
					<?php echo $blogcek['blogs_title'] ?>
				</a>
			</h4>

			<p class="stext-117 cl6">
				<?php echo strip_tags(mb_substr($blogcek['blogs_makale'],0,150)) ?><a href="blog/<?php echo $blogcek['blogs_seourl'] ?>">... Devamını okumak için tıklayın.</a>
			</p>

			<div class="flex-w flex-sb-m p-t-18">
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

				<a href="blog/<?php echo $blogcek['blogs_seourl'] ?>" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
					Devamını oku

					<i class="fa fa-long-arrow-right m-l-9"></i>
				</a>
			</div>
		</div>
	</div>
	<?php } ?>
