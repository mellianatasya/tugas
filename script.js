// Konfirmasi Hapus Data
document.addEventListener('DOMContentLoaded', function() {
    // Menambahkan event listener ke semua tombol hapus
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Mengonfirmasi penghapusan
            const confirmation = confirm('Apakah Anda yakin ingin menghapus data ini?');
            if (!confirmation) {
                e.preventDefault(); // Mencegah penghapusan jika user tidak mengonfirmasi
            }
        });
    });

    // Tambahan interaksi pada form tambah dan edit
    const formFields = document.querySelectorAll('input, select');
    formFields.forEach(field => {
        field.addEventListener('focus', function() {
            // Menandai field yang sedang difokuskan dengan border biru
            field.style.border = '2px solid #007bff';
        });
        field.addEventListener('blur', function() {
            // Menghapus border biru setelah kehilangan fokus
            field.style.border = '';
        });
    });

    // Fitur untuk menampilkan pesan konfirmasi setelah berhasil tambah, edit, atau hapus
    const successMessage = document.querySelector('.alert-success');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.display = 'none';
        }, 5000); // Menyembunyikan pesan setelah 5 detik
    }
    
    // Misalnya, jika ingin menambah fitur autocomplete di form
    const nisField = document.getElementById('nis');
    if (nisField) {
        nisField.addEventListener('input', function() {
            // Bisa disesuaikan untuk mengautolengkap NIS dari database
            console.log('Mengetik NIS: ', nisField.value);
        });
    }
});
