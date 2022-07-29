<?php
$class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
$exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_email = $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$phone = $this->db->get_where('settings', array('type' => 'phone'))->row()->description;
$no_serial = $this->db->get_where('enroll', ['student_id' => $student_id, 'year' => $tahun_ajaran])->row()->no_serial;
?>
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>style/cms/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>style/cms/css/main.css?version=3.3" rel="stylesheet">
<style>
    * {
        -webkit-print-color-adjust: exact !important;
        /* Chrome, Safari */
        color-adjust: exact !important;
        /*Firefox*/
    }
</style>
<div class="content-w">
    <div class="content-i">
        <div class="content-box">

            <div class="element-wrapper">
                <div class="rcard-wy" id="print_area">
                    <div class="rcard-w" style="padding-top: 60px;">
                        <div class="infos">
                            <div class="info-1">
                                <div class="rcard-logo-w">
                                    <img alt="" src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>">
                                </div>
                                <p></br>
                                <h4><?php echo $system_name; ?></h4>
                                <div class="company-address">Hasil Nilai Karakter Siswa</div>
                                
                            </div>
                            <div class="info-2">
                                <div class="rcard-profile">
                                    <img alt="" src="<?php echo $this->crud_model->get_image_url('student', $student_id); ?>">
                                </div>
                                <div class="company-name"><?php echo $this->crud_model->get_name('student', $student_id); ?></div>
                                <div class="company-address">
                                    <?php echo get_phrase('roll'); ?>: <?php echo $this->db->get_where('enroll', array('student_id' => $student_id))->row()->roll; ?><br />Kelas: <?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?><br />Kelompok: <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?> <br> Dari : <?= $this->crud_model->bln_indo($tgl_awal) ?> <br> Sampai : <?= $this->crud_model->bln_indo($tgl_akhir) ?>
                                </div>
                            </div>
                        </div>
                        <div class="rcard-table table-responsive mt-3">
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
                                    foreach ($data_report as $data) { ?>
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
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-info btn-rounded" onclick="printDiv('print_area')"><?php echo get_phrase('print'); ?></button>
        </div>
    </div>
</div>

<script>
    function printDiv(nombreDiv) {
        var contenido = document.getElementById(nombreDiv).innerHTML;
        var contenidoOriginal = document.body.innerHTML;
        document.body.innerHTML = contenido;
        window.print();
        document.body.innerHTML = contenidoOriginal;
    }
</script>