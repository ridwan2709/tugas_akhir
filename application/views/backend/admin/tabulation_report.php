 <?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>
 <style type="text/css">
 	.titulosincss {
 		text-align: center;
 		font-weight: bold;
 	}

 	.imagen {
 		position: absolute;
 		right: 5px;
 		top: 10px;
 	}

 	.mediano {
 		font-size: 11px;
 	}

 	.grande {
 		font-size: 13px;
 	}

 	.tablatitulo {
 		padding: 10px 0;
 	}

 	td.descripcion {
 		font-weight: bold;
 	}

 	td.nota {
 		text-align: center;
 	}

 	td.notapromedio {
 		text-align: center;
 		font-weight: bold;
 		padding: 3px;
 	}

 	td.notapromediofinal {
 		text-align: center;
 		font-weight: bold;
 		font-size: 14px;
 		padding: 5px;
 	}

 	.firmadirector {
 		padding: 40px 0 20px 0;
 		font-weight: bold;
 		float: right;
 		width: 300px;
 	}

 	.firma {
 		border-bottom: 1px solid #000;
 	}

 	.firmadirector .texto {
 		text-align: center;
 	}

 	table {
 		width: 100%;
 	}

 	.negrita {
 		font-weight: bold;
 	}

 	.cuadro {
 		width: 100%;
 	}
 </style>
 <div class="content-w">
 	<?php include 'fancy.php'; ?>
 	<div class="header-spacer"></div>
 	<div class="conty">
 		<div class="os-tabs-w menu-shad">
 			<div class="os-tabs-controls">
 				<ul class="navs navs-tabs">
 					<li class="navs-item">
 						<a class="navs-links" href="<?php echo base_url(); ?>admin/general_reports/"><i class="picons-thin-icon-thin-0658_cup_place_winner_award_prize_achievement"></i> <span><?php echo get_phrase('classes'); ?></span></a>
 					</li>
 					<li class="navs-item">
 						<a class="navs-links" href="<?php echo base_url(); ?>admin/students_report/"><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i> <span><?php echo get_phrase('students'); ?></span></a>
 					</li>
 					<li class="navs-item">
 						<a class="navs-links" href="<?php echo base_url(); ?>admin/attendance_report/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i> <span><?php echo get_phrase('attendance'); ?></span></a>
 					</li>
 					<li class="navs-item">
 						<a class="navs-links" href="<?php echo base_url(); ?>admin/marks_report/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i> <span><?php echo get_phrase('final_marks'); ?></span></a>
 					</li>
 					<li class="navs-item">
 						<a class="navs-links <?php if ($page_name == 'tabulation_report') echo "active"; ?>" href="<?php echo base_url(); ?>admin/tabulation_report/"><i class="picons-thin-icon-thin-0070_paper_role"></i> <span><?php echo get_phrase('tabulation_sheet'); ?></span></a>
 					</li>
 					<li class="navs-item">
 						<a class="navs-links" href="<?php echo base_url(); ?>admin/accounting_report/"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i> <span><?php echo get_phrase('accounting'); ?></span></a>
 					</li>
 					<li class="navs-item">
 						<a class="navs-links" href="<?php echo base_url(); ?>admin/testimonials/"><i class="picons-thin-icon-thin-0280_chat_message_comment_bubble_reply_quote"></i> <span>Testimoni</span></a>
 					</li>
 					<li class="navs-item">
 						<a class="navs-links" href="<?php echo base_url(); ?>admin/management/"><i class="picons-thin-icon-thin-0710_business_tie_user_profile_avatar_man_male"></i> <span>Management</span></a>
 					</li>
 				</ul>
 			</div>
 		</div>
 		<div class="content-i">
 			<div class="content-box">
 				<h5 class="form-header"><?php echo get_phrase('tabulation_sheet'); ?></h5>
 				<hr>
 				<?php echo form_open(base_url() . 'admin/tabulation_report/', array('class' => 'form m-b')); ?>
 				<div class="row">
 					<div class="col-sm-3">
 						<div class="form-group label-floating is-select">
 							<label class="control-label"><?php echo get_phrase('class'); ?></label>
 							<div class="select">
 								<select name="class_id" required="" onchange="get_class_sections(this.value); get_class_subjects(this.value)">
 									<option value=""><?php echo get_phrase('select'); ?></option>
 									<?php
										$class = $this->db->get('class')->result_array();
										foreach ($class as $row) : ?>
 										<option value="<?php echo $row['class_id']; ?>" <?php if ($class_id == $row['class_id']) echo "selected"; ?>><?php echo $row['name']; ?></option>
 									<?php endforeach; ?>
 								</select>
 							</div>
 						</div>
 					</div>
 					<div class="col-sm-3">
 						<div class="form-group label-floating is-select">
 							<label class="control-label"><?php echo get_phrase('section'); ?></label>
 							<div class="select">
 								<?php if ($section_id == "") : ?>
 									<select name="section_id" required id="section_holder" onchange="get_student(this.value)">
 										<option value=""><?php echo get_phrase('select'); ?></option>
 									</select>
 								<?php else : ?>
 									<select name="section_id" required id="section_holder" onchange="get_student(this.value)">
 										<option value=""><?php echo get_phrase('select'); ?></option>
 										<?php
											$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
											foreach ($sections as $key) :
											?>
 											<option value="<?php echo $key['section_id']; ?>" <?php if ($section_id == $key['section_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
 										<?php endforeach; ?>
 									</select>
 								<?php endif; ?>
 							</div>
 						</div>
 					</div>
 					<div class="col-sm-4">
 						<div class="form-group label-floating is-select">
 							<label class="control-label"><?php echo get_phrase('subject'); ?></label>
 							<div class="select">
 								<?php if ($subject_id == "") : ?>
 									<select name="subject_id" required id="subject_holder">
 										<option value=""><?php echo get_phrase('select'); ?></option>
 									</select>
 								<?php else : ?>
 									<select name="subject_id" required id="subject_holder">
 										<option value=""><?php echo get_phrase('select'); ?></option>
 										<?php
											$subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
											foreach ($subjects as $key) :
											?>
 											<option value="<?php echo $key['subject_id']; ?>" <?php if ($subject_id == $key['subject_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
 										<?php endforeach; ?>
 									</select>
 								<?php endif; ?>
 							</div>
 						</div>
 					</div>
 					<div class="col-sm-2">
 						<div class="form-group">
 							<button class="btn btn-success btn-upper" style="margin-top:20px" type="submit"><span><?php echo get_phrase('get_report'); ?></span></button>
 						</div>
 					</div>
 				</div>
 				<?php echo form_close(); ?>
 				<hr>
 				<?php if ($class_id != "" && $section_id != "" && $subject_id != "") : ?>
 					<div class="row"><br><br>
 						<a href="<?php echo base_url(); ?>admin/tab_sheet_print/<?php echo $class_id; ?>/<?php echo $section_id; ?>/<?php echo $subject_id; ?>" target="_blank"><button class="btn btn-purple btn-sm btn-rounded"><i class="picons-thin-icon-thin-0333_printer" style="font-weight: 300; font-size: 25px;"></i></button></a>
 						<div class="cuadro" id="print_area">

 							<center><img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>" alt="" width="5%" /></center>
 							<div class="titulosincss">
 								<div class="grande"><?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?></div>
 								<div class="mediano"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?></div>
 								<div class="grande"><?php echo get_phrase('tabulation_sheet'); ?></div>
 								<div class="mediano"><?php echo $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name; ?></div>
 								<div class="mediano"><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?> | <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?></div>
 							</div>
 							<table cellpading="0" cellspacing="0" border="1" style="margin: 20px 0;" class="bg-white">
 								<tr style="background-color: #a01a7a; color: #fff;text-align: center;">
 									<th class="text-center">#</th>
 									<th class="text-center"><?php echo get_phrase('gender'); ?></th>
 									<th class="text-center"><?php echo get_phrase('student'); ?></th>
 									<?php
										$exam = $this->db->get('exam')->result_array();
										foreach ($exam as $row) :
										?>
 										<th class="text-center"><?php echo $row['name']; ?></th>
 									<?php endforeach; ?>
 									<th class="text-center"><?php echo get_phrase('average'); ?></th>
 								</tr>
 								<?php
									$n = 1;
									$m = 0;
									$f = 0;
									$students = $this->db->get_where('enroll', array('class_id' => $class_id, 'section_id' => $section_id, 'year' => $running_year))->result_array();
									foreach ($students as $row) :
										if ($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->sex == 'M') {
											$m += 1;
										} else {
											$f += 1;
										}
									?>
 									<tr class="text-center" id="student-<?php echo $row['student_id']; ?>">
 										<td class="text-center"><?php echo $n++; ?></td>
 										<td class="text-center"><?php if ($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->sex == 'M') echo "M";
																	else echo "F"; ?></td>
 										<td class="text-center"><?php echo $this->crud_model->get_name('student', $row['student_id']); ?></td>
 										<?php
											$average = 0;
											$exams = $this->crud_model->get_exams();
											foreach ($exams as $key) :
												$average += $this->db->get_where('mark', array('student_id' => $row['student_id'], 'year' => $running_year, 'exam_id' => $key['exam_id'], 'subject_id' => $subject_id))->row()->labtotal;
											?>
 											<td class="text-center"><?php echo $this->db->get_where('mark', array('student_id' => $row['student_id'], 'year' => $running_year, 'exam_id' => $key['exam_id'], 'subject_id' => $subject_id))->row()->labtotal; ?></td>
 										<?php endforeach; ?>
 										<td class="text-center"><?php echo $average / count($exams); ?></td>
 									</tr>
 								<?php endforeach; ?>
 							</table>
 							<table cellpading="0" cellspacing="0" border="0" style="margin: 20px 0; width: 40%;">
 								<tr>
 									<td><?php echo get_phrase('mens'); ?></td>
 									<td><?php echo $m; ?></td>
 									<td><?php echo get_phrase('women'); ?></td>
 									<td><?php echo $f; ?></td>
 								</tr>
 							</table>
 							<table cellpading="0" cellspacing="0" border="0">
 								<tr>
 									<td><?php echo get_phrase('teacher'); ?></td>
 									<td><?php echo $this->crud_model->get_name('teacher', $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->teacher_id); ?></td>
 								</tr>
 								<tr>
 									<td>&nbsp;</td>
 									<td></td>
 								</tr>
 								<tr>
 									<td><?php echo get_phrase('signature'); ?></td>
 									<td>_________________________________________</td>
 								</tr>
 							</table>
 						</div>
 					</div>
 				<?php endif; ?>
 			</div>
 		</div>
 	</div>
 </div>


 <script type="text/javascript">
 	function get_class_sections(class_id) {
 		$.ajax({
 			url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
 			success: function(response) {
 				jQuery('#section_holder').html(response);
 			}
 		});
 	}

 	function get_class_subjects(class_id) {
 		$.ajax({
 			url: '<?php echo base_url(); ?>admin/get_class_subject/' + class_id,
 			success: function(response) {
 				jQuery('#subject_holder').html(response);
 			}
 		});
 	}
 </script>
 <script>
 	function printDiv(nombreDiv) {
 		var contenido = document.getElementById(nombreDiv).innerHTML;
 		var contenidoOriginal = document.body.innerHTML;
 		document.body.innerHTML = contenido;
 		window.print();
 		document.body.innerHTML = contenidoOriginal;
 	}
 </script>