<?php include 'header.php'; ?>
<?php include 'koneksi.php'; ?>

<?php
// Cek apakah ada parameter 'id' di URL
if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];

    // Ambil data kelas berdasarkan id_kelas
    $query = "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'";
    $result = mysqli_query($koneksi, $query);
    $kelas = mysqli_fetch_assoc($result);

    // Jika kelas tidak ditemukan
    if (!$kelas) {
        echo "<script>alert('Kelas tidak ditemukan!'); window.location.href = 'kelola_kelas.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID kelas tidak ditemukan!'); window.location.href = 'kelola_kelas.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama_kelas = $_POST['nama_kelas'];

    // Query untuk update data kelas
    $update_query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id_kelas = '$id_kelas'";

    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>
                alert('Kelas berhasil diperbarui!');
                window.location.href = 'kelola_kelas.php';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui kelas!');</script>";
    }
}
?>

<style>
    .kelas-container {
        max-width: 600px;
        margin: auto;
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .kelas-header {
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 20px;
    }
    .btn-custom {
        border-radius: 8px;
        font-weight: bold;
    }
    .btn-success {
        background-color: #27ae60;
        border-color: #27ae60;
    }
    .btn-success:hover {
        background-color: #229954;
    }
    .btn-secondary {
        background-color: #95a5a6;
        border-color: #95a5a6;
    }
    .btn-secondary:hover {
        background-color: #7f8c8d;
    }
</style>

<div class="container mt-5 kelas-container">
    <h2 class="text-center kelas-header">🏫 Edit Kelas</h2>
    
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control shadow-sm" id="nama_kelas" name="nama_kelas" value="<?= $kelas['nama_kelas'] ?>" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="kelola_kelas.php" class="btn btn-secondary btn-custom shadow"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" name="update" class="btn btn-success btn-custom shadow"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>


