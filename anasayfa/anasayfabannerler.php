<!-- Banner  -->
<div class="sec-banner bg0 p-t-80 p-b-50">
	<div class="container">
		<div class="row">
			<?php 
			$bannersor = $db->wread2("anasayfa_banner","durum",1);
			while ($bannercek=$bannersor->fetch(PDO::FETCH_ASSOC)) { ?>
			<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
				<!-- Block1 -->
				<div class="block1 wrap-pic-w">
					<img src="src/dimg/banner/<?php echo $bannercek['banner_file'] ?>" alt="<?php echo $bannercek['aciklama'] ?>">

					<a href="<?php echo $bannercek['url'] ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
						<div class="block1-txt-child1 flex-col-l">
							<span class="block1-name ltext-102 trans-04 p-b-8">
								<?php echo $bannercek['baslik'] ?>
							</span>

							<span class="block1-info stext-102 trans-04">
								<?php echo $bannercek['aciklama'] ?>
							</span>
						</div>

						<div class="block1-txt-child2 p-b-4 trans-05">
							<div class="block1-link stext-101 cl0 trans-09"> 
								<?php echo $bannercek['buton'] ?> 
							</div>
						</div>
					</a>
				</div>
			</div> 
			<?php } ?>

		</div>
	</div>
</div>
