<div class="container mt-5">
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Kesalahan Validasi Konten!</h4>
        <p>Terjadi masalah saat memuat konten novel. Data yang diminta tidak sesuai dengan struktur yang diharapkan.</p>
        <hr>
        <p class="mb-0">Detail Kesalahan:</p>
        <pre><?php echo htmlspecialchars($error_details); ?></pre>
        <p>Mohon informasikan kepada administrator atau pengembang.</p>
    </div>
    <a href="<?= $BASE ?>/novel" class="btn btn-primary">Kembali ke Daftar Novel</a>
</div>