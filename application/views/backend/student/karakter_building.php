<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$date = date('Y-m-d');
if ($week) {
  $date = date('Y-m-d', strtotime($week . ' week'));
}
list($start_date, $end_date) = x_week_range($date);
?>
<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
          <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url(); ?>student/karakter_building/"><i class="os-icon picons-thin-icon-thin-0724_policeman_security"></i><span><?php echo get_phrase('character building'); ?></span></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content-box">
      <div class="element-header" style="text-align: center; padding-top: 20px;">
        <a href="<?= base_url('student/karakter_building/') ?>">
          <h4><?= date('d-m-Y', strtotime($start_date)) . ' s/d ' . date('d-m-Y', strtotime($end_date)) ?></h4>
        </a>
        <?php
        // if (!$week) {
        ?>
      </div>
      <div class="navigation-arrow mb-2">
        <div class="arrow-left mr-2" style="float: left;">
          <a href="<?= base_url('student/karakter_building/' . ($week ? $week - 1 : '-1')) ?>" class="btn btn-block btn-outline-primary withripple">Sebelumnya</a>
        </div>
        <div class="arrow-right mr-2" style="float: right;">
          <a href="<?= base_url('student/karakter_building/' . ($week ? $week + 1 : '1')) ?>" class="btn btn-block btn-outline-primary withripple">Selanjutnya</a>
        </div>
      </div> <br /><br /><br />
      <div class="os-tabs-w">
        <div class="os-tabs-controls">
          <ul class="navs navs-tabs upper">
            <li class="navs-item">
              <a class="navs-links active" data-toggle="tab" href="#data"><?php echo 'data'; ?></a>
            </li>
            <li class="navs-item">
              <a class="navs-links" data-toggle="tab" href="#penilai"><?php echo 'penilai'; ?></a>
            </li>
          </ul>
        </div>
      </div>
      <br>
      <div class="tab-content ">
        <div class="tab-pane active" id="data">
          <div class="element-wrapper">
            <div class="element-box-tp">
              <div class="table-responsive">
                <table class="table table-padded">
                  <thead>
                    <tr>
                      <th style="text-align: center; vertical-align:middle"><?php echo get_phrase('NIS'); ?></th>
                      <th style="text-align: center; vertical-align:middle"><?php echo get_phrase('student'); ?></th>
                      <th style="text-align: center"><?php echo get_phrase('Perilaku dan Adab'); ?></th>
                      <th style="text-align: center"><?php echo get_phrase('Keagamaan'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $result = $this->db->query("SELECT count(DISTINCT date) as date_count, `build_id`, `build`.`student_id`, `build`.`user_id`, `build`.`class_id`, `build`.`section_id`, AVG(NULLIF(adb_1a, 0)) AS adb_1a, AVG(NULLIF(adb_1b, 0)) AS adb_1b, AVG(NULLIF(adb_1c, 0)) AS adb_1c, AVG(NULLIF(adb_1d, 0)) AS adb_1d, AVG(NULLIF(adb_2a, 0)) AS adb_2a, AVG(NULLIF(adb_2b, 0)) AS adb_2b, AVG(NULLIF(adb_2c, 0)) AS adb_2c, AVG(NULLIF(adb_2d, 0)) AS adb_2d, AVG(NULLIF(adb_2e, 0)) AS adb_2e, AVG(NULLIF(adb_3a, 0)) AS adb_3a, AVG(NULLIF(adb_3b, 0)) AS adb_3b, AVG(NULLIF(adb_4a, 0)) AS adb_4a, AVG(NULLIF(adb_4b, 0)) AS adb_4b, AVG(NULLIF(adb_5a, 0)) AS adb_5a, AVG(NULLIF(adb_5b, 0)) AS adb_5b, AVG(NULLIF(adb_6a, 0)) AS adb_6a, AVG(NULLIF(adb_6b, 0)) AS adb_6b, AVG(NULLIF(adb_6c, 0)) AS adb_6c, AVG(NULLIF(adb_6d, 0)) AS adb_6d, AVG(NULLIF(adb_7a, 0)) AS adb_7a, AVG(NULLIF(adb_7b, 0)) AS adb_7b, AVG(NULLIF(adb_7c, 0)) AS adb_7c, AVG(NULLIF(adb_7d, 0)) AS adb_7d, AVG(NULLIF(adb_7e, 0)) AS adb_7e, AVG(NULLIF(adb_8a, 0)) AS adb_8a, AVG(NULLIF(adb_8b, 0)) AS adb_8b, AVG(NULLIF(adb_9a, 0)) AS adb_9a, AVG(NULLIF(adb_9b, 0)) AS adb_9b, lk_sholat_shubuh, lk_sholat_dzuhur, lk_shalat_ashar, lk_shalat_magrib, lk_shalat_isya, lk_membaca_asmaul_husna, lk_mengenal_kosakata_arab, lk_hafal_doa, lk_mengikuti_kajian, lk_membaca_quran FROM `build`
                    LEFT JOIN( SELECT student_id, SUM(sholat_shubuh) AS lk_sholat_shubuh, SUM(sholat_dzuhur) AS lk_sholat_dzuhur, SUM(shalat_ashar) AS lk_shalat_ashar, SUM(shalat_magrib) AS lk_shalat_magrib, SUM(shalat_isya) AS lk_shalat_isya, SUM(membaca_asmaul_husna) AS lk_membaca_asmaul_husna, SUM(mengenal_kosakata_arab) AS lk_mengenal_kosakata_arab, SUM(hafal_doa) AS lk_hafal_doa, SUM(mengikuti_kajian) AS lk_mengikuti_kajian, SUM(membaca_quran) AS lk_membaca_quran FROM 
                    (SELECT student_id, AVG(NULLIF(sholat_shubuh, 0)) AS sholat_shubuh, AVG(NULLIF(sholat_dzuhur, 0)) AS sholat_dzuhur, AVG(NULLIF(shalat_ashar, 0)) AS shalat_ashar, AVG(NULLIF(shalat_magrib, 0)) AS shalat_magrib, AVG(NULLIF(shalat_isya, 0)) AS shalat_isya, AVG(NULLIF(membaca_asmaul_husna, 0)) AS membaca_asmaul_husna, AVG(NULLIF(mengenal_kosakata_arab, 0)) AS mengenal_kosakata_arab, AVG(NULLIF(hafal_doa, 0)) AS hafal_doa, AVG(NULLIF(mengikuti_kajian, 0)) AS mengikuti_kajian, AVG(NULLIF(membaca_quran, 0)) AS membaca_quran FROM `keagamaan` WHERE `date` >= '$start_date' AND `date` <= '$end_date' GROUP BY `student_id`, `date`) as k group by student_id) AS lk
                    ON lk.student_id = build.student_id WHERE `build`.`date` >= '$start_date' AND `build`.`date` <= '$end_date' GROUP BY `build`.`student_id`")->result_array();

                    $result2 = $this->db->query("SELECT count(DISTINCT date) as date_count, `build_id`, `build2`.`student_id`, `build2`.`user_id`, `build2`.`class_id`, `build2`.`section_id`, AVG(NULLIF(lpa_2_1, 0)) AS lpa_2_1, AVG(NULLIF(lpa_2_24, 0)) AS lpa_2_24, AVG(NULLIF(lpa_2_2, 0)) AS lpa_2_2, AVG(NULLIF(lpa_2_4, 0)) AS lpa_2_4, AVG(NULLIF(lpa_2_5, 0)) AS lpa_2_5, AVG(NULLIF(lpa_2_6, 0)) AS lpa_2_6, AVG(NULLIF(lpa_2_7, 0)) AS lpa_2_7, AVG(NULLIF(lpa_2_8, 0)) AS lpa_2_8, AVG(NULLIF(lpa_2_9, 0)) AS lpa_2_9, AVG(NULLIF(lpa_2_10, 0)) AS lpa_2_10, AVG(NULLIF(lpa_2_11, 0)) AS lpa_2_11, AVG(NULLIF(lpa_2_12, 0)) AS lpa_2_12, AVG(NULLIF(lpa_2_13, 0)) AS lpa_2_13, AVG(NULLIF(lpa_2_14, 0)) AS lpa_2_14, AVG(NULLIF(lpa_2_15, 0)) AS lpa_2_15, AVG(NULLIF(lpa_2_16, 0)) AS lpa_2_16, AVG(NULLIF(lpa_2_17, 0)) AS lpa_2_17, AVG(NULLIF(lpa_2_18, 0)) AS lpa_2_18, AVG(NULLIF(lpa_2_19, 0)) AS lpa_2_19, AVG(NULLIF(lpa_2_20, 0)) AS lpa_2_20, AVG(NULLIF(lpa_2_21, 0)) AS lpa_2_21, AVG(NULLIF(lpa_2_22, 0)) AS lpa_2_22, AVG(NULLIF(lpa_2_23, 0)) AS lpa_2_23, lk_sholat_wajib, lk_sholat_rawatib, lk_sholat_dhuha, lk_sholat_tahajud, lk_setor_dalil, lk_menutup_aurat, lk_ilmu_fiqih, lk_membaca_alquran, lk_bahasa_arab, lk_shaum,lk_asmaulhusna FROM `build2` LEFT JOIN( SELECT student_id, SUM(sholat_wajib) AS lk_sholat_wajib, SUM(sholat_rawatib) AS lk_sholat_rawatib, SUM(sholat_dhuha) AS lk_sholat_dhuha, SUM(sholat_tahajud) AS lk_sholat_tahajud, SUM(setor_dalil) AS lk_setor_dalil, SUM(menutup_aurat) AS lk_menutup_aurat, SUM(ilmu_fiqih) AS lk_ilmu_fiqih, SUM(membaca_alquran) AS lk_membaca_alquran, SUM(bahasa_arab) AS lk_bahasa_arab, SUM(shaum) AS lk_shaum, SUM(asmaulhusna) AS lk_asmaulhusna FROM (SELECT student_id, AVG(NULLIF(sholat_wajib, 0)) AS sholat_wajib, AVG(NULLIF(sholat_rawatib, 0)) AS sholat_rawatib, AVG(NULLIF(sholat_dhuha, 0)) AS sholat_dhuha, AVG(NULLIF(sholat_tahajud, 0)) AS sholat_tahajud, AVG(NULLIF(setor_dalil, 0)) AS setor_dalil, AVG(NULLIF(menutup_aurat, 0)) AS menutup_aurat, AVG(NULLIF(ilmu_fiqih, 0)) AS ilmu_fiqih, AVG(NULLIF(membaca_alquran, 0)) AS membaca_alquran, AVG(NULLIF(bahasa_arab, 0)) AS bahasa_arab, AVG(NULLIF(shaum, 0)) AS shaum, AVG(NULLIF(asmaulhusna,0)) AS asmaulhusna FROM `keagamaan2` WHERE `date` >= '$start_date' AND `date` <= '$end_date' GROUP BY `student_id`, `date`) as k group by student_id) AS lk ON lk.student_id = build2.student_id WHERE `build2`.`date` >= '$start_date' AND `build2`.`date` <= '$end_date' GROUP BY `build2`.`student_id`")->result_array();

                    // level 1
                    foreach ($result as $key => $row) {
                      $jumlah_nilai = 0;
                      $jumlah_jenis = 0;
                      $jumlah_lk = 0;
                      $jumlah_hari_kosong = ($week ? 7 : date('N')) - $row['date_count'];
                      foreach ($row as $kode => $nilai) {
                        if (strpos($kode, 'adb_') === 0) {
                          $jumlah_nilai += $nilai;
                          $jumlah_jenis++;
                        } else if (strpos($kode, 'lk_') === 0) {
                          $jumlah_lk += round($nilai);
                        }
                      }
                      if ($jumlah_hari_kosong) {
                        $jumlah_jenis = $jumlah_jenis * $jumlah_hari_kosong;
                      }
                      $rata2_lpa = $jumlah_nilai / $jumlah_jenis;
                      $result[$key]['rata2_lpa'] = $rata2_lpa;
                      $result[$key]['rata2_lpa_round'] = round($rata2_lpa);
                      $result[$key]['jumlah_lk'] = round($jumlah_lk);
                    }
                    $lpa_value = array_column($result, 'rata2_lpa_round');
                    $lk_value = array_column($result, 'jumlah_lk');
                    array_multisort($lpa_value, SORT_DESC, $lk_value, SORT_DESC, $result);

                    //level2
                    foreach ($result2 as $key => $row) {
                      $jumlah_nilai = 0;
                      $jumlah_jenis = 0;
                      $jumlah_lk = 0;
                      $jumlah_hari_kosong = ($week ? 7 : date('N')) - $row['date_count'];
                      foreach ($row as $kode => $nilai) {
                        if (strpos($kode, 'lpa_') === 0) {
                          $jumlah_nilai += $nilai;
                          $jumlah_jenis++;
                        } else if (strpos($kode, 'lk_') === 0) {
                          $jumlah_lk += round($nilai);
                        }
                      }
                      if ($jumlah_hari_kosong) {
                        $jumlah_jenis = $jumlah_jenis * $jumlah_hari_kosong;
                      }
                      $rata2_lpa = $jumlah_nilai / $jumlah_jenis;
                      $result2[$key]['rata2_lpa'] = $rata2_lpa;
                      $result2[$key]['rata2_lpa_round'] = round($rata2_lpa);
                      $result2[$key]['jumlah_lk'] = round($jumlah_lk);
                    }
                    $lpa_value = array_column($result2, 'rata2_lpa_round');
                    $lk_value = array_column($result2, 'jumlah_lk');
                    array_multisort($lpa_value, SORT_DESC, $lk_value, SORT_DESC, $result2);
                    //level 2
                    foreach ($result2 as $row2) {
                    ?>
                      <tr>
                        <td><span><?php echo $this->db->get_where('enroll', array('student_id' => $row2['student_id']))->row()->roll; ?></span></td>
                        <td class="cell-with-media">
                          <a href="<?php echo base_url(); ?>student/looking_karakter/<?php echo $row2['student_id']; ?><?= $week ? "/$week" : "" ?>" style="color:#999999"><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row2['student_id']); ?>" style="height: 25px; border-radius:50%" class="purple"><span> <?php echo $this->crud_model->get_name('student', $row2['student_id']); ?></span></a>
                        </td>
                        <td><?= to_abj($row2['rata2_lpa']); ?></td>
                        <td><?= round($row2['jumlah_lk']); ?></td>
                      </tr>
                    <?php
                    }
                    //level 1
                    foreach ($result as $row) {
                    ?>
                      <tr>
                        <td><span><?php echo $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->roll; ?></span></td>
                        <td class="cell-with-media">
                          <a href="<?php echo base_url(); ?>student/looking_karakter/<?php echo $row['student_id']; ?><?= $week ? "/$week" : "" ?>" style="color:#999999"><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" style="height: 25px; border-radius:50%;" class="purple"><span> <?php echo $this->crud_model->get_name('student', $row['student_id']); ?></span></a>
                        </td>
                        <td><?= to_abj($row['rata2_lpa']); ?></td>
                        <td><?= round($row['jumlah_lk']); ?></td>
                      </tr>
                    <?php
                    }
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="penilai">
          <div class="element-wrapper">
            <div class="element-box-tp">
              <div class="table-responsive">
                <table class="table table-padded">
                  <thead>
                    <tr>
                      <th><?php echo 'Tanggal'; ?></th>
                      <th><?php echo 'Penilai'; ?></th>
                      <th><?php echo 'Siswa'; ?></th>
                      <th><?php echo 'Level'; ?></th>
                      <th><?php echo 'LPA'; ?></th>
                      <th><?php echo 'LK'; ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $date = date('Y-m-d');
                    if ($week) {
                      $date = date('Y-m-d', strtotime($week . ' week'));
                    }
                    list($start_date, $end_date) = x_week_range($date);
                    // sql level 2
                    $this->db->where('date >=', $start_date);
                    $this->db->where('date <=', $end_date);
                    $sqlLPA2 = $this->db->get('build2')->result_array();
                    $this->db->where('date >=', $start_date);
                    $this->db->where('date <=', $end_date);
                    $sqlLK2 = $this->db->get('keagamaan2')->result_array();

                    // sql level 1
                    $this->db->where('date >=', $start_date);
                    $this->db->where('date <=', $end_date);
                    $sqlLPA = $this->db->get('build')->result_array();
                    $this->db->where('date >=', $start_date);
                    $this->db->where('date <=', $end_date);
                    $sqlLK = $this->db->get('keagamaan')->result_array();


                    // level2
                    foreach ($sqlLPA2 as $key => $data) :
                      $jumlah_nilai = 0;
                      $jumlah_jenis = 0;
                      foreach ($data as $kode => $nilai) {
                        if (strpos($kode, 'lpa_') === 0) {
                          $jumlah_nilai += $nilai;
                          if ($nilai != 0) {
                            $jumlah_jenis++;
                          }
                        }
                      }

                      $hasillpa2 = $jumlah_nilai / $jumlah_jenis;

                      $id = $data['user_id'];
                      $tes = $this->db->query("SELECT SUBSTR('$id', POSITION('-' IN '$id')+1) AS user_id, SUBSTR('$id',1, POSITION('-' IN '$id')-1) AS user_type")->result();
                      if ($tes[0]->user_type == 'admin') {
                        $tabel = 'admin';
                      } else if ($tes[0]->user_type == 'teacher') {
                        $tabel = 'teacher';
                      } else if ($tes[0]->user_type == 'parent') {
                        $tabel = 'parent';
                      }

                      // lk
                      $lk = $sqlLK2[$key];
                      $jumlah_lk = 0;
                      $angka_terisi = 0;
                      $indikators = array_slice(array_keys($lk), 6);
                      foreach ($indikators as $indikator) {
                        if ($lk[$indikator] != 0) $angka_terisi++;

                        $jumlah_lk += $lk[$indikator];
                      }
                    ?>
                      <tr>
                        <td><?= $data['date'] ?></td>
                        <td><img alt="" src="<?php echo $this->crud_model->get_image_url($tabel, $tes[0]->user_id); ?>" style="height: 25px; border-radius:50%;" class="purple"><span> <?php echo $this->crud_model->get_name($tabel, $tes[0]->user_id); ?></span></td>
                        <td><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $data['student_id']); ?>" style="height: 25px; border-radius:50%;" class="purple"><span> <?php echo $this->crud_model->get_name('student', $data['student_id']); ?></span></td>
                        <td><?= $this->db->get_where('section', array('section_id' => $data['section_id']))->row()->name; ?></td>
                        <td><?= to_abj($hasillpa2); ?></td>
                        <td><?= $jumlah_lk ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <?php
                    $date = date('Y-m-d');
                    if ($week) {
                      $date = date('Y-m-d', strtotime($week . ' week'));
                    }
                    list($start_date, $end_date) = x_week_range($date);



                    // level1
                    // var_dump($sqlLPA);
                    foreach ($sqlLPA as $key => $data) :
                      $jumlah_nilai = 0;
                      $jumlah_jenis = 0;
                      foreach ($data as $kode => $nilai) {
                        // var_dump($kode);
                        if (strpos($kode, 'adb_') === 0) {
                          $jumlah_nilai += $nilai;
                          if ($nilai != 0) {
                            $jumlah_jenis++;
                          }
                        }
                      }
                      $hasillpa = $jumlah_nilai / $jumlah_jenis;


                      $id = $data['user_id'];
                      $tes = $this->db->query("SELECT SUBSTR('$id', POSITION('-' IN '$id')+1) AS user_id, SUBSTR('$id',1, POSITION('-' IN '$id')-1) AS user_type")->result();
                      if ($tes[0]->user_type == 'admin') {
                        $tabel = 'admin';
                      } else if ($tes[0]->user_type == 'teacher') {
                        $tabel = 'teacher';
                      } else if ($tes[0]->user_type == 'parent') {
                        $tabel = 'parent';
                      }

                      // lk
                      $lk = $sqlLK[$key];
                      $jumlah_lk = 0;
                      $angka_terisi = 0;
                      $indikators = array_slice(array_keys($lk), 6);
                      foreach ($indikators as $indikator) {
                        if ($lk[$indikator] != 0) $angka_terisi++;

                        $jumlah_lk += $lk[$indikator];
                      }
                    ?>
                      <tr>
                        <td><?= $data['date'] ?></td>
                        <td><img alt="" src="<?php echo $this->crud_model->get_image_url($tabel, $tes[0]->user_id); ?>" style="height: 25px; border-radius:50%;" class="purple"><span> <?php echo $this->crud_model->get_name($tabel, $tes[0]->user_id); ?></span></td>
                        <td><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $data['student_id']); ?>" style="height: 25px; border-radius:50%;" class="purple"><span> <?php echo $this->crud_model->get_name('student', $data['student_id']); ?></span></td>
                        <td><?= $this->db->get_where('section', array('section_id' => $data['section_id']))->row()->name; ?></td>
                        <td><?= to_abj($hasillpa) ?></td>
                        <td><?= $jumlah_lk ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="display-type"></div>
</div>