<?php
include "../config/koneksi.php";
  session_start();
  session_destroy();
   mysql_query("UPDATE pegawai SET aktif='0' WHERE username='$username'");
  echo "<script>alert('Anda telah keluar dari halaman administrator'); window.location = 'index.php'</script>";
?>
