<?php 
$running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
$info = base64_decode($data);
$ex = explode('-', $info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach($sub as $row):
  ?>
  <div class="content-w">
    <div class="conty">
      <?php include 'fancy.php';?>
      <div class="header-spacer"></div>
      <div class="cursos cta-with-media" style="background: #<?php echo $row['color'];?>;">
        <div class="cta-content">
          <div class="user-avatar">
            <img alt="" src="<?php echo base_url();?>uploads/subject_icon/<?php echo $row['icon'];?>" style="width:60px;">
          </div>
          <h3 class="cta-header"><?php echo $row['name'];?> - <small><?php echo get_phrase('online_exams');?></small></h3>
          <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
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
                <div class="element-wrapper">
                  <div class="element-box-tp">
                    <h6 class="element-header">
                      <?php echo get_phrase('online_exams');?>
                      <div style="margin-top:auto;float:right;"><a href="<?php echo base_url();?>admin/new_exam/<?php echo $data;?>/" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i><div class="ripple-container"></div></a></div>
                    </h6>
                    <div class="table-responsive">
                      <table class="table table-padded">
                        <thead>
                          <tr>
                            <th><?php echo get_phrase('status');?></th>
                            <th><?php echo get_phrase('title');?></th>
                            <th><?php echo get_phrase('date');?></th>
                            <th>Pembuat Soal</th>
                            <th><?php echo get_phrase('options');?></th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php
                         $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
                         $this->db->order_by('online_exam_id', 'desc');
                         $online_exams = $this->db->where(array('running_year' => $year, 'subject_id' => $row['subject_id'], 'class_id' => $row['class_id'],'section_id' => $ex[1]))->get('online_exam')->result_array();
                         foreach($online_exams as $row):
                          ?>
                          <tr>
                            <td>
                             <button class="btn btn-<?php echo $row['status'] == 'published' ? 'success' : 'warning'; ?> btn-sm"><?php if($row['status'] == "published") echo get_phrase('published'); else if($row['status'] == "pending") echo get_phrase('pending'); else echo get_phrase('expired');?></button>
                           </td>
                           <td><span><?php echo $row['title'];?></span></td>
                           <td><span><?php echo '<b>'.get_phrase('date').' :</b> '.date('M d, Y', $row['exam_date']).'<br>'.'<b>Masa Aktif :</b> '.$row['time_start'].' - '.$row['time_end'].'<br>'.'<b>Durasi :</b> '.$row['duration'].' Menit';?></span></td>
                           <td><span><?php echo $this->crud_model->get_name($this->db->get_where('online_exam', array('online_exam_id' => $row['online_exam_id']))->row()->uploader_type, $this->db->get_where('online_exam', array('online_exam_id' => $row['online_exam_id']))->row()->uploader_id);?></a></span></td>
                           <td class="bolder">
                            <a href="<?php echo base_url();?>admin/examroom/<?php echo $row['online_exam_id'];?>" class="btn btn-success btn-sm"> <?php echo get_phrase('details');?></a><br>
                            <?php if ($row['status'] == 'pending'): ?>
                              <a href="<?php echo base_url();?>admin/manage_online_exam_status/<?php echo $row['online_exam_id'];?>/published/<?php echo $data;?>/" class="btn btn-info btn-sm save"><?php echo get_phrase('publish_exam');?></a><br>
                              <?php elseif ($row['status'] == 'published'): ?>
                                <a href="<?php echo base_url();?>admin/manage_online_exam_status/<?php echo $row['online_exam_id'];?>/expired/<?php echo $data;?>/" class="btn btn-primary btn-sm save"> <?php echo get_phrase('mark_as_expired');?></a><br>
                                <?php elseif($row['status'] == 'expired'): ?>
                                  <a href="#" class="btn btn-warning btn-sm"> <?php echo get_phrase('expired');?></a><br>
                                <?php endif; ?>
                                <a class="btn btn-danger btn-sm delete" href="<?php echo base_url();?>admin/manage_exams/delete/<?php echo $row['online_exam_id'];?>/<?php echo $data;?>/"><?php echo get_phrase('delete');?></a>
                              </td>
                            </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
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