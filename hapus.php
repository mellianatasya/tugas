<?php 
include 'koneksi.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    // Query untuk menghapus data siswa berdasarkan NIS
    $query = "DELETE FROM siswa WHERE nis = '$nis'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data! " . mysqli_error($koneksi) . "'); window.location='index.php';</script>";
    }
}
?>
