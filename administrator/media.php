<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
    include "../config/koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!---------------------------------------------masukan semua css---------------------------------->
    <title>Libsska &trade;</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.gif" />
    

</head>

<body>

    <div id="wrapper">
<!---------------------------------------------header-------------------------------------------------------------->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?module=home">Library essemka &trade;</a>
            </div>
<!------------------------------------------------------------akhiri header----------------------------------------->

            <ul class="nav navbar-top-links navbar-right">
 <!-----------------------------------------profil----------------------->               
                <li class="dropdown">
                    <a href="?module=pegawai">
                        <i class="fa fa-user fa-fw"></i> Profil 
                    </a>
                </li>
<!------------------------------------------logout----------------------------->
                <li class="dropdown">
                    <a href="logout.php">
                        <i class="fa fa-sign-out fa-fw"></i> Logout
                    </a>
                </li>
              
           
</ul><!---------------------------------------akhiri menu header------------------>
           

<!------------------------------------------------sidebar------------------------>
            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
<!----------------------------welcome-------------------------->

<div class="user-panel">
<div class="pull-left image">
<img src="img/avatar.jpg" class="img-circle" alt="User Image" />
</div>
<div class="pull-left info"><br />
<p class="text-muted"> <?php echo "<i class='fa text-succes'> <SCRIPT language=JavaScript>var d = new Date();
            var h = d.getHours();
            if (h < 11) { document.write('Selamat Pagi,  $_SESSION[namalengkap]...'); }
            else { if (h < 15) { document.write('Selamat Siang, $_SESSION[namalengkap]...'); }
            else { if (h < 19) { document.write('Selamat Sore, $_SESSION[namalengkap]...'); }
            else { if (h <= 23) { document.write('Selamat Malam,  $_SESSION[namalengkap]...'); }
            }}}</SCRIPT></i> "; ?></p>

<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
</div>
</div>
 <!-------------------------------end welcome------------------------>
                        
                        <li>
                            <a href="?module=home"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Manajemen<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?module=buku"><i class="fa fa-book fa-fw"></i> Buku</a>
                                </li>
                                <li>
                                    <a href="?module=kategori"><i class="fa fa-tags fa-fw"></i> Kategori</a>
                                </li>
                                <li>
                                    <a href="?module=penerbit"><i class="fa fa-edit fa-fw"></i> Penerbit</a>
                                </li>
                                <li>
                                <a href="?module=pegawai"><i class="fa fa-user fa-fw"></i> Pegawai</a>
                                </li>
                            </ul>
                        </li>
<!----------------------------------------------akhiri dropdown 1-------------------------------------->
                        <li>
                            <a href="#"><i class="fa fa-suitcase fa-fw"></i> Transaksi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                     <a href="?module=transaksi"><i class="fa fa-pencil fa-fw"></i> Peminjaman</a>
                                </li>
                                <li>
                                     <a href="?module=pengembalian"><i class="fa fa-calendar fa-fw"></i> Pengembalian</a>
                                </li>
                            </ul>
 <!---------------------------------------------------akhiri dropdown 2----------------------------------->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-info fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li>
                                    <a href="?module=blacklist"><i class="fa fa-times fa-fw"></i> Blacklist</a>
                                </li>
                                <li>
                                    <a href="?module=pinjam"><i class="fa fa-check fa-fw"></i> Buku Di Pinjam</a>
                                </li>
                                <li>
                                    <a href="?module=stock"><i class="fa fa-files-o fa-fw"></i> Stok Buku</a>
                                </li>
                            </ul>
 <!---------------------------------------------------akhiri dropdown 3----------------------------------->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Anggota<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                     <a href="?module=anggota"><i class="fa fa-pencil fa-fw"></i> Daftar Anggota</a>
                                </li>
                                <li>
                                     <a href="?module=perkelas"><i class="fa fa-male fa-fw"></i> Anggota Perkelas</a>
                                </li>
                            </ul>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Setting<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?module=modul"><i class="fa fa-puzzle-piece fa-fw"></i> Modul</a>
                                </li>
                                <li>
                                    <a href="?module=kelas"><i class="fa fa-trophy fa-fw"></i> Kelas</a>
                                </li>
                            </ul>
 
                        </li>
                    </ul>
 <!-------------------------------------------progress------------------------------------------------------>

                </div>
 <!--------------------------------------------------akhiri sidebar------------------------------------>

            </div>
<!---------------------------------------------------akhiri navbar------------------------------------->
        </nav>
        

        <div id="page-wrapper">
         <?php 
         include 'page.php';
         ?>   
        </div>
 <!-------------------------------------------------akhiri page-------------------------------------->


    </div>
 <!-------------------------------------------------akhirii wadah------------------------------------->

<!------------------------------------------------------masukan js------------------------------------------------->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.metisMenu.js"></script>
    <script src="js/sb-admin.js"></script>
   

</body>

</html>
<?php
}
}
?>