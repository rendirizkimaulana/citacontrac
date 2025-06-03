<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  header("Location: index.html");
  exit;
}

$conn = new mysqli("localhost", "root", "", "citacontrac");

// Tambah soal baru
$alert = "";
if (isset($_POST['tambah'])) {
  $soal = $conn->real_escape_string($_POST['soal']);
  $a = $conn->real_escape_string($_POST['a']);
  $b = $conn->real_escape_string($_POST['b']);
  $c = $conn->real_escape_string($_POST['c']);
  $d = $conn->real_escape_string($_POST['d']);
  $jawaban = $conn->real_escape_string($_POST['jawaban']);

  if ($conn->query("INSERT INTO evaluasi (soal, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban)
                    VALUES ('$soal', '$a', '$b', '$c', '$d', '$jawaban')")) {
    $alert = "<div class='alert alert-success'>Soal berhasil ditambahkan.</div>";
  } else {
    $alert = "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
  }
}

// Hapus soal
if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  $conn->query("DELETE FROM evaluasi WHERE id=$id");
}

$soalList = $conn->query("SELECT * FROM evaluasi ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Evaluasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="text-primary mb-4">Kelola Evaluasi</h2>

  <?= $alert ?>

  <form method="post" class="mb-5">
    <div class="mb-3">
      <label for="soal" class="form-label">Pertanyaan:</label>
      <textarea name="soal" id="soal" class="form-control" required rows="3"></textarea>
    </div>

    <div class="row mb-3">
      <div class="col-md-3">
        <label class="form-label">A</label>
        <input type="text" name="a" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">B</label>
        <input type="text" name="b" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">C</label>
        <input type="text" name="c" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">D</label>
        <input type="text" name="d" class="form-control" required>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Jawaban Benar:</label>
      <select name="jawaban" class="form-select" required>
        <option value="">Pilih</option>
        <option value="a">A</option>
        <option value="b">B</option>
        <option value="c">C</option>
        <option value="d">D</option>
      </select>
    </div>

    <button type="submit" name="tambah" class="btn btn-success">Tambah Soal</button>
  </form>

  <hr>

  <h4 class="mb-3">Daftar Soal</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-light">
        <tr>
          <th width="30%">Soal</th>
          <th>A</th>
          <th>B</th>
          <th>C</th>
          <th>D</th>
          <th>Jawaban</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $soalList->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['soal']) ?></td>
            <td><?= htmlspecialchars($row['pilihan_a']) ?></td>
            <td><?= htmlspecialchars($row['pilihan_b']) ?></td>
            <td><?= htmlspecialchars($row['pilihan_c']) ?></td>
            <td><?= htmlspecialchars($row['pilihan_d']) ?></td>
            <td><strong><?= strtoupper(htmlspecialchars($row['jawaban'])) ?></strong></td>
            <td>
              <a href="edit_evaluasi.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus soal ini?')" class="btn btn-sm btn-danger">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <a href="beranda.php" class="btn btn-secondary mt-4">← Kembali ke Beranda</a>
</div>

</body>
</html>
