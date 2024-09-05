<!-- her ürünün urun_turu_sini data-filtere yazdır ve ürün sayfasında da gerekli kısıma urun_turu_yi yazdır  -->
<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
	Tüm ürünler
</button>

<?php 
$urun_turu_sor=$db->wread2("urun_turleri","urun_turu_durum",1); 
while ($urun_turu_cek=$urun_turu_sor->fetch(PDO::FETCH_ASSOC)) {  ?>


<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".<?php echo $urun_turu_cek['id'] ?>">
	<?php echo $urun_turu_cek['urun_turu'] ?>
</button>



<?php } ?> 