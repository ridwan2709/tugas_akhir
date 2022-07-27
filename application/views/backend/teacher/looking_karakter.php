<div class="content-w">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="conty">
        <div class="content-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="pipeline white lined-primary">
                        <div class="pipeline-header">
                            <h5><?php echo get_phrase('character building'); ?></h5>
                            <hr>
                            <h6>Nama : <?php echo $this->crud_model->get_name('student', $student_id); ?></h6>
                            <h6><?php echo get_phrase('roll'); ?>: <?php echo $this->db->get_where('enroll', array('student_id' => $student_id))->row()->roll; ?>.</h6>
                        </div>
                        <ul class="navs navs-tabs upper mb-4">
                            <li class="navs-item">
                                <a class="navs-links active" data-toggle="tab" href="#lpa_data">Perilaku dan Adab</a>
                            </li>
                            <li class="navs-item">
                                <a class="navs-links" data-toggle="tab" href="#lk_data">Keagamaan</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <?php
                            $section = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->section_id;
                            ?>
                            <div class="tab-pane active" id="lpa_data">
                                <div class="row">
                                    <div class="col-sm-3" style="border: 1px solid #eee; max-width:20% !important">
                                        <h5 class="form-header">Statistik Nilai</h5>
                                        <canvas id="myChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                                <?php if ($section == 1 OR $section == 2 OR $section == 3) { ?>
                                    <div class="element-box-tp">
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="vertical-align: middle"><?php echo get_phrase('Hari'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Merapihkan tempat tidur'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Menyiapkan peralatan sekolah'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Menyiapkan pakaian'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Melakukan tugas tanpa disuruh'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Berani untuk bertanya'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Berani mengungkapkan pendapatnya'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Berani untuk meminta pertolongan'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Berani mengakui kesalahan dan mau memberi maaf'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Berani tampil kedepan'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Bersikap jujur'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Membiasakan memberi salam dan berjabat tangan'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Berbicara dengan lemah lembut'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Berperilaku sopan pada semua orang'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Mengucap bismillah sebelum aktifitas'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Mengucap hamdalah sesudah aktifitas'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Melakukan tasymit ketika bersin atau orang lain bersin'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Mau membantu sesama'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Mau diajak bekerja sama'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Bersedekah'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Membuang sampah pada tempatnya'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Peduli dengan kebersihan lingkungan'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Peduli keindahan'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Peduli kerapihan'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Menengok saudara / teman yang sakit'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Mengajak sesama berbuat baik'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Mengingatkan kebaikan terhadap sesama'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Mau meminta maaf ketika melakukan kesalahan'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center"><?php echo get_phrase('Mau bermaaf-maafan dengan sesama'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $this->db->select('build_id,student_id,user_id,class_id,section_id,date,avg(nullif(adb_1a,0)) as adb_1a,avg(nullif(adb_1b,0)) as adb_1b,avg(nullif(adb_1c,0)) as adb_1c,avg(nullif(adb_1d,0)) as adb_1d,avg(nullif(adb_2a,0)) as adb_2a,avg(nullif(adb_2b,0)) as adb_2b,avg(nullif(adb_2c,0)) as adb_2c,avg(nullif(adb_2d,0)) as adb_2d,avg(nullif(adb_2e,0)) as adb_2e,avg(nullif(adb_3a,0)) as adb_3a,avg(nullif(adb_3b,0)) as adb_3b,avg(nullif(adb_4a,0)) as adb_4a,avg(nullif(adb_4b,0)) as adb_4b,avg(nullif(adb_5a,0)) as adb_5a,avg(nullif(adb_5b,0)) as adb_5b,avg(nullif(adb_6a,0)) as adb_6a,avg(nullif(adb_6b,0)) as adb_6b,avg(nullif(adb_6c,0)) as adb_6c,avg(nullif(adb_6d,0)) as adb_6d,avg(nullif(adb_7a,0)) as adb_7a,avg(nullif(adb_7b,0)) as adb_7b,avg(nullif(adb_7c,0)) as adb_7c,avg(nullif(adb_7d,0)) as adb_7d,avg(nullif(adb_7e,0)) as adb_7e,avg(nullif(adb_8a,0)) as adb_8a,avg(nullif(adb_8b,0)) as adb_8b,avg(nullif(adb_9a,0)) as adb_9a,avg(nullif(adb_9b,0)) as adb_9b')->where(['student_id' => $student_id])->group_by('date');
                                                    $date = date('Y-m-d');
                                                    if ($week) {
                                                        $date = date('Y-m-d', strtotime($week . ' week'));
                                                    }
                                                    list($start_date, $end_date) = x_week_range($date);
                                                    $this->db->where('date >=', $start_date);
                                                    $this->db->where('date <=', $end_date);
                                                    $build = $this->db->get('build')->result_array();
                                                    foreach ($build as $r) :
                                                        ?>
                                                        <tr>
                                                            <td><?= get_phrase(date('l', strtotime($r['date']))); ?></td>
                                                            <td><?= to_abj($r['adb_1a']); ?></td>
                                                            <td><?= to_abj($r['adb_1b']); ?></td>
                                                            <td><?= to_abj($r['adb_1c']); ?></td>
                                                            <td><?= to_abj($r['adb_1d']); ?></td>
                                                            <td><?= to_abj($r['adb_2a']); ?></td>
                                                            <td><?= to_abj($r['adb_2b']); ?></td>
                                                            <td><?= to_abj($r['adb_2c']); ?></td>
                                                            <td><?= to_abj($r['adb_2d']); ?></td>
                                                            <td><?= to_abj($r['adb_2e']); ?></td>
                                                            <td><?= to_abj($r['adb_3a']); ?></td>
                                                            <td><?= to_abj($r['adb_3b']); ?></td>
                                                            <td><?= to_abj($r['adb_4a']); ?></td>
                                                            <td><?= to_abj($r['adb_4b']); ?></td>
                                                            <td><?= to_abj($r['adb_5a']); ?></td>
                                                            <td><?= to_abj($r['adb_5b']); ?></td>
                                                            <td><?= to_abj($r['adb_6a']); ?></td>
                                                            <td><?= to_abj($r['adb_6b']); ?></td>
                                                            <td><?= to_abj($r['adb_6c']); ?></td>
                                                            <td><?= to_abj($r['adb_6d']); ?></td>
                                                            <td><?= to_abj($r['adb_7a']); ?></td>
                                                            <td><?= to_abj($r['adb_7b']); ?></td>
                                                            <td><?= to_abj($r['adb_7c']); ?></td>
                                                            <td><?= to_abj($r['adb_7d']); ?></td>
                                                            <td><?= to_abj($r['adb_7e']); ?></td>
                                                            <td><?= to_abj($r['adb_8a']); ?></td>
                                                            <td><?= to_abj($r['adb_8b']); ?></td>
                                                            <td><?= to_abj($r['adb_9a']); ?></td>
                                                            <td><?= to_abj($r['adb_9b']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="element-box-tp">
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="vertical-align: middle"><?php echo get_phrase('Hari'); ?></th>
                                                        <th style="vertical-align: middle; text-align:center">Mengikuti program pidato di hari Jumat</th>
                                                        <th style="vertical-align: middle; text-align:center">Mempresentasikan karya yang sedang dikerjakan setiap seminggu sekali</th>
                                                        <th style="vertical-align: middle; text-align:center">Berbahasa secara ahsan</th>
                                                        <th style="vertical-align: middle; text-align:center">Praktek karya ilmiah tentang makhluk hidup dan lingkungan sekitar</th>
                                                        <th style="vertical-align: middle; text-align:center">Memberikan minimal 3 hasil karya ilmiah/karangan/keterampilan dalam 1 semester</th>
                                                        <th style="vertical-align: middle; text-align:center">Mengucapkan kalimat istirja ketika mendapat musibah</th>
                                                        <th style="vertical-align: middle; text-align:center">Tidak tergesa-gesa</th>
                                                        <th style="vertical-align: middle; text-align:center">Sabar</th>
                                                        <th style="vertical-align: middle; text-align:center">Berbaik sangka</th>
                                                        <th style="vertical-align: middle; text-align:center">Banyak istigfar</th>
                                                        <th style="vertical-align: middle; text-align:center">Berdoa dengan doa yang baik</th>
                                                        <th style="vertical-align: middle; text-align:center">Tawakal</th>
                                                        <th style="vertical-align: middle; text-align:center">Banyak berdzikir</th>
                                                        <th style="vertical-align: middle; text-align:center">Menghindari makanan dan minuman yang instant dan mengandung pengawet</th>
                                                        <th style="vertical-align: middle; text-align:center">Tidak berlebihan dalam makan, minum dan berpakaian</th>
                                                        <th style="vertical-align: middle; text-align:center">Mengamalkan adab-adab Keislaman</th>
                                                        <th style="vertical-align: middle; text-align:center">Melakukan kegiatan sosial setiap hari</th>
                                                        <th style="vertical-align: middle; text-align:center">Membaca buku minimal 1 tema perhari</th>
                                                        <th style="vertical-align: middle; text-align:center">Mengikuti kegiatan keagamaan</th>
                                                        <th style="vertical-align: middle; text-align:center">Mempersiapkan dan merapihkan peralatannya sendiri</th>
                                                        <th style="vertical-align: middle; text-align:center">Mengajak berbuat baik</th>
                                                        <th style="vertical-align: middle; text-align:center">Mencegah/menasihati perbuatan tercela</th>
                                                        <th style="vertical-align: middle; text-align:center">Siap tampil menjadi pemimpin</th>
                                                        <th style="vertical-align: middle; text-align:center">Mengerjakan pekerjaan rumah dan tugas-tugasnya</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $this->db->select('build_id,student_id,user_id,class_id,section_id,date,avg(nullif(lpa_2_1,0)) as lpa_2_1,avg(nullif(lpa_2_24,0)) as lpa_2_24,avg(nullif(lpa_2_2,0)) as lpa_2_2, avg(nullif(lpa_2_3,0)) as lpa_2_3, avg(nullif(lpa_2_4,0)) as lpa_2_4, avg(nullif(lpa_2_5,0)) as lpa_2_5, avg(nullif(lpa_2_6,0)) as lpa_2_6, avg(nullif(lpa_2_7,0)) as lpa_2_7, avg(nullif(lpa_2_8,0)) as lpa_2_8, avg(nullif(lpa_2_9,0)) as lpa_2_9, avg(nullif(lpa_2_10,0)) as lpa_2_10, avg(nullif(lpa_2_11,0)) as lpa_2_11, avg(nullif(lpa_2_12,0)) as lpa_2_12, avg(nullif(lpa_2_13,0)) as lpa_2_13, avg(nullif(lpa_2_14,0)) as lpa_2_14, avg(nullif(lpa_2_15,0)) as lpa_2_15, avg(nullif(lpa_2_16,0)) as lpa_2_16, avg(nullif(lpa_2_17,0)) as lpa_2_17, avg(nullif(lpa_2_18,0)) as lpa_2_18, avg(nullif(lpa_2_19,0)) as lpa_2_19, avg(nullif(lpa_2_20,0)) as lpa_2_20, avg(nullif(lpa_2_21,0)) as lpa_2_21, avg(nullif(lpa_2_22,0)) as lpa_2_22, avg(nullif(lpa_2_23,0)) as lpa_2_23')->where(['student_id' => $student_id])->group_by('date');
                                                    $date = date('Y-m-d');
                                                    if ($week) {
                                                        $date = date('Y-m-d', strtotime($week . ' week'));
                                                    }
                                                    list($start_date, $end_date) = x_week_range($date);
                                                    $this->db->where('date >=', $start_date);
                                                    $this->db->where('date <=', $end_date);
                                                    $build = $this->db->get('build2')->result_array();
                                                    foreach ($build as $r) :
                                                        ?>
                                                        <tr>
                                                            <td><?= get_phrase(date('l', strtotime($r['date']))); ?></td>
                                                            <td><?= to_abj($r['lpa_2_1']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_2']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_3']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_4']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_5']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_6']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_7']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_8']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_9']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_10']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_11']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_12']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_13']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_14']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_15']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_16']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_17']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_18']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_19']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_20']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_21']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_22']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_23']); ?></td>
                                                            <td><?= to_abj($r['lpa_2_24']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php
                            $lk_list = [
                                ['name' => 'sholat_shubuh', 'text' => 'Sholat shubuh'],
                                ['name' => 'sholat_dzuhur', 'text' => 'Sholat dzuhur'],
                                ['name' => 'shalat_ashar', 'text' => 'Shalat ashar'],
                                ['name' => 'shalat_magrib', 'text' => 'Shalat magrib'],
                                ['name' => 'shalat_isya', 'text' => 'Shalat isya'],
                                ['name' => 'membaca_asmaul_husna', 'text' => 'Membaca 99 asmaul husna'],
                                ['name' => 'mengenal_kosakata_arab', 'text' => 'Mengenal kosakata bahasa arab'],
                                ['name' => 'hafal_doa', 'text' => 'Hafal doa sehari-hari'],
                                ['name' => 'mengikuti_kajian', 'text' => 'Mengikuti muhadoroh/kajian/taklim'],
                                ['name' => 'membaca_quran', 'text' => 'Membaca al-Quran/Iqro']
                            ];
                            $lk2_list =[
                                ['name' => 'sholat_wajib', 'text' => 'Sholat Wajib'],
                                ['name' => 'sholat_rawatib', 'text' => 'Sholat Rawatib'],
                                ['name' => 'sholat_dhuha', 'text' => 'Sholat Dhuha'],
                                ['name' => 'sholat_tahajud', 'text' => 'Sholat Tahajud'],
                                ['name' => 'setor_dalil', 'text' => 'Setor Dalil'],
                                ['name' => 'menutup_aurat', 'text' => 'Menutup Aurat dan Berpakaian Sopan'],
                                ['name' => 'ilmu_fiqih', 'text' => 'Mengetahui Ilmu Fiqih'],
                                ['name' => 'membaca_alquran', 'text' => 'Membaca Alquran Dengan Tartil'],
                                ['name' => 'bahasa_arab', 'text' => 'Berbicara Bahasa Arab'],
                                ['name' => 'shaum', 'text' => 'Shaum Sunnah / Wajib'],
                                ['name' => 'asmaulhusna', 'text' => 'Asmaulhusna & Terjemahannya']
                            ];
                            ?>
                            <div class="tab-pane" id="lk_data">
                                <div class="row">
                                    <div class="col-sm-3" style="border: 1px solid #eee;">
                                        <h5 class="form-header">Statistik Nilai</h5>
                                        <canvas id="myChart2" width="400" height="400"></canvas>
                                    </div>
                                </div>
                                <?php if ($section == 1 OR $section == 2 OR $section == 3) { ?>
                                    <div class="element-box-tp">
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="vertical-align: middle"><?php echo get_phrase('Hari'); ?></th>
                                                        <?php
                                                        foreach ($lk_list as $item) {
                                                            ?>
                                                            <th style="vertical-align: middle; text-align:center"><?php echo get_phrase($item['text']); ?></th>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $this->db->select('id,student_id,user_id,class_id,section_id,date,avg(nullif(sholat_shubuh,0)) as sholat_shubuh,avg(nullif(sholat_dzuhur,0)) as sholat_dzuhur,avg(nullif(shalat_ashar,0)) as shalat_ashar,avg(nullif(shalat_magrib,0)) as shalat_magrib,avg(nullif(shalat_isya,0)) as shalat_isya,avg(nullif(membaca_asmaul_husna,0)) as membaca_asmaul_husna,avg(nullif(mengenal_kosakata_arab,0)) as mengenal_kosakata_arab,avg(nullif(hafal_doa,0)) as hafal_doa,avg(nullif(mengikuti_kajian,0)) as mengikuti_kajian,avg(nullif(membaca_quran,0)) as membaca_quran')->where(['student_id' => $student_id])->group_by('date');
                                                    $this->db->where('date >=', $start_date);
                                                    $this->db->where('date <=', $end_date);
                                                    $lk_data = $this->db->get('keagamaan')->result_array();
                                                    foreach ($lk_data as $item) {
                                                        ?>
                                                        <tr>
                                                            <td><?= get_phrase(date('l', strtotime($item['date']))); ?></td>
                                                            <?php
                                                            foreach ($lk_list as $col) {
                                                                ?>
                                                                <td><?= round($item[$col['name']]) ?></td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="element-box-tp">
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th style="vertical-align: middle"><?php echo get_phrase('Hari'); ?></th>
                                                        <?php
                                                        foreach ($lk2_list as $item) {
                                                            ?>
                                                            <th style="vertical-align: middle; text-align:center"><?php echo get_phrase($item['text']); ?></th>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $this->db->select('id,student_id,user_id,class_id,section_id,date,avg(nullif(sholat_wajib,0)) as sholat_wajib,avg(nullif(sholat_rawatib,0)) as sholat_rawatib,avg(nullif(sholat_dhuha,0)) as sholat_dhuha,avg(nullif(sholat_tahajud,0)) as sholat_tahajud,avg(nullif(setor_dalil,0)) as setor_dalil,avg(nullif(menutup_aurat,0)) as menutup_aurat,avg(nullif(ilmu_fiqih,0)) as ilmu_fiqih,avg(nullif(membaca_alquran,0)) as membaca_alquran,avg(nullif(bahasa_arab,0)) as bahasa_arab,avg(nullif(shaum,0)) as shaum,avg(nullif(asmaulhusna,0)) as asmaulhusna')->where(['student_id' => $student_id])->group_by('date');
                                                    $this->db->where('date >=', $start_date);
                                                    $this->db->where('date <=', $end_date);
                                                    $lk_data = $this->db->get('keagamaan2')->result_array();
                                                    foreach ($lk_data as $item) {
                                                        ?>
                                                        <tr>
                                                            <td><?= get_phrase(date('l', strtotime($item['date']))); ?></td>
                                                            <?php
                                                            foreach ($lk2_list as $col) {
                                                                ?>
                                                                <td><?= round($item[$col['name']]) ?></td>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Nilai',
                data: [
                    <?php
                    if ($section == 15 or $section == 5 or $section == 7) {
                        foreach ($build2 as $key => $row) {
                            $lpa = $this->db->get_where('build2', array('date' => $row['date'], 'student_id' => $row['student_id']))->result_array();
                            foreach ($lpa as $key => $value) {
                                $jumlah_nilai1 = 0;
                                foreach ($value as $kode => $nilai) {
                                    if (strpos($kode, 'lpa_') === 0) {
                                        $jumlah_nilai1 += $nilai;
                                        $jumlah_jenis++;
                                    }
                                }
                            }
                            echo $jumlah_nilai1 . ',';
                        }
                    } else {
                        foreach ($build as $key => $row) {
                            $lpa = $this->db->get_where('build', array('date' => $row['date'], 'student_id' => $row['student_id']))->result_array();
                            foreach ($lpa as $key => $value) {
                                $jumlah_nilai1 = 0;
                                foreach ($value as $kode => $nilai) {
                                    if (strpos($kode, 'adb_') === 0) {
                                        $jumlah_nilai1 += $nilai;
                                        $jumlah_jenis++;
                                    }
                                }
                            }
                            echo $jumlah_nilai1 . ',';
                        }
                    }
                    ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('myChart2');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Nilai',
                data: [
                    <?php
                    if ($section == 15 or $section == 5 or $section == 7) {
                        foreach ($lk_data2 as $key => $value) {
                            $lk2 = $this->db->get_where('keagamaan2', array('date' => $value['date'], 'student_id' => $value['student_id']))->result_array();
                            foreach ($lk2 as $key => $row) {
                                $nilai2 =
                                    $row['sholat_wajib'] +
                                    $row['sholat_rawatib'] +
                                    $row['sholat_dhuha'] +
                                    $row['sholat_tahajud'] +
                                    $row['setor_dalil'] +
                                    $row['menutup_aurat'] +
                                    $row['ilmu_fiqih'] +
                                    $row['membaca_alquran'] +
                                    $row['bahasa_arab'] +
                                    $row['shaum'] +
                                    $row['asmaulhusna'];
                            }
                            echo $nilai2 . ',';
                        }
                    } else {
                        foreach ($lk_data as $key => $value) {
                            $lk = $this->db->get_where('keagamaan', array('date' => $value['date'], 'student_id' => $value['student_id']))->result_array();
                            foreach ($lk as $key => $row) {
                                $nilai1 =
                                    $row['sholat_shubuh'] +
                                    $row['sholat_dzuhur'] +
                                    $row['shalat_ashar'] +
                                    $row['shalat_magrib'] +
                                    $row['shalat_isya'] +
                                    $row['membaca_asmaul_husna'] +
                                    $row['mengenal_kosakata_arab'] +
                                    $row['hafal_doa'] +
                                    $row['mengikuti_kajian'] +
                                    $row['membaca_quran'];
                            }
                            echo $nilai1 . ',';
                        }
                    }
                    ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });
</script>