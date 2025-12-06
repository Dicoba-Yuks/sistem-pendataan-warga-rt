<?php

function login($data)
{
  $conn = koneksi();
  $username = $data['username'];
  $password = $data['password'];

  // Cari user berdasarkan username
  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  // Cek apakah username ditemukan
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    // Cek password (menggunakan verifikasi hash)
    if (password_verify($password, $row['password'])) {
      // Login Berhasil
      return true;
    }
  }

  // Login Gagal
  return [
    'error' => true,
    'pesan' => 'Username atau Password Salah!'
  ];
}

function registrasi($data)
{
  $conn = koneksi();

  $username = strtolower(stripslashes($data['username']));
  $password_1 = mysqli_real_escape_string($conn, $data['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $data['password_2']);

  //Cek konfirmasi password
  if ($password_1 !== $password_2) {
    echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
    return false;
  }

  //Cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>alert('Username sudah terdaftar!');</script>";
    return false;
  }

  //Enkripsi password (Hashing)
  $password = password_hash($password_1, PASSWORD_DEFAULT);

  //Tambahkan user baru ke database
  mysqli_query($conn, "INSERT INTO user VALUES (NULL, '$username', '$password')");

  return mysqli_affected_rows($conn);
}

//Fungsi Koneksi Database
function koneksi()
{
  $conn = mysqli_connect('localhost', 'root', '', 'data_warga', 3307);

  // Cek koneksi
  if (!$conn) {
    echo "<h1>KONEKSI DATABASE GAGAL!</h1>";
    echo "<p>Detail: " . mysqli_connect_error() . "</p>";
    return null;
  }
  return $conn;
}

//Fungsi Query (untuk mengambil semua data)
function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query);

  // Cek jika query gagal
  if (!$result) {
    return [];
  }

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

//Fungsi Tambah Data Warga
function tambah_warga($data)
{
  $conn = koneksi();

  // Ambil dan bersihkan data
  $nama = htmlspecialchars($data['nama']);
  $nik = htmlspecialchars($data['nik']);
  $jk = htmlspecialchars($data['jenis_kelamin']);
  $tgl_lahir = htmlspecialchars($data['tanggal_lahir']);
  $status_k = htmlspecialchars($data['status_kawin']);
  $pekerjaan = htmlspecialchars($data['pekerjaan']);
  $alamat = htmlspecialchars($data['alamat']);

  //Validasi NIK (Harus 16 digit)
  if (strlen($nik) != 16) {
    return [
      'error' => true,
      'pesan' => 'Gagal: NIK harus tepat 16 digit!'
    ];
  }

  //Validasi Nama (Tidak boleh numerik)
  if (is_numeric($nama)) {
    return [
      'error' => true,
      'pesan' => 'Gagal: Nama tidak boleh angka!'
    ];
  }

  // Query INSERT
  $query = "INSERT INTO warga 
    VALUES (
      NULL, '$nama', '$nik', '$jk', '$tgl_lahir', 
      '$status_k', '$pekerjaan', '$alamat'
    )";

  mysqli_query($conn, $query);

  // Kembalikan jumlah baris yang terpengaruh (1 = berhasil)
  return mysqli_affected_rows($conn);
}

//Fungsi Hapus Data Warga
function hapus_warga($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM warga WHERE id = $id");
  return mysqli_affected_rows($conn);
}

//Fungsi Ubah Data Warga
function ubah_warga($data)
{
  $conn = koneksi();

  // Pastikan ID disiapkan dengan aman
  $id = mysqli_real_escape_string($conn, $data['id']);
  $nama = htmlspecialchars($data['nama']);
  $nik = htmlspecialchars($data['nik']);
  $jk = htmlspecialchars($data['jenis_kelamin']);
  $tgl_lahir = htmlspecialchars($data['tanggal_lahir']);
  $status_k = htmlspecialchars($data['status_kawin']);
  $pekerjaan = htmlspecialchars($data['pekerjaan']);
  $alamat = htmlspecialchars($data['alamat']);

  //Validasi NIK (Harus 16 digit)
  if (strlen($nik) != 16) {
    return [
      'error' => true,
      'pesan' => 'Gagal: NIK harus tepat 16 digit!'
    ];
  }

  //Validasi Nama (Tidak boleh numerik)
  if (is_numeric($nama)) {
    return [
      'error' => true,
      'pesan' => 'Gagal: Nama tidak boleh angka!'
    ];
  }

  // Query UPDATE
  $query = "UPDATE warga SET
    nama = '$nama',
    nik = '$nik',
    jenis_kelamin = '$jk',
    tanggal_lahir = '$tgl_lahir',
    status_kawin = '$status_k',
    pekerjaan = '$pekerjaan',
    alamat = '$alamat'
  WHERE id = '$id'";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

//Fungsi Cari Data Warga (digunakan oleh AJAX)
function cari_warga($keyword)
{
  $conn = koneksi();
  $query = "SELECT id, nama, nik, jenis_kelamin, pekerjaan, status_kawin, tanggal_lahir, alamat FROM warga 
    WHERE
      LOWER(nama) LIKE '%$keyword%' OR  
          nik LIKE '%$keyword%' OR
          LOWER(pekerjaan) LIKE '%$keyword%'
    ORDER BY id DESC";

  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
