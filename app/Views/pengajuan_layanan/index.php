<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengajuan Layanan TI</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pengajuan Layanan TI</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pengajuan Layanan TI</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Layanan</th>
                                    <th>Deskripsi Keluhan</th>
                                    <th>No BMN</th>
                                    <th>Teknisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pengajuan as $index => $item) : ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= $item['jenis_layanan'] ?></td>
                                        <td><?= $item['deskripsi_keluhan'] ?></td>
                                        <td><?= $item['no_bmn'] ?></td>
                                        <td><?= $item['teknisi'] ?></td>
                                        <td><?= $item['status_pengajuan'] ?></td>
                                        <td>
                                            <a href="<?= base_url('pengajuan_layanan/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="<?= base_url('pengajuan_layanan/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="<?= base_url('pengajuan_layanan/print/' . $item['id']) ?>" class="btn btn-info btn-sm">Print</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="<?= base_url('pengajuan_layanan/create') ?>" class="btn btn-primary">Tambah Pengajuan</a>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>