<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $judul; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Beranda</a></li>
                    <li class="breadcrumb-item active"><?= $subjudul; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row-4">
            <div class="col-12">
                <a href="<?= site_url('/kelola/create') ?>" class="btn btn-primary mb-3" style="margin-top: -1rem;">Tambah Pengguna</a>
                 <table id="usersTable" class="table table-sm table-bordered table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIP Lama</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $key => $user): ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= esc($user['username']) ?></td>
                            <td><?= esc($user['fullname']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td><?= esc($user['nip_lama']) ?></td>
                            <td>
                                <ul class="list-unstyled">
                                    <?php foreach ($user['roles'] as $role): ?>
                                        <li><?= $role ?>,</li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                            <td><?= $user['is_active'] ? 'Active' : 'Inactive' ?></td>
                            <td><?= esc($user['created_at']) ?></td>
                            <td><!-- Add action buttons here --></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#usersTable').DataTable();
    });
</script>

<?= $this->endSection(); ?>
