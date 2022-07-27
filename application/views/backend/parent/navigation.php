<div class="fixed-sidebar">
  <div class="fixed-sidebar-left sidebar--small" id="sidebar-left">
    <a href="<?php echo base_url(); ?>parents/panel/" class="logo">
      <div class="img-wrap">
        <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'icon_white'))->row()->description; ?>">
      </div>
    </a>
    <div class="mCustomScrollbar" data-mcs-theme="dark">
      <ul class="left-menu">
        <li>
          <a href="javascript:void(0);" class="js-sidebar-open">
            <i class="left-menu-icon picons-thin-icon-thin-0069a_menu_hambuger"></i>
          </a>
        </li>
        <li <?php if ($page_name == 'panel') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/panel" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('dashboard'); ?>">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0045_home_house"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'message' || $page_name == 'group') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/message/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('messages'); ?>">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'teachers') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/teachers/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('teachers'); ?>">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'konseling' || $page_name == 'laporan' || $page_name == 'meet_konseling' || $page_name == 'forum_room_konseling' || $page_name == 'lihat_laporan' || $page_name == 'live_konseling') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/konseling/" data-toggle="tooltip" data-placement="right" data-original-title="Konseling">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0484_gauge_dashboard_full_fuel"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'request') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/request/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('permissions'); ?>">
            <div class="left-menu-icon">
              <i class="os-icon os-icon picons-thin-icon-thin-0015_fountain_pen"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'karakter_building' || $page_name == 'student_report' || $page_name == 'view_report') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/karakter_building/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('behavior'); ?>">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
            </div>
          </a>
        </li>
        <li <?php if ($page_name == 'noticeboard' || $page_name == 'galeri' || $page_name == 'blog' || $page_name == 'galerifoto') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/noticeboard/" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo get_phrase('news'); ?>">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <!-- tampilan responsif -->
  <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1">
    <a href="<?php echo base_url(); ?>parents/panel/" class="logo">
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
          <a href="javascript:void(0);" class="js-sidebar-open">
            <i class="left-menu-icon picons-thin-icon-thin-0069a_menu_hambuger"></i>
            <span class="left-menu-title"><?php echo get_phrase('minimize_menu'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'panel') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/panel">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0045_home_house"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('dashboard'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'message' || $page_name == 'group') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/message/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('messages'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'teachers') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/teachers/">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('teachers'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'konseling' || $page_name == 'laporan' || $page_name == 'meet_konseling' || $page_name == 'forum_room_konseling' || $page_name == 'lihat_laporan' || $page_name == 'live_konseling') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/konseling/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0484_gauge_dashboard_full_fuel"></i>
            </div>
            <span class="left-menu-title">Konseling</span>
          </a>
        </li>
        <li <?php if ($page_name == 'request') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/request/">
            <div class="left-menu-icon">
              <i class="os-icon os-icon picons-thin-icon-thin-0015_fountain_pen"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('permissions'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'karakter_building' || $page_name == 'student_report' || $page_name == 'view_report') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/karakter_building/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('behavior'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'noticeboard' || $page_name == 'galeri' || $page_name == 'blog' || $page_name == 'galerifoto') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/noticeboard/">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('news'); ?></span>
          </a>
        </li>
        <br><br>
        <li></li>
      </ul>
    </div>
  </div>
</div>
<!-- tampilan responsive mobile -->
<div class="fixed-sidebar fixed-sidebar-responsive">
  <div class="fixed-sidebar-left sidebar--small" id="sidebar-left-responsive">
    <a href="<?php echo base_url(); ?>parents/panel/" class="logo js-sidebar-open">
      <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'icon_white'))->row()->description; ?>">
    </a>
  </div>
  <div class="fixed-sidebar-left sidebar--large" id="sidebar-left-1-responsive">
    <a href="<?php echo base_url(); ?>parents/panel/" class="logo">
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
          <a href="<?php echo base_url(); ?>parents/panel">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0045_home_house"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('dashboard'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'message' || $page_name == 'group') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/message/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0322_mail_post_box"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('messages'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'teachers') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/teachers/">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('teachers'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'konseling' || $page_name == 'laporan' || $page_name == 'meet_konseling' || $page_name == 'forum_room_konseling' || $page_name == 'lihat_laporan' || $page_name == 'live_konseling') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/konseling/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0484_gauge_dashboard_full_fuel"></i>
            </div>
            <span class="left-menu-title">Konseling</span>
          </a>
        </li>
        <li <?php if ($page_name == 'request') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/request/">
            <div class="left-menu-icon">
              <i class="os-icon os-icon picons-thin-icon-thin-0015_fountain_pen"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('permissions'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'karakter_building' || $page_name == 'student_report' || $page_name == 'view_report') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/karakter_building/">
            <div class="left-menu-icon">
              <i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('behavior'); ?></span>
          </a>
        </li>
        <li <?php if ($page_name == 'noticeboard' || $page_name == 'galeri' || $page_name == 'blog' || $page_name == 'galerifoto') : ?>class="currentItem" <?php endif; ?>>
          <a href="<?php echo base_url(); ?>parents/noticeboard/">
            <div class="left-menu-icon">
              <i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>
            </div>
            <span class="left-menu-title"><?php echo get_phrase('news'); ?></span>
          </a>
        </li>
        <br><br>
        <li></li>
      </ul>
    </div>
  </div>
</div>