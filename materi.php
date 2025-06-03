<?php
session_start();
include 'db/koneksi.php';

if (!isset($_SESSION['username'])) {
  header("Location: index.html");
  exit;
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];

if ($role === 'admin' && isset($_POST['tambah'])) {
  $judul = mysqli_real_escape_string($conn, $_POST['judul']);
  $isi   = mysqli_real_escape_string($conn, $_POST['isi']);
  mysqli_query($conn, "INSERT INTO materi (judul, isi) VALUES ('$judul', '$isi')");
  header("Location: materi.php"); // refresh agar form tidak double submit
  exit;
}

if ($role === 'admin' && isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  mysqli_query($conn, "DELETE FROM materi WHERE id=$id");
  header("Location: materi.php");
  exit;
}

$result = mysqli_query($conn, "SELECT * FROM materi ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Materi Pelatihan - PT Citacontrac</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- AOS Animation -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  
  <style>
    body {
      background: #f8f9fa;
      min-height: 100vh;
    }
    h2 {
      color: #004aad;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }
    .btn-primary {
      background: linear-gradient(45deg, #0056b3, #007bff);
      border: none;
      transition: background 0.3s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(45deg, #007bff, #0056b3);
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 28px rgba(0,0,0,0.18);
    }
    textarea.form-control {
      resize: vertical;
    }
    a.btn-danger {
      transition: background-color 0.3s ease;
    }
    a.btn-danger:hover {
      background-color: #b02a37;
      border-color: #b02a37;
    }
    .welcome-text {
      color: #333;
      margin-bottom: 1rem;
    }
    .form-label {
      font-weight: 600;
      color: #004aad;
    }
  </style>
</head>
<body>

<div class="container mt-5 mb-5">
  <h2 class="mb-4 text-center">Materi Pelatihan</h2>
  <p class="welcome-text text-center">Selamat datang, <strong><?= htmlspecialchars($username) ?></strong> (<?= htmlspecialchars($role) ?>)</p>
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <a href="beranda.php" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda
    </a>
    <a href="logout.php" class="btn btn-outline-danger">
      <i class="bi bi-box-arrow-right"></i> Logout
    </a>
  </div>

  <?php if ($role === 'admin'): ?>
  <div class="card mb-5 shadow-sm" data-aos="fade-up">
    <div class="card-body">
      <h5 class="card-title text-primary mb-3">Tambah Materi Baru</h5>
      <form method="POST" autocomplete="off">
        <div class="mb-3">
          <label for="judul" class="form-label">Judul Materi</label>
          <input type="text" name="judul" id="judul" class="form-control" placeholder="Judul Materi" required>
        </div>
        <div class="mb-3">
          <label for="isi" class="form-label">Isi Materi</label>
          <textarea name="isi" id="isi" class="form-control" rows="6" placeholder="Isi materi..." required></textarea>
        </div>
        <button type="submit" name="tambah" class="btn btn-primary">
          <i class="bi bi-plus-circle"></i> Tambah Materi
        </button>
      </form>
    </div>
  </div>
  <?php endif; ?>

  <?php if (mysqli_num_rows($result) == 0): ?>
    <div class="alert alert-info text-center" data-aos="fade-in">
      <i class="bi bi-info-circle"></i> Belum ada materi yang tersedia.
    </div>
  <?php else: ?>
    <div class="row gy-4">
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="card h-100">
            <div class="card-body d-flex flex-column">
              <h4 class="card-title text-primary"><?= htmlspecialchars($row['judul']) ?></h4>
              <p class="card-text flex-grow-1"><?= nl2br(htmlspecialchars($row['isi'])) ?></p>
              <small class="text-muted">Dibuat: <?= htmlspecialchars($row['created_at']) ?></small>
              <?php if ($role === 'admin'): ?>
                <div class="mt-3 text-end">
                  <a href="materi.php?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                     onclick="return confirm('Hapus materi ini?')">
                    <i class="bi bi-trash"></i> Hapus
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>

</div>

<!-- Bootstrap JS -->
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
