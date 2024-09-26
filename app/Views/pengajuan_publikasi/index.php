<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0"><?= $judul ?></h3>
                <a href="<?= base_url('Publikasi/ajupublikasi') ?>" class="btn btn-light btn-sm"></i> Ajukan Publikasi</a>
            </div>
        </div>
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
            <thead class="table table-striped table-bordered" style="text-align: center;">
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Jenis</th>
                    <th>Judul Publikasi</th>
                    <th style="width: 30px">Fungsi Pengusul</th>
                    <th>Nama Penyusun</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Perbaikan</th>
                    <th style="width: 170px">Tautan</th>
                    <th>Status</th>
                    <th style="width: 120px">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-secondary">
                <?php $no = 1;
                foreach ($Publikasi as $key => $value) { ?>

                    <tr data-id="<?= $value['id_publikasi'] ?>">
                        <td style="text-align: center;"><?= $no++  ?>.</td>
                        <td style="text-align: center;"><?php echo ($value['id_jenispublikasi'] == 1) ? "ARC" : "NON ARC"; ?></td>
                        <td><?= $value['judul_publikasi_ind'] ?></td>
                        <td style="text-align: center;"><?= $value['nama_fungsi'] ?></td>
                        <td><?= $value['nama_penyusun'] ?></td>
                        <td><?= date('d-m-Y', strtotime($value['tgl_pengajuan'])) ?></td>
                        <td><?= $value['tgl_repisi'] ? date('d-m-Y', strtotime($value['tgl_repisi'])) : '-' ?></td>

                        <td>
                            <?php if (session()->get('role') == 4): ?>
                                <button class="btn btn-primary update-link" data-id="<?= $value['id_publikasi'] ?>" data-type="publikasi" data-toggle="modal" data-target="#updateLinkModal"><i class="fas fa-book"></i></button>
                                <?php if ($value['link_spsnrkf'] != null): ?>
                                    <button class="btn btn-secondary update-link" data-id="<?= $value['id_publikasi'] ?>" data-type="spsnrkf" data-toggle="modal" data-target="#updateLinkModal"><i class="fas fa-file-signature"></i></button>
                                <?php endif; ?>
                                <?php if ($value['link_spsnres2'] != null): ?>
                                    <button class="btn btn-success update-link" data-id="<?= $value['id_publikasi'] ?>" data-type="spsnres2" data-toggle="modal" data-target="#updateLinkModal"><i class="fas fa-file-signature"></i></button>
                                <?php endif; ?>
                            <?php else: ?>
                                <a class="btn btn-primary" href="<?= $value['link_publikasi'] ?>" target="_blank"><i class="fas fa-book"></i></a>
                                <?php if ($value['link_spsnrkf'] != null): ?>
                                    <a class="btn btn-secondary" href="<?= $value['link_spsnrkf'] ?>" target="_blank"><i class="fas fa-file-signature"></i></a>
                                <?php endif; ?>
                                <?php if ($value['link_spsnres2'] != null): ?>
                                    <a class="btn btn-success" href="<?= $value['link_spsnres2'] ?>" target="_blank"><i class="fas fa-file-signature"></i></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>

                        <td class="status <?= $value['bgcolor']; ?>"><?= $value['status_review']; ?></td>

                        <td style="text-align: center;" align=center>
                            <a href="<?= base_url('Publikasi/LihatKomentar') ?>/<?= $value['id_publikasi'] ?>" class="btn btn-primary btn-sm ubah" data-data="<?= $value['id_publikasi'] ?>"
                                data-toggle="tooltip" data-placement="top" title="Lihat Komentar">
                                <i class="fas fa-comment"></i>
                            </a>
                            <?php if (in_array(session()->get('role'), [1, 3])): ?>
                                <!-- Button Update Status -->
                                <button type="button" class="btn btn-info btn-sm btn-status" data-id="<?= $value['id_publikasi'] ?>" data-toggle="modal" data-target="#statusModal"
                                    data-toggle="tooltip" data-placement="top" title="Status Publikasi">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            <?php endif; ?>

                            <!-- Button Delete Komentar -->
                            <?php
                            if ($value['flag'] == 5 && (session()->get('role') == 1 || session()->get('role') == 4)) {
                            ?>
                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?= $value['id_publikasi'] ?>"
                                    data-toggle="modal" data-target="#deleteModal"
                                    data-toggle="tooltip" data-placement="top" title="Hapus Publikasi">
                                    <i class="fas fa-trash"></i>
                                </button>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<!-- Modal for updating links -->
<div class="modal fade" id="updateLinkModal" tabindex="-1" role="dialog" aria-labelledby="updateLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateLinkModalLabel">Perbarui Tautan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateLinkForm">
                    <input type="hidden" id="publikasi_id" name="publikasi_id">
                    <input type="hidden" id="link_type" name="link_type">
                    <div class="form-group">
                        <label for="new_link">Tautan</label>
                        <input type="text" class="form-control" id="new_link" name="new_link" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveLink">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Publikasi -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus publikasi ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Status -->
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

<script>
    $(document).ready(function() {
        let deleteId;

        $('.btn-delete').on('click', function() {
            deleteId = $(this).data('id');
        });

        $('#confirmDelete').on('click', function() {
            $.ajax({
                url: '<?= base_url('Publikasi/deletePublikasi') ?>/' + deleteId,
                type: 'POST',
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Gagal menghapus publikasi');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan');
                }
            });
        });

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

        // Handle form submission
        $('#statusForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#statusModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Gagal memperbarui status');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan');
                }
            });
        });

        $('.update-link').on('click', function() {
            var id = $(this).data('id');
            var type = $(this).data('type');
            var currentLink = '';

            var modalTitle = 'Perbarui Tautan ';
            if (type === 'publikasi') {
                modalTitle += 'Publikasi';
                currentLink = '<?= $value['link_publikasi'] ?>';
            } else if (type === 'spsnrkf') {
                modalTitle += 'SPS NRKF';
                currentLink = '<?= $value['link_spsnrkf'] ?>';
            } else if (type === 'spsnres2') {
                modalTitle += 'SPS NRES2';
                currentLink = '<?= $value['link_spsnres2'] ?>';
            }

            $('#updateLinkModalLabel').text(modalTitle);
            $('#publikasi_id').val(id);
            $('#link_type').val(type);
            $('#new_link').val(currentLink);
        });

        $('#saveLink').on('click', function() {
            var id = $('#publikasi_id').val();
            var type = $('#link_type').val();
            var newLink = $('#new_link').val();

            $.ajax({
                url: '<?= base_url('Publikasi/updateLink') ?>',
                method: 'POST',
                data: {
                    id: id,
                    type: type,
                    new_link: newLink
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {

                        $('#updateLinkModal').modal('hide');
                        // location.reload();
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Tautan sudah diperbarui",
                            icon: "success"
                        });
                    } else {
                        alert('Gagal memperbarui tautan');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan');
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>