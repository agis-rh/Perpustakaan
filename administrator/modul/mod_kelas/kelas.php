<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_kelas/aksi_kelas.php";
switch($_GET[act]){
  // Tampil Kelas
  default:
    echo "<div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-trophy fa-fw'></i> Kelas</em></p></h4><hr>
 </div><br />
 <div class='row'>
 <div class='col-lg-12'>
  <div align='right'> <button type='button' class='btn  btn-primary' onclick=\"window.location.href='?module=kelas&act=tambahkelas';\">Tambah Kelas</button></div><br />
 <div class='panel panel-primary'>
 <div class='panel-heading'>
 <i class='fa fa-trophy fa-fw'></i> Data Kelas
 </div>
 <div class='panel-body'>
 <div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
 <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Aktif</th>
                                    <th>Aksi</th>                                   
                                </tr>
                            </thead>
                            <tbody>";
    $tampil=mysql_query("SELECT * FROM kelas ORDER BY nama_kelas");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td width='10%'>$no</td>
             <td width='70%'>$r[nama_kelas]</td>
             <td width='10%'>$r[aktif]</td>
             <td width='10'><a href=?module=kelas&act=editkelas&id=$r[id_kelas]><img src='img/edit.png' border='0' title='edit' /></a>
             </td></tr>";
      $no++;
    }
    echo "<tbody></table></div>";
    echo "<div id=paging><div class='alert alert-info'>*) Data pada Kelas tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Kelas.</div></div><br>";
    break;
  
  // Form Tambah Kelas
  case "tambahkelas":
  if ($_SESSION[leveluser]=='admin'){ 
    echo "<form method=POST action='$aksi?module=kelas&act=input'>
   <div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
   <i class='fa fa-trophy fa-fw'></i> Tambah Kelas
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
          <table class='list'>
          <table class='list'>
          <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Nama Kelas</div><div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='nama_kelas'></div></div><br />
          <tr><td class='left' colspan=2><input type=submit rol='button' class='btn btn-primary' name=submit value=Simpan></td>
          <td><div class='col-md-3 col-md-push-2'><input type=button value=Batal rol='button' class='btn btn-primary' onclick=self.history.back()></div></td></tr>
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
  
  // Form Edit Kelas  
  case "editkelas":
    $edit=mysql_query("SELECT * FROM kelas WHERE id_kelas='$_GET[id]'");
    $r=mysql_fetch_array($edit);

if ($_SESSION[leveluser]=='admin'){ 
    echo "<form method=POST action=$aksi?module=kelas&act=update>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
   <i class='fa fa-trophy fa-fw'></i> Edit Kelas
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
          <input type=hidden name=id value='$r[id_kelas]'>
          <table class='list'>
           <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Nama Kelas</div><div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='nama_kelas' value='$r[nama_kelas]'></div></div>";
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
}
}
?>
