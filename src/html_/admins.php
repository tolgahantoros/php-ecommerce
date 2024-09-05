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
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
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
                                                <h3 class="card-title">Yöneticiler</h3>
                                                <div style="position: relative;top: 3%;left: 75%;">
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
                                                    "dir" => "admins",
                                                    "file_name" => "admins_file",
                                                    "pass" => "admins_pass"]
                                                    );
                                                if ($sonuc['status']) {
                                                    ?>
                                                    <div class="alert alert-success" role="alert">
                                                        <strong>Tebrikler - </strong> Yeni Yönetici Başarıyla Oluşturuldu.
                                                    </div>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong>Hata - </strong> <?php echo $sonuc['error']; ?>
                                                    </div>
                                                    <?php
                                                }
                                            }elseif(isset($_POST['adminupdate'])){ 

                                                $sonuc = $db->update("admins",$_POST,[
                                                    "form_name" => "adminupdate",
                                                    "columns" => "admins_id",
                                                    "dir" => "admins",
                                                    "file_name" => "admins_file",
                                                    "file_delete" => "delete_file", 
                                                    "pass" => "admins_pass"
                                                    ]);
                                                if ($sonuc['status']) {
                                                    ?>
                                                    <div class="alert alert-success" role="alert">
                                                        <strong>Tebrikler - </strong> Yönetici Başarıyla Güncellendi.
                                                    </div>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong>Hata - </strong> <?php echo $sonuc['error']; ?>
                                                    </div>
                                                    <?php
                                                }
                                            }elseif(isset($_GET['admin_sil'])){
                                                if ($_GET['admins_id']==$_SESSION['admins']['admins_id']) {
                                                    header("Location:admins.php?hata=kendiHesabiniziSilemezsiniz");
                                                    exit;
                                                }
                                                $harfsayisi=strlen($_GET['delete_file']);
                                                $_GET['delete_file'] = substr($_GET['delete_file'], 4,$harfsayisi);
                                                $sonuc = $db->delete("admins",
                                                    "admins_id",
                                                    $_GET['admins_id'],
                                                    base64_decode($_GET['delete_file'])
                                                    );
                                                if ($sonuc['status']) {
                                                    ?>
                                                    <div class="alert alert-success" role="alert">
                                                        <strong>Tebrikler - </strong> Yöneticiyi başarıyla sildiniz.
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
                                                <div class="collapse" id="adminekle">
                                                    <div class="card card-body">
                                                        <form action="" method="POST" enctype="multipart/form-data">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            <div class="col-md-4 m-auto">
                                                                                <div align="center"><label>Ad Soyad</label></div>
                                                                                <input type="text" required="" name="admins_namesurname" placeholder="Ad ve Soyad Giriniz." class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-md-4 m-auto">
                                                                                <div align="center"><label>Yönetici Yönetici Adı</label></div>
                                                                                <input type="text" required="" name="admins_username" placeholder="Yönetici Adını Giriniz." class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-md-4 m-auto">
                                                                                <div align="center"><label>Yönetici Şifre</label></div>
                                                                                <input type="password" required="" name="admins_pass" placeholder="Ad ve Soyad Giriniz." class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div style="position:relative;left: 37%;">
                                                                            <fieldset class="form-group">
                                                                                <input type="file" name="admins_file" class="form-control-file"  required=""  id="exampleInputFile">
                                                                            </fieldset>
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
                                                                <th>Düzenle</th>
                                                                <th>Sil</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            <?php 
                                                            $admincek=$db->read("admins",[
                                                                "columns_name" => "admins_id",
                                                                "columns_sort" => "ASC"
                                                                ]);
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

                                                                       <td align="center"><a  data-toggle="collapse" href="#duzenle<?php echo $say?>"
                                                                        aria-expanded="false" aria-controls="duzenle<?php echo $say?>">
                                                                    </div><!-- /.modal -->
                                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                                                    data-target="#duzenle<?php echo $say ?>"><i class="fas fa-cogs"></i></button>
                                                                </div>
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
                                                                                                <p>Güncellemek istemediğiniz<br>alanları boş bırakabilirsiniz!</p>
                                                                                                <div class="form-group">
                                                                                                    <img style="width: 60px;height: 60px;" src="../dimg/admins/<?php echo $satir['admins_file']?>">
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="col-md-12 m-auto">
                                                                                                        <div align="center"><label>Ad Soyad</label></div>
                                                                                                        <input type="text" required=""  name="admins_namesurname" placeholder="Ad ve Soyad Giriniz." value="<?php echo $satir['admins_namesurname']; ?>" class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="col-md-12 m-auto">
                                                                                                        <div align="center"><label>Yönetici Yönetici Adı</label></div>
                                                                                                        <input type="text" name="admins_username" placeholder="Yönetici Adını Giriniz." value="<?php echo $satir['admins_username']; ?>" class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="col-md-12 m-auto">
                                                                                                        <div align="center"><label>Yönetici Yeni Şifre</label></div>
                                                                                                        <input type="password" name="admins_pass" placeholder="Yönetici Yeni Şifresini Giriniz." class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div style="position:relative;left: 37%;">
                                                                                                    <fieldset class="form-group">
                                                                                                        <input type="file" name="admins_file" class="form-control-file" id="exampleInputFile">
                                                                                                    </fieldset>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="col-md-4 m-auto">
                                                                                                        <div align="center"><label>
                                                                                                            <br>Yönetici Durumu</label></div>
                                                                                                            <div class="col-md-4 m-auto">
                                                                                                                <div class="custom-control custom-radio">
                                                                                                                    <input type="radio" id="customRadio3<?php echo $say ?>" name="admins_status" value="1" <?php 
                                                                                                                    if ($satir['admins_status']==1) {
                                                                                                                        ?> 
                                                                                                                        checked
                                                                                                                        <?php
                                                                                                                    }
                                                                                                                    ?> 
                                                                                                                    class="custom-control-input" >
                                                                                                                    <label class="custom-control-label" for="customRadio3<?php echo $say ?>">Aktif</label>
                                                                                                                </div>
                                                                                                                <div class="custom-control custom-radio">
                                                                                                                    <input type="radio" id="customRadio4<?php echo $say ?>" name="admins_status" value="0" <?php 
                                                                                                                    if ($satir['admins_status']==0) {
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
                                                                                                        <input type="hidden" name="admins_id" value="<?php echo $satir['admins_id'];?>">
                                                                                                        <input type="hidden" value="<?php if(isset($satir['admins_file'])){
                                                                                                            echo $satir['admins_file'];
                                                                                                        }else{echo "null";}?>" name="delete_file">
                                                                                                        <input type="submit" class="btn btn-success" name="adminupdate" value="Güncelle">
                                                                                                        <a href="admins.php"><button type="button" class="btn btn-secondary">Vazgeç</button>
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td align="center"><a class="btn btn-outline-danger" href="?admin_sil=True&admins_id=<?php echo $satir['admins_id'];
                                                                                if($satir['admins_file']!='Array'){
                                                                                    echo "&delete_file=".rand(1000,9999).base64_encode($satir['admins_file']);
                                                                                } ?>">
                                                                                <i class="far fa-trash-alt"></i></a>
                                                                            </td>
                                                                        </tr>
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