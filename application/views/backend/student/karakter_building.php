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
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>student/forum_konseling/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span>Forum Diskusi</span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>student/request_student/"><i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span><?php echo get_phrase('reports'); ?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>student/meet_konseling/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo get_phrase('live'); ?></span></a>
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
        <!-- <div class="arrow-today mr-2">
          <a href="<?= base_url('student/karakter_building/') ?>" class="btn btn-block btn-primary withripple">Minggu ini</a>
        </div> -->
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
            <div class="element-header">
              <div class="row">
                  <div class="col-sm-3" style="border: 1px solid #eee; max-width:20% !important">
										<h5 class="form-header">Lembar Keagamaan</h5>
										<canvas id="myChart" width="400" height="400" style="display: block; width: 401px; height: 401px;" class="chartjs-render-monitor"></canvas>
									</div>
                  <div class="col-sm-3" style="border: 1px solid #eee; max-width:20% !important">
										<h5 class="form-header">Lembar Perilaku Adab</h5>
										<canvas id="myChart2" width="400" height="400" style="display: block; width: 401px; height: 401px;" class="chartjs-render-monitor"></canvas>
									</div>
              </div>
              <?php
              // }
              ?>
            </div>
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

                    // level 1
                    foreach ($result as $key => $row) {
                      $jumlah_nilai1 = 0;
                      $jumlah_jenis = 0;
                      $jumlah_lk = 0;
                      $jumlah_hari_kosong = ($week ? 7 : date('N')) - $row['date_count'];
                      foreach ($row as $kode => $nilai) {
                        if (strpos($kode, 'adb_') === 0) {
                          $jumlah_nilai1 += $nilai;
                          $jumlah_jenis++;
                        } else if (strpos($kode, 'lk_') === 0) {
                          $jumlah_lk += round($nilai);
                        }
                      }
                      if ($jumlah_hari_kosong) {
                        $jumlah_jenis = $jumlah_jenis * $jumlah_hari_kosong;
                      }
                      $rata2_lpa = $jumlah_nilai1 / $jumlah_jenis;
                      $result[$key]['rata2_lpa'] = $rata2_lpa;
                      $result[$key]['rata2_lpa_round'] = round($rata2_lpa);
                      $result[$key]['jumlah_lk'] = round($jumlah_lk);
                    }
                    $lpa_value = array_column($result, 'rata2_lpa_round');
                    $lk_value = array_column($result, 'jumlah_lk');
                    array_multisort($lpa_value, SORT_DESC, $lk_value, SORT_DESC, $result);

                    //level2
                    foreach ($result2 as $key => $row) {
                      $jumlah_nilai2 = 0;
                      $jumlah_jenis = 0;
                      $jumlah_lk2 = 0;
                      $jumlah_hari_kosong = ($week ? 7 : date('N')) - $row['date_count'];
                      foreach ($row as $kode => $nilai) {
                        if (strpos($kode, 'lpa_') === 0) {
                          $jumlah_nilai2 += $nilai;
                          $jumlah_jenis++;
                        } else if (strpos($kode, 'lk_') === 0) {
                          $jumlah_lk2 += round($nilai);
                        }
                      }
                      if ($jumlah_hari_kosong) {
                        $jumlah_jenis = $jumlah_jenis * $jumlah_hari_kosong;
                      }
                      $rata2_lpa = $jumlah_nilai2 / $jumlah_jenis;
                      $result2[$key]['rata2_lpa'] = $rata2_lpa;
                      $result2[$key]['rata2_lpa_round'] = round($rata2_lpa);
                      $result2[$key]['jumlah_lk'] = round($jumlah_lk2);
                    }
                    $lpa_value = array_column($result2, 'rata2_lpa_round');
                    $lk_value = array_column($result2, 'jumlah_lk');
                    array_multisort($lpa_value, SORT_DESC, $lk_value, SORT_DESC, $result2);

                    //level 2
                    foreach ($result2 as $row2) {
                      $param_for_edit = base64_encode($row2['class_id'].'-'.$row2['section_id'].'-'.$row2['student_id']);
                      $cek_data = $this->db->get_where('build2', array('user_id' => 'student-'.$this->session->userdata('login_user_id'), 'date' => $date))->row();
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
                      $param_for_edit = base64_encode($row['class_id'].'-'.$row['section_id'].'-'.$row['student_id']);
                      $cek_data = $this->db->get_where('build', array('user_id' => 'student-'.$this->session->userdata('login_user_id'), 'date' => $date))->row();
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
                      $jumlah_lk2 = 0;
                      $angka_terisi = 0;
                      $indikators = array_slice(array_keys($lk), 6);
                      foreach ($indikators as $indikator) {
                        if ($lk[$indikator] != 0) $angka_terisi++;

                        $jumlah_lk2 += $lk[$indikator];
                      }
                      ?>
                      <tr>
                        <td><?= $data['date'] ?></td>
                        <td><img alt="" src="<?php echo $this->crud_model->get_image_url($tabel, $tes[0]->user_id); ?>" style="height: 25px; border-radius:50%;" class="purple"><span> <?php echo $this->crud_model->get_name($tabel, $tes[0]->user_id); ?></span></td>
                        <td><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $data['student_id']); ?>" style="height: 25px; border-radius:50%;" class="purple"><span> <?php echo $this->crud_model->get_name('student', $data['student_id']); ?></span></td>
                        <td><?= $this->db->get_where('section', array('section_id' => $data['section_id']))->row()->name; ?></td>
                        <td><?= to_abj($hasillpa2); ?></td>
                        <td><?= $jumlah_lk2 ?></td>
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
                      if ($tes[0]->user_type == 'student') {
                        $tabel = 'student';
                      } else if ($tes[0]->user_type == 'teacher') {
                        $tabel = 'teacher';
                      } else if ($tes[0]->user_type == 'parent') {
                        $tabel = 'parent';
                      }

                      // lk
                      $lk = $sqlLK[$key];
                      $jumlah_lk1 = 0;
                      $angka_terisi = 0;
                      $indikators = array_slice(array_keys($lk), 6);
                      foreach ($indikators as $indikator) {
                        if ($lk[$indikator] != 0) $angka_terisi++;

                        $jumlah_lk1 += $lk[$indikator];
                      }
                    ?>
                      <tr>
                        <td><?= $data['date'] ?></td>
                        <td><img alt="" src="<?php echo $this->crud_model->get_image_url($tabel, $tes[0]->user_id); ?>" style="height: 25px; border-radius:50%;" class="purple" ><span> <?php echo $this->crud_model->get_name($tabel, $tes[0]->user_id); ?></span></td>
                        <td><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $data['student_id']); ?>" style="height: 25px; border-radius:50%;" class="purple" ><span> <?php echo $this->crud_model->get_name('student', $data['student_id']); ?></span></td>
                        <td><?= $this->db->get_where('section', array('section_id' => $data['section_id']))->row()->name; ?></td>
                        <td><?= to_abj($hasillpa) ?></td>
                        <td><?= $jumlah_lk1 ?></td>
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
<script>
	var ctx = document.getElementById("myChart");
  console.log(<?= $jumlah_lk ?>);
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ["Level 1 ", "Level 2 "],
			datasets: [{
				label: '#',
				data: [<?= $jumlah_lk != false ? $jumlah_lk : 0 ?>, <?= $jumlah_lk2 != false ? $jumlah_lk2 : 0 ?>  ],
				backgroundColor: [
					'rgba(255, 99, 132, 0.7)',
					'rgba(54, 162, 235, 0.7)'
				],
				borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)'
				],
				borderWidth: 0
			}]
		},

	});
