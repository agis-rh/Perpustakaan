<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_pegawai/aksi_pegawai.php";
switch($_GET[act]){
  // Tampil Pegawai
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM pegawai ORDER BY username");
    }
    else{
      $tampil=mysql_query("SELECT * FROM pegawai 
                           WHERE username='$_SESSION[namauser]'");
    }
    
    echo "<div class='row'>
 <div class='col-lg-12'>
<h4><p class='text-primary'><em><i class='fa fa-user fa-fw'></i> Pegawai</em></p></h4><hr>
 </div><br />
<div class='row'>
<div class='col-lg-12'>
<div align='right'> <button type='button' class='btn  btn-primary' onclick=\"window.location.href='?module=pegawai&act=tambahpegawai';\">Tambah Pegwai</button></div><br />
<div class='panel panel-primary'>
<div class='panel-heading'>
 <i class='fa fa-user fa-fw'></i> Data Pegawai
</div>

<div class='panel-body'>
<div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
<thead>
                    <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No.Telp</th>
                    <th>Level</th>
                    <th>Blokir</th> 
                    <th>Aksi</th>                                  
                    </tr>
</thead>
<tbody>";
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
                 <td>$r[username]</td>
                 <td>$r[nama_lengkap]</td>
		         <td><a href=mailto:$r[email]>$r[email]</a></td>
		         <td>$r[no_telp]</td>
		         <td>$r[level]</td>
		         <td>$r[blokir]</td>
             <td><a href=?module=pegawai&act=editpegawai&id=$r[id_session]><img src='img/edit.png' border='0' title='edit' /></a></td></tr>";
      $no++;
    }
    echo "</tbody></table></div></div></div></div>";
    break;

// Tambah Pegawai  
  case "tambahpegawai":
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
  <i class='fa fa-user fa-fw'></i>  Tambah Pegawai
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
    <form method=POST action='$aksi?module=pegawai&act=input'>
           <table class='list'>
           <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Username</div>     <div class='col-md-9 col-md-pull-3'><input type=text required='required'  class='form-control' name='username'></div></div>
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Password</div>     <div class='col-md-9 col-md-pull-3'><input type=password required='required' class='form-control' name='password'></div></div>
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Nama Lengkap</div> <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='nama_lengkap' size=30></div></div>
           <div class='row show-grid'>  
          <div class='col-md-3 col-md-push-9'>E-mail</div>      <div class='col-md-9 col-md-pull-3'><input type=email required='required' class='form-control' name='email' size=30></div></div>
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>No.Telp/HP</div>   <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='no_telp' size=20></div></div><br />
          <div class='alert alert-info'> *) Untuk kolom username jangan menggunakan spasi,symbol atau karakter lainnya.<br />
                                              Usahakan semua di isi menggunakan huruf</div>
          <td colspan=2><input type=submit role='button' class='btn btn-primary' value=Simpan></td>
          <td><div class='col-md-3 col-md-push-2'><input type=button value=Batal role='button' class='btn  btn-primary' onclick=self.history.back()></div></td></tr>
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
 
 // Edit Pegawai   
  case "editpegawai":
    $edit=mysql_query("SELECT * FROM pegawai WHERE id_session='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
 <i class='fa fa-user fa-fw'></i>   Edit Pegawai
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
          <form method=POST action=$aksi?module=pegawai&act=update>
          <input type=hidden name=id value='$r[id_session]'>
          <table class='list'>
         <div class='row show-grid'>
        <div class='col-md-3 col-md-push-9'>Username</div>      
        <div class='col-md-9 col-md-pull-3'><input type=text required='required' name='username' id='disabledInput' class='form-control' value='$r[username]' disabled></div></div>
         
          <div class='row show-grid'>
         <div class='col-md-3 col-md-push-9'>Password</div>      
         <div class='col-md-9 col-md-pull-3'><input type=text  name='password' class='form-control'> </div></div>
          
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Nama Lengkap</div> 
          <div class='col-md-9 col-md-pull-3'><input type=text required='required' name='nama_lengkap' class='form-control' size=30  value='$r[nama_lengkap]'></div></div>
           
         <div class='row show-grid'>
         <div class='col-md-3 col-md-push-9'>Email</div>          
        <div class='col-md-9 col-md-pull-3'><input type=email required='required' name='email' size=30 class='form-control' value='$r[email]'></div></div>
         
        <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>No.Telp</div>       
          <div class='col-md-9 col-md-pull-3'><input type=text required='required' name='no_telp' size=30 class='form-control' value='$r[no_telp]'></div></div>";

    if ($r[blokir]=='N'){
      echo "
                            <label>Blokir</label><br />
                            <label class='radio-inline'><input type='radio' name='blokir' value='Y' />Y</label>
                            <label class='radio-inline'> <input type='radio' name='blokir' value='N' checked/>N</label>
							";
      
    }
    else{
      echo "
      <label>Blokir</label><br />    
      <label class='radio-inline'><input type='radio' name='blokir' value='Y' checked/>Y</label>
      <label class='radio-inline'> <input type='radio' name='blokir' value='N'/>N</label>
							";
    }
    
    echo "<br /><br />
     <div class='alert alert-info'>*) Apabila password tidak diubah, dikosongkan saja.<br />
                            **) Username tidak bisa diubah.</div><br /><br /><br />
          <tr><td class='left' colspan=2><input type=submit rol='button'class='btn  btn-primary' value=Update></td>
          <td><div class='col-md-3 col-md-push-2'><input type=button value=Batal rol='button' class='btn  btn-primary' onclick=self.history.back()></div></td></tr>
          </table></form><div>";     
    }
    else{
    echo "<div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-default'>
  <div class='panel-heading'>
 <i class='fa fa-user fa-fw'></i>   Edit Pegawai
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-6'>
  <div class='form-group'>
          <form method=POST action=$aksi?module=pegawai&act=update>
          <input type=hidden name=id value='$r[id_session]'>
          <input type=hidden name=blokir value='$r[blokir]'>
          <table>
          <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Username</div>    <div class='col-md-9 col-md-pull-3'><input type=text id='disabledInput' class='form-control' name='username' value='$r[username]' disabled></div></div>
          <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Password</div>    <div class='col-md-9 col-md-pull-3'><input type=text  class='form-control' name='password'> </div></div>
          <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Nama Lengkap</div> <div class='col-md-9 col-md-pull-3'><input type=text  class='form-control' name='nama_lengkap' size=30  value='$r[nama_lengkap]'></div></div>
          <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>E-mail</div>       <div class='col-md-9 col-md-pull-3'><input type=text  class='form-control' name='email' size=30 value='$r[email]'></div></div>
          <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>No.Telp/HP</div>   <div class='col-md-9 col-md-pull-3'><input type=text  class='form-control' name='no_telp' size=30 value='$r[no_telp]'></div></div>";    
    echo "<tr><td colspan=2><div class='alert alert-info'>*) Apabila password tidak diubah, dikosongkan saja.<br />
                            **) Username tidak bisa diubah.</div></td></tr><br /><br />";
                            
                            
    echo "<tr><td colspan=2><input type=submit class='btn btn-outline btn-primary' value=Update>
                            <input type=button value=Batal class='btn btn-outline btn-primary' onclick=self.history.back()></td></tr>
          </table></form></div>";     
    }
    break;  
}
}
?>
