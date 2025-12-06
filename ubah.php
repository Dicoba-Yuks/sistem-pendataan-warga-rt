<?php
require 'functions.php';

// Ambil ID dari URL
$id = $_GET["id"];

// Ambil data warga berdasarkan ID
$warga = query("SELECT * FROM warga WHERE id = $id")[0];

$validasi_error = null;

// Cek apakah tombol submit sudah ditekan
if (isset($_POST["submit"])) {
  $result = ubah_warga($_POST);

  if (is_array($result) && isset($result['error'])) {
    // Jika hasil adalah array error dari validasi
    $validasi_error = $result['pesan'];
  } elseif ($result > 0) {
    echo "<script>
        alert('Data Warga Berhasil Diubah!');
        document.location.href = 'index.php';
    </script>";
  } else {
    echo "<script>
        alert('Data Warga Gagal Diubah atau Tidak Ada Perubahan!');
        document.location.href = 'index.php';
    </script>";
  }
}

include 'header.php';
?>

<h1>Ubah Data Warga</h1>
<a href="index.php">← Kembali ke Daftar Warga</a>
<hr>

<?php if ($validasi_error): ?>
  <p style="color:red; font-weight:bold;"><?= $validasi_error; ?></p>
<?php endif; ?>

<form action="" method="post">
  <input type="hidden" name="id" value="<?= $warga['id']; ?>">
  <ul>
    <li>
      <label for="nama">Nama Lengkap:</label>
      <input type="text" name="nama" id="nama" required value="<?= $warga['nama']; ?>">
    </li>
    <li>
      <label for="nik">NIK (16 Digit):</label>
      <input type="text" name="nik" id="nik" required maxlength="16" value="<?= $warga['nik']; ?>">
    </li>
    <li>
      <label for="jenis_kelamin">Jenis Kelamin:</label>
      <select name="jenis_kelamin" id="jenis_kelamin">
        <option value="Laki-laki" <?= ($warga['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
        <option value="Perempuan" <?= ($warga['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
      </select>
    </li>
    <li>
      <label for="tanggal_lahir">Tanggal Lahir:</label>
      <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?= $warga['tanggal_lahir']; ?>">
    </li>
    <li>
      <label for="status_kawin">Status Kawin:</label>
      <input type="text" name="status_kawin" id="status_kawin" value="<?= $warga['status_kawin']; ?>">
    </li>
    <li>
      <label for="pekerjaan">Pekerjaan:</label>
      <input type="text" name="pekerjaan" id="pekerjaan" value="<?= $warga['pekerjaan']; ?>">
    </li>
    <li>
      <label for="alamat">Alamat (RT/RW):</label>
      <textarea name="alamat" id="alamat"><?= $warga['alamat']; ?></textarea>
    </li>

    <li>
      <button type="submit" name="submit">Ubah Data</button>
    </li>
  </ul>
</form>

<?php
include 'footer.php';
?>