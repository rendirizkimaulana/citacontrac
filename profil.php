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
    <title>Profil Saya - PT.Citacontrac & PLN</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- AOS Animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

    <style>
        /* Salin semua style dari halaman beranda agar konsisten */
        .text-shadow-lg {
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
        }

        .text-shadow-md {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
        }

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

        .feature-icon {
            transition: color 0.3s ease, transform 0.3s ease;
            cursor: default;
        }

        .feature-icon:hover {
            color: #0056b3;
            transform: scale(1.2);
        }

        .hover-shadow:hover {
            box-shadow: 0 0 25px rgba(0, 145, 234, 0.7);
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.07);
            transition: transform 0.3s ease;
        }

        /* Navbar specific */
        nav.navbar {
            margin-bottom: 1.5rem;
        }

    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="beranda.php">PT.Citacontrac</a>
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
                            <li><a class="dropdown-item active" href="profil.php">Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Profil Content -->
    <main class="container py-4" data-aos="fade-up">
        <h1 class="mb-4 text-primary">Profil Saya</h1>

        <div class="card shadow-sm p-4">
            <h4>Username:</h4>
            <p><?= $username ?></p>

            <h4>Role:</h4>
            <p><?= ucfirst($role) ?></p>

            <!-- Tambahkan info profil lain jika ada -->
            <h4>Email:</h4>
            <p>user@example.com (contoh placeholder)</p>

            <h4>Deskripsi:</h4>
            <p>Ini adalah halaman profil pengguna. Anda dapat menambahkan data lebih lengkap sesuai kebutuhan.</p>
        </div>
    </main>

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
