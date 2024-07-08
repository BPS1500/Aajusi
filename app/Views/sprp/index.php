<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Data SPRP</h2>
    <a href="<?= base_url('sprp/create') ?>" class="btn btn-success mb-3">Tambah Data</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Wilayah</th>
                <th>Kategori</th>
                <th>ISBN</th>
                <th>Jml Arab</th>
                <th>Jml Romawi</th>
                <th>Kerjasama Instansi</th>
                <th>Pembuat Cover</th>
                <th>Orientasi</th>
                <th>Diterbitkan Untuk</th>
                <th>Nama Ukuran</th>
                <th>ID Ukuran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sprps as $sprp) : ?>
                <tr>
                    <td><?= $sprp['id_sprp'] ?></td>
                    <td><?= $sprp['kodewilayah'] ?></td>
                    <td><?= $sprp['id_kategori'] ?></td>
                    <td><?= $sprp['ISBN'] ?></td>
                    <td><?= $sprp['jml_arab'] ?></td>
                    <td><?= $sprp['jml_romawi'] ?></td>
                    <td><?= $sprp['kerjasama_instansi'] ?></td>
                    <td><?= $sprp['id_pembuatcover'] ?></td>
                    <td><?= $sprp['orientasi'] ?></td>
                    <td><?= $sprp['diterbitkanuntuk'] ?></td>
                    <td><?= $sprp['nama_ukuran'] ?></td>
                    <td><?= $sprp['id_ukuran'] ?></td>
                    <td>
                        <a href="<?= base_url('sprp/edit/' . $sprp['id_sprp']) ?>" class="btn btn-warning">Edit</a>
                        <a href="<?= base_url('sprp/delete/' . $sprp['id_sprp']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>