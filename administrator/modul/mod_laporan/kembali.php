<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_transaksi/aksi_transaksi.php";
include "../../../config/fungsi_denda.php";
include "../../../config/fungsi_tgl.php";
switch($_GET[act]){
  // DAFTAR PENGEMBALIAN
  default:

  $tampil = mysql_query("SELECT * FROM transaksi_pinjam,anggota WHERE transaksi_pinjam.id_anggota=anggota.id_anggota AND status='kembali' ORDER BY id_transaksi DESC");
    
    echo "<div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-user fa-fw'></i> Pengembalian Buku</em></p></h4><hr>
 </div><br />
<div class='row'>
<div class='col-lg-12'>
<div class='panel panel-primary'>
<div class='panel-heading'>
 <i class='fa fa-user fa-fw'></i> Data yang telah mengembalikan buku
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Tgl. Pinjam</th>
                    <th>Di Kembalikan</th> 
                    <th>Status</th>  
                    <th>Aksi</th>                                  
                    </tr>
</thead>
<tbody>";
   $no=1;
    while ($r=mysql_fetch_array($tampil)){
        
       echo "<tr>
                 <td width='5%'>$no</td>
                 <td width='45%'>$r[nama]</td>
                 <td width='10%'>$r[tgl_pinjam]</td>
                 <td width='15%'>$r[dikembalikan]</td>";
      
       
       
       echo "<td width='10%'>$r[status]</td>
		        
             <td width='5%'><a href=?module=kembali&act=detail&id=$r[id_transaksi]>Detail</a> </td>
		        </tr>";
              $no++;
   
    }
    echo "</tbody></table></div></div></div></div>";
    break;
  
// detail peminjam telah kembali   
     case "detail":
     
$tampil = mysql_query("SELECT * FROM transaksi_pinjam,buku WHERE transaksi_pinjam.id_buku=buku.id_buku AND id_transaksi='$_GET[id]'");
echo" <div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-retweet fa-fw'></i> Detail Pengembalian</em></p></h4><hr>
 </div><br />
<div class='row'>
<div class='col-lg-12'>
<div align='right'><input type=button  rol='button' class='btn btn-primary' value=Kembali onclick=self.history.back()></div><br />
<div class='panel panel-primary'>
<div class='panel-heading'>
                   
 <i class='fa fa-book fa-fw'></i> Data Buku yang dikembalikan
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
</thead>
<tbody>";
   $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
            <td><th>Kode Peminjaman</th></td> <td>:<font color='#06f'><strong> $r[kode_pinjam] </strong></font></td>
            </tr>
            <tr>
            <td><th>Nama Buku</th></td>      <td>: $r[judul]</td>
            </tr>
            <tr>
            <td><th>Kode Buku</th></td>        <td>: $r[kode_buku]</td>
            </tr>
            <tr>
            <td><th>Tgl.Pinjam</th></td>   <td>: $r[tgl_pinjam]</td>
            </tr>
            <tr>
            <td><th>Tgl.Di Kembalikan</th></td>   <td>: $r[dikembalikan]</td>
            </tr>
            <tr>
            <td><th>Meminjam Kepada</th></td>   <td>: $r[pegawai]</td>
            </tr>
            <tr>
            <td><th>Status</th></td>         <td>: $r[status]</td>
            </tr>
            <tr>
            <td><th>Cover Buku</td>         <td><img src='../foto_buku/small_$r[gambar]' width='150' height='150'></td>
            </tr>";
              $no++;
   
    }
    echo "</tbody></table></div></div></div></div></div>";
    
$tampil = mysql_query("SELECT * FROM transaksi_pinjam,anggota WHERE transaksi_pinjam.id_anggota=anggota.id_anggota AND id_transaksi='$_GET[id]'");
echo" <br />
<div class='row'>
<div class='col-lg-12'>
<div class='panel panel-primary'>
<div class='panel-heading'>
                   
 <i class='fa fa-user fa-fw'></i> Data Orang yang mengembalikan
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
</thead>
<tbody>";
   $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
            <td><th>Nama</th></td>      <td>: $r[nama]</td>
            </tr>
            <tr>
            <td><th>Alamat</th></td>   <td>: $r[alamat]</td>
            </tr>
            <tr>
            <td><th>E-mail</th></td>   <td>: $r[email]</td>
            </tr>
            <tr>
            <td><th>Telpon</th></td>   <td>: $r[telpon]</td>
            </tr>";
echo "</tbody></table></div></div></div></div>";
     
     break;
    
}


 
}
}
?>
