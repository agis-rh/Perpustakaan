<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Input anggota
if ($module=='anggota' AND $act=='input'){
    
// ambil code
$ar=mysql_query("SELECT id_anggota FROM anggota ORDER BY id_anggota DESC LIMIT 1");
while ($r=mysql_fetch_array($ar)){
    $code=$r[id_anggota]+1;
    
  mysql_query("INSERT INTO anggota(no_anggota,
                                 nama,
                                 jk,
                                 kelas, 
                                 alamat,
                                 email,
                                 telpon) 
	                       VALUES('ALS-$code',
                                '$_POST[nama]',
                                '$_POST[jk]',
                                '$_POST[kelas]',
                                '$_POST[alamat]',
                                '$_POST[email]',
                                '$_POST[telpon]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update anggota
elseif ($module=='anggota' AND $act=='update'){
    mysql_query("UPDATE anggota SET nama        = '$_POST[nama]',
                                    kelas      = '$_POST[kelas]',
                                    alamat     = '$_POST[alamat]',
                                    email      = '$_POST[email]', 
                                    telpon     = '$_POST[telpon]'
                           WHERE  id_anggota    = '$_POST[id]'");

  
  header('location:../../media.php?module='.$module);
}
}
?>
