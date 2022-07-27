<div class="content-w">
 <?php include 'fancy.php';?>
 <div class="header-spacer"></div>
 <div class="content-i">
  <div class="content-box">
    <div class="conty">
      <div class="row">
        <?php
        $array_subject_id = array();
        $array_class_id = array();
        $subjects = $this->db->from('subject')->where('teacher_id', $this->session->userdata('login_user_id'))->order_by('class_id', 'asc')->group_by('class_id')->get()->result_array();
        foreach ($subjects as $subject):
          array_push($array_subject_id, $subject['subject_id']);
          array_push($array_class_id, $subject['class_id']);
          ?>
          <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="ui-block" data-mh="friend-groups-item">        
              <div class="friend-item friend-groups">
                <div class="friend-item-content">
                  <div class="more">
                    <i class="icon-feather-more-horizontal"></i>
                    <ul class="more-dropdown">
                      <li><a href="<?php echo base_url();?>teacher/cursos/<?php echo base64_encode($subject['class_id']);?>/"><?php echo get_phrase('my_subjects');?></a></li>
                    </ul>
                  </div>
                  <div class="friend-avatar">
                    <div class="author-thumb">
                      <img src="<?php echo base_url();?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" width="120px" style="background-color:#fff;padding:15px; border-radius:0px">
                    </div>
                    <div class="author-content">
                      <a href="<?php echo base_url();?>teacher/cursos/<?php echo base64_encode($subject['class_id']);?>/" class="h5 author-name"><?php echo $this->db->get_where('class', array('class_id' => $subject['class_id']))->row()->name;?></a>
                      <div class="country"><b><?php echo get_phrase('sections');?>:</b> <?php $sections = $this->db->get_where('section', array('class_id' => $subject['class_id']))->result_array(); foreach($sections as $sec):?> <?php echo $sec['name']." "."|";?><?php endforeach;?></div>
                    </div>
                  </div>        
                </div>
              </div>
            </div>
          </div>
          <?php
        endforeach;

        $classes = $this->db->from('relasi_mapel_guru rmg')->where('rmg.teacher_id', $this->session->userdata('login_user_id'))->join('subject sb', 'sb.subject_id = rmg.subject_id', 'inner')->order_by('sb.class_id', 'asc')->group_by('class_id')->get()->result_array();
        foreach($classes as $cl):
          if (!in_array($cl['class_id'], $array_class_id)) {
            ?>
            <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="ui-block" data-mh="friend-groups-item">        
                <div class="friend-item friend-groups">
                  <div class="friend-item-content">
                    <div class="more">
                      <i class="icon-feather-more-horizontal"></i>
                      <ul class="more-dropdown">
                        <li><a href="<?php echo base_url();?>teacher/cursos/<?php echo base64_encode($cl['class_id']);?>/"><?php echo get_phrase('my_subjects');?></a></li>
                      </ul>
                    </div>
                    <div class="friend-avatar">
                      <div class="author-thumb">
                        <img src="<?php echo base_url();?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" width="120px" style="background-color:#fff;padding:15px; border-radius:0px">
                      </div>
                      <div class="author-content">
                        <a href="<?php echo base_url();?>teacher/cursos/<?php echo base64_encode($cl['class_id']);?>/" class="h5 author-name"><?php echo $this->db->get_where('class', array('class_id' => $cl['class_id']))->row()->name;?></a>
                        <div class="country"><b><?php echo get_phrase('sections');?>:</b> <?php $sections = $this->db->get_where('section', array('class_id' => $cl['class_id']))->result_array(); foreach($sections as $sec):?> <?php echo $sec['name']." "."|";?><?php endforeach;?></div>
                      </div>
                    </div>        
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
        endforeach;
        ?>
      </div>
    </div>
  </div>
</div>