<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>
<div class="content-w">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="conty">
        <div class="content-i">
            <div class="content-box">
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="row">
                            <?php
                            $n = 1;
                            $class_id     = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->class_id;
                            $teacher_list = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
                            foreach ($teacher_list as $row1) :
                            ?>
                                <div class="col-sm-6 col-md-6 col-lg-4">
                                    <div class="ui-block list">
                                        <div class="birthday-item inline-items">
                                            <div class="author-thumb">
                                                <img src="<?php echo $this->crud_model->get_image_url('teacher', $row1['teacher_id']); ?>" class="user-avatar circle purple" style="line-height: 0px">
                                            </div>
                                            <div class="birthday-author-name">
                                                <a href="javascript:void(0);" class="h6 author-name"><?php echo $this->crud_model->get_name('teacher', $row1['teacher_id']); ?></a>
                                                <div class="birthday-date"><b><i class="picons-thin-icon-thin-0291_phone_mobile_contact"></i></b> <?php echo $this->db->get_where('teacher', array('teacher_id' => $row1['teacher_id']))->row()->phone; ?></div>
                                                <div class="birthday-date"><b><i class="picons-thin-icon-thin-0321_email_mail_post_at"></i></b> <?php echo $this->db->get_where('teacher', array('teacher_id' => $row1['teacher_id']))->row()->email; ?></div>
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