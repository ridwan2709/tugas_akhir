<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
          <li class="navs-item">
            <a href="<?php echo base_url(); ?>teacher/request/" class="navs-links"><i class="os-icon picons-thin-icon-thin-0015_fountain_pen"></i><span><?php echo get_phrase('permissions'); ?></span></a>
          </li>
          <li class="navs-item">
            <a href="<?php echo base_url(); ?>teacher/alatdanbahan/" class="navs-links active"><i class="os-icon picons-thin-icon-thin-0465_shopping_cart_basket_store"></i><span><?php echo "Alat dan Bahan"; ?></span></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content-i">
      <div class="content-box">
        <div style="margin-top:10px; text-align:right;"><a href="#apply" data-toggle="tab" class="btn btn-control btn-grey-lighter btn-purple"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
            <div class="ripple-container"></div>
          </a></div>

        <div class="tab-content">
          <div class="tab-pane active" id="permissions">
            <div class="element-wrapper">
              <div class="element-box-tp">
                <div class="table-responsive">
                  <table class="table table-padded">
                    <thead>
                      <tr>
                        <th><?php echo get_phrase('status'); ?></th>
                        <th><?php echo get_phrase('user'); ?></th>
                        <th><?php echo "Rencana"; ?></th>
                        <th><?php echo "Jenis Pengajuan"; ?></th>
                        <th><?php echo get_phrase('description'); ?></th>
                        <th><?php echo "Bahan dan Alat"; ?></th>
                        <th><?php echo "Total Pengajuan Dana"; ?></th>
                        <th><?php echo get_phrase('file'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $count = 1;
                      $this->db->order_by('id', 'desc');
                      $requests = $this->db->get_where('bahandanalat', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
                      foreach ($requests as $row) :
                      ?>
                        <tr>
                          <td>
                            <?php if ($row['status'] == 2) : ?>
                              <span class="status-pill red"></span><span><?php echo get_phrase('rejected'); ?></span>
                            <?php endif; ?>
                            <?php if ($row['status'] == 0) : ?>
                              <span class="status-pill yellow"></span><span><?php echo get_phrase('pending'); ?></span>
                            <?php endif; ?>
                            <?php if ($row['status'] == 1) : ?>
                              <span class="status-pill green"></span><span><?php echo get_phrase('approved'); ?></span>
                            <?php endif; ?>
                          </td>
                          <td><img alt="" src="<?php echo $this->crud_model->get_image_url('teacher', $this->session->userdata('login_user_id')); ?>" width="25px" class="purple" style="border-radius: 500%;margin-right:5px;"> <?php echo $this->crud_model->get_name('teacher', $row['teacher_id']); ?></td>
                          <td><a class="btn nc btn-rounded btn-sm btn-purple" style="color:white"><?php echo $row['rencana']; ?></a></td>
                          <td><a class="btn nc btn-rounded btn-sm btn-purple" style="color:white"><?php echo $row['jenis']; ?></a></td>
                          <td><?php echo $row['description']; ?></td>
                          <td><?php echo $row['bahanalat']; ?></a></td>
                          <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php echo number_format($row['totaldana'], 0, '.', '.'); ?></a></td>
                          <td>
                            <?php if ($row['file'] == "") : ?>
                              <p><?php echo get_phrase('no_file'); ?></p>
                            <?php endif; ?>
                            <?php if ($row['file'] != "") : ?>
                              <a href="<?php echo base_url(); ?>uploads/request/<?php echo $row['file']; ?>" class="btn btn-rounded btn-sm btn-primary" style="color:white"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <?php echo get_phrase('download'); ?></a>
                            <?php endif; ?>
                          </td>

                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


          <div class="tab-pane" id="apply">
            <div class="element-wrapper">
              <div class="element-box lined-primary">
                <?php echo form_open(base_url() . 'teacher/alatdanbahan/create', array('enctype' => 'multipart/form-data')); ?>
                <h5 class="form-header"><?php echo get_phrase('apply'); ?></h5><br>
                <div class="form-group">
                  <label for=""> <?php echo "Rencana Kegiatan"; ?></label>
                  <input type='text' class="datepicker-here" data-language='en' name="rencana" data-multiple-dates-separator="/" />
                </div>
                <div class="form-group">
                  <label for=""> <?php echo "Jenis Kegiatan"; ?></label><input class="form-control" name="jenis" placeholder="" required type="text">
                </div>
                <div class="form-group">
                  <label> <?php echo get_phrase('description'); ?></label><textarea name="description" class="form-control" required="" rows="4"></textarea>
                </div>
                <div class="form-group">
                  <label> <?php echo "Bahan/Alat yang Diperlukan"; ?></label><textarea name="bahanalat" class="form-control" required="" rows="4" placeholder="Contoh : Karton 1 lbr, Spidol 2 bh"></textarea>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label> <?php echo "Estimasi Kebutuhan Dana (Rp)"; ?></label><input name="totaldana" class="form-control uang" required="" type="text">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for=""> <?php echo get_phrase('send_file'); ?></label>
                      <input type="file" name="file_name" id="file-3" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-buttons-w text-right">
                  <button class="btn btn-primary btn-rounded" type="submit"> <?php echo 'Ajukan'; ?></button>
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