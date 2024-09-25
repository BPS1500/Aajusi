<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="col-md-12">
    <div class="card mb-4">
        <div class="card-body">
            <div id="newCommentFormContainer">
                <button class="btn btn-outline-primary btn-block" type="button" data-toggle="collapse" data-target="#newCommentForm" aria-expanded="false" aria-controls="newCommentForm">
                    <i class="fas fa-plus-circle"></i> Tambah Komentar
                </button>
                <div class="collapse mt-3" id="newCommentForm">
                    <form action="<?= base_url('publikasi/addkomentar') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_publikasi" value="<?= $id_publikasi ?>">
                        <div class="form-group">
                            <textarea id="summernote" class="form-control" name="catatan" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div id="commentSection">
                <?php foreach ($Komentar as $komen => $value) : ?>
                    <div class="comment-thread mb-4">
                        <div class="comment-main p-3 bg-light rounded">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0">
                                    <?= $value['pemeriksa'] ?>
                                    <small class="text-muted"><?= $value['tgl_komen_admin'] ?></small>
                                </h5>
                                <div>
                                    <?php if (in_array(session()->get('role'), [1, 3])) : ?>
                                        <label class="switch mr-2">
                                            <input type="checkbox" class="toggle-status" data-id="<?= $value['id_komentar']; ?>" <?= $value['selesai'] == '1' ? 'checked' : '' ?>>
                                            <span class="slider round"
                                                data-toggle="tooltip"
                                                data-status="<?= $value['selesai'] == '1' ? 'sudah_sesuai' : 'belum_sesuai' ?>"
                                                title="<?= $value['selesai'] == '1' ? 'Sudah Sesuai' : 'Belum Sesuai' ?>"></span>
                                        </label>
                                    <?php elseif (in_array(session()->get('role'), [2, 4])) : ?>
                                        <button class="btn btn-sm btn-<?= $value['selesai'] == '1' ? 'success' : 'warning' ?> mr-2 status-btn <?= session()->get('role') == '4' ? 'inactive' : '' ?>"
                                            data-id="<?= $value['id_komentar']; ?>"
                                            data-status="<?= $value['selesai']; ?>"
                                            <?= session()->get('role') == '4' ? 'aria-disabled="true"' : '' ?>>
                                            <?= $value['selesai'] == '1' ? 'Sesuai' : 'Belum Sesuai' ?>
                                        </button>
                                    <?php endif; ?>

                                    <?php if ($value['pemeriksa'] == session()->get('full_name')) : ?>
                                        <?php if (in_array(session()->get('role'), [1, 3])) : ?>
                                            <button class="btn btn-sm btn-primary edit-comment mr-2" data-id="<?= $value['id_komentar']; ?>" data-comment="<?= htmlspecialchars($value['catatan']); ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                        <?php endif; ?>
                                        <?php if (session()->get('role') == '1') : ?>
                                            <form action="<?= base_url('publikasi/deletekomentar/' . $value['id_komentar']) ?>" method="post" class="d-inline-block delete-form">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-danger mr-2">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <button class="btn btn-sm btn-info reply-btn" data-id="<?= $value['id_komentar']; ?>">
                                        <i class="fas fa-reply"></i> Balas
                                    </button>
                                </div>
                            </div>
                            <div class="comment-content">
                                <?= $value['catatan'] ?>
                            </div>
                        </div>

                        <div class="replies ml-4 mt-3">
                            <?php if (!empty($value['replies'])): ?>
                                <?php foreach ($value['replies'] as $reply): ?>
                                    <div class="reply p-3 bg-white rounded mb-2">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0">
                                                <?= $reply['pemeriksa'] ?>
                                                <small class="text-muted"><?= $reply['tgl_reply'] ?></small>
                                            </h6>
                                        </div>
                                        <div class="reply-content">
                                            <?= $reply['catatan'] ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <div class="reply-form-container mt-3" style="display: none;">
                                <form class="reply-form" data-id="<?= $value['id_komentar']; ?>">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="id_komentar" value="<?= $value['id_komentar'] ?>">
                                    <div class="form-group">
                                        <textarea class="form-control" name="catatan" rows="2" required placeholder="Tulis balasan Anda..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                                </form>
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
    <div class="modal-dialog modal-lg" role="document">
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
                        <textarea id="summernote-edit" class="form-control" name="catatan" rows="3" required></textarea>
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
            $('#summernote-edit').summernote('code', comment);
            $('#editCommentModal').modal('show');
        });

        $('#saveEditComment').click(function() {
            var id = $('#edit_comment_id').val();
            var comment = $('#summernote-edit').summernote('code');

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
                success: function(response) {},
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('.status-btn').click(function() {
            if ($(this).hasClass('inactive')) return;

            var id = $(this).data('id');
            var status = $(this).data('status');
            var newStatus = status == 1 ? 0 : 1;
            var newLabel = newStatus == 1 ? 'Sesuai' : 'Belum Sesuai';
            var newClass = newStatus == 1 ? 'btn-success' : 'btn-warning';

            $(this).data('status', newStatus);
            $(this).removeClass('btn-success btn-warning').addClass(newClass);
            $(this).text(newLabel);

            $.ajax({
                url: '<?= base_url('publikasi/updateStatus') ?>',
                type: 'POST',
                data: {
                    id_komentar: id,
                    selesai: newStatus,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success: function(response) {},
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

        $('.reply-btn').click(function() {
            var id = $(this).data('id');
            var replyFormContainer = $(this).closest('.comment-thread').find('.reply-form-container');

            $('.reply-form-container').not(replyFormContainer).hide();

            replyFormContainer.toggle();
        });

        $('.reply-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var id_komentar = form.data('id');

            $.ajax({
                url: '<?= base_url('publikasi/addReply') ?>',
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    form.find('textarea').val('');
                    form.parent().hide();
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        function refreshReplies(id_komentar) {
            $.ajax({
                url: '<?= base_url('publikasi/getReplies') ?>',
                type: 'GET',
                data: {
                    id_komentar: id_komentar
                },
                success: function(response) {
                    $('#replies_' + id_komentar).html(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
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

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:checked+.slider:before {
        transform: translateX(14px);
    }

    .slider.round {
        border-radius: 20px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .comment-thread {
        border-left: 2px solid #007bff;
        padding-left: 15px;
    }

    .comment-main {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .replies {
        margin-left: 20px;
    }

    .reply {
        border: 1px solid #e9ecef;
    }
</style>


<?= $this->endSection() ?>