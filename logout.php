<?php
session_start();

// Hapus semua session yang telah disetel
$_SESSION = [];
session_unset();
session_destroy();

// Redirect ke halaman login
header("Location: login.php");
exit;
