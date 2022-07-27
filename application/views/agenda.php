<?php
include('header.php');
include('go2hi.php');
?>


<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Informasi Agenda</h2>
                <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>Informasi Agenda</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <section id="agenda" class="portfolio-details">
        <div class="container" data-aos="fade-up">

            <div class="portfolio-description">
                <h5 style="font-weight: bold; text-align:center">Agenda Mendatang</h5><br /><br />
            </div>
            <?php
            $tanggal = date('Y-m-d H:i:s');
            $this->db->order_by('start', 'ASC');
            $this->db->where('start >', $tanggal);
            $events = $this->db->get('events')->result_array();
            foreach ($events as $event) :
            ?>
                <div class="col-md-11">
                    <ul class="cbp_tmtimeline">
                        <li>
                            <time class="cbp_tmtime" datetime="2017-11-04T03:45"><span><?= date('d F Y', strtotime($event['start'])); ?></span> <span style="font-size: 14px;"><?php echo \go2hi\go2hi::date('d F Y', 1, strtotime($event['start'])); ?> H</span> <span>Mulai : <?= date('H:i', strtotime($event['start'])); ?> WIB s.d Selesai</span></time>
                            <div class="cbp_tmicon" style="background-color: <?= $event['color'] ?>;"><i class="zmdi zmdi-calendar-note"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);"><?= $event['title'] ?></a></h2>
                                <p><?= $event['deskripsi'] ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php endforeach; ?>

        </div>
    </section>
    <!-- End #main -->

    <?php include('footer.php'); ?>