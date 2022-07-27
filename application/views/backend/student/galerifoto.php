<link href="<?= base_url(); ?>assets/landing-page/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>assets/landing-page/vendor/venobox/venobox.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="<?= base_url(); ?>assets/landing-page/css/style.css" rel="stylesheet">

<style type="text/css">
    .portfolio .portfolio-wrap:hover .portfolio-links {
        opacity: 1;
        bottom: calc(50% - 35px) !important;
    }

    .portfolio-links-top {
        left: 0;
        right: 0;
        text-align: center;
        z-index: 3;
        position: absolute;
        transition: all ease-in-out 0.3s;
        opacity: 1;
        top: -10px;
        font-size: 20px;
        opacity: 0;
    }

    .portfolio .portfolio-wrap:hover .portfolio-links-top {
        top: calc(10px);
        opacity: 1;
    }

    .portfolio-links-top a {
        color: #dddddd;
    }

    .portfolio-links-top a:hover {
        color: #ffffff;
    }
</style>


<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$id_kategori = base64_decode($kategori);
?>
<div class="content-w">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="conty">
        <div class="os-tabs-w menu-shad">
            <div class="os-tabs-controls">
                <ul class="navs navs-tabs">
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url(); ?>student/noticeboard/"><i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i> <span>Berita</span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links active" href="<?php echo base_url(); ?>student/galeri/"><i class="picons-thin-icon-thin-0618_album_picture_image_photo"></i> <span>Galery</span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url(); ?>student/blog/"><i class="picons-thin-icon-thin-0075_document_file_paper_text_article_blog_template"></i> <span>Blog</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-i">
            <div class="content-box">
                <div class="back" style="margin-top:-20px;margin-bottom:10px">
                    <a href="<?php echo base_url(); ?>student/galeri/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
                </div>
                <h5 class="form-header"><?= $this->db->get_where('kategori', array('id_kategori' => $id_kategori))->row()->nama; ?></h5>
                <hr />

                <div class="portfolio">
                    <div class="row portfolio-container">
                        <?php
                        $galeri = $this->db->get_where('galeri', array('id_kategori' => $id_kategori))->result_array();
                        foreach ($galeri as $data) :
                        ?>
                            <div class="col col-xl-3 col-lg-3 col-md-6 col-sm-6 portfolio-item filter-iht">
                                <div class="portfolio-wrap">
                                    <img src="<?= $data['gambar'] ?>" data-src="<?= $data['gambar'] ?>" class="lazy img-fluid" alt="" width="500" height="400">
                                    <div class="portfolio-links">
                                        <a href="<?= $data['gambar'] ?>" data-gall="portfolioGallery" class="venobox" title=""><i class="bx bx-zoom-in"></i></a>
                                    </div>
                                    <!-- <div class="portfolio-links-top" style="text-align: right;">
                                    <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_galeri/<?php echo $data['id_galeri']; ?>');"><i style="font-size:20px;" class="picons-thin-icon-thin-0001_compose_write_pencil_new" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit'); ?>"></i></a>
                                    <a href="<?php echo base_url(); ?>student/galerifotos/delete/<?= $data['id_galeri']; ?>/<?= $data['id_kategori']; ?>" class="delete"><i style="font-size:20px;" class="picons-thin-icon-thin-0057_bin_trash_recycle_delete_garbage_full" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete'); ?>"></i></a>
                                </div> -->
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url(); ?>assets/landing-page/vendor/counterup/counterup.min.js"></script>
<script src="<?= base_url(); ?>assets/landing-page/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url(); ?>assets/landing-page/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url(); ?>assets/landing-page/vendor/venobox/venobox.min.js"></script>
<script src="<?= base_url(); ?>assets/landing-page/vendor/aos/aos.js"></script>
<script src="<?= base_url(); ?>assets/landing-page/vendor/lazyload/lazyload.min.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url(); ?>assets/landing-page/js/main.js"></script>