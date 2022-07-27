<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>
<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
      <!-- Menu -->
      <?php include 'menu_report.php' ?>
      <!-- End Menu -->

    <div class="content-i">
      <div class="content-box">
        <div class="row">
          <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
            <div id="newsfeed-items-grid">
              <div class="element-wrapper">
                <div class="element-box-tp">
                  <h6 class="element-header">
                    Management
                    <div style="margin-top:auto;float:right;"><a href="#" data-target="#new_post" data-toggle="modal" data-focus="false" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
                        <div class="ripple-container"></div>
                      </a></div>
                  </h6>
                  <div class="table-responsive">
                    <table class="table table-padded">
                      <thead>
                        <tr>
                          <th>Foto</th>
                          <th>Nama</th>
                          <th>Jabatan</th>
                          <th><?php echo get_phrase('options'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $this->db->order_by('id_management', 'desc');
                        $post = $this->db->get('management')->result_array();
                        foreach ($post as $row) :
                        ?>
                          <tr>
                            <td style="text-align: center;"><img src="<?= $row['foto'] ?>" alt="" style="height:50px; border-radius:50%" class="purple"></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?php echo $row['jabatan']; ?></td>
                            <td class="bolder">
                              <a style="color:grey;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit'); ?>" href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_management/<?php echo $row['id_management']; ?>');"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a>
                              <a style="color:grey;" class="danger delete" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete'); ?>" href="<?php echo base_url(); ?>admin/management/delete/<?php echo $row['id_management']; ?>/<?php echo $data; ?>/"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
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

<div class="modal fade" id="new_post" tabindex="-1" role="dialog" aria-labelledby="new_post" aria-hidden="true">
  <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
    <div class="modal-content">
      <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
      </a>
      <div class="modal-body">
        <div class="ui-block-title" style="background-color:#00579c">
          <h6 class="title" style="color:white">Tim Management Baru</h6>
        </div>
        <div class="ui-block-content">
          <?php echo form_open(base_url() . 'admin/management/create/' . $data, array('enctype' => 'multipart/form-data')); ?>
          <div class="row">
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group label-floating">
                <label class="control-label"><?php echo get_phrase('name'); ?></label>
                <input class="form-control" name="nama" type="text" required="">
              </div>
            </div>
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group label-floating">
                <label class="control-label">Jabatan</label>
                <input class="form-control" name="jabatan" type="text" required="">
              </div>
            </div>
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group label-floating">
                <label class="control-label">Link Foto</label>
                <input class="form-control" name="foto" type="text" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="form-buttons-w text-right">
          <center><button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo get_phrase('save'); ?></button></center>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>

  </div>
</div>