<?php
include 'header.php';
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = isset($_POST['id_kelas']) ? $_POST['id_kelas'] : null;
    $id_wali = isset($_POST['id_wali']) ? $_POST['id_wali'] : null;
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Cek apakah id_kelas dan id_wali kosong
    if (empty($id_kelas) || empty($id_wali)) {
        echo "<script>alert('Kelas dan Wali Murid harus dipilih!'); window.history.back();</script>";
        exit;
    }

    // Query untuk menambahkan data siswa
    $query = "INSERT INTO siswa (nis, nama_siswa, tempat_lahir, tanggal_lahir, id_kelas, id_wali, jenis_kelamin)
              VALUES ('$nis', '$nama_siswa', '$tempat_lahir', '$tanggal_lahir', '$id_kelas', '$id_wali', '$jenis_kelamin')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>


<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="width: 50rem; border-radius: 12px;">
        <h2 class="text-center mb-4 text-primary">Tambah Data Siswa</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nis" class="form-label fw-bold">NIS</label>
                <input type="text" class="form-control shadow-sm" id="nis" name="nis" required>
            </div>
            <div class="mb-3">
                <label for="nama_siswa" class="form-label fw-bold">Nama Siswa</label>
                <input type="text" class="form-control shadow-sm" id="nama_siswa" name="nama_siswa" required>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir</label>
                <input type="text" class="form-control shadow-sm" id="tempat_lahir" name="tempat_lahir" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                <input type="date" class="form-control shadow-sm" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>

            <!-- Pilihan Kelas -->
            <div class="mb-3">
                <label for="id_kelas" class="form-label fw-bold">Kelas</label>
                <select class="form-control shadow-sm" id="id_kelas" name="id_kelas" required>
                    <option value="">Pilih Kelas</option>
                    <?php
                    $kelas_query = "SELECT * FROM kelas";
                    $result = mysqli_query($koneksi, $kelas_query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='".$row['id_kelas']."'>".$row['nama_kelas']."</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Input Wali Murid -->
<div class="mb-3">
    <label for="wali_murid" class="form-label fw-bold">Wali Murid</label>
    <input type="text" class="form-control shadow-sm" id="wali_murid" name="wali_murid" required>
</div>


            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Kelamin</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="laki" name="jenis_kelamin" value="L" required>
                        <label class="form-check-label" for="laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="perempuan" name="jenis_kelamin" value="P" required>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="index.php" class="btn btn-secondary shadow-sm">Kembali</a>
                <button type="submit" name="submit" class="btn btn-success shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>
