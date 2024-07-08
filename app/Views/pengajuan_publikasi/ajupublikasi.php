<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <style>
            .required label:after {
                content: " *";
                color: red;
            }
        </style>
        <?php
        session();
        $validation = Config\Services::validation();
        ?>
        <?php echo form_open('Publikasi/InsertData') ?>
        <form>
            <div class="card-body form-group form-group-sm">
                <div class="required">
                    <div class="form-group">
                        <label>Jenis Publikasi</label>
                        <select name="id_jenispublikasi" id="id_jenispublikasi" class="form-control" required>
                            <option value="">--Pilih Jenis Publikasi--</option>
                            <?php foreach ($jenispublikasi as $value) { ?>
                                <option value="<?= $value['id_jenispublikasi'] ?>"><?= $value['jenis_publikasi'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="hidden" id="id_user_upload" name="id_user_upload" value="<?= $_SESSION['nip_lama'] ?>">
                    <div class="form-group">
                        <label>Judul Publikasi</label>
                        <select name="id_judulpublikasi" id="id_judulpublikasi" class="form-control" required>
                            <option value="">--Pilih Judul Publikasi--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fungsi Pengusul</label>
                        <select name="id_fungsi" class="form-control" required>
                            <option value="">--Pilih Fungsi Pengusul--</option>
                            <?php foreach ($fungsi as $key => $value) { ?>
                                <option value="<?= $value['id_fungsi'] ?>"> <?= $value['nama_fungsi'] ?> </option>
                            <?php } ?>
                        </select>
                        <p class="text-danger"><?= $validation->hasError('nama_fungsi') ? $validation->getError('nama_fungsi') : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label>Nama Penyusun</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama Penyusun" name="nama_penyusun" required>
                        <p class="text-danger"><?= $validation->hasError('nama_penyusun') ? $validation->getError('nama_penyusun') : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label>Publikasi</label>
                        <input type="text" class="form-control" placeholder="Masukkan Link Publikasi" name="link_publikasi" required>
                        <p class="text-danger"><?= $validation->hasError('link_publikasi') ? $validation->getError('link_publikasi') : '' ?></p>
                    </div>
                </div>

                <div class="required">
                    <div class="form-group">
                        <label>SPSNR Ketua Tim</label>
                        <input type="text" class="form-control" placeholder="Masukkkan Link SPSNR Ketua TIM" name='link_spsnrkf'>
                        <p class="text-danger"><?= $validation->hasError('link_spsnrkf') ? $validation->getError('link_spsnrkf') : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label>SPSNR Eseleon II</label>
                        <input type="text" class="form-control" placeholder="Masukkkan Link SPSNR Eselon II" name='link_spsnres2'>
                        <p class="text-danger"><?= $validation->hasError('link_spsnres2') ? $validation->getError('link_spsnres2') : '' ?></p>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <?php form_close() ?>
    </div>
    <!-- /.card -->
</div>

<script>
    $(document).ready(function() {
        $("#id_jenispublikasi").change(function(e) {
            var id_jenispublikasi = $("#id_jenispublikasi").val();
            console.log(id_jenispublikasi);
            $.ajax({
                type: 'POST',
                url: "<?= base_url('Publikasi/Judulpublikasi') ?>",
                data: {
                    id_jenispublikasi: id_jenispublikasi
                },
                success: function(response) {
                    $("#id_judulpublikasi").html(response);
                    console.log(response);
                }
            })
        });
    });
</script>
<?= $this->endSection() ?>