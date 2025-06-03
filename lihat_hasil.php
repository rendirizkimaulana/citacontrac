<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  header("Location: index.html");
  exit;
}

$conn = new mysqli("localhost", "root", "", "citacontrac");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$result = $conn->query("SELECT username, nilai, tanggal FROM hasil_evaluasi ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Evaluasi Pengguna</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="text-primary mb-4">Data Evaluasi Semua Pengguna</h2>

  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-light">
        <tr>
          <th>Username</th>
          <th>Nilai</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= htmlspecialchars($row['nilai']) ?>/2</td>
              <td><?= htmlspecialchars($row['tanggal']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="3" class="text-center text-muted">Belum ada data evaluasi dari user.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <a href="beranda.php" class="btn btn-secondary mt-3">← Kembali ke Beranda</a>
</div>

</body>
</html>
