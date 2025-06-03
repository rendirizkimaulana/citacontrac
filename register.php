<?php
session_start();
include 'db/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = md5($_POST['password']); // Gunakan md5 sesuai struktur tabel saat ini

  // Cek apakah username sudah ada
  $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  if (mysqli_num_rows($cek) > 0) {
    $error = "Username sudah digunakan!";
  } else {
    // Tambah user baru (role otomatis 'user')
    if (mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')")) {
      $success = "Pendaftaran berhasil! Silakan login.";
    } else {
      $error = "Terjadi kesalahan saat pendaftaran.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register Akun Baru - PT Citacontrac</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('img/login.jpg') no-repeat center center fixed;
      background-size: cover;
      overflow: hidden;
    }

    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(8px);
      z-index: 0;
    }

    nav.navbar {
      background-color: rgba(255, 255, 255, 0.85);
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      z-index: 10;
    }

    nav.navbar .navbar-brand {
      font-weight: 700;
      color: #0d6efd;
      font-size: 1.5rem;
    }

    .register-container {
      position: relative;
      z-index: 5;
      min-height: calc(100vh - 56px);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .card-register {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
      max-width: 400px;
      width: 100%;
      padding: 40px 30px;
      text-align: center;
    }

    .card-register h3 {
      font-weight: 700;
      font-size: 28px;
      margin-bottom: 25px;
      color: #343a40;
    }

    .form-label {
      font-weight: 600;
      color: #495057;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px 15px;
      margin-bottom: 20px;
      font-size: 16px;
      border: 1.5px solid #ced4da;
      transition: border-color 0.3s;
    }

    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 8px rgba(13,110,253,0.3);
      outline: none;
    }

    .btn-primary {
      border-radius: 10px;
      font-weight: 700;
      padding: 12px;
      font-size: 16px;
      width: 100%;
      transition: background-color 0.3s;
    }

    .btn-primary:hover {
      background-color: #0b5ed7;
    }

    .text-center small {
      color: #6c757d;
      font-size: 14px;
    }

    .text-center small a {
      color: #0d6efd;
      font-weight: 600;
      text-decoration: none;
    }

    .text-center small a:hover {
      text-decoration: underline;
    }

    @media (max-width: 480px) {
      .card-register {
        padding: 30px 20px;
      }
      .card-register h3 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>

<nav class="navbar">
  <div class="container">
    <a class="navbar-brand" href="#">PT Citacontrac</a>
  </div>
</nav>

<div class="register-container">
  <div class="card-register">
    <h3>Form Registrasi Pengguna</h3>

    <?php if (isset($error)): ?>
      <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error) ?></div>
    <?php elseif (isset($success)): ?>
      <div class="alert alert-success" role="alert"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="post" novalidate autocomplete="off">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" id="username" name="username" class="form-control" required autofocus />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" required />
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
    </form>

    <div class="text-center mt-3">
      <small>Sudah punya akun? <a href="index.html">Login di sini</a></small>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
