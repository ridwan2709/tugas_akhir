<?php
$details = $this->db->get_where('tbl_tulisan', array('tulisan_id' => $id))->result_array();
foreach ($details as $row2) :
?>
  <div class="content-w">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="conty">
      <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="navs navs-tabs upper">
            <li class="navs-item">
              <a class="navs-links" href="<?php echo base_url(); ?>teacher/news/"><i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i> <span>Berita</span></a>
            </li>
            <li class="navs-item">
              <a class="navs-links" href="<?php echo base_url(); ?>teacher/galeri/"><i class="picons-thin-icon-thin-0618_album_picture_image_photo"></i> <span>Galery</span></a>
            </li>
            <li class="navs-item">
              <a class="navs-links active" href="<?php echo base_url(); ?>teacher/blog/"><i class="picons-thin-icon-thin-0075_document_file_paper_text_article_blog_template"></i> <span>Blog</span></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="content-i">
        <div class="content-box">
          <div class="col-lg-12">
            <div class="back hidden-sm-down" style="margin-top:-20px;margin-bottom:10px">
              <a href="<?php echo base_url(); ?>teacher/blog/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
            </div>
            <div class="element-wrapper">
              <div class="element-box lined-primary shadow">
                <div class="modal-header">
                  <h5 class="modal-title"><?php echo get_phrase('update_forum'); ?></h5>
                </div><br>
                <?php echo form_open(base_url() . 'teacher/blog/edit/' . $id, array('enctype' => 'multipart/form-data')); ?>
                <input type="hidden" name="views" value="<?php echo $row2['tulisan_views']; ?>">
                <input type="hidden" name="slider" value="<?php echo $row2['tulisan_img_slider']; ?>">
                <div class="form-group">
                  <label for=""> <?php echo get_phrase('title'); ?></label>
                  <input class="form-control" name="judul" required="" value="<?php echo $row2['tulisan_judul']; ?>" type="text">
                </div>

                <div class="form-group is-select pilihan">
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
                        <option value="<?= $row['tulisan_kategori_nama'] ?>" <?php if ($row['tulisan_kategori_nama'] == $row2['tulisan_kategori_nama']) echo "selected"; ?>><?= $row['tulisan_kategori_nama'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group tambah none">
                  <label class="control-label">Kategori</label>
                  <input class="form-control" name="kategori" type="text" id="kategori_input" disabled required>
                </div>
                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                  <center><a href="javascript:void(0);" class="btn btn-rounded btn-primary btn-sm tombol1" id="tambah">Tambah kategori</a></center><br>
                  <center><a href="javascript:void(0);" class="btn btn-rounded btn-primary btn-sm tombol2 none" id="hapus">Pilih Kategori</a></center><br>
                </div>
                <div class="form_grup">
                      <img src="<?= base_url('uploads/homework/').$row2['tulisan_gambar'] ?>" alt="" style="width:300px">     
                </div>
                  <div class="form-group">
                    <label class="control-label">Gambar</label>
                    <input class="form-control" name="file_name" type="file" required>
                  </div>

                <div class="form-group">
                  <label>Isi Blog</label><textarea cols="80" id="ckeditor1" name="isi" rows="2"><?php echo $row2['tulisan_isi']; ?></textarea>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-rounded btn-success" type="submit"> <?php echo get_phrase('update'); ?></button>
                </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

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