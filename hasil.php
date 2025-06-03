<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.html");
  exit;
}

if ($_SESSION['role'] != 'user') {
  echo "<div class='container mt-5'><div class='alert alert-danger'>Halaman ini hanya untuk user.</div></div>";
  exit;
}

$username = htmlspecialchars($_SESSION['username']);
$role = $_SESSION['role'];

$conn = new mysqli("localhost", "root", "", "citacontrac");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT nilai, tanggal FROM hasil_evaluasi WHERE username = ? ORDER BY tanggal DESC");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$total_soal = 8; // Ubah sesuai jumlah soal sebenarnya

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Riwayat Hasil Evaluasi - PT Citacontrac</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
      background: #f0f4f8;
    }

    main.content {
      flex: 1 0 auto;
      padding-bottom: 2rem;
    }

    footer {
      flex-shrink: 0;
    }

    .navbar-brand {
      font-weight: 700;
    }

    h2 {
      color: #0d6efd;
      text-align: center;
      margin-bottom: 2rem;
      text-shadow: 1px 1px 3px rgba(13, 110, 253, 0.3);
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      background: white;
      padding: 1.5rem;
    }

    .result-item {
      border-bottom: 1px solid #eee;
      padding: 1rem 0;
    }

    .result-item:last-child {
      border-bottom: none;
    }

    .score {
      font-size: 1.1rem;
      font-weight: 600;
    }

    .correct {
      color: #198754; /* hijau */
      font-weight: 700;
    }

    .wrong {
      color: #dc3545; /* merah */
      font-weight: 700;
    }

    .btn-secondary {
      display: block;
      width: 100%;
      margin-top: 1.5rem;
      font-weight: 600;
      padding: 0.6rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: background 0.3s ease;
    }

    .btn-secondary:hover {
      background-color: #0b5ed7;
      color: white;
      box-shadow: 0 6px 18px rgba(13, 110, 253, 0.5);
    }

    .alert-info {
      font-size: 1.1rem;
      text-align: center;
      padding: 1rem;
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
            <li class="nav-item"><a class="nav-link active" href="hasil.php">Hasil</a></li>
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

  <main class="content container mt-5 mb-5" style="max-width:720px;">
    <div class="card shadow-sm" data-aos="fade-up" data-aos-delay="100">
      <h2>Riwayat Evaluasi - <?= $username ?></h2>

      <?php if ($result->num_rows == 0): ?>
        <div class="alert alert-info" role="alert">
          <i class="bi bi-info-circle me-2"></i>Belum ada hasil evaluasi.
        </div>
      <?php else: ?>
        <?php while ($row = $result->fetch_assoc()): 
          $benar = (int)$row['nilai'];
          $salah = $total_soal - $benar;
          $tanggal = date("d M Y, H:i", strtotime($row['tanggal']));
        ?>
          <div class="result-item d-flex justify-content-between align-items-center">
            <div>
              <div class="score">
                <i class="bi bi-check2-circle correct"></i> Benar: <span class="correct"><?= $benar ?></span>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <i class="bi bi-x-circle wrong"></i> Salah: <span class="wrong"><?= $salah ?></span>
              </div>
              <small class="text-muted"><i class="bi bi-calendar-event"></i> <?= $tanggal ?></small>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>

      <a href="evaluasi.php" class="btn btn-success mt-3" aria-label="Ulangi Kuis">
        <i class="bi bi-arrow-clockwise me-2"></i> Ulangi Kuis
      </a>
      <a href="beranda.php" class="btn btn-secondary" aria-label="Kembali ke Beranda">
        <i class="bi bi-arrow-left-circle me-2"></i> Kembali ke Beranda
      </a>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

</body>

</html>

<?php
$stmt->close();
$conn->close();
?>

