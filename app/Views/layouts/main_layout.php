<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags and other head elements -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/AdminLTE/plugins/select2/css/select2.min.css') ?>"> <!-- Select2 CSS -->
    <!-- Load jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Load DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
</head>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?= $this->include('partials/navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('/') ?>" class="brand-link">
                <img src="<?= base_url('assets/AdminLTE/dist/img/BPSAdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AAJUSI BPS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('assets/AdminLTE/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= session()->get('full_name') ?></a>
                        <p class="d-block text-muted"><?= session()->get('role_name') ?></p>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url('/dashboard') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashbor
                                </p>
                            </a>
                        </li>

                        <!-- Layanan TI -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-network-wired"></i>
                                <p>
                                    Publikasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('/Publikasi') ?>" class="nav-link">
                                        <i class="far fa-eye"></i>
                                        <p>Status Pengajuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('/Publikasi/ajupublikasi') ?>" class="nav-link">
                                        <i class="far fa-eye"></i>
                                        <p>Pengajuan Publikasi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('/dashboard') ?>" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Panduan
                                </p>
                            </a>
                        </li>

                        <!-- Settings (Only for Admin) -->
                        <?php if (in_array('admin', session()->get('roles'))) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('/pengaturan') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Pengaturan
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Add more menu items here as needed -->
                        <!-- <li class="nav-item">
                            <a href="<?= base_url('/another_menu') ?>" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Another Menu
                                </p>
                            </a>
                        </li> -->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $this->renderSection('content') ?>
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <?= $this->include('partials/footer') ?>
        <!-- /.footer -->

    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <script src="<?= base_url('assets/AdminLTE/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/AdminLTE/dist/js/adminlte.min.js') ?>"></script>


    <script src="<?= base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/AdminLTE/plugins/select2/js/select2.min.js') ?>"></script> <!-- Select2 JS -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#pengajuanTable').DataTable();

            $('#detailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var user = button.data('user');
                var jenisLayanan = button.data('jenis-layanan');
                var noBMN = button.data('nobmn');
                var merk = button.data('merk');
                var tipe = button.data('tipe');
                var status = button.data('status');
                var deskripsiJaringan = button.data('jaringan');
                var deskripsiHardware = button.data('hardware');
                var deskripsiSoftware = button.data('software');
                var deskripsiLainnya = button.data('lainnya');
                var keterangan = button.data('keterangan');
                var namaTeknisi = button.data('nama-teknisi');
                var namaPihakKetiga = button.data('nama-pihak-ketiga');

                var modal = $(this);
                modal.find('#modalUser').text(user);
                modal.find('#modalJenisLayanan').text(jenisLayanan);
                modal.find('#modalNoBMN').text(noBMN);
                modal.find('#modalMerk').text(merk);
                modal.find('#modalTipe').text(tipe);
                modal.find('#modalStatus').text(status);
                modal.find('#modalDeskripsiJaringan').text(deskripsiJaringan);
                modal.find('#modalDeskripsiHardware').text(deskripsiHardware);
                modal.find('#modalDeskripsiSoftware').text(deskripsiSoftware);
                modal.find('#modalDeskripsiLainnya').text(deskripsiLainnya);
                modal.find('#modalKeterangan').text(keterangan);
                modal.find('#modalNamaTeknisi').text(namaTeknisi);
                modal.find('#modalNamaPihakKetiga').text(namaPihakKetiga);
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#tabel_publikasi').DataTable({
                language: {
                    search: "Pencarian:",
                    lengthMenu: "_MENU_  Data per Halaman",
                    page: "Halaman",
                    info: "Menampilkan Halaman _PAGE_ dari _PAGES_"

                }
            });
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
            $('#tblmasterpub').DataTable({
                language: {
                    search: "Pencarian:",
                    lengthMenu: "_MENU_  Data per Halaman",
                    page: "Halaman",
                    info: "Menampilkan Halaman _PAGE_ dari _PAGES_"

                }
            });
        });
    </script>
</body>

</html>