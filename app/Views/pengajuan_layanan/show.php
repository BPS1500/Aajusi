<!DOCTYPE html>
<html>

<head>
    <title>Detail Pengajuan Layanan TI</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Detail Pengajuan Layanan TI</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">NIP Lama User: <?= $pengajuan['nip_lama_user'] ?></h5>
                <p class="card-text">Jenis Layanan: <?= $pengajuan['jenis_layanan'] ?></p>
                <p class="card-text">Deskripsi Keluhan: <?= $pengajuan['deskripsi_keluhan'] ?></p>
                <p class="card-text">No BMN: <?= $pengajuan['no_bmn'] ?></p>
                <p class="card-text">Status: <?= $pengajuan['status'] ?></p>
                <p class="card-text">Tanggal Pengajuan: <?= $pengajuan['tanggal_pengajuan'] ?></p>
                <p class="card-text">Tanggal Perubahan: <?= $pengajuan['tanggal_perubahan'] ?></p>
                <a href="/pengajuan_layanan_ti/print_receipt/<?= $pengajuan['id'] ?>" class="btn btn-secondary">Cetak Tanda Terima</a>
                <a href="/pengajuan_layanan_ti/add_action/<?= $pengajuan['id'] ?>" class="btn btn-primary">Tambah Aksi</a>
            </div>
        </div>
    </div>
</body>

</html>