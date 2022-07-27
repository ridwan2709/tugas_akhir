<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Homeschooling Permata Hati</title>
    <meta content="Homeschooling Permata Hati" name="tittle">
    <meta content="Homeschooling Permata Hati merupakan lembaga pendidikan alternatif yang saat ini menjadi salah satu pilihan orang tua dan masyarakat pada umumnya, yang dikelola secara profesional dan proporsional yang berorientasi pada pembentukan karakter serta minat bakat anak dibawah asuhan Yayasan Indonesia Satu Hati" name="description">
    <meta content="Sekolah, Lembaga Pendidikan, Aplikasi Sekolah, Sukabumi, Homeschooling, Homeschooling Sukabumi, Homeschooling Permata Hati, HSPH, HS" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'favicon'))->row()->description; ?>" rel="icon">

    <!-- Agenda -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <!-- Greating Holiday -->
    <link rel="stylesheet" id="wp-block-library-css" href="assets/landing-page/greating/style_002.css" media="all">
    <link rel="stylesheet" id="wp-block-library-theme-css" href="assets/landing-page/greating/theme.css" media="all">
    <link rel="stylesheet" id="wdp-centered-css-css" href="assets/landing-page/greating/wdp-centered-timeline.css" media="all">
    <link rel="stylesheet" id="wdp-horizontal-css-css" href="assets/landing-page/greating/wdp-horizontal-styles.css" media="all">
    <link rel="stylesheet" id="wdp-fontello-css-css" href="assets/landing-page/greating/wdp-fontello.css" media="all">
    <!-- <link rel="stylesheet" id="twenty-twenty-one-style-css" href="assets/landing-page/greating/style.css" media="all"> -->
    <link rel="stylesheet" id="twenty-twenty-one-print-style-css" href="assets/landing-page/greating/print.css" media="print">
    <link rel="stylesheet" id="elementor-icons-css" href="assets/landing-page/greating/elementor-icons.css" media="all">
    <link rel="stylesheet" id="elementor-animations-css" href="assets/landing-page/greating/animations.css" media="all">
    <link rel="stylesheet" id="elementor-frontend-css" href="assets/landing-page/greating/frontend.css" media="all">
    <link rel="stylesheet" id="elementor-post-5-css" href="assets/landing-page/greating/post-5.css" media="all">
    <!-- <link rel="stylesheet" id="weddingpress-wdp-css" href="assets/landing-page/greating/wdp.css" media="all"> -->
    <link rel="stylesheet" id="elementor-global-css" href="assets/landing-page/greating/global.css" media="all">
    <link rel="stylesheet" id="elementor-post-7-css" href="assets/landing-page/greating/post-7.css" media="all">
    <link rel="stylesheet" id="google-fonts-1-css" href="assets/landing-page/greating/css.css" media="all">
    <link rel="stylesheet" id="toastify-css" href="assets/landing-page/toastify/css/toastify.min.css" media="all">
    <link rel="stylesheet" id="toastify-css" href="assets/landing-page/toastify/css/popup.css" media="all">
    <!-- animate -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" media="all" rel="stylesheet">
    <script src="assets/landing-page/greating/jquery.js" id="jquery-core-js"></script>
    <style>
        .recentcomments a {
            display: inline !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>/assets/landing-page/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/landing-page/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/landing-page/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/landing-page/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/landing-page/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/landing-page/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/landing-page/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Counter -->
    <script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
    <!-- instascan -->
    <script src="<?php echo base_url(); ?>assets/instascan.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        });
    </script>

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>/assets/landing-page/css/style.css?20200103" rel="stylesheet">

    <!-- Sweet Alert File -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<body>

    <!-- Bottom Navbar -->
    <nav class="navbar-dark border-top navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom" style="background: #ffffff;">

        <div id="mySidenav" class="sidenav">
            <!-- <a class="nav-link scrollto" href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
            <a class="nav-link scrollto" href="<?= base_url('/#hero') ?>" onclick="closeNav()">Beranda</a>
            <a class="nav-link scrollto" href="<?= base_url('/#about') ?>" onclick="closeNav()">Prakata</a>
            <a class="nav-link scrollto" href="<?= base_url('/#services') ?>" onclick="closeNav()">Layanan</a>
            <a class="nav-link scrollto" href="<?= base_url('/#features') ?>" onclick="closeNav()">Fitur Aplikasi</a>
            <a class="nav-link scrollto" href="<?= base_url('/#portfolio') ?>" onclick="closeNav()">Galeri</a>
            <a class="nav-link scrollto" href="<?= base_url('/blog') ?>" onclick="closeNav()">Artikel</a>
            <a class="nav-link scrollto" href="<?= base_url('/#team') ?>" onclick="closeNav()">Tim Manajemen</a>
            <a class="nav-link scrollto" href="<?= base_url('/#contact') ?>" onclick="closeNav()">Kontak</a>
            <a class="nav-link scrollto" href="<?= base_url('/pdb') ?>" onclick="closeNav()">Informasi Pendaftaran</a>
            <a class="nav-link scrollto" href="<?= base_url('/rapor') ?>" onclick="closeNav()">Cek Rapor</a>
        </div>

        <ul class="navbar-nav nav-justified w-100">
            <?php
            $type = $this->session->userdata('login_type');
            if ($type == 'admin' || $type == 'teacher' || $type == 'student' || $type == 'parent' || $type == 'accountant' || $type == 'librarian') {
            ?>
                <li class="nav-item">
                    <a onclick="openNav()" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#444444" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg>
                        <p class="m-0" style="color: #444444; font-size: 12px">Menu</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="<?= base_url('#portfolio') ?>" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#444444" class="bi bi-images" viewBox="0 0 16 16">
                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                        </svg>
                        <p class="m-0" style="color: #444444; font-size: 12px">Galeri</p>
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                    if ($type == 'admin') {
                        $login = explode(' ', trim($this->crud_model->get_name('admin', $this->session->userdata('login_user_id'))));
                        $link = base_url('/admin/library');
                    } elseif ($type == 'teacher') {
                        $login = explode(' ', trim($this->crud_model->get_name('teacher', $this->session->userdata('login_user_id'))));
                        $link = base_url('/teacher/library');
                    } elseif ($type == 'parent') {
                        $login = explode(' ', trim($this->crud_model->get_name('parent', $this->session->userdata('login_user_id'))));
                        $link = base_url('/parents/library');
                    } elseif ($type == 'student') {
                        $login = explode(' ', trim($this->crud_model->get_name('student', $this->session->userdata('login_user_id'))));
                        $link = base_url('/student/library');
                    } else {
                        $login = explode(' ', trim('Login'));
                        $link = base_url('');
                    }
                    ?>
                    <a href="<?= $link ?>" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#444444" class="bi bi-journals" viewBox="0 0 16 16">
                            <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z" />
                            <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z" />
                        </svg>
                        <p class="m-0" style="color: #444444; font-size: 12px"><?php echo "Perpustakaan"; ?></p>
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                    if ($type == 'admin') {
                        $login = explode(' ', trim($this->crud_model->get_name('admin', $this->session->userdata('login_user_id'))));
                        $link = base_url('/admin/notifications');
                    } elseif ($type == 'teacher') {
                        $login = explode(' ', trim($this->crud_model->get_name('teacher', $this->session->userdata('login_user_id'))));
                        $link = base_url('/teacher/notifications');
                    } elseif ($type == 'parent') {
                        $login = explode(' ', trim($this->crud_model->get_name('parent', $this->session->userdata('login_user_id'))));
                        $link = base_url('/parents/notifications');
                    } elseif ($type == 'student') {
                        $login = explode(' ', trim($this->crud_model->get_name('student', $this->session->userdata('login_user_id'))));
                        $link = base_url('/student/notifications');
                    } elseif ($type == 'accountant') {
                    } else {
                        $login = explode(' ', trim('Login'));
                        $link = base_url('/login');
                    }
                    ?>
                    <div class="label-avatar bg-danger">!<?php echo $fancy_notify; ?></div>
                    <a href="<?= $link ?>" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#444444" class="bi bi-bell" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                        </svg>
                        <p class="m-0" style="color: #444444; font-size: 12px"><?php echo "Notifikasi"; ?></p>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item">
                    <a onclick="openNav()" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#444444" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg>
                        <p class="m-0" style="color: #444444; font-size: 12px">Menu</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="https://play.google.com/store/apps/details?id=com.homeschooling.permatahati" class="nav-link">
                        <img src="<?= base_url('assets/landing-page/img/playstore.png') ?>" width="25" height="25" />
                        <p class="m-0" style="color: #444444; font-size: 12px">Download</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/pdb') ?>" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#444444" class="bi bi-info-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                        <p class="m-0" style="color: #444444; font-size: 12px">Persyaratan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://wa.wizard.id/d5c46e" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#128C7E" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                        </svg>
                        <p class="m-0" style="color: #128C7E; font-size: 12px">Whatsapp</p>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>
    <!-- End of Bottom Navbar -->

    <!-- ======= Header ======= -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>

            <div class="indicator">
                <svg width="16px" height="12px">
                    <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo"><a href="<?= base_url() ?>"><img src="<?= base_url() ?>/assets/landing-page/img/logo.png" class="img-fluid" alt=""></a></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.php" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar d-none d-lg-block" style="padding-top: 20px;">
                <ul style="text-shadow: 1px 0.5px #ffffff;">
                    <li><a class="nav-link scrollto" href="<?= base_url('/#hero') ?>">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('/#portfolio') ?>">Galeri</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('/#blog') ?>">Artikel</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('/pdb') ?>#pdb">Informasi Pendaftaran</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('/#rapor') ?>">Cek Rapor</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('/#testimonials') ?>">Testimoni</a></li>
                    <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="./#contact">Contact</a></li> -->
                    <!-- <li><a class="getstarted scrollto" href="./#about">Login</a></li> -->
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
            <?php
            $type = $this->session->userdata('login_type');
            if ($type == 'admin') {
                $login = explode(' ', trim($this->crud_model->get_name('admin', $this->session->userdata('login_user_id'))));
                $link = base_url('/admin/tablero');
            } elseif ($type == 'teacher') {
                $login = explode(' ', trim($this->crud_model->get_name('teacher', $this->session->userdata('login_user_id'))));
                $link = base_url('/teacher/panel');
            } elseif ($type == 'parent') {
                $login = explode(' ', trim($this->crud_model->get_name('parent', $this->session->userdata('login_user_id'))));
                $link = base_url('/parents/panel');
            } elseif ($type == 'student') {
                $login = explode(' ', trim($this->crud_model->get_name('student', $this->session->userdata('login_user_id'))));
                $link = base_url('/student/panel');
            } else {
                $login = explode(' ', trim('Login'));
                $link = base_url('/login');
            }
            ?>

            <a class="view-more-btn" href="<?= $link ?>"><?php echo "$login[0] $login[1]"; ?></a>

        </div>
    </header><!-- End Header -->