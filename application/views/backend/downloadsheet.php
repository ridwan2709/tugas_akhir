<!DOCTYPE html>
<html lang="en">

<header>
</header>

<body>

    <?php
    $data = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
    foreach ($data as $row) :
    ?>
        <div style="width:100%; font-size: 16px; line-height: 24px; font-family: 'nunito'; color: #555;">
            <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
                <tr>
                    <td colspan="2">
                        <table style="width: 100%;line-height: inherit;text-align: left;">
                            <tr>
                                <td style="padding-bottom: 20px; vertical-align: top;">
                                    <p style="font-size: 12px; text-transform:uppercase"><b>Formulir Pendaftaran Peserta Didik Baru</b></p>
                                    <p style="font-size:12px ;">Tahun Ajaran: <?= $this->crud_model->getInfo('running_year') ?></p>
                                </td>
                                <td style="padding-bottom: 20px; vertical-align: top;text-align:center;padding-top:5px;"></td>
                                <td style="text-align: right;">
                                    <p style="font-size: 12px; text-transform:uppercase"><b><?php echo $this->crud_model->getInfo('system_name'); ?></b></p>
                                    <p style="font-size: 12px;"><?php echo $this->crud_model->getInfo('address'); ?></b></p>
                                    <p style="font-size: 12px;"><?php echo $this->crud_model->getInfo('phone'); ?></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" style="margin-top:20px; width: 100%;line-height: inherit;text-align: left;">
                <tr>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Nomor Induk Siswa</b><br>
                        <?php echo $this->db->get_where('enroll', array('student_id' => $student_id))->row()->roll; ?>
                    </td>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Nama Depan</b><br>
                        <?php echo $row['first_name']; ?>
                    </td>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Nama Belakang</b><br>
                        <?php echo $row['last_name']; ?>
                    </td>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Jenis Kelamin</b><br>
                        <?php if ($row['sex'] == 'M') echo 'Laki-Laki';
                        else echo 'Perampuan'; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Alamat</b><br>
                        <?php echo $row['address']; ?>
                    </td>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Telepon</b><br>
                        <?php echo $row['phone']; ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Tanggal Lahir</b><br>
                        <?php echo $row['birthday']; ?>
                    </td>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Email</b><br>
                        <?php echo $row['email']; ?>
                    </td>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Username</b><br>
                        <?php echo $row['username']; ?>
                    </td>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Password</b><br>
                        <?php echo base64_decode($pw); ?>
                    </td>
                </tr>
                <?php
                $class_id   = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->class_id;
                $section_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->section_id;
                ?>
                <tr>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Nama Ibu</b><br>
                        <?php echo $this->crud_model->get_name('parent', $row['parent_id']); ?>
                    </td>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Nama Ayah</b><br>
                        <?php echo $row['authorized_person']; ?>
                    </td>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Username</b><br>
                        <?php echo $this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->username; ?>
                    </td>
                    <td style="padding:2px;font-size: 12px; border: 1px solid #000; text-align:center;">
                        <b style="font-size: 12px;">Password</b><br>
                        <?php 
                            if(!$pw2){
                                echo '**********';
                            }else{
                                echo base64_decode($pw2);
                            } ?>
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" style="margin-top:20px; border-top:1px solid #000; border-left:1px solid #000; border-right:1px solid #000; width: 100%;line-height: inherit;text-align: left;">
                <tr>
                    <th style="border: 1px solid #000" colspan="4">Rencana Mata Pelajaran Yang Akan Diambil</th>
                </tr>
                <tr>
                    <th style="border: 1px solid #000">#</th>
                    <th style="border: 1px solid #000">Mata Pelajaran</th>
                    <th style="border: 1px solid #000">Mentor</th>
                    <th style="border: 1px solid #000">Pilih</th>
                </tr>
                <?php
                $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
                foreach ($subjects as $key => $sub) :
                ?>
                    <tr>
                        <td style="padding:5px;font-size: 12px; border: 1px solid #000; text-align:center;">
                            <b style="font-size: 12px;"><?= $key + 1 ?></b>
                        </td>
                        <td style="padding:5px;font-size: 12px; border: 1px solid #000; text-align:center;">
                            <?php echo $sub['name']; ?>
                        </td>
                        <td style="padding:5px;font-size: 12px; border: 1px solid #000; text-align:center;">
                            <?php echo $this->crud_model->get_name('teacher', $sub['teacher_id']); ?>
                        </td>
                        <td style="padding:5px;font-size: 12px; border: 1px solid #000; text-align:center;">

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <table style="margin-top:25px; line-height: 24px;">
                <tr>
                    <td style="font-size: 12px;">
                        <?php echo $this->db->get_where('academic_settings', array('type' => 'terms'))->row()->description; ?>
                    </td>
                </tr>
            </table>
            <br>
            <table cellpadding="0" cellspacing="0" style="margin-top:45px;margin-bottom:10px; width: 100%;line-height: inherit;text-align: center;">
                <tr>
                    <td style="padding:5px;font-size: 12px; text-align:center;">
                        <center>____________________________________<br>
                            Orangtua
                    </td>
                    <td colspan="1" style="width:40%;">
                    </td>
                    <td style="padding:5px;font-size: 12px; text-align:center;">
                        ____________________________________<br>Siswa
                    </td>
                </tr>
            </table>
            <!-- <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;margin-top:50px">
                    <tr>
                        <td colspan="2" style="padding-bottom: 40px;border-top:2px solid black;">
                            <table style="width: 100%;line-height: inherit;text-align: left;vertical-align:top">
                                <tr>
                                    <td style="font-size: 12px;">
                                        <b>Alamat:</b><br>
                                        <?php echo $this->crud_model->getInfo('address'); ?>
                                    </td>
                                    <td style="font-size: 12px;">
                                        <b>Telepon:</b><br>
                                        <?php echo $this->crud_model->getInfo('phone'); ?>
                                    </td>
                                    <td style="text-align: right;font-size: 12px;">
                                        Oleh: <?php echo $this->crud_model->getInfo('system_name'); ?><br>
                                        <b><?php echo base_url(); ?></b>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table> -->
        </div>
    <?php endforeach; ?>
</body>

</html>