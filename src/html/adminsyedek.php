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
                                                <h3 class="card-title">Yöneticilar</h3>
                                                <div style="position: absolute;top: 3%;left: 80%;">
                                                    <a  data-toggle="collapse" href="#adminekle"
                                                    aria-expanded="false" aria-controls="adminekle">
                                                    <button type="button" class="btn btn-outline-success"><i
                                                        class="fa fa-plus"></i> Yönetici Ekle</button>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php 
                                            if (isset($_POST['admininsert'])) {
                                                $sonuc = $db->insert("admins",$_POST,[
                                                    "form_name" => "admininsert",
                                                    "pass" => "admins_pass"]
                                                    );
                                                if ($sonuc['status']) {
                                                    ?>
                                                    <div class="alert alert-success" role="alert">
                                                    <strong>Başarılı - </strong> Yeni Yönetici Başarıyla Oluşturuldu.
                                                    </div>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong>Hata - </strong> Yönetici Oluşturulurken Bir Şeyler Ters Gitti.
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <div class="collapse" id="adminekle">
                                                <div class="card card-body">
                                                    <form action="" method="POST">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 m-auto">
                                                                            <div align="center"><label>Ad Soyad</label></div>
                                                                            <input type="text" name="admins_namesurname" placeholder="Ad ve Soyad Giriniz." class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 m-auto">
                                                                            <div align="center"><label>Yönetici Yönetici Adı</label></div>
                                                                            <input type="text" name="admins_username" placeholder="Yönetici Adını Giriniz." class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 m-auto">
                                                                            <div align="center"><label>Yönetici Şifre</label></div>
                                                                            <input type="password" name="admins_pass" placeholder="Ad ve Soyad Giriniz." class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="col-md-4 m-auto">
                                                                            <div align="center"><label>Yönetici Durumu</label></div>
                                                                            <div class="col-md-4 m-auto">
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" id="customRadio1" name="admins_status" value="1" 
                                                                                    class="custom-control-input" checked>
                                                                                    <label class="custom-control-label" for="customRadio1">Aktif</label>
                                                                                </div>
                                                                                <div class="custom-control custom-radio">
                                                                                    <input type="radio" id="customRadio2" name="admins_status" value="0" 
                                                                                    class="custom-control-input">
                                                                                    <label class="custom-control-label" for="customRadio2">Pasif</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div align="right" class="box-footer">

                                                                        <input type="submit" class="btn btn-success" name="admininsert" value="Kaydet">
                                                                        <a href="admins.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
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
                                                            <th>Ad Soyad</th>
                                                            <th>Kullanıcı Adı</th>
                                                            <th>Durum</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> 
                                                        <?php 
                                                        $admincek=$db->read("admins");
                                                        while ($satir=$admincek->fetch(PDO::FETCH_ASSOC)) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo ++$say; ?></td>
                                                                <td><?php echo $satir['admins_namesurname']; ?></td>
                                                                <td><?php echo $satir['admins_username']; ?></td>
                                                                <td align="center">
                                                                    <?php 
                                                                    if ($satir['admins_status']==1) {
                                                                        ?> 
                                                                        <button type="button" class="btn btn-success btn-rounded">Aktif</button>
                                                                        <?php
                                                                    }else{
                                                                     ?> 
                                                                     <button type="button" class="btn btn-danger btn-rounded">Pasif</button>
                                                                     <?php } ?>
                                                                 </td>
                                                                 <td align="center"></td>
                                                                 <td align="center">$320,800</td>
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