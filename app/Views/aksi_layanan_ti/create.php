<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Tambah Aksi Layanan TI untuk Pengajuan ID: <?= $id_pengajuan ?></h2>
    <form action="<?= base_url('aksi_layanan_ti/store') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan ?>">
        <div class="form-group">
            <label for="deskripsi_aksi">Deskripsi Aksi</label>
            <textarea class="form-control" id="deskripsi_aksi" name="deskripsi_aksi" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="biaya_penanganan">Biaya Penanganan</label>
            <input type="number" step="0.01" class="form-control" id="biaya_penanganan" name="biaya_penanganan">
        </div>
        <div class="form-group">
            <label for="kwitansi">Kwitansi</label>
            <input type="text" class="form-control" id="kwitansi" name="kwitansi">
        </div>
        <div class="form-group">
            <label for="dokumentasi">Dokumentasi</label>
            <input type="text" class="form-control" id="dokumentasi" name="dokumentasi">
        </div>
        <div class="form-group">
            <label for="tanggal_aksi">Tanggal Aksi</label>
            <input type="datetime-local" class="form-control" id="tanggal_aksi" name="tanggal_aksi" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Aksi</button>
    </form>
</div>
<?= $this->endSection() ?>
