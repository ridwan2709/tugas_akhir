<div class="content-w">
	<?php include 'fancy.php'; ?>
	<div class="header-spacer"></div>
	<div class="conty">
		<div class="os-tabs-w menu-shad">
			<div class="os-tabs-controls">
				<ul class="navs navs-tabs upper">
					<li class="navs-item">
						<a class="navs-links active" data-toggle="tab" href="#permissions"><i class="os-icon picons-thin-icon-thin-0015_fountain_pen"></i><span><?php echo get_phrase('permissions'); ?></span></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="content-i">
			<div class="content-box">
				<div style="margin-top:10px; text-align:right;"><a href="#apply" data-toggle="tab" class="btn btn-control btn-grey-lighter btn-purple"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
						<div class="ripple-container"></div>
					</a></div>
				<div class="element-wrapper">
					<div class="tab-content">
						<div class="tab-pane active" id="permissions">
							<div class="table-responsive">
								<table class="table table-padded">
									<thead>
										<tr>
											<th><?php echo get_phrase('reason'); ?></th>
											<th><?php echo get_phrase('description'); ?></th>
											<th><?php echo get_phrase('student'); ?></th>
											<th><?php echo get_phrase('from'); ?></th>
											<th><?php echo get_phrase('until'); ?></th>
											<th><?php echo get_phrase('status'); ?></th>
											<th><?php echo get_phrase('file'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$count = 1;
										$this->db->order_by('request_id', 'desc');
										$requests = $this->db->get_where('students_request', array('student_id' => $this->session->userdata('login_user_id')))->result_array();
										foreach ($requests as $row) {
										?>
											<tr>
												<td><a class="btn nc btn-rounded btn-sm btn-purple" style="color:white"><?php echo $row['title']; ?></a></td>
												<td><?php echo $row['description']; ?></td>
												<td><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" width="25px" class="purple" style="border-radius: 50%; margin-right:5px;"> <?php echo $this->crud_model->get_name('student', $row['student_id']); ?></td>
												<td><a class="btn nc btn-rounded btn-sm btn-primary" style="color:white"><?php echo $row['start_date']; ?></a></td>
												<td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php echo $row['end_date']; ?></a></td>
												<td>
													<?php if ($row['status'] == 0) : ?>
														<a class="btn nc btn-rounded btn-sm btn-warning" style="color:white"><?php echo get_phrase('pending'); ?></a>
													<?php endif; ?>
													<?php if ($row['status'] == 1) : ?>
														<a class="btn nc btn-rounded btn-sm btn-success" style="color:white"><?php echo get_phrase('approved'); ?></a>
													<?php endif; ?>
													<?php if ($row['status'] == 2) : ?>
														<a class="btn nc btn-rounded btn-sm btn-danger" style="color:white"><?php echo get_phrase('rejected'); ?></a>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($row['file'] == "") : ?>
														<p><?php echo get_phrase('no_file'); ?></p>
													<?php endif; ?>
													<?php if ($row['file'] != "") : ?>
														<a href="<?php echo base_url(); ?>uploads/request/<?php echo $row['file']; ?>" class="btn btn-rounded btn-sm btn-primary" style="color:white"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <?php echo get_phrase('download'); ?></a>
													<?php endif; ?>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="apply">
							<div class="element-wrapper">
								<div class="element-box lined-primary shadow">
									<?php echo form_open(base_url() . 'student/request/create', array('enctype' => 'multipart/form-data')); ?>

									<h5 class="form-header"><?php echo get_phrase('apply'); ?></h5><br>
									<div class="form-group">
										<label for=""> <?php echo get_phrase('reason'); ?></label>
										<input class="form-control" placeholder="" type="text" name="title" required="">
									</div>
									<div class="form-group">
										<label> <?php echo get_phrase('description'); ?></label>
										<textarea class="form-control" rows="4" name="description" required=""></textarea>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for=""> <?php echo get_phrase('from'); ?></label>
												<input type='text' class="datepicker-here" data-position="top left" data-language='en' name="start_date" data-multiple-dates-separator="/" />
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for=""> <?php echo get_phrase('until'); ?></label>
												<input type='text' class="datepicker-here" data-position="top left" data-language='en' name="end_date" data-multiple-dates-separator="/" />
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for=""> <?php echo get_phrase('send_file'); ?></label>
										<input type="file" name="file_name" id="file-3" class="form-control">
									</div>
									<div class="form-buttons-w text-right">
										<button class="btn btn-rounded btn-primary" type="submit"> <?php echo get_phrase('send'); ?></button>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div>
		</div>