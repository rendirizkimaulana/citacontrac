<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  header("Location: index.html");
  exit;
}

$conn = new mysqli("localhost", "root", "", "citacontrac");

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM evaluasi WHERE id=$id")->fetch_assoc();

if (isset($_POST['simpan'])) {
  $soal = $_POST['soal'];
  $a = $_POST['a'];
  $b = $_POST['b'];
  $c = $_POST['c'];
  $d = $_POST['d'];
  $jawaban = $_POST['jawaban'];

  $conn->query("UPDATE evaluasi SET
    soal='$soal',
    pilihan_a='$a',
    pilihan_b='$b',
    pilihan_c='$c',
    pilihan_d='$d',
    jawaban='$jawaban'
    WHERE id=$id");

  header("Location: kelola_evaluasi.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Soal Evaluasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="text-primary mb-4">Edit Soal Evaluasi</h2>

    <form method="post" class="mb-5">
      <div class="mb-3">
        <label for="soal" class="form-label">Pertanyaan:</label>
        <textarea name="soal" id="soal" class="form-control" required rows="3"><?= htmlspecialchars($data['soal']) ?></textarea>
      </div>

      <div class="row mb-3">
        <div class="col-md-3">
          <label class="form-label">A</label>
          <input type="text" name="a" class="form-control" required value="<?= htmlspecialchars($data['pilihan_a']) ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">B</label>
          <input type="text" name="b" class="form-control" required value="<?= htmlspecialchars($data['pilihan_b']) ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">C</label>
          <input type="text" name="c" class="form-control" required value="<?= htmlspecialchars($data['pilihan_c']) ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">D</label>
          <input type="text" name="d" class="form-control" required value="<?= htmlspecialchars($data['pilihan_d']) ?>">
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Jawaban Benar:</label>
        <select name="jawaban" class="form-select" required>
          <option value="">Pilih</option>
          <option value="A" <?= $data['jawaban'] == 'A' ? 'selected' : '' ?>>A</option>
          <option value="B" <?= $data['jawaban'] == 'B' ? 'selected' : '' ?>>B</option>
          <option value="C" <?= $data['jawaban'] == 'C' ? 'selected' : '' ?>>C</option>
          <option value="D" <?= $data['jawaban'] == 'D' ? 'selected' : '' ?>>D</option>
        </select>
      </div>

      <div class="d-flex justify-content-between">
        <a href="kelola_evaluasi.php" class="btn btn-secondary">← Kembali</a>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</body>
</html>
