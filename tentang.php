<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
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
  <title>Tentang - PT.Citacontrac</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <style>
    .hero-section {
      background: linear-gradient(135deg, #004aad, #0091ea);
      color: white;
      overflow: hidden;
      position: relative;
    }
    svg.wave {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      z-index: 1;
    }
  </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">PT.Citacontrac</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if ($role == 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="materi.php">Kelola Materi</a></li>
          <li class="nav-item"><a class="nav-link" href="kelola_evaluasi.php">Kelola Evaluasi</a></li>
          <li class="nav-item"><a class="nav-link" href="lihat_hasil.php">Lihat Hasil</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="beranda.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="materi.php">Materi</a></li>
          <li class="nav-item"><a class="nav-link" href="simulasi.php">Simulasi</a></li>
          <li class="nav-item"><a class="nav-link" href="evaluasi.php">Evaluasi</a></li>
          <li class="nav-item"><a class="nav-link active" href="#">Tentang</a></li>
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

<!-- Hero Section -->
<section class="hero-section text-center py-5">
  <div class="container position-relative" style="z-index: 2;">
    <h1 class="display-5 fw-bold mb-3 text-shadow-lg" data-aos="fade-down">Tentang PT. Citacontrac</h1>
    <p class="lead mb-4 text-shadow-md" data-aos="fade-up" data-aos-delay="200">
      Kami hadir untuk mendukung pelatihan teknis yang aman dan efektif di bidang ketenagalistrikan.
    </p>
  </div>
  <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 150" preserveAspectRatio="none">
    <path fill="#ffffff" fill-opacity="0.3" d="M0,64L48,85.3C96,107,192,149,288,149.3C384,149,480,107,576,90.7C672,75,768,85,864,80C960,75,1056,53,1152,37.3C1248,21,1344,11,1392,5.3L1440,0L1440,150L1392,150C1344,150,1248,150,1152,150C1056,150,960,150,864,150C768,150,672,150,576,150C480,150,384,150,288,150C192,150,96,150,48,150L0,150Z"></path>
  </svg>
</section>

<!-- Profil Perusahaan dengan Slider Gambar -->
<section class="py-5 bg-white" data-aos="fade-up" data-aos-delay="400">
  <div class="container">
    <h2 class="mb-4 text-center fw-bold">Profil Perusahaan</h2>
    <p class="text-center mb-5 text-secondary fs-5">
      PT Citacontrac telah berpengalaman lebih dari 10 tahun dalam bidang instalasi listrik dan pengadaan alat kelistrikan. 
      Kami selalu mengutamakan kualitas, keamanan, dan inovasi dalam setiap layanan kami.
    </p>

    <div id="companyCarousel" class="carousel slide shadow rounded" data-bs-ride="carousel" data-bs-interval="4000">
      <div class="carousel-inner rounded">
        <div class="carousel-item active">
          <img src="img/tentang1.png" class="d-block w-100" alt="Proyek Instalasi Listrik 1" style="max-height: 400px; object-fit: cover;">
        </div>
        <div class="carousel-item">
          <img src="img/tentang2.png" class="d-block w-100" alt="Proyek Instalasi Listrik 2" style="max-height: 400px; object-fit: cover;">
        </div>
        <div class="carousel-item">
          <img src="img/tentang3.jpeg" class="d-block w-100" alt="Tim Profesional" style="max-height: 400px; object-fit: cover;">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#companyCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Sebelumnya</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#companyCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Berikutnya</span>
      </button>
    </div>
  </div>
</section>


<!-- Misi Section -->
<section class="py-5 bg-light" data-aos="zoom-in-up">
  <div class="container">
    <h2 class="mb-4 text-center fw-bold">Misi Kami</h2>
    <div class="row text-center">
      <div class="col-md-4 mb-4">
        <i class="bi bi-lightning-charge-fill fs-1 text-warning"></i>
        <h5 class="mt-2 fw-semibold">Efisiensi Pelatihan</h5>
        <p>Meningkatkan efisiensi pelatihan teknis melalui media digital berbasis simulasi.</p>
      </div>
      <div class="col-md-4 mb-4">
        <i class="bi bi-person-video2 fs-1 text-primary"></i>
        <h5 class="mt-2 fw-semibold">Interaktif & Praktis</h5>
        <p>Memberikan pengalaman belajar interaktif yang mudah dipahami.</p>
      </div>
      <div class="col-md-4 mb-4">
        <i class="bi bi-award-fill fs-1 text-success"></i>
        <h5 class="mt-2 fw-semibold">Kualitas SDM</h5>
        <p>Menyiapkan tenaga kerja unggul dan siap pakai di bidang ketenagalistrikan.</p>
      </div>
    </div>
  </div>
</section>

<!-- Kontak & Lokasi -->
<section class="py-5 bg-white" data-aos="fade-up">
  <div class="container">
    <h2 class="mb-4 text-center fw-bold">Kontak & Lokasi</h2>
    <div class="row align-items-center">
      <div class="col-md-6 mb-4">
        <h5 class="fw-semibold"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Alamat</h5>
        <p>MT. Haryono Square G Jl. Otista Raya<br>
        RT 06 RW 12 Jakarta Timur, Indonesia<br>
        Jl. Pinang Ranti No. 5 Jakarta Timur, Indonesia</p>

        <h5 class="fw-semibold"><i class="bi bi-envelope-fill text-primary me-2"></i>Email</h5>
        <p>citacontrac@yahoo.com</p>

        <h5 class="fw-semibold"><i class="bi bi-telephone-fill text-success me-2"></i>Telepon</h5>
        <p>(021) 8090623</p>
      </div>
      <div class="col-md-6">
        <!-- GMaps Embed -->
        <div class="ratio ratio-4x3 rounded shadow">
          <iframe
            src="https://www.google.com/maps?q=PV6J%2BG5%20Pinang%20Ranti,%20Jakarta%20Timur&output=embed"
            width="600"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
        <div class="container">
            <small>&copy; <?= date('Y') ?> PT.Citacontrac & PLN. All Rights Reserved.</small>
        </div>
    </footer>

<!-- JS Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    once: true,
    duration: 800,
    easing: 'ease-in-out'
  });
</script>
</body>
</html>
