<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $judul; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Beranda</a></li>
                    <li class="breadcrumb-item active"><?= $subjudul; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row-4">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header bg-white">
                        <h3 class="card-title">Master Publikasi</h3>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-primary" name="action" value="import">Import</button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahModal">Tambah</button>
                        </div>
                    </div>
                    <table id="usersTable" class="table table-sm table-bordered table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 10%;">Jenis Publikasi</th>
                                <th style="width: 20%;">Judul Publikasi (Indonesia)</th>
                                <th style="width: 20%;">Judul Publikasi (Inggris)</th>
                                <th style="width: 10%;">Frekuensi Terbit</th>
                                <th style="width: 10%;">Bahasa</th>
                                <th style="width: 10%;">No ISSN</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($publikasi as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['id_jenispublikasi'] == 1 ? 'ARC' : ($row['id_jenispublikasi'] == 2 ? 'NON ARC' : 'Unknown') ?></td>
                                <td><?= $row['judul_publikasi_ind'] ?></td>
                                <td><em><?= $row['judul_publikasi_eng'] ?></em></td>
                                <td><?= $row['frekuensi_terbit'] ?></td>
                                <td><?= $row['bahasa'] ?></td>
                                <td><?= $row['no_issn'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal"
                                            data-id="<?= $row['id'] ?>"
                                            data-id_jenispublikasi="<?= $row['id_jenispublikasi'] ?>"
                                            data-judul_publikasi_ind="<?= $row['judul_publikasi_ind'] ?>"
                                            data-judul_publikasi_eng="<?= $row['judul_publikasi_eng'] ?>"
                                            data-frekuensi_terbit="<?= $row['frekuensi_terbit'] ?>"
                                            data-bahasa="<?= $row['bahasa'] ?>"
                                            data-no_issn="<?= $row['no_issn'] ?>">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?= $row['id'] ?>">Hapus</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" method="post">
                <input type="hidden" name="id" id="deleteId" value="">
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus publikasi ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Master Publikasi -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Master Publikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="post">
                <input type="hidden" name="id" id="editId" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editJenisPublikasi">Jenis Publikasi</label>
                        <select name="id_jenispublikasi" id="editJenisPublikasi" class="form-control">
                            <option value="1">ARC</option>
                            <option value="2">NON ARC</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editJudulPublikasiInd">Judul Publikasi (Indonesia)</label>
                        <input type="text" name="judul_publikasi_ind" id="editJudulPublikasiInd" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editJudulPublikasiEng">Judul Publikasi (Inggris)</label>
                        <input type="text" name="judul_publikasi_eng" id="editJudulPublikasiEng" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editFrekuensiTerbit">Frekuensi Terbit</label>
                        <select name="frekuensi_terbit" id="editFrekuensiTerbit" class="form-control">
                            <?php foreach($frekuensi as $freq): ?>
                                <option value="<?= $freq['id_freq'] ?>"><?= $freq['frekuensi_terbit'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editBahasa">Bahasa</label>
                        <select name="bahasa" id="editBahasa" class="form-control">
                            <?php foreach($bahasa as $b): ?>
                                <option value="<?= $b['id_bahasa'] ?>"><?= $b['bahasa'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editNoISSN">No ISSN</label>
                        <input type="text" name="no_issn" id="editNoISSN" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Master Publikasi -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Master Publikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambahForm" method="post" action="<?= base_url('/masterpublikasi/tambah') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambahJenisPublikasi">Jenis Publikasi</label>
                        <select name="id_jenispublikasi" id="tambahJenisPublikasi" class="form-control">
                            <option value="1">ARC</option>
                            <option value="2">NON ARC</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tambahJudulPublikasiInd">Judul Publikasi (Indonesia)</label>
                        <input type="text" name="judul_publikasi_ind" id="tambahJudulPublikasiInd" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tambahJudulPublikasiEng">Judul Publikasi (Inggris)</label>
                        <input type="text" name="judul_publikasi_eng" id="tambahJudulPublikasiEng" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tambahFrekuensiTerbit">Frekuensi Terbit</label>
                        <select name="frekuensi_terbit" id="tambahFrekuensiTerbit" class="form-control">
                            <?php foreach($frekuensi as $freq): ?>
                                <option value="<?= $freq['id_freq'] ?>"><?= $freq['frekuensi_terbit'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tambahBahasa">Bahasa</label>
                        <select name="bahasa" id="tambahBahasa" class="form-control">
                            <?php foreach($bahasa as $b): ?>
                                <option value="<?= $b['id_bahasa'] ?>"><?= $b['bahasa'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tambahNoISSN">No ISSN</label>
                        <input type="text" name="no_issn" id="tambahNoISSN" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#usersTable').DataTable({
        // Your DataTable configurations
    });

    // Fill delete modal with data
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('#deleteId').val(id);
        modal.find('#deleteForm').attr('action', '/masterpublikasi/delete/' + id);
    });

    // Fill edit modal with data
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var id_jenispublikasi = button.data('id_jenispublikasi');
        var judul_publikasi_ind = button.data('judul_publikasi_ind');
        var judul_publikasi_eng = button.data('judul_publikasi_eng');
        var frekuensi_terbit = button.data('frekuensi_terbit');
        var bahasa = button.data('bahasa');
        var no_issn = button.data('no_issn');
        var modal = $(this);
        modal.find('#editId').val(id);
        modal.find('#editJenisPublikasi').val(id_jenispublikasi);
        modal.find('#editJudulPublikasiInd').val(judul_publikasi_ind);
        modal.find('#editJudulPublikasiEng').val(judul_publikasi_eng);
        modal.find('#editFrekuensiTerbit').val(frekuensi_terbit);
        modal.find('#editBahasa').val(bahasa);
        modal.find('#editNoISSN').val(no_issn);
        modal.find('#editForm').attr('action', '/masterpublikasi/edit/' + id);
    });
});
</script>

<?= $this->endSection() ?>