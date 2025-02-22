<?php
include 'header.php';
include 'koneksi.php';

// Ambil NIS siswa dari parameter URL
if (!isset($_GET['nis']) || empty($_GET['nis'])) {
    echo "<script>alert('NIS siswa tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

$nis = $_GET['nis'];

// Ambil data siswa berdasarkan NIS
$query = "SELECT * FROM siswa WHERE nis = '$nis'";
$result = mysqli_query($koneksi, $query);
$siswa = mysqli_fetch_assoc($result);

if (!$siswa) {
    echo "<script>alert('Data siswa tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// Proses update jika tombol simpan ditekan
if (isset($_POST['submit'])) {
    $nama_siswa = $_POST['nama_siswa'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas']; // ID kelas dari dropdown
    $id_wali = $_POST['id_wali']; // ID wali dari dropdown
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Query update berdasarkan NIS
    $update_query = "UPDATE siswa SET 
                        nama_siswa = '$nama_siswa', 
                        tempat_lahir = '$tempat_lahir', 
                        tanggal_lahir = '$tanggal_lahir', 
                        id_kelas = '$id_kelas', 
                        id_wali = '$id_wali', 
                        jenis_kelamin = '$jenis_kelamin'
                    WHERE nis = '$nis'";

    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}    
?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="width: 50rem; border-radius: 12px;">
        <h2 class="text-center mb-4 text-primary">Edit Data Siswa</h2>
        <form action="edit.php?nis=<?= $nis ?>" method="POST">
            <div class="mb-3">
                <label for="nis" class="form-label fw-bold">NIS</label>
                <input type="text" class="form-control shadow-sm" id="nis" name="nis" value="<?= $siswa['nis'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_siswa" class="form-label fw-bold">Nama Siswa</label>
                <input type="text" class="form-control shadow-sm" id="nama_siswa" name="nama_siswa" value="<?= $siswa['nama_siswa'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir</label>
                <input type="text" class="form-control shadow-sm" id="tempat_lahir" name="tempat_lahir" value="<?= $siswa['tempat_lahir'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                <input type="date" class="form-control shadow-sm" id="tanggal_lahir" name="tanggal_lahir" value="<?= $siswa['tanggal_lahir'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label fw-bold">Kelas</label>
                <select class="form-control shadow-sm" id="id_kelas" name="id_kelas" required>
                    <option value="">Pilih Kelas</option>
                    <?php
                    $kelas_query = "SELECT * FROM kelas";
                    $kelas_result = mysqli_query($koneksi, $kelas_query);
                    while ($kelas = mysqli_fetch_assoc($kelas_result)) {
                        $selected = ($kelas['id_kelas'] == $siswa['id_kelas']) ? 'selected' : '';
                        echo "<option value='".$kelas['id_kelas']."' $selected>".$kelas['nama_kelas']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_wali" class="form-label fw-bold">Wali Murid</label>
                <select class="form-control shadow-sm" id="id_wali" name="id_wali" required>
                    <option value="">Pilih Wali Murid</option>
                    <?php
                    $wali_query = "SELECT * FROM wali_murid";
                    $wali_result = mysqli_query($koneksi, $wali_query);
                    while ($wali = mysqli_fetch_assoc($wali_result)) {
                        $selected = ($wali['id_wali'] == $siswa['id_wali']) ? 'selected' : '';
                        echo "<option value='".$wali['id_wali']."' $selected>".$wali['nama_wali']."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Kelamin</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="laki" name="jenis_kelamin" value="L" <?= ($siswa['jenis_kelamin'] == 'L') ? 'checked' : '' ?> required>
                        <label class="form-check-label" for="laki">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="perempuan" name="jenis_kelamin" value="P" <?= ($siswa['jenis_kelamin'] == 'P') ? 'checked' : '' ?> required>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="index.php" class="btn btn-secondary shadow-sm">Kembali</a>
                <button type="submit" name="submit" class="btn btn-success shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
