<?php require_once 'urundetay/header.php'; 
$blogcek=$db->wread("blogs","blogs_seourl",$_GET['icerik']); 
?>

<?php require_once 'blog_detay/blog_icerik.php'; ?>
<?php require_once 'urundetay/footer.php'; ?>
