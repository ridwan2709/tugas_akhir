<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$info = base64_decode($data);
$ex = explode('-', $info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach ($sub as $subs) :
?>
  <div class="content-w">
    <div class="conty">
      <?php include 'fancy.php'; ?>
      <div class="header-spacer"></div>
      <div class="cursos cta-with-media" style="background: #<?php echo $subs['color']; ?>;">
        <div class="cta-content">
          <div class="user-avatar">
            <img alt="" src="<?php echo base_url(); ?>uploads/subject_icon/<?php echo $subs['icon']; ?>" style="width:60px;">
          </div>
          <h3 class="cta-header"><?php echo $subs['name']; ?> - <small><?php echo get_phrase('marks'); ?></small></h3>
          <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"</small>
        </div>
      </div>
      <!-- Menu -->
        <?php include 'menu_akademic.php' ?>
      <!-- End Menu -->
      <div class="content-i">
        <div class="content-box">
          <div class="row">
            <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
              <div class="ui-block">
                <article class="hentry post thumb-full-width">
                  <div class="post__author author vcard inline-items">
                    <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>" style="border-radius:0px">
                    <div class="author-date">
                      <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo get_phrase('upload_marks'); ?> <small>(<?php echo $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name; ?>)</small>.</a>
                    </div>
                  </div>
                  <div class="edu-posts cta-with-media">
                    <div style="padding:0% 0%">
                      <div id='cssmenu'>
                        <ul>
                          <?php
                          $var = 0;
                          $examss = $this->db->get('exam')->result_array();
                          foreach ($examss as $exam) :
                            $var++;
                          ?>
                            <li class='<?php if ($exam['exam_id'] == $exam_id) echo "act"; ?>'><a href="<?php echo base_url(); ?>admin/upload_marks/<?php echo $data . '/' . $exam['exam_id']; ?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><?php echo $exam['name']; ?></a></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <?php echo form_open(base_url() . 'admin/marks_update/' . $exam_id . '/' . $ex[0] . '/' . $ex[1] . '/' . $ex[2]); ?>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr style="background:#f2f4f8;">
                          <th style="text-align: center; vertical-align: middle"><?php echo get_phrase('student'); ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->la1; ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->la2; ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->la3; ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->la4; ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->la5; ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->la6; ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->la7; ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->la8; ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->la9; ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->la10; ?></th>
                          <th style="text-align: center; vertical-align: middle"><?php echo get_phrase('comment'); ?></th>
                          <th style="text-align: center; vertical-align: middle">pilihan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $count = 1;
                        $marks_of_students = $this->db->get_where('mark', array('class_id' => $ex[0], 'section_id' => $ex[1], 'year' => $running_year, 'subject_id' => $ex[2], 'exam_id' => $exam_id))->result_array();
                        foreach ($marks_of_students as $row) :
                        ?>
                          <tr style="height:25px;">
                            <td style="min-width:190px">
                              <img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" width="25px" class="user-avatar circle purple" style="line-height: 0px"> <?php echo $this->crud_model->get_name('student', $row['student_id']); ?>
                            </td>
                            <td class="text-center">
                              <center><?php echo $row['mark_obtained']; ?></center>
                            </td>
                            <td>
                              <center><?php echo $row['labuno']; ?></center>
                            </td>
                            <td>
                              <center><?php echo $row['labdos']; ?></center>
                            </td>
                            <td>
                              <center><?php echo $row['labtres']; ?></center>
                            </td>
                            <td>
                              <center><?php echo $row['labcuatro']; ?></center>
                            </td>
                            <td>
                              <center><?php echo $row['labcinco']; ?></center>
                            </td>
                            <td>
                              <center><?php echo $row['labseis']; ?></center>
                            </td>
                            <td>
                              <center><?php echo $row['labsiete']; ?></center>
                            </td>
                            <td>
                              <center><?php echo $row['labocho']; ?></center>
                            </td>
                            <td>
                              <center><?php echo $row['labnueve']; ?></center>
                            </td>
                            <td>
                              <center><?php echo $row['comment']; ?></center>
                            </td>
                            <td>
                              <center>
                                <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_mark/<?= $row['mark_id'] ?>/<?= $ex[2] ?>');" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0001_compose_write_pencil_new" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit'); ?>"></i></a>
                              </center>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="control-block-button post-control-button">
                    <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_mark/<?php echo $ex[2]; ?>/<?php echo $ex[1]; ?>');" class="btn btn-control featured-post" style="background-color: #99bf2d; color: #fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('update_activities'); ?>">
                      <i class="picons-thin-icon-thin-0102_notebook_to_do_bullets_list"></i>
                    </a>
                  </div>
                </article>
              </div>
            </main>

          </div>
        </div>
        <a class="back-to-top" href="javascript:void(0);">
          <img src="<?php echo base_url(); ?>style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
        </a>
      </div>
    </div>
  </div>

<?php endforeach; ?>