<?php include 'header.php'; ?>
<?php include 'koneksi.php'; ?>

<?php
// Cek apakah ada parameter 'id' di URL
if (isset($_GET['id'])) {
    $id_wali = $_GET['id'];

    // Ambil data wali berdasarkan id_wali
    $query = "SELECT * FROM wali_murid WHERE id_wali = '$id_wali'";
    $result = mysqli_query($koneksi, $query);
    $wali = mysqli_fetch_assoc($result);

    // Jika wali tidak ditemukan
    if (!$wali) {
        echo "<script>alert('Wali murid tidak ditemukan!'); window.location.href = 'kelola_wali.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID wali tidak ditemukan!'); window.location.href = 'kelola_wali.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama_wali = mysqli_real_escape_string($koneksi, trim($_POST['nama_wali']));
    $kontak = mysqli_real_escape_string($koneksi, trim($_POST['kontak']));

    // Query untuk update data wali murid
    $update_query = "UPDATE wali_murid SET nama_wali = '$nama_wali', kontak = '$kontak' WHERE id_wali = '$id_wali'";

    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>
                alert('Data wali murid berhasil diperbarui!');
                window.location.href = 'kelola_wali.php';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui data wali murid!');</script>";
    }
}
?>

<style>
    .wali-container {
        max-width: 600px;
        margin: auto;
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .wali-header {
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

<div class="container mt-5 wali-container">
    <h2 class="text-center wali-header">👨‍👩‍👧‍👦 Edit Wali Murid</h2>
    
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama_wali" class="form-label">Nama Wali Murid</label>
            <input type="text" class="form-control shadow-sm" id="nama_wali" name="nama_wali" value="<?= htmlspecialchars($wali['nama_wali']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label">Telepon Wali Murid</label>
            <input type="text" class="form-control shadow-sm" id="kontak" name="kontak" value="<?= htmlspecialchars($wali['kontak']) ?>" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="kelola_wali.php" class="btn btn-secondary btn-custom shadow"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" name="update" class="btn btn-success btn-custom shadow"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>


