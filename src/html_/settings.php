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
               <h3 class="card-title">Genel Site Ayarları</h3>
             </div>
             <?php 
             if(isset($_POST['settingupdate'])){  
              if (isset($_POST['delete_file'])) {
                $sonuc = $db->update("settings",$_POST,[
                  "form_name" => "settingupdate",
                  "columns" => "settings_id",
                  "dir" => "settings",
                  "file_name" => "settings_value",
                  "file_delete" => "delete_file"
                  ]);
              }else{
               $sonuc = $db->update("settings",$_POST,[
                "form_name" => "settingupdate",
                "columns" => "settings_id",
                "dir" => "settings"
                ]);
             }
             if ($sonuc['status']) {
              ?>
              <div class="alert alert-success" role="alert">
               <strong>Tebrikler - </strong> Ayarlar Başarıyla Güncellendi.
             </div>
             <?php
           }else{
            ?>
            <div class="alert alert-danger" role="alert">
             <strong>Hata - </strong> <?php echo $sonuc['error']; ?>
           </div>
           <?php
         }
       }elseif(isset($_GET['setting_sil'])){
         if ($_GET['settings_id']==$_SESSION['settings']['settings_id']) {
          header("Location:settings.php?hata=kendiHesabiniziSilemezsiniz");
          exit;
        }
        $harfsayisi=strlen($_GET['delete_file']);
        $_GET['delete_file'] = substr($_GET['delete_file'], 4,$harfsayisi);
        $sonuc = $db->delete("settings",
          "settings_id",
          $_GET['settings_id'],
          base64_decode($_GET['delete_file'])
          );
        if ($sonuc['status']) {
          ?>
          <div class="alert alert-success" role="alert">
           <strong>Tebrikler - </strong> Ayarı başarıyla sildiniz.
         </div>
         <?php
       }else{
        ?>
        <div class="alert alert-danger" role="alert">
         <strong>Hata - </strong> <?php echo $sonuc['error']; ?>
       </div>
       <?php
     }
   } ?>
   <div class="table-responsive">
    <table id="zero_config" class="table table-striped table-bordered no-wrap">
     <thead>
      <tr>
       <th>Düzenle</th>
       <th>Ad</th>
       <th>İçerik</th>
       <th>Key</th>
       <th>Sil</th>
     </tr>
   </thead>
   <tbody> 
    <?php 
    $settingcek=$db->read("settings",[
      "columns_name" => "settings_id",
      "columns_sort" => "ASC"
      ]);
    $say=0;
    while ($satir=$settingcek->fetch(PDO::FETCH_ASSOC)) {
     $say++;
     ?>
     <tr>
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
            <div class="text-center mt-2 mb-4">
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
                   <p>Güncellemek istemediğiniz alanları boş bırakabilirsiniz!</p>
                   <div class="form-group">
                    <div class="col-md-12 m-auto">
                     <div align="center"><label>Ad</label></div>
                     <input type="text" required=""  name="settings_description" placeholder="Ayar adı" value="<?php echo $satir['settings_description']; ?>" class="form-control">
                   </div>
                 </div>
                 <div class="form-group">
                  <div class="col-md-12 m-auto">
                   <div align="center"><label>İçerik</label></div>
                   <?php 
                   if ($satir['settings_type']=="text") {?> 
                   <input type="text" name="settings_value" placeholder="Ayar İçeriği" value="<?php echo $satir['settings_value']; ?>" class="form-control">
                   <?php
                 }elseif ($satir['settings_type']=="textarea") {?> 
                 <textarea rows="3" cols="50" name="settings_value"><?php echo $satir['settings_value']; ?></textarea>
                 <?php
               }elseif ($satir['settings_type']=="file") {?> 
               <a target="_blank" href=""><img width="100" src="../dimg/settings/<?php echo $satir['settings_value'];?>"></a>
               <?php
             }
             ?>

           </div>
         </div>
         <div class="form-group">
          <div class="col-md-12 m-auto">
           <div align="center"><label>Key</label></div>
           <input type="text" name="settings_key" placeholder="Ayar Keywords" value="<?php echo $satir['settings_key']?>" class="form-control">
         </div>
       </div>
       <?php 
       if ($satir['settings_type']=="file") {
        ?> 
        <div style="position:relative;left: 37%;">
         <fieldset class="form-group">
          <input type="file" name="settings_value" class="form-control-file" id="exampleInputFile">
        </fieldset>
      </div>
      <?php
    }

    ?>
    <div class="form-group">
      <div class="col-md-4 m-auto">
       <div align="center"><label>
        <br>Durum</label></div>
        <div class="col-md-4 m-auto">
         <div class="custom-control custom-radio">
          <input type="radio" id="customRadio3<?php echo $say ?>" name="settings_status" value="1" <?php 
          if ($satir['settings_status']==1) {
           ?> 
           checked
           <?php
         }
         ?> 
         class="custom-control-input" >
         <label class="custom-control-label" for="customRadio3<?php echo $say ?>">Aktif</label>
       </div>
       <div class="custom-control custom-radio">
        <input type="radio" id="customRadio4<?php echo $say ?>" name="settings_status" value="0" <?php 
        if ($satir['settings_status']==0) {
         ?> 
         checked
         <?php
       }
       ?> 
       class="custom-control-input">
       <label class="custom-control-label" for="customRadio4<?php echo $say ?>">Pasif</label>
     </div>
   </div>
 </div>
</div>
<div align="center" class="box-footer">
 <input type="hidden" name="settings_id" value="<?php echo $satir['settings_id'];?>">
 <?php 
 if ($satir['settings_type']=="file") {
  ?> 
  
  <input type="hidden" value="<?php if(isset($satir['settings_value'])){
    echo $satir['settings_value'];
  }else{echo "null";}?>" name="delete_file">

  <?php }  ?>

  <input type="submit" class="btn btn-success" name="settingupdate" value="Güncelle">
  <a href="settings.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
  </a>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
<td><?php echo $satir['settings_description']; ?></td>
<td><?php  
  echo mb_substr($satir['settings_value'],0,40)."<br>".mb_substr($satir['settings_value'],40,40)."<br>".mb_substr($satir['settings_value'],80,40)."<br>".mb_substr($satir['settings_value'],120,40)."<br>".mb_substr($satir['settings_value'],160,40); ?></td>
  <td><?php echo $satir['settings_key'] ?></td>
  <td align="center"><a class="btn btn-outline-danger" href="?setting_sil=True&settings_id=<?php echo $satir['settings_id'];
   if($satir['settings_file']!='Array'){
    echo "&delete_file=".rand(1000,9999).base64_encode($satir['settings_file']);
  } ?>">
  <i class="fas fa-trash-alt"></i></a>
</td>
</tr></form>

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