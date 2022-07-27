<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs">
          <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url(); ?>student/news/"><i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i> <span>Berita</span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>student/galeri/"><i class="picons-thin-icon-thin-0618_album_picture_image_photo"></i> <span>Galery</span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>student/blog/"><i class="picons-thin-icon-thin-0075_document_file_paper_text_article_blog_template"></i> <span>Blog</span></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content-box">
      <div class="conta iner">
        <h3><?php echo get_phrase('news'); ?></h3>
        <?php
        $id = $this->session->userdata('login_user_id');
        $type = $this->session->userdata('login_type');
        $this->db->select('news_code');
        $this->db->where('user_id', $id);
        $this->db->where('user_type', $type);
        $checkNews = $this->db->get('readed')->row()->news_code;
        $this->db->select_max('news_id', 'news_id');
        $checkNewsNew = $this->db->get('news')->row()->news_id;

        $cekCount = $this->db->query("SELECT COUNT(*) as jumlah FROM news WHERE news_id > '$checkNews'")->row()->jumlah;
        if (!$checkNews) {
          $news = '';
        } else {
          $this->db->order_by('news_id', 'desc');
          $this->db->where('news_id<=', $checkNews);
          $news = $this->db->get('news')->result_array();
        }

        if ($checkNews != $checkNewsNew) { ?>
          <div class="col align-center mb-3">
            <a class="animate__animated animate__bounceIn animate__infinite animate__slow btn btn-primary btn-rounded" href="<?= base_url() . 'student/readNews/' . $checkNews ?>">Ada <?= $cekCount ?> berita/informasi belum dibaca</b></a>
          </div>
        <?php } else {
          //tidak ditampilkan
        }
        ?>
        <div class="row">
          <?php
          $this->db->order_by('news_id', 'desc');
          $news = $this->db->get('news')->result_array();
          foreach ($news as $wall) :
          ?>
            <div class="col col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="ui-block paddingtel">
                <article class="hentry post has-post-thumbnail thumb-full-width">
                  <div class="post__author author vcard inline-items">
                    <img src="<?php echo $this->crud_model->get_image_url('admin', $wall['admin_id']); ?>" class="user-avatar circle purple" style="line-height: 0px">
                    <div class="author-date">
                      <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud_model->get_name('admin', $wall['admin_id']); ?></a>
                      <div class="post__date">
                        <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date . " " . $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date2; ?></time>
                      </div>
                    </div>
                  </div>
                  <?php if ($wall['type'] == 'video') : ?>
                    <hr>
                    <p><?php echo $wall['description']; ?></p>
                    <div class="post-thumb">
                      <iframe src="<?php echo $wall['embed']; ?>" height="360" width="100%" frameborder="0" allowfullscreen=""></iframe>
                    </div>
                  <?php else : ?>
                    <?php if (file_exists('uploads/news_images/' . $wall['news_code'] . '.jpg')) : ?>
                      <hr>
                      <p><?php echo $wall['description']; ?></p>
                      <div class="post-thumb">
                        <img id="zoom_01<?php echo $wall['news_code']; ?>" src="<?php echo base_url(); ?>uploads/news_images/<?php echo $wall['news_code']; ?>.jpg" data-zoom-image="<?php echo base_url(); ?>uploads/news_images/<?php echo $wall['news_code']; ?>.jpg">
                      </div>
                    <?php else : ?>
                      <div class="wall-content">
                        <p><?php echo $wall['description']; ?></p>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
                  <div class="control-block-button post-control-button">
                    <a href="javascript:void(0);" class="btn btn-control" style="background-color:#001b3d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('news'); ?>">
                      <i class="picons-thin-icon-thin-0032_flag"></i>
                    </a>
                  </div>
                </article>
              </div>
            </div>
            <script>
              $('#zoom_01' + '<?= $news_code ?>').elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
              });
            </script>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>