<?php
require 'functions.php';
include 'header.php';
?>

<h1>Sistem Pendataan Warga RT</h1>
<a href="tambah.php">Tambah Data Warga Baru</a>
<br><br>
<input type="text" name="keyword" id="keyword" placeholder="Cari Nama atau NIK..." autocomplete="off">
<button type="submit" id="tombol-cari" style="display:none;">Cari</button>
<hr>
<div id="container-data">
  <?php include 'ajax_cari.php'; ?>
</div>

<?php
include 'footer.php';
?>