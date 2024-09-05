<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
	<title>OG - Admin Paneli</title>
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
          <div class="row">
           <div class="col-12">
            <div class="card">
             <div class="card-body">
              <div class="d-flex align-items-center mb-4">
               <h3 class="card-title">Slider</h3>
               <div style="position: relative;top: 3%;left: 75%;">
                <a  data-toggle="collapse" href="#sliderbaslikekle"
                aria-expanded="false" aria-controls="sliderbaslikekle">
                <button type="button" class="btn btn-outline-success"><i
                 class="fa fa-plus"></i> Slider Ekle</button>
               </a>
             </div>
           </div> <?php 
           if (isset($_POST['sliderekle'])) { 
    											// echo "<pre>";
    											// print_r($_POST);
    											// print_r($_FILES);
             $sliderekle=$db->insert("slider",$_POST,[
              "form_name" => "sliderekle",
              "dir" => "slider",
              "file_name" => "slider_file"
              ]);
             if ($sliderekle) {
              ?>
              <div class="alert alert-success" role="alert">
                <strong>Tebrikler - </strong> Slider Başarıyla Eklendi.
              </div>
              <?php
            }else{
              ?>
              <div class="alert alert-error" role="alert">
                <strong>HATA - </strong> Slider Eklenirken Bir Sorun Oluştu.
              </div>
              <?php
            }
          }
          if (isset($_POST['sliderupdate'])) {
           $silinecek = $_POST['sayac'];
           $_POST["slider_yazi"] = $_POST[$silinecek];
           unset($_POST[$silinecek]);
           unset($_POST['sayac']);
           // echo "<pre>";
           // echo $silinecek;
           // print_r($_POST);
           $sliderupdate=$db->update("slider",$_POST,[
            "form_name" => "sliderupdate",
            "columns" => "slider_id",
            "dir" => "slider",
            "file_name" => "slider_file",
            "file_delete" => "delete_file"
            ]);
           if ($sliderupdate) {
            ?>
            <div class="alert alert-success" role="alert">
              <strong>Tebrikler - </strong> Slider Başarıyla Güncellendi.
            </div>
            <?php
          }else{
            ?>
            <div class="alert alert-error" role="alert">
              <strong>HATA - </strong> Slider Güncellenirken Bir Sorun Oluştu.
            </div>
            <?php
          }
        }
        if ($_GET['slidersil']=="True") {
          $harfsayisi=strlen($_GET['delete_file']);
          $_GET['delete_file'] = substr($_GET['delete_file'], 4,$harfsayisi);
          $slidersil = $db->delete("slider","slider_id",$_GET['slider_id'],base64_decode($_GET['delete_file']));
          if ($slidersil) {
            ?>
            <div class="alert alert-success" role="alert">
             <strong>Tebrikler - </strong> Slider Başarıyla Silindi.
           </div>
           <?php
         }else{
          ?>
          <div class="alert alert-error" role="alert">
           <strong>HATA - </strong> Slider Silinirken Bir Sorun Oluştu.
         </div>
         <?php
       }
     }
     ?>
     <div class="collapse" id="sliderbaslikekle">
       <div class="card card-body">

        <form action="" method="POST" enctype="multipart/form-data">
         <div class="container-fluid">
          <div class="row">
           <div class="card-body"> 
            <div class="form-group">
             <div class="col-md-6 m-auto">
              <div align="center"><label>Slider Başlık</label></div>
              <input type="text" required="" name="slider_ad" placeholder="Slider Başlık" class="form-control">
            </div>
          </div>  
          <div class="form-group"  >
           <div class="col-md-4 m-auto">
            <fieldset class="form-group">
             <div align="center">Slider Resim (Boyut 1920x930 olmalı)</div><br>
             <input type="file" name="slider_file" class="form-control-file"  required=""  id="exampleInputFile">
           </fieldset>
         </div>   
       </div>
       <div class="form-group">
         <div class="col-md-12 m-auto">
          <div align="center"><label>Slider Yazısı</label></div>
          <textarea name="slider_yazi"></textarea>
          <script>
           CKEDITOR.replace( 'slider_yazi' );

         </script>
       </div>
     </div>
     <div class="form-group">
       <div class="col-md-6 m-auto">
        <div align="center"><label>Slider Sıra</label></div>
        <input type="number" required="" name="slider_sira" placeholder="Slider Sırası" class="form-control">
      </div>
    </div> 
    <div class="form-group">
     <div class="col-md-6 m-auto">
       <div align="center"><label>Slider Buton Yazısı</label></div>
       <input type="text" required="" name="slider_buton" placeholder="Slider Buton Yazısı" class="form-control">
     </div>
   </div> 
   <div class="form-group">
     <div class="col-md-6 m-auto">
      <div align="center"><label>Slider Link</label></div>
      <input type="text" required="" name="slider_link" placeholder="Slider Link" class="form-control">
    </div>
  </div> 
  <div class="form-group">
   <div class="col-md-6 m-auto">
    <div align="center"><label>Slider Durumu</label></div>
    <div class="col-md-6 m-auto">
     <div class="custom-control custom-radio">
      <input type="radio" id="customRadio3" name="slider_durum" value="1" 
      class="custom-control-input" checked>
      <label class="custom-control-label" for="customRadio3">Aktif</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="customRadio4" name="slider_durum" value="0" 
      class="custom-control-input">
      <label class="custom-control-label" for="customRadio4">Pasif</label>
    </div>
  </div>
</div>
</div>
<div align="center" class="box-slider">
 <input type="submit" class="btn btn-success" name="sliderekle" value="Kaydet">
 <a href="slider.php"><button type="button" class="btn btn-secondary">Vazgeç</button></a>
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
    <th>#</th>
    <th>Slider Başlık</th>
    <th>Slider Sırası</th>
    <th>Durum</th>
    <th>Düzenle</th>
    <th>Sil</th>
  </tr>
