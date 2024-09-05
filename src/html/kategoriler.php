<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Meü Ceng Admin</title>
	<link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
	<link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
	<link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<link href="../dist/css/style.min.css" rel="stylesheet">
	<link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
	<script src="../dist/ckeditor/ckeditor.js"></script>

</head>

<body>
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
      </div> -->
      <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
      <?php require_once 'header.php'; ?>
      <?php require_once 'sidebar.php'; ?>
      <div class="page-wrapper">
       <div class="page-breadcrumb">
        <div class="row">
         <div class="col-5 align-self-center">
         </div>
       </div>
     </div>
     <div class="container-fluid"> 
      <div class="row">
       <div class="col-12">
        <div class="card">
         <div class="card-body">
          <div class="d-flex align-items-center mb-4">
           <h3 class="card-title">Kategoriler</h3>
           <div style="position: relative;top: 3%;left: 75%;">
            <a  data-toggle="collapse" href="#blogekle"
            aria-expanded="false" aria-controls="blogekle">
            <button type="button" class="btn btn-outline-success"><i
             class="fa fa-plus"></i> Kategori Ekle</button>
           </a>
         </div>
       </div>
       <?php 
       if (isset($_POST['kategoriekle'])) {
                                                // seo url ekle
        $_POST['kategori_seourl'] = $db->seo($_POST['kategori_ad']);
        $kategoriekle = $db->insert("kategori",$_POST,[
          "form_name" => "kategoriekle"
          ]);

        if ($kategoriekle['status']){
          ?>
          <div class="alert alert-success" role="alert">
           <strong>Tebrikler - </strong> Yeni Kategori Başarıyla Oluşturuldu.
         </div>
         <?php
       }else{
        ?>
        <div class="alert alert-danger" role="alert">
         <strong>Hata - </strong> <?php echo $kategoriekle['error']; ?>
       </div>
       <?php 
     } 
   }
   if (isset($_POST['kategoriguncelle'])) {
    									// seo url güncelle
    $_POST['kategori_seourl'] = $db->seo($_POST['kategori_ad']);
    $kategoriguncelle=$db->update("kategori",$_POST,[
      "form_name" => "kategoriguncelle",
      "columns" => "kategori_id"
      ]);
    if ($kategoriguncelle['status']){
      ?>
      <div class="alert alert-success" role="alert">
       <strong>Tebrikler - </strong> Yeni Kategori Başarıyla Güncellendi.
     </div>
     <?php
   }else{
    ?>
    <div class="alert alert-danger" role="alert">
     <strong>Hata - </strong> <?php echo $kategoriekle['error']; ?>
   </div>
   <?php 
 } 
}
if (isset($_GET['kategori_sil'])) {
 $kategori_sil = $db->delete("kategori","kategori_id",$_GET['kategori_sil']);
 if ($kategori_sil['status']){
  ?>
  <div class="alert alert-success" role="alert">
   <strong>Tebrikler - </strong> Kategori Başarıyla Silindi.
 </div>
 <?php
}else{
  ?>
  <div class="alert alert-danger" role="alert">
   <strong>Hata - </strong> <?php echo $kategoriekle['error']; ?>
 </div>
 <?php 
} 
}
?>
<div class="collapse" id="blogekle">
 <div class="card card-body">
  <form action="" method="POST" enctype="multipart/form-data">
   <div class="container-fluid">
    <div class="row">
     <div class="card-body"> 
      <div class="form-group">
       <div class="col-md-6 m-auto">
        <div align="center"><label>Üst Kategori</label></div>
        <select class="form-control" name="kategori_ust">
         <option value="0">Yok</option>
         <?php 

         $kategorisor = $db->wread2("kategori","kategori_ust",0);
         while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
          ?> 
          <option value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>
          <?php } ?>
        </select>
      </div>
    </div> 
    <div class="form-group">
      <div class="col-md-6 m-auto">
       <div align="center"><label>Kategori Adı</label></div>
       <input type="text" required="" name="kategori_ad" placeholder="Kategori Adı" class="form-control">
     </div>
   </div>
   <div class="form-group">
    <div class="col-md-6 m-auto">
     <div align="center"><label>Kategori Sıra</label></div>
     <input type="number" required="" name="kategori_sira" placeholder="Kategori Sırası" class="form-control">
   </div>
 </div>
 <div class="form-group">
  <div class="col-md-6 m-auto">
   <div align="center"><label>Kategori Title</label></div>
   <input type="text" required="" name="kategori_title" placeholder="Kategori Başlığı" class="form-control">
 </div>
