<?php
require 'functions.php';

if (isset($_POST['register'])) {
  if (registrasi($_POST) > 0) {
    echo "<script>
      alert('Registrasi Berhasil! Silakan login.');
      document.location.href = 'login.php';
    </script>";
  } else {
    echo "<script>
        alert('Registrasi Gagal!');
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Akun</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="login-body">
  <div class="login-container">
    <h1>Registrasi Akun Petugas</h1>
    <hr>
    <form action="" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
      </div>
      <div class="form-group">
        <label for="password_1">Password:</label>
        <input type="password" name="password_1" id="password_1" required>
      </div>
      <div class="form-group">
        <label for="password_2">Konfirmasi Password:</label>
        <input type="password" name="password_2" id="password_2" required>
      </div>
      <button type="submit" name="register">Daftar</button>
    </form>
    <p class="register-link">Sudah punya akun? <a href="login.php">Login di sini</a></p>
  </div>
</body>

</html>