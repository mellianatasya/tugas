<?php include 'header.php'; ?>
<?php include 'koneksi.php'; ?>


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
    <h2 class="text-center kelas-header">➕ Tambah Kelas</h2>
   
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control shadow-sm" id="nama_kelas" name="nama_kelas" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="kelola_kelas.php" class="btn btn-secondary btn-custom shadow"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" name="simpan" class="btn btn-success btn-custom shadow"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>


<?php
if (isset($_POST['simpan'])) {
    $nama_kelas = $_POST['nama_kelas'];


    // Pastikan koneksi sudah benar, menggunakan mysqli_query
    $query = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Kelas berhasil ditambahkan!');
                window.location.href = 'kelola_kelas.php';
              </script>";
    } else {
        echo "<script>alert('Gagal menambahkan kelas!');</script>";
    }
}
?>
