<div class="content-w">
  <?php $cl_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->class_id; ?>
  <?php $section_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->section_id; ?>
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <div class="all-wrapper no-padding-content solid-bg-all">
      <div class="layout-w">
        <div class="content-w">
          <div class="content-i">
            <div class="content-box">
              <div class="app-email-w">
                <div class="app-email-i">
                  <div class="ae-content-w" style="background-color: #f2f4f8;">
                    <div class="top-header top-header-favorit">
                      <div class="top-header-thumb">
                        <img src="<?php echo base_url(); ?>uploads/bglogin.jpg" style="height:180px; object-fit:cover;">
                        <div class="top-header-author">
                          <div class="author-thumb">
                            <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>" style="background-color: #fff; padding:10px">
                          </div>
                          <div class="author-content">
                            <a href="javascript:void(0);" class="h3 author-name"><?php echo get_phrase('my_subjects'); ?> <small>(<?php echo $this->db->get_where('class', array('class_id' => $cl_id))->row()->name; ?>)</small></a>
                            <div class="country"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br><br><br>
                    <div class="aec-full-message-w">
                      <div class="aec-full-message">
                        <div class="container-fluid" style="background-color: #f2f4f8;">
                          <div class="tab-content">
                            <div class="tab-pane active" id="tabss">
                              <div class="row">
                                <?php
                                $this->db->order_by('subject_id', 'desc');
                                $subjects = $this->db->get_where('subject', array('class_id' => $cl_id))->result_array();
                                foreach ($subjects as $row2) :
                                ?>
                                  <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="ui-block" data-mh="friend-groups-item">
                                      <div class="friend-item friend-groups">
                                        <div class="friend-item-content">
                                          <div class="more">
                                            <i class="icon-feather-more-horizontal"></i>
                                            <ul class="more-dropdown">
                                              <li><a href="<?php echo base_url(); ?>student/subject_dashboard/<?php echo base64_encode($row2['class_id'] . "-" . $section_id . "-" . $row2['subject_id']); ?>/"><?php echo get_phrase('dashboard'); ?></a></li>
                                            </ul>
                                          </div>
                                          <div class="friend-avatar">
                                            <div class="author-thumb">
                                              <img src="<?php echo base_url(); ?>uploads/subject_icon/<?php echo $row2['icon']; ?>" width="120px" style="background-color:#<?php echo $row2['color']; ?>;padding:30px;border-radius:0px;">
                                            </div>
                                            <div class="author-content">
                                              <a href="<?php echo base_url(); ?>student/subject_dashboard/<?php echo base64_encode($row2['class_id'] . "-" . $section_id . "-" . $row2['subject_id']); ?>/" class="h5 author-name"><?php echo $row2['name']; ?></a><br>
                                              <img src="<?php echo $this->crud_model->get_image_url('teacher', $row2['teacher_id']); ?>" style="border-radius:50%;width:20px;" class="purple"><span> <?php echo $this->crud_model->get_name('teacher', $row2['teacher_id']); ?></span>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php endforeach; ?>
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
        </div>
      </div>
      <div class="display-type"></div>
    </div>
  </div>
</div>