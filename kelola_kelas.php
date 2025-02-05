<?php include 'header.php'; ?>
<?php include 'koneksi.php'; ?>

<style>
    .kelas-container {
        max-width: 900px;
        margin: auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    }
    .kelas-header {
        font-size: 2rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 20px;
        text-align: center;
    }
    .kelas-tabel {
        border-radius: 8px;
        overflow: hidden;
    }
    .kelas-tabel thead {
        background: #3498db;
        color: white;
    }
    .kelas-tabel tbody tr:hover {
        background: #ecf0f1;
    }
    .kelas-tabel tbody tr {
        transition: background 0.3s ease;
    }
    .btn-custom {
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
    .btn-success {
        background-color: #27ae60;
        border-color: #27ae60;
    }
    .btn-success:hover {
        background-color: #229954;
    }
    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }
    .btn-danger:hover {
        background-color: #c0392b;
    }
    .btn-secondary {
        background-color: #95a5a6;
        border-color: #95a5a6;
    }
    .btn-secondary:hover {
        background-color: #7f8c8d;
    }
    .search-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .search-container input {
        width: 80%;
        padding: 8px 15px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    .search-container button {
        margin-left: 10px;
    }
</style>

<div class="container mt-5 kelas-container">
    <h2 class="kelas-header">🏫 Kelola Kelas</h2>

    <div class="search-container">
        <a href="tambah_kelas.php" class="btn btn-success btn-custom shadow"><i class="fas fa-plus"></i> Tambah Kelas</a>
        <form method="GET" class="d-flex">
            <input type="text" name="cari" class="form-control shadow-sm" placeholder="🔍 Cari Kelas..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
            <button type="submit" class="btn btn-primary btn-custom shadow"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <table class="table table-striped table-bordered kelas-tabel shadow-sm">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Cek apakah ada pencarian
        $where = "";
        if (isset($_GET['cari']) && $_GET['cari'] != "") {
            $cari = $_GET['cari'];
            $where = "WHERE nama_kelas LIKE '%$cari%'";
        }

        // Query untuk mengambil data kelas
        $result = mysqli_query($koneksi, "SELECT * FROM kelas $where");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?= $row['nama_kelas'] ?></td>
                <td>
                    <a href="edit_kelas.php?id=<?= $row['id_kelas'] ?>" class="btn btn-warning btn-sm btn-custom shadow"><i class="fas fa-edit"></i> Edit</a>
                    <a href="hapus_kelas.php?id=<?= $row['id_kelas'] ?>" class="btn btn-danger btn-sm btn-custom shadow" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i> Hapus</a>
                </td>
            </tr>
        <?php 
            }
        } else {
            echo "<tr><td colspan='2' class='text-center text-muted'>🚫 Data tidak ditemukan</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary btn-custom shadow"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</div>


