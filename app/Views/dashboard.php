<?= $this->extend('layouts/main_layout'); ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $judul ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-6">
                <div class="small-box bg-success custom-box-size">
                    <div class="inner">
                        <h3><?= $dataDashboard['masterarc'] ?></h3>
                        <table cellspacing="0" cellpadding="0" style="font-size:18px">
                            <thead>
                                <tr>
                                    <th width=9%></th>
                                    <th width=88%></th>
                                    <th width=6%></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan=2><b>PUBLIKASI ARC</b></td>
                                    <td><b><?= $dataDashboard['masterarc'] ?></b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Publikasi Masuk</td>
                                    <td><?= $dataDashboard['arc'] ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Status Publikasi</td>
                                    <td></td>
                                </tr>
                                <?php for ($i = 0; $i < 4; $i++) { ?>
                                    <tr>
                                        <td></td>
                                        <td>- <?= $status[$i]['status_review'] ?></td>
                                        <td><?= $dataDashboard['arcstatus'][$i + 1] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-5 col-6">
                <div class="small-box bg-warning custom-box-size">
                    <div class="inner">
                        <h3><?= $dataDashboard['masternonarc'] ?></h3>
                        <table cellspacing="0" cellpadding="0" style="font-size:18px">
                            <thead>
                                <tr>
                                    <th width=9%></th>
                                    <th width=88%></th>
                                    <th width=6%></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan=2><b>PUBLIKASI NON ARC</b></td>
                                    <td><b><?= $dataDashboard['masternonarc'] ?></b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Publikasi Masuk</td>
                                    <td><?= $dataDashboard['nonarc'] ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Status Publikasi</td>
                                    <td></td>
                                </tr>
                                <?php for ($i = 0; $i < 4; $i++) { ?>
                                    <tr>
                                        <td></td>
                                        <td>- <?= $status[$i]['status_review'] ?></td>
                                        <td><?= $dataDashboard['nonarcstatus'][$i + 1] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>