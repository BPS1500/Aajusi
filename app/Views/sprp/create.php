<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1><?= isset($sprp) ? 'Edit' : 'Tambah' ?> SPRP</h1>
    <form action="<?= base_url('/sprp/' . (isset($sprp) ? 'update/' . $sprp['id_publikasi'] : 'store')) ?>" method="post">
        <div class="form-group">
            <label for="id_publikasi">ID Publikasi</label>
            <input type="text" class="form-control" id="id_publikasi" name="id_publikasi" value="<?= isset($sprp) ? $sprp['id_publikasi'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="kodewilayah">Kode Wilayah</label>
            <input type="text" class="form-control" id="kodewilayah" name="kodewilayah" value="<?= isset($sprp) ? $sprp['kodewilayah'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="id_kategori">ID Kategori</label>
            <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="<?= isset($sprp) ? $sprp['id_kategori'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="ISBN">ISBN</label>
            <input type="text" class="form-control" id="ISBN" name="ISBN" value="<?= isset($sprp) ? $sprp['ISBN'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="jml_arab">Jumlah Arab</label>
            <input type="text" class="form-control" id="jml_arab" name="jml_arab" value="<?= isset($sprp) ? $sprp['jml_arab'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="jml_romawi">Jumlah Romawi</label>
            <input type="text" class="form-control" id="jml_romawi" name="jml_romawi" value="<?= isset($sprp) ? $sprp['jml_romawi'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="kerjasama_instansi">Kerjasama Instansi</label>
            <input type="text" class="form-control" id="kerjasama_instansi" name="kerjasama_instansi" value="<?= isset($sprp) ? $sprp['kerjasama_instansi'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="id_pembuatcover">ID Pembuat Cover</label>
            <input type="text" class="form-control" id="id_pembuatcover" name="id_pembuatcover" value="<?= isset($sprp) ? $sprp['id_pembuatcover'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="orientasi">Orientasi</label>
            <input type="text" class="form-control" id="orientasi" name="orientasi" value="<?= isset($sprp) ? $sprp['orientasi'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="diterbitkanuntuk">Diterbitkan Untuk</label>
            <input type="text" class="form-control" id="diterbitkanuntuk" name="diterbitkanuntuk" value="<?= isset($sprp) ? $sprp['diterbitkanuntuk'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="nama_ukuran">Nama Ukuran</label>
            <input type="text" class="form-control" id="nama_ukuran" name="nama_ukuran" value="<?= isset($sprp) ? $sprp['nama_ukuran'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="id_ukuran">ID Ukuran</label>
            <input type="text" class="form-control" id="id_ukuran" name="id_ukuran" value="<?= isset($sprp) ? $sprp['id_ukuran'] : '' ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?= $this->endSection() ?>