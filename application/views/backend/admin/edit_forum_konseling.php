<?php $details = $this->db->get_where('forum', array('post_code' => $code))->result_array();
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
              <a class="navs-links" href="<?php echo base_url(); ?>admin/karakter_building/"><i class="os-icon picons-thin-icon-thin-0724_policeman_security"></i><span><?php echo get_phrase('character building'); ?></span></a>
            </li>
            <li class="navs-item">
              <a class="navs-links active" href="<?php echo base_url(); ?>admin/forum_konseling/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span>Forum Diskusi</span></a>
            </li>
            <li class="navs-item">
              <a class="navs-links" href="<?php echo base_url(); ?>admin/request_student/"><i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span><?php echo get_phrase('reports'); ?></span></a>
            </li>
            <li class="navs-item">
              <a class="navs-links" href="<?php echo base_url(); ?>admin/meet_konseling/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo get_phrase('live'); ?></span></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="content-i">
        <div class="content-box">
          <div class="col-lg-12">
            <div class="back hidden-sm-down" style="margin-top:-20px;margin-bottom:10px">
              <a href="<?php echo base_url(); ?>admin/forum_konseling/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
            </div>
            <div class="element-wrapper">
              <div class="element-box lined-primary shadow">
                <div class="modal-header">
                  <h5 class="modal-title"><?php echo get_phrase('update_forum'); ?></h5>
                </div><br>
                <?php echo form_open(base_url() . 'admin/forum_konseling/update/' . $code, array('enctype' => 'multipart/form-data')); ?>
                <div class="form-group">
                  <label for=""> <?php echo get_phrase('title'); ?></label><input class="form-control" name="title" required="" value="<?php echo $row2['title']; ?>" type="text">
                </div>
                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="description-toggle">
                    <div class="description-toggle-content">
                      <div class="h6">Perlihatkan kepada orangtua</div>
                      <p>Jika Anda ingin orangtua melihat informasi ini, aktifkan opsi ini.</p>
                    </div>
                    <div class="togglebutton">
                      <label><input name="post_status" value="1" <?php if ($row2['post_status'] == 1) echo "checked"; ?> type="checkbox"></label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label> <?php echo get_phrase('description'); ?></label><textarea cols="80" id="ckeditor1" name="description" rows="2"><?php echo $row2['description']; ?></textarea>
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