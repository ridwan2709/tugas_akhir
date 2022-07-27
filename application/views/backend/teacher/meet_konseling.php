<?php 
$running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
$info = base64_decode($data);
$ex = explode("-",$info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
?>
<div class="content-w">
  <div class="conty">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div> 
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
        <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>teacher/karakter_building/"><i class="os-icon picons-thin-icon-thin-0724_policeman_security"></i><span><?php echo get_phrase('character building'); ?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>teacher/forum_konseling/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span>Forum Diskusi</span></a>
          </li>
          <li class="navs-item">
              <a class="navs-links" href="<?php echo base_url();?>teacher/student_report/"><i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span><?php echo get_phrase('reports');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url();?>teacher/meet_konseling/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo get_phrase('live');?></span></a>
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
                    <?php echo get_phrase('live');?>
                    </h6>
                  <div class="table-responsive">
                    <table class="table table-padded">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><?php echo get_phrase('title');?></th>
                          <th><?php echo get_phrase('date');?></th>
                          <th><?php echo get_phrase('description');?></th>
                          <th><?php echo get_phrase('options');?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $n = 1;
                        $this->db->order_by('live_id', 'desc');
                        $this->db->where('class_id', 0);
                        $this->db->where('section_id', 0);
                        $this->db->where('subject_id', 0);
                        $info = $this->db->get('live')->result_array();
                        foreach ($info as $row):
                         ?>   
                         <tr>
                          <td><?php echo $n++?></td>
                          <td><?php echo $row['title']?></td>
                          <td><?php echo $row['date']." ".$row['time'];?></td>
                          <td><?php echo $row['description']?></td>
                          <td class="text-center bolder">
                          <?php if($row['liveType'] == 2){ ?>
                                <a href="<?php echo $row['siteUrl'] ?>" target="_blank" style="color:gray;"><span><i style="color:gray;" class="picons-thin-icon-thin-0139_window_new_extern_full_screen_maximize"></i></span></a>
                              <?php } else {?>
                                <a href="<?php echo base_url();?>teacher/live_konseling/<?php echo base64_encode($row['live_id']);?>" style="color:gray;"><span><i style="color:gray;" class="picons-thin-icon-thin-0139_window_new_extern_full_screen_maximize"></i></span></a>
                              <?php } ?>
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