
        <div class="os-tabs-w menu-shad">
            <div class="os-tabs-controls">
                <ul class="navs navs-tabs">
                    <li class="navs-item">
                        <a class="navs-links <?= $this->uri->segment(2) == 'students_report'? 'active' : '' ?>" href="<?php echo base_url(); ?>admin/students_report/"><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i> <span><?php echo get_phrase('students'); ?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links <?php if ($page_name == 'marks_report') echo "active"; ?>" href="<?php echo base_url(); ?>admin/marks_report/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i> <span><?php echo get_phrase('final_marks'); ?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links <?= $this->uri->segment(2) == 'testimonials'? 'active' : '' ?>" href="<?php echo base_url(); ?>admin/testimonials/"><i class="picons-thin-icon-thin-0280_chat_message_comment_bubble_reply_quote"></i> <span>Testimoni</span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links <?= $this->uri->segment(2) == 'management'? 'active' : '' ?>" href="<?php echo base_url(); ?>admin/management/"><i class="picons-thin-icon-thin-0710_business_tie_user_profile_avatar_man_male"></i> <span>Management</span></a>
                    </li>
                </ul>
            </div>
        </div>