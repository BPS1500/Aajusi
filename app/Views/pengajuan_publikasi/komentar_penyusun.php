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
                                <?php if ($value['selesai'] == '0') : ?>
                                    <a href="#" class="btn btn-danger btn-sm">Belum Sesuai</a>
                                <?php else : ?>
                                    <a href="#" class="btn btn-success btn-sm">Sesuai</a>
                                <?php endif; ?>

                                <?php if ($value['pemeriksa'] == session()->get('full_name')) : ?>
                                    <button class="btn btn-sm btn-primary edit-comment ml-2" data-id="<?= $value['id_komentar']; ?>" data-comment="<?= htmlspecialchars($value['catatan']); ?>">Edit</button>
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
});
</script>

<?= $this->endSection() ?>