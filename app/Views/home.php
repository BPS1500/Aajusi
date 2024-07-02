<?= $this->extend('layouts/landing_layout'); ?>

<?= $this->section('content'); ?>
<div class="jumbotron text-center">
    <div class="container">
        <h1 class="display-4">Selamat datang di SiNanTI!</h1>
        <p class="lead">Sistem Layanan TI untuk pengajuan layanan dan persediaan barang dengan efisiensi tinggi.</p>
        <hr class="my-4">
        <a class="btn btn-primary btn-lg" href="<?= base_url('auth/login'); ?>" role="button">Login Sekarang</a>
    </div>
</div>

<div class="container my-5">
    <div class="row text-center feature">
        <div class="col-md-4">
            <i class="fas fa-tools features-icon"></i>
            <h3>Pengajuan Layanan TI</h3>
            <p>Mengajukan layanan TI seperti permintaan perbaikan perangkat, instalasi perangkat lunak, dll.</p>
        </div>
        <div class="col-md-4">
            <i class="fas fa-boxes features-icon"></i>
            <h3>Pengajuan Persediaan</h3>
            <p>Mengajukan persediaan barang seperti pembelian perangkat keras dan perangkat lunak.</p>
        </div>
        <div class="col-md-4">
            <i class="fas fa-tasks features-icon"></i>
            <h3>Manajemen Permintaan</h3>
            <p>Mengelola permintaan yang diajukan dan mengawasi statusnya.</p>
        </div>
    </div>
</div>

<div class="container contact-section text-center">
    <h3>Hubungi Kami</h3>
    <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu untuk menghubungi kami.</p>
    <a class="btn btn-outline-primary" href="mailto:support@sinanti.com">Email Kami</a>
</div>

<div class="footer">
    <p>&copy; 2024 SiNanTI. All rights reserved.</p>
</div>
<?= $this->endSection(); ?>