<?php
$info = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->result_array();
foreach($info as $row):
  ?>
  <div class="content-w"> 
   <?php include 'fancy.php';?>
   <div class="header-spacer"></div>
   <div class="content-i">
    <div class="content-box">
     <div class="conty">
       <div class="back" style="margin-top:-20px;margin-bottom:10px">		
         <a title="<?php echo get_phrase('return');?>" href="<?php echo base_url();?>admin/teachers/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
       </div>
       <div class="row">
         <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">                
           <div id="newsfeed-items-grid">
            <div class="ui-block paddingtel">
              <div class="user-profile">
               <div class="up-head-w" style="background-image:url(<?php echo base_url();?>uploads/bglogin.jpg)">
                <div class="up-main-info">
                  <div class="user-avatar-w">
                   <div class="user-avatar">
                    <img alt="" src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']);?>" style="background-color:#fff;">
                  </div>
                </div>
                <h3 class="text-white"><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></h3>
                <h5 class="up-sub-header">@<?php echo $row['username'];?></h5>
              </div>
              <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g>
              </svg>
            </div>
            <div class="up-controls">
              <div class="row">
                <div class="col-lg-6">
                  <div class="value-pair">
                    <div><?php echo get_phrase('account_type');?>:</div>
                    <div class="value badge badge-pill badge-success"><?php echo get_phrase('teacher');?></div>
                  </div>
                  <div class="value-pair">
                    <div><?php echo get_phrase('member_since');?>:</div>
                    <div class="value"><?php echo $row['since'];?>.</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="ui-block">
              <div class="ui-block-title">		
               <h6 class="title"><?php echo get_phrase('assigned_subjects');?></h6>
             </div>
             <div class="ui-block-content">
               <div class="row">
                 <?php 
                 $array_subject_id = array();
                 $this->db->order_by('subject_id', 'desc');
                 $subjects = $this->db->from('subject')->where('teacher_id', $teacher_id)->get()->result_array();
                 $r_rmg = $this->db->from('relasi_mapel_guru rmg')->where('rmg.teacher_id', $teacher_id)->join('subject sb', 'sb.subject_id = rmg.subject_id', 'inner')->get()->result_array();
                 foreach ($subjects as $subject):
                  array_push($array_subject_id, $subject['subject_id']);
                  ?>
                  <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block" data-mh="friend-groups-item">
                      <div class="friend-item friend-groups">
                        <div class="friend-item-content">
                          <div class="friend-avatar"> 
                           <div class="author-thumb">
                            <img src="<?php echo base_url();?>uploads/subject_icon/<?php echo $subject['icon'];?>" width="120px" style="background-color:#<?php echo $subject['color'];?>;padding:30px;border-radius:0px;">
                          </div>
                          <div class="author-content">
                            <a href="javascript:void();" class="h5 author-name"><?php echo $subject['name'];?></a><br>
                            <span> <?php echo $this->db->get_where('class', array('class_id' => $subject['class_id']))->row()->name;?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
              endforeach;
              foreach ($r_rmg as $k_rmg => $v_rmg) {
                if (!in_array($v_rmg['subject_id'], $array_subject_id)) {
                  ?>
                  <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="ui-block" data-mh="friend-groups-item">
                      <div class="friend-item friend-groups">
                        <div class="friend-item-content">
                          <div class="friend-avatar"> 
                           <div class="author-thumb">
                            <img src="<?php echo base_url();?>uploads/subject_icon/<?php echo $v_rmg['icon'];?>" width="120px" style="background-color:#<?php echo $v_rmg['color'];?>;padding:30px;border-radius:0px;">
                          </div>
                          <div class="author-content">
                            <a href="javascript:void();" class="h5 author-name"><?php echo $v_rmg['name'];?></a><br>
                            <span> <?php echo $this->db->get_where('class', array('class_id' => $v_rmg['class_id']))->row()->name;?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</main>
<div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
 <div class="crumina-sticky-sidebar">
   <div class="sidebar__inner">
    <div class="ui-block paddingtel">
     <div class="ui-block-content">
       <div class="widget w-about">
         <a href="javascript:void(0);" class="logo"><img src="<?php echo base_url();?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>"></a>
         <ul class="socials">
           <li><a href="<?php echo $this->db->get_where('settings', array('type' => 'facebook'))->row()->description;?>"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
           <li><a href="<?php echo $this->db->get_where('settings', array('type' => 'twitter'))->row()->description;?>"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
           <li><a href="<?php echo $this->db->get_where('settings', array('type' => 'youtube'))->row()->description;?>"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
           <li><a href="<?php echo $this->db->get_where('settings', array('type' => 'instagram'))->row()->description;?>"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
         </ul>
       </div>
     </div>
   </div>
   <div class="ui-block paddingtel">
     <div class="ui-block-content">
      <div class="help-support-block">
       <h3 class="title"><?php echo get_phrase('quick_links');?></h3>
       <ul class="help-support-list">
        <li>
         <i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
         <a href="<?php echo base_url();?>admin/teacher_profile/<?php echo $teacher_id;?>/"><?php echo get_phrase('personal_information');?></a>
       </li>
       <li>
         <i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
         <a href="<?php echo base_url();?>admin/teacher_update/<?php echo $teacher_id;?>/"><?php echo get_phrase('update_information');?></a>
       </li>
       <li>
         <i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
         <a href="<?php echo base_url();?>admin/teacher_schedules/<?php echo $teacher_id;?>/"><?php echo get_phrase('schedules');?></a>
       </li>
       <li>
         <i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
         <a href="<?php echo base_url();?>admin/teacher_subjects/<?php echo $teacher_id;?>/"><?php echo get_phrase('subjects');?></a>
       </li>
     </ul>
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php endforeach;?>