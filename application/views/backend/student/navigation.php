<div class="fixed-sidebar">
  <div class="fixed-sidebar-left sidebar--small" id="sidebar-left">
    <a href="<?php echo base_url(); ?>student/panel/" class="logo">
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
          <a href="<?php echo base_url(); ?>student/panel" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('dashboard'); ?>">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0045_home_house"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'message' || $page_name == 'group') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/message/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('messages'); ?>">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'teachers') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/teachers/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('teachers'); ?>">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'noticeboard' || $page_name == 'galeri' || $page_name == 'blog' || $page_name == 'galerifoto') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/noticeboard/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('news'); ?>">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'request') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/request/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('permissions'); ?>">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0015_fountain_pen"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'karakter_building') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/karakter_building/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('karakter_building'); ?>">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0724_policeman_security"></i>
            </div>
          </a>
        </li>
        <?php if ($this->db->get_where('settings', array('type' => 'students_reports'))->row()->description == 1) : ?>
          <li <?php if ($page_name == 'send_report' || $page_name == 'view_report') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>student/send_report/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('teacher_reports'); ?>">
              <div class="left-menu-icon">
                <i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
              </div>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <!-- tampilab responsive -->
  <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1">
    <a href="<?php echo base_url(); ?>student/panel/" class="logo">
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
          <a href="<?php echo base_url(); ?>student/panel">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0045_home_house"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('dashboard'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'message' || $page_name == 'group') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/message/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('messages'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'teachers') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/teachers/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('teachers'); ?>">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('teachers'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'noticeboard') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/noticeboard/">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('news'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'request') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/request/">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0015_fountain_pen"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('permissions'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'karakter_building') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/karakter_building/">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0724_policeman_security"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('karakter_building'); ?></span>
          </a>
        </li>
        <?php if ($this->db->get_where('settings', array('type' => 'students_reports'))->row()->description == 1) : ?>
          <li <?php if ($page_name == 'send_report' || $page_name == 'view_report') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>student/send_report/">
              <div class="left-menu-icon">
                <i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('teacher_reports'); ?></span>
            </a>
          </li>
        <?php endif; ?>
        <li></li>
      </ul>
    </div>
  </div>
</div>
<!-- tampilan mobile -->
<div class="fixed-sidebar fixed-sidebar-responsive">
  <div class="fixed-sidebar-left sidebar--small" id="sidebar-left-responsive">
    <a href="<?php echo base_url(); ?>student/panel/" class="logo js-sidebar-open">
      <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'icon_white'))->row()->description; ?>">
    </a>

  </div>

  <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1-responsive">
    <a href="<?php echo base_url(); ?>student/panel/" class="logo">
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
          <a href="<?php echo base_url(); ?>student/panel">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0045_home_house"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('dashboard'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'message' || $page_name == 'group') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/message/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('messages'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'teachers') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/teachers/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('teachers'); ?>">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('teachers'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'noticeboard') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/noticeboard/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0010_newspaper_reading_news"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('news'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'request') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/request/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0015_fountain_pen"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('permissions'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'karakter_building') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>student/karakter_building/">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0724_policeman_security"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('karakter_building'); ?></span>
          </a>
        </li>
        <?php if ($this->db->get_where('settings', array('type' => 'students_reports'))->row()->description == 1) : ?>
          <li <?php if ($page_name == 'send_report' || $page_name == 'view_report') : ?>class="currentItem" <?php endif; ?>>
            <a href="<?php echo base_url(); ?>student/send_report/">
              <div class="left-menu-icon">
                <i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
              </div>
              <span class="left-menu-title"><?php echo get_phrase('teacher_reports'); ?></span>
            </a>
          </li>
        <?php endif; ?>
        <li></li>
      </ul>
    </div>
  </div>
</div>