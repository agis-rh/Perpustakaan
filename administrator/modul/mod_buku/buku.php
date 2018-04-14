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
  // Tampil buku
  default:
   $tampil = mysql_query("SELECT A.id_buku, B.nama_penerbit, A.judul, A.penulis, A.tgl_masuk, A.jumlah_buku FROM buku A, penerbit B WHERE A.id_penerbit=B.id_penerbit ORDER BY A.judul");
    
    echo "<div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-book fa-fw'></i> Data Buku</em></p></h4><hr>
 </div><br />
<div class='row'>
<div class='col-lg-12'>
<div align='right'> <button type='button' class='btn  btn-primary' onclick=\"window.location.href='?module=buku&act=tambahbuku';\">Tambah Buku</button></div><br />
<div class='panel panel-primary'>
<div class='panel-heading'>
 <i class='fa fa-book fa-fw'></i> Buku
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
                    <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penerbit</th> 
                    <th>Tgl.Masuk</th>
                    <th>Jumlah</th>  
                    <th>Aksi</th>                                  
                    </tr>
</thead>
<tbody>";
   $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
                 <td>$no</td>
                 <td>$r[judul]</td>
                 <td>$r[nama_penerbit]</td>
                 <td>$r[tgl_masuk]</td>
                 <td>$r[jumlah_buku] Buku</td>
		        
             <td><a href=?module=buku&act=editbuku&id=$r[id_buku]><img src='img/edit.png' border='0' title='edit' /></a> 
		                <a href='$aksi?module=buku&act=hapus&id=$r[id_buku]&namafile=$r[gambar]'><img src='img/del.png' border='0' title='edit' /></a></td>
		        </tr>";
              $no++;
   
    }
    echo "</tbody></table></div></div></div></div>";
    break;
  
  // Tambah Buku
  case "tambahbuku":
    echo " <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
  <i class='fa fa-book fa-fw'></i>  Tambah Buku
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
    <form method=POST action='$aksi?module=buku&act=input' enctype='multipart/form-data'>
          <table class='list'>
          <div class='row show-grid'> 
         <div class='col-md-3 col-md-push-9'>Judul</div> <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='judul' size=60></div></div>
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Kategori</div> <div class='col-md-9 col-md-pull-3'> 
          <select class='form-control' name='kategori'>
            <option value=0 selected>- Pilih Kategori -</option>";
            $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
    echo "</select></div></div>
   <div class='row show-grid'>
  <div class='col-md-3 col-md-push-9'>Penerbit</div> <div class='col-md-9 col-md-pull-3'>
    <select class='form-control' name='penerbit'>
    <option value=0 selected>- Pilih Penerbit -</option>";
    $tampil=mysql_query("SELECT * FROM penerbit ORDER BY nama_penerbit");
    while($r=mysql_fetch_array($tampil)){
        echo "<option value=$r[id_penerbit]>$r[nama_penerbit]</option>";
    }
    echo "</select></div></div>
           <div class='row show-grid'>
         <div class='col-md-3 col-md-push-9'>No.ISBN</div>  <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='isbn'></div></div>
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Jumlah Buku</div>  <div class='col-md-9 col-md-pull-3'> <input type=text required='required' class='form-control' name='jumlah'></div></div>
          <div class='row show-grid'> 
         <div class='col-md-3 col-md-push-9'>Penulis</div>     <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='penulis'></div></div>
          <div class='row show-grid'> 
          <div class='col-md-3 col-md-push-9'>Tahun Terbit</div>  <div class='col-md-9 col-md-pull-3'> <input type=text required='required' class='form-control' name='terbit'></div></div>
         <div class='row show-grid'>
         <div class='col-md-3 col-md-push-9'>Deskripsi</div>  <div class='col-md-9 col-md-pull-3'><textarea name='deskripsi' required='required' row='3' class='form-control'></textarea></div></div>
         <div class='row show-grid'>
         <div class='col-md-3 col-md-push-9'>Cover Buku</div>     <div class='col-md-9 col-md-pull-3'> <input class='form-control' type=file name='fupload'></div></div> 
                                          <div class='alert alert-info'> *) Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</div><br />
          <tr><td colspan=2><input type=submit  rol='button' class='btn  btn-primary' value=Simpan></td>
          <td><div class='col-md-3 col-md-push-2'><input type=button  rol='button' class='btn  btn-primary' value=Batal onclick=self.history.back()></div></td></tr>
          </table></form>";
     break;
  
 // Edit Buku  
  case "editbuku":
    $edit = mysql_query("SELECT * FROM buku WHERE id_buku='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo " <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
  <i class='fa fa-book fa-fw'></i>  Edit Buku
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
    <form method=POST enctype='multipart/form-data' action=$aksi?module=buku&act=update>
          <input type=hidden name=id value=$r[id_buku]>
          <table>
           <div class='row show-grid'> 
           <div class='col-md-3 col-md-push-9'>Judul</div> <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='judul' value='$r[judul]'></div></div>
           <div class='row show-grid'> 
           <div class='col-md-3 col-md-push-9'>Kategori</div><div class='col-md-9 col-md-pull-3'><select class='form-control' name='kategori'>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
          if ($r[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
    echo "</select></div></div>
    <div class='row show-grid'>
    <div class='col-md-3 col-md-push-9'>Penerbit</div><div class='col-md-9 col-md-pull-3'><select class='form-control' name='penerbit'>";
   $tampil=mysql_query("SELECT * FROM penerbit ORDER BY nama_penerbit");
          if ($r[id_penerbit]==0){
            echo "<option value=0 selected>- Pilih Penerbit -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_penerbit]==$w[id_penerbit]){
              echo "<option value=$w[id_penerbit] selected>$w[nama_penerbit]</option>";
            }
            else{
              echo "<option value=$w[id_penerbit]>$w[nama_penerbit]</option>";
            }
          }
    echo "</select></div></div>
    <div class='row show-grid'> 
           <div class='col-md-3 col-md-push-9'>No.ISBN</div>  <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='isbn' value=$r[isbn] size=20></div></div>
            <div class='row show-grid'> 
           <div class='col-md-3 col-md-push-9'>Jumlah Buku</div>    <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='jumlah' value=$r[jumlah_buku] size=20></div></div>
            <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Penulis</div>     <div class='col-md-9 col-md-pull-3'> <input type=text required='required' class='form-control' name='penulis' value=$r[penulis] ></div></div>
           <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Tahun Terbit</div>  <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='terbit' value=$r[tahun_terbit] size=4></div></div>
           <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Deskripsi</div>  <div class='col-md-9 col-md-pull-3'><textarea name='deskripsi' required='required' row='3' class='form-control'>$r[deskripsi]</textarea></div></div>
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Cover Buku</div><div class='col-md-9 col-md-pull-3'> 
          <img src='../foto_buku/small_$r[gambar]' width='150' height='150'></div></div>
          <div class='row show-grid'> 
          <div class='col-md-3 col-md-push-9'>Ganti Cover</div> <div class='col-md-9 col-md-pull-3'><input class='form-control' type=file name='fupload'></div></div>
          <div class='alert alert-info'>  *) Apabila gambar tidak diubah, dikosongkan saja.</div><br />
          <tr><td colspan=2><input type=submit  rol='button' class='btn btn-primary' value=Update></td>
          <td><div class='col-md-3 col-md-push-2'><input type=button value=Batal  rol='button' class='btn  btn-primary' onclick=self.history.back()></div></td></tr>
         </table></form></div>";
    break;  
}
}
?>
