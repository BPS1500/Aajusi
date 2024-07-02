<!DOCTYPE html>
<html>

<head>
    <title>Tambah Aksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Aksi</h1>
        <form action="/pengajuan_layanan_ti/addAction/<?= $pengajuan['id'] ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="deskripsi_aksi">Deskripsi Aksi</label>
                <textarea class="form-control" id="deskripsi_aksi" name="deskripsi_aksi" required></textarea>
            </div>
            <div class="form-group">
                <label for="biaya_penanganan">Biaya Penanganan</label>
                <input type="number" class="form-control" id="biaya_penanganan" name="biaya_penanganan" required>
            </div>
            <div class="form-group">
                <label for="kwitansi">Upload Kwitansi</label>
                <input type="file" class="form-control-file" id="kwitansi" name="kwitansi">
            </div>
            <div class="form-group">
                <label for="dokumentasi">Upload Dokumentasi</label>
                <input type="file" class="form-control-file" id="dokumentasi" name="dokumentasi">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>