<?php 
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];
    // Query untuk menghapus data siswa berdasarkan ID
    $query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='index.php';</script>";
    }
}
?>
