<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_anggota/aksi_anggota.php";
switch($_GET[act]){
  // Tampil Anggota
  default:
    $tampil = $tampil = mysql_query("SELECT * FROM anggota,kelas WHERE anggota.kelas=kelas.id_kelas AND terlambat>'0' ORDER BY terlambat DESC");
    
    echo "<div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-times fa-fw'></i> Blacklist</em></p></h4><hr>
 </div><br />
<div class='row'>
<div class='col-lg-12'>
<div class='panel panel-primary'>
<div class='panel-heading'>
 <i class='fa fa-times fa-fw'></i> Daftar orang yang telat mengembalikan buku
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
                    <tr>
                    <th>No.Anggota</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Alamat</th> 
                    <th>Terlambat</th>                                  
                    </tr>
</thead>
<tbody>";
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
                 <td width='5%'>$r[no_anggota]</td>
                 <td width='55%'>$r[nama]</td>
                 <td width='15%'>$r[nama_kelas]</td>
		         <td width='20%'>$r[alamat]</td>
             <td width='5%'>$r[terlambat] Kali</td></tr>";
   
    }
    echo "</tbody></table></div></div></div></div>";
    break;
 
 

 
}
}
?>
