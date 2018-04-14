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
$pinjam			= date("d-m-Y");
$tuju_hari		= mktime(0,0,0,date("n"),date("j")+7,date("Y"));
$kembali		= date("d-m-Y", $tuju_hari);




//kembali
if ($module=='kembalikan' AND $act=='kembali'){
    $kembali		= date("d-m-Y");
     mysql_query("UPDATE buku SET jumlah_tempo=(jumlah_tempo+1) WHERE judul='$_GET[judul]'");
     mysql_query("UPDATE transaksi_pinjam SET status='Kembali',dikembalikan='$kembali' WHERE id_transaksi='$_GET[id]'");
     header('location:../../media.php?module=pengembalian');
}


//perpanjang peminjaman
if ($module=='' AND $act=='perpanjang'){
    $tgl_kembali    =$_GET[tgl_kembali];
    $pecah			= explode("-",$tgl_kembali);
	$next_7_hari	= mktime(0,0,0,$pecah[1],$pecah[0]+7,$pecah[2]);
	$hari_next		= date("d-m-Y", $next_7_hari);


	mysql_query("UPDATE transaksi_pinjam SET tgl_kembali='$hari_next' WHERE id_transaksi='$_GET[id]'");
    header('location:../../media.php?module=pengembalian');

    
}

}
?>
