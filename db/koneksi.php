<?php
$servername = "localhost";
$username = "root";       // Ganti dengan username MySQL kamu
$password = "";           // Ganti dengan password MySQL kamu
$dbname = "citacontrac";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>
