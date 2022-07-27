<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$info = base64_decode($data);
$ex = explode("-", $info);
$class_info = $this->db->get('class')->result_array();
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
$originalDate = date('m/d/Y');
$newDate = date("d-m-Y", strtotime($originalDate));
$timestamp  = strtotime($newDate);
foreach ($sub as $row) :
?>
  <div class="content-w">
    <div class="conty">
      <?php include 'fancy.php'; ?>
      <div class="header-spacer"></div>
      <div class="cursos cta-with-media" style="background: #<?php echo $row['color']; ?>;">
        <div class="cta-content">
          <div class="user-avatar">
            <img alt="" src="<?php echo base_url(); ?>uploads/subject_icon/<?php echo $row['icon']; ?>" style="width:60px;">
          </div>
          <h3 class="cta-header"><?php echo $row['name']; ?> - <small><?php echo get_phrase('attendance'); ?></small></h3>
          <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"</small>
        </div>
      </div>
      <!-- Menu -->
          <?php include 'menu_akademic.php'; ?>
      <!-- End Menu -->
    <div class="content-i">
      <div class="content-box">
        <div class="ui-block">
          <article class="hentry post thumb-full-width">
            <?php echo form_open(base_url() . 'teacher/attendance_insert/' . $timestamp. '/' . $data); ?>
            <div class="post__author author vcard inline-items">
              <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>" style="border-radius:0px;">
              <div class="author-date">
                <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo get_phrase('attendance'); ?> <small>(<?php echo date("m/d/Y", $timestamp); ?>)</small>.</a>
              </div>
            </div>
            <div class="edu-posts cta-with-media">
              <div class="table-responsive">
                <table class="table table-lightborder table-bordered">
                  <thead>
                    <tr style="background:#0061da; color:#fff; text-align:center">
                      <th><?php echo get_phrase('student'); ?></th>
                      <th><?php echo get_phrase('roll'); ?></th>
                      <th><?php echo get_phrase('status'); ?></th>
                      <th>Deskripsi Kegiatan/Materi/Tugas</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count = 1;
                     $students   =   $this->db->get_where('enroll', array('class_id' => $ex[0], 'section_id' => $ex[1], 'year' => $running_year))->result_array();
                    foreach ($students as $row) :
                      $attn = $this->db->get_where('attendance', array('student_id' => $row['student_id'], 'timestamp' => $timestamp, 'subject_id' => $ex[2], 'teacher_id' => $this->session->userdata('login_user_id')))->row();
                    ?>
                    <input type="hidden" name="class_id" value="<?= $ex[0] ?>">
                    <input type="hidden" name="section_id" value="<?= $ex[1] ?>">
                    <input type="hidden" name="subject_id" value="<?= $ex[2] ?>">
                    <input type="hidden" name="year" value="<?= $running_year ?>">
                    <input type="hidden" name="student_id" value="<?= $row['student_id'] ?>">
                      <tr>
                        <td style="min-width:170px;">
                          <img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" width="25px" class="purple" style="border-radius: 50%;margin-right:5px;"><?php echo $this->crud_model->get_name('student', $row['student_id']); ?>
                        </td>
                        <td><?php echo $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->roll; ?></td>
                        <td style="text-align: center;" nowrap>
                          <span class="radio">
                            <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('present'); ?>">
                              <label>
                                <input type="radio" <?php if ($attn->status == 1) echo 'checked'; ?> value="1" name="status_<?php echo $row['student_id']; ?>_<?= $timestamp ?>"><span class="circle"></span><span class="check"></span>
                              </label>
                            </h6>
                          </span>
                          <span class="radio">
                            <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('late'); ?>">
                              <label>
                                <input type="radio" <?php if ($attn->status == 3) echo 'checked'; ?> value="3" name="status_<?php echo $row['student_id']; ?>_<?= $timestamp ?>"><span class="circle"></span><span class="check"></span>
                              </label>
                            </h6>
                          </span>
                          <span class="radio">
                            <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('absent'); ?>">
                              <label>
                                <input type="radio" <?php if ($attn->status == 2) echo 'checked'; ?> value="2" name="status_<?php echo $row['student_id']; ?>_<?= $timestamp ?>"><span class="circle"></span><span class="check"></span>
                              </label>
                            </h6>
                          </span>
                        </td>
                        <td>
                          <textarea type="text" class="form-control" name="ket_<?php echo $row['student_id']; ?>_<?= $timestamp ?>" placeholder="Keterangan"><?= $attn->keterangan ?></textarea>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <div class="form-buttons-w text-center">
                  <button class="btn btn-rounded btn-success" type="submit"> <?php echo get_phrase('update'); ?></button>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?>
          </article>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>


<script type="text/javascript">
  function select_section(class_id) {
    $.ajax({
      url: '<?php echo base_url(); ?>admin/get_sectionss/' + class_id,
      success: function(response) {
        jQuery('#section_holder').html(response);
      }
    });
  }
</script>