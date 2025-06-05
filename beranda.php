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
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
        }

        .text-shadow-md {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
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

        /* Responsive adjustments for Hero Section */
        @media (max-width: 767.98px) {
            .hero-section .container {
                flex-direction: column !important;
                text-align: center;
                gap: 1.5rem !important;
            }

            .hero-section h1.display-4 {
                font-size: 2rem !important;
                line-height: 1.2;
                margin: 0;
            }

            .hero-section img {
                max-height: 60px !important;
                filter: drop-shadow(0 0 0.5rem #0091ea);
            }

            .btn.btn-light.btn-lg {
                font-size: 1.1rem;
                padding: 0.75rem 2rem;
                width: 100%;
                max-width: 320px;
                margin: 0 auto;
                display: block;
            }
        }

        /* Smaller text for paragraph in hero on mobile */
        @media (max-width: 767.98px) {
            .hero-section p.lead {
                font-size: 1rem !important;
                margin-bottom: 1.5rem;
            }
        }

        /* Adjust carousel images on mobile */
        @media (max-width: 575.98px) {
            #profilCarousel .carousel-item img {
                max-height: 250px !important;
            }
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
                    <?php if ($role === 'admin') : ?>
                        <li class="nav-item"><a class="nav-link" href="materi.php">Kelola Materi</a></li>
                        <li class="nav-item"><a class="nav-link" href="kelola_evaluasi.php">Kelola Evaluasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="lihat_hasil.php">Lihat Hasil</a></li>
                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link" href="materi.php">Materi</a></li>
                        <li class="nav-item"><a class="nav-link" href="simulasi.php">Simulasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="evaluasi.php">Evaluasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="hasil.php">Hasil</a></li>
                        <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang</a></li>
                    <?php endif; ?>
                </ul>

<div class="d-flex align-items-center text-white">
    <i class="bi bi-person-circle fs-4 me-2"></i>
    <div class="dropdown">
        <a class="text-white text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            <?= $username ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="profil.php">Profil Saya</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>

    </nav>

    <!-- Hero Section -->
    <section class="hero-section py-5">
        <div class="container position-relative d-flex justify-content-center align-items-center gap-4 flex-wrap"
            style="z-index: 2;">

            <!-- Logo PLN -->
            <img src="img/Logo_PLN.png" alt="Logo PLN" class="img-fluid" style="max-height: 80px; filter: drop-shadow(0 0 0.75rem #0091ea);"
                data-aos="fade-right" data-aos-delay="200" />

            <!-- Teks utama -->
            <h1 class="display-4 fw-bold text-shadow-lg m-0" data-aos="fade-down" data-aos-delay="400">
                Simulasi Meteran Listrik Interaktif
            </h1>

            <!-- Logo Citacontrac -->
            <img src="img/citacontrac.png" alt="Logo Citacontrac" class="img-fluid" style="max-height: 80px; filter: drop-shadow(0 0 0.75rem #0077c2);"
                data-aos="fade-left" data-aos-delay="200" />

        </div>

        <div class="container text-center mt-4" style="z-index: 2;">
            <p class="lead mb-4 text-shadow-md" data-aos="fade-up" data-aos-delay="600">
                Media pembelajaran inovatif hasil kerjasama dengan <strong>PLN</strong> untuk meningkatkan kompetensi teknis
                instalasi listrik.
            </p>
            <a href="simulasi.php"
                class="btn btn-light btn-lg shadow-lg px-4 py-3 ripple-effect animate__animated animate__pulse animate__infinite"
                aria-label="Mulai Simulasi Sekarang" data-aos="zoom-in" data-aos-delay="800" style="position: relative; z-index: 10;">
                Mulai Simulasi Sekarang
            </a>
        </div>

        <!-- SVG Wave Bottom -->
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 150" preserveAspectRatio="none">
            <path fill="#ffffff" fill-opacity="0.3"
                d="M0,64L48,85.3C96,107,192,149,288,149.3C384,149,480,107,576,90.7C672,75,768,85,864,80C960,75,1056,53,1152,37.3C1248,21,1344,11,1392,5.3L1440,0L1440,150L1392,150C1344,150,1248,150,1152,150C1056,150,960,150,864,150C768,150,672,150,576,150C480,150,384,150,288,150C192,150,96,150,48,150L0,150Z">
            </path>
        </svg>
    </section>

    <!-- Profil Perusahaan Slider Gambar -->
    <section class="py-5 bg-white" data-aos="fade-up" data-aos-delay="250">
        <div class="container">
            <h2 class="mb-4 text-center fw-bold">Profil Perusahaan</h2>
            <p class="text-center mb-5 text-secondary fs-5">
                PT Citacontrac telah berpengalaman lebih dari 10 tahun dalam bidang instalasi listrik dan pengadaan alat kelistrikan.
                Kami selalu mengutamakan kualitas, keamanan, dan inovasi dalam setiap layanan kami.
            </p>

            <div id="profilCarousel" class="carousel slide shadow rounded" data-bs-ride="carousel" data-bs-interval="4000"
                style="max-width: 800px; margin: 0 auto;">
                <div class="carousel-inner rounded">
                    <div class="carousel-item active">
                        <img src="img/tentang1.png" class="d-block w-100" alt="Proyek Instalasi Listrik 1"
                            style="max-height: 400px; object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="img/tentang2.png" class="d-block w-100" alt="Proyek Instalasi Listrik 2"
                            style="max-height: 400px; object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="img/tentang3.jpeg" class="d-block w-100" alt="Tim Profesional"
                            style="max-height: 400px; object-fit: cover;">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#profilCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Sebelumnya</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#profilCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Berikutnya</span>
                </button>
            </div>
        </div>
    </section>

<!-- Kerjasama dengan PLN - Carousel Kotak Ukuran Fitur Utama -->
<section class="py-5" data-aos="fade-up" data-aos-delay="100">
  <div class="container">
    <h2 class="mb-4 text-center fw-bold">Kerjasama dengan PLN</h2>
    <p class="text-center fs-5 mb-5 text-secondary">
      Kami berkomitmen mendukung pelatihan teknis di sektor ketenagalistrikan bersama PLN dengan menghadirkan media
      pembelajaran berbasis web interaktif. Solusi ini mempermudah peserta pelatihan memahami prosedur pemasangan
      dan penggunaan meteran listrik secara praktis, efektif, dan efisien.
    </p>

    <div id="plnCarousel" class="carousel slide" data-bs-ride="carousel" style="max-width: 1000px; margin: auto;">
      <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="d-flex justify-content-center gap-4 flex-wrap">
            <div class="card shadow-sm" style="width: 200px; border-radius: 12px; overflow: hidden;">
              <img src="img/tentang1.png" class="card-img-top" alt="Kerjasama 1" style="height: 140px; object-fit: cover;">
            </div>
            <div class="card shadow-sm" style="width: 200px; border-radius: 12px; overflow: hidden;">
              <img src="img/tentang1.png" class="card-img-top" alt="Kerjasama 2" style="height: 140px; object-fit: cover;">
            </div>
            <div class="card shadow-sm" style="width: 200px; border-radius: 12px; overflow: hidden;">
              <img src="img/tentang1.png" class="card-img-top" alt="Kerjasama 2" style="height: 140px; object-fit: cover;">
            </div>
            <div class="card shadow-sm" style="width: 200px; border-radius: 12px; overflow: hidden;">
              <img src="img/tentang1.png" class="card-img-top" alt="Kerjasama 3" style="height: 140px; object-fit: cover;">
            </div>
          </div>
        </div>

        <!-- Slide 2 (opsional, bisa diduplikasi jika gambar lain tersedia) -->
        <div class="carousel-item">
          <div class="d-flex justify-content-center gap-4 flex-wrap">
            <div class="card shadow-sm" style="width: 200px; border-radius: 12px; overflow: hidden;">
              <img src="img/tentang1.png" class="card-img-top" alt="Kerjasama 4" style="height: 140px; object-fit: cover;">
            </div>
            <div class="card shadow-sm" style="width: 200px; border-radius: 12px; overflow: hidden;">
              <img src="img/tentang1.png" class="card-img-top" alt="Kerjasama 5" style="height: 140px; object-fit: cover;">
            </div>
            <div class="card shadow-sm" style="width: 200px; border-radius: 12px; overflow: hidden;">
              <img src="img/tentang1.png" class="card-img-top" alt="Kerjasama 5" style="height: 140px; object-fit: cover;">
            </div>
            <div class="card shadow-sm" style="width: 200px; border-radius: 12px; overflow: hidden;">
              <img src="img/tentang1.png" class="card-img-top" alt="Kerjasama 6" style="height: 140px; object-fit: cover;">
            </div>
          </div>
        </div>

      </div>

      <!-- Kontrol Carousel -->
      <button class="carousel-control-prev" type="button" data-bs-target="#plnCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Sebelumnya</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#plnCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Berikutnya</span>
      </button>
    </div>
  </div>
</section>


    <!-- Demo Video Simulasi -->
    <section class="py-5 bg-light" data-aos="zoom-in" data-aos-delay="200">
        <div class="container text-center">
            <h2 class="mb-4 fw-bold">Cegah Kebakaran dengan Peduli Instalasi Listrik di Rumah</h2>
            <div class="ratio ratio-16x9 mx-auto" style="max-width:900px;">
                <video controls preload="metadata" style="border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.3);">
                    <source src="video/simulasi_pemasangan_meteran.mp4" type="video/mp4" />
                    Browser Anda tidak mendukung video HTML5.
                </video>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold" data-aos="fade-up" data-aos-delay="300">Fitur Utama</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center hover-shadow">
                        <i class="bi bi-journal-text fs-1 mb-3 feature-icon"></i>
                        <h5 class="fw-bold">Materi Pembelajaran</h5>
                        <p class="text-secondary mt-2">Modul materi lengkap tentang pemasangan dan penggunaan meteran listrik dengan materi yang mudah dipahami.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center hover-shadow">
                        <i class="bi bi-person-video3 fs-1 mb-3 feature-icon"></i>
                        <h5 class="fw-bold">Simulasi Interaktif</h5>
                        <p class="text-secondary mt-2">Pengalaman simulasi pemasangan meteran yang mendekati situasi nyata melalui antarmuka yang mudah digunakan.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm p-4 text-center hover-shadow">
                        <i class="bi bi-bar-chart-line fs-1 mb-3 feature-icon"></i>
                        <h5 class="fw-bold">Evaluasi dan Hasil</h5>
                        <p class="text-secondary mt-2">Evaluasi pemahaman secara berkala dan laporan hasil yang bisa diakses kapan saja oleh peserta dan admin.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary text-white py-4 mt-auto">
        <div class="container text-center small">
            &copy; 2025 PT Citacontrac. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap Bundle JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init();
    </script>
</body>

</html>
