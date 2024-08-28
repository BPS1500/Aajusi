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
            <form action="<?= base_url('/sprp/' . (isset($sprp) ? 'update/' . $sprp['id_sprp'] : 'store')) ?>" method="post">
                <div class="form-group">
                    <label for="id">Nama Publikasi</label>
                    <select id="id" name="id" class="form-control select2">
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
                    <label for="kodewilayah">Wilayah</label>
                        <select id="kodewilayah" name="kodewilayah" class="form-control select">
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
                        <label for="id_kategori">Kategori</label>
                        <select id="id_kategori" name="id_kategori" class="form-control select">
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
                        <label for="jml_romawi">Jumlah Romawi</label>
                        <input type="text" placeholder="Masukan Jumlah Romawi" class="form-control" id="jml_romawi" name="jml_romawi" value="<?= isset($sprp) ? $sprp['jml_romawi'] : '' ?>">
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="jml_arab">Jumlah Arab</label>
                        <input type="number" placeholder="Masukan Jumlah Arab" class="form-control" id="jml_arab" name="jml_arab" value="<?= isset($sprp) ? $sprp['jml_arab'] : '' ?>">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="ISBN">ISBN</label>
                        <input type="text" placeholder="Masukan Nomor ISBN" class="form-control" id="ISBN" name="ISBN" value="<?= isset($sprp) ? $sprp['ISBN'] : '' ?>">
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="kerjasama_instansi">Kerjasama Instansi</label>
                        <input type="text" placeholder="Masukan Kerjasama Instansi" class="form-control" id="kerjasama_instansi" name="kerjasama_instansi" value="<?= isset($sprp) ? $sprp['kerjasama_instansi'] : '' ?>">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_cover">Pembuat Cover</label>
                        <select id="id_cover" name="id_cover" class="form-control select">
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
                        <label for="id_orientasi">Orientasi</label>
                        <select id="id_orientasi" name="id_orientasi" class="form-control select">
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
                        <label for="id_diterbit">Diterbitkan Untuk</label>
                        <select id="id_diterbit" name="id_diterbit" class="form-control select">
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
                        <label for="id_ukuran">Ukuran Kertas</label>
                        <select id="id_ukuran" name="id_ukuran" class="form-control select">
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
</script>
