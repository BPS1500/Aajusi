<?= $this->extend('layouts/main_layout'); ?>

<?= $this->section('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashbor Penyusun</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success custom-box-size">
                    <div class="inner">
                        <h3>53</sup></h3>
                        <p><strong>PUBLIKASI ARC</strong></p>
                        <p>Publikasi Masuk </p>
                        <p>Status Publikasi</p>
                        <p> - Sedang Diperiksa</p>
                        <p> - Butuh Perbaikan</p>
                        <p> - Disetujui</p>
                        <p> - Ditolak</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya  <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning custom-box-size">
                    <div class="inner">
                        <h3>44</h3>
                        <p><strong>PUBLIKASI NON ARC</strong></p>
                        <p>Publikasi Masuk </p>
                        <p>Status Publikasi</p>
                        <p> - Sedang Diperiksa</p>
                        <p> - Butuh Perbaikan</p>
                        <p> - Disetujui</p>
                        <p> - Ditolak</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>