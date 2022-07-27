<!-- ======= Footer ======= -->
<footer id="footer">

  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-5 col-md-12 footer-info">
          <a href="#hero" class="logo d-flex align-items-center">
            <img src="<?= base_url() ?>assets/landing-page/img/logo.png" class="img-fluid" alt="" style="max-width: 50%; padding-bottom: 10px">
          </a>
          <p>
            Homeschooling Permata Hati merupakan lembaga pendidikan dibawah naungan Yayasan Indonesia Satu Hati yang berorientasi kepada pembentukan karakter serta minat bakat anak.
          </p>
          <div class="social-links mt-3" style="padding-bottom: 40px">
            <a href="https://twitter.com/hspermatahati/" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="https://www.facebook.com/hspermatahati/" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/hspermatahati/" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://homeschoolingpermatahati.business.site/" class="google"><i class="bi bi-google"></i></a>
            <a href="https://bit.ly/3iHMoYJ" class="youtube"><i class="bi bi-youtube"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Menu Utama</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('/#hero') ?>">Beranda</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('/#portfolio') ?>">Galeri</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('/#blog') ?>">Blog</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('/#contact') ?>">Kontak</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('/pdb') ?>">Informasi Pendaftaran</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Aplikasi Kami</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="https://www.digitalkode.com/">Digital Kode</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="https://kasto.indonesiasatuhati.id/">Kasir Toko</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="https://koperasi.indonesiasatuhati.id/">Koperasi Indonesia Satu Hati</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Aplikasi Mobile</h4>
          <a href="https://play.google.com/store/apps/details?id=com.homeschooling.permatahati"><img src="<?= base_url() ?>assets/landing-page/img/google-play.png" class="img-fluid" alt="" style="max-width: 50%;"></a>
          <h4 style="margin: 20px 0 0 0;">Donasi</h4>
          <a href="<?= base_url('donasi#donate') ?>"><img src="<?= base_url() ?>assets/landing-page/img/support.png" class="img-fluid animate__animated animate__bounceIn animate__infinite animate__slow" alt="" style="max-width: 50%;"></a>
        </div>

      </div>
    </div>
  </div>

  <div class="container">

    <div class="copyright-wrap py-4">
      <div class="me-md-auto text-center text-md-center">
        <div class="copyright" style="margin-bottom: 50px;">
          &copy; Copyright <strong><span>Homeschooling Permata Hati</span></strong>. All Rights Reserved
        </div>
      </div>
    </div>

  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- <div id="preloader"></div> -->

<!-- Vendor JS Files -->
<script src="<?= base_url() ?>/assets/landing-page/vendor/aos/aos.js"></script>
<script src="<?= base_url() ?>/assets/landing-page/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>/assets/landing-page/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url() ?>/assets/landing-page/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url() ?>/assets/landing-page/vendor/counterup/jquery.counterup.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
<script src="<?= base_url() ?>/assets/landing-page/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url() ?>/assets/landing-page/vendor/aos/aos.js"></script>
<script src="<?= base_url() ?>/assets/landing-page/toastify/js/toastify.min.js"></script>
<script src="<?= base_url() ?>/assets/landing-page/vendor/lazyload/lazyload.min.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url() ?>/assets/landing-page/js/main.js"></script>

<!-- Side navbar bottom -->
<script>
  function openNav() {
    var mysidenav = document.getElementById("mySidenav");
    mysidenav.style.width = "100%";
    console.log(mysidenav.clientWidth);
    if (mysidenav.clientWidth > 0) closeNav();
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
</script>

<!-- Contact JS -->
<script>
  $(document).ready(function() {
    setTimeout(click1, 500);
  });

  function click1() {
    $("#i-porto-1").click();
  }
  $("#i-btn-send").click(function() {
    var nomor_wa = "6289652248345"; //Dengan 62
    //
    var nama = $("#i-nama").val();
    var subjek = $("#i-subject").val();
    var pesan = $("#i-pesan").val();
    var line2 = "Saya ingin bertanya tentang *" + subjek + "*.";
    var line1 = "Bismillah, perkenalkan nama saya *" + nama + "*.";
    var line3 = pesan;

    if (nama == '' || subjek == '' || pesan == '') {
      swal({
        title: "Data belum lengkap",
        text: "Silahkan lengkapi pesan yang ingin Anda sampaikan!",
        icon: "error",
        dangerMode: true
      });
      return false;
    }
    //
    var link = "https://wa.me/" + nomor_wa + "?text=" + encodeURI(line1) + "%0A" + encodeURI(line2) + "%0A" + "%0A" + encodeURI(line3);
    return window.open(link);
  });
</script>

<script>
  $(document).on("submit", "form.show-student", function() {
    let no_serial = $("form.show-student input").val();

    window.location = "<?php echo base_url('rapor/show'); ?>/" + no_serial;

    return false;
  })
</script>

<!-- camera scanner -->
<script type="text/javascript">
  $(document).ready(function() {
    $("#scan").click(function() {
      $('.kamera').removeClass('none');

      let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
      });
      scanner.addListener('scan', function(content) {
        window.location = content;
      });

      Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
          cameras.forEach(function(item) {
            $('#selectCamera').append('<option value="' + item.id + '">' + item.name + '</option>')
          })

          $('#selectCamera').on('change', function(event) {
            var id = $(this).val()
            var camera = cameras.find(function(camera) {
              return camera.id === id;
            })
            scanner.start(camera);
          })

          $('#selectCamera').val(cameras[0].id).trigger('change')

          var backCamera = cameras.find(function(camera) {
            return camera.name.indexOf('back') !== -1
          });

          if (backCamera) {
            $('#selectCamera').val(backCamera.id).trigger('change')
          }
        } else {
          console.error('Cameras Not Found');
        }
      }).catch(function(e) {
        console.error(e);
      });
    });
  });
