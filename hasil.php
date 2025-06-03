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

$username = $_SESSION['username'];

$conn = new mysqli("localhost", "root", "", "citacontrac");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT nilai, tanggal FROM hasil_evaluasi WHERE username = ? ORDER BY tanggal DESC");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Riwayat Hasil Evaluasi - PT Citacontrac</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
      background: white;
      padding: 2rem;
    }
    table.table {
      margin-top: 1rem;
      font-size: 1rem;
    }
    table.table thead {
      background: #0d6efd;
      color: white;
      border-radius: 15px;
    }
    table.table th, table.table td {
      vertical-align: middle;
    }
    .btn-secondary {
      display: block;
      width: 100%;
      margin-top: 1.5rem;
      font-weight: 600;
      padding: 0.6rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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

<div class="container mt-5 mb-5">
  <div class="card shadow-sm">
    <h2>Riwayat Evaluasi - <?= htmlspecialchars($username) ?></h2>

    <?php if ($result->num_rows == 0): ?>
      <div class="alert alert-info" role="alert">
        <i class="bi bi-info-circle me-2"></i>Belum ada hasil evaluasi.
      </div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead>
            <tr>
              <th>Nilai</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['nilai']) ?>/2</td>
              <td><?= date("d M Y, H:i", strtotime($row['tanggal'])) ?></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

    <a href="beranda.php" class="btn btn-secondary" aria-label="Kembali ke Beranda">
      <i class="bi bi-arrow-left-circle me-2"></i> Kembali ke Beranda
    </a>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
