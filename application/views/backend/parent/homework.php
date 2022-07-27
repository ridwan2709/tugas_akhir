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
?>

<?php $sub = $this->db->get_where('subject', array('subject_id' => $ex[1]))->result_array();
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
                          $homeworks = $this->db->order_by('homework_id', 'desc')->get_where('homework', array('class_id' => $ex[0], 'status' => 1, 'section_id' => $ex[0], 'subject_id' => $ex[1]))->result_array();
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
                                <a style="color:grey;" href="<?php echo base_url(); ?>parents/homeworkroom/<?php echo $row['homework_code']; ?>/<?php echo $ex[3]; ?>/" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view'); ?>"><i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i></a>
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