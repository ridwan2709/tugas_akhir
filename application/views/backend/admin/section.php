<div class="content-w">
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
    <div class="conty">
      <div class="os-tabs-w menu-shad">
        <?php include 'pengaturan_academic_menu.php' ;?>
      </div>
      <div class="content-i">
        <div class="content-box">
          <div class="col-sm-12">
            <h5 class="form-header"><?php echo get_phrase('manage_sections');?></h5><br>
            <div class="row">
              <div class="col-sm-6">
                <?php echo form_open(base_url() . 'admin/section/', array('class' => 'form m-b'));?>
                <div class="form-group label-floating is-select">
                  <label class="control-label"><?php echo get_phrase('class');?></label>
                  <div class="select">
                    <select name="class_id" onchange="submit();">
                      <option value=""><?php echo get_phrase('select');?></option>
                      <?php $cl = $this->db->get('class')->result_array(); foreach($cl as $row):?>
                      <option value="<?php echo $row['class_id'];?>" <?php if($class_id == $row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <?php echo form_close();?>
              </div>
              <div class="col-sm-6">
                <div style="float:right;">
                  <a href="#" class="btn btn-control bg-purple" style="background:#99bf2d; color: #fff;" data-toggle="modal" data-target="#crearadmin">
                    <i class="picons-thin-icon-thin-0001_compose_write_pencil_new" style="font-size:25px;" title="<?php echo get_phrase('new_section');?>"></i>
                    <div class="ripple-container"></div>
                  </a>
                </div>
              </div>
              <div class="col-sm-12">  
                <div class="row">   
                <?php $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
                  foreach($sections as $row):?>
                  <div class="col-sm-4">
                    <div class="ui-block list">
                      <div class="more" style="float:right; margin-right:15px; ">
                        <i class="icon-options"></i>                                
                        <ul class="more-dropdown" style="z-index:999">
                          <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_section/<?php echo $row['section_id'];?>');"><?php echo get_phrase('edit');?></a></li>
                          <li><a class="delete" href="<?php echo base_url();?>admin/sections/delete/<?php echo $row['section_id'];?>"><?php echo get_phrase('delete');?></a></li>
                        </ul>
                      </div>
                      <div class="birthday-item inline-items">
                        <div class="circle blue"><?php echo substr($row['name'],0,2);?></div>&nbsp;
                        <div class="birthday-author-name">
                          <div><b><?php echo get_phrase('teacher');?>:</b> <?php echo $this->crud_model->get_name('teacher', $row['teacher_id']);?></div>
                          <div><b><?php echo get_phrase('students');?>:</b> <?php $this->db->where('section_id', $row['section_id']); echo $this->db->count_all_results('enroll');?>.</div>
                          <div><b><?php echo get_phrase('class');?>:</b> <span class="badge badge-info" style="font-size:12px"><?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;?></span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach;?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="crearadmin" tabindex="-1" role="dialog" aria-labelledby="crearadmin" aria-hidden="true" style="top:10%;">
    <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
      <div class="modal-content">
        <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
        </a>
        <div class="modal-body">
          <div class="modal-header" style="background-color:#00579c">
              <h6 class="title" style="color:white"><?php echo get_phrase('new_section');?></h6>
          </div>
          <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/sections/create');?>
                <div class="row">
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo get_phrase('name');?></label>
                            <input class="form-control" type="text" name="name" required="">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo get_phrase('teacher');?></label>
                            <div class="select">
                                <select name="teacher_id">
                                    <option value=""><?php echo get_phrase('select');?></option>
                                    <?php $teachers = $this->db->get('teacher')->result_array(); 
                                        foreach($teachers as $teacher):
                                    ?>
                                        <option value="<?php echo $teacher['teacher_id'];?>"><?php echo $teacher['first_name']." ".$teacher['last_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo get_phrase('class');?></label>
                            <div class="select">
                                <select name="class_id" required>
                                    <option value=""><?php echo get_phrase('select');?></option>
                                    <?php $classes = $this->db->get('class')->result_array(); 
                                        foreach($classes as $row2):
                                    ?>
                                        <option value="<?php echo $row2['class_id'];?>" <?php if($class_id == $row2['class_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success" type="submit"><?php echo get_phrase('save');?></button>
                    </div>
                </div>
            </form>          
        </div>
      </div>
    </div>
  </div>
</div>