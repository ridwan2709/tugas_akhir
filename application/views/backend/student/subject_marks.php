<?php 
  $encode_data = $data;
  $decode_data = base64_decode($encode_data);
  $explode_data = explode("-", $decode_data);
?>
<?php $min = $this->db->get_where('academic_settings' , array('type' =>'minium_mark'))->row()->description;?>
<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php if ($tahun_ajaran == NULL) {
  $tahun_ajaran = $running_year;
} ?>
<?php 
    $sub = $this->db->get_where('subject', array('subject_id' => $explode_data[2]))->result_array();
    foreach($sub as $rows):
?>
<div class="content-w">
  <div class="conty">
    <?php $info = base64_decode($data);?>
    <?php $ids = explode("-",$info);?>
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
    <div class="cursos cta-with-media" style="background: #<?php echo $rows['color'];?>;">
      <div class="cta-content">
        <div class="user-avatar">
          <img alt="" src="<?php echo base_url();?>uploads/subject_icon/<?php echo $rows['icon'];?>" style="width:60px;">
        </div>
        <h3 class="cta-header"><?php echo $rows['name'];?> - <small><?php echo get_phrase('marks');?></small></h3>
        <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $explode_data[0]))->row()->name;?> | <?php echo $this->db->get_where('section', array('section_id' => $explode_data[1]))->row()->name;?> | TA. <?= $tahun_ajaran ?></small>
      </div>
    </div>
      <!-- Menu -->
        <?php include 'menu_akademic.php' ?>
      <!-- End Menu -->
    <div class="content-i">
      <div class="content-box">
        <div class="row">
          <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
            <div id="newsfeed-items-grid">      
            <div style="padding:0% 0%">
        <div id='cssmenu'>
            <ul>
                <?php  
                    $var = 0;
                    $examss = $this->db->get('exam')->result_array();
                    foreach($examss as $exam):
                    $var++;
                ?>
                    <li class='<?php if($exam['exam_id'] == $exam_id) echo "act";?>'><a href="<?php echo base_url();?>student/subject_marks/<?php echo $data.'/'.$exam['exam_id'];?>/<?= $tahun_ajaran ?>"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><?php echo $exam['name'];?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
      </div>
                <div class="element-wrapper bg-white">
                    <div class="element-box-tp">
                     <div class="table-responsive">
                <table class="table table-lightborder">
                  <thead>
                    <tr style="background-color: #e1e8ed; color:#000;">
                      <th class="text-center">#</th>
                      <th class="text-center"><?php echo get_phrase('activity');?></th>
                      <th class="text-center"><?php echo get_phrase('mark');?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="text-center">
                      <td>1</td>
                      <td><?php echo $this->db->get_where('subject' , array('subject_id' => $explode_data[2]))->row()->la1;?></td>
            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php if($this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->mark_obtained == "") echo '0'; else echo $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $explode_data[0], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->mark_obtained; ?></a></td>
                    </tr>
                    <tr class="text-center">
                      <td>2</td>
                      <td><?php echo $this->db->get_where('subject' , array('subject_id' => $explode_data[2]))->row()->la2;?></td>
            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php if($this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labuno == "") echo '0'; else echo $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $explode_data[0], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labuno; ?></a></td>
                    </tr>
                    <tr class="text-center">
                      <td>3</td>
                      <td><?php echo $this->db->get_where('subject' , array('subject_id' => $explode_data[2]))->row()->la3;?></td>
            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php if($this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labdos == "") echo '0'; else echo $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $explode_data[0], 'student_id' => $explode_data[1], 'year' => $tahun_ajaran))->row()->labdos; ?></a></td>
                    </tr>
                    <tr class="text-center">
                      <td>4</td>
                      <td><?php echo $this->db->get_where('subject' , array('subject_id' => $explode_data[2]))->row()->la4;?></td>
            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php if($this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labtres == "") echo '0'; else echo $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $explode_data[0], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labtres; ?></a></td>
                    </tr>
                    <tr class="text-center">
                      <td>5</td>
                      <td><?php echo $this->db->get_where('subject' , array('subject_id' => $explode_data[2]))->row()->la5;?></td>
            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php if($this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labcuatro == "") echo '0'; else echo $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $explode_data[0], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labcuatro; ?></a></td>
                    </tr>
                    <tr class="text-center">
                      <td>6</td>
                      <td><?php echo $this->db->get_where('subject' , array('subject_id' => $explode_data[2]))->row()->la6;?></td>
            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php if($this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labcinco == "") echo '0'; else echo $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $explode_data[0], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labcinco; ?></a></td>
                    </tr>
                    <tr class="text-center">
                      <td>7</td>
                      <td><?php echo $this->db->get_where('subject' , array('subject_id' => $explode_data[2]))->row()->la7;?></td>
            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php if($this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labseis == "") echo '0'; else echo $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $explode_data[0], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labseis; ?></a></td>
                    </tr>
                    <tr class="text-center">
                      <td>8</td>
                      <td><?php echo $this->db->get_where('subject' , array('subject_id' => $explode_data[2]))->row()->la8;?></td>
            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php if($this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labsiete == "") echo '0'; else echo $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $explode_data[0], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labsiete; ?></a></td>
                    </tr>
                    <tr class="text-center">
                      <td>9</td>
                      <td><?php echo $this->db->get_where('subject' , array('subject_id' => $explode_data[2]))->row()->la9;?></td>
            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php if($this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' =>$this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labocho == "") echo '0'; else echo $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $explode_data[0], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labocho; ?></a></td>
                    </tr>
                    <tr class="text-center">
                      <td>10</td>
                      <td><?php echo $this->db->get_where('subject' , array('subject_id' => $explode_data[2]))->row()->la10;?></td>
            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php  if($this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labnueve == "") echo '0'; else echo $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $explode_data[0], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labnueve;?></a></td>
                    </tr>
                    <tr style="border-top: solid #a5a5a5;" class="text-center">
                      <td>
                        -
                      </td>
                      <td>
                        <?php echo get_phrase('total');?>
                      </td>
            <td>
            <?php $mark = $this->db->get_where('mark' , array('subject_id' => $explode_data[2], 'exam_id' => $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $tahun_ajaran))->row()->labtotal;?>
            <?php if($mark < $min || $mark == ""):?>
              <a class="btn btn-rounded btn-sm btn-danger" style="color:white"><?php if($mark == "") echo '0'; else echo $mark;?></a>
            <?php endif;?>
            <?php if($mark >= $min):?>
              <a class="btn btn-rounded btn-sm btn-success" style="color:white"><?php echo $mark;?></a>
            <?php endif;?>
            </td>
                    </tr> 
                  </tbody>
                </table>
              </div>
        <a class="btn btn-sm btn-success text-white" style="margin-left:10px;" href="<?php echo base_url();?>student/my_marks/"><?php echo get_phrase('view_all_marks');?></a><br><br>
        
                </div>
              </div>
            </div>
          </main>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach;?>