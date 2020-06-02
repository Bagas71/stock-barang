<?php 
require 'functions.php';

// pagination
$jumlahDataPerhalaman = 4;
$jumlahData = count(query("SELECT tabel_barang.id, tabel_barang.nama_barang, 
                tabel_barang.harga_barang, tabel_jenis_barang.jenis_barang, 
                tabel_barang.stock_barang, tabel_barang.gambar 
                FROM tabel_barang 
                JOIN tabel_jenis_barang 
                ON tabel_jenis_barang.id = tabel_barang.jenis_barang") );
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$hasilInputan = query("SELECT tabel_barang.id, tabel_barang.nama_barang, 
                tabel_barang.harga_barang, tabel_jenis_barang.jenis_barang, 
                tabel_barang.stock_barang, tabel_barang.gambar 
                FROM tabel_barang 
                JOIN tabel_jenis_barang 
                ON tabel_jenis_barang.id = tabel_barang.jenis_barang ORDER BY id DESC LIMIT $awalData , $jumlahDataPerhalaman"); 

// untuk mengaktifkan pencarian
if (isset($_POST['cari']) ) {
  $hasilInputan = cari($_POST["keyword"]);
}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Data Barang</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="css/clndr.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="js/morris-chart/morris.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="index.php" class="logo">
        <img src="images/logo.png" alt="">
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<!-- bagian untuk menampilkan user -->
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
           <form class="form-inline ml-auto" action="" method="post">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword" autocomplete="off">
              <button class="btn btn-outline-warning my-2 my-sm-0" type="submit" name="cari">Search</button>
            </form>
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <img src='images/avatar-mini-2.jpg'>
                <span class="username">Admin</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="login.html"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
        <!-- akhir dari sintax untuk menampilkan user -->
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

        <!-- bagian dari data tables -->
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Data Tables</span>
                    </a>
                    <ul class="sub">
                        <li><a href="hasil_jenis_barang.php">Jenis Barang / Item</a></li>
                    </ul>
                </li>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
   <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
           <section class="panel panel-primary">
                    <header class="panel-heading">
                        Hasil Inputan
                       
                    </header>
                    <div class="panel-body">
                        <section id="no-more-tables">
                            <table action="" method="post" class="table table-bordered table-striped table-condensed cf">
                                <thead class="cf">
                            <tr>
                                <th> No. </th>
                                <th> Nama Barang </th>
                                <th> Harga Barang </th>
                                <th> Jenis Barang </th>
                                <th> Stock Barang </th>
                                <th> Gambar </th>
                                <th> Aksi</th>
                            </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($hasilInputan as $hasil) :?>
                             <tr>
                                <td data-title="No."><?= $i;  ?></td>
                                <td data-title="Nama Barang"><?= $hasil["nama_barang"] ; ?></td>
                                <td data-title="Harga Barang"><?= $hasil["harga_barang"] ; ?></td>
                                <td data-title="Jenis Barang"><?= $hasil["jenis_barang"] ; ?></td>
                                <td data-title="Stock Barang"><?= $hasil["stock_barang"] ; ?></td>
                                <td data-title="Gambar">
                                    <img width="70" height="70" src="img/<?= $hasil["gambar"] ?>">
                                </td>
                                <td data-title="Aksi">
                                   <a href="ubah_barang.php?id=<?=$hasil["id"]; ?>" class="btn btn-primary">Ubah</a> |
                                    <a href="hapus_barang.php?id=<?=$hasil["id"]; ?>"onclick="return confirm('apakah anda yakin.?')" class="btn btn-secondary">Hapus</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>    
                               
                                </tbody>
                            </table>
                        </section>
                            <nav aria-label="Page navigation example">
                              <ul class="pagination">
                                <?php if ( $halamanAktif > 1) : ?>
                                <li class="page-item">
                                  <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                </li>
                                <?php endif; ?>

                                <?php for ( $i = 1 ; $i <= $jumlahHalaman; $i++) : ?>
                                <?php if( $i == $halamanAktif) : ?>
                                    <li class="active" class="page-item"><a class="page-link" href="?halaman=<?= $i ; ?>"><?= $i ;  ?></a></li>
                                <?php else : ?> 
                                    <li class="page-item"><a class="page-link" href="?halaman=<?= $i ; ?>"><?= $i ;  ?></a></li> 
                                <?php endif; ?>
                                <?php endfor; ?>

                                <?php if ( $halamanAktif < $jumlahHalaman) : ?>   
                                <li class="page-item">
                                  <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </li>
                                <?php endif; ?>
                              </ul>
                            </nav>
                            <form>
                                    <button type="submit" name="tambah" style="float: right; margin-top: -70px;" class="btn btn-success"><a href="tambah_barang.php" class="btn btn-success">Tambah Data</a></button>
                            </form>
                    </div>
                </section>
            </div>
        </div>

        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
</section>



<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<script src="js/jquery.js"></script>
<script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/skycons/skycons.js"></script>
<script src="js/jquery.scrollTo/jquery.scrollTo.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/calendar/clndr.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<script src="js/calendar/moment-2.2.1.js"></script>
<script src="js/evnt.calendar.init.js"></script>
<script src="js/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="js/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
<script src="js/gauge/gauge.js"></script>
<!--clock init-->
<!--  <script src="js/css3clock/js/css3clock.js"></script> -->
<!--Easy Pie Chart-->
<!--- <script src="js/easypiechart/jquery.easypiechart.js"></script> --->
<!--Sparkline Chart-->
<!-- <script src="js/sparkline/jquery.sparkline.js"></script> -->
<!--Morris Chart-->
<!-- <script src="js/morris-chart/morris.js"></script> -->
<!-- <script src="js/morris-chart/raphael-min.js"></script> -->
<!--jQuery Flot Chart-->
<!-- <script src="js/flot-chart/jquery.flot.js"></script> -->
<!-- <script src="js/flot-chart/jquery.flot.tooltip.min.js"></script> -->
<!-- <script src="js/flot-chart/jquery.flot.resize.js"></script> -->
<!-- <script src="js/flot-chart/jquery.flot.pie.resize.js"></script> -->
<script src="js/flot-chart/jquery.flot.animator.min.js"></script>
<!-- <script src="js/flot-chart/jquery.flot.growraf.js"></script> -->
<!-- <script src="js/dashboard.js"></script> -->
<script src="js/jquery.customSelect.min.js" ></script>
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
<!--script for this page-->
</body>
</html>