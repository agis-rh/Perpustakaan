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


// Input transaksi
if ($module=='transaksi' AND $act=='input'){
$buku=$_POST[buku];
$bln =date("m");
$data=mysql_fetch_array(mysql_query("SELECT jumlah_tempo FROM buku WHERE id_buku='$buku'"));
 if ($data['jumlah_tempo']!=0){
    

//ambil pegawai

$ra=mysql_query("SELECT * FROM pegawai WHERE username='$_SESSION[namauser]'");
while($a=mysql_fetch_array($ra)){
    $pegawai=$a[nama_lengkap];
    
// ambil code
$ar=mysql_query("SELECT id_transaksi FROM transaksi_pinjam ORDER BY id_transaksi DESC LIMIT 1");
while ($r=mysql_fetch_array($ar)){
    $code=$r[id_transaksi]+1;
    
//proses transaksi
  mysql_query("INSERT INTO transaksi_pinjam(id_buku,
                                            kode_pinjam,
                                            id_anggota,
                                            kode_buku,
                                            pegawai, 
                                            tgl_pinjam,
                                            tgl_kembali,
                                            status) 
	                       VALUES('$_POST[buku]',
                                'PM-$code',
                                '$_POST[peminjam]',
                                '$_POST[kode]',
                                '$pegawai',
                                '$pinjam',
                                '$kembali',
                                'Pinjam')");
  mysql_query("UPDATE buku SET jumlah_tempo=(jumlah_tempo-1),dipinjam=(dipinjam+1) WHERE id_buku=$_POST[buku]");
  mysql_query("UPDATE anggota SET meminjam=(meminjam+1) WHERE id_anggota=$_POST[peminjam]");
  mysql_query("UPDATE grafik SET peminjaman=(peminjaman+1) WHERE bulan=$bln");
  header('location:../../media.php?module='.$module);
  }
  }
}else{
    echo "<script>alert('Maaf buku sudah habis di pinjam !');</script>";
   echo "<meta http-equiv='refresh' content='0; url=../../media.php?module=transaksi'>";
}
}


//kembali
if ($module=='transaksi' AND $act=='kembali'){
    $kembali		= date("d-m-Y");
     mysql_query("UPDATE buku SET jumlah_tempo=(jumlah_tempo+1) WHERE judul='$_GET[judul]'");
     mysql_query("UPDATE transaksi_pinjam SET status='Kembali',dikembalikan='$kembali' WHERE id_transaksi='$_GET[id]'");
     header('location:../../media.php?module='.$module);
}


//perpanjang peminjaman
if ($module=='transaksi' AND $act=='perpanjang'){
    $tgl_kembali    =$_GET[tgl_kembali];
    $pecah			= explode("-",$tgl_kembali);
	$next_7_hari	= mktime(0,0,0,$pecah[1],$pecah[0]+7,$pecah[2]);
	$hari_next		= date("d-m-Y", $next_7_hari);


	mysql_query("UPDATE transaksi_pinjam SET tgl_kembali='$hari_next' WHERE id_transaksi='$_GET[id]'");
    header('location:../../media.php?module='.$module);

    
}

}
?>
