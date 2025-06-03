<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.html");
  exit;
}

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
  $username = $_SESSION['username'];
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
  
  <style>
    body {
      background: #f0f4f8;
      min-height: 100vh;
      padding-bottom: 3rem;
    }
    .container {
      max-width: 720px;
    }
    h2 {
      color: #0d6efd;
      text-align: center;
      margin-bottom: 2rem;
      text-shadow: 1px 1px 3px rgba(13, 110, 253, 0.3);
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      padding: 2rem;
      background: white;
    }
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
    }
  </style>
</head>
<body>

<div class="container mt-5 mb-5">
  <div class="card shadow-sm">
    <h2>Evaluasi Pemasangan Meteran</h2>

    <form method="POST" novalidate>
      <?php
      $result = $conn->query("SELECT * FROM evaluasi ORDER BY id ASC");
      if ($result->num_rows == 0) {
        echo "<p class='text-center text-muted'>Tidak ada soal evaluasi.</p>";
      } else {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='mb-4'>";
          echo "<p class='fw-semibold'>" . htmlspecialchars($row['soal']) . "</p>";

          $options = ['a' => $row['pilihan_a'], 'b' => $row['pilihan_b'], 'c' => $row['pilihan_c'], 'd' => $row['pilihan_d']];
          foreach ($options as $key => $val) {
            $inputId = "q" . $row['id'] . $key;
            echo "<div class='form-check'>";
            echo "<input class='form-check-input' type='radio' name='q" . $row['id'] . "' id='$inputId' value='$key' required>";
            echo "<label class='form-check-label' for='$inputId'>" . htmlspecialchars($val) . "</label>";
            echo "</div>";
          }
          echo "</div><hr>";
        }
      }
      ?>
      <button type="submit" class="btn btn-primary" aria-label="Kirim Jawaban">
        <i class="bi bi-check-circle me-2"></i> Kirim Jawaban
      </button>
    </form>

    <a href="beranda.php" class="btn btn-secondary mt-3" aria-label="Kembali ke Beranda">
      <i class="bi bi-arrow-left-circle me-2"></i> Kembali ke Beranda
    </a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
