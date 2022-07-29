<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
<div class="content-w">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="conty">
      <!-- Menu -->
      <?php include 'menu_report.php' ?>
      <!-- End Menu -->
        <div class="content-i">
            <div class="content-box">
                <h5 class="form-header"><?php echo 'Cetak Rapor'; ?></h5>
                <hr>
                <?php echo form_open(base_url() . 'admin/marks_report/', array('class' => 'form m-b')); ?>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo get_phrase('class'); ?></label>
                            <div class="select">
                                <select name="class_id" required="" onchange="get_class_sections(this.value)">
                                    <option value=""><?php echo get_phrase('select'); ?></option>
                                    <?php
                                    $class = $this->db->get('class')->result_array();
                                    foreach ($class as $row) :
                                    ?>
                                        <option value="<?php echo $row['class_id']; ?>" <?php if ($class_id == $row['class_id']) echo "selected"; ?>><?php echo $row['name']; ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo get_phrase('section'); ?></label>
                            <div class="select">
                                <?php
                                if ($section_id == "") :
                                ?>
                                    <select name="section_id" required id="section_holder" onchange="get_student(this.value)">
                                        <option value=""><?php echo get_phrase('select'); ?></option>
                                    </select>
                                <?php
                                else :
                                ?>
                                    <select name="section_id" required id="section_holder" onchange="get_student(this.value)">
                                        <option value=""><?php echo get_phrase('select'); ?></option>
                                        <?php
                                        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
                                        foreach ($sections as $key) :
                                        ?>
                                            <option value="<?php echo $key['section_id']; ?>" <?php if ($section_id == $key['section_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                <?php
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo get_phrase('student'); ?></label>
                            <div class="select">
                                <?php
                                if ($student_id == "") :
                                ?>
                                    <select name="student_id" required id="student_holder">
                                        <option value=""><?php echo get_phrase('select'); ?></option>
                                    </select>
                                <?php
                                else :
                                ?>
                                    <select name="student_id" required id="student_holder">
                                        <option value=""><?php echo get_phrase('select'); ?></option>
                                        <?php
                                        $students = $this->db->get_where('enroll', array('section_id' => $section_id))->result_array();
                                        foreach ($students as $key) :
                                        ?>
                                            <option value="<?php echo $key['student_id']; ?>" <?php if ($student_id == $key['student_id']) echo "selected"; ?>><?php echo $this->crud_model->get_name('student', $key['student_id']); ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                <?php
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group label-floating">
                        <label for="" class="control-label">Bulan Awal</label>
                        <input type="month" name="tgl_awal" id="" class="form-group">
                    </div>
                    <div class="form-group label-floating">
                        <label for="" class="control-label">Bulan Akhir</label>
                        <input type="month" name="tgl_akhir" id="" class="form-group">
                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                            <button class="btn btn-success btn-upper" style="margin-top:20px" type="submit"><i class="picons-thin-icon-thin-0154_ok_successful_check"></i></button>
                        </div>
                    </div>

                </div>
                <hr>
                <?php echo form_close(); ?>
                
                <?php
                if ($class_id != "" && $section_id != "" && $student_id != "") : ?>
                    <div class="element-wrapper" id="print_area">
                        <div class="rcard-w">
                            <div class="infos">
                                <div class="info-1">
                                    <div class="rcard-logo-w">
                                        <img alt="" src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>">
                                    </div>
                                    <div class="company-name"><?php echo $system_name; ?></div>
                                    <div class="company-address"><?php echo get_phrase('marks'); ?> Karakter Siswa</div>
                                    <div class="company-address">Tahun Ajaran <?php echo $running_year; ?></div>
                                </div>
                                <div class="info-2">
                                    <div class="rcard-profile">
                                        <img alt="" src="<?php echo $this->crud_model->get_image_url('student', $student_id); ?>" class="purple" style="line-height: 0px">
                                    </div>
                                    <div class="company-name"><?php echo $this->crud_model->get_name('student', $student_id); ?></div>
                                    <div class="company-address">
                                        <?php echo get_phrase('roll'); ?> : <?php echo $this->db->get_where('enroll', array('student_id' => $student_id))->row()->roll; ?><br />Kelas : <?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?><br />Kelompok : <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="rcard-heading">
                                <div class="rcard-date">&nbsp;</div>
                            </div>
                            <div class="rcard-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Bulan</th>
                                            <th class="text-center">Jumlah LPA</th>
                                            <th class="text-center">Jumlah LK</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $jumlah_lpa = 0;
                                        foreach($data_report as $data){ ?>
                                        <tr>
                                            <td><?= $this->crud_model->bln_indo($data['DATE']) ?></td>
                                            <td><?= $data['jumlah_lpa'] ?></td>
                                            <td><?= $data['jumlah_lk'] ?></td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="rcard-footer">
                                <div class="rcard-logo">
                                    <img alt="" src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>"><span><?php echo $system_name; ?></span>
                                </div>
                                <div class="rcard-info">
                                    <span><?php echo $system_email; ?></span><span><?php echo $phone; ?></span>
                                </div>
                                <a target="_blank" href="<?php echo base_url(); ?>admin/marks_report_print_view/<?php echo base64_encode($student_id . '.' . $exam_id . '.' . $class_id . '.' . $section_id . '.' . $tahun_ajaran); ?>/"><button class="btn btn-rounded btn-success" type="submit"><i class="picons-thin-icon-thin-0333_printer"></i> <?php echo get_phrase('print'); ?></button></a>
                            </div>
                        </div>
                    </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function get_class_sections(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
            success: function(response) {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>

<script type="text/javascript">
    function get_student(section_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_class_students/' + section_id,
            success: function(response) {
                jQuery('#student_holder').html(response);
            }
        });
    }
</script>