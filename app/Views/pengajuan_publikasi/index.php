<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header row">
            <div class="col-md-10">
                <h3 class="card-title"><?= $judul ?></h3>
            </div>
            <a href="<?= base_url('Publikasi/ajupublikasi') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"> Ajukan Publikasi </i></a>
        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <?php
            if (session()->getFlashdata('insert')) {
                echo '<div class="alert alert-success">';
                echo session()->getFlashdata('insert');
                echo '</div>';
            }
            ?>

            <table id="tabel_publikasi" class="table-bordered table-hover">
                <thead class=" table table-primary align-middle" style="text-align: center;">
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Jenis</th>
                        <th>Judul Publikasi</th>
                        <th style="width: 30px">Fungsi Pengusul</th>
                        <th style="width: 170px">Tautan</th>
                        <th>Status</th>
                        <th style="width: 120px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    <?php $no = 1;
                    foreach ($Publikasi as $key => $value) { ?>

                        <tr>
                            <td style="text-align: center;"><?= $no++  ?>.</td>
                            <td style="text-align: center;"><?php if ($value['id_jenispublikasi'] == 1) {
                                                                echo "ARC";
                                                            } else {
                                                                echo "NON ARC";
                                                            }
                                                            ?></td>
 
                            <td><?= $value['judul_publikasi_ind'] ?></td>
                            <td style="text-align: center;"><?= $value['nama_fungsi'] ?></td>
                            <td><a class="btn btn-primary" href="<?= $value['link_publikasi'] ?>" target="_blank"><i class="fas fa-book"></i></a><?php if ($value['link_spsnrkf'] != null) { ?> <a class="btn btn-secondary" href="<?= $value['link_spsnrkf'] ?>" target="_blank"><i class="fas fa-file-signature"></i></a><?php } ?><?php if ($value['link_spsnres2'] != null) { ?> <a class="btn btn-success" href="<?= $value['link_spsnres2'] ?>" target="_blank"><i class="fas fa-file-signature"></i></a><?php } ?></td>
                            <td class="<?= $value['bgcolor']; ?>"><?= $value['status_review']; ?></td>

                            <td style="text-align: center;" align=center>
                                <a href="<?= base_url('Publikasi/LihatKomentar') ?>/<?= $value['id_publikasi'] ?>" class="btn btn-primary btn-sm ubah" data-data="<?= $value['id_publikasi'] ?>"
                                   data-toggle="tooltip" data-placement="top" title="Lihat Komentar">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if (session()->get('id_user') == $value['id_user_upload'] && $value['flag'] != 3) { ?>
                                    <button type="button" class="btn btn-warning btn-sm btn-edit" data-id="<?= $value['id_publikasi'] ?>" data-toggle="modal" data-target="#modal-sm5"
                                            data-toggle="tooltip" data-placement="top" title="Update Link">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                <?php } ?>
                                <!-- Button Update Status -->
                                <button type="button" class="btn btn-info btn-sm btn-status" data-id="<?= $value['id_publikasi'] ?>" data-toggle="modal" data-target="#statusModal"
                                        data-toggle="tooltip" data-placement="top" title="Status Publikasi">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL UPDATE STATUS -->
<div class="modal fade" id="statusModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Perbarui Status Publikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="statusForm" method="post" action="<?= base_url('Publikasi/updateStatus') ?>">
                    <input type="hidden" id="id_publikasi" name="id_publikasi">
                    <div class="form-group">
                        <label for="status_review">Pilih Status:</label>
                        <select class="form-control" id="status_review" name="status_review"></select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" form="statusForm">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL STATUS -->
<div class="modal fade" id="modal-sm5">
    <div class="modal-dialog modal-sm">
        <?php echo form_open('Publikasi/setLink') ?>
        <form action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Perbarui Tautan Publikasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- btn Approved -->
                    <div class="container d-flex">
                        <input type="hidden" id="id_hidden" name="id">
                        <textarea name="link" id="inputLink" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary simpan">Simpan</button>
                </div>
        </form>
        <?php echo form_close() ?>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        $('.btn-edit').on('click', function() {
            const id_publikasi = $(this).data('id');
            $('#id_hidden').val(id_publikasi);

            // ajax :
            $.ajax({
                url: 'http://localhost/PublikasiBPS-ci4/public/Publikasi/getLink',
                data: {
                    id: id_publikasi
                },
                method: 'post',
                success: function(data) {
                    $('#inputLink').val(data);
                }
            });
        });

        // Update Status Button
        $('.btn-status').on('click', function() {
            const id_publikasi = $(this).data('id');
            $('#id_publikasi').val(id_publikasi);

            $.ajax({
                url: '<?= base_url("Publikasi/getStatusOptions") ?>',
                method: 'POST',
                dataType: 'json',
                success: function(data) {
                    let options = '';
                    data.forEach(function(item) {
                        options += `<option value="${item.id}">${item.status_review}</option>`;
                    });
                    $('#status_review').html(options);
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
