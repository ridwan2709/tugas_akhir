<div class="content-w">
	<?php include 'fancy.php'; ?>
	<div class="header-spacer"></div>
	<div class="conty">
		<div class="all-wrapper no-padding-content solid-bg-all">
			<div class="layout-w">
				<div class="content-w">
					<div class="content-i">
						<div class="content-box">
							<div class="app-email-w">
								<div class="app-email-i">
									<div class="ae-content-w" style="background-color: #f2f4f8;">
										<div class="top-header top-header-favorit">
											<div class="top-header-thumb">
												<img src="<?php echo base_url(); ?>uploads/bglogin.jpg" alt="nature" style="height:180px; object-fit:cover;">
												<div class="top-header-author">
													<div class="author-thumb">
														<img src="<?php echo base_url(); ?>uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>" style="background-color: #fff;padding:10px;">
													</div>
													<div class="author-content">
														<a href="javascript:void(0);" class="h3 author-name"><?php echo get_phrase('teachers'); ?></a>
														<div class="country"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?></div>
													</div>
												</div>
											</div>
											<div class="profile-section" style="background-color: #fff;">
												<div class="control-block-button">
													<a href="#" class="btn btn-control bg-purple" style="background:#0084ff; color: #fff;" data-toggle="modal" data-target="#creardocente">
														<i class="icon-feather-plus" title="<?php echo get_phrase('new_account'); ?>"></i>
													</a>
												</div>
											</div>
										</div>
										<div class="aec-full-message-w">
											<div class="aec-full-message">
												<div class="container-fluid" style="background-color: #f2f4f8;"><br>
													<div class="col-sm-12">
														<div class="row">
															<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
																<div class="form-group label-floating" style="background-color: #fff;">
																	<label class="control-label"><?php echo get_phrase('search'); ?></label>
																	<input class="form-control" id="filter" type="text" required="">
																</div>
															</div>
														</div>
														<div class="row" id="results">
															<?php
															$this->db->order_by('teacher_id', 'desc');
															$teacher = $this->db->get('teacher')->result_array();
															foreach ($teacher as $row) :
															?>
																<div class="col-xl-4 col-md-6 results">
																	<div class="card-box widget-user ui-block list">
																		<div class="more" style="float:right;">
																			<i class="icon-options"></i>
																			<ul class="more-dropdown">
																				<li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_teacher/<?php echo $row['teacher_id']; ?>');"><?php echo get_phrase('edit'); ?></a></li>
																				<li><a class="delete" href="<?php echo base_url(); ?>admin/teachers/delete/<?php echo $row['teacher_id']; ?>"><?php echo get_phrase('delete'); ?></a></li>
																			</ul>
																		</div>
																		<div>
																			<img src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']); ?>" class="img-responsive rounded-circle purple" alt="user">
																			<div class="wid-u-info">
																				<a href="<?php echo base_url(); ?>admin/teacher_profile/<?php echo $row['teacher_id']; ?>/" class="h6 author-name">
																					<h5 class="mt-0 m-b-5"> <?php echo $this->crud_model->get_name('teacher', $row['teacher_id']); ?></h5>
																				</a>
																				<p class="text-muted m-b-5 font-13">
																					<b><i class="picons-thin-icon-thin-0291_phone_mobile_contact"></i></b> <?php echo $row['phone']; ?><br>
																					<b><i class="picons-thin-icon-thin-0321_email_mail_post_at"></i></b> <?php echo $row['email']; ?><br>
																					<b><i class="picons-thin-icon-thin-0714_identity_card_photo_user_profile"></i></b> <?php echo $row['idcard']; ?><br>
																				</p>
																			</div>
																		</div>
																	</div>
																</div>
															<?php endforeach; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="display-type"></div>
		</div>
	</div>
</div>




