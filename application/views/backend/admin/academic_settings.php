<div class="content-w">
    <?php include 'fancy.php';?>
	<div class="header-spacer"></div>
	   <div class="conty">
		    <div class="os-tabs-w menu-shad">
			    <div class="os-tabs-controls">
			        <ul class="navs navs-tabs upper">
				        <li class="navs-item">
    				        <a class="navs-links active" href="<?php echo base_url();?>admin/section/"><i class="os-icon picons-thin-icon-thin-0006_book_writing_reading_read_manual"></i><span><?php echo get_phrase('academic_settings'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/section/"><i class="os-icon picons-thin-icon-thin-0002_write_pencil_new_edit"></i><span><?php echo get_phrase('sections'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/grade/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo get_phrase('grades'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/semesters/"><i class="os-icon picons-thin-icon-thin-0007_book_reading_read_bookmark"></i><span><?php echo get_phrase('semesters'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/student_promotion/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo get_phrase('student_promotion'); ?></span></a>
				        </li>
			        </ul>
			    </div>
		    </div>
            <div class="content-i">
                <div class="content-box">
		            <div class="col-sm-12">
                    <div class="element-box lined-primary shadow">
		                <h5 class="form-header"><?php echo get_phrase('academic_settings');?></h5><br>
		                <?php echo form_open(base_url() . 'admin/academic_settings/do_update' , array('target'=>'_top'));?>
		                <div class="row">
                            <div class="col-sm-4">
                                <div class="description-toggle">
                                    <div class="description-toggle-content">
                                        <label><?php echo get_phrase('enable_teacher_reports'); ?></label>
                                    </div>
                                    <div class="togglebutton">
                                        <label><input name="report_teacher" value="1" type="checkbox" <?php if($this->db->get_where('settings', array('type' => 'students_reports'))->row()->description == 1) echo "checked";?>></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-toggle">
                                    <div class="description-toggle-content">
                                        <label><?php echo get_phrase('enable_sundays_schedules'); ?></label>
                                    </div>
                                    <div class="togglebutton">
                                        <label><input name="routine" value="1" type="checkbox" <?php if($this->db->get_where('academic_settings' , array('type' =>'routine'))->row()->description == 1) echo 'checked';?>></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                          		    <label class="control-label"><?php echo get_phrase('minimum_mark'); ?></label>
                  			        <input class="form-control" name="minium_mark" type="text" required="" value="<?php echo $this->db->get_where('academic_settings' , array('type' =>'minium_mark'))->row()->description;?>">
                		        </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group label-floating">
                                    <label><?php echo get_phrase('terms_conditions'); ?></label>
                                    <textarea class="form-control" name="terms" id="ckeditor1"><?php echo $this->db->get_where('academic_settings' , array('type' =>'terms'))->row()->description;?></textarea>
                                </div>
                            </div>
                        </div>
		                <div class="form-buttons-w">
                            <button class="btn btn-rounded btn-success" type="submit"> <?php echo get_phrase('update');?></button>
                        </div>
                    <?php echo form_close();?>
		            </div>
		        </div>
	        </div>
        </div>
    </div>
</div>