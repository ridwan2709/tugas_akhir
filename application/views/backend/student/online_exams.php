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
                    <h3 class="cta-header"><?php echo $row['name']; ?> - <small><?php echo get_phrase('online_exams'); ?></small></h3>
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
                                                    $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
                                                    $student_id = $this->session->userdata('login_user_id');
                                                    $subject_id = $ex[2];
                                                    $class_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->class_id;
                                                    $section_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->section_id;
                                                    $this->db->order_by("online_exam_id", "dsc");
                                                    if ($section_id == 1 or $section_id == 2 or $section_id == 3) {
                                                        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id, 'status' => 'published');
                                                    } else {
                                                        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'subject_id' => $subject_id, 'status' => 'published');
                                                    }
                                                    $exams = $this->db->where($match)->get('online_exam')->result_array();
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
                                                                <?php if ($this->crud_model->check_availability_for_student($row['online_exam_id']) != "submitted") :
                                                                    if ($current_time >= $exam_start_time && $current_time <= $exam_end_time) : ?>
                                                                        <a href="<?php echo base_url(); ?>student/examroom/<?php echo $row['code']; ?>/" class="btn btn-success btn-rounded"><?php echo get_phrase('take_exam'); ?></a>
                                                                    <?php else : ?>
                                                                        <div class="btn btn-info btn-rounded">
                                                                            <?php echo get_phrase('take_exam_message'); ?>
                                                                        </div>
                                                                    <?php endif;
                                                                else :
                                                                    if ($current_time > $exam_end_time) :
                                                                    ?>
                                                                        <a href="<?php echo base_url(); ?>student/online_exam_result/<?php echo $row['online_exam_id']; ?>/" class="btn btn-success btn-rounded"><?php echo get_phrase('view_results'); ?></a>
                                                                    <?php else : ?>
                                                                        <a href="javascript:void(0);" class="btn btn-warning btn-roundend"><?php echo get_phrase('waiting_results'); ?></a>
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
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>