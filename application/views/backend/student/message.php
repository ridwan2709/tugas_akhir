<div class="content-w">
	<?php include 'fancy.php'; ?>
	<div class="header-spacer"></div>
	<div class="conty" style="background-color:#fff;">
		<div class="full-chat-w">
			<div class="full-chat-i">
				<div class="full-chat-left support-tickets">
					<div class="tab-content">
						<div class="os-tabs-w bg-white">
							<ul class="navs navs-tabs upper centered">
								<li class="navs-item">
									<a class="navs-links <?php if ($page_name == 'message' && $message_inner_page_name != 'message_new') echo "active"; ?>" href="<?php echo base_url(); ?>student/message/" style="color:#000"><i class="os-icon picons-thin-icon-thin-0306_chat_message_discussion_bubble_conversation" style="color:#047bf8"></i><span><?php echo get_phrase('chats'); ?></span></a>
								</li>
								<li class="navs-item">
									<a class="navs-links <?php if ($message_inner_page_name == 'message_new') echo "active"; ?>" href="<?php echo base_url(); ?>student/message/message_new/" style="color:#000"><i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new" style="color:#047bf8"></i><span><?php echo get_phrase('write'); ?></span></a>
								</li>
								<li class="navs-item">
									<a class="navs-links" href="<?php echo base_url(); ?>student/group/" style="color:#000"><i class="os-icon picons-thin-icon-thin-0719_group_users_circle" style="color:#047bf8"></i><span><?php echo get_phrase('groups'); ?></span></a>
								</li>
							</ul>
						</div>
						<div class="tab-pane active<?= $message_inner_page_name != 'message_home' ? ' d-none d-md-block' : '' ?>" id="chats">
							<div class="user-list">
								<?php
								$current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
								$this->db->where('sender', $current_user);
								$this->db->or_where('reciever', $current_user);
								$message_threads = $this->db->get('message_thread')->result_array();
								foreach ($message_threads as $row) :
									if ($row['sender'] == $current_user) {
										$user_to_show = explode('-', $row['reciever']);
									}
									if ($row['reciever'] == $current_user) {
										$user_to_show = explode('-', $row['sender']);
									}
									$user_to_show_type = $user_to_show[0];
									$user_to_show_id = $user_to_show[1];
									$unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
								?>
									<?php $this->db->where('message_thread_code', $row['message_thread_code']);
									$rw = $this->db->get('message')->last_row(); ?>
									<?php $dbinfo = explode('-', $rw->sender); ?>
									<a href="<?php echo base_url(); ?>student/message/message_read/<?php echo $row['message_thread_code']; ?>">
										<div class="user-w box <?php if (isset($current_message_thread_code) && $current_message_thread_code == $row['message_thread_code']) echo 'active'; ?>">
											<div class="avatar with-status status-green">
												<img alt="" src="<?php echo $this->crud_model->get_image_url($user_to_show_type, $user_to_show_id); ?>" class="purple" style="border-radius: 50%;">
											</div>
											<div class="user-info">
												<?php if ($unread_message_number > 0) : ?>
													<div class="user-date"><?php echo $unread_message_number; ?></div>
												<?php else : ?>
													<div class="user-date">
														<?php echo $rw->timestamp; ?>
													</div>
												<?php endif; ?>
												<div class="user-name" title="<?php echo $this->crud_model->get_name($user_to_show_type, $user_to_show_id); ?>">
													<?php echo $this->crud_model->get_name($user_to_show_type, $user_to_show_id); ?>
												</div>
												<div class="last-message">
													<?php if ($current_user == $rw->sender) echo get_phrase('you') . ": " . substr($rw->message, 0, 40) . '...';
													else echo substr($rw->message, 0, 40) . '...'; ?>
												</div>
												<div class="last-message">
													<?php if ($user_to_show_type == 'admin') : ?>
														<a class="badge badge-success" href="<?php echo base_url(); ?>student/message/message_read/<?php echo $row['message_thread_code']; ?>" style="color:white"><?php echo get_phrase('admin'); ?></a>
													<?php endif; ?>
													<?php if ($user_to_show_type == 'student') : ?>
														<a class="badge badge-secondary" href="<?php echo base_url(); ?>student/message/message_read/<?php echo $row['message_thread_code']; ?>" style="color:white"><?php echo get_phrase('student'); ?></a>
													<?php endif; ?>
													<?php if ($user_to_show_type == 'teacher') : ?>
														<a class="badge badge-warning" href="<?php echo base_url(); ?>student/message/message_read/<?php echo $row['message_thread_code']; ?>" style="color:white"><?php echo get_phrase('teacher'); ?></a>
													<?php endif; ?>
													<?php if ($user_to_show_type == 'parent') : ?>
														<a class="badge badge-purple" href="<?php echo base_url(); ?>student/message/message_read/<?php echo $row['message_thread_code']; ?>" style="color:white"><?php echo get_phrase('parent'); ?></a>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</a>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
				<?php include $message_inner_page_name . '.php'; ?>
			</div>
		</div>
	</div>
</div>