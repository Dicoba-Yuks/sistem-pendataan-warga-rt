<?php
if (!function_exists('koneksi')) {
  // Gunakan require_once yang aman untuk memuat functions.php
  require_once 'functions.php';
}

// Cek apakah 'keyword' ada
$keyword = $_GET['keyword'] ?? "";
$warga = cari_warga($keyword);
?>

<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <th>No.</th>
    <th>Nama</th>
    <th>NIK</th>
    <th>Jenis Kelamin</th>
    <th>Pekerjaan</th>
    <th>Aksi</th>
  </tr>

  <?php if (empty($warga)) : ?>
    <tr>
      <td colspan="6">
        <p style="color:red; font-style:italic; text-align:center;">
          DATA WARGA TIDAK DITEMUKAN!
        </p>
      </td>
    </tr>
  <?php endif; ?>

  <?php $i = 1;
  foreach ($warga as $w) : ?>
    <tr>
      <td><?= $i++; ?></td>
      <td><?= $w['nama']; ?></td>
      <td><?= $w['nik']; ?></td>
      <td><?= $w['jenis_kelamin']; ?></td>
      <td><?= $w['pekerjaan']; ?></td>
      <td>
        <a href="ubah.php?id=<?= $w['id']; ?>">Ubah</a> |
        <a href="hapus.php?id=<?= $w['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>