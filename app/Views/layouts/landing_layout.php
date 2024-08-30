<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SiNanTI - Sistem Layanan TI'; ?></title>

    <!-- Favicons -->
    <link href="<?= base_url('assets/Bikin/assets/') ?>img/favicon.png" rel="icon">
    <link href="<?= base_url('assets/Bikin/assets/') ?>img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/Bikin/assets/') ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/Bikin/assets/') ?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/Bikin/assets/') ?>vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url('assets/Bikin/assets/') ?>vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/Bikin/assets/') ?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('assets/Bikin/assets/') ?>css/main.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Bikin
    * Template URL: https://bootstrapmade.com/bikin-free-simple-landing-page-template/
    * Updated: Aug 07 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">AAJUSI</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <!-- <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#contact">Hubungi</a></li>
                </ul> -->
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <!-- <div class="header-social-links">
                <a href="https://jambi.bps.go.id/" class="twitter" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-twitter-x"></i>
                </a>
                <a href="https://www.facebook.com/BPSJambi/" class="facebook" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://www.instagram.com/bps_jambi/" class="instagram" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.youtube.com/channel/UCIg5Vi_IlqQ88EWCJ42fh8Q" class="youtube" target="_blank" rel="noopener noreferrer">
                    <i class="bi bi-youtube"></i>
                </a>
            </div> -->

        </div>
    </header>

    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section" style="margin-top: -100px;">
            <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
                <img src="<?php echo base_url() ?>assets/Bikin/assets/img/hero-img.png" class="img-fluid animated" alt="">
                <h1>Selamat datang di <span>AAJUSI</span></h1>
                <p>Aplikasi Pengajuan Publikasi BPS Provinsi Jambi</p>
                <div class="d-flex">
                    <a href="<?php echo base_url('login') ?>" class="btn-get-started scrollto">Mulai Sekarang</a>
                </div>
            </div>
        </section>
        <!-- /Hero Section -->
    </main>

    <footer id="footer" class="footer dark-background">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">

                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Tim Pengembang AAJUSI</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/Bikin/assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/Bikin/assets/') ?>vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url('assets/Bikin/assets/') ?>vendor/aos/aos.js"></script>
    <script src="<?= base_url('assets/Bikin/assets/') ?>vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url('assets/Bikin/assets/') ?>vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url('assets/Bikin/assets/') ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url('assets/Bikin/assets/') ?>vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="<?= base_url('assets/Bikin/assets/') ?>js/main.js"></script>

</body>

</html>