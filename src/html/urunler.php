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
           <h3 class="card-title">Ürünler</h3>
           <div style="position: relative;top: 3%;left: 75%;">
            <a  data-toggle="collapse" href="#urunekle"
            aria-expanded="false" aria-controls="urunekle">
            <button type="button" class="btn btn-outline-success"><i
             class="fa fa-plus"></i> Ürün Ekle</button>
           </a>
         </div>
       </div>
       <?php 
       if (isset($_POST['urunekle'])) {
        if (strstr($_POST['urun_ad'],".")) {
          ?>
          <div class="alert alert-danger" role="alert">
            <strong>HATA - </strong> Ürün adında ' . '(Nokta) bulunamaz.
          </div>
          <?php 
        }else{

          if (empty($_POST['urun_seourl'])) {
           $_POST['urun_seourl'] = $db->seo($_POST['urun_ad']);
         }

         $_POST['urun_seourl'] = $_POST['urun_seourl']."-p-".rand("1000000000","9999999999");

         $ext=strtolower(substr($_FILES['urun_file']['name'], strpos($_FILES['urun_file']['name'],'.')));
         $_FILES['urun_file']['name'] = $_POST['urun_ad'].$ext;  
         $urunekle=$db->insert("urun",$_POST,[
          "form_name" => "urunekle",
          "dir" => "urun",
          "file_name" => "urun_file"
          ]);
         if ($urunekle['status']) {
          ?>
          <div class="alert alert-success" role="alert">
            <strong>Tebrikler - </strong> Ürün başarıyla eklendi.
          </div>
          <?php
        }else{
          ?>
          <div class="alert alert-danger" role="alert">
            <strong>Hata - </strong> <?php echo $sonuc['error']; ?>
          </div>
          <?php
        }
      }

    }

    if (isset($_GET['urunsil'])) {
      $harfsayisi=strlen($_GET['delete_file']);
      $_GET['delete_file'] = substr($_GET['delete_file'], 4,$harfsayisi);
      $sonuc = $db->delete("urun",
        "urun_id",
        $_GET['urun_id'],
        base64_decode($_GET['delete_file'])
        );
      if ($sonuc['status']) {
        ?>
        <div class="alert alert-success" role="alert">
          <strong>Tebrikler - </strong> Ürünü başarıyla sildiniz.
        </div>
        <?php
      }else{
        ?>
        <div class="alert alert-danger" role="alert">
          <strong>Hata - </strong> <?php echo $sonuc['error']; ?>
        </div>
        <?php
      }
    }


    ?>
    <div class="collapse" id="urunekle">
     <div class="card card-body">
      <form action="" method="POST" enctype="multipart/form-data">
       <div class="container-fluid">
        <div class="row">
         <div class="card-body"> 
          <div class="form-group">
           <div class="col-md-6 m-auto">
            <div align="center"><label>Ürün Kategorisi</label></div>
            <select class="form-control" name="kategori_id">
              <?php 
              $kategorisor = $db->read("kategori",[
                "columns_name" => "kategori_ad",
                "columns_sort" => "ASC"
                ]); 
                while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>
                <?php } ?> 
              </select>
            </div>
          </div>
          <div class="form-group">
           <div class="col-md-6 m-auto">
             <div align="center"><label>Ürün Türü</label></div>
             <select class="form-control" name="urun_tur">
              <?php 
              $urunturusor = $db->read("urun_turleri",[
                "columns_name" => "urun_turu",
                "columns_sort" => "ASC"
                ]); 
                while ($urunturucek=$urunturusor->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $urunturucek['id'] ?>"><?php echo $urunturucek['urun_turu'] ?></option>
                <?php } ?> 
              </select>
            </div>
          </div>
          <div class="form-group">
           <div class="col-md-6 m-auto">
             <div align="center"><label>Ürünün Sayfa Başlığı</label></div>
             <input type="text" required="" name="urun_title" placeholder="Ürün Sayfa Başlığı" class="form-control">
           </div>
         </div>
         <div class="form-group">
           <div class="col-md-6 m-auto">
             <div align="center"><label>Ürünün Sayfa Açıklaması</label></div>
             <input type="text" required="" name="urun_description" placeholder="Ürün Adı" class="form-control">
           </div>
         </div>
         <div class="form-group">
           <div class="col-md-6 m-auto">
             <div align="center"><label>Ürünün Seo URL'si (BOŞ BIRAKIRSANIZ ÜRÜN ADINA GÖRE SEO URL OLUŞTURULUR)
              <div class="alert alert-danger" role="alert">
              <strong>UYARI - </strong> SEO URL'sinde Türkçe karakter kullanmayın.
              </div>
            </label></div>
            <input type="text" required="" name="urun_seourl" placeholder="Ürün Seo URL'si" class="form-control">
          </div>
        </div>
        <div class="form-group">
         <div class="col-md-6 m-auto">
          <div align="center"><label>Ürün Adı</label></div>
          <input type="text" required="" name="urun_ad" placeholder="Ürün Adı" class="form-control">
        </div>
      </div>
      <div class="form-group">
       <div class="col-md-6 m-auto">
         <div align="center"><label>Ürün Cinsiyeti</label></div>
         <select class="form-control" name="urun_cinsiyet">
           <option value="erkek">Erkek</option>
           <option value="kadın">Kadın</option>
           <option value="unisex">Unisex</option>
         </select>
       </div>
     </div>
     <div class="form-group">
       <div class="col-md-12 m-auto">
         <div align="center"><label>Ürün Detay</label></div>
         <textarea required="" name="urun_detay"></textarea>
         <script>
           CKEDITOR.replace( 'urun_detay' );
         </script>
       </div>
     </div>
     <div align="center">
       <label>Ürün Fotoğrafı (Boyut 1200x1486 Olmalı)</label>
     </div>
     <div style="position:relative;left: 37%;"> 
       <fieldset class="form-group">
         <input type="file" name="urun_file" required="" class="form-control-file" id="exampleInputFile">
       </fieldset>
     </div>
     <div class="form-group">
       <div class="col-md-6 m-auto">
         <div align="center"><label>Ürün Fiyatı</label></div>
         <input type="number" required="" min="0" name="urun_fiyat" placeholder="Ürün Fiyatı" class="form-control">
       </div>
     </div>
     <div class="form-group">
       <div class="col-md-6 m-auto">
        <div align="center"><label>Ürün indirim Oranı (Yoksa 0)</label></div>
        <input type="number" required="" value="0" max="99" min="0" name="urun_indirim" placeholder="Ürün İndirim Oranı" class="form-control">
      </div>
    </div>
    <div class="form-group">
     <div class="col-md-6 m-auto">
      <div align="center"><label>Ürün Anahtar Kelimeler (Kelimeleri virgül ile ayırın.)</label></div>
      <input type="text" name="urun_keyword" placeholder="Ürün Anahtar Kelimeleri" class="form-control">
    </div>
  </div>
  <div class="form-group">
   <div class="col-md-6 m-auto">
     <div align="center"><label>Ürün Barkod</label></div>
     <input type="text" name="urun_barkod" placeholder="Ürün Barkodu" class="form-control">
   </div>
 </div>
 <div class="form-group">
   <div class="col-md-6 m-auto">
     <div align="center"><label>Ürün Stok</label></div>
     <input type="number" required="" min="1" name="urun_stok" placeholder="Ürün stok sayısı" class="form-control">
   </div>
 </div>
 <div class="form-group">
   <div class="col-md-6 m-auto">
    <div align="center"><label>Ürünü Anasayfaya Çıkar</label></div>
    <div class="col-md-6 m-auto">
     <div class="custom-control custom-radio">
      <input type="radio" id="customRadio5" name="urun_onecikar" value="1" 
      class="custom-control-input">
      <label class="custom-control-label" for="customRadio5">Evet</label>
    </div>
    <div class="custom-control custom-radio">
      <input type="radio" id="customRadio6" name="urun_onecikar" value="0" 
      class="custom-control-input" checked="">
      <label class="custom-control-label" for="customRadio6">Hayır</label>
    </div>
  </div>
