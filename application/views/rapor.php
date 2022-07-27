<?php include('header.php'); ?>

<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <a href="<?= base_url('rapor') ?>">
          <h2>Cek Rapor</h2>
        </a>
        <ol>
          <li><a href="<?= base_url('/#hero') ?>">Home</a></li>
          <li>Cek Rapor</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Rapor Section ======= -->
  <section id="rapor" class="blog" style="min-height:500px;">
    <div class="container" data-aos="fade-up">

      <div class="sidebar" style="margin: 0 0 0 0; box-shadow: none">

        <h5 class="sidebar-title" style="text-align: center;">Masukan No. Serial Rapor Yang Ingin Diketahui!</h5>

        <form class="show-student" style="text-align: center;">
          <input type="text" name="no-serial" placeholder="No. Seri Rapor" autocomplete="off" class="roll" style="width: 70%; height: 40px">
          <button class="cari raport" type="submit" style="margin-left: 5px;"><i class="bi bi-search"></i></button>
          <a class="cari raport" id="scan" data-bs-toggle="modal" data-bs-target="#modal"><i class="bi bi-upc-scan"></i></a>
        </form>

        <?php
        if ($this->session->failed) {
        ?>
          <div class="alert alert-danger">
            <?php echo $this->session->failed; ?>
          </div>
        <?php
        }
        ?>

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
  </section><!-- End Rapor Section -->

</main><!-- End #main -->

<?php include('footer.php'); ?>