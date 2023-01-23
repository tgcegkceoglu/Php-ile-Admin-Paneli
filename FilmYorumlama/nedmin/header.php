<?php 
   ob_start();
   session_start();
   include 'netting/baglan.php';
   $ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
   $ayarsor->execute(
    array(
       'id' => 0
    ));
   $ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

   $kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
   $kullanicisor->execute(
    array(
       'mail' => $_SESSION['kullanici_mail']
    ));
   $say=$kullanicisor->rowCount();
   $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

   if(!isset($_SESSION['kullanici_mail'])){
      header("Location:login.php");
   }
   if($say == 0){
    header("Location:login.php");
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Film Ve Dizi Yorumlama Sitesi</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

   

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <h6 class=" mx-3 m-3">Admin Paneli</h6>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="anasayfa.php">
                    <i class="fas fa-home"></i>
                    <span>Yönetim Paneli</span>
                </a>
            </li>
            
            <li class="nav-item" style="margin: 0 5px;">
                <a class="nav-link" href="hakkimizda-ayar.php" >
                    <i class="fas fa-info"></i>
                    <span>Hakkımızda</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                    <i class="fas fa-fw fa-blog"></i>
                    <span>Kullanıcılar</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="collapseFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kullanıcılar :</h6>
                        <a class="collapse-item" href="kullanici.php">Kullanıcılar</a>
                        <a class="collapse-item" href="kullanici-ekle.php">Kullanıcı Ekle</a>
                    </div>
                </div>
            </li>
            

            <li class="nav-item" style="margin: 0 3px;">
                <a class="nav-link" href="menu.php">
                    <i class="fas fa-bookmark"></i>
                    <span>Menüler</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-ellipsis-v"></i>
                    <span>Kategoriler</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Blog :</h6>
                        <a class="collapse-item" href="kategori.php">Kategoriler Yazıları</a>
                        <a class="collapse-item" href="kategori-ekle.php">Kategoriler Ekle</a>
                    </div>
                </div>
            </li>
            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-blog"></i>
                    <span>Blog</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Blog :</h6>
                        <a class="collapse-item" href="blog.php">Blog Yazıları</a>
                        <a class="collapse-item" href="blog-ekle.php">Blog Ekle</a>
                    </div>
                </div>
            </li>
            

           
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Ayarlar</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Ayarlar :</h6>
                        <a class="collapse-item" href="genel-ayar.php">Site Ayarları</a>
                        <a class="collapse-item" href="iletisim-ayar.php">İletişim Ayarları</a>
                        <a class="collapse-item" href="sosyal-ayar.php">Sosyal Ayarlar</a>
                    </div>
                </div>
            </li>
             <!-- Divider -->
             <hr class="sidebar-divider">
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $kullanicicek['kullanici_adsoyad']?></span>
                                <img style="width: 30px; height: 30px; object-fit: cover;" class="img-profile rounded-circle"
                                    src="../images/author/<?php echo $kullanicicek['kullanici_resim']?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Güvenli Çıkış
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->