<?php
$admin_type = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->owner_status;
?>
<div class="fixed-sidebar">
  <div class="fixed-sidebar-left sidebar--small" id="sidebar-left">
    <a href="<?php echo base_url(); ?>admin/" class="logo">
      <div class="img-wrap">
        <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'icon_white'))->row()->description; ?>">
      </div>
    </a>
    <div class="mCustomScrollbar" data-mcs-theme="dark">
      <ul class="left-menu">
        <li>
          <a href="#" class="js-sidebar-open">
            <i class="left-menu-icon picons-thin-icon-thin-0069a_menu_hambuger"></i>
          </a>
        </li>
        <li <?php if ($page_name == 'panel') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>admin/panel" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('dashboard'); ?>">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0045_home_house"></i>
            </div>
          </a>
        </li>

        <!-- Messages Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'messages'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'message' || $page_name == 'group') { ?> class="currentItem" <?php } ?>>
            <a href="<?php echo base_url(); ?>admin/message/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('messages'); ?>">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
              </div>
            </a>
          </li>
        <?php endif; ?>
        <!-- End Messages Access -->

        <li <?php if ($page_name == 'users' || $page_name == 'admins' || $page_name == 'teachers' || $page_name == 'students' || $page_name == 'parents' || $page_name == 'accountant' || $page_name == 'librariran' || $page_name == 'pending' || $page_name == 'admin_profile' || $page_name == 'admin_update' || $page_name == 'teacher_profile' || $page_name == 'teacher_update' || $page_name == 'teacher_schedules' || $page_name == 'teacher_subjects' || $page_name == 'student_portal' || $page_name == 'student_update' || $page_name == 'student_invoices' || $page_name == 'student_marks' || $page_name == 'student_profile_attendance' || $page_name == 'student_profile_report' || $page_name == 'parent_profile' || $page_name == 'parent_update' || $page_name == 'parent_childs' || $page_name == 'accountant_profile' || $page_name == 'accountant_update' || $page_name == 'librarian_profile' || $page_name == 'librarian_update') { ?> class="currentItem" <?php } ?>>
          <a href="<?php echo base_url(); ?>admin/users/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('users'); ?>">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
            </div>
          </a>
        </li>

        <!-- Polls Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'polls'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'polls' || $page_name == 'view_poll' || $page_name == 'new_poll') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/polls/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('polls'); ?>">
              <div class="left-menu-icon">
                <i class="os-icon picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
              </div>
            </a>
          </li>
        <?php endif; ?>

        <!-- Behavior Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'behavior'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'karakter_building' || $page_name == 'forum_konseling' || $page_name == 'request_student' || $page_name == 'meet_konseling' || $page_name == 'forum_room_konseling' || $page_name == 'live_konseling' || $page_name == 'looking_karakter' || $page_name == 'edit_karakter') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/karakter_building/" data-toggle="tooltip" data-placement="right" data-original-title="Pembinaan">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
              </div>
            </a>
          </li>
        <?php endif; ?>

        <!-- News Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'news'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'news' || $page_name == 'galeri' || $page_name == 'blog' || $page_name == 'edit_blog' || $page_name == 'galerifoto') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/news/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('news'); ?>">
              <div class="left-menu-icon">
                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
              </div>
            </a>
          </li>
        <?php endif; ?>

        <!-- System Reports Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'system_reports'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'students_report' || $page_name == 'attendance_report' || $page_name == 'accounting_report' || $page_name == 'tabulation_report' || $page_name == 'marks_report' || $page_name == 'testimonials' || $page_name == 'management') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/students_report/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('system_reports'); ?>">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0378_analytics_presentation_statistics_graph"></i>
              </div>
            </a>
          </li>
        <?php endif; ?>

        
        <!-- Academic Settings Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'academic_settings'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'section' || $page_name == 'section' || $page_name == 'grade' || $page_name == 'semester' || $page_name == 'student_promotion') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/section/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('academic_settings'); ?>">
              <div class="left-menu-icon">
                <i class="os-icon picons-thin-icon-thin-0006_book_writing_reading_read_manual"></i>
              </div>
            </a>
          </li>
        <?php endif; ?>

        <!-- Settings Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'settings'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'system_settings' || $page_name == 'sms' || $page_name == 'email' || $page_name == 'translate' || $page_name == 'database') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/system_settings/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('settings'); ?>">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0051_settings_gear_preferences"></i>
              </div>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>

  <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1">
    <a href="<?php echo base_url(); ?>admin/panel/" class="logo">
      <div class="img-wrap">
        <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'icon_white'))->row()->description; ?>">
      </div>
      <div class="title-block">
        <h6 class="logo-title"><?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?></h6>
      </div>
    </a>
    <div class="mCustomScrollbar" data-mcs-theme="dark">
      <ul class="left-menu">
        <li>
          <a href="#" class="js-sidebar-open">
            <i class="left-menu-icon picons-thin-icon-thin-0069a_menu_hambuger"></i>
            <span class="left-menu-title"><?php echo get_phrase('minimize_menu'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'panel') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>admin/panel">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0045_home_house"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('dashboard'); ?></span>
          </a>
        </li>

        <!-- Messages Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'messages'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'message' || $page_name == 'group') { ?> class="currentItem" <?php } ?>>
            <a href="<?php echo base_url(); ?>admin/message/">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('messages'); ?></span>
            </a>
          </li>
        <?php endif; ?>

        <!-- users -->
        <li <?php if ($page_name == 'users' || $page_name == 'admins' || $page_name == 'teachers' || $page_name == 'students' || $page_name == 'parents' || $page_name == 'accountant' || $page_name == 'librariran' || $page_name == 'pending' || $page_name == 'admin_profile' || $page_name == 'admin_update' || $page_name == 'teacher_profile' || $page_name == 'teacher_update' || $page_name == 'teacher_schedules' || $page_name == 'teacher_subjects' || $page_name == 'student_portal' || $page_name == 'student_update' || $page_name == 'student_invoices' || $page_name == 'student_marks' || $page_name == 'student_profile_attendance' || $page_name == 'student_profile_report' || $page_name == 'parent_profile' || $page_name == 'parent_update' || $page_name == 'parent_childs' || $page_name == 'accountant_profile' || $page_name == 'accountant_update' || $page_name == 'librarian_profile' || $page_name == 'librarian_update') { ?> class="currentItem" <?php } ?>>
          <a href="<?php echo base_url(); ?>admin/users/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('users'); ?></span>
          </a>
        </li>


        <!-- Polls Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'polls'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'polls' || $page_name == 'view_poll' || $page_name == 'new_poll') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/polls/">
              <div class="left-menu-icon">
                <i class="os-icon picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('polls'); ?></span>
            </a>
          </li>
        <?php endif; ?>

        <!-- Behavior Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'behavior'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'karakter_building' || $page_name == 'forum_konseling' || $page_name == 'request_student' || $page_name == 'meet_konseling' || $page_name == 'forum_room_konseling' || $page_name == 'live_konseling' || $page_name == 'looking_karakter' || $page_name == 'edit_karakter') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/karakter_building/">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
              </div>
              <span class="left-menu-title">Pembinaan</span>
            </a>
          </li>
        <?php endif; ?>

        <!-- News Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'news'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'news' || $page_name == 'galeri' || $page_name == 'blog' || $page_name == 'edit_blog' || $page_name == 'galerifoto') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/news/">
              <div class="left-menu-icon">
                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('news'); ?></span>
            </a>
          </li>
        <?php endif; ?>
        <!-- System Reports Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'system_reports'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'students_report' || $page_name == 'attendance_report' || $page_name == 'accounting_report' || $page_name == 'tabulation_report' || $page_name == 'marks_report' || $page_name == 'testimonials' || $page_name == 'management') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/students_report/">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0378_analytics_presentation_statistics_graph"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('system_reports'); ?></span>
            </a>
          </li>
        <?php endif; ?>

        <!-- Settings Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'settings'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'system_settings' || $page_name == 'sms' || $page_name == 'email' || $page_name == 'translate' || $page_name == 'database') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/system_settings/">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0051_settings_gear_preferences"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('settings'); ?></span>
            </a>
          </li>
        <?php endif; ?>
        <br><br>
        <li></li>
      </ul>
    </div>
  </div>
