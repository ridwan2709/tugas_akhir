<?php $details = $this->db->get_where('reports', array('code' => $code))->result_array();
foreach ($details as $row) :
?>
	<div class="content-w">
		<?php include 'fancy.php'; ?>
		<div class="header-spacer"></div>
		<div class="conty">
			<div class="content-box">
				<div class="back" style="margin-top:-20px;margin-bottom:10px">
					<a title="<?php echo get_phrase('return'); ?>" href="javascript:window.history.go(-1);"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></href=>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="pipeline white lined-primary">
							<div class="pipeline-header">
								<h5 class="pipeline-name"><?php echo $row['title']; ?></h5>
								<div class="pipeline-header-numbers">
									<div class="pipeline-count">
										<i class="os-icon picons-thin-icon-thin-0024_calendar_month_day_planner_events"></i> <?php echo $row['date']; ?> <br>
									</div>
									<div class="col-3 text-right">
										<?php if ($row['priority'] == 'alta') : ?>
											<a class="btn nc btn-rounded btn-sm btn-danger text-left" style="color:white"><?php echo get_phrase('high'); ?></a></td>
										<?php endif; ?>
										<?php if ($row['priority'] == 'media') : ?>
											<a class="btn nc btn-rounded btn-sm btn-warning text-left" style="color:white"><?php echo get_phrase('medium'); ?></a></td>
										<?php endif; ?>
										<?php if ($row['priority'] == 'baja') : ?>
											<a class="btn nc btn-rounded btn-sm btn-info text-left" style="color:white"><?php echo get_phrase('low'); ?></a></td>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<p><?php echo $row['description']; ?></p>
							<?php if ($row['file'] != "") : ?>
								<div class="b-t padded-v-big">
									<?php echo get_phrase('file'); ?>: <a class="btn btn-rounded btn-sm btn-primary" href="<?php echo base_url(); ?>uploads/report_files/<?php echo $row['file']; ?>" style="color:white"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <?php echo get_phrase('download'); ?></a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php endforeach; ?>
<script>
	var post_message = '<?php echo get_phrase('comment_success'); ?>';
	$(document).ready(function() {
		$("#add").click(function() {
			message = $("#message").val();
			report_code = $("#report_code").val();
			if (message != "" && report_code != "") {
				$.ajax({
					url: "<?php echo base_url(); ?>teacher/create_report/response/",
					type: 'POST',
					data: {
						message: message,
						report_code: report_code
					},
					success: function(result) {
						$('#panel').load(document.URL + ' #panel');
						$("#message").val('');
						const Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 8000
						});
						Toast.fire({
							type: 'success',
							title: post_message
						})
					}
				});
			}
		});
	});
</script>