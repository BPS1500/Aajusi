<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Dashboard'; ?></title>
    <link rel="stylesheet" href="<?= base_url('AdminLTE/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Profile Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        <span class="pl-2"><?= session()->get('full_name'); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- Switch Role Dropdown Item -->
                        <div class="dropdown-divider"></div>
                        <?php foreach (session()->get('role_names') as $roleId => $roleName) : ?>
                            <a href="<?= base_url('auth/switchRole/' . $roleId); ?>" class="dropdown-item">
                                <i class="fas fa-exchange-alt mr-2"></i> <?= $roleName; ?>
                            </a>
                        <?php endforeach; ?>
                        <!-- Logout Dropdown Item -->
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('full_name'); ?></a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <?= $this->renderSection('content'); ?>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.5
            </div>
            <strong>Copyright &copy; 2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>

    <script src="<?= base_url('plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('AdminLTE/js/adminlte.min.js'); ?>"></script>
</body>

</html>