</script>

<script>
  var donasi = <?php echo json_encode($donasi); ?>;
  var a = 1;
  jumlah_text = 0;

  function loopThroughSplittedText(donasi) {
    jumlah_text = donasi.length;
    for (var i = 0; i < donasi.length; i++) {
      (function(i) {})(i);
    };
  }
  loopThroughSplittedText(donasi);
  window.onload = function start() {
    slide();
  }

  function timeSince(date) {

    var seconds = Math.floor((new Date() - date) / 1000);

    var interval = seconds / 31536000;

    if (interval > 1) {
      return Math.floor(interval) + " years ago";
    }
    interval = seconds / 2592000;
    if (interval > 1) {
      return Math.floor(interval) + " months ago";
    }
    interval = seconds / 86400;
    if (interval > 1) {
      return Math.floor(interval) + " days ago";
    }
    interval = seconds / 3600;
    if (interval > 1) {
      return "Recently";
    }
    interval = seconds / 60;
    if (interval > 1) {
      return "Recently";
    }
    return "Recently";
  }



  function slide() {

    var formatter = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
    });
    var judul = donasi[0].judul;
    var jumlah = "Baru saja berdonasi sejumlah " + formatter.format(donasi[0].jumlah);
    var date = donasi[0].tanggal;
    var newdate = date.split("\/").reverse().join("-");
    var waktu = timeSince(new Date(newdate));

    Toastify({
      text: "<div class=popup_box><div class='popup_content'><div class=popup_img><i class='bi bi-check-circle-fill'></i></div><h3>" + judul + "</h3> - <p>" + jumlah + "<span class='timesince'> - </span><span class='timesince'>" + waktu + "</span></p></div></div>",
      duration: 5000,
      newWindow: false,
      close: false,
      gravity: "top", // `top` or `bottom`
      position: "left", // `left`, `center` or `right`				  
      stopOnFocus: true, // Prevents dismissing of toast on hover
      onClick: function() {} // Callback after click
    }).showToast();

    setInterval(function() {
      if (a == jumlah_text) {
        a = 0;
      }
      var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
      });
      var judul = donasi[a].judul;
      var jumlah = "Baru saja berdonasi sejumlah " + formatter.format(donasi[a].jumlah);
      var date = donasi[a].tanggal;
      var newdate = date.split("\/").reverse().join("-");
      var waktu = timeSince(new Date(newdate));

      Toastify({
        text: "<div class=popup_box><div class='popup_content'><div class=popup_img><i class='bi bi-check-circle-fill'></i></div><h3>" + judul + "</h3> - <p>" + jumlah + "<span class='timesince'> - </span><span class='timesince'>" + waktu + "</span></p></div></div>",
        duration: 5000,
        newWindow: false,
        close: false,
        gravity: "top", // `top` or `bottom`
        position: "left", // `left`, `center` or `right`				  
        stopOnFocus: true, // Prevents dismissing of toast on hover
        onClick: function() {} // Callback after click
      }).showToast();

      a = a + 1;

    }, 10000);
  };
</script>
<script>
  
  $(window).on('load', function() {
    //for use in production please remove this setTimeOut
    setTimeout(function(){ 
        $('.preloader').addClass('preloader-deactivate');
    });
    //uncomment this line for use this snippet in production
    //	$('.preloader').addClass('preloader-deactivate');
});

</script>

</body>

</html>