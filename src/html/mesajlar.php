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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                          <?php  
                          if (isset($_GET['mesaj_durum'])) {
                              if ($_GET['mesaj_durum']==1) {
                                  $mesajokundu = $db->update("mesajlar",$_GET,[
                                    "columns" => "mesaj_id"
                                    ]);
                              }elseif($_GET['mesaj_durum']==0){
                                $mesajokundu = $db->update("mesajlar",$_GET,[
                                    "columns" => "mesaj_id"
                                    ]);
                            } 
                        }elseif(isset($_GET['mesaj_id'])) {
                           $mesajoku2 = $db->wread("mesajlar","mesaj_id",$_GET['mesaj_id']); ?>
                           <div class="container-fluid">
                               <form>
                                <div class="form-group">
                                    <div class="col-md-6 m-auto">
                                        <div align="center"><label>Mesaj ID</label></div>
                                        <input type="text" required="" name="blogs_title" value="<?php echo $mesajoku2['mesaj_id']; ?>" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 m-auto">
                                        <div align="center"><label>Ad Soyad</label></div>
                                        <input type="text" required="" name="blogs_title" value="<?php echo $mesajoku2['mesaj_adsoyad']; ?>" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 m-auto">
                                        <div align="center"><label>Email</label></div>
                                        <input type="text" required="" name="blogs_title" value="<?php echo $mesajoku2['mesaj_email']; ?>" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 m-auto">
                                        <div align="center"><label>Telefon No</label></div>
                                        <input type="text" required="" name="blogs_title" value="<?php echo $mesajoku2['mesaj_telefon']; ?>" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 m-auto">
                                        <div align="center"><label>Mesaj ID</label></div>
                                        <textarea rows="8" class="form-control" disabled=""><?php echo $mesajoku2['mesaj_icerik'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 m-auto">
                                        <div align="center"><label>Gönderenin İP Adresi</label></div>
                                        <input type="text" required="" name="blogs_title" value="<?php echo $mesajoku2['mesaj_ip']; ?>" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 m-auto">
                                        <div align="center"><label>Gönderilen Tarih</label></div>
                                        <input type="text" required="" name="blogs_title" value="<?php echo $mesajoku2['mesaj_tarih']; ?>" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 m-auto">
                                        <div align="center"><label>Okundu İşaretle</label><br>
                                        <a type="submit" href="?mesaj_id=<?php echo $mesajoku2['mesaj_id']."&"."mesaj_durum=0"; ?>"><button type="button" class="btn btn-outline-success">Okundu</button></a>
                                        <a href="mesajlar.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
                                        </a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div> 
                        <?php } ?>

                        <h4 class="card-title">Gelen Mesajlar</h4>
                        <div class="table-responsive">
                          <table id="multi_col_order"
                          class="table table-striped table-bordered display no-wrap" style="width:100%">
                          <thead>
                           <tr> 
                            <th>Ad Soyad</th> 
                            <th>Mesaj</th> 
                            <th>Tarih</th> 
                            <th>Oku</th>
                            <th>Okundu</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                       $mesajsor=$db->read("mesajlar",[
                        "columns_name" => "mesaj_id",
                        "columns_sort" => "DESC"
                        ]);
                       while($mesajcek=$mesajsor->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <tr> 
                         <td><?php echo $mesajcek['mesaj_adsoyad'] ?></td>  
                         <td><?php echo substr($mesajcek['mesaj_icerik'],0,20); ?>...<a href="?mesaj_id=<?php echo $mesajcek['mesaj_id']; ?>">Mesajı Aç</a></td> 
                         <td><?php echo $mesajcek['mesaj_tarih'] ?></td> 

                         <td><a href="?mesaj_id=<?php echo $mesajcek['mesaj_id'] ?>" class="btn btn-outline-success"><i class="fas fa-envelope-open"></i></a></td>
                         <td>
                             <?php 
                             if ($mesajcek['mesaj_durum']==1) {
                                 ?>   
                                 <a href="?mesaj_id=<?php echo $mesajcek['mesaj_id'] ?>&mesaj_durum=0" class="btn btn-outline-success">Okunmadı</a>
                                 <?php }else{?> 
                                 <a href="?mesaj_id=<?php echo $mesajcek['mesaj_id'] ?>&mesaj_durum=1" class="btn btn-outline-secondary">Okundu</a>
                                 <?php } ?>


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
</div>
</div>
<?php require_once 'footer.php'; ?>
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