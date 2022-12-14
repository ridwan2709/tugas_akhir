<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$class_info = $this->db->get('class')->result_array();
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
          <h3 class="cta-header"><?php echo $row['name']; ?> - <small><?php echo get_phrase('homework'); ?></small></h3>
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
              <div id="newsfeed-items-grid">
                <div class="element-wrapper">
                  <div class="element-box-tp">
                    <h6 class="element-header"><?php echo get_phrase('homework'); ?></h6>
                    <div class="table-responsive">
                      <table class="table table-padded">
                        <thead>
                          <tr>
                            <th><?php echo get_phrase('title'); ?></th>
                            <th><?php echo get_phrase('type'); ?></th>
                            <th><?= 'pembuat tugas'; ?></th>
                            <th><?php echo get_phrase('allow_homework_deliveries'); ?></th>
                            <th><?php echo get_phrase('options'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $counter = 1;
                          $class_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->class_id;
                          $section_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->section_id;
                          $this->db->order_by('homework_id', 'desc');
                          $homeworks = $this->db->get_where('homework', array('class_id' => $class_id, 'status' => 1, 'section_id' => $section_id, 'subject_id' => $ex[2]))->result_array();
                          foreach ($homeworks as $row) :
                          ?>
                            <tr>
                              <td><span><?php echo $row['title']; ?></span></td>
                              <td>
                                <?php if ($row['type'] == 1) : ?>
                                  <span class="badge badge-success"><?php echo get_phrase('online_text'); ?></span>
                                <?php endif; ?>
                                <?php if ($row['type'] == 2) : ?>
                                  <span class="badge badge-info"><?php echo get_phrase('files'); ?></span>
                                <?php endif; ?>
                              </td>
                              <td><?= $this->crud_model->get_name($row['uploader_type'], $row['uploader_id']); ?></td>
                              <td><?php echo $row['date_end']; ?></td>
                              <td class="bolder">
                                <a style="color:grey;" href="<?php echo base_url(); ?>student/homeworkroom/<?php echo $row['homework_code']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view_homework'); ?>"><i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i></a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </main>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>