</script>
<script>
	var ctx = document.getElementById("myChart2");
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: {
			labels: ["Level 1", "Level 2"],
			datasets: [{
				label: '#',
				data: [<?= $jumlah_nilai1 != false ? $jumlah_nilai1 : 0; ?>, <?= $jumlah_nilai2 != false ? $jumlah_nilai2 : 0; ?>],
				backgroundColor: [
					'rgba(255, 99, 132, 0.7)',
					'rgba(54, 162, 235, 0.7)'
				],
				borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)'
				],
				borderWidth: 0
			}]
		},

	});
</script>


<script type="text/javascript">
  
  function get_class_sections(class_id) {
    console.log('test', class_id);
    $.ajax({
      url: '<?php echo base_url(); ?>student/get_class_section/' + class_id,
      success: function(response) {
        jQuery('#section_selector_holder').html(response);
      }
    });
  }

  function get_class_students(class_id) {
    $.ajax({
      url: '<?php echo base_url(); ?>student/get_class_stundets/' + class_id,
      success: function(response) {
        jQuery('#students_holder').html(response);
      }
    });
  }

  function type_section(type) {
    switch (type) {
      case '15':
      case '5':
      case '7':
        $('#section_1').addClass('d-none');
        $('#section_2').removeClass('d-none');
        break;
      default:
        $('#section_2').addClass('d-none');
        $('#section_1').removeClass('d-none');
        break;
    }
  }

  function get_lpa_lk_data(student_id) {
    var section = $('#section_selector_holder').val();
    var level = section <= 3 ? 1 : 2;
    $.ajax({
      url: '<?php echo base_url(); ?>student/get_lpa_lk_data/' + student_id + '?level=' + level,
      success: function(data) {
        if (data) {
          if (level == 2) {
            $('#lpa_2_1').val(data.lpa_2_1)
            $('#lpa_2_2').val(data.lpa_2_2)
            $('#lpa_2_3').val(data.lpa_2_3)
            $('#lpa_2_4').val(data.lpa_2_4)
            $('#lpa_2_5').val(data.lpa_2_5)
            $('#lpa_2_6').val(data.lpa_2_6)
            $('#lpa_2_7').val(data.lpa_2_7)
            $('#lpa_2_8').val(data.lpa_2_8)
            $('#lpa_2_9').val(data.lpa_2_9)
            $('#lpa_2_10').val(data.lpa_2_10)
            $('#lpa_2_11').val(data.lpa_2_11)
            $('#lpa_2_12').val(data.lpa_2_12)
            $('#lpa_2_13').val(data.lpa_2_13)
            $('#lpa_2_14').val(data.lpa_2_14)
            $('#lpa_2_15').val(data.lpa_2_15)
            $('#lpa_2_16').val(data.lpa_2_16)
            $('#lpa_2_17').val(data.lpa_2_17)
            $('#lpa_2_18').val(data.lpa_2_18)
            $('#lpa_2_19').val(data.lpa_2_19)
            $('#lpa_2_20').val(data.lpa_2_20)
            $('#lpa_2_21').val(data.lpa_2_21)
            $('#lpa_2_22').val(data.lpa_2_22)
            $('#lpa_2_23').val(data.lpa_2_23)
            $('#lpa_2_24').val(data.lpa_2_24)
            if (data.lk_id) {
              $('#lk_data_2 [name="sholat_wajib"]').val(data.sholat_wajib)
              $('#lk_data_2 [name="sholat_rawatib"]').val(data.sholat_rawatib)
              $('#lk_data_2 [name="sholat_dhuha"]').val(data.sholat_dhuha)
              $('#lk_data_2 [name="sholat_tahajud"]').val(data.sholat_tahajud)
              $('#lk_data_2 [name="setor_dalil"]').val(data.setor_dalil)
              $('.select-gambar [name="menutup_aurat"][value="' + data.menutup_aurat + '"]').click()
              $('#lk_data_2 [name="ilmu_fiqih"]').val(data.ilmu_fiqih)
              $('#lk_data_2 [name="membaca_alquran"]').val(data.membaca_alquran)
              $('#lk_data_2 [name="bahasa_arab"]').val(data.bahasa_arab)
              $('#lk_data_2 [name="shaum"]').val(data.shaum)
              $('#lk_data_2 [name="asmaulhusna"]').val(data.asmaulhusna)
            } else {
              $('#lk_data_2 [input="number"],#lk_data_2 select').val(0);
            }
          } else {
            $('#adb_1a_holder').val(data.adb_1a)
            $('#adb_1b_holder').val(data.adb_1b)
            $('#adb_1c_holder').val(data.adb_1c)
            $('#adb_1d_holder').val(data.adb_1d)
            $('#adb_2a_holder').val(data.adb_2a)
            $('#adb_2b_holder').val(data.adb_2b)
            $('#adb_2c_holder').val(data.adb_2c)
            $('#adb_2d_holder').val(data.adb_2d)
            $('#adb_2e_holder').val(data.adb_2e)
            $('#adb_3a_holder').val(data.adb_3a)
            $('#adb_3b_holder').val(data.adb_3b)
            $('#adb_4a_holder').val(data.adb_4a)
            $('#adb_4b_holder').val(data.adb_4b)
            $('#adb_5a_holder').val(data.adb_5a)
            $('#adb_5b_holder').val(data.adb_5b)
            $('#adb_6a_holder').val(data.adb_6a)
            $('#adb_6b_holder').val(data.adb_6b)
            $('#adb_6c_holder').val(data.adb_6c)
            $('#adb_6d_holder').val(data.adb_6d)
            $('#adb_7a_holder').val(data.adb_7a)
            $('#adb_7b_holder').val(data.adb_7b)
            $('#adb_7c_holder').val(data.adb_7c)
            $('#adb_7d_holder').val(data.adb_7d)
            $('#adb_7e_holder').val(data.adb_7e)
            $('#adb_8a_holder').val(data.adb_8a)
            $('#adb_8b_holder').val(data.adb_8b)
            $('#adb_9a_holder').val(data.adb_9a)
            $('#adb_9b_holder').val(data.adb_9b)
            if (data.lk_id) {
              $('#lk_data [name="sholat_shubuh"]').val(data.sholat_shubuh)
              $('#lk_data [name="sholat_dzuhur"]').val(data.sholat_dzuhur)
              $('#lk_data [name="shalat_ashar"]').val(data.shalat_ashar)
              $('#lk_data [name="shalat_magrib"]').val(data.shalat_magrib)
              $('#lk_data [name="shalat_isya"]').val(data.shalat_isya)
              $('#lk_data [name="membaca_asmaul_husna"]').val(data.membaca_asmaul_husna)
              $('#lk_data [name="mengenal_kosakata_arab"]').val(data.mengenal_kosakata_arab)
              $('#lk_data [name="hafal_doa"]').val(data.hafal_doa)
              $('#lk_data [name="mengikuti_kajian"]').val(data.mengikuti_kajian)
              $('#lk_data [name="membaca_quran"]').val(data.membaca_quran)
            } else {
              $('#lk_data [input="number"],#lk_data select').val(0);
            }
          }
        } else {
          $('#addroutine .col-lg-4 select').val(0)
          $('#lk_data [input="number"],#lk_data select').val(0);
        }
      }
    });
  }

  function change_type(type) {
    switch (type) {
      case '0':
        $('#lpa_data').addClass('d-none');
        $('#lk_data').addClass('d-none');
        break;
      case '1':
        $('#lk_data').addClass('d-none');
        $('#lpa_data').removeClass('d-none');
        $('#lpa_data_2').addClass('d-none');
        $('#lk_data_2').addClass('d-none');
        break;
      case '2':
        $('#lpa_data').addClass('d-none');
        $('#lk_data').removeClass('d-none');
        $('#lpa_data_2').addClass('d-none');
        $('#lk_data_2').addClass('d-none');
        break;
    }
  }

  function change_type_2(type) {
    switch (type) {
      case '0':
        $('#lpa_data_2').addClass('d-none');
        $('#lk_data_2').addClass('d-none');
        break;
      case '1':
        $('#lk_data_2').addClass('d-none');
        $('#lpa_data_2').removeClass('d-none');
        $('#lpa_data').addClass('d-none');
        $('#lk_data').addClass('d-none');
        break;
      case '2':
        $('#lpa_data_2').addClass('d-none');
        $('#lk_data_2').removeClass('d-none');
        $('#lpa_data').addClass('d-none');
        $('#lk_data').addClass('d-none');
        break;
    }
  }

  function select_aurat() {
    $('.select-gambar').removeClass('none');
  }
  $('.select-gambar [name="menutup_aurat"]').on('change', function() {
    var value = $('.select-gambar [name="menutup_aurat"]:checked').val()
    $('.select-aurat').text(value)
  })

  function pilih() {
    $('.select-gambar').addClass('none');
  }
</script>