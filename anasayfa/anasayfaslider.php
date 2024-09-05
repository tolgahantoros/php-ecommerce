<section class="section-slide">
	<div class="wrap-slick1 rs2-slick1">
		<div class="slick1">


			<?php 
			$slidersor=$db->read("slider",[
				"columns_name" => "slider_sira",
				"columns_sort" => "ASC"
				]);
				while ($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC)) { ?>
				<div class="item-slick1 bg-overlay1" style="background-image: url(src/dimg/slider/<?php echo $slidercek['slider_file']; ?>);" data-thumb="src/dimg/slider/<?php echo $slidercek['slider_file']; ?>" data-caption="<?php echo $slidercek['slider_ad'] ?>">
					<div class="container h-full">
						<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 txt-center cl0 respon2">
									<?php echo htmlspecialchars_decode($slidercek['slider_yazi']) ?>
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
									<?php echo $slidercek['slider_ad'] ?>
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="<?php echo $slidercek['slider_link'] ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									<?php echo $slidercek['slider_buton'] ?>
								</a>
							</div>
						</div>
					</div>
				</div>  
				<?php } ?>
			</div>

			<div class="wrap-slick1-dots p-lr-10"></div>
		</div>
	</section>