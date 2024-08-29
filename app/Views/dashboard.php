<?= $this->extend('layouts/main_layout'); ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $judul ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- ARC Publications -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 font-weight-bold">
                            <i class="ion ion-stats-bars"></i> Publikasi ARC
                        </h5>
                        <h3 class="mb-0"><?= $dataDashboard['masterarc'] ?></h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text font-weight-bold">Publikasi Masuk: <span class="float-right"><?= $dataDashboard['arc'] ?></span></p>
                        <p class="card-text font-weight-bold mb-1">Status Publikasi:</p>
                        <ul class="list-group list-group-flush">
                            <?php for ($i = 0; $i < 4; $i++) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= $status[$i]['status_review'] ?>
                                    <span class ="card-text font-weight-bold"><?= $dataDashboard['arcstatus'][$i + 1] ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="#" class="btn btn-outline-success btn-sm float-right">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Non-ARC Publications -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 font-weight-bold">
                            <i class="ion ion-stats-bars"></i> Publikasi Non ARC
                        </h5>
                        <h3 class="mb-0"><?= $dataDashboard['masternonarc'] ?></h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text font-weight-bold">Publikasi Masuk: <span class="float-right"><?= $dataDashboard['nonarc'] ?></span></p>
                        <p class="card-text font-weight-bold mb-1">Status Publikasi:</p>
                        <ul class="list-group list-group-flush">
                            <?php for ($i = 0; $i < 4; $i++) { ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= $status[$i]['status_review'] ?>
                                    <span class ="card-text font-weight-bold"><?= $dataDashboard['nonarcstatus'][$i + 1] ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="#" class="btn btn-outline-warning btn-sm float-right">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Future Graphs and Analytics Section -->
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Graphs and Analytics</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-muted">Visualisasi Data</p>
                        <!-- Placeholder for graphs -->
                        <!-- <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>