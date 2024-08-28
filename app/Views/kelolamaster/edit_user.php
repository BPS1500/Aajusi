<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row-4">
            <div class="col-12">
                <form action="<?= site_url('/kelola/pengguna/update/' . $user['id']) ?>" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?= $user['username']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Nama Lengkap</label>
                        <input type="text" id="fullname" name="fullname" class="form-control" value="<?= $user['fullname']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= $user['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nip_lama" class="form-label">NIP Lama</label>
                        <input type="text" id="nip_lama" name="nip_lama" class="form-control" value="<?= $user['nip_lama']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="roles" class="form-label">Roles</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="role1" name="roles[]" value="1" <?= in_array(1, json_decode($user['roles'], true)) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="role1">Super Admin</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="role2" name="roles[]" value="2" <?= in_array(2, json_decode($user['roles'], true)) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="role2">Pemantau/Pimpinan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="role3" name="roles[]" value="3" <?= in_array(3, json_decode($user['roles'], true)) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="role3">BPS Provinsi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="role4" name="roles[]" value="4" <?= in_array(4, json_decode($user['roles'], true)) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="role4">BPS Kabupaten/Kota</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Is Active?</label>
                        <div class="form-check">
                            <input type="checkbox" id="is_active" name="is_active" class="form-check-input" value="1" <?= $user['is_active'] ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
