<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Pengajuan Layanan TI</h3>
        </div>
        <div class="card-body">
            <form id="formPengajuan" action="<?= base_url('layanan_ti/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="nip_lama_user">NIP Lama User</label>
                    <input type="text" class="form-control" id="nip_lama_user" name="nip_lama_user" value="<?= session()->get('nip_lama') ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="jenis_layanan">Jenis Layanan</label><br>
                    <?php foreach ($jenis_layanan as $layanan) : ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input jenis_layanan_checkbox" type="checkbox" name="jenis_layanan[]" value="<?= $layanan['id'] ?>">
                            <label class="form-check-label"><?= $layanan['nama_layanan'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="form-group">
                    <label for="no_bmn">No BMN</label>
                    <select class="form-control select2" id="no_bmn" name="no_bmn">
                        <?php foreach ($bmn as $item) : ?>
                            <option value="<?= $item['no_bmn'] ?>"><?= $item['no_bmn'] ?> - <?= $item['jenis_perangkat'] ?> - <?= $item['merk'] ?> - <?= $item['tipe'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group deskripsi_keluhan_jaringan" style="display:none;">
                    <label for="deskripsi_keluhan_jaringan">Deskripsi Keluhan Jaringan</label>
                    <textarea class="form-control" id="deskripsi_keluhan_jaringan" name="deskripsi_keluhan_jaringan" rows="3"></textarea>
                </div>

                <div class="form-group deskripsi_keluhan_hardware" style="display:none;">
                    <label for="deskripsi_keluhan_hardware">Deskripsi Keluhan Hardware</label>
                    <textarea class="form-control" id="deskripsi_keluhan_hardware" name="deskripsi_keluhan_hardware" rows="3"></textarea>
                </div>

                <div class="form-group deskripsi_keluhan_software" style="display:none;">
                    <label for="deskripsi_keluhan_software">Deskripsi Keluhan Software</label>
                    <textarea class="form-control" id="deskripsi_keluhan_software" name="deskripsi_keluhan_software" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="keterangan_tambahan">Keterangan Tambahan</label>
                    <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const form = document.getElementById('formPengajuan');
        const checkboxElements = document.querySelectorAll('.jenis_layanan_checkbox');
        const keluhanJaringanElement = document.querySelector('.deskripsi_keluhan_jaringan');
        const keluhanHardwareElement = document.querySelector('.deskripsi_keluhan_hardware');
        const keluhanSoftwareElement = document.querySelector('.deskripsi_keluhan_software');

        const deskripsiKeluhanElements = {
            '1': keluhanJaringanElement,
            '2': keluhanHardwareElement,
            '3': keluhanSoftwareElement
        };

        checkboxElements.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                for (const key in deskripsiKeluhanElements) {
                    deskripsiKeluhanElements[key].style.display = 'none';
                }

                checkboxElements.forEach(cb => {
                    if (cb.checked && deskripsiKeluhanElements[cb.value]) {
                        deskripsiKeluhanElements[cb.value].style.display = 'block';
                    }
                });
            });
        });

        form.addEventListener('submit', (e) => {
            let isValid = true;
            let selectedValues = Array.from(checkboxElements).filter(cb => cb.checked).map(cb => cb.value);

            if (selectedValues.length === 0) {
                alert('Minimal satu jenis layanan harus dipilih.');
                isValid = false;
            }

            selectedValues.forEach(value => {
                const keluhanElement = deskripsiKeluhanElements[value];
                if (keluhanElement && keluhanElement.style.display === 'block') {
                    const textarea = keluhanElement.querySelector('textarea');
                    if (!textarea.value.trim()) {
                        alert('Deskripsi keluhan untuk ' + keluhanElement.querySelector('label').innerText + ' harus diisi.');
                        isValid = false;
                    }
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>

<?= $this->endSection() ?>