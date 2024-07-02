<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengajuan Layanan TI</title>
</head>

<body>
    <h1>Laporan Pengajuan Layanan TI</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <td><?= $pengajuan['id'] ?></td>
        </tr>
        <tr>
            <th>NIP Lama User</th>
            <td><?= $pengajuan['nip_lama_user'] ?></td>
        </tr>
        <tr>
            <th>Jenis Layanan</th>
            <td><?= $pengajuan['jenis_layanan'] ?></td>
        </tr>
        <tr>
            <th>Deskripsi Keluhan</th>
            <td><?= $pengajuan['deskripsi_keluhan'] ?></td>
        </tr>
        <tr>
            <th>No BMN</th>
            <td><?= $pengajuan['no_bmn'] ?></td>
        </tr>
        <tr>
            <th>Deskripsi Keluhan Hardware</th>
            <td><?= $pengajuan['deskripsi_keluhan_hardware'] ?></td>
        </tr>
        <tr>
            <th>Deskripsi Keluhan Software</th>
            <td><?= $pengajuan['deskripsi_keluhan_software'] ?></td>
        </tr>
        <tr>
            <th>Deskripsi Keluhan Lainnya</th>
            <td><?= $pengajuan['deskripsi_keluhan_lainnya'] ?></td>
        </tr>
        <tr>
            <th>Teknisi</th>
            <td><?= $pengajuan['teknisi'] ?></td>
        </tr>
        <tr>
            <th>Status Pengajuan</th>
            <td><?= $pengajuan['status_pengajuan'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Pengajuan</th>
            <td><?= $pengajuan['tanggal_pengajuan'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Perubahan</th>
            <td><?= $pengajuan['tanggal_perubahan'] ?></td>
        </tr>
    </table>
</body>

</html>