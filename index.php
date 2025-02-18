<?php include 'header.php'; ?>
<?php include 'koneksi.php'; ?>


<div class="container mt-4 kelas-container">
    <h2 class="text-center kelas-header text-primary">Data Siswa</h2>


    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="kelola_kelas.php" class="btn text-white shadow" style="background-color: #28a745;">Kelola Kelas</a>
            <a href="kelola_wali.php" class="btn text-white shadow" style="background-color: #28a745;">Kelola Wali Murid</a>
        </div>
        <a href="tambah.php" class="btn text-white shadow" style="background-color: #28a745;">Tambah Siswa</a>
    </div>


    <table class="table table-striped table-bordered kelas-tabel shadow-sm">
        <thead class="bg-primary text-white">
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Kelas</th>
                <th>Wali Murid</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Query untuk mengambil data siswa
        $result = mysqli_query($koneksi, "SELECT * FROM siswa");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?= $row['nis'] ?></td>
                <td><?= $row['nama_siswa'] ?></td>
                <td><?= $row['tempat_lahir'] ?></td>
                <td><?= $row['tanggal_lahir'] ?></td>
                <td><?= $row['id_kelas'] ?></td>
                <td><?= $row['id_wali'] ?></td>
                <td><?= ($row['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan' ?></td>
                <td>
                    <a href="edit.php?nis=<?= $row['nis'] ?>" class="btn btn-sm text-white shadow" style="background-color: #fd7e14;">Edit</a>
                    <a href="hapus.php?nis=<?= $row['nis'] ?>" class="btn btn-sm text-white shadow" style="background-color: #dc3545;" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8' class='text-center'>Tidak ada data siswa</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>