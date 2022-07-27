<?php
$min = $this->db->get_where('academic_settings', array('type' => 'minium_mark'))->row()->description;
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
<div class="content-w">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="conty">
        <div class="content-i">
            <div class="content-box">
                <div class="os-tabs-w">
                    <div class="os-tabs-controls">
                        <ul class="navs navs-tabs upper">
                            <?php
                            $n = 1;
                            $children_of_parent = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                            foreach ($children_of_parent as $row) :
                            ?>
                                <li class="nav-item">
                                    <?php $active = $n++; ?>
                                    <a class="navs-links <?php if ($active == 1) echo 'active'; ?>" data-toggle="tab" href="#<?php echo $row['username']; ?>"><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" width="25px" style="border-radius: 25px;margin-right:5px;" class="user-avatar circle purple" style="line-height: 0px"> <?php echo $this->crud_model->get_name('student', $row['student_id']); ?></a>
                                </li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <?php
                    $n = 1;
                    $children_of_parent = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                    foreach ($children_of_parent as $row2) :
                    ?>
                        <?php $active = $n++; ?>
                        <div class="tab-pane <?php if ($active == 1) echo 'active'; ?>" id="<?php echo $row2['username']; ?>">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    $student_info = $this->db->get_where('enroll', array('student_id' => $row2['student_id'], 'year' => $running_year))->result_array();
                                    foreach ($student_info as $row) :
                                    ?>
                                        <div class="pipeline white lined-secondary">
                                            <div class="pipeline-header">
                                                <h5 class="pipeline-name"><?php echo get_phrase('student'); ?></h5>
                                            </div>
                                            <div class="pipeline-item">
                                                <div class="pi-foot">
                                                    <a class="extra-info" href="javascript:void(0);"><img alt="" src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>" width="40px" style="margin-right:5px"><span class="text-white"><?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?></span></a>
                                                </div>
                                                <div class="pi-body bglogo">
                                                    <div class="avatar">
                                                        <img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="user-avatar circle purple" style="line-height: 0px">
                                                    </div>
                                                    <div class="pi-info">
                                                        <div class="h6 pi-name">
                                                            <?php echo $this->crud_model->get_name('student', $row['student_id']) ?><br>
                                                            <small><?php echo get_phrase('roll'); ?>: <?php echo $this->db->get_where('enroll', array('student_id' => $row2['student_id']))->row()->roll; ?></small>
                                                        </div>
                                                        <div class="pi-sub">
                                                            <?php echo get_phrase('class'); ?>: <?php echo $this->crud_model->get_class_name($row['class_id']); ?><br>
                                                            <?php echo get_phrase('section'); ?>: <?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name; ?> <br>
                                                            <b class="my-4">Pilih Tahun Ajaran:</b> <br>
                                                            <div class="select">
                                                                <select class="" name="tahun_ajaran" id="tahunAjaran" required="" onchange="pilihTahunAjaran()">
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
                                    <?php
                                    endforeach;
                                    ?>
                                </div>
                                <div class="col-sm-12">
                                    <div class="element-box lined-success">
                                        <h5 class="form-header">Tugas/Project:</h5>
                                        <?php echo $this->db->get_where('enroll', array('student_id' => $row2['student_id'], 'year' => $tahun_ajaran))->row()->project; ?>
                                    </div>
                                </div>
                                <?php
                                $student_info = $this->db->get_where('enroll', array('student_id' => $row2['student_id'], 'year' => $tahun_ajaran))->result_array();
                                $exams = $this->db->get_where('exam')->result_array();
                                foreach ($student_info as $row1) :
                                    foreach ($exams as $row2) :
                                ?>
                                        <div class="col-sm-12">
                                            <div class="element-box lined-primary shadow">
                                                <h5 class="form-header"><?php echo get_phrase('marks'); ?><br>
                                                    <small><?php echo $row2['name']; ?></small><br>
                                                    <small>Tahun Ajaran: <?php echo $tahun_ajaran; ?></small>
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
                                                                    'subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'class_id' => $row1['class_id'], 'student_id' => $row1['student_id'], 'year' => $tahun_ajaran
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
                                                                        if (!$status)
                                                                            continue;

                                                                        $jumlahNilai += $value;
                                                                        $nilaiYangDiisi++;
                                                                    }
                                                                    $rata2 = $jumlahNilai / $nilaiYangDiisi;
                                                                    if ($rata2 === 0) continue;
                                                                    if ($nilaiYangDiisi === 0)
                                                                        continue
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

                                                                        <td><?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $row1['student_id'], 'year' => $tahun_ajaran))->row()->comment; ?></td>
                                                                        <?php
                                                                        $data = base64_encode($row1['class_id'] . "-" . $row3['subject_id'] . '-' . $row1['student_id'] . '-' . $section_id = $this->db->get_where('enroll', array('student_id' => $row1['student_id']))->row()->section_id); ?>
                                                                        <td><a class="btn btn-rounded btn-sm btn-primary" style="color:white" href="<?php echo base_url(); ?>parents/subject_marks/<?php echo $data; ?>/<?php echo $row2['exam_id']; ?>/<?= $tahun_ajaran ?>"><?php echo get_phrase('view_all'); ?></a></td>
                                                                    </tr>
                                                            <?php
                                                                endforeach;
                                                            endforeach;
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="form-buttons-w text-right">
                                                        <a target="_blank" href="<?php echo base_url(); ?>parents/marks_print_view/<?php echo base64_encode($row1['student_id'] . '-' . $row2['exam_id']); ?>/<?= $tahun_ajaran ?>"><button class="btn btn-rounded btn-success" type="submit"><i class="picons-thin-icon-thin-0333_printer"></i> <?php echo get_phrase('print'); ?></button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    endforeach;
                                endforeach;
                                ?>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function pilihTahunAjaran() {
        var tahunAjaran = document.getElementById("tahunAjaran").value;
        window.location.href = "<?= base_url('parents/marks/?year=') ?>" + tahunAjaran;
        return false;
    }
</script>