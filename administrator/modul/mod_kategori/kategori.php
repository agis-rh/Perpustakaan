<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-tags fa-fw'></i> Kategori</em></p></h4><hr>
 </div><br />
 <div class='row'>
 <div class='col-lg-12'>
  <div align='right'> <button type='button' class='btn  btn-primary' onclick=\"window.location.href='?module=kategori&act=tambahkategori';\">Tambah Kategori</button></div><br />
 <div class='panel panel-primary'>
 <div class='panel-heading'>
 <i class='fa fa-tags fa-fw'></i> Data Kategori
 </div>
 <div class='panel-body'>
 <div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
 <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>                                   
                                </tr>
                            </thead>
                            <tbody>";
    $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr width='5%'><td>$no</td>
             <td width='75%'>$r[nama_kategori]</td>
             <td width='5%'>$r[aktif]</td>
             <td width='10%'><a href=?module=kategori&act=editkategori&id=$r[id_kategori]><img src='img/edit.png' border='0' title='edit' /></a>
             </td></tr>";
      $no++;
    }
    echo "<tbody></table></div>";
    echo "<div id=paging><div class='alert alert-info'>*) Data pada Kategori tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Kategori.</div></div><br>";
    break;
  
  // Form Tambah Kategori
  case "tambahkategori":
    if ($_SESSION[leveluser]=='admin'){  
    echo "<form method=POST action='$aksi?module=kategori&act=input'>
   <div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
   <i class='fa fa-tags fa-fw'></i> Tambah Kategori
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
          <table class='list'>
          <table class='list'>
          <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Nama Kategori</div><div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='nama_kategori'></div></div><br />
          <tr><td class='left' colspan=2><input type=submit rol='button' class='btn  btn-primary' name=submit value=Simpan></td>
          <td><div class='col-md-3 col-md-push-2'><input type=button value=Batal rol='button' class='btn  btn-primary' onclick=self.history.back()></div></td></tr>
          </table></form>";
          }
          else{
      echo " <div class='panel panel-default'>
      <div class='panel-heading'>
      <i class='fa fa-warning fa-fw'></i> Peringatan 
      </div>
      <div class='panel-body'>
      <ul class='timeline'>
      <li class='timeline-inverted'>
      <div class='timeline-badge'><i class='fa fa-warning'></i>
      </div>
      <div class='timeline-panel'>
      <div class='timeline-heading'>
      <h4 class='timeline-title'>Informasi</h4>
      </div>
      <div class='timeline-body'>
     <p>Anda tidak berhak mengakses halaman ini !</p><hr>
     <tr>
      <td><a href='?module=home'><button type=button role='button' class='btn btn-primary btn-xs'>Halaman Utama</button></a>
      </td>
      <td><button type=button role='button' class='btn btn-primary btn-xs' onclick=self.history.back()>Halaman Sebelumnya</button>
      </td>
      </tr>
      </div>
      </div>
      </li></div></li></ul></div>";
    }                    
     break;
  
  // Form Edit Kategori  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

 if ($_SESSION[leveluser]=='admin'){
    echo "<form method=POST action=$aksi?module=kategori&act=update>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
   <i class='fa fa-tags fa-fw'></i> Edit Kategori
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
          <input type=hidden name=id value='$r[id_kategori]'>
          <table class='list'>
           <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Nama Kategori</div><div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='nama_kategori' value='$r[nama_kategori]'></div></div>";
    if ($r[aktif]=='Y'){
      echo "
      <label>Aktif</label><br />
      <label class='radio-inline'><input type=radio name='aktif' value='Y' checked>Y</label> 
      <label class='radio-inline'><input type=radio name='aktif' value='N'> N</label><br /><br /><br />";
    }
    else{
      echo "
      <label>Aktif</label><br />
     <label class='radio-inline'><input type=radio name='aktif' value='Y'>Y</label> 
     <label class='radio-inline'><input type=radio name='aktif' value='N' checked>N</label><br /><br /><br />";
    }

    echo "<tr><td class='left' colspan=2><input type=submit rol='button'class='btn  btn-primary' value=Update></td>
    <td><div class='col-md-3 col-md-push-2'><input type=button rol='button' class='btn  btn-primary' value=Batal onclick=self.history.back()></div></td></tr>
          </table></form></div></div>";
          }  else{
      echo " <div class='panel panel-default'>
      <div class='panel-heading'>
      <i class='fa fa-warning fa-fw'></i> Peringatan 
      </div>
      <div class='panel-body'>
      <ul class='timeline'>
      <li class='timeline-inverted'>
      <div class='timeline-badge'><i class='fa fa-warning'></i>
      </div>
      <div class='timeline-panel'>
      <div class='timeline-heading'>
      <h4 class='timeline-title'>Informasi</h4>
      </div>
      <div class='timeline-body'>
     <p>Anda tidak berhak mengakses halaman ini !</p><hr>
     <tr>
      <td><a href='?module=home'><button type=button role='button' class='btn btn-primary btn-xs'>Halaman Utama</button></a>
      </td>
      <td><button type=button role='button' class='btn btn-primary btn-xs' onclick=self.history.back()>Halaman Sebelumnya</button>
      </td>
      </tr>
      </div>
      </div>
      </li></div></li></ul></div>";
    }          
    break;  
}
}
?>
