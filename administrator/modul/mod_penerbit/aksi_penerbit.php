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

// Input penerbit
if ($module=='penerbit' AND $act=='input'){
  mysql_query("INSERT INTO penerbit(nama_penerbit,alamat,email) VALUES('$_POST[nama_penerbit]','$_POST[alamat]','$_POST[email]')");
  header('location:../../media.php?module='.$module);
}

// Update penerbit
elseif ($module=='penerbit' AND $act=='update'){
  mysql_query("UPDATE penerbit SET nama_penerbit='$_POST[nama_penerbit]', alamat='$_POST[alamat]', email='$_POST[email]', aktif='$_POST[aktif]' 
               WHERE id_penerbit = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
