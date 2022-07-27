
			    <div class="os-tabs-controls">
			        <ul class="navs navs-tabs upper">
				        <li class="navs-item">
							<a class="navs-links <?= $this->uri->segment(2) == 'section'? 'active' : '' ?>" href="<?php echo base_url();?>admin/section/"><i class="os-icon picons-thin-icon-thin-0002_write_pencil_new_edit"></i><span><?php echo get_phrase('sections'); ?></span></a>
				        </li>
				        <li class="navs-item">
							<a class="navs-links <?= $this->uri->segment(2) == 'grados'? 'active' : '' ?>" href="<?php echo base_url();?>admin/grados/"><i class="os-icon picons-thin-icon-thin-0006_book_writing_reading_read_manual"></i><span><?php echo get_phrase('class'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links <?= $this->uri->segment(2) == 'grade'? 'active' : '' ?>" href="<?php echo base_url();?>admin/grade/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo get_phrase('grades'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links <?= $this->uri->segment(2) == 'semesters'? 'active' : '' ?>" href="<?php echo base_url();?>admin/semesters/"><i class="os-icon picons-thin-icon-thin-0007_book_reading_read_bookmark"></i><span><?php echo get_phrase('semesters'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links <?= $this->uri->segment(2) == 'student_promotion'? 'active' : '' ?>" href="<?php echo base_url();?>admin/student_promotion/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo get_phrase('student_promotion'); ?></span></a>
				        </li>
			        </ul>
			    </div>