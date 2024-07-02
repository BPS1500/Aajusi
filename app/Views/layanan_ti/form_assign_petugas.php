<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Assign Petugas</h1>
            <div class="card mb-3">
                <div class="card-header">
                    <h3>Detail Pengajuan</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">Nama User</th>
                                <td>
                                    <?php
                                    foreach ($users as $user) {
                                        if ($user['nip_lama'] == $pengajuan['nip_lama_user']) {
                                            echo $user['fullname'];
                                            break;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Layanan</th>
                                <td>
                                    <?php
                                    $jenisLayananArray = json_decode($pengajuan['jenis_layanan']);
                                    foreach ($jenisLayananArray as $jenisLayananId) {
                                        foreach ($jenis_layanan as $layanan) {
                                            if ($layanan['id'] == $jenisLayananId) {
                                                echo $layanan['nama_layanan'] . '<br>';
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">No BMN</th>
                                <td><?= $pengajuan['no_bmn'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Perangkat</th>
                                <td><?= $bmn['jenis_perangkat'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Merk</th>
                                <td><?= $bmn['merk'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tipe</th>
                                <td><?= $bmn['tipe'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td><?= $pengajuan['status'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi Keluhan Jaringan</th>
                                <td><?= $pengajuan['deskripsi_keluhan_jaringan'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi Keluhan Hardware</th>
                                <td><?= $pengajuan['deskripsi_keluhan_hardware'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi Keluhan Software</th>
                                <td><?= $pengajuan['deskripsi_keluhan_software'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi Keluhan Lainnya</th>
                                <td><?= $pengajuan['deskripsi_keluhan_lainnya'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Keterangan Tambahan</th>
                                <td><?= $pengajuan['keterangan_tambahan'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <form action="<?= base_url('/layanan_ti/assign_store/' . $pengajuan['id']) ?>" method="post">
                <div class="form-group">
                    <label for="nip_lama_teknisi">Teknisi</label>
                    <select name="nip_lama_teknisi" id="nip_lama_teknisi" class="form-control">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['nip_lama'] ?>"><?= $user['fullname'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_pihak_ketiga">Pihak Ketiga</label>
                    <select name="id_pihak_ketiga" id="id_pihak_ketiga" class="form-control">
                        <option value="">-- Pilih Pihak Ketiga --</option>
                        <?php foreach ($pihak_ketiga as $pihak) : ?>
                            <option value="<?= $pihak['id'] ?>"><?= $pihak['nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_pihak_ketiga">Atau Tambahkan Pihak Ketiga Baru</label>
                    <input type="text" name="nama_pihak_ketiga" id="nama_pihak_ketiga" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Assign</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>