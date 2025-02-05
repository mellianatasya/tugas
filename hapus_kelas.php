<?php 

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];

    // Query untuk menghapus kelas berdasarkan id_kelas
    $query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Kelas berhasil dihapus!');
                window.location.href = 'kelola_kelas.php';
              </script>";
    } else {
        echo "<script>alert('Gagal menghapus kelas!'); window.location.href = 'kelola_kelas.php';</script>";
    }
} else {
    echo "<script>alert('ID kelas tidak ditemukan!'); window.location.href = 'kelola_kelas.php';</script>";
}
?>