<div class="modal fade" id="creardocente" tabindex="-1" role="dialog" aria-labelledby="creardocente" aria-hidden="true">
	<div class="modal-dialog window-popup edit-my-poll-popup" role="document">
		<div class="modal-content">
			<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
			</a>
			<div class="modal-body">
				<div class="ui-block-title" style="background-color:#00579c">
					<h6 class="title" style="color:white"><?php echo get_phrase('new_account'); ?></h6>
				</div>
				<div class="ui-block-content">
					<?php echo form_open(base_url() . 'admin/teachers/create', array('enctype' => 'multipart/form-data')); ?>
					<div class="row">
						<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group">
								<label class="control-label"><?php echo get_phrase('photo'); ?></label>
								<input class="form-control" name="userfile" type="file" required="">
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating">
								<label class="control-label"><?php echo get_phrase('first_name'); ?></label>
								<input class="form-control" name="first_name" type="text" required="">
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating">
								<label class="control-label"><?php echo get_phrase('last_name'); ?></label>
								<input class="form-control" name="last_name" type="text" required="">
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating is-select">
								<label class="control-label"><?php echo get_phrase('gender'); ?></label>
								<div class="select">
									<select name="gender">
										<option value=""><?php echo get_phrase('select'); ?></option>
										<option value="M"><?php echo get_phrase('male'); ?></option>
										<option value="F"><?php echo get_phrase('female'); ?></option>
									</select>
								</div>
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating">
								<label class="control-label"><?php echo get_phrase('username'); ?></label>
								<input class="form-control" placeholder="" type="text" name="username" id="user_teacher">
								<small><span id="result_teacher"></span></small>
								<span class="input-group-addon">
									<i class="icon-feather-mail"></i>
								</span>
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating">
								<label class="control-label"><?php echo get_phrase('password'); ?></label>
								<input class="form-control" placeholder="" type="password" name="password">
								<span class="input-group-addon">
									<i class="icon-feather-mail"></i>
								</span>
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating">
								<label class="control-label"><?php echo get_phrase('email'); ?></label>
								<input class="form-control" placeholder="" type="email" name="email">
								<span class="input-group-addon">
									<i class="icon-feather-mail"></i>
								</span>
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating is-empty">
								<label class="control-label"><?php echo get_phrase('phone'); ?></label>
								<input class="form-control" name="phone" type="text">
								<span class="input-group-addon">
									<i class="icon-feather-phone"></i>
								</span>
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating is-empty">
								<label class="control-label"><?php echo get_phrase('identification'); ?></label>
								<input class="form-control" name="idcard" type="text">
								<span class="input-group-addon">
									<i class="picons-thin-icon-thin-0714_identity_card_photo_user_profile"></i>
								</span>
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating is-empty">
								<label class="control-label"><?php echo 'Tempat Lahir'; ?></label>
								<input class="form-control" name="tempatLahir" type="text">
								<span class="input-group-addon">
									<i class="picons-thin-icon-thin-0720_user_location_position"></i>
								</span>
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group date-time-picker label-floating">
								<label class="control-label"><?php echo get_phrase('birthday'); ?></label>
								<input type='text' class="datepicker-here" data-position="top left" data-language='en' name="datetimepicker" data-multiple-dates-separator="/" />
								<span class="input-group-addon">
									<i class="icon-feather-calendar"></i>
								</span>
							</div>
						</div>
						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating is-empty">
								<label class="control-label"><?php echo get_phrase('address'); ?></label>
								<input class="form-control" name="address" type="text">
								<span class="input-group-addon">
									<i class="icon-feather-map-pin"></i>
								</span>
							</div>
						</div>

						<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group label-floating is-empty">
								<label class="control-label"><?php echo 'Pendidikan Terakhir'; ?></label>
								<input class="form-control" name="pendidikanTerakhir" type="text">
								<span class="input-group-addon">
									<i class="picons-thin-icon-thin-0047_home_flat"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="form-buttons-w text-right">
						<center><button class="btn btn-rounded btn-success btn-lg" id="sub_teacher" type="submit"><?php echo get_phrase('save'); ?></button></center>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	window.onload = function() {
		$("#filter").keyup(function() {

			var filter = $(this).val(),
				count = 0;

			$('#results div').each(function() {

				if ($(this).text().search(new RegExp(filter, "i")) < 0) {
					$(this).hide();

				} else {
					$(this).show();
					count++;
				}
			});
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		var query;
		$("#user_teacher").keyup(function(e) {
			query = $("#user_teacher").val();
			$("#result_teacher").queue(function(n) {
				$.ajax({
					type: "POST",
					url: '<?php echo base_url(); ?>register/search_user',
					data: "c=" + query,
					dataType: "html",
					error: function() {
						alert("??Error!");
					},
					success: function(data) {
						if (data == "success") {
							texto = "<b style='color:#ff214f'><?php echo get_phrase('already_exist'); ?></b>";
							$("#result_teacher").html(texto);
							$('#sub_teacher').attr('disabled', 'disabled');
						} else {
							texto = "";
							$("#result_teacher").html(texto);
							$('#sub_teacher').removeAttr('disabled');
						}
						n();
					}
				});
			});
		});
	});
</script>