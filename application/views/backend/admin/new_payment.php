<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <?php include 'menuPayments.php'; ?>
    <div class="content-i">
      <div class="content-box">
        <div class="element-wrapper">
          <div class="os-tabs-w">
            <div class="os-tabs-controls">
              <ul class="navs navs-tabs upper">
                <li class="navs-item">
                  <a class="navs-links active" data-toggle="tab" href="#single"><?php echo get_phrase('single_invoice'); ?></a>
                </li>
                <li class="navs-item">
                  <a class="navs-links" data-toggle="tab" href="#bulk"><?php echo get_phrase('bulk_invoice'); ?></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="tab-content">
            <div class="tab-pane active" id="single">
              <div class="row">
                <div class="col-sm-6">
                  <?php echo form_open(base_url() . 'admin/invoice/create'); ?>
                  <div class="element-box lined-primary shadow">
                    <h5 class="form-header"><?php echo get_phrase('invoice_details'); ?></h5><br>

                    <div class="row">
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                          <label class="control-label"><?php echo get_phrase('class'); ?></label>
                          <div class="select">
                            <select name="class_id" required="" onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select'); ?></option>
                              <?php
                              $classes = $this->db->get('class')->result_array();
                              foreach ($classes as $row) :
                              ?>
                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group label-floating is-select">
                          <label class="control-label"><?php echo get_phrase('section'); ?></label>
                          <div class="select">
                            <?php
                            $section_id = '';
                            if ($section_id == "") :
                            ?>
                              <select name="section_id" required id="section_holder" onchange="return get_student(this.value)">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                              </select>
                            <?php
                            else :
                            ?>
                              <select name="section_id" required id="section_holder" onchange="get_student(this.value)">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
                                foreach ($sections as $key) :
                                ?>
                                  <option value="<?php echo $key['section_id']; ?>" <?php if ($section_id == $key['section_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
                                <?php
                                endforeach;
                                ?>
                              </select>
                            <?php
                            endif;
                            ?>
                          </div>
                        </div>
                      </div>
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                          <label class="control-label"><?php echo get_phrase('student'); ?></label>
                          <div class="select">
                            <?php
                            $student_id = '';
                            if ($student_id == "") :
                            ?>
                              <select name="student_id" required id="student_holder">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                              </select>
                            <?php
                            else :
                            ?>
                              <select name="student_id" required id="student_holder">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $students = $this->db->get_where('enroll', array('class_id' => $class_id))->result_array();
                                foreach ($students as $key) :
                                ?>
                                  <option value="<?php echo $key['student_id']; ?>" <?php if ($student_id == $key['student_id']) echo "selected"; ?>><?php echo $this->crud_model->get_name('student', $key['student_id']); ?></option>
                                <?php
                                endforeach;
                                ?>
                              </select>
                            <?php
                            endif;
                            ?>
                          </div>
                        </div>
                      </div>
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                          <label class="control-label"><?php echo get_phrase('title'); ?></label>
                          <input class="form-control" name="title" type="text" required="">
                        </div>
                      </div>
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-empty">
                          <label class="control-label"><?php echo get_phrase('description'); ?>:</label>
                          <textarea class="form-control" name="description" rows="3" required=""></textarea>
                          <span class="material-input"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="element-box lined-success shadow">
                    <h5 class="form-header">
                      <?php echo get_phrase('payment_details'); ?>
                    </h5><br>
                    <div class="row">
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                          <label class="control-label"><?php echo get_phrase('amount'); ?></label>
                          <input class="form-control uang" name="amount" type="text" required="">
                        </div>
                      </div>
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                          <label class="control-label"><?php echo get_phrase('status'); ?></label>
                          <div class="select">
                            <select name="status" required="">
                              <option value=""><?php echo get_phrase('select'); ?></option>
                              <option value="completed"><?php echo get_phrase('completed'); ?></option>
                              <option value="pending"><?php echo get_phrase('pending'); ?></option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                          <label class="control-label"><?php echo get_phrase('method'); ?></label>
                          <div class="select">
                            <select name="method" required="">
                              <option value=""><?php echo get_phrase('select'); ?></option>
                              <option value="3"><?php echo get_phrase('card'); ?></option>
                              <option value="1"><?php echo get_phrase('cash'); ?></option>
                              <option value="2"><?php echo get_phrase('check'); ?></option>
                            </select>
                          </div>
                        </div>
                      </div><br>
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <button class="btn btn-success btn-rounded" type="submit"><?php echo get_phrase('create_invoice'); ?></button>
                      </div>
                    </div>
                  </div>
                  <?php echo form_close(); ?>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="bulk">
              <?php echo form_open(base_url() . 'admin/invoice/bulk', array('class' => 'form-horizontal form-groups-bordered validate', 'id' => 'mass', 'target' => '_top')); ?>
              <div class="row">
                <div class="col-sm-6">
                  <div class="element-box lined-primary shadow">
                    <h5 class="form-header"><?php echo get_phrase('payment_details'); ?></h5><br>

                    <div class="row">
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                          <label class="control-label"><?php echo get_phrase('class'); ?></label>
                          <div class="select">
                            <select name="class_id" required="" class="class_id" onchange="return get_class_students_mass(this.value)">
                              <option value=""><?php echo get_phrase('select'); ?></option>
                              <?php
                              $classes = $this->db->get('class')->result_array();
                              foreach ($classes as $row) :
                              ?>
                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                          <label class="control-label"><?php echo get_phrase('amount'); ?></label>
                          <input class="form-control uang" name="amount" type="text" required="">
                        </div>
                      </div>
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                          <label class="control-label"><?php echo get_phrase('title'); ?></label>
                          <input class="form-control" name="title" type="text" required="">
                        </div>
                      </div>
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-empty">
                          <label class="control-label"><?php echo get_phrase('description'); ?>:</label>
                          <textarea class="form-control" name="description" rows="3" required=""></textarea>
                          <span class="material-input"></span>
                        </div>
                      </div>
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                          <label class="control-label"><?php echo get_phrase('method'); ?></label>
                          <div class="select">
                            <select name="method" required="">
                              <option value=""><?php echo get_phrase('select'); ?></option>
                              <option value="3"><?php echo get_phrase('card'); ?></option>
                              <option value="1"><?php echo get_phrase('cash'); ?></option>
                              <option value="2"><?php echo get_phrase('check'); ?></option>
                            </select>
                          </div>
                        </div>
                      </div><br>

                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="element-box lined-success shadow">
                    <h5 class="form-header">
                      <?php echo get_phrase('students'); ?>
                    </h5><br>
                    <div class="row">
                      <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                          <label class="control-label"><?php echo get_phrase('status'); ?></label>
                          <div class="select">
                            <select name="status" required="">
                              <option value=""><?php echo get_phrase('select'); ?></option>
                              <option value="completed"><?php echo get_phrase('completed'); ?></option>
                              <option value="pending"><?php echo get_phrase('pending'); ?></option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="student_selection_holder_mass"></div>
                    <hr>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                      <button class="btn btn-success btn-rounded" type="submit"><?php echo get_phrase('create_invoice'); ?></button>
                    </div>
                  </div>
                </div>
              </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
  function select() {
    var chk = $('.check');
    for (i = 0; i < chk.length; i++) {
      chk[i].checked = true;
    }
  }

  function unselect() {
    var chk = $('.check');
    for (i = 0; i < chk.length; i++) {
      chk[i].checked = false;
    }
  }
</script>
<script type="text/javascript">
  var class_id = '';

  function get_class_students_mass(class_id) {
    if (class_id !== '') {
      $.ajax({
        url: '<?php echo base_url(); ?>admin/get_class_students_mass/' + class_id,
        success: function(response) {
          jQuery('#student_selection_holder_mass').html(response);
        }
      });
    }
  }

  function check_validation() {
    if (section_id !== '') {
      $('.submit').removeAttr('disabled');
    } else {
      $('.submit').attr('disabled', 'disabled');
    }
  }
  $('.section_id').change(function() {
    section_id = $('.section_id').val();
    check_validation();
  });
</script>
<script type="text/javascript">
  function get_class_sections(class_id) {
    $.ajax({
      url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
      success: function(response) {
        jQuery('#section_holder').html(response);
      }
    });
  }
</script>

<script type="text/javascript">
  function get_student(section_id) {
    $.ajax({
      url: '<?php echo base_url(); ?>admin/get_class_students/' + section_id,
      success: function(response) {
        jQuery('#student_holder').html(response);
      }
    });
  }
</script>