</thead>
<tbody> 
 <?php 
 $slidersor=$db->read("slider",[
  "columns_name" => "slider_id",
  "columns_sort" => "ASC"
  ]);
 $say = 1;
 while ($satir=$slidersor->fetch(PDO::FETCH_ASSOC)) {
  ?>
  <tr>
   <td><?php echo $say++; ?></td>
   <td><?php echo $satir['slider_ad']; ?></td>
   <td><?php echo $satir['slider_sira']; ?></td>
   <td align="center">
    <?php 
    if ($satir['slider_durum']==1) {
     ?> 
     <button type="button" class="btn btn-success btn-rounded">Aktif</button>
     <?php
   }else{
     ?> 
     <button type="button" class="btn btn-danger btn-rounded">Pasif</button>
     <?php } ?>
   </td>
   <td align="center"><a  data-toggle="collapse" href="#duzenle<?php echo $say?>"
     aria-expanded="false" aria-controls="duzenle<?php echo $say?>">
     <button type="button" class="btn btn-outline-success" data-toggle="modal"
     data-target="#duzenle<?php echo $say ?>"><i class="fas fa-cogs"></i></button>
   </a>
   <div id="duzenle<?php echo $say ?>" class="modal fade" tabindex="-1" role="dialog"
     aria-hidden="true">
     <div class="modal-dialog">
      <div class="modal-content">
       <div class="modal-body">
        <div class="text-center mt-2 mb-6">
         <a href="index.html" class="text-success">
          <span><img class="mr-2" src="../assets/images/logo-icon.png"
           alt="" height="18"><img
           src="../assets/images/logo-text.png" alt=""
           height="18"></span>
         </a>
       </div>
       <form action="" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
         <div class="row">
          <div class="card-body"> 
           <div class="form-group">
            <div class="col-md-6 m-auto">
             <div align="center"><label>Slider Başlık</label></div>
             <input type="text" required="" name="slider_ad" value="<?php echo $satir['slider_ad'] ?>" placeholder="Slider Başlık" class="form-control">
           </div>
         </div>  
         <div class="form-group"  >
          <div class="col-md-6 m-auto">
           <fieldset class="form-group">
            <div align="center">Slider Resim (Boyut 1920x930 olmalı)</div><br>
            <img  class="form-control-file" src="../dimg/slider/<?php echo $satir['slider_file']?>"><br> 
            <input type="file" name="slider_file" class="form-control-file" id="exampleInputFile">
          </fieldset>
        </div>   
      </div>
      <div class="form-group">
        <div class="col-md-12 m-auto">
         <div align="center"><label>Slider Yazısı</label></div>
         <textarea name="slider_yazi<?php echo $satir["slider_id"] ?>"><?php echo $satir['slider_yazi']?></textarea>
         <script>
          CKEDITOR.replace( 'slider_yazi<?php echo $satir["slider_id"] ?>' );

        </script>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6 m-auto">
       <div align="center"><label>Slider Sıra</label></div>
       <input type="number" required="" name="slider_sira" placeholder="Slider Sırası" value="<?php echo $satir['slider_sira']?>" class="form-control">
     </div>
   </div> 
   <div class="form-group">
     <div class="col-md-6 m-auto">
       <div align="center"><label>Slider Buton Yazısı</label></div>
       <input type="text" required="" name="slider_buton" placeholder="Slider Buton Yazısı" value="<?php echo $satir['slider_buton']?>" class="form-control">
     </div>
   </div> 
   <div class="form-group">
    <div class="col-md-6 m-auto">
     <div align="center"><label>Slider Link</label></div>
     <input type="text" required="" name="slider_link" placeholder="Slider Link" value="<?php echo $satir['slider_link']?>" class="form-control">
   </div>
 </div> 
 <div class="form-group">
  <div class="col-md-6 m-auto">
   <label>slider Durumu</label>
   <div class="col-md-6 m-auto">
    <div class="custom-control custom-radio">
     <input type="radio" id="customRadio7<?php echo $satir['id'];?>" name="slider_durum" value="1" 
     class="custom-control-input" checked>
     <label class="custom-control-label" for="customRadio7<?php echo $satir['id'];?>">Aktif</label>
   </div>
   <div class="custom-control custom-radio">
     <input type="radio" id="customRadio8<?php echo $satir['id'];?>" name="slider_durum" value="0" 
     class="custom-control-input">
     <label class="custom-control-label" for="customRadio8<?php echo $satir['id'];?>">Pasif</label>
   </div>
 </div>
</div>
</div> 

<div align="center" class="box-slider">
  <input type="hidden" name="slider_id" value="<?php echo $satir['slider_id'];?>">
  <input type="hidden" value="slider_yazi<?php echo $satir['slider_id']?>" name="sayac">
  <input type="hidden" value="<?php if(isset($satir['slider_file'])){
   echo $satir['slider_file'];
 }else{echo "null";}?>" name="delete_file">
 <input type="submit" class="btn btn-success" name="sliderupdate" value="Güncelle">
 <a href="menu.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
 </a>
</div>
</div>
</div>
</div>
<td align="center"><a class="btn btn-outline-danger" href="?slidersil=True&slider_id=<?php echo $satir['slider_id']; if($satir['admins_file']!='Array'){
  echo "&delete_file=".rand(1000,9999).base64_encode($satir['slider_file']);
}?>">
<i class="far fa-trash-alt"></i></a>
</td>
</form>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
<?php require_once 'slider.php'; ?>
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