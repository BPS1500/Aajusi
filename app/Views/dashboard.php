<?= $this->extend('layouts/main_layout'); ?>

<?= $this->section('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Pengajuan Baru</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= base_url('layanan/tabel'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Penyelesaian Layanan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>
                        <p>Pengguna Baru</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>
                        <p>Kunjungan Baru</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <!-- Formulir Pengajuan -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Formulir Pengajuan Layanan TI</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('layanan/submit'); ?>" method="post">
                            <div class="form-group">
                                <label for="judul_pengajuan">Judul Pengajuan</label>
                                <input type="text" class="form-control" id="judul_pengajuan" name="judul_pengajuan" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_pengajuan">Deskripsi Pengajuan</label>
                                <textarea class="form-control" id="deskripsi_pengajuan" name="deskripsi_pengajuan" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                <!-- Tabel Pengajuan -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pengajuan Layanan TI</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Tanggal Pengajuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data pengajuan layanan -->
                                <?php if (!empty($pengajuan)) : ?>
                                    <?php foreach ($pengajuan as $key => $item) : ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= $item['judul_pengajuan']; ?></td>
                                            <td><?= $item['deskripsi_pengajuan']; ?></td>
                                            <td><?= $item['status']; ?></td>
                                            <td><?= $item['created_at']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data pengajuan</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>