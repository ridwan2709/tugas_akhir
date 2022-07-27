<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>
<div class="content-w">
  <div class="conty">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
          <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url(); ?>admin/teacher_attendance/"><i class="os-icon picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i><span><?php echo get_phrase('teacher_attendance'); ?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url(); ?>admin/teacher_attendance_report/"><i class="os-icon os-icon picons-thin-icon-thin-0386_graph_line_chart_statistics"></i><span><?php echo get_phrase('teacher_attendance_report'); ?></span></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content-i">
      <div class="content-box">
        <?php echo form_open(base_url() . 'admin/attendance_teacher/', array('class' => 'form m-b')); ?>
        <div class="row col-sm-12">
          <div class="col-sm-8 col-lg-4" style="width: 240px;">
            <div class="form-group label-floating" style="background:#fff;">
              <label class="control-label"><?php echo get_phrase('date'); ?></label>
              <input type='text' class="datepicker-here" data-position="bottom left" data-language='en' name="timestamp" data-multiple-dates-separator="/" value="<?php echo date("m/d/Y", $timestamp); ?>" />
              <span class="material-input"></span>
            </div>
          </div>
          <input type="hidden" name="year" value="<?php echo $running_year; ?>">
          <div class="col-sm-4 col-lg-2" style="width: 10px; margin-left:-22px">
            <div class="form-group" style="width: 120px;">
              <button class="btn" style="margin-top:10px; background-color: #f2f4f8; border-color:#f2f4f8; font-size:20px" type="submit"><i class="picons-thin-icon-thin-0033_search_find_zoom"></i> </button>
              <?php echo form_close(); ?>
              <botton class="btn" style="margin-top: 10px; margin-left:-15px; background-color: #f2f4f8; border-color:#f2f4f8;" id="scan" data-toggle="modal" data-target="#modal"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 172 172" style=" fill:#000000;background-color: #f2f4f8; border-color:#f2f4f8;">
                  <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                    <path d="M0,172v-172h172v172z" fill="none"></path>
                    <g fill="#636c72">
                      <path d="M13.76,13.76v20.64c-0.01754,1.24059 0.63425,2.39452 1.7058,3.01993c1.07155,0.62541 2.39684,0.62541 3.46839,0c1.07155,-0.62541 1.72335,-1.77935 1.7058,-3.01993v-13.76h13.76c1.24059,0.01754 2.39452,-0.63425 3.01993,-1.7058c0.62541,-1.07155 0.62541,-2.39684 0,-3.46839c-0.62541,-1.07155 -1.77935,-1.72335 -3.01993,-1.7058zM137.6,13.76c-1.24059,-0.01754 -2.39452,0.63425 -3.01993,1.7058c-0.62541,1.07155 -0.62541,2.39684 0,3.46839c0.62541,1.07155 1.77935,1.72335 3.01993,1.7058h13.76v13.76c-0.01754,1.24059 0.63425,2.39452 1.7058,3.01993c1.07155,0.62541 2.39684,0.62541 3.46839,0c1.07155,-0.62541 1.72335,-1.77935 1.7058,-3.01993v-20.64zM44.72,34.4v103.2h3.44h79.12v-103.2zM51.6,41.28h68.8v89.44h-68.8zM17.14625,134.11297c-1.89722,0.02966 -3.41223,1.58976 -3.38625,3.48703v20.64h20.64c1.24059,0.01754 2.39452,-0.63425 3.01993,-1.7058c0.62541,-1.07155 0.62541,-2.39684 0,-3.46839c-0.62541,-1.07155 -1.77935,-1.72335 -3.01993,-1.7058h-13.76v-13.76c0.01273,-0.92983 -0.35149,-1.82522 -1.00967,-2.48214c-0.65819,-0.65692 -1.55427,-1.01942 -2.48408,-1.00489zM154.74625,134.11297c-1.89722,0.02966 -3.41223,1.58976 -3.38625,3.48703v13.76h-13.76c-1.24059,-0.01754 -2.39452,0.63425 -3.01993,1.7058c-0.62541,1.07155 -0.62541,2.39684 0,3.46839c0.62541,1.07155 1.77935,1.72335 3.01993,1.7058h20.64v-20.64c0.01273,-0.92983 -0.35149,-1.82522 -1.00967,-2.48214c-0.65819,-0.65692 -1.55427,-1.01942 -2.48408,-1.00489z"></path>
                    </g>
                  </g>
                </svg></botton>
            </div>
          </div>
        </div>
        <div class="modal fade kamera" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" style="margin-top: 40%; width: 100%;  padding: 0">
            <div class="modal-content" style="height: auto;  min-height: 100%;  border-radius: 0;">
              <div class="modal-body">
                <video src="" id="preview" width="100%"></video>
                <center>
                  <select id="selectCamera" name="options" class="form-select">
                  </select>
                </center>
              </div>
            </div>
          </div>
        </div>
        <div class="ui-block">
          <article class="hentry post thumb-full-width">
            <div class="post__author author vcard inline-items">
              <img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>" style="border-radius:0px;">
              <div class="author-date">
                <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo get_phrase('teachers_attendance'); ?> <small>(<?php echo date("m/d/Y", $timestamp); ?>)</small>.</a>
              </div>
            </div>
            <div class="edu-posts cta-with-media">
              <div class="table-responsive">
                <?php echo form_open(base_url() . 'admin/attendance_update3/' . $timestamp); ?>
                <table class="table table-lightborder">
                  <thead>
                    <tr class="bg-primary">
                      <th class="text-white"><?php echo get_phrase('teacher'); ?></th>
                      <th class="text-white" style="text-align: center;"><?php echo get_phrase('status'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $count = 1;
                    $select_id = 0;
                    $attendance = $this->db->get_where('teacher')->result_array();
                    foreach ($attendance as $row) :
                      $attn = $this->db->get_where('teacher_attendance', array('teacher_id' => $row['teacher_id'], 'timestamp' => $timestamp))->row();
                    ?>
                      <tr>
                        <td style="min-width:170px">
                          <img alt="" src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']); ?>" width="25px" style="border-radius: 50%; margin-right:5px;" class="purple"><?php echo $this->crud_model->get_name('teacher', $row['teacher_id']); ?>
                        </td>
                        <input type="hidden" name="year" value="<?= $running_year ?>">
                        <td style="text-align: center;" nowrap>
                          <span class="radio">
                            <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('present'); ?>">
                              <label>
                                <input type="radio" <?php if ($attn->status == 1) echo 'checked'; ?> value="1" name="status_<?php echo $row['teacher_id'] . "_" . $timestamp; ?>"><span class="circle"></span><span class="check"></span>
                              </label>
                            </h6>
                          </span>
                          <span class="radio">
                            <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('late'); ?>">
                              <label>
                                <input type="radio" <?php if ($attn->status == 3) echo 'checked'; ?> value="3" name="status_<?php echo $row['teacher_id'] . "_" . $timestamp; ?>"><span class="circle"></span><span class="check"></span>
                              </label>
                            </h6>
                          </span>
                          <span class="radio">
                            <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('absent'); ?>">
                              <label>
                                <input type="radio" value="2" <?php if ($attn->status == 2) echo 'checked'; ?> name="status_<?php echo $row['teacher_id'] . "_" . $timestamp; ?>"><span class="circle"></span><span class="check"></span>
                              </label>
                            </h6>
                          </span>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <div class="form-buttons-w">
                  <button class="btn btn-success btn-rounded" type="submit"> <?php echo get_phrase('update'); ?></button>
                </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </article>
        </div>




      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#scan").click(function() {
      $('.kamera').removeClass('none');

      let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
      });
      scanner.addListener('scan', function(content) {
        $.ajax({
          url: "<?= base_url('admin/attendance_update2/') . $timestamp ?>",
          type: 'post',
          data: 'id=' + content,
          success: function(msg) {
            if (msg == 'sukses') {
              location.reload();
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Data berhasil disimpan',
                showConfirmButton: false,
                timer: 2000
              })
            } else {
              console.loh(msg);
            }
          }
        });
      });
      Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
          cameras.forEach(function(item) {
            $('#selectCamera').append('<option value="' + item.id + '">' + item.name + '</option>')
          })

          $('#selectCamera').on('change', function(event) {
            var id = $(this).val()
            var camera = cameras.find(function(camera) {
              return camera.id === id;
            })
            scanner.start(camera);
          })

          $('#selectCamera').val(cameras[0].id).trigger('change')

          var backCamera = cameras.find(function(camera) {
            return camera.name.indexOf('back') !== -1
          });

          if (backCamera) {
            $('#selectCamera').val(backCamera.id).trigger('change')
          }
        } else {
          console.error('Cameras Not Found');
        }
      }).catch(function(e) {
        conrole.error(e);
      });
    });
  });
</script>