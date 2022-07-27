<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php $info = base64_decode($data);
$ex = explode('-', $info);
$originalDate = date('m/d/Y');
$newDate = date("d-m-Y", strtotime($originalDate));
$timestamp  = strtotime($newDate);
?>
<?php $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
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
          <h3 class="cta-header"><?php echo $rows['name'];?> - <small><?php echo get_phrase('live');?></small></h3>
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
                    <h6 class="element-header"><?php echo get_phrase('live');?></h6>
                    <div class="table-responsive">
                      <table class="table table-padded">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('title');?></th>
                            <th><?php echo get_phrase('date');?></th>
                            <th><?php echo get_phrase('description');?></th>
                            <th><?php echo get_phrase('options');?></th>
                          </tr>
                        </thead>
                        <?= var_dump($timestamp) ?>
                        <tbody>
                          <?php
                          $n = 1;
                          $this->db->order_by('live_id', 'desc');
                          $this->db->where('class_id', $ex[0]);
                          $this->db->where('section_id', $ex[1]);
                          $this->db->where('subject_id', $ex[2]);
                          $info = $this->db->get('live')->result_array();
                          foreach ($info as $row):
                           ?>   
                           <tr>
                            <td><?php echo $n++?></td>
                            <td><?php echo $row['title']?></td>
                            <td><?php echo $row['date']." ".$row['time'];?></td>
                            <td><?php echo $row['description']?></td>
                            <td class="text-center bolder">
                              <form action="<?= base_url('student/liveClass/').$row['live_id'].'/'.$row['liveType'];?>" method="post">
                                <input type="hidden" name="class_id" value="<?= $ex[0] ?>">
                                <input type="hidden" name="section_id" value="<?= $ex[1] ?>">
                                <input type="hidden" name="subject_id" value="<?= $ex[2] ?>">
                                <input type="hidden" name="timestamp" value="<?= $timestamp ?>">
                                <button type="submit" style="color:gray; background:transparent; border:0px"><span><i style="color:gray;" class="picons-thin-icon-thin-0139_window_new_extern_full_screen_maximize"></i></span></button>
                              </form>
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