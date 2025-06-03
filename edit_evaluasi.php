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

<h2>Edit Soal Evaluasi</h2>

<form method="post">
  <textarea name="soal" rows="3" cols="60" required><?= htmlspecialchars($data['soal']) ?></textarea><br>
  A. <input type="text" name="a" value="<?= $data['pilihan_a'] ?>" required><br>
  B. <input type="text" name="b" value="<?= $data['pilihan_b'] ?>" required><br>
  C. <input type="text" name="c" value="<?= $data['pilihan_c'] ?>" required><br>
  D. <input type="text" name="d" value="<?= $data['pilihan_d'] ?>" required><br>
  Jawaban:
  <select name="jawaban" required>
    <option value="A" <?= $data['jawaban'] == 'A' ? 'selected' : '' ?>>A</option>
    <option value="B" <?= $data['jawaban'] == 'B' ? 'selected' : '' ?>>B</option>
    <option value="C" <?= $data['jawaban'] == 'C' ? 'selected' : '' ?>>C</option>
    <option value="D" <?= $data['jawaban'] == 'D' ? 'selected' : '' ?>>D</option>
  </select><br><br>
  <button type="submit" name="simpan">Simpan Perubahan</button>
</form>

<br><a href="kelola_evaluasi.php">Kembali</a>
