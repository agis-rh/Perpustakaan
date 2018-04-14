<?php
session_start();
  if ($_SESSION[leveluser]=='user'){
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
else{
include '../config/koneksi.php';

$aksi="modul/mod_modul/aksi_modul.php";
switch($_GET[act]){
  // Tampil Modul
  default:
 echo "<div class='row'>
 <div class='col-lg-12'>
 <h4><p class='text-primary'><em><i class='fa fa-puzzle-piece fa-fw'></i> Modul</em></p></h4><hr>
 </div><br />
 <div class='row'>
 <div class='col-lg-12'>
  <div align='right'> <button type='button' class='btn  btn-primary' onclick=\"window.location.href='?module=modul&act=tambahmodul';\">Tambah Modul</button></div><br />
 <div class='panel panel-primary'>
 <div class='panel-heading'>
 <i class='fa fa-puzzle-piece fa-fw'></i> Data Modul
 </div>
 <div class='panel-body'>
 <div class='table-responsive'>
 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
 <thead>
                                
 <tr>
 <th>No</th>
 <th>Nama Modul</th>
 <th>Link</th>
 <th>Publish</th> 
 <th>Aktif</th> 
 <th>Status</th>
 <th>Aksi</th>                                    
 </tr>
 </thead>
 <tbody>";
   
    $tampil=mysql_query("SELECT * FROM modul ORDER BY urutan");
    while ($hasil=mysql_fetch_array($tampil)){
      echo "
			<tr><td>$hasil[urutan]</td>
            <td>$hasil[nama_modul]</td>
            <td><a href=$hasil[link]>$hasil[link]</a></td>
            <td>$hasil[publish]</td>
            <td>$hasil[aktif]</td>
            <td>$hasil[status]</td>
            <td><a href=?module=modul&act=editmodul&id=$hasil[id_modul]><img src='img/edit.png' border='0' title='edit' /></a>
	              <a href=$aksi?module=modul&act=hapus&id=$hasil[id_modul]><img src='img/del.png' border='0' title='hapus' /></a>
            </td></tr>";
    }
    echo "</tbody></table></div>";
    break;

  case "tambahmodul":
    echo " <div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
 <i class='fa fa-puzzle-piece fa-fw'></i>  Tambah Modul
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
          <form method=POST action='$aksi?module=modul&act=input'>
          <table class='list'><tbody>
          <div class='row show-grid'>
           <div class='col-md-3 col-md-push-9'>Nama Modul</div>
           <div class='col-md-9 col-md-pull-3'><input type=text required='required' class='form-control' name='nama_modul'></div>
           </div>
           <div class='row show-grid'>
          <div class='col-md-3 col-md-push-9'>Link</div>
          <div class='col-md-9 col-md-pull-3'><input type=text required='required' name='link' class='form-control' size=30><div>
          </div><br />
         <label>Publish</label> <br />      <label class='radio-inline'> <input type=radio name='publish' value='Y' checked>Y </label> 
                                       <label class='radio-inline'><input type=radio name='publish' value='N'> N</label><br /><br />
         <label>Aktif</label><br />       <label class='radio-inline'><input type=radio name='aktif' value='Y' checked>Y </label> 
                                    <label class='radio-inline'> <input type=radio name='aktif' value='N'> N</label><br /><br />
                                    
          <label>Status</label><br />   <label class='radio-inline'> <input type=radio name='status' value='admin' checked>admin</label>
                                        <label class='radio-inline'> <input type=radio name='status' value='user'>user</label><br /><br />
          <tr><td class='left' colspan=2><input type=submit role='button' class='btn  btn-primary' value=Simpan></td>
          <td><div class='col-md-3 col-md-push-2'><input type=button value=Batal role='button' class='btn  btn-primary' onclick=self.history.back()></div></td></tr>
          </tbody></table></form>";
     break;
 
  case "editmodul":
    $edit = mysql_query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo " <div class='row'>
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>
 <i class='fa fa-puzzle-piece fa-fw'></i>  Edit Modul
  </div>
  <div class='panel-body'>
  <div class='row'>
  <div class='col-lg-12'>
  <div class='form-group'>
  <form method=POST action=$aksi?module=modul&act=update>
  <input type=hidden name=id value='$r[id_modul]'>
  <table  class='list'><tbody>
  <div class='row show-grid'>
                            <div class='col-md-3 col-md-push-9'>Nama Modul</div>
                            <div class='col-md-9 col-md-pull-3'><input type='text' required='required' name='nama_modul' class='form-control' value='$r[nama_modul]'/></div>
  </div>
  <div class='row show-grid'>
                            <div class='col-md-3 col-md-push-9'>Link</div>
                            <div class='col-md-9 col-md-pull-3'><input type='text' required='required' name='link' class='form-control' value='$r[link]'/></div>
  </div>";
    if ($r[publish]=='Y'){
        	echo"
                            <label>Publish</label><br />
                            <label class='radio-inline'> <input type='radio' name='publish' value='Y' checked/>Y</label>
                            <label class='radio-inline'> <input type='radio' name='publish' value='N'/>N
							
							</label><br /><br />";

    }
    else{
        echo"
                            <label>Publish</label><br />
                            <label class='radio-inline'> <input type='radio' name='publish' value='Y'/>Y</label>
                            <label class='radio-inline'> <input type='radio' name='publish' value='N'  checked/>N
							
							</label><br /><br />";
    }
    if ($r[aktif]=='Y'){
      echo "
      <label>Aktif</label><br /> 
      <label class='radio-inline'><input type=radio name='aktif' value='Y' checked>Y</label>  
      <label class='radio-inline'>  <input type=radio name='aktif' value='N'> N</label><br /><br />";
    }
    else{
      echo "
      <label>Aktif</label><br />
      <label class='radio-inline'> <input type=radio name='aktif' value='Y'>Y</label>  
      <label class='radio-inline'> <input type=radio name='aktif' value='N' checked>N</label><br /><br />";
    }
    if ($r[status]=='user'){
      echo "
      <label>Status</label><br /> 
      <label class='radio-inline'> <input type=radio name='status' value='user' checked>user</label>  
      <label class='radio-inline'> <input type=radio name='status' value='admin'> admin</label><br /><br />";
    }
    else{
      echo "
      <label>Status</label><br />
      <label class='radio-inline'> <input type=radio name='status' value='user'>user</label>  
      <label class='radio-inline'> <input type=radio name='status' value='admin' checked>admin
                                       </label><br /><br />";
    }
    echo "<div class='row show-grid'>
                            <div class='col-md-3 col-md-push-9'>Urutan</div>
                            <div class='col-md-9 col-md-pull-3'><input type='text' required='required' name='urutan' class='form-control' value='$r[urutan]'/></div></div><br /><br />
                         <tr><td class='left' colspan=2><input role='button' class='btn  btn-primary' type=submit value=Update></td>
    <td><div class='col-md-3 col-md-push-2'><input type=button value=Batal role='button' class='btn  btn-primary' onclick=self.history.back()></td></tr>
          </tbody></table></form>";
         
    break;  
}
}
?>
