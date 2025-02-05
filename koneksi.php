<?php
$host = "localhost"; // Sesuaikan dengan host server database
$user = "root";      // Sesuaikan dengan username MySQL
$pass = "";          // Sesuaikan dengan password MySQL
$db   = "sekolah";   // Nama database yang digunakan

// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
