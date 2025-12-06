<?php
require 'functions.php';

// Ambil ID dari URL
$id = $_GET["id"];

// Panggil fungsi hapus_warga
if (hapus_warga($id) > 0) {
  echo "<script>
    alert('Data Warga Berhasil Dihapus!');
    document.location.href = 'index.php';
  </script>";
} else {
  echo "<script>
    alert('Data Warga Gagal Dihapus!');
    document.location.href = 'index.php';
  </script>";
}
