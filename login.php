<?php
session_start();
require 'functions.php';

if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

$error = false;

if (isset($_POST['login'])) {
  $result = login($_POST);

  if ($result === true) {
    //Set session login
    $_SESSION['login'] = true;

    //Redirection ke halaman utama
    header("Location: index.php");
    exit;
  } else {
    if (isset($result['error'])) {
      $error = true;
      $pesan = $result['pesan'];
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Sistem Pendataan</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="login-body">
  <div class="login-container">
    <h1>Login Petugas RT</h1>
    <hr>

    <?php if ($error) : ?>
      <p class="error-msg"><?= $pesan; ?></p>
    <?php endif; ?>

    <form action="" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
      </div>
      <button type="submit" name="login">Masuk</button>
    </form>
    <p class="register-link">Belum punya akun? <a href="registrasi.php">Registrasi di sini</a></p>
  </div>
</body>

</html>