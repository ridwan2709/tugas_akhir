<?php $min = $this->db->get_where('academic_settings', array('type' => 'minium_mark'))->row()->description;
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$student = $this->db->get_where('student', array('student_id' => $this->session->userdata('login_user_id')))->result_array();
?>
<div class="content-w">
  <div class="conty">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="content-i">
      <div class="content-box">
        <div class="row">
          <?php foreach ($student as $row) { ?>
            <div class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
              <div id="newsfeed-items-grid">
                <div class="ui-block paddingtel">
                  <div class="user-profile">
                    <div class="up-head-w" style="background-image:url(<?php echo base_url(); ?>uploads/bglogin.jpg)">
                      <div class="up-main-info">
                        <div class="user-avatar-w">
                          <div class="user-avatar">
                            <img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" style="background-color:#fff;">
                          </div>
                        </div>
                        <h3 class="text-white"><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></h3>
                        <h5 class="up-sub-header">@<?php echo $row['username']; ?></h5>
                      </div>
                      <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF">
                          <path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path>
                        </g>
                      </svg>
                    </div>
                    <div class="up-controls">
                      <div class="row">
                        <div class="col-lg-8">
                          <div class="value-pair">
                            <div><?php echo get_phrase('account_type'); ?>:</div>
                            <div class="value badge badge-pill badge-primary"><?php echo get_phrase('student'); ?></div>
                          </div>
                          <div class="value-pair">
                            <div><?php echo get_phrase('member_since'); ?>:</div>
                            <div class="value"><?php echo $row['since']; ?>.</div>
                          </div>
                          <div class="value-pair">
                            <div><?php echo get_phrase('roll'); ?>:</div>
                            <div class="value"><?php echo $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->roll; ?>.</div>
                          </div>
                          <div class="value-pair">
                            <div>Tahun Ajaran:</div>
                            <div class="value">
                              <select name="tahun_ajaran" id="tahunAjaran" required="" onchange="pilihTahunAjaran()" style="padding:0px 15px 0px 15px">
                                <option value="0">Pilih</option>
                                <?php
                                $tahun_ajaran = $_GET['year'];
                                if (!$tahun_ajaran) {
                                  $tahun_ajaran = $running_year;
                                }
                                ?>
                                <?php $this->db->select('year');
                                $this->db->group_by('year');
                                $mengambil_tahun_ajaran = $this->db->get('enroll')->result_array();
                                foreach ($mengambil_tahun_ajaran as $thn_ajar) : ?>
                                  <option value="<?php echo $thn_ajar['year'] ?>" <?php if ($tahun_ajaran == $thn_ajar['year']) echo 'selected'; ?>><?php echo $thn_ajar['year'] ?>
                                  </option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="element-box lined-success">
                    <h5 class="form-header">Tugas/Project:</h5>
                    <div>
                      <?php echo $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->project; ?>
                    </div>
                  </div>
                </div>
                <?php
                $student_info = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->result_array();
                $exams = $this->db->get('exam')->result_array();
                foreach ($student_info as $row1) :
                  foreach ($exams as $row2) :
                ?>
                    <div class="col-sm-12">
                      <div class="element-box lined-primary shadow">
                        <h5 class="form-header"><?php echo get_phrase('your_marks'); ?><br>
                          <small><?php echo $row2['name']; ?></small><br>
                          <small>Tahun Ajaran: <?= $tahun_ajaran ?></small>
                        </h5>
                        <div class="table-responsive">
                          <table class="table table-lightborder">
                            <thead>
                              <tr>
                                <th><?php echo get_phrase('subject'); ?></th>
                                <th><?php echo get_phrase('teacher'); ?></th>
                                <th><?php echo get_phrase('mark'); ?></th>
                                <th><?php echo get_phrase('grade'); ?></th>
                                <th><?php echo get_phrase('comment'); ?></th>
                                <th><?php echo get_phrase('view_all'); ?></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $subjects = $this->db->get_where('subject', array('class_id' => $row1['class_id']))->result_array();
                              foreach ($subjects as $row3) :
                                $obtained_mark_query = $this->db->get_where('mark', array(
                                  'subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'class_id' => $row1['class_id'], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran
                                ));
                                if ($obtained_mark_query->num_rows() > 0) {
                                  $marks = $obtained_mark_query->result_array();
                                } else {
                                  continue;
                                }
                                foreach ($marks as $row4) :
                                  $nilaiYangDiisi = 0;
                                  $jumlahNilai = 0;
                                  $rata2 = 0;
                                  foreach ($row4 as $key => $value) {
                                    /**
                                     * Jika kata depan bukan lab atau bukan mark obtained
                                     * dan bukan labtotal
                                     * 
                                     * maka diskip
                                     */
                                    $status = (strpos($key, 'lab') === 0 || $key === 'mark_obtained') && $key !== 'labtotal' && $value !== "";
                                    if (!$status) continue;

                                    $jumlahNilai += $value;
                                    $nilaiYangDiisi++;
                                  }
                                  $rata2 = $jumlahNilai / $nilaiYangDiisi;

                                  if ($rata2 === 0) continue;

                                  if ($nilaiYangDiisi === 0) continue
                              ?>
                                  <tr>
                                    <td><?php echo $row3['name']; ?></td>
                                    <td><img alt="" src="<?php echo $this->crud_model->get_image_url('teacher', $row3['teacher_id']); ?>" width="25px" class="user-avatar circle purple" style="line-height: 0px"> <?php echo $this->crud_model->get_name('teacher', $row3['teacher_id']); ?></td>
                                    <td><?php if ($rata2 < $min || $rata2 == 0) : ?>
                                        <a class="btn btn-rounded btn-sm btn-danger" style="color:white"><?php if ($rata2 == 0) echo '0';
                                                                                                          else echo round($rata2); ?></a>
                                      <?php endif; ?>
                                      <?php if ($rata2 >= $min) : ?>
                                        <a class="btn btn-rounded btn-sm btn-info" style="color:white"><?php echo round($rata2) ?></a>
                                      <?php endif; ?>
                                    </td>
                                    <td><?php echo $grade = $this->crud_model->get_grade(round($rata2)); ?></td>
                                    <td><?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->comment; ?></td>
                                    <?php $data = base64_encode($row2['exam_id'] . "-" . $this->session->userdata('login_user_id') . "-" . $row3['subject_id']); ?>
                                    <td><a class="btn btn-rounded btn-sm btn-primary" style="color:white" href="<?php echo base_url(); ?>student/subject_marks/<?php echo $data; ?>/<?php echo $row2['exam_id']; ?>/<?= $tahun_ajaran ?>"><?php echo get_phrase('view_all'); ?></a></td>
                                  </tr>
                              <?php endforeach;
                              endforeach; ?>
                            </tbody>
                          </table>
                          <div class="form-buttons-w text-right">
                            <a target="_blank" href="<?php echo base_url(); ?>student/marks_print_view/<?php echo base64_encode($this->session->userdata('login_user_id') . '-' . $row2['exam_id']); ?>/<?= $tahun_ajaran ?>"><button class="btn btn-rounded btn-success" type="submit"><i class="picons-thin-icon-thin-0333_printer"></i> <?php echo get_phrase('print'); ?></button></a>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php endforeach;
                endforeach; ?>
              </div>
            </div>
        </div>
      </div>
    </div>

    <script>
      function pilihTahunAjaran() {
        var tahunAjaran = document.getElementById("tahunAjaran").value;
        window.location.href = "<?= base_url('student/my_marks?year=') ?>" + tahunAjaran;
        return false;
      }
    </script>