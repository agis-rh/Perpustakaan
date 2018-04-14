<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if ($_GET['module']=='home')
{ 
include "home.php";
}
else
if ($_GET['module']=='pengembalian')
{ 
include "modul/mod_kembali/kembalikan.php";
}
else
if ($_GET['module']=='perkelas')
{ 
include "modul/mod_anggota/perkelas.php";
}
else
if ($_GET['module']=='blacklist')
{ 
include "modul/mod_laporan/blacklist.php";
}
else
if ($_GET['module']=='kelas')
{ 
include "modul/mod_kelas/kelas.php";
}
else
if ($_GET['module']=='modul')
{ 
include "modul/mod_modul/modul.php";
}
else
if ($_GET['module']=='pegawai')
{ 
include "modul/mod_pegawai/pegawai.php";
}
else
if ($_GET['module']=='buku')
{ 
include "modul/mod_buku/buku.php";
}
else
if ($_GET['module']=='anggota')
{ 
include "modul/mod_anggota/anggota.php";
}
else
if ($_GET['module']=='transaksi')
{ 
include "modul/mod_transaksi/transaksi.php";
}
else
if ($_GET['module']=='pinjam')
{ 
include "modul/mod_laporan/pinjam.php";
}
else
if ($_GET['module']=='kategori')
{ 
include "modul/mod_kategori/kategori.php";
}
else
if ($_GET['module']=='stock')
{ 
include "modul/mod_laporan/stock.php";
}
else
if ($_GET['module']=='kembali')
{ 
include "modul/mod_laporan/kembali.php";
}
else
if($_GET['module']=='kembalikan') {
    include "modul/mod_kembali/pengembalian.php";
    
}
else
if ($_GET['module']=='penerbit')
{ 
include "modul/mod_penerbit/penerbit.php";
}
else
{
include "not_found.php";	
}
?>
</body>
</html>