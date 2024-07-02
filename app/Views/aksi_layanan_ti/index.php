<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Pengajuan Layanan TI yang Diassign</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama User</th>
                <th>Jenis Layanan</th>
                <th>No BMN</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengajuan_layanan as $item) : ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['nip_lama_user'] ?></td>
                    <td><?= $item['jenis_layanan'] ?></td>
                    <td><?= $item['no_bmn'] ?></td>
                    <td><?= $item['status'] ?></td>
                    <td>
                        <a href="<?= base_url('aksi_layanan_ti/create/' . $item['id']) ?>" class="btn btn-primary">Input Aksi</a>
                        <a href="<?= base_url('aksi_layanan_ti/log/' . $item['id']) ?>" class="btn btn-secondary">Lihat Log</a>
                        <a href="<?= base_url('aksi_layanan_ti/updateStatus/' . $item['id'] . '/Dalam Proses') ?>" class="btn btn-warning">Dalam Proses</a>
                        <a href="<?= base_url('aksi_layanan_ti/updateStatus/' . $item['id'] . '/Selesai') ?>" class="btn btn-success">Selesai</a>
                        <?php if ($item['status'] == 'Selesai') : ?>
                            <a href="<?= base_url('aksi_layanan_ti/printTandaTerima/' . $item['id']) ?>" class="btn btn-info">Print Tanda Terima</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
