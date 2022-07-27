<?php include('header.php'); ?>

<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <a href="<?= base_url('/rapor') ?>">
          <h2>Cek Rapor</h2>
        </a>
        <ol>
          <li><a href="<?= base_url('/#hero') ?>">Home</a></li>
          <li>Nilai Rapor</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Rapor Section ======= -->
  <section id="rapor" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="sidebar" style="margin: 0 0 0 0; box-shadow: none">

        <h5 class="sidebar-title">Hasil Pencarian</h5>

        <?php $student_info = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
        foreach ($student_info as $row) :
        ?>
          <div class="card" style="height: 250px; position: relative; background-image:url(<?php echo base_url(); ?>uploads/bglogin.jpg); background-size: 100% 500px; object-fit: cover; background-position: 0px; ">
            <div class="card-body" style="z-index: 9;">
              <div class="user-info py-3">
                <div class="user-avatar w-25" style="border-radius: 50%; width: 25%;">
                  <img alt="" src="<?php echo $this->crud_model->get_image_url('student', $student_id); ?>" style="background-color:#fff; border-radius: 50%; width: 40%; box-shadow: 0px 0px 10px #ddd;">
                </div>
                <h3 class="text-white pt-2"><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></h3>
              </div>
            </div>
            <svg class="decor" width="100%" height="201px" style="position: absolute; z-index: 9; bottom: -8px; margin: -1px; right: -1px;" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF">
                <path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path>
              </g>
            </svg>
            <div style="position: absolute; z-index: 1; top: 0; bottom: 0; right: 0; left: 0; background: black; opacity: .4;"></div>
          </div>

          <div class="up-controls" style="width: 100%; background: white;">
            <div class="row py-2">
              <div class="col-lg-12 col-md-12 col-sm-12 d-flex">
                <div class="value-pair" style="padding: 10px 20px; border-right: 1px solid #ddd; font: 400 normal 13px/15px Arial;">
                  <div style="font-weight: bold; padding: 5px;"><?php echo get_phrase('roll'); ?>:</div>
                  <div style="padding: 5px" class="value"><?php echo $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->roll; ?>.</div>
                </div>
                <div class="value-pair" style="padding: 10px 20px; border-right: 1px solid #ddd; font: 400 normal 13px/15px Arial;">
                  <div style="font-weight: bold; padding: 5px;"><?php echo get_phrase('class'); ?>:</div>
                  <?php
                  $class_id = $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->class_id;
                  $section_id = $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->section_id; ?>
                  <div style="padding: 5px" class="value"><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?>.</div>
                </div>
                <?php
                // $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
                // $no_serial = $this->db->get_where('enroll', ['student_id' => $row['student_id'], 'year' => $running_year])->row()->no_serial;
                ?>
                <div class="value-pair" style="padding: 10px 20px; font: 400 normal 13px/15px Arial;">
                  <div style="font-weight: bold; padding: 5px;">No. Seri Rapor:</div>
                  <div style="padding: 5px" class="value"><?php echo $no_serial; ?>.</div>
                </div>
              </div>
            </div>
            <?php $min = $this->db->get_where('academic_settings', array('type' => 'minium_mark'))->row()->description; ?>
            <?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>

            <?php
            $student_info = $this->db->get_where('enroll', array('student_id' => $student_id, 'no_serial' => $no_serial))->result_array();
            $exams = $this->db->get('exam')->result_array();
            foreach ($student_info as $row1) :
              foreach ($exams as $row2) :
            ?>
                <div class="card mb-3">
                  <div class="card-header text-center">
                    <?php $exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name; ?>
                    <h5 style="font-weight: bold"><?php echo $exam_name; ?>
                      <?php echo $row2['name']; ?></h5>
                    <h5>Tahun Ajaran <?php echo $tahun_ajaran ?></h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-lightborder">
                        <thead>
                          <tr style="text-align: center;">
                            <th><?php echo get_phrase('subject'); ?></th>
                            <th><?php echo get_phrase('teacher'); ?></th>
                            <th><?php echo get_phrase('mark'); ?></th>
                            <th><?php echo get_phrase('grade'); ?></th>
                            <th width='350'><?php echo get_phrase('comment'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $subjects = $this->db->get_where('subject', array('class_id' => $row1['class_id']))->result_array();
                          foreach ($subjects as $row3) :
                            $this->db->group_by('subject_id');
                            $obtained_mark_query = $this->db->get_where('mark', array(
                              'subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'class_id' => $row1['class_id'], 'student_id' => $student_id, 'year' => $tahun_ajaran
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
                                <td><img alt="" src="<?php echo $this->crud_model->get_image_url('teacher', $row3['teacher_id']); ?>" width="25px" style="border-radius: 10px;margin-right:5px;"> <?php echo $this->crud_model->get_name('teacher', $row3['teacher_id']); ?> <br></td>
                                <td style="text-align: center"><?php if ($rata2 < $min || $rata2 == 0) : ?>

                                    <a class="btn btn-rounded btn-sm btn-danger" style="color:white"><?php if ($rata2 == 0) echo '0';
                                                                                                      else echo round($rata2); ?></a>
                                  <?php endif; ?>
                                  <?php if ($rata2 >= $min) : ?>
                                    <a class="btn btn-rounded btn-sm btn-info" style="color:white"><?php echo round($rata2) ?></a>
                                  <?php endif; ?>
                                </td>
                                <td style="text-align: center"><?php echo $grade = $this->crud_model->get_grade(round($rata2)); ?></td>
                                <td><?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $row1['student_id'], 'year' => $tahun_ajaran))->row()->comment; ?></td>
                                <?php $data = base64_encode($row2['exam_id'] . "-" . $this->session->userdata('login_user_id') . "-" . $row3['subject_id']); ?>
                              </tr>
                          <?php endforeach;
                          endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            <?php endforeach;
            endforeach; ?>

          <?php endforeach; ?>

          </div>

      </div>

    </div>
  </section><!-- End Rapor Section -->

</main><!-- End #main -->

<?php include ('footer.php'); ?>