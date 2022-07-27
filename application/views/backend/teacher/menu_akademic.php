<div class="os-tabs-w menu-shad">
    <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'subject_dashboard'  ? 'active' : ''; ?>" href="<?php echo base_url(); ?>teacher/subject_dashboard/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo get_phrase('dashboard'); ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'online_exams'  ? 'active' : ''; ?>" href="<?php echo base_url(); ?>teacher/online_exams/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo get_phrase('online_exams'); ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'homework'  ? 'active' : ''; ?>" href="<?php echo base_url(); ?>teacher/homework/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo get_phrase('homework'); ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'forum'  ? 'active' : ''; ?>" href="<?php echo base_url(); ?>teacher/forum/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo get_phrase('forum'); ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'study_material'  ? 'active' : ''; ?>" href="<?php echo base_url(); ?>teacher/study_material/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo get_phrase('study_material'); ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'upload_marks'  ? 'active' : ''; ?>" href="<?php echo base_url(); ?>teacher/upload_marks/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo get_phrase('marks'); ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'meet'  ? 'active' : ''; ?>" href="<?php echo base_url(); ?>teacher/meet/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo get_phrase('live'); ?></span></a>
            </li>
            <li class="navs-item">
                <a class="navs-links <?= $this->uri->segment(2) == 'manage_attendance_view'  ? 'active' : ''; ?>" href="<?php echo base_url(); ?>teacher/manage_attendance_view/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo get_phrase('attendance'); ?></span></a>
            </li>
        </ul>
    </div>
</div>