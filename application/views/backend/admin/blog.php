<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>
<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs">
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>admin/news/"><i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i> <span>Berita</span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>admin/galeri/"><i class="picons-thin-icon-thin-0618_album_picture_image_photo"></i> <span>Galery</span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url(); ?>admin/blog/"><i class="picons-thin-icon-thin-0075_document_file_paper_text_article_blog_template"></i> <span>Blog</span></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content-i">
      <div class="content-box">
        <div class="row">
          <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
            <div id="newsfeed-items-grid">
              <div class="element-wrapper">
                <div class="element-box-tp">
                  <h6 class="element-header">
                    Blog
                    <div style="margin-top:auto;float:right;"><a href="#" data-target="#new_blog" data-toggle="modal" data-focus="false" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
                        <div class="ripple-container"></div>
                      </a></div>
                  </h6>
                  <div class="table-responsive">
                    <table class="table table-padded">
                      <thead>
                        <tr>
                          <th><?php echo get_phrase('title'); ?></th>
                          <th>Penulis</th>
                          <th>Tanggal</th>
                          <th>Kategori</th>
                          <th>Views</th>
                          <th><?php echo get_phrase('options'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $counter = 1;
                        foreach ($blog as $b) :
                        ?>
                          <tr>
                            <td><?= $b['tulisan_judul'] ?></td>
                            <td><span><?php echo $b['tulisan_author']; ?></span></td>
                            <td><?= $b['tulisan_tanggal'] ?></td>
                            <td><?php echo $b['tulisan_kategori_nama']; ?></td>
                            <td><?php echo $b['tulisan_views']; ?></td>
                            <td class="bolder">
                              <a style="color:grey;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit'); ?>" href="<?php echo base_url(); ?>admin/edit_blog/<?php echo $b['tulisan_id']; ?>"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a>
                              <a style="color:grey;" data-toggle="tooltip" data-placement="top" data-original-title="Baca Blog" href="<?php echo base_url(); ?>admin/baca_blog/<?php echo $b['tulisan_id']; ?>"><i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i></a>
                              <a style="color:grey;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete'); ?>" class="danger delete" href="<?php echo base_url(); ?>admin/blog/delete/<?php echo $b['tulisan_id']; ?>/<?php echo $data; ?>/"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="col pagination">
                      <?= $this->pagination->create_links(); ?>
                    </div>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
      <a class="back-to-top" href="javascript:void(0);">
        <img src="<?php echo base_url(); ?>style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
      </a>
    </div>
  </div>
</div>

<div class="modal fade" id="new_blog" tabindex="-1" role="dialog" aria-labelledby="new_blog" aria-hidden="true">
  <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
    <div class="modal-content">
      <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
      </a>
      <div class="modal-body">
        <div class="ui-block-title" style="background-color:#00579c">
          <h6 class="title" style="color:white">Blog Baru</h6>
        </div>
        <div class="ui-block-content">
          <?php echo form_open(base_url() . 'admin/blog/create/', array('enctype' => 'multipart/form-data')); ?>
          <div class="row">
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group">
                <label class="control-label">Judul</label>
                <input class="form-control" name="judul" type="text" required="">
              </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 pilihan">
              <div class="form-group is-select">
                <label class="control-label">Kategori</label>
                <div class="select">
                  <select name="kategori" id="kategori_select" required>
                    <option value="0"><?php echo get_phrase('select'); ?></option>
                    <?php
                    $this->db->select('tulisan_kategori_nama');
                    $this->db->group_by('tulisan_kategori_nama');
                    $kategori = $this->db->get('tbl_tulisan')->result_array();
                    foreach ($kategori as $row) {
                    ?>
                      <option value="<?= $row['tulisan_kategori_nama'] ?>"><?= $row['tulisan_kategori_nama'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 tambah none">
              <div class="form-group">
                <label class="control-label">Kategori</label>
                <input class="form-control" name="kategori" type="text" id="kategori_input" disabled required>
              </div>
            </div>
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <center><a href="javascript:void(0);" class="btn btn-rounded btn-primary btn-sm tombol1" id="tambah">Tambah kategori</a></center><br>
              <center><a href="javascript:void(0);" class="btn btn-rounded btn-primary btn-sm tombol2 none" id="hapus">Pilih Kategori</a></center><br>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group">
                <label class="control-label">Gambar</label>
                <input class="form-control" name="file_name" type="file" required>
              </div>
            </div>
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group">
                <label class="control-label">Isi Blog</label>
                <textarea class="form-control" id="ckeditor1" name="isi"></textarea>
              </div>
            </div>
          </div>
          <div class="form-buttons-w text-right">
            <center><button class="btn btn-rounded btn-success" type="submit"><?php echo get_phrase('save'); ?></button></center>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#tambah').click(function() {
      $('.tambah').removeClass('none');
      $('#kategori_input').removeAttr('disabled');
      $('.pilihan').addClass('none');
      $('#kategori_select').attr('disabled');
      $('.tombol1').addClass('none');
      $('.tombol2').removeClass('none');
    });

    $('#hapus').click(function() {
      $('.tambah').addClass('none');
      $('.tambah').addClass('disable');
      $('.pilihan').removeClass('none');
      $('.pilihan').removeClass('disable');
      $('.tombol1').removeClass('none');
      $('.tombol2').addClass('none');
    });
  });
</script>