</div>
<div class="form-group">
  <div class="col-md-6 m-auto">
   <div align="center"><label>Kategori Description</label></div>
   <input type="text" required="" name="kategori_description" placeholder="Kategori Açıklaması" class="form-control">
 </div>
</div>
<div class="form-group">
  <div class="col-md-6 m-auto">
   <div align="center"><label>Kategori Keyword</label></div>
   <input type="text" required="" name="kategori_keyword" placeholder="Kategori Anahtar Kelimeleri" class="form-control">
 </div>
</div>
<div class="form-group">
  <div class="col-md-6 m-auto">
   <div align="center"><label>Kategori Durumu</label></div>
   <div class="col-md-6 m-auto">
    <div class="custom-control custom-radio">
     <input type="radio" id="customRadio3" name="kategori_durum" value="1" 
     class="custom-control-input" checked>
     <label class="custom-control-label" for="customRadio3">Aktif</label>
   </div>
   <div class="custom-control custom-radio">
     <input type="radio" id="customRadio4" name="kategori_durum" value="0" 
     class="custom-control-input">
     <label class="custom-control-label" for="customRadio4">Pasif</label>
   </div>
 </div>
</div>
</div>
<div align="right" class="box-footer">
  <input type="submit" class="btn btn-success" name="kategoriekle" value="Kaydet">
  <a href="blogs.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
  </a>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
