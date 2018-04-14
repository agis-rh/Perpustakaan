<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_transaksi/aksi_transaksi.php";
include "../../../config/fungsi_tgl.php";
switch($_GET[act]){
  // Tampil peminjam
  default:
   
    echo "<div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-user fa-fw'></i> Pustakawan</em></p></h4><hr>
 </div><br />
<div class='col-md-4'>
<div class='input-group custom-search-form'>
 <input type='text' class='form-control' placeholder='Search...'>
 <span class='input-group-btn'>
 <button class='btn btn-default' type='button'>
 <i class='fa fa-search'></i>
 </button>
 </span>
 </div>
 </div>
 </div>

 


<div class='row'>
<div class='col-lg-12'>
<div align='right'> <button type='button' class='btn  btn-primary' onclick=\"window.location.href='?module=transaksi&act=tambahtransaksi';\">Transaksi</button></div><br />
<div class='panel panel-primary'>
<div class='panel-heading'>
 <i class='fa fa-user fa-fw'></i> Data Peminjam
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Tgl. Pinjam</th>
                    <th>Tgl. Kembali</th> 
                    <th>Terlambat</th>
                    <th>Status</th>  
                    <th>Aksi</th>                                  
                    </tr>
</thead>
<tbody>";
  $tampil = mysql_query("SELECT * FROM transaksi_pinjam,anggota WHERE transaksi_pinjam.id_anggota=anggota.id_anggota AND
   status='pinjam' ORDER BY id_transaksi DESC");
   
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
  
  
   
   $no = 1;
    while ($r=mysql_fetch_array($tampil)){
        
        
       echo "<tr>
                 <td>$no</td>
                 <td>$r[nama]</td>
                 <td>$r[tgl_pinjam]</td>
                 <td>$r[tgl_kembali]</td>
                 <td>";
        $denda=500;
        $tgl_dateline=$r[tgl_kembali];
		$tgl_kembali=date('d-m-Y');
		$lambat=terlambat($tgl_dateline, $tgl_kembali);
		$denda=$lambat*$denda;
		if ($lambat>0) {
		echo "<font color='#06f'>$lambat hari<br>(Rp $denda)</font>";
		}
		else {
		echo "Tidak";
		}
        
       
       echo "</td><td>$r[status]</td>
		        
             <td><a href=?module=transaksi&act=detail&id=$r[id_transaksi]>Detail</a> </td>
		        </tr>";
              $no++;
   
    }
    echo "</tbody></table></div></div></div></div>";

    break;
  
  case "tambahtransaksi":
$pinjam			= date("d-m-Y");
$tuju_hari		= mktime(0,0,0,date("n"),date("j")+7,date("Y"));
$kembali		= date("d-m-Y", $tuju_hari);

    echo " <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
  <i class='fa fa-book fa-fw'></i>  Tambah Transaksi
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
    <form method=POST action='$aksi?module=transaksi&act=input' enctype='multipart/form-data'>
    
    <table class='list'>
    <div class='row show-grid'>
    <div class='col-md-3 col-md-push-9'>Kode Peminjaman</div> <div class='col-md-9 col-md-pull-3'> ";
    $data=mysql_query("SELECT id_transaksi FROM transaksi_pinjam ORDER BY id_transaksi DESC LIMIT 1");
    while($a=mysql_fetch_array($data)){
        $code=$a[id_transaksi]+1;
    echo "<input type=text name='code' class='form-control' value='PM-$code' disabled>";
            }
    echo "</div></div>";
         
echo "   <div class='row show-grid'>
         <div class='col-md-3 col-md-push-9'>Kode Buku</div>  <div class='col-md-9 col-md-pull-3'>
         <input type=text class='form-control' name='kode'></div></div>
         <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Judul Buku</div> <div class='col-md-9 col-md-pull-3'> 
          <select class='form-control' name='buku'>
            <option value=0 selected>- Pilih Buku -</option>";
            $tampil=mysql_query("SELECT * FROM buku ORDER BY judul");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_buku]>$r[judul]</option>";
            }
    echo "</select></div></div>
   <div class='row show-grid'>
  <div class='col-md-3 col-md-push-9'>Peminjam</div> <div class='col-md-9 col-md-pull-3'>
    <select class='form-control' name='peminjam'>
    <option value=0 selected>- Pilih Peminjam -</option>";
    $tampil=mysql_query("SELECT * FROM anggota ORDER BY nama");
    while($r=mysql_fetch_array($tampil)){
        echo "<option value=$r[id_anggota]>$r[nama]</option>";
    }
    echo "</select></div></div>
           <div class='row show-grid'>
         <div class='col-md-3 col-md-push-9'>Tanggal Pinjam</div>  <div class='col-md-9 col-md-pull-3'>
         <input type=text class='form-control' name='pinjam' value='$pinjam' disabled></div></div>
         
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Tanggal Kembali</div>  <div class='col-md-9 col-md-pull-3'>
           <input type=text class='form-control' name='kembali' value='$kembali' disabled></div></div>
           
           <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Nama Pegawai</div> <div class='col-md-9 col-md-pull-3'> ";
            $tampil=mysql_query("SELECT * FROM pegawai WHERE username='$_SESSION[namauser]'");
            while($r=mysql_fetch_array($tampil)){
              echo "<input type=text name='pegawai' class='form-control' value='$r[nama_lengkap]' disabled>";
            }
    echo "</div></div>
            <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Status</div>  <div class='col-md-9 col-md-pull-3'>
           <input type=text class='form-control' name='status' value='pinjam' disabled></div></div>
                                          <div class='alert alert-info'> *) Apabila Pengembalian buku melibihi batas
                                                                            yang ditentukan maka akan dikenakan denda !</div><br />
          <tr><td colspan=2><input type=submit  rol='button' class='btn btn-primary' value=Simpan><td>
          <td><div class='col-md-3 col-md-push-2'><input type=button  rol='button' class='btn  btn-primary' value=Batal onclick=self.history.back()></div></td></tr>
          </table></form>";
     break;
     
     case "detail":
     
