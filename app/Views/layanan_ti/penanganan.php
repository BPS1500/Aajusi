<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('title') ?>Penanganan Layanan TI<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Penanganan Layanan TI</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis Layanan</th>
                        <th>Deskripsi Keluhan</th>
                        <th>Status</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Tanggal Perubahan</th>
                        <th>Aksi</th>
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
                            <td><?= $item['tanggal_perubahan'] ?></td>
                            <td>
                                <a href="<?= base_url('pengajuan_layanan/edit/' . $item['id']) ?>" class="btn btn-primary">Edit</a>
                                <a href="<?= base_url('pengajuan_layanan/delete/' . $item['id']) ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>