<div class="table-responsive">
  <table id="zero_config" class="table table-striped table-bordered no-wrap">
   <thead>
    <tr> 
     <th>Başlık</th> 
     <th>Üst</th>
     <th>Sıra</th>
     <th>Düzenle</th>
     <th>Sil</th>
   </tr>
 </thead>
 <tbody> 
  <?php 
  $kategorisor = $db->read("kategori","kategori_ad",[
   "columns" => "kategori_ad",
   "columns_sort" => "ASC"
   ]);
  while ($kategoricek=$kategorisor->Fetch(PDO::FETCH_ASSOC)) {
   ?> 
   <tr>
    <td><?php echo $kategoricek['kategori_ad'] ?></td>
    <td><?php if ($kategoricek['kategori_ust']==0) {
     echo "Yok";
   }else{
     $ustkategorisor=$db->wread("kategori","kategori_id",$kategoricek['kategori_ust']);
     echo $ustkategorisor['kategori_ad'];
   }?></td>
   <td><?php echo $kategoricek['kategori_sira'] ?></td> 
   <td align="center"><a  data-toggle="collapse" href="#duzenle<?php echo $say?>"
     aria-expanded="false" aria-controls="duzenle<?php echo $kategoricek['kategori_id']?>">
   </div> 
   <button type="button" class="btn btn-outline-success" data-toggle="modal"
   data-target="#duzenle<?php echo $kategoricek['kategori_id'] ?>"><i class="fas fa-cogs"></i></button>
 </div>
</a> 
<div id="duzenle<?php echo $kategoricek['kategori_id'] ?>" class="modal fade" tabindex="-1" role="dialog"
 aria-hidden="true">
 <div class="modal-dialog">
  <div class="modal-content">

   <div class="modal-body">
    <div class="text-center mt-2 mb-4">
     <a href="index.html" class="text-success">
      <span><img class="mr-2" src="../assets/images/logo-icon.png"
       alt="" height="18"><img
       src="../assets/images/logo-text.png" alt=""
       height="18"></span>
     </a>
   </div>
   <form method="POST" action="">
    <div class="form-group">
     <div class="col-md-6 m-auto">
      <div align="center"><label>Üst Kategori</label></div>
      <select class="form-control" name="kategori_ust">
       <option value="0">Yok</option>
       <?php 
       $ustkategorisor = $db->wread2("kategori","kategori_ust",0);
       while ($ustkategoricek=$ustkategorisor->fetch(PDO::FETCH_ASSOC)) {
        ?> 
        <option <?php 
        if ($ustkategoricek['kategori_id']==$kategoricek['kategori_ust']) {
         echo "selected";
       }
       ?> value="<?php echo $ustkategoricek['kategori_id']; ?>"><?php echo $ustkategoricek['kategori_ad']; ?></option>
       <?php } ?>
     </select>
   </div>
 </div>
 <div class="form-group">
  <div class="col-md-6 m-auto">
   <div align="center"><label>Kategori Adı</label></div>
   <input type="text" required="" name="kategori_ad" placeholder="Kategori Adı" value="<?php echo $kategoricek['kategori_ad'] ?>" class="form-control">
 </div>
</div>
<div class="form-group">
  <div class="col-md-6 m-auto">
   <div align="center"><label>Kategori Sıra</label></div>
   <input type="number" required="" name="kategori_sira" placeholder="Kategori Sırası" value="<?php echo $kategoricek['kategori_sira'] ?>" class="form-control">
 </div>
</div>
<div class="form-group">
  <div class="col-md-6 m-auto">
   <div align="center"><label>Kategori Title</label></div>
   <input type="text" required="" name="kategori_title" placeholder="Kategori Başlığı" value="<?php echo $kategoricek['kategori_title'] ?>" class="form-control">
 </div>
</div>
<div class="form-group">
  <div class="col-md-6 m-auto">
   <div align="center"><label>Kategori Description</label></div>
   <input type="text" required="" name="kategori_description" placeholder="Kategori Açıklaması" value="<?php echo $kategoricek['kategori_description'] ?>" class="form-control">
 </div>
</div>
<div class="form-group">
  <div class="col-md-6 m-auto">
   <div align="center"><label>Kategori Keyword</label></div>
   <input type="text" required="" name="kategori_keyword" placeholder="Kategori Anahtar Kelimeleri" value="<?php echo $kategoricek['kategori_keyword'] ?>" class="form-control">
 </div>
</div>
<div class="form-group">
  <div class="col-md-6 m-auto">
   <div align="center"><label>Kategori Durumu</label></div>
   <div class="col-md-6 m-auto">
    <div class="custom-control custom-radio">
     <input type="radio" id="customRadio3<?php echo $kategoricek['kategori_id']?>" name="kategori_durum" value="1" 
     class="custom-control-input" 
     <?php if ($kategoricek['kategori_durum']==1) {
      echo "checked";
    } ?>>
    <label class="custom-control-label" for="customRadio3<?php echo $kategoricek['kategori_id']?>">Aktif</label>
  </div>
  <div class="custom-control custom-radio">
   <input type="radio" id="customRadio4<?php echo $kategoricek['kategori_id']?>" name="kategori_durum" value="0" 
   <?php if ($kategoricek['kategori_durum']==0) {
    echo "checked";
  } ?> 
  class="custom-control-input">
  <label class="custom-control-label" for="customRadio4<?php echo $kategoricek['kategori_id']?>">Pasif</label>
</div>
</div>
</div>
</div>
<div align="right" class="box-footer">
  <input type="hidden" name="kategori_id" value="<?php echo $kategoricek['kategori_id'] ?>">
  <input type="submit" class="btn btn-success" name="kategoriguncelle" value="Kaydet">
  <a href="blogs.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
  </a>
</div>
</form>
</div>
</div>
</div>
</div></td> 
<td align="center"><a class="btn btn-outline-danger" href="?kategori_sil=<?php echo $kategoricek['kategori_id'] ?>"><i class="far fa-trash-alt"></i></a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php require_once 'footer.php'; ?>
</div>
</div>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<!-- apps -->
<script src="../dist/js/app-style-switcher.js"></script>
<script src="../dist/js/feather.min.js"></script>
<script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="../dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="../dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="../assets/extra-libs/c3/d3.min.js"></script>
<script src="../assets/extra-libs/c3/c3.min.js"></script>
<script src="../assets/libs/chartist/dist/chartist.min.js"></script>
<script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>
<script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
</body>

</html>