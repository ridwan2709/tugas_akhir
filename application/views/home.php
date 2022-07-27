<?php include('header.php');

$status = $this->db->get_where('settings', array('type' => 'lp_status'))->row()->description;

if ($status == 'deactivate') { ?>
  <!-- ======= Hero Section ======= -->
  <div class="waves-bacground">
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
      <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
      </defs>
      <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255, 255, 255,0.7)" />
        <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255, 255, 255,0.5)" />
        <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255, 255, 255,0.3)" />
        <use xlink:href="#gentle-wave" x="48" y="7" fill="rgb(255, 255, 255)" />
      </g>
    </svg>
  </div>
  <!-- Hero Slider -->
  <section id="hero" class="d-flex align-items-center hero_backgraound-color-yellow slide-1">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center costume-ruang">
          <h2>Selamat Datang di</h2>
          <h1>
            <strong>Homeschooling<br /></strong>
            <span class="font-semibold">Permata Hati</span>
          </h1>
          <div><a href="#about" class="bx bx-chevron-down animation-up-down scrollto" style="font-size: 50px; color: #22214a"></a></div>
        </div>
        <div class="col-xl-4 col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="150">
          <img src="assets/landing-page/img/slider/Header-Fun.png" class="img-fluid hero-img-samping" alt="">
        </div>
      </div>
    </div>
  </section>
  <section id="hero" class="d-flex align-items-center hero_backgraound-color-green slide-2">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center costume-ruang">
          <h1>
            <span class="font-semibold">Membentuk Karakter Baik Pada Anak</span>
          </h1>
          <div><a href="#about" class="bx bx-chevron-down animation-up-down scrollto" style="font-size: 50px; color: #22214a"></a></div>
        </div>
        <div class="col-xl-4 col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="150">
          <img src="assets/landing-page/img/slider/Header-Jenius.png" class="img-fluid hero-img-samping" alt="">
        </div>
      </div>
    </div>
  </section>
  <section id="hero" class="d-flex align-items-center hero_backgraound-color-blue slide-3">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center costume-ruang">
          <h1>
            <span class="font-semibold">Serta Mengembangkan Minat dan Bakat Anak</span>
          </h1>
          <div><a href="#about" class="bx bx-chevron-down animation-up-down scrollto" style="font-size: 50px; color: #22214a"></a></div>
        </div>
        <div class="col-xl-4 col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="150">
          <img src="assets/landing-page/img/slider/Header-Creative.png" class="img-fluid hero-img-samping" alt="">
        </div>
      </div>
    </div>
  </section>
  <!-- End Hero Slider -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container-fluid">
    </div>

  </section><!-- End Hero -->

<?php } else if ($status == 'active') { ?>
  <!-- ======= Hero Section ======= -->
  <div class="waves-bacground">
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
      <defs>
        <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
      </defs>
      <g class="parallax">
        <use xlink:href="#gentle-wave" x="48" y="0" style="opacity: 70%;" fill="#<?= $this->db->get_where('settings', array('type' => 'wave1'))->row()->description; ?>" />
        <use xlink:href="#gentle-wave" x="48" y="3" style="opacity: 50%;" fill="#<?= $this->db->get_where('settings', array('type' => 'wave2'))->row()->description; ?>" />
        <use xlink:href="#gentle-wave" x="48" y="5" style="opacity: 30%;" fill="#<?= $this->db->get_where('settings', array('type' => 'wave3'))->row()->description; ?>" />
        <use xlink:href="#gentle-wave" x="48" y="7" style="opacity: unset;" fill="#<?= $this->db->get_where('settings', array('type' => 'wave4'))->row()->description; ?>" />
      </g>
    </svg>
  </div>

  <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7" data-elementor-settings="[]">
    <div class="elementor-section-wrap">
      <section class="elementor-section elementor-top-section elementor-element elementor-element-13b84977 elementor-section-height-min-height hidden elementor-section-boxed elementor-section-height-default elementor-section-items-middle shown d-flex align-items-center" data-id="13b84977" data-element_type="section" id="hero" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
        <div class="elementor-background-overlay" style="background-image: url(<?= base_url('uploads/banner.jpg'); ?>);"></div>
        <div class="elementor-container elementor-column-gap-default">
          <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-63fd6706" data-id="63fd6706" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="elementor-widget-wrap" data-aos="zoom-in" data-aos-delay="150">
              <div class="elementor-element elementor-element-79b54f56 elementor-widget elementor-widget-heading" data-id="79b54f56" data-element_type="widget" data-widget_type="heading.default">
                <div class="elementor-widget-container">
                  <img src="<?= base_url('uploads/imgCenter.jpg'); ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </section>
  </div>
  </div>
  <!-- End Greating Holiday -->

<?php } ?>



