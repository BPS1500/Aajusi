<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Data SPRP</h3>
                    <a href="<?= base_url('sprp/create') ?>" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if (empty($sprps)): ?>
                    <div class="alert alert-warning text-center" role="alert">
                        No data available
                    </div>
                <?php else: ?>
                <div class="table-responsive">
                    <table id="sprpTable" class="table table-striped table-bordered">
                        <thead >
                            <tr>
                                <th>No</th>
                                <th>Jenis Publikasi</th>
                                <th>Kode Wilayah</th>
                                <th>Kategori</th>
                                <th>Judul Bahasa Indonesia</th>
                                <th>Judul Bahasa Inggris</th>
                                <th>Katalog</th>
                                <th>Nomor Publikasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sprps as $index => $sprp) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $sprp['jenis_publikasi'] ?></td>
                                    <td><?= $sprp['kodewilayah'] ?></td>
                                    <td><?= $sprp['kategori_pub'] ?></td>
                                    <td><?= $sprp['judul_publikasi_ind'] ?></td>
                                    <td><?= $sprp['judul_publikasi_eng'] ?></td>
                                    <td><?= $sprp['katalog'] ?></td>
                                    <td><?= $sprp['nomor_publikasi'] ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="#" class="btn btn-sm btn-info view-details" 
                                               data-id="<?= $sprp['id_sprp'] ?>" title="Detail">
                                               <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('sprp/edit/' . $sprp['id_sprp']) ?>" 
                                               class="btn btn-sm btn-warning" title="Edit">
                                               <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if (empty($sprp['nomor_publikasi'])) : ?>
                                            <a href="<?= base_url('sprp/delete/' . $sprp['id_sprp']) ?>" 
                                            class="btn btn-sm btn-danger" title="Delete" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Detail SPRP</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <!-- Modal content will be populated here -->
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function() {
    $('#sprpTable').DataTable();

    $('.view-details').on('click', function(event) {
        event.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: '<?= base_url('sprp/get_details/') ?>' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var modal = $('#detailModal');
                var content = `
                     <div class ="row">
                     <div class="col-md-12">
                            <div class="form-group">
                                <label>Nomor Publikasi </label>
                                <input type="text" class="form-control" value="${response.nomor_publikasi}" readonly>
                            </div>
                     </div>
                    </div> 

                    <div class ="row">
                     <div class="col-md-12">
                            <div class="form-group">
                                <label>Jenis Publikasi </label>
                                <input type="text" class="form-control" value="${response.jenis_publikasi}" readonly>
                            </div>
                     </div>
                    </div> 

                    <div class ="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Judul Publikasi (Indonesia)</label>
                                <input type="text" class="form-control" value="${response.judul_publikasi_ind}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Judul Publikasi (English)</label>
                                <input type="text" class="form-control" value="${response.judul_publikasi_eng}" readonly>
                            </div>
                        </div>
                    </div>

                    <div class ="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Katalog</label>
                                <input type="text" class="form-control" value="${response.katalog}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label>Nama Wilayah</label>
                                <input type="text" class="form-control" value="${response.kodewilayah} - ${response.nama_wilayah}" readonly>
                            </div>
                        </div>
                    </div>
               
                
    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kategori Publikasi</label>
                            <input type="text" class="form-control" value="${response.kategori_pub}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                            <label>No. ISSN</label>
                            <input type="text" class="form-control" value="${response.no_issn}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                            <label>No. ISBN</label>
                            <input type="text" class="form-control" value="${response.ISBN}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jumlah Arab</label>
                            <input type="text" class="form-control" value="${response.jml_arab}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jumlah Romawi</label>
                            <input type="text" class="form-control" value="${response.jml_romawi}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kerjasama Instansi</label>
                            <input type="text" class="form-control" value="${response.kerjasama_instansi}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pembuat Cover</label>
                            <input type="text" class="form-control" value="${response.pembuat_cover}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Orientasi</label>
                            <input type="text" class="form-control" value="${response.orientasi}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Diterbitkan Untuk</label>
                            <input type="text" class="form-control" value="${response.diterbitkanuntuk}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ukuran</label>
                            <input type="text" class="form-control" value="${response.nama_ukuran}" readonly>
                        </div>
                    </div>
                </div>
                `;
                modal.find('.modal-body').html(content);
                modal.modal('show');
            },
            error: function() {
                alert('Data tidak dapat diambil.');
            }
        });
    });
});
</script>

<style>
    .btn-group .btn i {
        margin-right: 3px;
    }
    .btn-group .btn {
        margin-right: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    .btn-group .btn:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>

<?= $this->endSection() ?>
