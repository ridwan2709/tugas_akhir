<?php include('header.php'); ?>

<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <a href="<?= base_url('blog') ?>">
          <h2>Blog</h2>
        </a>
        <ol>
          <li><a href="<?= base_url('blog') ?>">Home</a></li>
          <li>Blog</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Blog Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-8 entries">
          <?php
          foreach ($tulisan as $value) {
          ?>

            <article class="entry">

              <div class="entry-img">
                <img src="<?= base_url('/assets/landing-page/img/blog/') ?><?= $value['tulisan_gambar'] ?>" alt="" class="img-fluid">
                <img src="<?= base_url('uploads/blog/') ?><?= $value['tulisan_gambar'] . '.jpg' ?>" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="<?= base_url('blog/posting/' . $value['tulisan_id']) ?>"><?= $value['tulisan_judul'] ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-card-heading"></i> <a href="<?= base_url('blog/posting/' . $value['tulisan_id']) ?>"><?= $value['tulisan_kategori_nama'] ?></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="<?= base_url('blog/posting/' . $value['tulisan_id']) ?>"><?= $value['tulisan_author'] ?></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="<?= base_url('blog/posting/' . $value['tulisan_id']) ?>"><time><?= substr($value['tulisan_tanggal'], 0, 10); ?></time></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="<?= base_url('blog/posting/' . $value['tulisan_id']) ?>"> Comments</a></li>
                </ul>
              </div>

              <div class="entry-content">
                <div>
                  <?php
                  $str = $value['tulisan_isi'];
                  $jmlChar = 300;
                  if ($str[$jmlChar - 1] != ' ') {
                    $jmlChar = strpos($str, ' ', $jmlChar);
                  }
                  $kata = substr($str, 0, $jmlChar) . ' ....';
                  echo (str_word_count($value['tulisan_isi']) > 60 ? $kata : $value['tulisan_isi'])
                  ?>
                </div>
                <div class="read-more">
                  <a href="<?= base_url('blog/posting/' . $value['tulisan_id']) ?>">Read More</a>
                </div>
              </div>

            </article><!-- End blog entry -->
          <?php } ?>

          
          <nav aria-label="navigation">
                    <?php echo $this->pagination->create_links(); ?>
          </nav>

        </div>
        <!-- End blog entries list -->

        <div class="col-lg-4">

          <div class="sidebar">

            <h5 class="sidebar-title">Search</h5>
            <div class="sidebar-item search-form">
              <form action="">
                <input type="text">
                <button type="submit"><i class="bi bi-search"></i></button>
              </form>
            </div><!-- End sidebar search formn-->

            <h3 class="sidebar-title">Categories</h3>
            <div class="sidebar-item categories">
              <ul>
                <?php
                $this->db->select('tulisan_kategori_nama');
                $this->db->group_by('tulisan_kategori_nama');
                $kategori = $this->db->get('tbl_tulisan')->result_array();
                foreach ($kategori as $value) {
                  $jumlah = $this->db->query("SELECT COUNT('tulisan_kategori_nama') AS jumlah_tulisan FROM `tbl_tulisan` WHERE tulisan_kategori_nama = '$value[tulisan_kategori_nama]'")->result_array();
                ?>
                  <li><a href="<?= base_url('blog?kategori=') . $value['tulisan_kategori_nama'] ?>"><?= $value['tulisan_kategori_nama'] ?> <span>(<?= $jumlah[0]['jumlah_tulisan']; ?>)</span></a></li>
                <?php } ?>
              </ul>
            </div><!-- End sidebar categories-->

            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">
              <?php
              $this->db->limit(5);
              $this->db->order_by('tulisan_id', 'DESC');
              $tulisan = $this->db->get('tbl_tulisan')->result_array();
              foreach ($tulisan as $value) {
              ?>
                <div class="post-item clearfix">
                  <img src="<?= base_url('/assets/landing-page/img/blog/') ?><?= $value['tulisan_gambar'] ?>" alt="">
                  <img src="<?= base_url('uploads/blog/') ?><?= $value['tulisan_gambar'] . '.jpg' ?>" alt="" class="img-fluid">
                  <h4><a href="<?= base_url('/blog/posting/') . $value['tulisan_id'] ?>"><?= $value['tulisan_judul'] ?></a></h4>
                  <time datetime="2020-01-01"><?= substr($value['tulisan_tanggal'], 0, 10); ?></time>
                </div>
              <?php } ?>

            </div><!-- End sidebar recent posts-->

            <!-- <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  <li><a href="#">App</a></li>
                  <li><a href="#">IT</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Mac</a></li>
                  <li><a href="#">Design</a></li>
                  <li><a href="#">Office</a></li>
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Studio</a></li>
                  <li><a href="#">Smart</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>
              </div> -->
            <!-- End sidebar tags-->

          </div><!-- End sidebar -->

        </div><!-- End blog sidebar -->

      </div>

    </div>
  </section><!-- End Blog Section -->

</main><!-- End #main -->

<?php include('footer.php'); ?>