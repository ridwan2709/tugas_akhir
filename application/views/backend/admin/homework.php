<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$class_info = $this->db->get('class')->result_array();
$info = base64_decode($data);
$ex = explode('-', $info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach ($sub as $row) :
?>
  <div class="content-w">
    <div class="conty">
      <?php include 'fancy.php'; ?>
      <div class="header-spacer"></div>
      <div class="cursos cta-with-media" style="background: #<?php echo $row['color']; ?>;">
        <div class="cta-content">
          <div class="user-avatar">
            <img alt="" src="<?php echo base_url(); ?>uploads/subject_icon/<?php echo $row['icon']; ?>" style="width:60px;">
          </div>
          <h3 class="cta-header"><?php echo $row['name']; ?> - <small><?php echo get_phrase('homework'); ?></small></h3>
          <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"</small>
        </div>
      </div>
      <!-- Menu -->
      <?php include 'menu_akademic.php' ?>
      <!-- End Menu -->
      <div class="content-i">
        <div class="content-box">
          <div class="row">
            <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
              <div id="newsfeed-items-grid">
                <div class="element-wrapper">
                  <div class="element-box-tp">
                    <h6 class="element-header">
                      <?php echo get_phrase('homework'); ?>
                      <div style="margin-top:auto;float:right;"><a href="#" data-target="#new_homework" data-toggle="modal" data-focus="false" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
                          <div class="ripple-container"></div>
                        </a></div>
                    </h6>
                    <div class="table-responsive">
                      <table class="table table-padded">
                        <thead>
                          <tr>
                            <th><?php echo get_phrase('status'); ?></th>
                            <th><?php echo get_phrase('title'); ?></th>
                            <th><?php echo get_phrase('type'); ?></th>
                            <th><?php echo 'pembuat tugas'; ?></th>
                            <th><?php echo get_phrase('allow_homework_deliveries'); ?></th>
                            <th><?php echo get_phrase('options'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $counter = 1;
                          $this->db->order_by('homework_id', 'desc');
                          $homeworks = $this->db->get_where('homework', array('subject_id' => $row['subject_id'], 'year' => $running_year, 'class_id' => $ex[0], 'section_id' => $ex[1]))->result_array();
                          foreach ($homeworks as $hm) :
                          ?>
                            <tr>
                              <td>
                                <?php if ($hm['status'] == 1) : ?>
                                  <span class="status-pill green"></span> <span><?php echo get_phrase('published'); ?></span>
                                <?php else : ?>
                                  <span class="status-pill red"></span><span><?php echo get_phrase('no_published'); ?></span>
                                <?php endif; ?>
                              </td>
                              <td><span><?php echo $hm['title']; ?></span></td>
                              <td>
                                <?php if ($hm['type'] == 1) : ?>
                                  <span class="badge badge-success"><?php echo get_phrase('online_text'); ?></span>
                                <?php endif; ?>
                                <?php if ($hm['type'] == 2) : ?>
                                  <span class="badge badge-info"><?php echo get_phrase('files'); ?></span>
                                <?php endif; ?>
                              </td>
                              <td><?= $this->crud_model->get_name($hm['uploader_type'], $hm['uploader_id']); ?></td>
                              <td><?php echo $hm['date_end']; ?></td>
                              <td class="bolder">
                                <a style="color:grey;" href="<?php echo base_url(); ?>admin/homeworkroom/<?php echo $hm['homework_code']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view_homework'); ?>"><i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i></a>
                                <a style="color:grey;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete'); ?>" class="danger delete" href="<?php echo base_url(); ?>admin/homework/delete/<?php echo $hm['homework_code']; ?>/<?php echo $data; ?>/"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
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

  <div class="modal fade" id="new_homework" tabindex="-1" role="dialog" aria-labelledby="new_homework" aria-hidden="true">
    <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
      <div class="modal-content">
        <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
        </a>
        <div class="modal-body">
          <div class="ui-block-title" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo get_phrase('new_homework'); ?></h6>
          </div>
          <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/homework/create/', array('enctype' => 'multipart/form-data')); ?>
            <div class="row">
              <input type="hidden" value="<?php echo $ex[0]; ?>" name="class_id" />
              <input type="hidden" value="<?php echo $ex[1]; ?>" name="section_id" />
              <input type="hidden" value="<?php echo $ex[2]; ?>" name="subject_id" />
              <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group label-floating">
                  <label class="control-label"><?php echo get_phrase('title'); ?></label>
                  <input class="form-control" name="title" type="text" required="">
                </div>
              </div>
              <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <label class="control-label"><?php echo get_phrase('type'); ?></label>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="custom-control custom-radio">
                  <input type="radio" name="type" id="1" required="" value="1" class="custom-control-input"> <label for="1" class="custom-control-label"><?php echo get_phrase('online_text'); ?></label>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="custom-control custom-radio">
                  <input type="radio" name="type" id="2" value="2" class="custom-control-input"> <label for="2" class="custom-control-label"><?php echo get_phrase('files'); ?></label>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-4 col-4">
                <div class="custom-control custom-radio">
                  <input type="radio" name="type" id="3" value="3" class="custom-control-input"> <label for="3" class="custom-control-label"><?php echo get_phrase('study_material'); ?></label>
                </div>
              </div>
              <div class="col col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group label-floating">
                  <label class="control-label"><?php echo get_phrase('date'); ?></label>
                  <input type='text' class="datepicker-here" required="" data-position="bottom left" data-language='en' name="date_end" data-multiple-dates-separator="/" />
                </div>
              </div>
              <div class="col col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group label-floating">
                  <label class="control-label"><?php echo get_phrase('time'); ?></label>
                  <div class="input-group clockpicker" data-align="top" data-autoclose="true">
                    <input type="text" required="" name="time_end" class="form-control" value="09:30">
                  </div>
                </div>
              </div>
              <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="description-toggle">
                  <div class="description-toggle-content">
                    <div class="h6"><?php echo get_phrase('show_students'); ?></div>
                    <p><?php echo get_phrase('show_message'); ?></p>
                  </div>
                  <div class="togglebutton">
                    <label><input name="status" value="1" type="checkbox"></label>
                  </div>
                </div>
              </div>
              <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                  <label class="control-label"><?php echo get_phrase('description'); ?></label>
                  <textarea class="form-control" id="ckeditor1" name="description"></textarea>
                </div>
              </div>
              <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                  <label class="control-label"><?php echo get_phrase('file'); ?></label>
                  <input class="form-control" name="file_name" type="file">
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
<?php endforeach; ?>