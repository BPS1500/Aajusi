<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<?php dd($pengajuan); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Pengajuan Layanan TI</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Pengajuan Layanan TI</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pengajuan Layanan TI</h3>
                        <div class="card-tools">
                            <a href="<?= base_url('/layanan_ti/create') ?>" class="btn btn-primary btn-sm">Tambah Pengajuan</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="pengajuanTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP Lama User</th>
                                    <th>Jenis Layanan</th>
                                    <th>Deskripsi Keluhan</th>
                                    <th>No BMN</th>
                                    <th>Status</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pengajuan as $index => $item) : ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= $item['nip_lama_user'] ?></td>
                                        <td><?= $item['jenis_layanan'] ?></td>
                                        <td><?= $item['deskripsi_keluhan'] ?></td>
                                        <td><?= $item['no_bmn'] ?></td>
                                        <td><?= $item['status'] ?></td>
                                        <td><?= $item['tanggal_pengajuan'] ?></td>
                                        <td>
                                            <a href="<?= base_url('layanan_ti/assign/' . $item['id']) ?>" class="btn btn-sm btn-success">Assign</a>
                                            <a href="<?= base_url('layanan_ti/print/' . $item['id']) ?>" class="btn btn-sm btn-info">Print</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

<script src="<?= base_url('assets/AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('#pengajuanTable').DataTable();
    });
</script>

<?= $this->endSection() ?>