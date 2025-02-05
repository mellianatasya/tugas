<?php 
include 'header.php'; 
include 'koneksi.php'; 
?>

<style>
    .form-container {
        max-width: 600px;
        margin: auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    }
    .form-header {
        font-size: 1.8rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-control {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    .btn-custom {
        width: 100%;
        border-radius: 8px;
        font-weight: bold;
        transition: transform 0.2s ease-in-out;
    }
    .btn-custom:hover {
        transform: scale(1.05);
    }
    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
    }
    .btn-primary:hover {
        background-color: #2980b9;
    }
    .btn-secondary {
        background-color: #95a5a6;
        border-color: #95a5a6;
    }
    .btn-secondary:hover {
        background-color: #7f8c8d;
    }
</style>

<div class="container mt-5 form-container">
    <h2 class="form-header">👨‍👩‍👧‍👦 Tambah Wali Murid</h2>

    <form method="POST" action="tambah_wali_murid.php">
        <div class="form-group">
            <label for="nama_wali">Nama Wali Murid</label>
            <input type="text" id="nama_wali" name="nama_wali" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kontak">Kontak Wali Murid</label>
            <input type="text" id="kontak" name="kontak" class="form-control" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary btn-custom">Simpan</button>
        <a href="kelola_wali.php" class="btn btn-secondary btn-custom mt-3">Kembali</a>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // Mengambil input dari form
        $nama_wali = mysqli_real_escape_string($koneksi, $_POST['nama_wali']);
        $kontak = mysqli_real_escape_string($koneksi, $_POST['kontak']);

        // Validasi input tidak boleh kosong
        if (empty($nama_wali) || empty($kontak)) {
            echo "<script>alert('Nama dan Kontak Wali Murid harus diisi!');</script>";
        } else {
            // Query untuk menambahkan data wali murid
            $query = "INSERT INTO wali_murid (nama_wali, kontak) VALUES (?, ?)";
            if ($stmt = mysqli_prepare($koneksi, $query)) {
                mysqli_stmt_bind_param($stmt, "ss", $nama_wali, $kontak);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>alert('Data wali murid berhasil ditambahkan!'); window.location='kelola_wali.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan data wali murid! Error: " . mysqli_error($koneksi) . "');</script>";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('Terjadi kesalahan saat mempersiapkan query!');</script>";
            }
        }
    }
    ?>
</div>


