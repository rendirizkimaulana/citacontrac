<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.html");
  exit;
}

$username = htmlspecialchars($_SESSION['username']);
$role = $_SESSION['role'];

$conn = new mysqli("localhost", "root", "", "citacontrac");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Proses submit jawaban
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $score = 0;

  $result = $conn->query("SELECT * FROM evaluasi ORDER BY id ASC");
  while ($row = $result->fetch_assoc()) {
    $qid = $row['id'];
    $jawaban_benar = $row['jawaban'];

    if (isset($_POST["q$qid"]) && strtolower($_POST["q$qid"]) == strtolower($jawaban_benar)) {
      $score++;
    }
  }

  $_SESSION['score'] = $score;

  // Simpan ke database hasil_evaluasi
  $stmt = $conn->prepare("INSERT INTO hasil_evaluasi (username, nilai) VALUES (?, ?)");
  $stmt->bind_param("si", $username, $score);
  $stmt->execute();
  $stmt->close();

  $conn->close();

  header("Location: hasil.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Evaluasi Pemasangan Meteran - PT Citacontrac</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- AOS Animation -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <style>
    /* Flexbox Layout agar footer selalu di bawah */
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

    /* Navbar */
    .navbar-brand {
      font-weight: 700;
    }

    /* Card styling untuk form */
    .card {
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      background: white;
      padding: 2rem;
    }

    /* Judul */
    h2 {
      color: #0d6efd;
      text-align: center;
      margin-bottom: 2rem;
      text-shadow: 1px 1px 3px rgba(13, 110, 253, 0.3);
    }

    /* Form styling */
    .form-check-label {
      cursor: pointer;
      font-weight: 500;
      user-select: none;
    }

    .form-check-input:checked + .form-check-label {
      color: #0d6efd;
      font-weight: 700;
    }

    hr {
      border-top: 1px solid #dee2e6;
      margin: 1.5rem 0;
    }

    button.btn-primary {
      width: 100%;
      font-size: 1.1rem;
      font-weight: 600;
      padding: 0.7rem;
      background: linear-gradient(45deg, #0d6efd, #3a8dff);
      border: none;
      transition: background 0.3s ease;
      box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    button.btn-primary:hover {
      background: linear-gradient(45deg, #3a8dff, #0d6efd);
      box-shadow: 0 6px 18px rgba(13, 110, 253, 0.5);
    }

    a.btn-secondary {
      display: block;
      width: 100%;
      margin-top: 1rem;
      font-weight: 600;
      padding: 0.6rem;
      text-align: center;
    }

    /* Styling pilihan jawaban card */
    .form-check {
      transition: all 0.3s ease;
    }

    .form-check:hover {
      background-color: #eaf1ff;
      transform: scale(1.02);
      box-shadow: 0 0 8px rgba(0, 123, 255, 0.15);
    }

    .form-check-input:checked + .form-check-label {
      color: #0d6efd;
      font-weight: bold;
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
            <li class="nav-item"><a class="nav-link active" href="evaluasi.php">Evaluasi</a></li>
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

  <main class="content container mt-5 mb-5" style="max-width:720px;">
    <div class="card shadow-sm" data-aos="fade-up" data-aos-delay="100">
      <h2>Evaluasi Pemasangan Meteran</h2>

      <form method="POST" novalidate>
        <?php
        $result = $conn->query("SELECT * FROM evaluasi ORDER BY id ASC");
        if ($result->num_rows == 0) {
          echo "<p class='text-center text-muted'>Tidak ada soal evaluasi.</p>";
        } else {
          $no = 1;
          while ($row = $result->fetch_assoc()) {
            echo "<div class='mb-5'>";
            echo "<h5 class='mb-3'><span class='badge bg-primary me-2'>$no.</span>" . htmlspecialchars($row['soal']) . "</h5>";

            $options = [
              'a' => $row['pilihan_a'],
              'b' => $row['pilihan_b'],
              'c' => $row['pilihan_c'],
              'd' => $row['pilihan_d']
            ];

            echo "<div class='row row-cols-1 row-cols-md-2 g-3'>";
            foreach ($options as $key => $val) {
              $inputId = "q" . $row['id'] . $key;
              echo "<div class='col'>";
              echo "<div class='form-check p-3 rounded border shadow-sm bg-light h-100'>";
              echo "<input class='form-check-input me-2' type='radio' name='q" . $row['id'] . "' id='$inputId' value='$key' required>";
              echo "<label class='form-check-label w-100' for='$inputId'><strong>" . strtoupper($key) . ".</strong> " . htmlspecialchars($val) . "</label>";
              echo "</div>";
              echo "</div>";
            }
            echo "</div>"; // End options row
            echo "</div><hr>";
            $no++;
          }
        }
        ?>
        <button type="submit" class="btn btn-primary mt-4" aria-label="Kirim Jawaban">
          <i class="bi bi-check-circle me-2"></i> Kirim Jawaban
        </button>
      </form>

      <a href="beranda.php" class="btn btn-secondary mt-3" aria-label="Kembali ke Beranda">
        <i class="bi bi-arrow-left-circle me-2"></i> Kembali ke Beranda
      </a>
    </div>
  </main>

  <!-- Bootstrap JS dan dependencies Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS Animation -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>
