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
                            <!-- <textarea id="summernote" class="form-control" id="new_comment" name="catatan" rows="3" required></textarea> -->
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
                                    <?php if (in_array(session()->get('role'), [1, 3])) : ?>
                                        <!-- Toggle Switch untuk roles 1 & 3 -->
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-status" data-id="<?= $value['id_komentar']; ?>" <?= $value['selesai'] == '1' ? 'checked' : '' ?>>
                                            <span class="slider round" 
                                                data-toggle="tooltip" 
                                                data-status="<?= $value['selesai'] == '1' ? 'sudah_sesuai' : 'belum_sesuai' ?>" 
                                                title="<?= $value['selesai'] == '1' ? 'Sudah Sesuai' : 'Belum Sesuai' ?>"></span>
                                        </label>
                                    <?php elseif (in_array(session()->get('role'), [2, 4])) : ?>
                                        <!-- Button untuk roles 2 & 4 -->
                                        <button class="btn btn-sm btn-<?= $value['selesai'] == '1' ? 'success' : 'warning' ?> ml-2 status-btn" 
                                            data-id="<?= $value['id_komentar']; ?>" 
                                            data-status="<?= $value['selesai']; ?>">
                                            <?= $value['selesai'] == '1' ? 'Sesuai' : 'Belum Sesuai' ?>
                                        </button>
                                    <?php endif; ?>

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
                                    
                                    <!-- Reply button -->
                                    <button class="btn btn-sm btn-info reply-btn ml-2" data-id="<?= $value['id_komentar']; ?>">Balas</button>
                                </div>
                            </div>
                        </div>

                        <div id="collapse<?= $value['id_komentar']; ?>" class="collapse <?php if ($value['selesai'] == '0') { echo "show"; } ?>" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <?= $value['catatan'] ?>

                                <!-- Form reply -->
                                <div class="reply-form mt-3" id="reply-form-<?= $value['id_komentar']; ?>" style="display: none;">
                                    <form class="add-reply-form" data-id="<?= $value['id_komentar']; ?>">
                                        <textarea class="form-control" name="reply" rows="2" required></textarea>
                                        <button type="submit" class="btn btn-primary btn-sm mt-2">Kirim</button>
                                    </form>
                                </div>

                                <!-- Replies section -->
                                <div class="replies mt-3" id="replies-<?= $value['id_komentar']; ?>">
                                    <!-- Replies will be loaded here -->
                                </div>
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
                        <textarea id="summernote-edit" class="form-control" id="edit_comment" name="catatan" rows="3" required></textarea>
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
            success: function(response) {
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $('.status-btn').click(function() {
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

    // Toggle reply form
    $('.reply-btn').click(function() {
        var id = $(this).data('id');
        $('#reply-form-' + id).toggle();
    });

    $('.add-reply-form').submit(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var reply = $(this).find('textarea').val();

        $.ajax({
            url: '<?= base_url('publikasi/addReply') ?>',
            type: 'POST',
            data: {
                id_komentar: id,
                catatan: reply,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            success: function(response) {
                if (response.success) {
                    loadReplies(id);
                    $('#reply-form-' + id).find('textarea').val('');
                    $('#reply-form-' + id).hide();
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Failed to submit reply: ' + error);
            }
        });
    });


    function loadReplies(id) {
        $.ajax({
            url: '<?= base_url('publikasi/getReplies') ?>',
            type: 'GET',
            data: { id_komentar: id },
            success: function(response) {
                $('#replies-' + id).html(response);
            }
        });
    }

    $('.replies').each(function() {
        var id = $(this).attr('id').split('-')[1];
        loadReplies(id);
    });

    // Submit reply
    $(document).on('submit', '.add-reply-form', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var reply = $(this).find('textarea[name="reply"]').val();

        $.ajax({
            url: '<?= base_url('publikasi/addReply') ?>',
            type: 'POST',
            data: {
                id_komentar: id,
                catatan: reply,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            success: function(response) {
                alert("tes");
                if (response.success) {
                    loadReplies(id);
                    $('.add-reply-form[data-id="' + id + '"]').find('textarea[name="reply"]').val('');
                    $('#reply-form-' + id).hide();
                } else {
                    alert('Failed to add reply. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
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

.replies {
    margin-left: 20px;
    border-left: 2px solid #ccc;
    padding-left: 10px;
}
</style>

<?= $this->endSection() ?>