$tampil = mysql_query("SELECT * FROM transaksi_pinjam,buku WHERE transaksi_pinjam.id_buku=buku.id_buku AND id_transaksi='$_GET[id]'");
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
<h4><p class='text-primary'><em><i class='fa fa-user fa-fw'></i> Detail Peminjam</em></p></h4><hr>
<div class='row'>
<div class='col-lg-12'>
<div align='right'><input type=button  rol='button' class='btn  btn-primary' value=Kembali onclick=self.history.back()></div><br />
<div class='panel panel-primary'>
<div class='panel-heading'>
                   
 <i class='fa fa-book fa-fw'></i> Data Buku yang dipinjam
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
            <td><th>Tgl.Harus Kembali</th></td>   <td>: $r[tgl_kembali]</td>
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
        
        if ($lambat==1){
            mysql_query("UPDATE anggota SET terlambat=(terlambat+1) WHERE id_anggota='$r[id_anggota]");
        }
       
            
       echo "</td>
            </tr>
            <tr>
            <td><th>Status</th></td>         <td>: $r[status]</td>
            </tr>
            <tr>
            <td><th>Cover Buku</td>         <td><img src='../foto_buku/small_$r[gambar]' width='150' height='150'></td>
            </tr>";
    
    
    echo "<tr>
            <td><th><a href='$aksi?module=transaksi&act=perpanjang&id=$r[id_transaksi]&tgl_kembali=$r[tgl_kembali]'><div align='right'><button type='button' class='btn btn-primary'>
            Perpanjang Buku</button></div></a></th></td>
            <td><a href='$aksi?module=transaksi&act=kembali&id=$r[id_transaksi]&judul=$r[judul]'><button type='button' class='btn btn-primary'>
            Kembalikan Buku</button></a></td></tr>
            ";
              $no++;
   
    }
    echo "</tbody></table></div></div></div></div></div>";
    
$tampil = mysql_query("SELECT * FROM transaksi_pinjam,anggota WHERE transaksi_pinjam.id_anggota=anggota.id_anggota AND id_transaksi='$_GET[id]'");

echo" <br />
<div class='row'>
<div class='col-lg-12'>
<div class='panel panel-primary'>
<div class='panel-heading'>
                   
 <i class='fa fa-user fa-fw'></i> Data Orang yang meminjam
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
