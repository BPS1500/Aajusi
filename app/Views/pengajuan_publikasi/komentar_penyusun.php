<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="col-md-10">
    <!-- New Comment Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Tambah Komentar Baru</h5>
        </div>
        <div class="card-body">
            <form action="<?= base_url('publikasi/addkomentar') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id_publikasi" value="<?= $id_publikasi ?>">
                <div class="form-group">
                    <label for="new_comment">Komentar:</label>
                    <textarea class="form-control" id="new_comment" name="catatan" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>
        </div>

    <div class="card-footer card-comments">
        <div id="accordion">
            <?php foreach ($Komentar as $komen => $value) : ?>
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link btn-block" data-toggle="collapse" data-target="#collapse<?= $value['id_komentar']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                <h4 style="text-align: left;"><?= $value['pemeriksa'] ?>
                                    <span style="font-size: small;"><?= ' (' . $value['tgl_komen_admin'] . ')'; ?></span>

                                    <?php if ($value['selesai'] == '0') { ?>
                                        <a href="#" class="btn btn-danger btn-sm float-right">Belum Sesuai</a>
                                    <?php } else { ?>
                                        <a href="#" class="btn btn-success btn-sm float-right">Sesuai</a>
                                    <?php } ?>
                                </h4>
                            </button>
                        </h5>
                    </div>

                    <div id="collapse<?= $value['id_komentar']; ?>" class="collapse <?php if ($value['selesai'] == '0') {
                                                                                        echo "show";
                                                                                    } ?>" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <?= $value['catatan'] ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- /.card -->

</div>
<?= $this->endSection() ?>