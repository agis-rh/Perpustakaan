<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];
$tanggal= date("d-m-Y");

// Hapus buku
if ($module=='buku' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM buku WHERE id_buku='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM buku WHERE id_buku='$_GET[id]'");  
  }
  else{
     mysql_query("DELETE FROM buku WHERE id_buku='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);


  mysql_query("DELETE FROM buku WHERE id_buku='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input buku
elseif ($module=='buku' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  
  // Apabila ada cover yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=buku)</script>";
    }
    else{
    UploadImage($nama_file_unik);

    mysql_query("INSERT INTO buku(judul,
                               id_kategori,
                                    id_penerbit,
                                    isbn,
                                    jumlah_buku,
                                    penulis,
                                    tahun_terbit,
                                    deskripsi,
                                    tgl_masuk,
                                    jumlah_tempo,
                                    gambar) 
                            VALUES('$_POST[judul]',
                                   '$_POST[kategori]',
                                   '$_POST[penerbit]',
                                   '$_POST[isbn]',
                                   '$_POST[jumlah]',
                                   '$_POST[penulis]',
                                   '$_POST[terbit]',
                                   '$_POST[deskripsi]',
                                   '$tanggal',
                                   '$_POST[jumlah]',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO buku(judul,
                               id_kategori,
                                    id_penerbit,
                                    isbn,
                                    jumlah_buku,
                                    penulis,
                                    tahun_terbit,
                                    deskripsi,
                                    jumlah_tempo,
                                    tgl_masuk) 
                            VALUES('$_POST[judul]',
                                   '$_POST[kategori]',
                                   '$_POST[penerbit]',                                 
                                   '$_POST[isbn]',
                                   '$_POST[penulis]',
                                   '$_POST[terbit]',
                                   '$_POST[deskripsi]',
                                   '$_POST[jumlah]',
                                   '$tanggal')");
  header('location:../../media.php?module='.$module);
  }
}

// Update buku
elseif ($module=='buku' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  // Apabila cover tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE buku SET judul = '$_POST[judul]',
                                   id_kategori = '$_POST[kategori]',
                                   id_penerbit ='$_POST[penerbit]',
                                   isbn       = '$_POST[isbn]',
                                   penulis     = '$_POST[penulis]',
                                   tahun_terbit= '$_POST[terbit]',
                                   
                                   jumlah_buku  = '$_POST[jumlah]',
                                   
                                   jumlah_tempo = '$_POST[jumlah]',
                                   
                                   deskripsi   = '$_POST[deskripsi]'
                             WHERE id_buku   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=buku)</script>";
    }
    else{
    UploadImage($nama_file_unik);
    mysql_query("UPDATE buku SET judul = '$_POST[judul]',
                                    id_kategori = '$_POST[kategori]',
                                   id_penerbit = '$_POST[penerbit]',
                                   isbn        = '$_POST[isbn]',
                                   penulis     = '$_POST[penulis]',
                                   tahun_terbit= '$_POST[terbit]',
                                   jumlah_buku = '$_POST[jumlah]',
                                   jumlah_tempo = '$_POST[jumlah]',
                                   deskripsi   = '$_POST[deskripsi]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_buku   = '$_POST[id]'");
    header('location:../../media.php?module='.$module);
    }
  }
}
}
?>
