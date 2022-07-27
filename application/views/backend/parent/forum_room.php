<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$posts = $this->db->get_where('forum', array('post_code' => $post_code))->result_array();
foreach ($posts as $row) :
?>
  <div class="content-w">
    <div class="conty">
      <?php include 'fancy.php'; ?>
      <div class="header-spacer"></div>
      <div class="content-i">
        <div class="content-box">
          <div class="row">
            <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
              <div id="newsfeed-items-grid">
                <div class="back">
                  <?php
                  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
                  ?>
                  <a href="<?= $url ?>"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
                </div>
                <h3 style="text-align: center;"><?php echo $row['title']; ?></h3>
                <div class="ui-block responsive-flex">
                  <article class="hentry post has-post-thumbnail thumb-full-width">
                    <div class="post__author author vcard inline-items">
                      <img src="<?php echo $this->crud_model->get_image_url($row['type'], $row['teacher_id']); ?>" class="user-avatar circle purple" style="line-height: 0px" alt="author">
                      <div class="author-date">
                        <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud_model->get_name($row['type'], $row['teacher_id']); ?></a>
                        <div class="post__date">
                          <div class="country"><span class="badge badge-success"><?php echo ucwords($row['type']); ?></span></div>
                          <time class="published" style="color: #0084ff;"><?php echo $row['timestamp']; ?></time>
                        </div>
                      </div>
                    </div>
                    <div class="wall-content">
                      <p><?php echo $row['description']; ?></p>
                      <?php if ($row['file_name'] != "") : ?>
                        <?php echo get_phrase('file'); ?>: <a class="btn btn-rounded btn-sm btn-primary" href="<?php echo base_url(); ?>uploads/forum/<?php echo $row['file_name']; ?>" style="color:white"><i class="os-icon       picons-thin-icon-thin-0042_attachment"></i> <?php echo $row['file_name']; ?></a>
                      <?php endif; ?>
                    </div>
                  </article>
                </div>
                <div class="ui-block responsive-flex">
                  <?php
                  $this->db->order_by('message_id', 'asc');
                  $messages = $this->db->get_where('forum_message', array('post_id' => $row['post_id']))->result_array();
                  foreach ($messages as $row2) :
                  ?>
                    <article class="hentry post has-post-thumbnail thumb-full-width" style="border-bottom-width: thick;">
                      <div class="post__author author vcard inline-items">
                        <?php if ($row2['user_type'] == "teacher") : ?>
                          <img alt="" src="<?php echo $this->crud_model->get_image_url('teacher', $row2['user_id']); ?>" class="user-avatar circle purple" style="line-height: 0px">
                        <?php endif; ?>
                        <?php if ($row2['user_type'] == "student") : ?>
                          <img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row2['user_id']); ?>" class="user-avatar circle purple" style="line-height: 0px">
                        <?php endif; ?>
                        <?php if ($row2['user_type'] == "admin") : ?>
                          <img alt="" src="<?php echo $this->crud_model->get_image_url('admin', $row2['user_id']); ?>" class="user-avatar circle purple" style="line-height: 0px">
                        <?php endif; ?>
                        <div class="author-date">
                          <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud_model->get_name($row2['user_type'], $row2['user_id']); ?></a>
                          <?php if ($row2['user_type'] == "student") : ?>
                            <div class="country"><span class="badge badge-info"><?php echo ucwords($row2['user_type']); ?></span></div>
                          <?php else : ?>
                            <div class="country"><span class="badge badge-success"><?php echo ucwords($row2['user_type']); ?></span></div>
                          <?php endif; ?></a>
                          <div class="post__date">
                            <time class="published" style="color: #0084ff;"><?php echo $row2['date']; ?></time>
                          </div>
                        </div>
                      </div>
                      <div class="wall-content">
                        <p><?php echo $row2['message']; ?></p>
                      </div>
                    </article>
                  <?php endforeach; ?>
                </div>
            </main>

            <div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
              <div class="crumina-sticky-sidebar">
                <div class="ui-block paddingtel">
                  <div class="ui-block-title">
                    <h6 class="title"><?php echo get_phrase('students'); ?></h6>
                  </div>
                  <ul class="widget w-friend-pages-added notification-list friend-requests">
                    <?php $students   =   $this->db->get_where('enroll', array('class_id' => $row['class_id'], 'section_id' => $row['section_id'], 'year' => $running_year))->result_array();
                    foreach ($students as $row2) : ?>
                      <li class="inline-items">
                        <div class="author-thumb">
                          <img src="<?php echo $this->crud_model->get_image_url('student', $row2['student_id']); ?>" alt="author" width="35px" class="user-avatar circle purple" style="line-height: 0px">
                        </div>
                        <div class="notification-event">
                          <a href="javascript:void(0);" class="h6 notification-friend"><?php echo $this->crud_model->get_name('student', $row2['student_id']); ?></a>
                          <span class="chat-message-item"><?php echo get_phrase('roll'); ?>: <?php echo $this->db->get_where('enroll', array('student_id' => $row2['student_id']))->row()->roll; ?></span>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
              <div class="crumina-sticky-sidebar">
                <div class="sidebar__inner">
                  <div class="ui-block paddingtel">
                    <div class="ui-block-title">
                      <h6 class="title"><?php echo get_phrase('teacher'); ?></h6>
                    </div>
                    <ul class="widget w-friend-pages-added notification-list friend-requests">
                      <?php $students   =   $this->db->get_where('teacher')->result_array();
                      foreach ($students as $row2) : ?>
                        <li class="inline-items">
                          <div class="author-thumb">
                            <img src="<?php echo $this->crud_model->get_image_url('teacher', $row2['teacher_id']); ?>" alt="author" width="35px" class="purple" style="border-radius: 50%;">
                          </div>
                          <div class="notification-event">
                            <a href="javascript:void(0);" class="h6 notification-friend"><?php echo $this->crud_model->get_name('teacher', $row2['teacher_id']); ?></a>
                            <span class="chat-message-item"><?php echo get_phrase('teacher'); ?></span>
                          </div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>