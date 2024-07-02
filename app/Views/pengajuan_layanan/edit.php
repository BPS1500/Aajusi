<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Pengajuan Layanan TI</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Pengajuan Layanan TI</li>
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
                        <h3 class="card-title">Form Edit Pengajuan Layanan TI</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('pengajuan_layanan/update/' . $pengajuan['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="nip_lama_user">NIP Lama User</label>
                                <input type="text" class="form-control" id="nip_lama_user" name="nip_lama_user" value="<?= $pengajuan['nip_lama_user'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_layanan">Jenis Layanan</label>
                                <select class="form-control" id="jenis_layanan" name="jenis_layanan" required>
                                    <option value="Jaringan" <?= $pengajuan['jenis_layanan'] == 'Jaringan' ? 'selected' : '' ?>>Jaringan</option>
                                    <option value="Hardware" <?= $pengajuan['jenis_layanan'] == 'Hardware' ? 'selected' : '' ?>>Hardware</option>
                                    <option value="Software" <?= $pengajuan['jenis_layanan'] == 'Software' ? 'selected' : '' ?>>Software</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_keluhan">Deskripsi Keluhan</label>
                                <textarea class="form-control" id="deskripsi_keluhan" name="deskripsi_keluhan" rows="3" required><?= $pengajuan['deskripsi_keluhan'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="no_bmn">No BMN</label>
                                <input type="text" class="form-control" id="no_bmn" name="no_bmn" value="<?= $pengajuan['no_bmn'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_keluhan_hardware">Deskripsi Keluhan Hardware</label>
                                <textarea class="form-control" id="deskripsi_keluhan_hardware" name="deskripsi_keluhan_hardware" rows="3"><?= $pengajuan['deskripsi_keluhan_hardware'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_keluhan_software">Deskripsi Keluhan Software</label>
                                <textarea class="form-control" id="deskripsi_keluhan_software" name="deskripsi_keluhan_software" rows="3"><?= $pengajuan['deskripsi_keluhan_software'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_keluhan_lainnya">Deskripsi Keluhan Lainnya</label>
                                <textarea class="form-control" id="deskripsi_keluhan_lainnya" name="deskripsi_keluhan_lainnya" rows="3"><?= $pengajuan['deskripsi_keluhan_lainnya'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="teknisi">Teknisi</label>
                                <select class="form-control" id="teknisi" name="teknisi" required>
                                    <?php foreach ($teknisi as $t) : ?>
                                        <option value="<?= $t['id'] ?>" <?= $pengajuan['teknisi'] == $t['id'] ? 'selected' : '' ?>><?= $t['nama_teknisi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_pengajuan">Status Pengajuan</label>
                                <select class="form-control" id="status_pengajuan" name="status_pengajuan" required>
                                    <option value="Pending" <?= $pengajuan['status_pengajuan'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Proses" <?= $pengajuan['status_pengajuan'] == 'Proses' ? 'selected' : '' ?>>Proses</option>
                                    <option value="Selesai" <?= $pengajuan['status_pengajuan'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>