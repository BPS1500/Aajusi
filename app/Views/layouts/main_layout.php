<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags and other head elements -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AAjusi BPS</title>
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
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>

    <!-- Summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        /* Change sidebar background color */
        .main-sidebar {
            background: rgb(39, 0, 93);
            background: linear-gradient(180deg, rgba(39, 0, 93, 1) 25%, rgba(112, 0, 201, 1) 80%, rgba(148, 0, 255, 1) 97%);
            /* Replace with your desired background color */
        }

        /* Change the sidebar link color */
        .main-sidebar .nav-link {
            color: #ffffff !important;
            /* Replace with your desired text color */
        }

        /* Change the sidebar link hover color */
        .main-sidebar .nav-link:hover {
            background-color: dark purple !important;
            /* Replace with your desired hover color */
        }

        /* Active link color */
        .main-sidebar .nav-link.active {
            background-color: #4b4b4b !important;
            /* Replace with your desired active link color */
        }
    </style>
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
                <img width="50px" src="<?= base_url('assets/img/bps.png') ?>" alt="AdminLTE Logo" class="" style="opacity: .8">
                <span class="brand-text font-weight-light">AAJUSI BPS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php
                        // Dapatkan role_id dari sesi
                        $role_id = session()->get('role');

                        // Query untuk mendapatkan menu berdasarkan role_id
                        $db = \Config\Database::connect();
                        $builder = $db->table('role_menu');
                        $builder->select('menus.id, menus.menu_name, menus.menu_link, menus.parent_id');
                        $builder->join('menus', 'menus.id = role_menu.menu_id');
                        $builder->where('role_menu.role_id', $role_id);
                        $menus = $builder->get()->getResult();

                        // Buat array untuk menampung menu
                        $menuArray = [];
                        foreach ($menus as $menu) {
                            $menuArray[$menu->parent_id][] = $menu;
                        }

                        // Dapatkan URL saat ini
                        $currentURL = current_url();

                        // Fungsi untuk menampilkan menu
                        function display_menu($parent_id, $menuArray, $currentURL)
                        {
                            if (isset($menuArray[$parent_id])) {
                                foreach ($menuArray[$parent_id] as $menu) {
                                    $active = ($currentURL == base_url($menu->menu_link)) ? 'active' : '';
                                    if (isset($menuArray[$menu->id])) {
                                        echo '<li class="nav-item has-treeview ' . $active . '">';
                                        echo '<a href="#" class="nav-link ' . $active . '">';
                                        echo '<i class="nav-icon fas fa-list"></i>';
                                        echo '<p>' . $menu->menu_name . '<i class="right fas fa-angle-left"></i></p>';
                                        echo '</a>';
                                        echo '<ul class="nav nav-treeview">';
                                        display_menu($menu->id, $menuArray, $currentURL);
                                        echo '</ul>';
                                        echo '</li>';
                                    } else {
                                        echo '<li class="nav-item">';
                                        echo '<a href="' . base_url($menu->menu_link) . '" class="nav-link ' . $active . '">';
                                        echo '<i class="nav-icon"></i>';
                                        echo '<p>' . $menu->menu_name . '</p>';
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                }
                            }
                        }
                        // Tampilkan menu utama
                        display_menu(NULL, $menuArray, $currentURL);
                        ?>
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

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

    <script>
        $('#summernote-edit').summernote({
            height: 150,
            placeholder: 'Edit your comment here...',
        });
    </script>
</body>

</html>