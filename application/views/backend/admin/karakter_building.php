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
            <a class="navs-links active" href="<?php echo base_url(); ?>admin/karakter_building/"><i class="os-icon picons-thin-icon-thin-0724_policeman_security"></i><span><?php echo get_phrase('character building'); ?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>admin/forum_konseling/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span>Forum Diskusi</span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>admin/request_student/"><i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span><?php echo get_phrase('reports'); ?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>admin/meet_konseling/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo get_phrase('live'); ?></span></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content-box">
      <div class="element-header" style="text-align: center; padding-top: 20px;">
        <a href="<?= base_url('admin/karakter_building/') ?>">
          <h4><?= date('d-m-Y', strtotime($start_date)) . ' s/d ' . date('d-m-Y', strtotime($end_date)) ?></h4>
        </a>
        <?php
        // if (!$week) {
        ?>
      </div>
      <div class="navigation-arrow mb-2">
        <div class="arrow-left mr-2" style="float: left;">
          <a href="<?= base_url('admin/karakter_building/' . ($week ? $week - 1 : '-1')) ?>" class="btn btn-block btn-outline-primary withripple">Sebelumnya</a>
        </div>
        <!-- <div class="arrow-today mr-2">
          <a href="<?= base_url('admin/karakter_building/') ?>" class="btn btn-block btn-primary withripple">Minggu ini</a>
        </div> -->
        <div class="arrow-right mr-2" style="float: right;">
          <a href="<?= base_url('admin/karakter_building/' . ($week ? $week + 1 : '1')) ?>" class="btn btn-block btn-outline-primary withripple">Selanjutnya</a>
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
              <div style="position: absolute; right: 0; top: -20px;">
                <a href="#" data-target="#addroutine" data-toggle="modal" data-focus="false" class="btn btn-control btn-grey-lighter btn-purple mr-2"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
                </a>
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
                      <th style="text-align: center"><?php echo get_phrase('Edit'); ?></th>
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
                      $cek_data = $this->db->get_where('build2', array('user_id' => 'admin-'.$this->session->userdata('login_user_id'), 'date' => $date, 'student_id' => $row['student_id']))->row();
                    ?>
                      <tr>
                        <td><span><?php echo $this->db->get_where('enroll', array('student_id' => $row2['student_id']))->row()->roll; ?></span></td>
                        <td class="cell-with-media">
                          <a href="<?php echo base_url(); ?>admin/looking_karakter/<?php echo $row2['student_id']; ?><?= $week ? "/$week" : "" ?>" style="color:#999999"><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row2['student_id']); ?>" style="height: 25px; border-radius:50%" class="purple"><span> <?php echo $this->crud_model->get_name('student', $row2['student_id']); ?></span></a>
                        </td>
                        <td><?= to_abj($row2['rata2_lpa']); ?></td>
                        <td><?= round($row2['jumlah_lk']); ?></td>
                        <?=  $cek_data != NULL  ? '<td align="center"> <a href="'. base_url() .'admin/edit_karakter/'. $param_for_edit .'" class="btn btn-control btn-grey-lighter btn-success" style="color:#eee"><i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i></a> </td>' : "" ?>
                      </tr>
                    <?php
                    }

                    //level 1
                    foreach ($result as $row) {
                      $param_for_edit = base64_encode($row['class_id'].'-'.$row['section_id'].'-'.$row['student_id']);
                      $cek_data = $this->db->get_where('build', array('user_id' => 'admin-'.$this->session->userdata('login_user_id'), 'date' => $date))->row();
                    ?>
                      <tr>
                        <td><span><?php echo $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->roll; ?></span></td>
                        <td class="cell-with-media">
                          <a href="<?php echo base_url(); ?>admin/looking_karakter/<?php echo $row['student_id']; ?><?= $week ? "/$week" : "" ?>" style="color:#999999"><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" style="height: 25px; border-radius:50%;" class="purple"><span> <?php echo $this->crud_model->get_name('student', $row['student_id']); ?></span></a>
                        </td>
                        <td><?= to_abj($row['rata2_lpa']); ?></td>
                        <td><?= round($row['jumlah_lk']); ?></td>
                        <?=  $cek_data != NULL  ? '<td align="center"> <a href="'. base_url() .'admin/edit_karakter/'. $param_for_edit .'" class="btn btn-control btn-grey-lighter btn-success" style="color:#eee"><i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i></a> </td>' : "" ?>
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
                      if ($tes[0]->user_type == 'admin') {
                        $tabel = 'admin';
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

<div class="modal fade" id="addroutine" tabindex="-1" role="dialog" aria-labelledby="addroutine" aria-hidden="true">
  <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
    <div class="modal-content">
      <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
      </a>
      <div class="modal-body">
        <div class="ui-block-title" style="background-color:#00579c">
          <h6 class="title" style="color:white"><?php echo get_phrase('add'); ?></h6>
        </div>
        <div class="ui-block-content">
          <?php echo form_open(base_url() . 'admin/create_perilaku/send/', array('enctype' => 'multipart/form-data')); ?>
          <div class="row">
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group label-floating is-select">
                <label class="control-label"><?php echo get_phrase('class'); ?></label>
                <div class="select">
                  <select name="class_id" onchange="get_class_sections(this.value)">
                    <option value=""><?php echo get_phrase('select'); ?></option>
                    <?php $cl = $this->db->get('class')->result_array();
                    foreach ($cl as $row) :
                    ?>
                      <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group label-floating is-select">
                <label class="control-label"><?php echo get_phrase('section'); ?></label>
                <div class="select">
                  <select name="section_id" id="section_selector_holder" onchange="get_class_students(this.value); type_section(this.value)">
                    <option value=""><?php echo get_phrase('select'); ?></option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="form-group label-floating is-select">
                <label class="control-label"><?php echo get_phrase('stduent'); ?></label>
                <div class="select">
                  <select name="student_id" id="students_holder" onchange="get_lpa_lk_data(this.value)" required>
                    <option value=""><?php echo get_phrase('select'); ?></option>
                  </select>
                </div>
              </div>
            </div>
            <!-- level 1 -->
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12" id=section_1>
              <div class="form-group label-floating is-select">
                <label class="control-label"><?php echo get_phrase('type'); ?></label>
                <div class="select">
                  <select name="input_type" id="input_type" onchange="change_type(this.value)">
                    <option value="0" selected></option>
                    <option value="1"><?= get_phrase('Perilaku dan Adab') ?></option>
                    <option value="2"><?= get_phrase('keagamaan') ?></option>
                  </select>
                </div>
              </div>
            </div>
            <!-- level 2 -->
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12 d-none" id="section_2">
              <div class="form-group label-floating is-select">
                <label class="control-label"><?php echo get_phrase('type'); ?></label>
                <div class="select">
                  <select name="input_type_2" id="input_type_2" onchange="change_type_2(this.value)">
                    <option value="0" selected></option>
                    <option value="1"><?= get_phrase('Perilaku dan Adab') ?></option>
                    <option value="2"><?= get_phrase('keagamaan') ?></option>
                  </select>
                </div>
              </div>
            </div>
            <!-- LPA level 1 -->
            <div id="lpa_data" class="m-0 row d-none">
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Merapihkan tempat tidur'); ?></label>
                  <div class="select">
                    <select name="adb_1a" id="adb_1a_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div>
                  <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Menyiapkan peralatan sekolah'); ?></label>
                  <div class="select">
                    <select name="adb_1b" id="adb_1b_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div>
                  <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Menyiapkan pakaian'); ?></label>
                  <div class="select">
                    <select name="adb_1c" id="adb_1c_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div>
                  <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Melakukan tugas-tugas tanpa disuruh'); ?></label>
                  <div class="select">
                    <select name="adb_1d" id="adb_1d_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div>
                  <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Berani untuk bertanya'); ?></label>
                  <div class="select">
                    <select name="adb_2a" id="adb_2a_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div>
                  <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Berani mengungkapkan pendapatnya'); ?></label>
                  <div class="select">
                    <select name="adb_2b" id="adb_2b_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Berani untuk meminta pertolongan'); ?></label>
                  <div class="select">
                    <select name="adb_2c" id="adb_2c_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Berani mengakui kesalahan dan mau memberi maaf'); ?></label>
                  <div class="select">
                    <select name="adb_2d" id="adb_2d_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Berani tampil kedepan'); ?></label>
                  <div class="select">
                    <select name="adb_2e" id="adb_2e_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Bersikap jujur'); ?></label>
                  <div class="select">
                    <select name="adb_3a" id="adb_3a_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Membiasakan memberi salam dan berjabat tangan'); ?></label>
                  <div class="select">
                    <select name="adb_3b" id="adb_3b_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Berbicara dengan lemah lembut'); ?></label>
                  <div class="select">
                    <select name="adb_4a" id="adb_4a_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Berperilaku sopan pada semua orang'); ?></label>
                  <div class="select">
                    <select name="adb_4b" id="adb_4b_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Mengucap bismillah sebelum aktifitas'); ?></label>
                  <div class="select">
                    <select name="adb_5a" id="adb_5a_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Mengucap hamdalah sesudah aktifitas'); ?></label>
                  <div class="select">
                    <select name="adb_5b" id="adb_5b_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Melakukan tasymit ketika bersin atau orang lain bersin'); ?></label>
                  <div class="select">
                    <select name="adb_6a" id="adb_6a_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Mau membantu sesama'); ?></label>
                  <div class="select">
                    <select name="adb_6b" id="adb_6b_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Mau diajak bekerja sama'); ?></label>
                  <div class="select">
                    <select name="adb_6c" id="adb_6c_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Bersedekah'); ?></label>
                  <div class="select">
                    <select name="adb_6d" id="adb_6d_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Membuang sampah pada tempatnya'); ?></label>
                  <div class="select">
                    <select name="adb_7a" id="adb_7a_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Peduli dengan kebersihan lingkungan'); ?></label>
                  <div class="select">
                    <select name="adb_7b" id="adb_7b_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Peduli keindahan'); ?></label>
                  <div class="select">
                    <select name="adb_7c" id="adb_7c_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Peduli kerapihan'); ?></label>
                  <div class="select">
                    <select name="adb_7d" id="adb_7d_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Menengok saudara / teman yang sakit'); ?></label>
                  <div class="select">
                    <select name="adb_7e" id="adb_7e_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Mengajak sesama berbuat baik'); ?></label>
                  <div class="select">
                    <select name="adb_8a" id="adb_8a_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Mengingatkan kebaikan terhadap sesama'); ?></label>
                  <div class="select">
                    <select name="adb_8b" id="adb_8b_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Mau meminta maaf ketika melakukan kesalahan'); ?></label>
                  <div class="select">
                    <select name="adb_9a" id="adb_9a_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
              <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('Mau bermaaf-maafan dengan sesama'); ?></label>
                  <div class="select">
                    <select name="adb_9b" id="adb_9b_holder">
                      <option value="0"></option>
                      <option value="4">A</option>
                      <option value="3">B</option>
                      <option value="2">C</option>
                      <option value="1">D</option>
                    </select>
                  </div> <span class="material-input"></span>
                </div>
              </div>
            </div>
            <!-- lk level 1 -->
            <div id="lk_data" class="col-12 m-0 p-0 row d-none">
              <?php
              $form_list = [
                ['name' => 'sholat_shubuh', 'text' => 'Sholat shubuh'],
                ['name' => 'sholat_dzuhur', 'text' => 'Sholat dzuhur'],
                ['name' => 'shalat_ashar', 'text' => 'Shalat ashar'],
                ['name' => 'shalat_magrib', 'text' => 'Shalat magrib'],
                ['name' => 'shalat_isya', 'text' => 'Shalat isya'],
                ['name' => 'membaca_asmaul_husna', 'text' => 'Membaca 99 asmaul husna', 'manual' => true],
                ['name' => 'mengenal_kosakata_arab', 'text' => 'Mengenal kosakata bahasa arab', 'manual' => true],
                ['name' => 'hafal_doa', 'text' => 'Hafal doa sehari-hari'],
                ['name' => 'mengikuti_kajian', 'text' => 'Mengikuti muhadoroh/kajian/taklim'],
                ['name' => 'membaca_quran', 'text' => 'Membaca al-Quran/Iqro', 'manual' => true]
              ];
              foreach ($form_list as $item) {
              ?>
                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                  <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo get_phrase($item['text']); ?></label>
                    <?php
                    if ($item['manual']) {
                    ?>
                      <input type="number" name="<?= $item['name'] ?>">
                    <?php
                    } else {
                    ?>
                      <div class="select">
                        <select name="<?= $item['name'] ?>">
                          <option value="0"></option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    <?php
                    }
                    ?>
                    <span class="material-input"></span>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
            <!-- end level 1 -->

            <!-- LPA level 2 -->
            <div id="lpa_data_2" class="col-12 m-0 p-0 row d-none">
              <?php
              $form_list = [
                ['name' => 'lpa_2-1', 'id' => 'lpa_2_1', 'text' => 'Mengikuti program pidato di hari Jumat'],
                ['name' => 'lpa_2-2', 'id' => 'lpa_2_2', 'text' => 'Mempresentasikan karya yang sedang dikerjakan setiap seminggu sekali'],
                ['name' => 'lpa_2-3', 'id' => 'lpa_2_3', 'text' => 'Berbahasa secara ahsan'],
                ['name' => 'lpa_2-4', 'id' => 'lpa_2_4', 'text' => 'Praktek karya ilmiah tentang makhluk hidup dan lingkungan sekitar'],
                ['name' => 'lpa_2-5', 'id' => 'lpa_2_5', 'text' => 'Memberikan minimal 3 hasil karya ilmiah/karangan/keterampilan dalam 1 semester'],
                ['name' => 'lpa_2-6', 'id' => 'lpa_2_6', 'text' => 'Mengucapkan kalimat istirja ketika mendapat musibah'],
                ['name' => 'lpa_2-7', 'id' => 'lpa_2_7', 'text' => 'Tidak tergesa-gesa'],
                ['name' => 'lpa_2-8', 'id' => 'lpa_2_8', 'text' => 'Sabar'],
                ['name' => 'lpa_2-9', 'id' => 'lpa_2_9', 'text' => 'Berbaik sangka'],
                ['name' => 'lpa_2-10', 'id' => 'lpa_2_10', 'text' => 'Banyak istigfar'],
                ['name' => 'lpa_2-11', 'id' => 'lpa_2_11', 'text' => 'Berdoa dengan doa-doa yang baik'],
                ['name' => 'lpa_2-12', 'id' => 'lpa_2_12', 'text' => 'Tawakal'],
                ['name' => 'lpa_2-13', 'id' => 'lpa_2_13', 'text' => 'Banyak berdzikir'],
                ['name' => 'lpa_2-14', 'id' => 'lpa_2_14', 'text' => 'Menghindari makanan dan minuman yang instant dan mengandung pengawet'],
                ['name' => 'lpa_2-15', 'id' => 'lpa_2_15', 'text' => 'Tidak berlebihan dalam makan, minum dan berpakaian'],
                ['name' => 'lpa_2-16', 'id' => 'lpa_2_16', 'text' => 'Mengamalkan adab-adab Keislaman'],
                ['name' => 'lpa_2-17', 'id' => 'lpa_2_17', 'text' => 'Melakukan kegiatan sosial setiap hari'],
                ['name' => 'lpa_2-18', 'id' => 'lpa_2_18', 'text' => 'Membaca buku minimal 1 tema perhari'],
                ['name' => 'lpa_2-19', 'id' => 'lpa_2_19', 'text' => 'Mengikuti kegiatan keagamaan'],
                ['name' => 'lpa_2-20', 'id' => 'lpa_2_20', 'text' => 'Mempersiapkan dan merapihkan peralatannya sendiri'],
                ['name' => 'lpa_2-21', 'id' => 'lpa_2_21', 'text' => 'Mengajak berbuat baik'],
                ['name' => 'lpa_2-22', 'id' => 'lpa_2_22', 'text' => 'Mencegah/menasihati perbuatan tercela'],
                ['name' => 'lpa_2-23', 'id' => 'lpa_2_23', 'text' => 'Siap tampil menjadi pemimpin'],
                ['name' => 'lpa_2-24', 'id' => 'lpa_2_24', 'text' => 'Mengerjakan pekerjaan rumah dan tugas-tugasnya'],
              ];
              foreach ($form_list as $data) {
              ?>
                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                  <div class="form-group label-floating is-select">
                    <label class="control-label"><?= $data['text'] ?></label>
                    <div class="select">
                      <select name="<?= $data['name'] ?>" id="<?= $data['id'] ?>">
                        <option value="0"></option>
                        <option value="4">A</option>
                        <option value="3">B</option>
                        <option value="2">C</option>
                        <option value="1">D</option>
                      </select>
                    </div>
                    <span class="material-input"></span>
                  </div>
                </div>
              <?php } ?>
            </div>

            <!-- LK Level 2 -->
            <div id="lk_data_2" class="col-12 m-0 p-0 row d-none">
              <?php
              $form_list = [
                ['name' => 'sholat_wajib', 'text' => 'Sholat Wajib', 'sepuluh' => true],
                ['name' => 'sholat_rawatib', 'text' => 'Sholat Rawatib', 'manual' => true],
                ['name' => 'sholat_dhuha', 'text' => 'Sholat Dhuha', 'manual' => true],
                ['name' => 'sholat_tahajud', 'text' => 'Sholat Tahajud', 'manual' => true],
                ['name' => 'setor_dalil', 'text' => 'Setor Dalil', 'manual' => true],
                ['name' => 'menutup_aurat', 'text' => 'Menutup Aurat dan Berpakaian Sopan', 'gambar' => true],
                ['name' => 'ilmu_fiqih', 'text' => 'Mengetahui Ilmu Fiqih Dasar', 'manual' => true],
                ['name' => 'membaca_alquran', 'text' => 'Membaca Alquran Dengan Tartil', 'manual' => true],
                ['name' => 'bahasa_arab', 'text' => 'Berbicara Bahasa Arab'],
                ['name' => 'shaum', 'text' => 'Shaum Sunnah / Wajib', 'lima' => true],
                ['name' => 'asmaulhusna', 'text' => 'Asmaulhusna & Terjemahannya', 'manual' => true]
              ];
              foreach ($form_list as $item) {
              ?>
                <div class="col col-lg-4 col-md-4 col-sm-12 col-12">
                  <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo get_phrase($item['text']); ?></label>
                    <?php
                    if ($item['manual']) {
                    ?>
                      <input type="number" name="<?= $item['name'] ?>">
                    <?php
                    } else if ($item['lima']) {
                    ?>
                      <div class="select">
                        <select name="<?= $item['name'] ?>">
                          <option value="0"></option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    <?php
                    } else if ($item['gambar']) {
                    ?>
                      <div class="select" onclick="select_aurat()">
                        <div class="select-aurat"></div>
                      </div>
                      <div class="none select select-gambar">
                        <div class="align-items-center d-flex form-input mb-4 mx-2">
                          <label for="aurat0" onclick="pilih()">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Tutup &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </label><input type="radio" id="aurat0" name="menutup_aurat" class="inline-block w-25 f-right none" value="0" style="flex-basis: 20px">
                        </div>
                        <div class="align-items-center d-flex form-input mb-4 mx-2">
                          <label for="aurat1" onclick="pilih()"><img src="<?= base_url('assets/images/') ?>2_poin.png" alt="" width="50" height="100" class="mr-2"> Menutup rambut</label><input type="radio" id="aurat1" name="menutup_aurat" value="1" class="inline-block w-25 f-right none" style="flex-basis: 20px">
                        </div>
                        <div class="align-items-center d-flex form-input mb-4 mx-2">
                          <label for="aurat2" onclick="pilih()"><img src="<?= base_url('assets/images/') ?>3_poin.png" alt="" width="50" height="100" class="mr-2"> Menutupi dada</label><input type="radio" id="aurat2" name="menutup_aurat" value="2" class="inline-block w-25 f-right none" style="flex-basis: 20px">
                        </div>
                        <div class="align-items-center d-flex form-input mb-4 mx-2">
                          <label for="aurat3" onclick="pilih()"><img src="<?= base_url('assets/images/') ?>4_poin.png" alt="" width="50" height="100" class="mr-2"> Longgar/tidak transparan</label><input type="radio" id="aurat3" name="menutup_aurat" value="3" class="inline-block w-25 f-right none" style="flex-basis: 20px">
                        </div>
                        <div class="align-items-center d-flex form-input mb-4 mx-2">
                          <label for="aurat4" onclick="pilih()"><img src="<?= base_url('assets/images/') ?>5_poin.png" alt="" width="50" height="100" class="mr-2"> Menutupi mata kaki</label><input type="radio" id="aurat4" name="menutup_aurat" value="4" class="inline-block w-25 f-right none" style="flex-basis: 20px">
                        </div>
                      </div>
                      <?php
                    } elseif($item['sepuluh']){
                    ?> 
                    <div class="select">
                        <select name="<?= $item['name'] ?>">
                          <option value="0"></option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                        </select>
                      </div>
                    <?php
                    } else {
                    ?>
                      <div class="select">
                        <select name="<?= $item['name'] ?>">
                          <option value="0"></option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
                    <?php
                    }
                    ?>
                    <span class="material-input"></span>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
          <div class="form-buttons-w text-right">
            <center><button class="btn btn-rounded btn-success" type="submit"><?php echo get_phrase('save'); ?></button></center>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
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
      url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
      success: function(response) {
        jQuery('#section_selector_holder').html(response);
      }
    });
  }

  function get_class_students(class_id) {
    $.ajax({
      url: '<?php echo base_url(); ?>admin/get_class_stundets/' + class_id,
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
      url: '<?php echo base_url(); ?>admin/get_lpa_lk_data/' + student_id + '?level=' + level,
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