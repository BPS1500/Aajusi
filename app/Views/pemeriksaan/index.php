<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Pemeriksaan Data SPRP</h3>
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
                        <thead class="thead-white">
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
                                        <a href="#" class="btn btn-sm btn-primary input-no-pub" 
                                            data-id="<?= $sprp['id_sprp'] ?>" 
                                            title="Input">
                                            <i class="fas fa-keyboard"></i> Input No. Pub
                                        </a>
                                        <a href="<?= base_url('sprp/delete/' . $sprp['id_sprp']) ?>" 
                                               class="btn btn-sm btn-danger" title="Delete" 
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                               <i class="fas fa-trash-alt"></i>
                                        </a>
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

<!-- Detail SPRP Modal -->
<div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg"  role="document">
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

<!-- Input No Publikasi Modal -->
<div id="inputModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="inputModalLabel">Input Nomor Publikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="inputForm" class="needs-validation" novalidate>
                    <input type="hidden" id="sprpId" name="id">
                    <div class="form-group">
                        <label for="inputNoPublikasi" class="font-weight-bold">Nomor Publikasi</label>
                        <input type="text" class="form-control" id="inputNoPublikasi" name="no_publikasi" placeholder="Masukkan Nomor Publikasi" required>
                        <div class="invalid-feedback">
                            Silakan masukkan nomor publikasi yang valid.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Close
                </button>
                <button type="button" class="btn btn-success" id="saveButton">
                    <i class="fas fa-save"></i> Save
                </button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // DataTable initialization
    $('#sprpTable').DataTable();

    // Show input modal
    $('.input-no-pub').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        // Store the id in a hidden input field
        $('#sprpId').val(id);
        $('#inputNoPublikasi').val('');
        $('#inputModal').modal('show');
    });

    // Save input nomor publikasi
    $('#saveButton').on('click', function() {
    var formData = $('#inputForm').serialize(); // Serialize the form data

    $.ajax({
        url: '<?= base_url('pemeriksaan/store_nomor_publikasi') ?>', // Correct route to store nomor publikasi
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                $('#inputModal').modal('hide');
                alert(response.message);
                location.reload(); // Reload page to reflect changes
            } else {
                alert('Gagal menyimpan Nomor Publikasi: ' + response.message);
            }
        },
        error: function() {
            alert('Terjadi kesalahan saat mengirim data.');
        }
    });
});
    // View details
    $('.view-details').on('click', function(event) {
        event.preventDefault();
        var id_sprp = $(this).data('id');

        // Perform an AJAX request to fetch the data
        $.ajax({
            url: '<?= base_url('pemeriksaan/get_details/') ?>' + id_sprp,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
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
                    modal.modal('show'); // Show the modal
                }
            },
            error: function() {
                alert('Data tidak dapat diambil.');
            }
        });
    });
});
</script>

<style>
    .btn-group .btn {
        margin-right: 5px;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    .btn-group .btn i {
        margin-right: 3px;
    }
    .btn-group .btn:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>

<?= $this->endSection() ?>
