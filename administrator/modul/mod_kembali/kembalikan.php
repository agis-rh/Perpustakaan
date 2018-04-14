<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
   echo "<div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-android fa-fw'></i> Form Pengembalian</em></p></h4><hr>
 </div><br />
   
   
   <form method=POST action='?module=kembalikan'>
   <div align='right'> <button type='button' class='btn  btn-primary' onclick=\"window.location.href='?module=kembali';\">
   Lihat Data</button></div><br />
   
    <div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
  <i class='fa fa-edit fa-fw'></i>  Masukan Kode Peminjaman & Kode Buku
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
          <table class='list'>
         <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Kode Peminjaman</div> <div class='col-md-9 col-md-pull-3'>
          <input type=text required='required' class='form-control' name='kode_peminjaman'></div></div>
         <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Kode Buku</div> <div class='col-md-9 col-md-pull-3'>
          <input type=text required='required' class='form-control' name='kode_buku'></div></div>
          <tr><td class='left' colspan=2><input type=submit rol='button' class='btn  btn-primary' name=submit value=Proses></td>
          <td><div class='col-md-3 col-md-push-2'><input type=button value=Batal rol='button' class='btn btn-primary' onclick=self.history.back()></div></td></tr>
          </table></form>";
          

}
?>
