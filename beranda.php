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
  <title>Selamat Datang di Simulasi Meteran - PT.Citacontrac & PLN</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- AOS Animation -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  
  <style>
    /* Text shadow helpers */
    .text-shadow-lg {
      text-shadow: 0 4px 6px rgba(0,0,0,0.4);
    }
    .text-shadow-md {
      text-shadow: 0 2px 4px rgba(0,0,0,0.25);
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
      top: 0; left: 0;
      pointer-events: none;
      background: rgba(255,255,255,0.3);
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
    /* Feature icons animation */
    .feature-icon {
      transition: color 0.3s ease, transform 0.3s ease;
      cursor: default;
    }
    .feature-icon:hover {
      color: #0056b3;
      transform: scale(1.2);
    }
    /* Hover shadow */
    .hover-shadow:hover {
      box-shadow: 0 0 25px rgba(0, 145, 234, 0.7);
      transform: translateY(-10px);
      transition: all 0.3s ease;
    }
    .hover-scale:hover {
      transform: scale(1.07);
      transition: transform 0.3s ease;
    }

    /* Hero Section */
    .hero-section {
      background: linear-gradient(135deg, #004aad, #0091ea);
      color: white;
      overflow: hidden;
      position: relative;
    }
    /* SVG Wave */
    svg.wave {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      z-index: 1;
    }
  </style>
</head>
<body>

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
        <?php if ($role == 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="materi.php">Kelola Materi</a></li>
          <li class="nav-item"><a class="nav-link" href="kelola_evaluasi.php">Kelola Evaluasi</a></li>
          <li class="nav-item"><a class="nav-link" href="lihat_hasil.php">Lihat Hasil</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="materi.php">Materi</a></li>
          <li class="nav-item"><a class="nav-link" href="simulasi.php">Simulasi</a></li>
          <li class="nav-item"><a class="nav-link" href="evaluasi.php">Evaluasi</a></li>
          <li class="nav-item"><a class="nav-link" href="hasil.php">Hasil</a></li>
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
    <h1 class="display-4 fw-bold mb-3 text-shadow-lg" data-aos="fade-down">Simulasi Meteran Listrik Interaktif</h1>
    <p class="lead mb-4 text-shadow-md" data-aos="fade-up" data-aos-delay="200">
      Media pembelajaran inovatif hasil kerjasama dengan <strong>PLN</strong> untuk meningkatkan kompetensi teknis instalasi listrik.
    </p>
    <a href="simulasi.php" 
       class="btn btn-light btn-lg shadow-lg px-4 py-3 ripple-effect animate__animated animate__pulse animate__infinite"
       aria-label="Mulai Simulasi Sekarang" data-aos="zoom-in" data-aos-delay="400">
       Mulai Simulasi Sekarang
    </a>
  </div>
  
  <!-- SVG Wave Bottom -->
  <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 150" preserveAspectRatio="none">
      <path fill="#ffffff" fill-opacity="0.3" d="M0,64L48,85.3C96,107,192,149,288,149.3C384,149,480,107,576,90.7C672,75,768,85,864,80C960,75,1056,53,1152,37.3C1248,21,1344,11,1392,5.3L1440,0L1440,150L1392,150C1344,150,1248,150,1152,150C1056,150,960,150,864,150C768,150,672,150,576,150C480,150,384,150,288,150C192,150,96,150,48,150L0,150Z"></path>
  </svg>
</section>

<!-- Kerjasama dengan PLN -->
<section class="py-5" data-aos="fade-up" data-aos-delay="100">
  <div class="container">
    <h2 class="mb-4 text-center fw-bold">Kerjasama dengan PLN</h2>
    <p class="text-center fs-5 mb-5 text-secondary">
      Kami berkomitmen mendukung pelatihan teknis di sektor ketenagalistrikan bersama PLN dengan menghadirkan media pembelajaran berbasis web interaktif.
      Solusi ini mempermudah peserta pelatihan memahami prosedur pemasangan dan penggunaan meteran listrik secara praktis, efektif, dan efisien.
    </p>

    <div class="row justify-content-center align-items-center">
      <div class="col-md-5 mb-3 mb-md-0 text-center">
        <img src="img/Logo_PLN.png" alt="Logo PLN" class="img-fluid shadow rounded" style="max-height:120px; filter: drop-shadow(0 0 0.75rem #0091ea);" />
      </div>
      <div class="col-md-5 text-center">
        <img src="img/citacontrac.png" alt="Logo Partner" class="img-fluid shadow rounded" style="max-height:120px; filter: drop-shadow(0 0 0.75rem #0077c2);" />
      </div>
    </div>
  </div>
</section>

<!-- Demo Video Simulasi -->
<section class="py-5 bg-light" data-aos="zoom-in" data-aos-delay="200">
  <div class="container text-center">
    <h2 class="mb-4 fw-bold">Demo Simulasi</h2>
    <div class="ratio ratio-16x9 mx-auto" style="max-width:900px;">
      <video controls preload="metadata" style="border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
        <source src="videos/simulasi-demo.mp4" type="video/mp4" />
        Browser Anda tidak mendukung video.
      </video>
    </div>
  </div>
</section>

<!-- Fitur Media Pembelajaran -->
<section class="py-5" data-aos="fade-up" data-aos-delay="300">
  <div class="container">
    <h2 class="mb-4 text-center fw-bold">Keunggulan Media Pembelajaran Kami</h2>
    <div class="row text-center gy-4">
      <?php
      $features = [
        ['icon'=>'bi-collection-play', 'title'=>'Interaktif & Praktis', 'desc'=>'Simulasi langkah demi langkah untuk pemahaman optimal.'],
        ['icon'=>'bi-phone-landscape', 'title'=>'Mudah Diakses', 'desc'=>'Kapan saja dan di mana saja, tanpa instalasi.'],
        ['icon'=>'bi-bar-chart-line', 'title'=>'Evaluasi & Monitoring', 'desc'=>'Sistem evaluasi otomatis tingkatkan kompetensi.']
      ];
      foreach($features as $feature): ?>
      <div class="col-md-4">
        <div class="p-4 border rounded shadow-sm h-100 hover-shadow d-flex flex-column align-items-center justify-content-center">
          <i class="bi <?= $feature['icon'] ?> fs-1 text-primary mb-3 feature-icon"></i>
          <h5 class="fw-semibold"><?= $feature['title'] ?></h5>
          <p><?= $feature['desc'] ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="py-5" style="background: linear-gradient(135deg, #0077c2, #004aad); color: #fff;">
  <div class="container text-center">
    <h3 class="fw-bold mb-3">Siap meningkatkan kemampuan teknis Anda?</h3>
    <a href="simulasi.php" class="btn btn-light btn-lg px-5 py-3 shadow-lg hover-scale ripple-effect" aria-label="Mulai Simulasi Sekarang">
      Mulai Simulasi Sekarang
    </a>
  </div>
</section>

<!-- Bootstrap JS + Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
      once: true,
      duration: 800,
      easing: 'ease-in-out'
    });
  });
</script>

</body>
</html>