<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Prakata</h2>
        <p>
          Homeschooling Permata Hati merupakan lembaga pendidikan dibawah naungan Yayasan Indonesia Satu Hati yang berorientasi kepada pembentukan karakter serta minat bakat, dengan menggunakan konsep pendidikan sbb :
        </p>
      </div>
      <div class="row">
        <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="150">
          <img src="assets/landing-page/img/about2.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
          <ul>
            <li><i class="bi bi-check-circle"></i> Pendidikan yang lebih menekankan pada pembentukan karakter, pembinaan kemandirian dan kemampuan minat serta bakat.</li>
            <li><i class="bi bi-check-circle"></i> Penggalian kreatifitas dan talenta.</li>
            <li><i class="bi bi-check-circle"></i> Melibatkan peran orang tua dalam mendidik, mengawasi, mengajari, membimbing serta menjadi tauladan yang baik untuk anak-anaknya agar kelak bisa menjadi Insan Rahmatan Lil Aalamiin.</li>
          </ul>
        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  <!-- ======= Counts Section ======= -->
  <section id="counts" class="counts">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2 style="color: white;">Akademisi</h2>
      </div>

      <?php
      $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
      $this->db->where('class_id', 1);
      $this->db->where('year', $running_year);
      $kelas_pertama = $this->db->count_all_results('enroll');
      $this->db->where('class_id', 2);
      $this->db->where('year', $running_year);
      $kelas_kedua = $this->db->count_all_results('enroll');
      $this->db->where('class_id', 3);
      $this->db->where('year', $running_year);
      $kelas_ketiga = $this->db->count_all_results('enroll');
      $pengajar = $this->db->count_all('teacher');
      ?>

      <div class="row counters">

        <div class="col-lg-3 col-6 text-center">
          <span class="counter"><?= $kelas_pertama ?></span>
          <p>Anak Usia <12 Tahun</p>
        </div>

        <div class="col-lg-3 col-6 text-center">
          <span class="counter"><?= $kelas_kedua ?></span>
          <p>Anak Usia 12-15 Tahun</p>
        </div>

        <div class="col-lg-3 col-6 text-center">
          <span class="counter"><?= $kelas_ketiga ?></span>
          <p>Anak Usia >15 Tahun</p>
        </div>

        <div class="col-lg-3 col-6 text-center">
          <span class="counter"><?= $pengajar ?></span>
          <p>Pengajar</p>
        </div>

      </div>

    </div>
  </section>
  <!-- End Counts Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Layanan</h2>
        <p>Agar konsep pendidikan dan bimbingan terhadap pembinaan anak bisa maksimal, maka Homeschooling di tempat kami memberikan pelayanan tidak hanya kepada anak didik, tapi kepada orang tua, lingkungan sekitar dan masyarakat umum.</p>
      </div>

      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon-box iconbox-blue">
            <div class="icon">
              <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
              </svg>
              <i class="bx bx-group"></i>
            </div>
            <h4>Parenting</h4>
            <p>Kegiatan yang bertujuan untuk berbagi tugas dan kewajiban pembinaan anak antara orang tua dan lembaga</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
          <div class="icon-box iconbox-orange ">
            <div class="icon">
              <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
              </svg>
              <i class="bx bx-message-rounded-detail"></i>
            </div>
            <h4>Konseling</h4>
            <p>Pelayanan untuk meningkatkan kemampuan dalam menghadapi masalah baik pada orang tua maupun anak.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
          <div class="icon-box iconbox-pink">
            <div class="icon">
              <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,251.2091493199835,5.337323636656869,175.0934190732945,40.62881213300186C97.87086631185822,76.43348514350839,51.98124368387456,156.15599469081315,36.44837278890362,239.84606092416172C21.716077023791087,319.22268207091537,43.775223500013084,401.1760424656574,96.891909868211,461.97329694683043C147.22146801428983,519.5804099606455,223.5754009179313,538.201503339737,300,541.5067337569781"></path>
              </svg>
              <i class="bx bx-tachometer"></i>
            </div>
            <h4>Bimbingan</h4>
            <p>Kegiatan yang dilakukan setiap hari terhadap anak baik daring maupun luring agar anak bisa merencanakan, mengembangkan, menyesuaikan diri dan mengatasi permasalahan.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon-box iconbox-yellow">
            <div class="icon">
              <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,503.46388370962813C374.79870501325706,506.71871716319447,464.8034551963731,527.1746412648533,510.4981551193396,467.86667711651364C555.9287308511215,408.9015244558933,512.6030010748507,327.5744911775523,490.211057578863,256.5855673507754C471.097692560561,195.9906835881958,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C329.3053358748298,57.3949838291264,248.02791733380457,8.279543830951368,175.87071277845988,42.242879143198664C103.41431057327972,76.34704239035025,93.79494320519305,170.9812938413882,81.28167332365135,250.07896920659033C70.17666984294237,320.27484674793965,64.84698225790005,396.69656628748305,111.28512138212992,450.4950937839243C156.20124167950087,502.5303643271138,231.32542653798444,500.4755392045468,300,503.46388370962813"></path>
              </svg>
              <i class="bx bx-street-view"></i>
            </div>
            <h4>Pembinaan</h4>
            <p>Bertujuan untuk membentuk kepribadian dan kebiasaan yang baik agar menjadi karakter dalam diri anak.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
          <div class="icon-box iconbox-red">
            <div class="icon">
              <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,532.3542879108572C369.38199826031484,532.3153073249985,429.10787420159085,491.63046689027357,474.5244479745417,439.17860296908856C522.8885846962883,383.3225815378663,569.1668002868075,314.3205725914397,550.7432151929288,242.7694973846089C532.6665558377875,172.5657663291529,456.2379748765914,142.6223662098291,390.3689995646985,112.34683881706744C326.66090330228417,83.06452184765237,258.84405631176094,53.51806209861945,193.32584062364296,78.48882559362697C121.61183558270385,105.82097193414197,62.805066853699245,167.19869350419734,48.57481801355237,242.6138429142374C34.843463184063346,315.3850353017275,76.69343916112496,383.4422959591041,125.22947124332185,439.3748458443577C170.7312796277747,491.8107796887764,230.57421082200815,532.3932930995766,300,532.3542879108572"></path>
              </svg>
              <i class="bx bx-slideshow"></i>
            </div>
            <h4>Evaluasi</h4>
            <p>Evaluasi dilakukan secara bertahap, mulai dari evaluasi pekanan, triwulanan, semesteran dan tahunan yang bertujuan untuk mengukur sejauh mana perkembangan yang dihaslikan dalam proses pendidikan anak</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
          <div class="icon-box iconbox-teal">
            <div class="icon">
              <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,566.797414625762C385.7384707136149,576.1784315230908,478.7894351017131,552.8928747891023,531.9192734346935,484.94944893311C584.6109503024035,417.5663521118492,582.489472248146,322.67544863468447,553.9536738515405,242.03673114598146C529.1557734026468,171.96086150256528,465.24506316201064,127.66468636344209,395.9583748389544,100.7403814666027C334.2173773831606,76.7482773500951,269.4350130405921,84.62216499799875,207.1952322260088,107.2889140133804C132.92018162631612,134.33871894543012,41.79353780512637,160.00259165414826,22.644507872594943,236.69541883565114C3.319112789854554,314.0945973066697,72.72355303640163,379.243833228382,124.04198916343866,440.3218312028393C172.9286146004772,498.5055451809895,224.45579914871206,558.5317968840102,300,566.797414625762"></path>
              </svg>
              <i class="bx bx-medal"></i>
            </div>
            <h4>Apresiasi</h4>
            <p>Merupakan bentuk penghargaan atas prestasi perkembangan diri anak sekecil apapun.</p>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Services Section -->

  <!-- ======= Features Section ======= -->
  <section id="features" class="features">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Fitur Aplikasi</h2>
        <p>Dalam proses kegiatan bimbingan, dan pengasuhan dalam menilai karakter sudah kami kemas ke dalam sebuah aplikasi SIPEKA (Sistem Informasi & Aplikasi Penilaian Karakter) yang akan memudahkan anak (untuk bimbingan belajar) dan orang tua untuk memantau dan mengawasi perkembangan anak serta guru untuk menyampaikan materi pembelajaran, mengawal kegiatan pembelajaran, mengevaluasi kegiatan pembelajaran dan mengapresiasi hasil pembelajaran anak. Adapun fitur-fiturnya sebagai berikut :</p>
      </div>

      <div class="row">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column align-items-lg-center">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <i class="bx bx-line-chart "></i>
            <h4>Laporan Perilaku</h4>
            <p>Setiap anak akan dibina dan dididik agar memiliki kepribadian yang baik di setiap harinya. Laporan perkembangannya nya bisa dilihat secara realtime.</p>
          </div>
          <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
            <i class="bx bx-chat"></i>
            <h4>Konsultasi dan Bimbingan</h4>
            <p>Aplikasi ini didesign user friendly dan komunikatif, sehingga akan memberikan kenyamanan baik anak maupun orang tua dalam melakukan konsultasi dan bimbingan individual.</p>
          </div>
          <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
            <i class="bx bx-news"></i>
            <h4>Informasi Berita dan Kegiatan</h4>
            <p>Selain berfungsi sebagai aplikasi pembelajaran dan bimbingan, juga berfungsi sebagai pusat berita dan informasi seputar kegiatan Homeschooling, Parenting dan Pendidikan.</p>
          </div>
        </div>
        <div class="image col-lg-6 order-1 order-lg-2 " data-aos="zoom-in" data-aos-delay="100">
          <img src="assets/landing-page/img/about.jpg" alt="" class="img-fluid">
        </div>
      </div>

    </div>
  </section><!-- End Features Section -->

  <!-- ======= Rapor Section ======= -->
  <section id="rapor" class="faq section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Cek Rapor</h2>
        <p>Masukan No. Serial Rapor yang ingin diketahui.</p> <br />
        <form class="show-student" style="text-align: center;">
          <input type="text" name="no-serial" placeholder="No. Seri Rapor" autocomplete="off" class="roll" style="width: 70%; padding-left: 10px; height: 40px">
          <button class="cari-btn submit" type="submit" style="margin-left: 5px;"><i class="bi bi-search"></i></button>
          <a class="cari-btn" id="scan" data-bs-toggle="modal" data-bs-target="#modal"><i class="bi bi-upc-scan"></i></a>
        </form>
      </div>
    </div>

    <div class="modal fade kamera" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-body">
          </div>
          <video src="" id="preview" width="100%"></video>
          <center>
            <select id="selectCamera" name="options" class="form-select">
            </select>
          </center>
        </div>
      </div>
    </div>
    <?php
    if ($this->session->failed) {
    ?>
      <div class="alert alert-danger">
        <?php echo $this->session->failed; ?>
      </div>
    <?php
    }
    ?>
  </section>
  <!-- End Rapor Section -->

  <!-- ======= Testimonials Section ======= -->
  <section id="testimonials" class="testimonials section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Testimoni</h2>
        <p>Sepatah kata dari tokoh masyarakat, tenaga pengajar, orang tua wali, alumni dan anak didik kami.</p>
      </div>

      <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
          <?php
          $testimoni = $this->db->get('testimonials')->result_array();
          foreach ($testimoni as $data) {
          ?>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  <?= $data['deskripsi'] ?>
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
                <img src="<?= $data['foto'] ?>" class="testimonial-img" alt="">
                <h3><?= $data['nama'] ?></h3>
                <h4><?= $data['jabatan'] ?></h4>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="swiper-pagination"></div>
        <!-- End testimonial item -->
      </div>
    </div>

  </section><!-- End Testimonials Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Galeri</h2>
        <p>Berikut beberapa dokumentasi kegiatan Homeschooling, baik kegiatan bimbingan, konseling, parenting maupun pembentukan karakter, serta pengembangan diri dan minat bakat anak.</p>
      </div>

      <div class="row" style="text-align: center;">
        <?php
        $galeri = $this->db->query('SELECT video FROM galeri ORDER BY id_galeri DESC LIMIT 3')->result_array();
        foreach ($galeri as $data) { ?>
          <div class="col-lg-4 lazy img-fluid" style="padding-bottom: 20px;">
            <?= $data['video'] ?>
          </div>
        <?php } ?>
      </div>

    </div>
    <div class="section-title">
      <div class="container" data-aos="fade-up">
        <br /><a class="view-more-btn" href="https://bit.ly/3iHMoYJ">View More</a>
      </div>
    </div>
  </section>
  <!-- End Portfolio Section -->

  <!-- ======= Pricing Section ======= -->
  <!-- <section id="pricing" class="pricing section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Pricing</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
      </div>

      <div class="row">

        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="box">
            <h3>Free</h3>
            <h4><sup>$</sup>0<span> / month</span></h4>
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li class="na">Pharetra massa</li>
              <li class="na">Massa ultricies mi</li>
            </ul>
            <div class="btn-wrap">
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
          <div class="box featured">
            <h3>Business</h3>
            <h4><sup>$</sup>19<span> / month</span></h4>
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li>Pharetra massa</li>
              <li class="na">Massa ultricies mi</li>
            </ul>
            <div class="btn-wrap">
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
          <div class="box">
            <h3>Developer</h3>
            <h4><sup>$</sup>29<span> / month</span></h4>
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li>Pharetra massa</li>
              <li>Massa ultricies mi</li>
            </ul>
            <div class="btn-wrap">
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
          <div class="box">
            <span class="advanced">Advanced</span>
            <h3>Ultimate</h3>
            <h4><sup>$</sup>49<span> / month</span></h4>
            <ul>
              <li>Aida dere</li>
              <li>Nec feugiat nisl</li>
              <li>Nulla at volutpat dola</li>
              <li>Pharetra massa</li>
              <li>Massa ultricies mi</li>
            </ul>
            <div class="btn-wrap">
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section> -->
  <!-- End Pricing Section -->

  <!-- ======= Agenda Section ======= -->
  <?php
  $tanggal = date('Y-m-d H:i:s');
  $this->db->order_by('start', 'ASC');
  $this->db->limit(1);
  $this->db->where('start >', $tanggal);
  $events = $this->db->get('events')->result_array();
  foreach ($events as $event) :
  ?>
    <a href="<?= base_url('/agenda') ?>" style="color: #ffffff;">
      <section id="agenda" class="faq section-bg">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2>Info Kegiatan</h2>
          </div>
          <div class="aos-animate aos-init agloop clear">
            <div class="age-info" style="margin-left: 30px;">
              <span class="agedate"><?= date('d', strtotime($event['start'])); ?></span>
              <span class="agemon"><?= date('F', strtotime($event['start'])); ?></span>
            </div>
            <div class="atime" style="text-align: left;">
              <div class="wakt">waktu : <?= date('H:i', strtotime($event['start'])); ?></div>
              <h3><?= $event['title'] ?></h3>
              <div class="evnt">
                <?php
                $str = $event['deskripsi'];
                $jmlChar = 100;
                if ($str[$jmlChar - 1] != ' ') {
                  $jmlChar = strpos($str, ' ', $jmlChar);
                }
                $kata = substr($str, 0, $jmlChar) . ' ....';
                echo (str_word_count($event['deskripsi']) > 10 ? $kata : $event['deskripsi'])
                ?>
              </div>
              <div style="border-bottom: 1px dashed #ffffff;margin-top: 20px;"></div>
    </a>
    </div>

    <div id="clockdiv">
      <div class="unday">
        <div class="days"></div>
        <span style="color: white;">HARI</span>
      </div>
      <div class="unhour">
        <div class="hours"></div>
        <span style="color: white;">JAM</span>
      </div>
      <div class="unminute">
        <div class="minutes"></div>
        <span style="color: white;">MENIT</span>
      </div>
      <div class="unsecond">
        <div class="seconds"></div>
        <span style="color: white;">DETIK</span>
      </div>
      <script>
        function getTimeRemaining(endtime) {
          var t = Date.parse(endtime) - Date.parse(new Date());
          var seconds = Math.floor((t / 1000) % 60);
          var minutes = Math.floor((t / 1000 / 60) % 60);
          var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
          var days = Math.floor(t / (1000 * 60 * 60 * 24));
          return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
          };
        }

        function initializeClock(id, endtime) {
          var clock = document.getElementById(id);
          var daysSpan = clock.querySelector('.days');
          var hoursSpan = clock.querySelector('.hours');
          var minutesSpan = clock.querySelector('.minutes');
          var secondsSpan = clock.querySelector('.seconds');

          function updateClock() {
            var t = getTimeRemaining(endtime);

            daysSpan.innerHTML = t.days;
            hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
            minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
            secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

            if (t.total <= 0) {
              clearInterval(timeinterval);
            }
          }

          updateClock();
          var timeinterval = setInterval(updateClock, 1000);
        }
        var deadline = '<?= date('F d Y H:i:s', strtotime($event['start'])); ?> UTC+0700';
        initializeClock('clockdiv', deadline);
      </script>
    </div>
    </div>
    </section>
    </a>
  <?php endforeach; ?>
  <!-- End Agenda Section -->

  <section id="blog" class="recent-blog-posts" style="background-color: #f9f8ff">

    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Artikel</h2>
        <p>Tulisan terbaru dari komunitas kami</p>
      </div>
      <div class="row">
        <?php
        $this->db->limit(3);
        $this->db->order_by('RAND()');
        $tulisan = $this->db->get('tbl_tulisan')->result_array();
        foreach ($tulisan as $data) {
        ?>
          <div class="col-lg-4">
            <div class="post-box">
              <div class="post-img"><img src="<?= base_url('/assets/landing-page/img/blog/') ?><?= $data['tulisan_gambar'] ?>" class="img-fluid" alt=""><img src="<?= base_url('/uploads/blog/') ?><?= $data['tulisan_gambar'] . '.jpg' ?>" class="img-fluid" alt=""></div>
              <span class="post-date"><i class="bi bi-pencil-square"></i> <?= $data['tulisan_author'] ?></span>
              <h3 class="post-title"><?= $data['tulisan_judul'] ?></h3>
              <a href="<?= base_url('blog/posting/' . $data['tulisan_id']) ?>" class="readmore stretched-link mt-auto"><span>Read More ...</span></a>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="section-title">
        <div class="container" data-aos="fade-up">
          <br /><a class="view-more-btn" href="<?= base_url('/blog') ?>">View More</a>
        </div>
      </div>
    </div>
    </div>
  </section><!-- End Recent Blog Posts Section -->

  <!-- ======= Team Section ======= -->
  <section id="team">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Tim Manajemen</h2>
      </div>

      <div class="row">
        <?php
        $management = $this->db->get('management')->result_array();
        foreach ($management as $data) {
        ?>

          <div class="col-lg-4 col-md-6 col-xl-3">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <img src="<?= $data['foto'] ?>" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4><?= $data['nama'] ?></h4>
                  <span><?= $data['jabatan'] ?></span>
                  <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
  </section><!-- End Team Section -->

  <!-- ======= Frequently Asked Questions Section ======= -->
  <section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Tanya Jawab</h2>
        <p>Berikut beberapa hal yang sering ditanyakan tentang Homeschooling.</p>
      </div>

      <div class="faq-list">
        <ul>
          <li data-aos="fade-up" data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-1">Bagaimana anak-anak homeschooling dalam bersosialisasi? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-1" class="collapse" data-bs-parent=".faq-list">
              <p>
                Sosialisasi dalam homeschooling adalah keberatan yang paling sering diajukan dan selalu ditanyakan pertama kali, padahal ini yang paling mudah dibantah. Mitos ini muncul dari ketidaktahuan tentang kegiatan Homeschooling sebenarnya. Banyak orang berasumsi bahwa dalam Homeschooling anak tidak keluar dari rumah dan hanya belajar sendiri atau berdua orang tuanya mulai dari pagi sampai sore. Kalau seperti itu ya pasti si anak jadi kuper. Pada kenyataannya, siswa Homeschooling lebih sering mengadakan studi lapangan kapan pun mereka mau. Saat waktunya belajar sejarah, mereka pergi ke museum dan berinteraksi dengan komunitas pecinta sejarah. Ingin belajar bisnis? Sambil makan di McDonald’s dan berbincang dengan manajernya dan para karyawannya saja. Siswa sekolah formal berinteraksi hanya dengan teman-teman yang seusia dan dikumpulkan dalam satu kelas seharian. Kalau siswa Homeschooling? Dengan banyak orang dari segala lapisan usia dan pekerjaan! Banyak riset yang membuktikan bahwa siswa Homeschooling dapat bersosialisasi sebaik, atau bahkan lebih baik, dari para sebayanya di sekolah formal, dan mereka menunjukkan lebih sedikit masalah perilaku pula
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="200">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Apakah anak-anak Homeschooling akan punya teman? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
              <p>
                Mirip dengan mitos pertama, mitos yang satu ini berasumsi bahwa rekan sebaya siswa Homeschooling yang bersekolah formal memiliki banyak teman sedangkan mereka tidak. Ok, coba kita jujur dulu dalam melihat fakta. Yang bisa didapat seorang anak dari “pertemanan” di lingkungan sekolah formal sebenarnya lebih banyak berupa “peer pressure”. Anak-anak ini saling memberi tekanan agar mereka bisa menjadi sama antara satu dengan yang lain. Seseorang bertanya pada orang tua homeschooler, “Anak-anakmu tidak punya teman dan tidak bisa belajar dari anak-anak sebayanya.” Orang tua homeschooler ini pun menjawab, “Coba kamu pergi ke sekolah formal saat siswanya beristirahat, perhatikan mereka, dan tunjukkan padaku, sifat-sifat mana dari mereka yang pantas ditiru anakku.” Benar juga. Sungguh tidak rugi siswa Homeschooling kehilangan “pertemanan” dalam lingkungan sekolah formal bila pada kenyataannya ia bisa berteman dengan teman-teman dari klub olahraga, remaja masjid, paduan suara gereja, kelas musik. Ia pun bisa berteman dengan orang-orang dari segala lapisan usia dan pekerjaan seperti staff museum, manajer restoran, dan lainnya.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="300">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Apakah anak-anak Homeschooling bisa belajar berkompetisi? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
              <p>
                Anak Homeschooling tidak berkompetisi dengan orang lain, namun ia berkompetisi dengan target performa yang ditetapkannya sendiri. Kalau dengan orang lain, ia belajar berkolaborasi. Anak diajarkan berkompetisi dengan standar performa yang ia tetapkan sendiri dengan bimbingan orang tua. Dan anak homeschooling juga belajar berkompetisi dalam artian konvensional juga kok. Mereka lebih sering mengikuti perlombaan atau kontes daripada teman-temannya di sekolah formal yang sudah tidak punya waktu lagi di luar kelas sekolah karena jadwalnya sudah penuh untuk ikut kegiatan ekskul di sekolah atau untuk persiapan Ujian Nasional.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="400">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Apakah biaya Homeschooling itu mahal? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Sebenarnya mungkin ini adalah pertanyaan terpenting bagi banyak orang, hanya gengsi saja kalau ditanyakan pertama. Faktanya, Homeschooling bisa mahal dan bisa murah. Masalah biaya sangat tergantung dari bujet dan kreativitas orang tua serta komunitas. Yang jelas, value for money dari Homeschooling seharusnya lebih tinggi daripada mengeluarkan biaya untuk sekolah formal.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="500">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Apakah anak Homeschooling bisa melanjutkan pendidikannya ke Perguruan Tinggi? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
              <p>
                Mitos yang dulu bisa jadi benar. Salah satu yang membuat Homeschooling kurang berkembang di Indonesia adalah dukungan pemerintah. Tapi itu dahulu, saat ini pemerintah sudah mulai gencar mendorong perkembangan pendidikan alternatif. Masuk perguruan tinggi bisa dilakukan oleh anak Homeschooling yang telah mengikuti ujian persamaan Paket C. Sudah banyak anak Homeschooling yang masuk ke perguruan tinggi. Di Inggris, rata-rata anak komunitas Homeschooling yang melanjutkan ke perguruan tinggi tiga kali lebih besar daripada anak sekolah formal. Bukan hanya masuk perguruan tinggi, anak Homeschooling bahkan bisa masuk ke sekolah dasar maupun sekolah menengah formal di tingkat mana pun mereka mau. Model ini dinamakan multiple entry and multiple exit. Tentu ada prosedur-prosedur yang harus dilewati. Anak Homeschooling juga bisa bekerja sama dengan sekolah formal untuk menjadi “siswa paruh waktu” di sekolah tersebut. Misalnya, pada hari Senin sampai Rabu ia Homeschooling, dan pada hari Kamis dan Jumat ia ikut bersekolah di sekolah formal dekat rumahnya. Ini semua sudah dimungkinkan di Indonesia. Tinggal kembali kepada orang tua untuk melihat semua opsi yang ada dan memilih yang terbaik untuk anaknya.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="600">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-6" class="collapsed">Apakah anak Homeschooling bisa mendapatkan kegiatan ekstrakurikuler yang cukup? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-6" class="collapse" data-bs-parent=".faq-list">
              <p>
                Sangat bisa, karena proses pembelajaran yang dilakukan selama beberapa jam pada Homeschooling bisa lebih produktif daripada waktu yang sama di sekolah formal. Artinya, anak Homeschooling akan memiliki lebih banyak waktu untuk menyalurkan hobi, mengembangkan bakatnya dan melakukan hal-hal lain yang mereka suka. Mereka bisa mengikuti kegiatan olahraga dan seni dengan mengikuti klub di mana mereka akan bermain dengan kelompok yang lebih kecil. Di sekolah, dengan kelompok yang besar, tiap anak hanya akan mendapat sedikit latihan olahraga dan seni. Sebagian besar waktunya akan digunakan untuk menunggu giliran.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="700">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-7" class="collapsed">Apakah anak Homeschooling bisa melakukan kegiatan praktek layaknya di laboratorium IPA? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-7" class="collapse" data-bs-parent=".faq-list">
              <p>
                Kalau memang dibutuhkan, orang tua juga bisa menyewa peralatan percobaan ilmiah. Dan lebih baik lagi adalah bila orang tua menggunakan kreativitas dalam membantu anak melakukan percobaan ilmiah. Kebanyakan percobaan ilmiah bisa dilakukan dengan peralatan dan bahan-bahan sederhana yang bisa didapat di rumah atau di pasar/supermarket.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="800">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-8" class="collapsed">Bagaimana jika kedua orang tuanya harus bekerja? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-8" class="collapse" data-bs-parent=".faq-list">
              <p>
                Yakin? “Harus” atau “mau”? Coba cek dulu, untuk apa uang dari second income itu dipakai? Untuk jasa baby sitter yang menjaga anak saat orang tua bekerja? Untuk baju-baju kerja? Untuk makan ke luar karena tidak ada yang sempat menyiapkan makanan di rumah? Bukankah ini pengeluaran yang bisa dihilangkan saat salah satu tidak bekerja? Ada juga kasus di mana single parent bisa sukses melakukan homeschooling dengan cara mengatur jadwal kerja secara kreatif atau malah bekerja dari rumah (apalagi di era dengan kemajuan teknologi seperti sekarang). Bisa juga orang tua minta bantuan saudara seperti nenek atau tante, asal kurikulum dan pengawasan tetap ada di orang tua. Coba dipikir kembali.
              </p>
            </div>
          </li>

        </ul>
      </div>

    </div>
  </section><!-- End Frequently Asked Questions Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Kontak</h2>
        <p>Untuk informasi lebih lanjut, silahkan kunjungi kami di alamat berikut agar senantiasa kami bisa terus berbagi walau hanya sebatas informasi.</p>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="info-box mb-4">
            <i class="bx bx-map"></i>
            <h3>Alamat Kami</h3>
            <p>Jl. Brawijaya Gg Brawijaya III No. 16 Sukabumi, Jawa Barat, 43121</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="info-box  mb-4"><a href="mailto:hsperisai@gmail.com" style="color: #444444;">
              <i class="bx bx-envelope"></i>
              <h3>Email Kami</h3>
              <p>hsperisai@gmail.com
            </a></p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="info-box  mb-4"><a href="tel:+62266221652" style="color: #444444;">
              <i class="bx bx-phone-call"></i>
              <h3>Telp Kami</h3>
              <p>+62 266 221 652
            </a></p>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-lg-6 ">
          <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.780851979644!2d106.9172463147565!3d-6.91678366961942!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68482c142d02f1%3A0x7c8979c9019bbcf1!2sHomeschooling%20Permata%20Hati!5e0!3m2!1sen!2sid!4v1597814948344!5m2!1sen!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div class="col-lg-6">
          <form role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="i-nama" placeholder="Your Name" data-rule="required" class="form-control" data-rule="minlen:4" data-msg="Mohon diisi nama lengkap Anda">
                <div class="validate"></div>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="required" class="form-control" data-rule="email" data-msg="Mohon diisi dengan email aktif Anda">
                <div class="validate"></div>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="i-subject" placeholder="Subject" data-rule="required" class="form-control" data-rule="minlen:4" data-msg="Isi subjek">
              <div class="validate"></div>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" id="i-pesan" data-rule="required" data-msg="Silahkan sampaikan pesan Anda"></textarea>
              <div class="validate"></div>
            </div>
            <div class="text-center" style="padding-top: 15px;"><button type="submit" id="i-btn-send" class="php-email-form button">Kirim Pesan</button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<?php include('footer.php'); ?>