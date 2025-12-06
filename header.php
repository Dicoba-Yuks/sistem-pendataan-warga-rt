<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Pendataan Warga RT</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <header>
      <nav>
        <a href="index.php">Daftar Warga</a> |
        <a href="tambah.php">Tambah Data</a> |
        <a href="logout.php" onclick="return confirm('Yakin ingin keluar?');">Logout</a>
      </nav>
      <hr>
    </header>