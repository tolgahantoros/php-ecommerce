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
          <div class="row">
           <div class="col-12">
            <div class="card">
             <div class="card-body">
              <div class="d-flex align-items-center mb-4">
               <h3 class="card-title">Bloglar</h3>
               <div style="position: relative;top: 3%;left: 75%;">
                <a  data-toggle="collapse" href="#blogekle"
                aria-expanded="false" aria-controls="blogekle">
                <button type="button" class="btn btn-outline-success"><i
                 class="fa fa-plus"></i> Blog Ekle</button>
               </a>
             </div>
           </div>
           <?php 
           if (isset($_POST['bloginsert'])) {

            $seo = $db->seo($_POST['blogs_title']);
            $_POST['blogs_seourl']=$seo;
            $sonuc = $db->insert("blogs",$_POST,[
              "form_name" => "bloginsert",
              "dir" => "blogs",
              "file_name" => "blogs_file"
              ]);
            if ($sonuc['status']) {
              ?>
              <div class="alert alert-success" role="alert">
               <strong>Tebrikler - </strong> Yeni Blog Başarıyla Oluşturuldu.
             </div>
             <?php
           }else{
            ?>
            <div class="alert alert-danger" role="alert">
             <strong>Hata - </strong> <?php echo $sonuc['error']; ?>
           </div>
           <?php
         }
       }elseif(isset($_GET['blog_sil'])){
         if ($_GET['blogs_id']==$_SESSION['blogs']['blogs_id']) {
          header("Location:blogs.php?hata=kendiHesabiniziSilemezsiniz");
          exit;
        }
        $harfsayisi=strlen($_GET['delete_file']);
        $_GET['delete_file'] = substr($_GET['delete_file'], 4,$harfsayisi);
        $sonuc = $db->delete("blogs",
          "blogs_id",
          $_GET['blogs_id'],
          base64_decode($_GET['delete_file'])
          );
        if ($sonuc['status']) {
          ?>
          <div class="alert alert-success" role="alert">
           <strong>Tebrikler - </strong> Blogyi başarıyla sildiniz.
         </div>
         <?php
       }else{
        ?>
        <div class="alert alert-danger" role="alert">
         <strong>Hata - </strong> <?php echo $sonuc['error']; ?>
       </div>
       <?php
     }
   }elseif($_GET['hata']=="kendiHesabiniziSilemezsiniz"){
     ?> 
     <div class="alert alert-danger" role="alert">
      <strong>Hata - </strong> LÜTFEN KENDİ HESABINIZI SİLMEYE ÇALIŞMAYIN!
    </div>
    <?php } ?>
    <div class="collapse" id="blogekle">
      <div class="card card-body">
       <form action="" method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
         <div class="row">
          <div class="card-body"> 
            <div class="form-group">
              <div class="col-md-4 m-auto">
               <div align="center"><label>Blog Title</label></div>
               <input type="text" required="" name="blogs_title" placeholder="Blog title'i" class="form-control">
             </div>
           </div>
           <div class="form-group">
            <div class="col-md-4 m-auto">
              <div align="center"><label>Blog Keywords</label></div>
              <input type="text" required="" name="blogs_keywords" placeholder="Blog Keywords" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4 m-auto">
             <div align="center"><label>Blog Description</label></div>
             <textarea rows="3" cols="25" name="blogs_description">250 Harfi geçmesin.</textarea>
           </div>
         </div>
         <div class="form-group">
          <div class="col-md-12 m-auto">
            <div align="center"><label>Blog Yazısı</label></div>
            <textarea name="blogs_makale"></textarea>
            <script>
              CKEDITOR.replace( 'blogs_makale' );
              
            </script>
          </div>
        </div>
        <div style="position:relative;left: 37%;">
          <fieldset class="form-group">
           <input type="file" name="blogs_file" class="form-control-file"  required=""  id="exampleInputFile">
         </fieldset>
       </div>
       <div class="form-group">
        <div class="col-md-4 m-auto">
          <div align="center"><label>Blog Kategorisi</label></div>
          <input type="text" required="" name="blogs_kategori" placeholder="Yazının kategorisini girin." class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-4 m-auto">
          <div align="center"><label>Blog Etiketleri</label></div>
          <input type="text" required="" name="blogs_etiket" placeholder="Blog için etiketler girin." class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-4 m-auto">
          <div align="center"><label>Blog Yazar</label></div>
          <input type="text" required="" name="blogs_yazar" placeholder="Yazarın Ad Soyadını girin." class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-4 m-auto">
         <div align="center"><label>Blog Öne Çıkar</label></div>
         <div class="col-md-4 m-auto">
          <div class="custom-control custom-radio">
           <input type="radio" id="customRadio5" name="blogs_onecikar" value="1" 
           class="custom-control-input" checked>
           <label class="custom-control-label" for="customRadio5">Evet</label>
         </div>
         <div class="custom-control custom-radio">
           <input type="radio" id="customRadio6" name="blogs_onecikar" value="0" 
           class="custom-control-input">
           <label class="custom-control-label" for="customRadio6">Hayır</label>
         </div>
       </div>
     </div>
   </div>
   <div class="form-group">
    <div class="col-md-4 m-auto">
     <div align="center"><label>Blog Durumu</label></div>
     <div class="col-md-4 m-auto">
      <div class="custom-control custom-radio">
       <input type="radio" id="customRadio3" name="blogs_status" value="1" 
       class="custom-control-input" checked>
       <label class="custom-control-label" for="customRadio3">Aktif</label>
     </div>
     <div class="custom-control custom-radio">
       <input type="radio" id="customRadio4" name="blogs_status" value="0" 
       class="custom-control-input">
       <label class="custom-control-label" for="customRadio4">Pasif</label>
     </div>
   </div>
 </div>
</div>
<div align="right" class="box-footer">
  <input type="submit" class="btn btn-success" name="bloginsert" value="Kaydet">
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
      <th>#</th> 
      <th>Başlık</th>
      <th>Tarih</th>
      <th>Durum</th>
      <th>Düzenle</th>
      <th>Sil</th>
    </tr>
  </thead>
  <tbody> 
    <?php 
    $blogcek=$db->read("blogs",[
      "columns_name" => "blogs_id",
      "columns_sort" => "ASC"
      ]);
    $say = 1;
    while ($satir=$blogcek->fetch(PDO::FETCH_ASSOC)) {
     ?>
     <tr>
      <td><?php echo $say++; ?></td> 
      <td><?php echo mb_substr($satir['blogs_title'],0,40)."<br>".mb_substr($satir['blogs_title'],40,1000); ?></td>
      <td><?php echo $satir['blogs_tarih'];?></td>
      <td align="center">
       <?php 
       if ($satir['blogs_status']==1) {
        ?> 
        <button type="button" class="btn btn-success btn-rounded">Aktif</button>
        <?php
      }else{
        ?> 
        <button type="button" class="btn btn-danger btn-rounded">Pasif</button>
        <?php } ?>
      </td>
      <td align="center"><a href="blogduzenle.php?blogs_id=<?php echo $satir['blogs_id']; ?>" >
        <button type="button" class="btn btn-outline-success" ><i class="fas fa-cogs"></i></button>
      </a>

      <td align="center"><a class="btn btn-outline-danger" href="?blog_sil=True&blogs_id=<?php echo $satir['blogs_id'];
        if($satir['blogs_file']!='Array'){
         echo "&delete_file=".rand(1000,9999).base64_encode($satir['blogs_file']);
       } ?>">
       <i class="far fa-trash-alt"></i></a>
     </td>
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