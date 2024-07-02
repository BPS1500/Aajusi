<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Tanda Terima Layanan TI</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID Pengajuan</th>
            <td><?= $pengajuan['id'] ?></td>
        </tr>
        <tr>
            <th>Nama User</th>
            <td><?= $pengajuan['nip_lama_user'] ?></td>
        </tr>
        <tr>
            <th>Jenis Layanan</th>
            <td><?= $pengajuan['jenis_layanan'] ?></td>
        </tr>
        <tr>
            <th>No BMN</th>
            <td><?= $pengajuan['no_bmn'] ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= $pengajuan['status'] ?></td>
        </tr>
        <tr>
            <th>Keterangan Tambahan</th>
            <td><?= $pengajuan['keterangan_tambahan'] ?></td>
        </tr>
    </table>
    <button onclick="window.print();" class="btn btn-primary">Print</button>
</div>
<?= $this->endSection() ?>
