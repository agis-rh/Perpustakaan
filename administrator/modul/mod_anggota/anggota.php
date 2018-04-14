<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_anggota/aksi_anggota.php";
switch($_GET[act]){
  // Tampil Anggota
  default:
    $tampil = mysql_query("SELECT A.id_anggota, B.nama_kelas, A.no_anggota, A.nama, A.email FROM anggota A, kelas B WHERE A.kelas=B.id_kelas ORDER BY A.kelas");
    
    echo "<div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-users fa-fw'></i> Anggota</em></p></h4><hr>
 </div><br />
<div class='row'>
<div class='col-lg-12'>
<div align='right'> <button type='button' class='btn btn-primary' onclick=\"window.location.href='?module=anggota&act=tambahanggota';\">Tambah Anggota</button></div><br />
<div class='panel panel-primary'>
<div class='panel-heading'>
 <i class='fa fa-users fa-fw'></i> Data Anggota
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
                    <tr>
                    <th>No.Anggota</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Email</th> 
                    <th>Aksi</th>                                  
                    </tr>
</thead>
<tbody>";
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr>
                 <td width='5%'>$r[no_anggota]</td>
                 <td width='55%'>$r[nama]</td>
                 <td width='15%'>$r[nama_kelas]</td>
		         <td width='20%'%'><a href=mailto:$r[email]>$r[email]</a></td>
             <td width='5%'><a href=?module=anggota&act=editanggota&id=$r[id_anggota]><img src='img/edit.png' border='0' title='edit' /></a></td></tr>";
   
    }
    echo "</tbody></table></div></div></div></div>";
    break;
 
 
 // Tambah anggota 
  case "tambahanggota":
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
  <i class='fa fa-users fa-fw'></i>  Tambah Anggota
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
    <form method=POST action='$aksi?module=anggota&act=input'>
           <table class='list'>
           <div class='row show-grid'>";
           $data=mysql_query("SELECT id_anggota FROM anggota ORDER BY id_anggota DESC LIMIT 1");
    while($a=mysql_fetch_array($data)){
        $code=$a[id_anggota]+1;
       echo "<div class='col-md-3 col-md-push-9'>No.Anggota</div>     <div class='col-md-9 col-md-pull-3'><input type=text required='required' value='ALS-$code' disabled  class='form-control' name='no'></div></div>";
           }
       echo "<div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Nama</div>     <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='nama'></div></div>
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>No.Telpon</div> <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='telpon' size=30></div></div>
           <div class='row show-grid'>  
          <div class='col-md-3 col-md-push-9'>E-mail</div>      <div class='col-md-9 col-md-pull-3'><input type=email required='required' class='form-control' name='email' size=30></div></div>
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Alamat</div>   <div class='col-md-9 col-md-pull-3'><textarea required='required' class='form-control' row='3' name='alamat'></textarea></div></div>
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Kelas</div>  
          <div class='col-md-9 col-md-pull-3'>
          <select class='form-control' name='kelas'>
           <option value=0 selected>- Pilih Kelas -</option>";
    $tampil=mysql_query("SELECT * FROM kelas ORDER BY nama_kelas");
    while($r=mysql_fetch_array($tampil)){
        echo "<option value=$r[id_kelas]>$r[nama_kelas]</option>";
    }
    echo "</select></div></div>
           <label>Jenis Kelamin</label><br />
      <label class='radio-inline'><input type=radio name='jk' value='L' checked>L</label> 
      <label class='radio-inline'><input type=radio name='jk' value='P'> P</label><br /><br /><br />
          <div class='alert alert-info'> *) Semua kolom harus di isi.<br />
                                            Jangan sampai ada yang kosong !</div>
          <td><input type=submit role='button' class='btn btn-primary' value=Simpan></td></div> 
                           <td><div class='col-md-3 col-md-push-2'><input type=button value=Batal role='button' class='btn btn-primary' onclick=self.history.back()></td></div></tr>
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

// Edit anggota    
  case "editanggota":
    $edit=mysql_query("SELECT * FROM anggota WHERE id_anggota='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
 <i class='fa fa-users fa-fw'></i>   Edit Anggota
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
          <form method=POST action=$aksi?module=anggota&act=update>
          <input type=hidden name=id value='$r[id_anggota]'>
          <table class='list'>
         <div class='row show-grid'>
        <div class='col-md-3 col-md-push-9'>No.Anggota</div>      
        <div class='col-md-9 col-md-pull-3'><input type=text required='required' name='no' id='disabledInput' class='form-control' value='$r[no_anggota]' disabled></div></div>
         
          <div class='row show-grid'>
         <div class='col-md-3 col-md-push-9'>Nama</div>      
         <div class='col-md-9 col-md-pull-3'><input type=text required='required' name='nama' class='form-control' value='$r[nama]'> </div></div>
          
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>No.Telpon</div> 
          <div class='col-md-9 col-md-pull-3'><input type=text required='required' name='telpon' class='form-control' size=30  value='$r[telpon]'></div></div>
           
         <div class='row show-grid'>
         <div class='col-md-3 col-md-push-9'>Email</div>          
        <div class='col-md-9 col-md-pull-3'><input type=email required='required' name='email' size=30 class='form-control' value='$r[email]'></div></div>
         
        <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Alamat</div>       
          <div class='col-md-9 col-md-pull-3'><textarea name='alamat' required='required' row='3' class='form-control' >$r[alamat]</textarea></div></div>
           <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Kelas</div>  
          <div class='col-md-9 col-md-pull-3'>
          <select class='form-control' name='kelas'>
           <option value=0 selected>- Pilih Kelas -</option>";
    $tampil=mysql_query("SELECT * FROM kelas ORDER BY nama_kelas");
    while($r=mysql_fetch_array($tampil)){
        echo "<option value=$r[id_kelas]>$r[nama_kelas]</option>";
    }
    echo "</div></div>
     <div class='alert alert-info'>*) No.Anggota tidak dapat diubah.</div><br /><br />
          <tr><td class='left'><input type=submit rol='button'class='btn btn-primary' value=Update></td>
                          <td><div class='col-md-3 col-md-push-2'><input type=button value=Batal rol='button' class='btn btn-primary' onclick=self.history.back()></div></td></tr>
          </table></form><div>";     
    }
    else{
    echo "<div class='panel panel-default'>
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
