<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="col-md-10">
    <!-- Form Tambah Komentar -->
    <div class="card mb-4">
        <div class="card-body">
            <div id="newCommentFormContainer">
                <button class="btn btn-outline-primary btn-block" type="button" data-toggle="collapse" data-target="#newCommentForm" aria-expanded="false" aria-controls="newCommentForm"> Tambah Komentar </button>
                <div class="collapse" id="newCommentForm">
                    <form action="<?= base_url('publikasi/addkomentar') ?>" method="post" class="mt-3">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_publikasi" value="<?= $id_publikasi ?>">
                        <div class="form-group">
                            <label for="new_comment">Komentar</label>
                            <textarea class="form-control" id="new_comment" name="catatan" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-footer card-comments">
    <div id="accordion">
        <?php foreach ($Komentar as $komen => $value) : ?>
            <div class="card">
                <div class="card-header" id="headingOne">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $value['id_komentar']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                <?= $value['pemeriksa'] ?>
                                <span style="font-size: small;"><?= ' (' . $value['tgl_komen_admin'] . ')'; ?></span>
                            </button>
                        </h5>
                        <div>
                            <!-- Toggle Switch  -->
                            <label class="switch">
                                <input type="checkbox" class="toggle-status" data-id="<?= $value['id_komentar']; ?>" <?= $value['selesai'] == '1' ? 'checked' : '' ?>>
                                <span class="slider round" 
                                    data-toggle="tooltip" 
                                    data-status="<?= $value['selesai'] == '1' ? 'sudah_sesuai' : 'belum_sesuai' ?>" 
                                    title="<?= $value['selesai'] == '1' ? 'Sudah Sesuai' : 'Belum Sesuai' ?>"></span>
                            </label>

                            <?php if ($value['pemeriksa'] == session()->get('full_name')) : ?>
                                <?php if (in_array(session()->get('role'), [1, 3])) : ?>
                                    <button class="btn btn-sm btn-primary edit-comment ml-2" data-id="<?= $value['id_komentar']; ?>" data-comment="<?= htmlspecialchars($value['catatan']); ?>">Edit</button>
                                <?php endif; ?>
                                <?php if (session()->get('role') == '1') : ?>
                                    <form action="<?= base_url('publikasi/deletekomentar/' . $value['id_komentar']) ?>" method="post" class="d-inline-block delete-form">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger ml-2">Delete</button>
                                    </form>

                                <?php endif; ?>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>

                <div id="collapse<?= $value['id_komentar']; ?>" class="collapse <?php if ($value['selesai'] == '0') { echo "show"; } ?>" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <?= $value['catatan'] ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

    </div>
</div>

<!-- Modal Edit Komentar-->
<div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel">Edit Komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCommentForm">
                    <input type="hidden" id="edit_comment_id" name="id_komentar">
                    <div class="form-group">
                        <label for="edit_comment">Komentar</label>
                        <textarea class="form-control" id="edit_comment" name="catatan" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="saveEditComment">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();

    $('.edit-comment').click(function() {
        var id = $(this).data('id');
        var comment = $(this).data('comment');
        $('#edit_comment_id').val(id);
        $('#edit_comment').val(comment);
        $('#editCommentModal').modal('show');
    });

    $('#saveEditComment').click(function() {
        var id = $('#edit_comment_id').val();
        var comment = $('#edit_comment').val();
        $.ajax({
            url: '<?= base_url('publikasi/editkomentar') ?>',
            type: 'POST',
            data: {
                id_komentar: id,
                catatan: comment,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            success: function(response) {
                $('#editCommentModal').modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('.toggle-status').change(function() {
        var id = $(this).data('id');
        var status = $(this).is(':checked') ? 1 : 0;
        var newStatus = status === 1 ? 'sudah_sesuai' : 'belum_sesuai';
        var newTitle = status === 1 ? 'Sudah Sesuai' : 'Belum Sesuai';

        var slider = $(this).siblings('.slider');
        slider.attr('data-status', newStatus);
        slider.attr('title', newTitle);

        slider.tooltip('dispose').tooltip();

        $.ajax({
            url: '<?= base_url('publikasi/updateStatus') ?>',
            type: 'POST',
            data: {
                id_komentar: id,
                selesai: status,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            success: function(response) {
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('form.delete-form').submit(function(e) {
        e.preventDefault();

        var form = $(this);
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Komentar Anda akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batalkan',
        }).then((result) => {
            if (result.isConfirmed) {
                form.off('submit').submit();
            }
        });
    });

});

</script>

<style>
.switch {
    position: relative;
    display: inline-block;
    width: 34px;
    height: 20px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 20px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 12px;
    width: 12px;
    border-radius: 50%;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:checked + .slider:before {
    transform: translateX(14px);
}

.slider.round {
    border-radius: 20px;
}
.slider.round:before {
    border-radius: 50%;
}
</style>

<?= $this->endSection() ?>
