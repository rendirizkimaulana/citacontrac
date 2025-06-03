<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
  header("Location: index.html");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Simulasi Pemasangan Meteran - PT Citacontrac</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .simulasi-card {
      transition: 0.3s;
      border-radius: 12px;
      overflow: hidden;
    }
    .simulasi-card:hover {
      transform: scale(1.03);
      box-shadow: 0 0 15px rgba(0,0,0,0.15);
    }
    .simulasi-img {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container my-5">
    <h2 class="text-primary mb-4">Simulasi Pemasangan Meteran</h2>
    <p>Pilih jenis meteran yang ingin Anda pelajari melalui media interaktif:</p>

    <div class="row">
      <!-- Prabayar -->
      <div class="col-md-6 mb-4">
        <div class="card simulasi-card h-100">
          <img src="img/prabayar.png" alt="Simulasi Prabayar" class="simulasi-img card-img-top" />
          <div class="card-body text-center">
            <h5 class="card-title">Meteran Prabayar</h5>
            <p class="card-text">Simulasi interaktif untuk pemasangan dan pengoperasian meteran listrik prabayar.</p>
            <a href="game.html" class="btn btn-primary">Mulai Simulasi</a>
          </div>
        </div>
      </div>

      <!-- Pascabayar -->
      <div class="col-md-6 mb-4">
        <div class="card simulasi-card h-100">
          <img src="img/prabayar.png" alt="Simulasi Prabayar" class="simulasi-img card-img-top" />
          <div class="card-body text-center">
            <h5 class="card-title">Meteran Pascabayar</h5>
            <p class="card-text">Simulasi interaktif untuk pemasangan dan pemahaman sistem meteran pascabayar.</p>
            <a href="game.html" class="btn btn-success">Mulai Simulasi</a>
          </div>
        </div>
      </div>
    </div>

    <a href="beranda.php" class="btn btn-outline-primary mt-4">Kembali ke Beranda</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
