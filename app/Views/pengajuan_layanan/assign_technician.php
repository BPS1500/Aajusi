<!DOCTYPE html>
<html>

<head>
    <title>Assign Teknisi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Assign Teknisi</h1>
        <form action="/pengajuan_layanan_ti/saveTechnicianAssignment/<?= $pengajuan['id'] ?>" method="post">
            <div class="form-group">
                <label for="nip_lama_eksekutor">NIP Lama Teknisi</label>
                <input type="text" class="form-control" id="nip_lama_eksekutor" name="nip_lama_eksekutor" required>
            </div>
            <button type="submit" class="btn btn-primary">Assign</button>
        </form>
    </div>
</body>

</html>