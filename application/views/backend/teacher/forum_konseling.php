<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$info = base64_decode($data);
$ex = explode('-', $info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
?>
<div class="content-w">
  <div class="conty">
    <?php
    $info = base64_decode($data);
    $ids = explode("-", $info);
    include 'fancy.php';
    ?>
    <div class="header-spacer"></div>
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>teacher/karakter_building/"><i class="os-icon picons-thin-icon-thin-0724_policeman_security"></i><span><?php echo get_phrase('character building'); ?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url(); ?>teacher/forum_konseling/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span>Forum Diskusi</span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>teacher/student_report/"><i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span><?php echo get_phrase('reports'); ?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>teacher/meet_konseling/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo get_phrase('live'); ?></span></a>
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
                    <?php echo get_phrase('forum'); ?>
                    <div style="margin-top:auto;float:right;"><a href="#" data-target="#new_post" data-toggle="modal" data-focus="false" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
                        <div class="ripple-container"></div>
                      </a></div>
                  </h6>
                  <div class="table-responsive">
                    <table class="table table-padded">
                      <thead>
                        <tr>
                          <th><?php echo get_phrase('status'); ?></th>
                          <th>Dibuat oleh</th>
                          <th><?php echo get_phrase('title'); ?></th>
                          <th><?php echo get_phrase('date'); ?></th>
                          <th><?php echo get_phrase('options'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $this->db->order_by('post_id', 'desc');
                        $post = $this->db->get_where('forum', array('class_id' => 0, 'section_id' => 0, 'subject_id' => 0))->result_array();
                        foreach ($post as $row) :
                        ?>
                          <tr>
                            <td>
                              <?php if ($row['post_status'] == 0) : ?>
                                <span class="status-pill blue" style="background-color: #0084ff;"></span><span><?php echo 'Hanya mentor'; ?></span>
                              <?php else : ?>
                                <span class="status-pill green"></span> <span><?php echo 'Bersama orang tua'; ?></span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if ($row['type'] == 'admin') : ?>
                                <img alt="" src="<?php echo $this->crud_model->get_image_url('admin', $row['teacher_id']); ?>" style="height: 25px; border-radius:50%" class="purple"><span><?php echo $this->crud_model->get_name('admin', $row['teacher_id']); ?></span>
                              <?php else : ?>
                                <img alt="" src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']); ?>" style="height: 25px; border-radius:50%" class="purple"><span><?php echo $this->crud_model->get_name('teacher', $row['teacher_id']); ?></span>
                              <?php endif; ?>
                            </td>
                            <td><?php echo $row['title']; ?></td>
                            <td><span><?php echo $row['upload_date']; ?></span></td>
                            <td class="bolder">
                              <!-- <a style="color:grey;" data-toggle="tooltip" data-placement="top" data-original-title="<!?php echo get_phrase('edit'); ?>" href="<!?php echo base_url(); ?>teacher/edit_forum_konseling/<!?php echo $row['post_code']; ?>"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a> -->
                              <a class="btn btn-rounded btn-sm btn-primary" style="color:white" data-original-title="<?php echo get_phrase('read_forum'); ?>" href="<?php echo base_url(); ?>teacher/forumroom_konseling/<?php echo $row['post_code']; ?>"><i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i> <?php echo get_phrase('view_forum'); ?></a>
                              <!-- <a style="color:grey;" class="danger delete" data-toggle="tooltip" data-placement="top" data-original-title="<!?php echo get_phrase('delete'); ?>" href="<!?php echo base_url(); ?>teacher/forum/delete/<!?php echo $row['post_code']; ?>/<!?php echo $data; ?>/"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a> -->
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
          <h6 class="title" style="color:white"><?php echo get_phrase('new_topic'); ?></h6>
        </div>
        <div class="ui-block-content">
          <?php echo form_open(base_url() . 'teacher/forum_konseling/create/' . $data, array('enctype' => 'multipart/form-data')); ?>
          <div class="row">
            <input type="hidden" value=0 name="class_id" />
            <input type="hidden" value=0 name="section_id" />
            <input type="hidden" value=0 name="subject_id" />
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group label-floating">
                <label class="control-label"><?php echo get_phrase('title'); ?></label>
                <input class="form-control" name="title" type="text" required="">
              </div>
            </div>
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="description-toggle">
                <div class="description-toggle-content">
                  <div class="h6">Perlihatkan kepada orangtua</div>
                  <p>Jika Anda ingin orangtua melihat informasi ini, aktifkan opsi ini</p>
                </div>
                <div class="togglebutton">
                  <label><input name="post_status" value="1" type="checkbox"></label>
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
                <input class="form-control" name="userfile" type="file">
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
</div>