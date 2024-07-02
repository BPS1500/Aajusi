<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>





<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Pengajuan Layanan TI</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Daftar Pengajuan Layanan TI</li>
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

                            <a href="<?= base_url('/layanan_ti/create') ?>" class="btn btn-primary">Tambah Pengajuan</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="pengajuanTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama User</th>
                                    <th>Jenis Layanan</th>
                                    <th>No BMN (Jenis Perangkat - Merk - Tipe)</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pengajuan_layanan as $pengajuan) : ?>
                                    <tr>
                                        <td><?= $pengajuan['id'] ?></td>
                                        <td>
                                            <?php
                                            foreach ($users as $user) {
                                                if ($user['nip_lama'] == $pengajuan['nip_lama_user']) {
                                                    echo $user['fullname'];
                                                    break;
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $jenisLayananArray = json_decode($pengajuan['jenis_layanan']);
                                            foreach ($jenisLayananArray as $jenisLayananId) {
                                                foreach ($jenis_layanan as $layanan) {
                                                    if ($layanan['id'] == $jenisLayananId) {
                                                        echo $layanan['nama_layanan'] . '<br>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?= $pengajuan['no_bmn'] ?>
                                            <?php
                                            foreach ($bmn as $item) {
                                                if ($item['no_bmn'] == $pengajuan['no_bmn']) {
                                                    echo " (" . $item['jenis_perangkat'] . " - " . $item['merk'] . " - " . $item['tipe'] . ")";
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td><?= $pengajuan['status'] ?></td>
                                        <td>
                                            <a href="<?= base_url('/layanan_ti/assign/' . $pengajuan['id']) ?>" class="btn btn-warning">Assign</a>
                                            <a href="<?= base_url('/layanan_ti/print/' . $pengajuan['id']) ?>" class="btn btn-primary">Print</a>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#detailModal" data-id="<?= $pengajuan['id'] ?>" data-user="<?= $user['fullname'] ?>" data-jenis-layanan='<?php
                                                                                                                                                                                                                    $jenisLayananArray = json_decode($pengajuan['jenis_layanan']);
                                                                                                                                                                                                                    $j_layanan = [];
                                                                                                                                                                                                                    foreach ($jenisLayananArray as $jenisLayananId) {
                                                                                                                                                                                                                        foreach ($jenis_layanan as $layanan) {
                                                                                                                                                                                                                            if ($layanan['id'] == $jenisLayananId) {
                                                                                                                                                                                                                                $j_layanan[] = $layanan['nama_layanan'] . ' ';
                                                                                                                                                                                                                            }
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                    echo json_encode($j_layanan);
                                                                                                                                                                                                                    ?>' data-nobmn='<?php
                                                                                                                                                                                                                                    $databmn = [];
                                                                                                                                                                                                                                    foreach ($bmn as $item) {
                                                                                                                                                                                                                                        if ($item['no_bmn'] == $pengajuan['no_bmn']) {
                                                                                                                                                                                                                                            $databmn[] = $item['jenis_perangkat'] . " - " . $item['merk'] . " - " . $item['tipe'] . " (" . $item['no_bmn'] . ")";
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                    echo json_encode($databmn);
                                                                                                                                                                                                                                    ?>' data-merk="<?= $item['merk'] ?>" data-tipe="<?= $item['tipe'] ?>" data-status="<?= $pengajuan['status'] ?>" data-keterangan="<?= $pengajuan['keterangan_tambahan'] ?>" data-jaringan="<?= $pengajuan['deskripsi_keluhan_jaringan'] ?>" data-hardware="<?= $pengajuan['deskripsi_keluhan_hardware'] ?>" data-software="<?= $pengajuan['deskripsi_keluhan_software'] ?>" data-lainnya="<?= $pengajuan['deskripsi_keluhan_lainnya'] ?>" data-nama-teknisi="<?= $pengajuan['nip_lama_teknisi'] ?>" data-nama-pihak-ketiga="<?= $pengajuan['id_pihak_ketiga'] ?>">
                                                Detail
                                            </button>
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

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Pengajuan Layanan TI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Nama User</th>
                            <td><span id="modalUser"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Layanan</th>
                            <td><span id="modalJenisLayanan"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">No BMN</th>
                            <td><span id="modalNoBMN"></span></td>
                        </tr>

                        <tr>
                            <th scope="row">Status</th>
                            <td><span id="modalStatus"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Deskripsi Keluhan Jaringan</th>
                            <td><span id="modalDeskripsiJaringan"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Deskripsi Keluhan Hardware</th>
                            <td><span id="modalDeskripsiHardware"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Deskripsi Keluhan Software</th>
                            <td><span id="modalDeskripsiSoftware"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Deskripsi Keluhan Lainnya</th>
                            <td><span id="modalDeskripsiLainnya"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Keterangan Tambahan</th>
                            <td><span id="modalKeterangan"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">NIP Teknisi</th>
                            <td><span id="modalNamaTeknisi"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">ID Pihak Ketiga</th>
                            <td><span id="modalNamaPihakKetiga"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->






<?= $this->endSection() ?>