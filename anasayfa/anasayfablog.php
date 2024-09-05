<div class="container">
	<div class="p-b-66">
		<h3 class="ltext-105 cl5 txt-center respon1">
			Blog Yazılarımız
		</h3>
	</div>

	<div class="row">
		<?php  
		$blogsor = $db->wread2("blogs",'blogs_must',1);
		while ($blogcek=$blogsor->fetch(PDO::FETCH_ASSOC)) { ?>
		<div class="col-sm-6 col-md-4 p-b-40">
			
			<div class="blog-item">
				<div class="hov-img0">
					<a href="blog/<?php echo $blogcek['blogs_seourl'] ?>">
						<img src="src/dimg/blogs/<?php echo $blogcek['blogs_file'] ?>" alt="<?php echo $blogcek['blogs_title'] ?>">
					</a>
				</div>

				<div class="p-t-15">
					<div class="stext-107 flex-w p-b-14">
						<span class="m-r-3">
							<span class="cl4">
								Yazar
							</span>

							<span class="cl5">
								<?php echo $blogcek['blogs_yazar'] ?>
							</span>
						</span>

						<span>
							<span class="cl4">
								Tarih
							</span>

							<span class="cl5">
								<?php echo $blogcek['blogs_tarih'] ?>
							</span>
						</span>
					</div>

					<h4 class="p-b-12">
						<a href="blog/<?php echo $blogcek['blogs_seourl'] ?>" class="mtext-101 cl2 hov-cl1 trans-04">
							<?php echo $blogcek['blogs_title'] ?>
						</a>
					</h4>

					<p class="stext-108 cl6">
						<?php echo strip_tags(mb_substr($blogcek['blogs_makale'],0,80)) ?><a href="blog/<?php echo $blogcek['blogs_seourl'] ?>">... Devamını okumak için tıklayın.</a>
					</p>
				</div>
			</div>
		</div> 
		<?php } ?>
	</div>
</div>
