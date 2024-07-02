<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>

<form action="<?= base_url('/layanan_ti/update/' . $pengajuan['id']) ?>" method="post">
    <!-- Form fields same as create form but pre-filled with $pengajuan data -->
    <!-- Add fields for jenis layanan, no bmn, deskripsi keluhan, keterangan tambahan, status, etc. -->
    <button type="submit" class="btn btn-primary">Update Pengajuan</button>
</form>

<?= $this->endSection() ?>
