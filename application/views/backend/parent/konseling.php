<?php
$running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;

  ?>

  <div class="content-w">
    <div class="conty">
     <?php include 'fancy.php';?> 
     <div class="header-spacer"></div>
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
        <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url(); ?>parents/konseling/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span>Forum Diskusi</span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>parents/laporan/"><i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span><?php echo get_phrase('reports'); ?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>parents/meet_konseling/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo get_phrase('live');?></span></a>
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
                    <?php echo get_phrase('forum');?>
                  </h6>
                  <div class="table-responsive">
                    <table class="table table-padded">
                      <thead>
                        <tr>
                          <th><?php echo get_phrase('title');?></th>
                          <th><?php echo get_phrase('date');?></th>
                          <th class="text-center"><?php echo get_phrase('details');?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $this->db->order_by('post_id', 'desc');
                        $post = $this->db->get_where('forum', array('class_id' => 0, 'section_id' => 0, 'post_status' => 1, 'subject_id' => 0))->result_array();
                        foreach ($post as $row):
                          ?>
                          <tr>
                            <td><?php echo $row['title']; ?></td>
                            <td><a class="btn nc btn-rounded btn-sm btn-success" style="color:white"><?php echo $row['timestamp'];?></a></td>
                            <td class="row-actions">
                              <a class="btn btn-rounded btn-sm btn-primary" style="color:white" href="<?php echo base_url();?>parents/forumroom_konseling/<?php echo $row['post_code']; ?>/<?php echo $ex[3];?>/"><i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i> <?php echo get_phrase('view_forum');?></a>
                            </td>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </div>
</div>