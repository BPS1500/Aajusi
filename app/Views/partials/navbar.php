<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url('/') ?>" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i> <?= session()->get('full_name') ?> (<?= session()->get('role_name') ?>)
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Switch Role</span>
                <?php foreach (session()->get('roles') as $role) : ?>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('auth/switchRole/' . $role) ?>" class="dropdown-item">
                        <i class="fas fa-user-tag mr-2"></i> <?= session()->get('role_names')[$role] ?>
                    </a>
                <?php endforeach; ?>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('auth/logout') ?>" class="dropdown-item dropdown-footer">Logout</a>
            </div>
        </li>
    </ul>
</nav>