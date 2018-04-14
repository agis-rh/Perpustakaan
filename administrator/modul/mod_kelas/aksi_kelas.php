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

// Input kelas
if ($module=='kelas' AND $act=='input'){
  mysql_query("INSERT INTO kelas(nama_kelas) VALUES('$_POST[nama_kelas]')");
  header('location:../../media.php?module='.$module);
}

// Update kelas
elseif ($module=='kelas' AND $act=='update'){
  mysql_query("UPDATE kelas SET nama_kelas='$_POST[nama_kelas]',aktif='$_POST[aktif]' 
               WHERE id_kelas = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
