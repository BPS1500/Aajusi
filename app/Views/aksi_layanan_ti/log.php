<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Log Aksi Layanan TI untuk Pengajuan ID: <?= $pengajuan['id'] ?></h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Aksi</th>
                <th>Deskripsi Aksi</th>
                <th>Biaya Penanganan</th>
                <th>Kwitansi</th>
                <th>Dokumentasi</th>
                <th>Tanggal Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aksi_layanan as $item) : ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['deskripsi_aksi'] ?></td>
                    <td><?= $item['biaya_penanganan'] ?></td>
                    <td><?= $item['kwitansi'] ?></td>
                    <td><?= $item['dokumentasi'] ?></td>
                    <td><?= $item['tanggal_aksi'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
