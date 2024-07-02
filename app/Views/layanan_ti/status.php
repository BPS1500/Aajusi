<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('title') ?>Status Layanan TI<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Status Layanan TI</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis Layanan</th>
                        <th>Deskripsi Keluhan</th>
                        <th>Status</th>
                        <th>Tanggal Pengajuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pengajuan as $item) : ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['jenis_layanan'] ?></td>
                            <td><?= $item['deskripsi_keluhan'] ?></td>
                            <td><?= $item['status'] ?></td>
                            <td><?= $item['tanggal_pengajuan'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>