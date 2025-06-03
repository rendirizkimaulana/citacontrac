<?php
session_start();
include 'db/koneksi.php';

if (!isset($_SESSION['username'])) {
  header("Location: index.html");
  exit;
}

$role = $_SESSION['role'];
$username = htmlspecialchars($_SESSION['username']);

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

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <style>
    html, body {
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
    /* Card styling */
    .card {
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 28px rgba(0,0,0,0.18);
    }
    h2 {
      color: #0d6efd;
      text-align: center;
      margin-bottom: 1rem;
      text-shadow: 1px 1px 3px rgba(13, 110, 253, 0.3);
    }
    .btn-primary {
      background: linear-gradient(45deg, #0056b3, #007bff);
      border: none;
      transition: background 0.3s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(45deg, #007bff, #0056b3);
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
      text-align: center;
    }
    .form-label {
      font-weight: 600;
      color: #004aad;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
  <div class="container">
    <a class="navbar-brand" href="beranda.php">PT.Citacontrac</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
      aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php if ($role === 'admin') : ?>
          <li class="nav-item"><a class="nav-link active" href="materi.php">Kelola Materi</a></li>
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
        <span class="me-3"><?= $username ?></span>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
      </div>
    </div>
  </div>
</nav>

<main class="content container mt-5 mb-5" style="max-width:900px;">
  <h2>Materi Pelatihan</h2>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <a href="beranda.php" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda
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
</main>


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
