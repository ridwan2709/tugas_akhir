<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>
<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>admin/request/"><i class="os-icon picons-thin-icon-thin-0015_fountain_pen"></i><span><?php echo get_phrase('permissions'); ?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links active   " href="<?php echo base_url(); ?>admin/alatdanbahan/"><i class="os-icon picons-thin-icon-thin-0465_shopping_cart_basket_store"></i><span><?php echo "Pengajuan"; ?></span></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content-box">
      <div class="os-tabs-w">
      </div>
      <br>
      <div class="tab-content ">
        <div class="tab-pane active" id="teachers">
          <div class="element-wrapper">
            <h6 class="element-header">
              <?php echo "Pengajuan Alat dan Bahan"; ?>
            </h6>
            <div class="element-box-tp">
              <div class="table-responsive">
                <table class="table table-padded">
                  <thead>
                    <tr>
                      <th><?php echo get_phrase('user'); ?></th>
                      <th><?php echo "Rencana"; ?></th>
                      <th><?php echo "Jenis Pengajuan"; ?></th>
                      <th><?php echo get_phrase('description'); ?></th>
                      <th><?php echo "Bahan dan Alat"; ?></th>
                      <th><?php echo "Total Pengajuan Dana"; ?></th>
                      <th><?php echo get_phrase('file'); ?></th>
                      <th><?php echo get_phrase('status'); ?></th>
                      <th><?php echo get_phrase('options'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count = 1;
                    $this->db->order_by('id', 'desc');
                    $requests = $this->db->get('bahandanalat')->result_array();
                    foreach ($requests as $row) {
                    ?>
                      <tr>
                        <td class="cell-with-media">
                          <img alt="" src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']); ?>" class="user-avatar circle purple" style="line-height: 0px"> <?php echo $this->crud_model->get_name('teacher', $row['teacher_id']); ?>
                        </td>
                        <td><?php echo $row['rencana']; ?></td>
                        <td><?php echo $row['jenis']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['bahanalat']; ?></a></td>
                        <td><a class="badge badge-primary" style="color:white"><?php echo number_format($row['totaldana'], 0, '.', '.'); ?></a></td>
                        <td>
                          <?php if ($row['file'] == "") : ?>
                            <p><?php echo get_phrase('no_file'); ?></p>
                          <?php endif; ?>
                          <?php if ($row['file'] != "") : ?>
                            <a href="<?php echo base_url(); ?>uploads/request/<?php echo $row['file']; ?>" class="btn btn-rounded btn-sm btn-primary" style="color:white"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <?php echo get_phrase('download'); ?></a>
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if ($row['status'] == 0) : ?>
                            <a class="btn nc btn-rounded btn-sm btn-warning" style="color:white"><?php echo get_phrase('pending'); ?></a>
                          <?php endif; ?>
                          <?php if ($row['status'] == 1) : ?>
                            <a class="btn nc btn-rounded btn-sm btn-success" style="color:white"><?php echo get_phrase('approved'); ?></a>
                          <?php endif; ?>
                          <?php if ($row['status'] == 2) : ?>
                            <a class="btn nc btn-rounded btn-sm btn-danger" style="color:white"><?php echo get_phrase('rejected'); ?></a>
                          <?php endif; ?>
                        </td>
                        <td class="bolder">
                          <?php if ($row['status'] == 0) { ?>
                            <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('approve'); ?>" class="save" href="<?php echo base_url(); ?>admin/alatdanbahan/accept/<?php echo $row['id']; ?>"><i style="color:gray" class="picons-thin-icon-thin-0154_ok_successful_check"></i></a>
                            <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('reject'); ?>" class="delete" href="<?php echo base_url(); ?>admin/alatdanbahan/reject/<?php echo $row['id']; ?>"><i style="color:gray" class="picons-thin-icon-thin-0153_delete_exit_remove_close"></i></a>
                          <?php } ?>
                          <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete'); ?>" class="delete" href="<?php echo base_url(); ?>admin/alatdanbahan/delete/<?php echo $row['id']; ?>"><i style="color:gray" class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
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


<script type="text/javascript">
  function get_class_sections(class_id) {
    $.ajax({
      url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
      success: function(response) {
        jQuery('#section_selector_holder').html(response);
      }
    });
  }
</script>

<script type="text/javascript">
  function get_class_students(class_id) {
    $.ajax({
      url: '<?php echo base_url(); ?>admin/get_class_stundets/' + class_id,
      success: function(response) {
        jQuery('#students_holder').html(response);
      }
    });
  }
</script>