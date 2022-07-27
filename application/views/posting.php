<?php include('header.php'); ?>

<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section id="blog" style="padding: 0 0;">
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="<?= base_url() ?>">Home</a></li>
          <li><a href="<?= base_url('/blog') ?>">Blog</a></li>
          <li><?= $tulisan[0]['tulisan_kategori_nama']; ?></li>
        </ol>
        <br>
        <h2><b><?= $tulisan[0]['tulisan_judul']; ?></b></h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <?php
    foreach ($tulisan as $data) :
    ?>
      <section class="blog">
        <div class="container" data-aos="fade-up">

          <div class="row">

            <div class="col-lg-8 entries">

              <article class="entry entry-single">

                <div class="entry-img">
                  <img src="<?= base_url('/assets/landing-page/img/blog/') ?><?= $data['tulisan_gambar'] ?>" alt="" class="img-fluid">
                  <img src="<?= base_url('uploads/blog/') ?><?= $data['tulisan_gambar'] . '.jpg' ?>" alt="" class="img-fluid">
                </div>

                <!-- <h2 class="entry-title">
                  <a href=""><?= $data['tulisan_judul'] ?></a>
                </h2> -->
                <br>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href=""><?= $data['tulisan_author'] ?></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href=""><time><?= substr($data['tulisan_tanggal'], 0, 10); ?></time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="<?= count($komentar) ?>"> Comments</a></li>
                  </ul>
                </div>

                <div class="entry-content">

                  <?= $data['tulisan_isi'] ?>

                  <!-- <blockquote>
                  <p>
                    Et vero doloremque tempore voluptatem ratione vel aut. Deleniti sunt animi aut. Aut eos aliquam doloribus minus autem quos.
                  </p>
                </blockquote> -->

                </div>

                <div class="entry-footer">
                  <i class="bi bi-folder"></i>
                  <ul class="cats">
                    <li><a href="#">Business</a></li>
                  </ul>

                  <i class="bi bi-tags"></i>
                  <ul class="tags">
                    <li><a href="#">Creative</a></li>
                    <li><a href="#">Tips</a></li>
                    <li><a href="#">Marketing</a></li>
                  </ul>
                </div>

              </article><!-- End blog entry -->

              <div class="blog-author d-flex align-items-center">
                <img src="<?= $this->crud_model->get_image_url('teacher', $data['tulisan_pengguna_id']); ?>" class="rounded-circle float-left" alt="">
                <div>
                  <h4><?= $data['tulisan_author'] ?></h4>

                  <div class="social-links">
                    <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                    <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                    <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                  </div>
                  <!-- <p>
                  Itaque quidem optio quia voluptatibus dolorem dolor. Modi eum sed possimus accusantium. Quas repellat voluptatem officia numquam sint aspernatur voluptas. Esse et accusantium ut unde voluptas.
                </p> -->
                </div>
              </div><!-- End blog author bio -->

              <div class="blog-comments">

                <h4 class="comments-count"><?= count($komentar) ?> Comments</h4>
                <?php
                $colors = array(
                  '#ff9e67',
                  '#10bdff',
                  '#14b5c7',
                  '#f98182',
                  '#8f9ce2',
                  '#ee2b33',
                  '#d4ec15',
                  '#613021',
                );
                foreach ($komentar as $row) :
                  shuffle($colors);
                ?>
                  <div id="comment-1" class="comment">
                    <div class="d-flex">
                      <div class="comment-img">
                        <div class="blodpost-tab-img" style="background-color:<?php echo reset($colors); ?>;width: 65px;height: 65px;border-radius:50px 50px 50px 50px;">
                          <center>
                            <h2 style="padding-top:20%;color:#fff;"><?php echo substr($row['komentar_nama'], 0, 1); ?></h2>
                          </center>
                        </div>
                      </div>
                      <div>
                        <h5><a href=""><?= $row['komentar_nama'] ?></a>
                          <!-- <a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5> -->
                          <time datetime="2020-01-01"><?= substr($row['komentar_tanggal'], 0, 10) ?></time>
                          <p>
                            <?= $row['komentar_isi'] ?>
                          </p>
                      </div>
                    </div>
                  </div>
                  <?php
                  $komentar_id = $row['komentar_id'];
                  $query = $this->db->query("SELECT * FROM tbl_komentar WHERE komentar_status='1' AND komentar_parent='$komentar_id' ORDER BY komentar_id ASC");
                  foreach ($query->result() as $res) :
                    shuffle($colors);
                  ?>
                    <div class="row">
                      <div class="col-md-12 offset-md-1">
                        <div class="row">
                          <div class="col-md-2">
                            <div class="blodpost-tab-img" style="background-color:<?php echo reset($colors); ?>;width: 65px;height: 65px;border-radius:50px 50px 50px 50px;">
                              <center>
                                <h2 style="padding-top:20%;color:#fff;"><?php echo substr($res->komentar_nama, 0, 1); ?></h2>
                              </center>
                            </div>
                          </div>
                          <div class="col-md-9">
                            <div class="blogpost-tab-description">
                              <h6><?php echo $res->komentar_nama; ?></h6><small><em><?php echo date("d M Y H:i", strtotime($res->komentar_tanggal)); ?></em></small>
                              <p><?php echo $res->komentar_isi; ?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                <?php endforeach;
                endforeach; ?>
                <div class="reply-form">
                  <h4>Leave a Reply</h4>
                  <p>Your email address will not be published. Required fields are marked * </p>
                  <form action="<?= base_url('blog/komentar') ?>" method="post">
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <input type="hidden" name="tulisan_id" value="<?= $data['tulisan_id'] ?>">
                        <input name="nama" type="text" class="form-control" placeholder="Your Name*">
                      </div>
                      <div class="col-md-6 form-group">
                        <input name="email" type="text" class="form-control" placeholder="Your Email*">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col form-group">
                        <textarea name="komentar" class="form-control" placeholder="Your Comment*"></textarea>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>

                  </form>

                </div>

              </div><!-- End blog comments -->

            </div><!-- End blog entries list -->

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

              </div> <!-- End sidebar -->

            </div><!-- End blog sidebar -->

          </div>

        </div>
      </section><!-- End Blog Single Section -->
    <?php
    endforeach;
    ?>
  </section>
</main><!-- End #main -->

<?php include('footer.php'); ?>