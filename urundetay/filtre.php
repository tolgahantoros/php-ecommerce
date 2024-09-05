<!-- Filter -->
<div class="dis-none panel-filter w-full p-t-10">
	<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
		<div class="filter-col4 p-r-15 p-b-27">
			<div class="mtext-102 cl2 p-b-15">
				Sırala
			</div>

			<ul>
				<li class="p-b-6">
					<a href="?sirala=otomatik" class="filter-link stext-106 trans-04 <?php if ($_GET['sirala']=="otomatik" OR empty($_GET['sirala'])) {
						echo "filter-link-active";
					} ?>">
					Otomatik
				</a>
			</li>

			<li class="p-b-6">
				<a href="?sirala=yeniler" class="filter-link stext-106 trans-04 <?php if ($_GET['sirala']=="yeniler") {
					echo "filter-link-active";
				} ?>">
				Yeniler
			</a>
		</li> 

		<li class="p-b-6">
			<a href="?sirala=artanfiyat" class="filter-link stext-106 trans-04 <?php if ($_GET['sirala']=="artanfiyat") {
				echo "filter-link-active";
			} ?>">
			Fiyat: Düşükten Yükseğe
		</a>
	</li>

	<li class="p-b-6">
		<a href="?sirala=azalanfiyat" class="filter-link stext-106 trans-04 <?php if ($_GET['sirala']=="azalanfiyat") {
			echo "filter-link-active";
		} ?>">
		Fiyat: Yüksekten Düşüğe
	</a>
</li>
</ul>
</div> 
</div>
</div>
</div>