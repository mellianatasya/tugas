<?php
include 'header.php';
include 'koneksi.php';

// Ambil ID siswa dari parameter URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID siswa tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

$id_siswa = $_GET['id'];

// Ambil data siswa berdasarkan ID
$query = "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'";
$result = mysqli_query($koneksi, $query);
$siswa = mysqli_fetch_assoc($result);

if (!$siswa) {
    echo "<script>alert('Data siswa tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// Proses update jika tombol simpan ditekan
if (isset($_POST['submit'])) {
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas']; // ID kelas dari dropdown
    $wali_murid = $_POST['id_wali']; // Diketik langsung
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Query update
    $update_query = "UPDATE siswa SET 
                        nis = '$nis', 
                        nama_siswa = '$nama_siswa', 
                        tempat_lahir = '$tempat_lahir', 
                        tanggal_lahir = '$tanggal_lahir', 
                        id_kelas = '$id_kelas', 
                        wali_murid = '$wali_murid', 
                        jenis_kelamin = '$jenis_kelamin'
                    WHERE id_siswa = '$id_siswa'";

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
        <form action="edit.php?id=<?= $id_siswa ?>" method="POST">
            <div class="mb-3">
                <label for="nis" class="form-label fw-bold">NIS</label>
                <input type="text" class="form-control shadow-sm" id="nis" name="nis" value="<?= $siswa['nis'] ?>" required>
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
                <label for="wali_murid" class="form-label fw-bold">Wali Murid</label>
                <input type="text" class="form-control shadow-sm" id="id_wali" name="id_wali" value="<?= $siswa['id_wali'] ?>" required>
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
