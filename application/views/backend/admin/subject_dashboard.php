<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$info = base64_decode($data);
$ex = explode('-', $info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach ($sub as $row) :
?>
  <div class="content-w">
    <div class="conty">
      <?php include 'fancy.php'; ?>
      <div class="header-spacer"></div>
      <div class="cursos cta-with-media" style="background: #<?php echo $row['color']; ?>;">
        <div class="cta-content">
          <div class="user-avatar">
            <img alt="" src="<?php echo base_url(); ?>uploads/subject_icon/<?php echo $row['icon']; ?>" style="width:60px;">
          </div>
          <h3 class="cta-header"><?php echo $row['name']; ?> - <small><?php echo get_phrase('dashboard'); ?></small></h3>
          <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"</small>
        </div>
      </div>
      <!-- Menu -->
      <?php include 'menu_akademic.php' ?>
      <!-- End Menu -->
      <div class="content-i">
        <div class="content-box">
          <div class="row">
            <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
              <div id="newsfeed-items-grid">
                <?php
                $db = $this->db->query("SELECT homework_id, wall_type,publish_date FROM homework WHERE class_id = $ex[0] AND subject_id = $ex[2] UNION SELECT document_id,wall_type,publish_date FROM document WHERE class_id = $ex[0] AND subject_id = $ex[2] UNION SELECT online_exam_id,wall_type,publish_date FROM online_exam WHERE class_id = $ex[0] AND subject_id = $ex[2] UNION SELECT post_id,wall_type,publish_date FROM forum WHERE class_id = $ex[0] AND subject_id = $ex[2] ORDER BY publish_date DESC LIMIT 10");
                if ($db->num_rows() > 0) :
                  foreach ($db->result_array() as $wall) :
                ?>
                    <?php if ($wall['wall_type'] == 'homework') : ?>
                      <div class="ui-block">
                        <article class="hentry post thumb-full-width">
                          <div class="post__author author vcard inline-items">
                            <img src="<?php echo $this->crud_model->get_image_url($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_id); ?>" class="user-avatar circle purple" style="line-height: 0px">
                            <div class="author-date">
                              <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud_model->get_name($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_id); ?></a>
                              <div class="post__date">
                                <time class="published">
                                  <?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->upload_date; ?>
                                </time>
                              </div>
                            </div>
                            <div class="more">
                              <i class="icon-options"></i>
                              <ul class="more-dropdown">
                                <li><a href="<?php echo base_url(); ?>admin/homework_edit/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>/"><?php echo get_phrase('edit'); ?></a></li>
                                <li><a class="delete" href="<?php echo base_url(); ?>admin/homework/delete/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>/<?php echo $data; ?>/"><?php echo get_phrase('delete'); ?></a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="edu-posts cta-with-media verde">
                            <div class="cta-content">
                              <div class="highlight-header morado"><?php echo $row['name']; ?></div>
                              <div class="grado">
                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                              </div>
                              <h3 class="cta-header"><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->title; ?></h3>
                              <div class="descripcion">
                                <?php
                                $homework_info = $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->description;
                                echo $homework_info;
                                ?>
                              </div>
                              <?php if ($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name != "") : ?>
                                <div class="table-responsive">
                                  <table class="table table-down">
                                    <tbody class="btn-vote">
                                      <tr>
                                        <td class="text-left cell-with-media">
                                          <a href="<?php echo base_url() . 'uploads/homework/' . $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name; ?>"><i class="picons-thin-icon-thin-0111_folder_files_documents" style="font-size:16px; color:#fff;"></i> <span><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name; ?></span><span class="smaller">(<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->filesize; ?>)</span></a>
                                        </td>
                                        <td class="text-center bolder">
                                          <a href="<?php echo base_url() . 'uploads/homework/' . $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name; ?>"> <span><i class="picons-thin-icon-thin-0121_download_file"></i></span> </a>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              <?php endif; ?>
                              <div class="deadtime">
                                <span><?php echo get_phrase('date'); ?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->date_end; ?> @ <?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->time_end; ?>
                              </div>
                              <a href="<?php echo base_url(); ?>admin/homeworkroom/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>/"><button class="btn btn-rounded btn-posts"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i> <?php echo get_phrase('view_homework'); ?></button></a>
                            </div>
                          </div>
                          <div class="control-block-button post-control-button">
                            <a href="javascript:void(0);" class="btn btn-control featured-post" style="background-color: #99bf2d; color: #fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('homework'); ?>">
                              <i class="picons-thin-icon-thin-0004_pencil_ruler_drawing"></i>
                            </a>
                          </div>
                        </article>
                      </div>
                    <?php endif; ?>
                    <?php if ($wall['wall_type'] == 'exam') : ?>
                      <div class="ui-block">
                        <article class="hentry post thumb-full-width">
                          <div class="post__author author vcard inline-items">
                            <img src="<?php echo $this->crud_model->get_image_url($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_id); ?>" class="user-avatar circle purple" style="line-height: 0px">
                            <div class="author-date">
                              <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud_model->get_name($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_id); ?></a>
                              <div class="post__date">
                                <time class="published">
                                  <?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->upload_date; ?>
                                </time>
                              </div>
                            </div>
                            <div class="more">
                              <i class="icon-options"></i>
                              <ul class="more-dropdown">
                                <li><a href="<?php echo base_url(); ?>admin/exam_edit/<?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->online_exam_id; ?>/"><?php echo get_phrase('edit'); ?></a></li>
                                <li><a class="delete" href="<?php echo base_url(); ?>admin/manage_exams/delete/<?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->online_exam_id; ?>/<?php echo $data; ?>"><?php echo get_phrase('delete'); ?></a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="edu-posts cta-with-media verde">
                            <div class="cta-content">
                              <div class="highlight-header celeste"><?php echo $row['name']; ?></div>
                              <div class="grado">
                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                              </div>
                              <h3 class="cta-header"><?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->title; ?></h3>
                              <div class="descripcion">
                                <?php echo strip_tags($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->instruction); ?>
                              </div>
                              <div class="deadtime">
                                <span><?php echo get_phrase('date'); ?> :</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo date('M d, Y', $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->exam_date); ?>
                              </div>
                              <div class="deadtime">
                                <span>Masa Aktif :</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->time_start . " - " . $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->time_end; ?>
                              </div>
                              <div class="deadtime">
                                <span><?php echo get_phrase('duration'); ?> :</span><i class="picons-thin-icon-thin-0026_time_watch_clock"></i><?php $minutes = number_format($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->duration);
                                                                                                                                                echo $minutes; ?> <?php echo get_phrase('minutes'); ?>
                              </div>
                              <a href="<?php echo base_url(); ?>admin/examroom/<?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->online_exam_id; ?>/"><button class="btn btn-rounded btn-posts verde"><i class="picons-thin-icon-thin-0014_notebook_paper_todo"></i> <?php echo get_phrase('view_exam'); ?></button></a>
                            </div>
                          </div>
                          <div class="control-block-button post-control-button">
                            <a href="javascript:void(0);" class="btn btn-control" style="background-color: #a01a7a; color: #fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('online_exams'); ?>">
                              <i class="picons-thin-icon-thin-0207_list_checkbox_todo_done"></i>
                            </a>
                          </div>
                        </article>
                      </div>
                    <?php endif; ?>
                    <?php if ($wall['wall_type'] == 'forum') : ?>
                      <div class="ui-block">
                        <article class="hentry post thumb-full-width">
                          <div class="post__author author vcard inline-items">
                            <img src="<?php echo $this->crud_model->get_image_url($this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->type, $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->teacher_id); ?>" class="user-avatar circle purple" style="line-height: 0px">
                            <div class="author-date">
                              <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud_model->get_name($this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->type, $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->teacher_id); ?></a>
                              <div class="post__date">
                                <time class="published">
                                  <?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->upload_date; ?>
                                </time>
                              </div>
                            </div>
                            <div class="more">
                              <i class="icon-options"></i>
                              <ul class="more-dropdown">
                                <li><a href="<?php echo base_url(); ?>admin/edit_forum/<?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->post_code; ?>/"><?php echo get_phrase('edit'); ?></a></li>
                                <li><a class="delete" href="<?php echo base_url(); ?>admin/forum/delete/<?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->post_code; ?>/<?php echo $data; ?>"><?php echo get_phrase('delete'); ?></a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="edu-posts cta-with-media verde">
                            <div class="cta-content">
                              <div class="highlight-header yellow">
                                <?php echo $row['name']; ?>
                              </div>
                              <div class="grado">
                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                              </div>
                              <h3 class="cta-header"><?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->title; ?></h3>
                              <div class="descripcion">
                                <?php echo strip_tags($this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->description); ?>
                              </div>
                              <a href="<?php echo base_url(); ?>admin/forumroom/<?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->post_code; ?>/"><button class="btn btn-rounded btn-posts"><i class="picons-thin-icon-thin-0014_notebook_paper_todo"></i> <?php echo get_phrase('view_forum'); ?></button></a>
                            </div>
                          </div>
                          <div class="control-block-button post-control-button">
                            <a href="javascript:void(0);" class="btn btn-control" style="background-color: #f4af08; color: #fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('forum'); ?>">
                              <i class="picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i>
                            </a>
                          </div>
                        </article>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php elseif ($db->num_rows() == 0) : ?>
                  <div class="ui-block">
                    <article class="hentry post thumb-full-width">
                      <div class="edu-posts cta-with-media">
                        <br><br>
                        <center>
                          <h3><?php echo get_phrase('no_recent_activity'); ?></h3>
                        </center><br>
                        <center><img src="<?php echo base_url(); ?>uploads/icons/norecent.svg" width="55%"></center>
                        <br><br>
                      </div>
                    </article>
                  </div>
                <?php endif; ?>
              </div>
            </main>

            <div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
              <div class="crumina-sticky-sidebar">
                <div class="sidebar__inner">
                  <div class="ui-block">
                    <div class="ui-block-title">
                      <h6 class="title"><?php echo "Koordinator Pelajaran"; ?></h6>
                    </div>
                    <div class="ui-block-content">
                      <div class="widget w-about">
                        <a href="javascript:void(0);" class="logo">
                          <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>"><br />
                        </a>
                        <?php $tch = $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->teacher_id; ?>
                        <div class="post__author author vcard inline-items" style="text-align: center;">
                          <img src="<?php echo $this->crud_model->get_image_url('teacher', $tch); ?>" class="user-avatar circle purple" style="line-height: 0px; width: auto;">
                          <div class="author-date">
                            <h5 style="padding-left: 10px;"><?php echo $this->crud_model->get_name('teacher', $tch) ?><br> <small><?php echo $this->db->get_where('teacher', array('teacher_id' => $tch))->row()->phone; ?></small></h5>
                          </div>
                        </div>
                        <ul class="socials">
                          <li><a target="_blank" href="<?php echo $this->db->get_where('settings', array('type' => 'facebook'))->row()->description; ?>"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
                          <li><a target="_blank" href="<?php echo $this->db->get_where('settings', array('type' => 'twitter'))->row()->description; ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                          <li><a target="_blank" href="<?php echo $this->db->get_where('settings', array('type' => 'youtube'))->row()->description; ?>"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                          <li><a target="_blank" href="<?php echo $this->db->get_where('settings', array('type' => 'instagram'))->row()->description; ?>"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="ui-block">
                    <div class="ui-block-title">
                      <h6 class="title"><?php echo get_phrase('subject_activity'); ?></h6>
                    </div>
                    <?php
                    $this->db->order_by('id', 'desc');
                    $this->db->group_by('notify');
                    $notifications = $this->db->get_where('notification', array('class_id' => $ex[0], 'section_id' => $ex[1], 'subject_id' => $ex[2], 'year' => $running_year));
                    if ($notifications->num_rows() > 0) :
                    ?>
                      <ul class="widget w-activity-feed notification-list">
                        <?php foreach ($notifications->result_array() as $notify) : ?>
                          <li>
                            <div class="author-thumb">
                              <img src="<?php echo base_url(); ?>uploads/notify.svg">
                            </div>
                            <div class="notification-event">
                              <a href="javascript:void(0);" class="notification-friend"><?php echo $notify['notify']; ?>.</a>
                              <span class="notification-date"><time class="entry-date updated"><?php echo $notify['date']; ?> <?php echo get_phrase('at'); ?> <?php echo $notify['time']; ?></time></span>
                            </div>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    <?php else : ?>
                      <br><br><br>
                      <center>
                        <h6><?php echo get_phrase('no_subject_activity'); ?></h6>
                      </center>
                      <br><br><br>
                    <?php endif; ?>
                  </div>
                  <div class="ui-block">
                    <div class="ui-block-title">
                      <h6 class="title"><?php echo get_phrase('latest_news'); ?></h6>
                    </div>
                    <div class="ui-block-content">
                      <ul class="widget w-personal-info item-block">
                        <?php
                        $this->db->limit(5);
                        $this->db->order_by('news_id', 'desc');
                        $news = $this->db->get('news')->result_array();
                        foreach ($news as $row5) :
                        ?>
                          <li><span class="text"><?php echo $row5['description']; ?></span></li>
                          <hr>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
              <div class="crumina-sticky-sidebar">
                <div class="sidebar__inner">
                  <div class="ui-block paddingtel">
                    <div class="ui-block-title">
                      <h6 class="title"><?php echo get_phrase('about_the_subject'); ?></h6>
                    </div>
                    <div class="ui-block-content">
                      <ul class="widget item-block">
                        <li>
                          <span class="text"><?php echo $row['about']; ?></span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="ui-block paddingtel">
                    <div class="ui-block-title">
                      <h6 class="title"><?php echo get_phrase('subject_stats'); ?></h6>
                    </div>
                    <div class="ui-block-content">
                      <div style="margin-bottom:10px">
                        <span class="subjectCounter"><?php echo $this->academic_model->countOnlineExams($ex[0], $ex[1], $ex[2]); ?></span>
                        <span class="counterText h6"><?php echo get_phrase('online_exams'); ?>.</span>
                      </div>
                      <div style="margin-bottom:10px">
                        <span class="subjectCounter"><?php echo $this->academic_model->countHomeworks($ex[0], $ex[1], $ex[2]); ?></span>
                        <span class="counterText h6"><?php echo get_phrase('homework'); ?>.</span>
                      </div>
                      <div style="margin-bottom:10px">
                        <span class="subjectCounter"><?php echo $this->academic_model->countForums($ex[0], $ex[1], $ex[2]); ?></span>
                        <span class="counterText h6"><?php echo get_phrase('forums'); ?>.</span>
                      </div>
                      <div style="margin-bottom:10px">
                        <span class="subjectCounter"><?php echo $this->academic_model->countMaterial($ex[0], $ex[1], $ex[2]); ?></span>
                        <span class="counterText h6"><?php echo get_phrase('study_material'); ?>.</span>
                      </div>
                      <div style="margin-bottom:10px">
                        <span class="subjectCounter"><?php echo $this->academic_model->countLive($ex[0], $ex[1], $ex[2]); ?></span>
                        <span class="counterText h6"><?php echo get_phrase('live_classes'); ?>.</span>
                      </div>
                    </div>
                  </div>
                  <div class="ui-block paddingtel">
                    <div class="ui-block-title">
                      <h6 class="title"><?php echo get_phrase('students'); ?></h6>
                    </div>
                    <ul class="widget w-friend-pages-added notification-list friend-requests">
                      <?php $students   =   $this->db->get_where('enroll', array('class_id' => $ex[0], 'section_id' => $ex[1], 'year' => $running_year))->result_array();
                      foreach ($students as $row2) : ?>
                        <li class="inline-items">
                          <div class="author-thumb">
                            <img src="<?php echo $this->crud_model->get_image_url('student', $row2['student_id']); ?>" width="35px" class="user-avatar circle purple" style="line-height: 0px">
                          </div>
                          <div class="notification-event">
                            <a href="javascript:void(0);" class="h6 notification-friend"><?php echo $this->crud_model->get_name('student', $row2['student_id']) ?></a>
                            <span class="chat-message-item"><?php echo get_phrase('roll'); ?>: <?php echo $this->db->get_where('enroll', array('student_id' => $row2['student_id']))->row()->roll; ?></span>
                          </div>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class="back-to-top" href="javascript:void(0);">
        <img src="<?php echo base_url(); ?>style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
      </a>
    </div>
  </div>
  </div>
<?php endforeach; ?>