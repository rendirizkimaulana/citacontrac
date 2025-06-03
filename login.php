<?php
session_start();
include 'db/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = md5($_POST['password']); // password MD5 sesuai insert dummy

  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    header("Location: beranda.php");
    exit;
  } else {
    echo "Username atau password salah.";
  }
}
?>