</div>
</div> 
<div align="right" class="box-footer">
 <input type="submit" class="btn btn-success" name="urunekle" value="Kaydet">
 <a href="uruns.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
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
    <th>Ürün Adı</th> 
    <th>Tarih</th>
    <th>Durum</th>
    <th>Düzenle</th>
    <th>Sil</th>
  </tr>
</thead>
<tbody> 
  <?php 
  $urunsor = $db->read("urun",[
    "columns_name" => "urun_zaman",
    "columns_sort" => "DESC"
    ]);
  $say = 0;
  while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { $say++; ?>
  <tr>
    <td><?php echo $say; ?></td>
    <td><?php echo substr($uruncek['urun_ad'], 0,50)."<br>".substr($uruncek['urun_ad'], 50) ?></td>
    <td><?php echo substr($uruncek['urun_zaman'],0,10) ?></td>
    <td align="center"><?php 
      if ($uruncek['urun_durum']==1) {
       ?> 
       <button type="button" class="btn btn-success btn-rounded">Aktif</button>
       <?php
     }else{
       ?> 
       <button type="button" class="btn btn-danger btn-rounded">Pasif</button>
       <?php } ?></td>
       <td align="center"><a type="button" class="btn btn-outline-success" href="urunduzenle.php?urun_id=<?php echo $uruncek['urun_id'] ?>" ><i class="fas fa-cogs"></i></a></td>
       <td align="center"><a class="btn btn-outline-danger" href="?urunsil=True&urun_id=<?php echo $uruncek['urun_id']; if($uruncek['urun_file']!='Array'){
        echo "&delete_file=".rand(1000,9999).base64_encode($uruncek['urun_file']);
      }?>">
      <i class="far fa-trash-alt"></i></a>
    </td>
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