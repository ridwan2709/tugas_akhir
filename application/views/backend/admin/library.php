<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>
<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
          <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url(); ?>admin/library/"><i class="os-icon picons-thin-icon-thin-0017_office_archive"></i>
              <span><?php echo get_phrase('library'); ?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>admin/book_request/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
              <span><?php echo 'peminjaman buku'; ?></span></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content-box">
      <div class="row">
        <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
          <div class="ui-block list" data-mh="friend-groups-item">
            <div class="friend-item friend-groups">
              <div class="friend-item-content">
                <div class="friend-avatar">
                  <br><br>
                  <i class="picons-thin-icon-thin-0017_office_archive" style="font-size:45px; color: #99bf2d;"></i>
                  <h1 style="font-weight:bold;"><?php echo $this->db->count_all_results('book'); ?></h1>
                  <div class="author-content">
                    <div class="country"><b> <?php echo 'Judul buku'; ?></b></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
          <div class="ui-block list" data-mh="friend-groups-item">
            <div class="friend-item friend-groups">
              <div class="friend-item-content">
                <div class="friend-avatar">
                  <br><br>
                  <i class="picons-thin-icon-thin-0073_documents_files_paper_text_archive_copy" style="font-size:45px; color: #dd2979;"></i>
                  <h1 style="font-weight:bold;"><?php $t = 0;
                                                $total_copies = $this->db->get('book')->result_array();
                                                foreach ($total_copies as $r) {
                                                  $t += $r['total_copies'];
                                                }
                                                echo $t; ?></h1>
                  <div class="author-content">
                    <div class="country"><b><?php echo 'Jumlah buku'; ?></b></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
          <div class="ui-block list" data-mh="friend-groups-item">
            <div class="friend-item friend-groups">
              <div class="friend-item-content">
                <div class="friend-avatar">
                  <br><br>
                  <i class="picons-thin-icon-thin-0086_import_file_load" style="font-size:45px; color: #f4af08 ;"></i>
                  <h1 style="font-weight:bold;"><?php $to = 0;
                                                $copies =  $this->db->get('book')->result_array();
                                                foreach ($copies as $row) {
                                                  $to += $row['issued_copies'];
                                                }
                                                echo $to; ?></h1>
                  <div class="author-content">
                    <div class="country"><b> <?php echo 'Buku dipinjam'; ?></b></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="tab-content ">
        <div class="tab-pane active" id="students">
          <div class="element-wrapper">
            <h6 class="element-header">
              <?php echo get_phrase('library'); ?>
              <div style="margin-top:auto;float:right;"><a href="#" data-target="#addroutine" data-toggle="modal" data-focus="false" class="btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
                  <div class="ripple-container"></div>
                </a></div>
            </h6>
            <div class="element-box-tp">
              <div class="table-responsive">
                <table class="table table-padded">
                  <thead>
                    <tr>
                      <th><?php echo 'Kategori Buku' ?></th>
                      <th><?php echo get_phrase('type'); ?></th>
                      <th><?php echo get_phrase('name'); ?></th>
                      <th><?php echo get_phrase('author'); ?></th>
                      <th><?php echo get_phrase('description'); ?></th>
                      <th><?php echo 'buku fisik'; ?></th>
                      <th><?php echo 'Nomor Klasifikasi' ?></th>
                      <th><?php echo get_phrase('download'); ?></th>
                      <th class="text-center"><?php echo get_phrase('options'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $count = 1;
                    $this->db->order_by('book_id', 'desc');
                    $book = $this->db->get_where('book')->result_array();
                    foreach ($book as $row) : ?>
                      <tr>
                        <td><a class="btn btn-rounded btn-sm btn-warning" style="color:white">
                            <?= $row['class_id']  ?></a>
                        </td>
                        <td>
                          <?php if ($row['type'] == 'ebook') : ?>
                            <a class="btn btn-rounded btn-sm btn-purple" style="color:white"><?php echo 'ebook'; ?></a>
                          <?php else : ?>
                            <a class="btn btn-rounded btn-sm btn-info" style="color:white"><?php echo 'fisik'; ?></a>
                          <?php endif; ?>
                        </td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['author']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td style="text-align: center">
                          <?php if ($row['status'] == '') : ?>
                            <a class="btn btn-rounded btn-sm btn-danger" style="color:white">Tidak tersedia</a>
                          <?php endif; ?>
                          <?php if ($row['status'] == 1) : ?>
                            <a class="btn btn-rounded btn-sm btn-info" style="color:white">Tersedia</a>
                          <?php endif; ?>
                        </td>
                        <td style="color:grey">
                          <?php if ($row['price'] >= '1') : ?>
                            <a class="btn btn-rounded btn-sm btn-success" style="color:white"><?= $row['price'] ?></a>
                          <?php else : ?>
                            <?php echo 'Tidak ada nomor klasifikasi'; ?>
                          <?php endif; ?>
                        </td>
                        <td style="color:grey">
                          <?php if ($row['type'] == 'ebook' && $row['file_name'] != "") : ?>
                            <a class="btn btn-rounded btn-sm btn-primary" style="color:white" href="<?php echo $row['file_name']; ?>"><i class="picons-thin-icon-thin-0016_bookmarks_reading_book"></i>&nbsp &nbsp baca</a>
                          <?php else : ?>
                            <?php echo get_phrase('no_downloaded'); ?>
                          <?php endif; ?>
                        </td>
                        <td class="row-actions">
                          <a style="color:grey" href="<?php echo base_url(); ?>admin/update_book/<?php echo $row['book_id']; ?>"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a>
                          <a class="danger delete" href="<?php echo base_url(); ?>admin/library/delete/<?php echo $row['book_id']; ?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="display-type"></div>
</div>

<div class="modal fade" id="addroutine" tabindex="-1" role="dialog" aria-labelledby="addroutine" aria-hidden="true">
  <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
    <div class="modal-content">
      <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
      </a>
      <div class="modal-body">
        <div class="ui-block-title" style="background-color:#00579c">
          <h6 class="title" style="color:white"><?php echo get_phrase('add_book'); ?></h6>
        </div>
        <div class="ui-block-content">
          <?php echo form_open(base_url() . 'admin/library/create', array('enctype' => 'multipart/form-data')); ?>
          <div class="row">
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group label-floating is-empty">
                <label class="control-label"><?php echo 'Judul'; ?></label>
                <input class="form-control" placeholder="" type="text" name="name">
                <span class="material-input"></span>
              </div>
            </div>


            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group label-floating is-empty">
                <label class="control-label"><?php echo get_phrase('author'); ?></label>
                <input class="form-control" type="text" name="author">
                <span class="material-input"></span>
              </div>
            </div>

            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group label-floating is-empty">
                <label class="control-label">Nomor Klasifikasi</label>
                <input class="form-control" placeholder="" type="text" name="price">
                <span class="material-input"></span>
              </div>
            </div>


            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group label-floating is-select">
                <label class="control-label">Kategori Buku</label>
                <div class="select">
                  <select name="class_id">
                    <option value=""><?php echo get_phrase('select'); ?></option>
                    <option value="Mata Pelajaran">Mata Pelajaran</option>
                    <option value="Karya Umum">Karya Umum</option>
                    <option value="Filsafat dan Psikologi">Filsafat dan Psikologi</option>
                    <option value="Agama">Agama</option>
                    <option value="Ilmu Sosial">Ilmu Sosial</option>
                    <option value="Bahasa">Bahasa</option>
                    <option value="Ilmu-Ilmu Murni">Ilmu-Ilmu Murni</option>
                    <option value="Ilmu Terapan atau Teknologi">Ilmu Terapan atau Teknologi</option>
                    <option value="Seni dan Olahraga">Seni dan Olahraga</option>
                    <option value="Kesustraan">Kesustraan</option>
                    <option value="Sejarah dan Geografi">Sejarah dan Geografi</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group label-floating is-empty">
                <label class="control-label"><?php echo get_phrase('total_copies'); ?></label>
                <input class="form-control" placeholder="" type="text" name="total_copies">
                <span class="material-input"></span>
              </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group label-floating is-empty">
                <label class="control-label"><?php echo get_phrase('description'); ?></label>
                <textarea class="form-control" placeholder="" name="description"></textarea>
                <span class="material-input"></span>
              </div>
            </div>

            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="description-toggle">
                <div class="description-toggle-content">
                  <div class="h6"><?php echo get_phrase('available'); ?></div>
                  <div><?php echo 'Jika buku fisiknya tersedia, aktifkan opsi ini'; ?></div>
                </div>
                <div class="togglebutton">
                  <label><input name="status" value="" type="checkbox"></label>
                </div>
              </div>
            </div>

            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="description-toggle">
                <div class="description-toggle-content">
                  <div class="h6"><?php echo 'eBook'; ?></div>
                  <div><?php echo 'Jika itu adalah buku virtual, aktifkan opsi ini'; ?></div>
                </div>
                <div class="togglebutton">
                  <label><input name="type" value="ebook" type="checkbox"></label>
                </div>
              </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group">
                <label class="control-label"><?php echo 'Link url'; ?></label>
                <input class="form-control" placeholder="" type="text" name="file_name">
                <span class="material-input"></span>
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