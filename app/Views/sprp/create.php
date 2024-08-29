<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h1><?= isset($sprp) ? 'Edit' : 'Tambah' ?> SPRP</h1>
            </div>
        </div>
        <div class="card-body p-4">
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger">
                <?= session('error') ?>
            </div>
            <?php endif; ?>
            <form action="<?= base_url('/sprp/' . (isset($sprp) ? 'update/' . $sprp['id_publikasi'] : 'store')) ?>" method="post" novalidate>
                
                <div class="form-group">
                    <label for="id">Nama Publikasi <span class="text-danger">*</span></label>
                    <select id="id" name="id" class="form-control select2" required>
                        <option value="">Pilih Publikasi</option>
                        <?php foreach ($datapublikasi as $publikasi): ?>
                            <option value="<?= $publikasi['id']; ?>" <?= (isset($sprp) && $sprp['id'] == $publikasi['id']) ? 'selected' : ''; ?>>
                                <?= $publikasi['id']; ?> - <?= $publikasi['judul_publikasi_ind']; ?> - <?= $publikasi['judul_publikasi_eng']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kodewilayah">Wilayah <span class="text-danger">*</span></label>
                            <select id="kodewilayah" name="kodewilayah" class="form-control select" required>
                                <option value="" disabled selected>Pilih Wilayah</option>
                                <?php foreach ($datawilayah as $wilayah): ?>
                                    <option value="<?= $wilayah['kodewilayah']; ?>" <?= (isset($sprp) && $sprp['kodewilayah'] == $wilayah['kodewilayah']) ? 'selected' : ''; ?>>
                                        <?= $wilayah['kodewilayah']; ?> - <?= $wilayah['nama_wilayah']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_kategori">Kategori <span class="text-danger">*</span></label>
                            <select id="id_kategori" name="id_kategori" class="form-control select" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($datakategori as $kategori): ?>
                                    <option value="<?= $kategori['id_kategori']; ?>" <?= (isset($sprp) && $sprp['id_kategori'] == $kategori['id_kategori']) ? 'selected' : ''; ?>>
                                        <?= $kategori['kategori_pub']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jml_romawi">Jumlah Romawi <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Masukan Jumlah Romawi" class="form-control" id="jml_romawi" name="jml_romawi" value="<?= isset($sprp) ? $sprp['jml_romawi'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jml_arab">Jumlah Arab <span class="text-danger">*</span></label>
                            <input type="number" placeholder="Masukan Jumlah Arab" class="form-control" id="jml_arab" name="jml_arab" value="<?= isset($sprp) ? $sprp['jml_arab'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ISBN">ISBN <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Masukan Nomor ISBN" class="form-control" id="ISBN" name="ISBN" value="<?= isset($sprp) ? $sprp['ISBN'] : '' ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kerjasama_instansi">Kerjasama Instansi <span class="text-danger">*</span></label>
                            <input type="text" placeholder="Masukan Kerjasama Instansi" class="form-control" id="kerjasama_instansi" name="kerjasama_instansi" value="<?= isset($sprp) ? $sprp['kerjasama_instansi'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_cover">Pembuat Cover <span class="text-danger">*</span></label>
                            <select id="id_cover" name="id_cover" class="form-control select" required>
                                <option value="">Pilih Pembuat Cover</option>
                                <?php foreach ($datacover as $cover): ?>
                                    <option value="<?= $cover['id_cover']; ?>" <?= (isset($sprp) && $sprp['id_cover'] == $cover['id_cover']) ? 'selected' : ''; ?>>
                                        <?= $cover['pembuat_cover']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_orientasi">Orientasi <span class="text-danger">*</span></label>
                            <select id="id_orientasi" name="id_orientasi" class="form-control select" required>
                                <option value="" disabled selected>Pilih Orientasi</option>
                                <?php foreach ($dataorientasi as $orientasi): ?>
                                    <option value="<?= $orientasi['id_orientasi']; ?>" <?= (isset($sprp) && $sprp['id_orientasi'] == $orientasi['id_orientasi']) ? 'selected' : ''; ?>>
                                        <?= $orientasi['orientasi']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_diterbit">Diterbitkan Untuk <span class="text-danger">*</span></label>
                            <select id="id_diterbit" name="id_diterbit" class="form-control select" required>
                                <option value="" disabled selected>Pilih Diterbitkan Untuk</option>
                                <?php foreach ($dataterbit as $terbit): ?>
                                    <option value="<?= $terbit['id_diterbit']; ?>" <?= (isset($sprp) && $sprp['id_diterbit'] == $terbit['id_diterbit']) ? 'selected' : ''; ?>>
                                        <?= $terbit['diterbitkanuntuk']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_ukuran">Ukuran Kertas <span class="text-danger">*</span></label>
                            <select id="id_ukuran" name="id_ukuran" class="form-control select" required>
                                <option value="" disabled selected>Pilih Ukuran Kertas</option>
                                <?php foreach ($dataukuran as $ukuran): ?>
                                    <option value="<?= $ukuran['id_ukuran']; ?>" <?= (isset($sprp) && $sprp['id_ukuran'] == $ukuran['id_ukuran']) ? 'selected' : ''; ?>>
                                        <?= $ukuran['nama_ukuran']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });
    });

    function validateForm() {
        // Required fields
        const requiredFields = ['kodewilayah', 'id_kategori', 'ISBN', 'jml_arab', 'jml_romawi', 'kerjasama_instansi', 'id_cover', 'id_orientasi', 'id_diterbit', 'id_ukuran', 'id'];
        let isValid = true;

        requiredFields.forEach(function(field) {
            const value = document.getElementById(field).value;
            if (!value) {
                isValid = false;
                document.getElementById(field).classList.add('is-invalid');
            } else {
                document.getElementById(field).classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            alert('Semua kolom yang ditandai dengan * wajib diisi.');
        }

        return isValid; // Return false to prevent form submission if validation fails
    }
    
</script>
