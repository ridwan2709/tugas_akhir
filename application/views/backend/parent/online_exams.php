<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$class_info = $this->db->get('class')->result_array();
$info = base64_decode($data);
$ex = explode('-', $info);

// ambil level student
$query = "SELECT st.first_name, en.*, sc.name, DATE_FORMAT(FROM_UNIXTIME(en.date_added), '%Y-%m-%d %H:%i:%s') AS 'date_formatted'
FROM enroll en
INNER JOIN student st ON st.student_id = en.student_id
INNER JOIN section sc ON sc.class_id = en.class_id
WHERE st.student_id = '" . $ex[2] . "' 
AND sc.section_id = en.section_id
AND en.date_added = (SELECT MAX(date_added) FROM enroll WHERE student_id = '" . $ex[2] . "')
ORDER BY date_formatted  DESC";
$r_level_student = $this->db->query($query);
$row_level_student = $r_level_student->row();
$level_student = (isset($row_level_student) ? $row_level_student->name : "");
$sub = $this->db->get_where('subject', array('subject_id' => $ex[1]))->result_array();

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
          <h3 class="cta-header"><?php echo $row['name']; ?> - <small><?php echo get_phrase('online_exams'); ?></small></h3>
          <small style="font-size:0.90rem; color:#fff;"><?php echo $this->crud_model->get_name('student', $ex[2]); ?></small>
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
                    <h6 class="element-header"><?php echo get_phrase('online_exams'); ?></h6>
                    <div class="table-responsive">
                      <table class="table table-padded">
                        <thead>
                          <tr>
                            <th><?php echo get_phrase('title'); ?></th>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th>Pembuat Soal</th>
                            <th><?php echo get_phrase('options'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($exams as $row) :
                            $current_time = time();
                            $exam_start_time = strtotime(date('Y-m-d', $row['exam_date']) . ' ' . $row['time_start']);
                            $exam_end_time = strtotime(date('Y-m-d', $row['exam_date']) . ' ' . $row['time_end']);
                          ?>
                            <tr>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo '<b>' . get_phrase('date') . ' :</b> ' . date('M d, Y', $row['exam_date']) . '<br>' . '<b>Masa Aktif :</b> ' . $row['time_start'] . ' - ' . $row['time_end'] . '<br>' . '<b>Durasi :</b> ' . $row['duration']; ?> Menit</td>
                              <td><span><?php echo $this->crud_model->get_name($this->db->get_where('online_exam', array('online_exam_id' => $row['online_exam_id']))->row()->uploader_type, $this->db->get_where('online_exam', array('online_exam_id' => $row['online_exam_id']))->row()->uploader_id); ?></a></span></td>
                              <td class="bolder">
                                <?php if ($this->crud_model->parent_check_availability_for_student($row['online_exam_id'], $ex[2]) != "submitted") : ?>
                                  <span class="btn btn-info btn-rounded"><?php echo get_phrase('waiting_information'); ?></span>
                                  <?php else :
                                  if ($current_time > $exam_end_time) : ?>
                                    <a href="<?php echo base_url(); ?>parents/online_exam_result/<?php echo $row['online_exam_id']; ?>/<?php echo $ex[2]; ?>/" class="btn btn-primary btn-rounded"><?php echo get_phrase('view_results'); ?></a>
                                  <?php else : ?>
                                    <a href="javascript:void(0);" class="btn btn-warning btn-roundend"><?php echo get_phrase('waiting_results'); ?>.</a>
                                <?php endif;
                                endif; ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
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