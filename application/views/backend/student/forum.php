<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php $info = base64_decode($data);
    $ex = explode('-', $info);
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
        <h3 class="cta-header"><?php echo $rows['name'];?> - <small><?php echo get_phrase('forum');?></small></h3>
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
                    <?php echo get_phrase('forum');?>
                    </h6>
                  <div class="table-responsive">
                    <table class="table table-padded">
                        <thead>
                          <tr>
                            <th><?php echo get_phrase('title');?></th>
					        <th><?php echo get_phrase('date');?></th>
					        <th class="text-center"><?php echo get_phrase('details');?></th>
                          </tr>
                        </thead>
                          <tbody>
                        <?php
	    		            $class_id = $this->db->get_where('enroll' , array('student_id' => $this->session->userdata('login_user_id') , 'year' => $running_year))->row()->class_id;
	    		            $section_id = $this->db->get_where('enroll' , array('student_id' => $this->session->userdata('login_user_id') , 'year' => $running_year))->row()->section_id;
    			            $this->db->order_by('post_id', 'desc');
    			            $post = $this->db->get_where('forum', array('class_id' => $class_id, 'section_id' => $section_id, 'post_status' => 1, 'subject_id' => $rows['subject_id']))->result_array();
    			            foreach ($post as $row):
    		            ?>
                          <tr>
                            <td><?php echo $row['title']; ?></td>
					        <td><a class="btn nc btn-rounded btn-sm btn-success" style="color:white"><?php echo $row['timestamp'];?></a></td>
					        <td class="row-actions">
						        <a class="btn btn-rounded btn-sm btn-primary" style="color:white" href="<?php echo base_url();?>student/forumroom/<?php echo $row['post_code']; ?>"><i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i> <?php echo get_phrase('view_forum');?></a>
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