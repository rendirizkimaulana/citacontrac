<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
  header("Location: index.html");
  exit;
}

$username = htmlspecialchars($_SESSION['username']);
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Simulasi Pemasangan Meteran - PT Citacontrac</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- AOS Animation -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <style>
    /* Hover shadow */
    .hover-shadow:hover {
      box-shadow: 0 0 25px rgba(0, 145, 234, 0.7);
      transform: translateY(-10px);
      transition: all 0.3s ease;
    }

    /* Ripple effect for buttons */
    .ripple-effect {
      position: relative;
      overflow: hidden;
    }

    .ripple-effect::after {
      content: "";
      position: absolute;
      border-radius: 50%;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      pointer-events: none;
      background: rgba(255, 255, 255, 0.3);
      animation: ripple 0.8s ease-out;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .ripple-effect:active::after {
      opacity: 1;
      animation: ripple 0.6s ease-out;
    }

    @keyframes ripple {
      0% {
        transform: scale(0);
        opacity: 0.7;
      }

      100% {
        transform: scale(2.5);
        opacity: 0;
      }
    }

    .simulasi-card {
      transition: 0.3s;
      border-radius: 12px;
      overflow: hidden;
    }

    .simulasi-card:hover {
      transform: scale(1.03);
      box-shadow: 0 0 15px rgba(0, 145, 234, 0.6);
    }

    .simulasi-img {
      height: 200px;
      object-fit: cover;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
    }
  </style>
</head>

<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">PT.Citacontrac</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php if ($role === 'admin') : ?>
            <li class="nav-item"><a class="nav-link" href="materi.php">Kelola Materi</a></li>
            <li class="nav-item"><a class="nav-link" href="kelola_evaluasi.php">Kelola Evaluasi</a></li>
            <li class="nav-item"><a class="nav-link" href="lihat_hasil.php">Lihat Hasil</a></li>
          <?php else : ?>
            <li class="nav-item"><a class="nav-link" href="materi.php">Materi</a></li>
            <li class="nav-item"><a class="nav-link active" href="simulasi.php">Simulasi</a></li>
            <li class="nav-item"><a class="nav-link" href="evaluasi.php">Evaluasi</a></li>
            <li class="nav-item"><a class="nav-link" href="hasil.php">Hasil</a></li>
            <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang</a></li>
          <?php endif; ?>
        </ul>

        <div class="d-flex align-items-center text-white">
          <i class="bi bi-person-circle fs-4 me-2"></i>
          <span class="me-3"><?= $username ?></span>
          <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <section class="py-5">
    <div class="container" data-aos="fade-up" data-aos-duration="800">
      <h2 class="text-primary mb-4">Simulasi Pemasangan Meteran</h2>
      <p class="mb-4">Pilih jenis meteran yang ingin Anda pelajari melalui media interaktif:</p>

      <div class="row g-4">
        <!-- Prabayar -->
        <div class="col-md-6">
          <div class="card simulasi-card hover-shadow h-100">
            <img src="img/prabayar.png" alt="Simulasi Prabayar" class="simulasi-img card-img-top" />
            <div class="card-body text-center">
              <h5 class="card-title">Meteran Prabayar</h5>
              <p class="card-text">Simulasi interaktif untuk pemasangan dan pengoperasian meteran listrik prabayar.</p>
              <a href="game.html" class="btn btn-primary ripple-effect">Mulai Simulasi</a>
            </div>
          </div>
        </div>

        <!-- Pascabayar -->
        <div class="col-md-6">
          <div class="card simulasi-card hover-shadow h-100">
            <img src="img/prabayar.png" alt="Simulasi Pascabayar" class="simulasi-img card-img-top" />
            <div class="card-body text-center">
              <h5 class="card-title">Meteran Pascabayar</h5>
              <p class="card-text">Simulasi interaktif untuk pemasangan dan pemahaman sistem meteran pascabayar.</p>
              <a href="game.html" class="btn btn-success ripple-effect">Mulai Simulasi</a>
            </div>
          </div>
        </div>
      </div>

      <a href="beranda.php" class="btn btn-outline-primary mt-5 ripple-effect">Kembali ke Beranda</a>
    </div>
  </section>


  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS JS -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 800,
      easing: 'ease-in-out',
    });
  </script>

</body>

</html>
