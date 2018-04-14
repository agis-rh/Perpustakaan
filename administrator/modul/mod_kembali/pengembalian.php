<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
$aksi="modul/mod_kembali/aksi_pengembalian.php";
  


$sql = mysql_query("SELECT transaksi_pinjam.id_transaksi,
                    nama,judul,kode_buku,kode_pinjam,gambar,tgl_kembali,pegawai 
                    FROM transaksi_pinjam, buku, anggota  
                    WHERE (transaksi_pinjam.id_buku=buku.id_buku) 
                    AND (transaksi_pinjam.id_anggota=anggota.id_anggota) 
                    AND (transaksi_pinjam.kode_pinjam='$_POST[kode_peminjaman]') 
                    AND (transaksi_pinjam.kode_buku='$_POST[kode_buku]')");
//fungsi untuk membuat denda dan terlambat
function terlambat($tgl_dateline, $tgl_kembali) {
$tgl_dateline_pcs = explode ("-", $tgl_dateline);
$tgl_dateline_pcs = $tgl_dateline_pcs[2]."-".$tgl_dateline_pcs[1]."-".$tgl_dateline_pcs[0];
$tgl_kembali_pcs = explode ("-", $tgl_kembali);
$tgl_kembali_pcs = $tgl_kembali_pcs[2]."-".$tgl_kembali_pcs[1]."-".$tgl_kembali_pcs[0];
$selisih = strtotime ($tgl_kembali_pcs) - strtotime ($tgl_dateline_pcs);
$selisih = $selisih / 86400;
if ($selisih>=1) {
	$hasil_tgl = floor($selisih);
}
else {
	$hasil_tgl = 0;
}
return $hasil_tgl;
}



echo" <div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-foursquare fa-fw'></i> Detail Pengembalian</em></p></h4><hr>
<div class='row'>
<div class='col-lg-12'>
<div align='right'><input type=button  rol='button' class='btn  btn-primary' value=Kembali onclick=self.history.back()></div><br />
<div class='panel panel-primary'>
<div class='panel-heading'>
                   
 <i class='fa fa-undo fa-fw'></i> Data Buku yang akan dikembalikan
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
</thead>
<tbody>";
   $no=1;
    while ($r=mysql_fetch_array($sql)){
       echo "<tr>
            <td><th>Kode Peminjaman</th></td> <td>:<font color='#06f'><strong> $r[kode_pinjam] </strong></font></td>
            </tr>
            <tr>
            <td><th>Judul Buku</th></td>      <td>: $r[judul]</td>
            </tr>
            <tr>
            <td><th>Kode Buku</th></td>        <td>: $r[kode_buku]</td>
            </tr>
            <tr>
            <td><th>Nama Peminjam</th></td>   <td>: $r[nama]</td>
            </tr>
            <tr>
            <td><th>Meminjam Kepada</th></td>   <td>: $r[pegawai]</td>
            </tr>
            <tr>
            <td><th>Terlambat</th></td>      <td>: "; 
            
            $denda=500;
        $tgl_dateline=$r[tgl_kembali];
		$tgl_kembali=date('d-m-Y');
		$lambat=terlambat($tgl_dateline, $tgl_kembali);
		$denda=$lambat*$denda;
		if ($lambat>0) {
		echo "<font color='#06f'>$lambat hari  (Rp $denda)</font>";
		}
		else {
		echo "Tidak Terlamabat";
		}
            
       echo "</td>
            </tr>
            <tr>
            <td><th>Cover Buku</td>         <td><img src='../foto_buku/small_$r[gambar]' width='150' height='150'></td>
            </tr>";
    
    
    echo "<tr>
            <td><th><a href='$aksi?module=kembalikan&act=perpanjang&id=$r[id_transaksi]&tgl_kembali=$r[tgl_kembali]'><div align='right'><button type='button' class='btn btn-primary'>
            Perpanjang Buku</button></div></a></th></td>
            <td><a href='$aksi?module=kembalikan&act=kembali&id=$r[id_transaksi]&judul=$r[judul]'><button type='button' class='btn btn-primary'>
            Kembalikan Buku</button></a></td></tr>
            ";
              $no++;
   
    }
    echo "</tbody></table></div></div></div></div></div>";
    
   
    
}



?>
