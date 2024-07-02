<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>

<div>
    <h2>Detail Pengajuan Layanan TI</h2>
    <p><strong>Nama User:</strong> <?= $pengajuan['nip_lama_user'] ?></p>
    <p><strong>Jenis Layanan:</strong> <?= $pengajuan['jenis_layanan'] ?></p>
    <p><strong>No BMN:</strong> <?= $pengajuan['no_bmn'] ?></p>
    <p><strong>Deskripsi Keluhan:</strong> <?= $pengajuan['deskripsi_keluhan_jaringan'] ?></p>
    <p><strong>Keterangan Tambahan:</strong> <?= $pengajuan['keterangan_tambahan'] ?></p>
    <p><strong>Status:</strong> <?= $pengajuan['status'] ?></p>
    <p><strong>Nama Teknisi:</strong> <?= $pengajuan['nip_lama_teknisi'] ?></p>
    <p><strong>Nama Pihak Ketiga:</strong> <?= $pengajuan['id_pihak_ketiga'] ?></p>
</div>

<script>
    window.print();
</script>

<?= $this->endSection() ?>