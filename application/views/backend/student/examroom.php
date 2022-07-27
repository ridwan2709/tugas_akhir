<?php
$details = $this->db->get_where('online_exam', array('code' => $code))->result_array();
foreach ($details as $row) :
?>
    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php'; ?>
            <div class="header-spacer"></div>
            <div class="content-i">
                <div class="content-box">
                    <?php echo form_open(base_url() . 'student/take_online_exam/'); ?>
                    <input type="hidden" value="<?php echo $row['code']; ?>" name="rand">
                    <input type="hidden" value="<?php echo base64_encode(date('d-m-Y H:i:s')) ?>" name="jam_mulai">
                    <div class="element-box lined-primary shadow" style="text-align:center">
                        <div class="col-sm-8" style="margin: 0 auto;">
                            <h3 class="form-header">Informasi Ujian</h3><br>
                            <p><?php echo $row['instruction']; ?></p><br>
                            <?php if ($this->session->flashdata('failed') == '1') : ?>
                                <div class="form-login-error">
                                    <center>
                                        <div class="alert alert-danger">Password ujian yang Anda masukan salah. <br> Silahkan hubungi bagian administrasi untuk mendapatkan password ujiannya!</div>
                                    </center>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="table-responsive col-sm-8" style="margin: 0 auto; text-align:left">
                            <table class="table table-lightbor table-lightfont">
                                <tr>
                                    <th><i class="picons-thin-icon-thin-0014_notebook_paper_todo" style="font-size:30px"></i></th>
                                    <td>
                                        <strong> <?php echo get_phrase('total_questions'); ?>:</strong> <?php $this->db->where('online_exam_id', $row['online_exam_id']);
                                                                                                        echo $this->db->count_all_results('question_bank'); ?> soal
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time" style="font-size:30px"></i></th>
                                    <td>
                                        <strong>
                                            <?php
                                            echo "Durasi";
                                            ?>:
                                        </strong>
                                        <?php
                                        $minutes = number_format($row['duration']);
                                        echo $minutes;
                                        echo ' menit';
                                        ?>.
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="picons-thin-icon-thin-0007_book_reading_read_bookmark" style="font-size:30px"></i></th>
                                    <td>
                                        <strong> <?php echo get_phrase('average_required'); ?>:</strong> <a class="btn btn-rounded btn-sm btn-primary" style="color:white"><?php echo $row['minimum_percentage']; ?>%</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="picons-thin-icon-thin-0207_list_checkbox_todo_done" style="font-size:30px"></i></th>
                                    <td><?php echo 'Pastikan semua soal sudah terjawab dengan benar'; ?>.</td>
                                </tr>
                                <?php if ($row['password'] != '') : ?>
                                    <tr>
                                        <th><i class="picons-thin-icon-thin-0136_rotation_lock" style="font-size:30px"></i></th>
                                        <td>Silahkan masukan password ujian!
                                            <input type="text" name="password" placeholder="<?php echo get_phrase('enter_exam_password'); ?>" class="form-control" required="">
                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><i class="picons-thin-icon-thin-0061_error_warning_alert_attention" style="font-size:30px"></i></th>
                                    <td style="color:red">
                                        <strong><?php echo 'PENTING'; ?>!</strong> <?php echo 'Di akhir ujian, pastikan untuk mengklik tombol Ujian Selesai'; ?>.
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <button class="btn btn-rounded btn-lg btn-success" type="submit"><?php echo get_phrase('start_exam'); ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>