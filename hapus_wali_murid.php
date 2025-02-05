<?php
include 'koneksi.php';

// Pastikan ada parameter ID yang dikirim
if (isset($_GET['id'])) {
    $id_wali = $_GET['id'];

    // Query untuk menghapus data wali berdasarkan ID
    $query = "DELETE FROM wali_murid WHERE id_wali = '$id_wali'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data wali murid berhasil dihapus!');
                window.location.href = 'kelola_wali.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data wali murid!');
                window.location.href = 'kelola_wali.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID wali murid tidak ditemukan!');
            window.location.href = 'kelola_wali.php';
          </script>";
}
?>
