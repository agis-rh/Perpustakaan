<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_pinjam/aksi_pinjam.php";
switch($_GET[act]){
  // Tampil buku dipinjam
  default:
   $tampil = mysql_query("SELECT * FROM buku WHERE jumlah_tempo != jumlah_buku");
    
    echo "<div class='row'>
 <div class='col-lg-12'>
 <h4><p class='text-primary'><em><i class='fa fa-book fa-fw'></i> Buku yang sedang di pinjam</em></p></h4><hr>
 </div><br />
<div class='row'>
<div class='col-lg-12'>
<div class='panel panel-primary'>
<div class='panel-heading'>
 <i class='fa fa-book fa-fw'></i> Data Buku
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
                    <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                     <th>Jumlah</th>  
                    <th>Dipinjam</th>                              
                    </tr>
</thead>
<tbody>";
   $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
                 <td width='5%'>$no</td>
                 <td width='75%'>$r[judul]</td>
                  <td width ='10%'>$r[jumlah_buku] Buku</td>
                 <td width='10%'>$r[dipinjam] kali</td>
		        </tr>";
              $no++;
   
    }
    echo "</tbody></table></div></div></div></div>";
    break;
  
  
}
}
?>
