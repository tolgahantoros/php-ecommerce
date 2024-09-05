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

                          <div class="d-flex align-items-center mb-4">
                              <h3 class="card-title">İadeye Düşen Siparişler İADEDEN ONAY VEYA BEKLEMEYE ALINIRSA AFFİLİATEYE BAKİYE VE REFERANSINI EKLEMEYİ UNUTMA</h3>  
                          </div> 
                          <?php 
                          if (isset($_POST['siparisguncelle'])) {
 

                            $siparisguncelle = $db->update("siparisler",$_POST,[
                                "form_name" => "siparisguncelle",
                                "columns" => "id"
                                ]);

                            if ($_POST['siparis_durum']!=2) {
                                $siparis_cek = $db->wread2("siparisler","id",$_POST['id']);
                                $siparis_cek = $siparis_cek->fetch(PDO::FETCH_ASSOC);
                                if ($siparis_cek['affiliate_id']!=0) {
                                    $ortak = $siparis_cek['affiliate_id'];
                                    $ortakcek = $db->wread2("affiliate","id",$ortak);
                                    $ortakcek = $ortakcek->fetch(PDO::FETCH_ASSOC);
                                    unset($_POST);

                                    $_POST['id'] = $ortak;
                                    $_POST['bakiye'] = $ortakcek['bakiye'] + ($siparis_cek['siparis_toplam']*$ortakcek['oran'])/100;
                                    $_POST['referans'] = $ortakcek['referans'] + 1; 
                                    $ortak_guncelle = $db->update("affiliate",$_POST,[
                                        "columns" => "id"
                                        ]);
                                }
                            }

                            if ($siparisguncelle['status']){
                                ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Tebrikler - </strong> Sipariş Güncellendi.
                                    <?php 
                                    if ($siparis_cek['affiliate_id']!=0) {
                                       echo $ortakcek['ad_soyad']." isimli ortağın bakiye ve referansı arttrılırdı. Yeni bakiyesi:".$_POST['bakiye']; // bakiye kısmına $ortak_bakiye yazdırırsak db den eski değeri alır bu yüzden postu yazdırıyoruz tekrar db den yeni değeri çekmemize gerek yok.
                                    }
                                    ?>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Hata - </strong> <?php echo $siparisguncelle['error']; ?>
                                </div>
                                <?php 
                            } 
                        }
                        ?>
                        <div class="table-responsive">
                           <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                             <tr> 
                              <th>id</th>
                              <th>Müşteri Adı</th> 
                              <th>Sipariş Toplamı</th>
                              <th>Sipariş Tarihi</th> 
                              <th>Teslim Tarihi</th>
                              <th>Sipariş Durumu</th>
                              <th>Detay</th> 
                          </tr>
                      </thead>
                      <tbody> 
                         <?php 
                         $siparissor = $db->wread2("siparisler","siparis_durum",2);
                         while ($sipariscek=$siparissor->Fetch(PDO::FETCH_ASSOC)) {
                          ?> 
                          <tr>
                           <td><?php echo $sipariscek['id'] ?></td>
                           <td>
                            <?php  $kullanici = $sipariscek['users_id'];
                            $kullanici_cek = $db->wread2("users","users_id",$kullanici);
                            $kullanici_cek = $kullanici_cek->fetch(PDO::FETCH_ASSOC);
                            echo $kullanici_cek['users_namesurname'];
                            ?> 
                        </td>
                        <td><?php echo $sipariscek['siparis_toplam'] ?></td>  
                        <td><?php echo $sipariscek['siparis_tarih'] ?></td>
                        <td><?php echo $sipariscek['siparis_teslimtarih'] ?></td>
                        <td align="center">
                            <?php 
                            if($sipariscek['siparis_durum']!=2){
                             ?>
                             <a href="#">
                              <button type="button" class="btn btn-success btn-rounded">Belirsiz</button>
                          </a>
                          <?php
                      }else{
                         ?> 
                         <a href="#">
                          <button type="button" class="btn btn-danger btn-rounded">İade Alındı</button>
                      </a>
                      <?php } ?>
                  </td> 
                  <td align="center"><a  data-toggle="collapse" href="#duzenle<?php echo $say?>"
                     aria-expanded="false" aria-controls="duzenle<?php echo $sipariscek['id']?>">
                 </div> 
                 <button type="button" class="btn btn-outline-success" data-toggle="modal"
                 data-target="#duzenle<?php echo $sipariscek['id'] ?>"><i class="fas fa-cogs"></i></button>
             </div>
         </a> 
         <div id="duzenle<?php echo $sipariscek['id'] ?>" class="modal fade" tabindex="-1" role="dialog"
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
              <div align="center"><label>Kargo Takip Numarası</label></div>
              <input type="text" name="kargo_takip" placeholder="Kargo Takip Numarası" value="<?php echo $sipariscek['kargo_takip'] ?>" class="form-control">
          </div>
      </div> 
      <div class="form-group">
         <div class="col-md-6 m-auto">
          <div align="center"><label>Sipariş Durumu</label></div>
          <div class="col-md-6 m-auto">
           <div class="custom-control custom-radio">
            <input type="radio" id="customRadio3<?php echo $sipariscek['id']?>" name="siparis_durum" value="1" 
            class="custom-control-input" 
            <?php if ($sipariscek['siparis_durum']==1) {
             echo "checked";
         } ?>>
         <label class="custom-control-label" for="customRadio3<?php echo $sipariscek['id']?>">Onaylı Bırak</label>
     </div>
     <div class="custom-control custom-radio">
        <input type="radio" id="customRadio4<?php echo $sipariscek['id']?>" name="siparis_durum" value="0" 
        <?php if ($sipariscek['siparis_durum']==0) {
         echo "checked";
     } ?> 
     class="custom-control-input">
     <label class="custom-control-label" for="customRadio4<?php echo $sipariscek['id']?>">Beklemeye Al</label>
 </div>
 <div class="custom-control custom-radio">
     <input type="radio" id="customRadio5<?php echo $sipariscek['id']?>" name="siparis_durum" value="2" 
     class="custom-control-input" 
     <?php if ($sipariscek['siparis_durum']==2) {
         echo "checked";
     } ?>>
     <label class="custom-control-label" for="customRadio5<?php echo $sipariscek['id']?>">İade olarak işaretle</label>
 </div>
</div>
</div>
</div>
<div align="align" class="box-footer">
 <input type="hidden" name="id" value="<?php echo $sipariscek['id'] ?>">
 <input type="submit" class="btn btn-success" name="siparisguncelle" value="Kaydet">
 <a href="blogs.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
 </a>
</div>
</form>
</div>
</div>
</div>
</div></td>  
</tr>
<?php } ?>
</tbody>
</table>
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