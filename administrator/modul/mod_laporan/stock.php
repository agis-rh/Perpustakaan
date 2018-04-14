<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_buku/aksi_buku.php";
switch($_GET[act]){
  // Tampil buku tersedia
  default:
   $tampil = mysql_query("SELECT * FROM buku WHERE jumlah_tempo !='0' ORDER BY judul");
    
    echo "<div class='row'><br />
 <div class='col-lg-12'>
 <h4><p class='text-primary'><em><i class='fa fa-files-o fa-fw'></i> Buku tersedia diperpustakaan </em></p></h4><hr>
 </div><br />
<div class='row'>
<div class='col-lg-12'>
<div class='panel panel-primary'>
<div class='panel-heading'>
 <i class='fa fa-files-o fa-fw'></i> Stok Buku
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
                    <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Tersedia</th> 
                    <th>Belum dikembalikan</th>                                  
                    </tr>
</thead>
<tbody>";
   $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
                 <td width='5%'>$no</td>
                 <td width='60%'>$r[judul]</td>
                 <td width='10%'>$r[jumlah_tempo] Buku</td>
                  <td width='20%'>";
        $a=$r[jumlah_buku]-$r[jumlah_tempo];
        	if ($a<=0) {
		echo "Tidak ada";
		}
		else {
		echo $a." Buku";
		}
                  
          echo "</td>
		        </tr>";
              $no++;
   
    }
    echo "</tbody></table></div></div></div></div>";
    break;
  
 
}
}
?>