</div>

<!-- tampilan responsif mobile -->
<div class="fixed-sidebar fixed-sidebar-responsive">
  <div class="fixed-sidebar-left sidebar--small" id="sidebar-left-responsive">
    <a href="<?php echo base_url(); ?>admin/panel/" class="logo js-sidebar-open">
      <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'icon_white'))->row()->description; ?>">
    </a>
  </div>
  <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1-responsive">
    <a href="<?php echo base_url(); ?>" class="logo">
      <div class="img-wrap">
        <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'icon_white'))->row()->description; ?>">
      </div>
      <div class="title-block">
        <h6 class="logo-title"><?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?></h6>
      </div>
    </a>
    <div class="mCustomScrollbar" data-mcs-theme="dark">
      <ul class="left-menu">
        <li>
          <a href="#" class="js-sidebar-open">
            <i class="left-menu-icon picons-thin-icon-thin-0069a_menu_hambuger"></i>
            <span class="left-menu-title"><?php echo get_phrase('minimize_menu'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'panel') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>admin/tablero">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0045_home_house"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('dashboard'); ?></span>
          </a>
        </li>

        <!-- Messages Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'messages'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'message' || $page_name == 'group') { ?> class="currentItem" <?php } ?>>
            <a href="<?php echo base_url(); ?>admin/message/">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('messages'); ?></span>
            </a>
          </li>
        <?php endif; ?>

        <li <?php if ($page_name == 'users' || $page_name == 'admins' || $page_name == 'teachers' || $page_name == 'students' || $page_name == 'parents' || $page_name == 'accountant' || $page_name == 'librariran' || $page_name == 'pending' || $page_name == 'admin_profile' || $page_name == 'admin_update' || $page_name == 'teacher_profile' || $page_name == 'teacher_update' || $page_name == 'teacher_schedules' || $page_name == 'teacher_subjects' || $page_name == 'student_portal' || $page_name == 'student_update' || $page_name == 'student_invoices' || $page_name == 'student_marks' || $page_name == 'student_profile_attendance' || $page_name == 'student_profile_report' || $page_name == 'parent_profile' || $page_name == 'parent_update' || $page_name == 'parent_childs' || $page_name == 'accountant_profile' || $page_name == 'accountant_update' || $page_name == 'librarian_profile' || $page_name == 'librarian_update') { ?> class="currentItem" <?php } ?>>
          <a href="<?php echo base_url(); ?>admin/users/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('users'); ?></span>
          </a>
        </li>

        <!-- Class Routine Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'schedules'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'class_routine_view' || $page_name == 'teacher_routine' || $page_name == 'looking_routine') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/class_routine_view/">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0029_time_watch_clock_wall"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('class_routine'); ?></span>
            </a>
          </li>
        <?php endif; ?>
        <!-- polls -->
        <?php if ($this->db->get_where('account_role', array('type' => 'polls'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'polls' || $page_name == 'view_poll' || $page_name == 'new_poll') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/polls/">
              <div class="left-menu-icon">
                <i class="os-icon picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('polls'); ?></span>
            </a>
          </li>
        <?php endif; ?>

        <!-- Behavior Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'behavior'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'karakter_building' || $page_name == 'forum_konseling' || $page_name == 'request_student' || $page_name == 'meet_konseling' || $page_name == 'forum_room_konseling' || $page_name == 'live_konseling' || $page_name == 'looking_karakter' || $page_name == 'edit_karakter')  : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/karakter_building/">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
              </div>
              <span class="left-menu-title">Pembinaan</span>
            </a>
          </li>
        <?php endif; ?>

        <!-- News Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'news'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'news' || $page_name == 'galeri' || $page_name == 'blog' || $page_name == 'edit_blog' || $page_name == 'galerifoto') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/news/">
              <div class="left-menu-icon">
                <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('news'); ?></span>
            </a>
          </li>
        <?php endif; ?>

        <!-- System Reports Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'system_reports'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'students_report' || $page_name == 'attendance_report' || $page_name == 'accounting_report' || $page_name == 'tabulation_report' || $page_name == 'marks_report' || $page_name == 'testimonials' || $page_name == 'management') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/students_reports/">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0378_analytics_presentation_statistics_graph"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('system_reports'); ?></span>
            </a>
          </li>
        <?php endif; ?>
        
        <!-- Settings Access -->
        <?php if ($this->db->get_where('account_role', array('type' => 'settings'))->row()->permissions == 1 || $admin_type == 1) : ?>
          <li <?php if ($page_name == 'system_settings' || $page_name == 'sms' || $page_name == 'email' || $page_name == 'translate' || $page_name == 'database') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>admin/system_settings/">
              <div class="left-menu-icon">
                <i class="picons-thin-icon-thin-0051_settings_gear_preferences"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('settings'); ?></span>
            </a>
          </li>
        <?php endif; ?><br><br>
        <li></li>
      </ul>
    </div>
  </div>
</div>