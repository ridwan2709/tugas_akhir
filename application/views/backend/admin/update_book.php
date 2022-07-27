<?php
$details = $book = $this->db->get_where('book', array('book_id' => $book_id))->result_array();
foreach ($details as $row) :
?>
  <div class="content-w">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="conty">
      <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="navs navs-tabs upper">
            <li class="navs-item">
              <a class="navs-links active" href="<?php echo base_url(); ?>admin/library/"><i class="os-icon picons-thin-icon-thin-0017_office_archive"></i><span><?php echo get_phrase('library'); ?></span></a>
            </li>
            <li class="navs-item">
              <a class="navs-links" href="<?php echo base_url(); ?>admin/book_request/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i><span><?php echo get_phrase('book_request'); ?></span></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="content-i">
        <div class="content-box">
          <div class="back" style="margin-top:-20px;margin-bottom:10px">
            <a href="<?php echo base_url(); ?>admin/library/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
          </div>
          <div class="tab-content">
            <div class="col-lg-12">
              <div class="element-wrapper">
                <div class="element-box lined-primary shadow">
                  <?php echo form_open(base_url() . 'admin/library/update/' . $row['book_id'], array('enctype' => 'multipart/form-data')); ?>
                  <h5 class="form-header"><?php echo get_phrase('update_book'); ?></h5><br>
                  <div class="row">
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="form-group label-floating">
                        <label class="control-label"><?php echo 'Judul Buku'; ?></label>
                        <input class="form-control" placeholder="" value="<?php echo $row['name']; ?>" required="" type="text" name="name">
                        <span class="material-input"></span>
                      </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="form-group label-floating">
                        <label class="control-label"><?php echo get_phrase('author'); ?></label>
                        <input class="form-control" placeholder="" value="<?php echo $row['author']; ?>" required="" type="text" name="author">
                        <span class="material-input"></span>
                      </div>
                    </div>

                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="form-group label-floating">
                        <label class="control-label"><?php echo 'Nomor Klasifikasi' ?></label>
                        <input class="form-control" placeholder="" type="text" name="price" value="<?php echo $row['price']; ?>">
                        <span class="material-input"></span>
                      </div>
                    </div>

                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="form-group label-floating">
                        <label class="control-label"><?php echo get_phrase('total_copies'); ?></label>
                        <input class="form-control" placeholder="" type="text" name="total_copies" value="<?php echo $row['total_copies']; ?>">
                        <span class="material-input"></span>
                      </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="form-group label-floating">
                        <label class="control-label"><?php echo get_phrase('description'); ?></label>
                        <textarea class="form-control" placeholder="" name="description"><?php echo $row['description']; ?></textarea>
                        <span class="material-input"></span>
                      </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="form-group label-floating is-select">
                        <label class="control-label"><?php echo 'Kategori Buku' ?></label>
                        <div class="select">
                          <select name="class_id">
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <option <?php if ('Mata Pelajaran' == $row['class_id']) echo 'selected'; ?> value="Mata Pelajaran">Mata Pelajaran</option>
                            <option <?php if ('Karya Umum' == $row['class_id']) echo 'selected'; ?> value="Karya Umum">Karya Umum</option>
                            <option <?php if ('Filsafat dan Psikologi' == $row['class_id']) echo 'selected'; ?> value="Filsafat dan Psikologi">Filsafat dan Psikologi</option>
                            <option <?php if ('Agama' == $row['class_id']) echo 'selected'; ?> value="Agama">Agama</option>
                            <option <?php if ('Ilmu Sosial' == $row['class_id']) echo 'selected'; ?> value="Ilmu Sosial">Ilmu Sosial</option>
                            <option <?php if ('Bahasa' == $row['class_id']) echo 'selected'; ?> value="Bahasa">Bahasa</option>
                            <option <?php if ('Ilmu-Ilmu Murni' == $row['class_id']) echo 'selected'; ?> value="Ilmu-Ilmu Murni">Ilmu-Ilmu Murni</option>
                            <option <?php if ('Ilmu Terapan atau Teknologi' == $row['class_id']) echo 'selected'; ?> value="Ilmu Terapan atau Teknologi">Ilmu Terapan atau Teknologi</option>
                            <option <?php if ('Seni dan Olahraga' == $row['class_id']) echo 'selected'; ?> value="Seni dan Olahraga">Seni dan Olahraga</option>
                            <option <?php if ('Kesustraan' == $row['class_id']) echo 'selected'; ?> value="Kesustraan">Kesustraan</option>
                            <option <?php if ('Sejarah dan Geografi' == $row['class_id']) echo 'selected'; ?> value="Sejarah dan Geografi">Sejaran dan Geografi</option>

                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                      <div class="description-toggle">
                        <div class="description-toggle-content">
                          <div class="h6"><?php echo get_phrase('available'); ?></div>
                          <p><?php echo 'jika buku fisik tersedia, aktifkan opsi ini'; ?></p>
                        </div>
                        <div class="togglebutton">
                          <label><input name="status" value="1" <?php if ($row['status'] == 1) echo 'checked'; ?> type="checkbox"></label>
                        </div>
                      </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                      <div class="description-toggle">
                        <div class="description-toggle-content">
                          <div class="h6"><?php echo 'eBook'; ?></div>
                          <p><?php echo 'Jika itu adalah buku virtual, aktifkan opsi ini'; ?></p>
                        </div>
                        <div class="togglebutton">
                          <label><input name="type" value="ebook" <?php if ($row['type'] == 'ebook') echo 'checked'; ?> type="checkbox"></label>
                        </div>
                      </div>
                    </div>

                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="form-group">
                        <label class="control-label"><?php echo 'Link url'; ?></label>
                        <input class="form-control" placeholder="" type="text" name="file_name" value="<?php echo $row['file_name']; ?>">
                        <span class="material-input"></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-buttons-w">
                    <button class="btn btn-primary btn-rounded" type="submit"> <?php echo get_phrase('update'); ?></button>
                  </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>