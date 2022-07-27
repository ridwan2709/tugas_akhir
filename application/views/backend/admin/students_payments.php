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
          <div class="tab-content">
            <div class="tab-pane active" id="invoices">
              <div class="col col-lg-6 col-md-6 col-sm-12 col-12" style="max-width: 100%">
                <div style="margin: auto 0; float: right;">
                  <a class="btn btn-rounded btn-success text-white" href="<?php echo base_url(); ?>admin/new_payment/"><?php echo '+Tagihan baru'; ?></a>
                </div>
                <br><br><br>
                <div class="form-group label-floating" style="background-color: #fff;">
                  <label class="control-label"><?php echo get_phrase('search'); ?></label>
                  <input class="form-control" id="filter" type="text" required="">
                </div>

              </div>
              <div class="element-wrapper">
                <div class="element-box-tp">
                  <div class="row" id="results">
                    <div class="table-responsive">
                      <table class="table table-padded">
                        <thead>
                          <tr>
                            <th><?php echo get_phrase('status'); ?></th>
                            <th><?php echo get_phrase('student'); ?></th>
                            <th><?php echo get_phrase('class'); ?></th>
                            <th><?php echo get_phrase('title'); ?></th>
                            <th><?php echo get_phrase('amount'); ?></th>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th><?php echo get_phrase('options'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $count = 1;
                          $this->db->where('year', $running_year);
                          $this->db->order_by('invoice_id', 'desc');
                          $invoices = $this->db->get('invoice')->result_array();
                          foreach ($invoices as $row) :
                          ?>
                            <tr>
                              <td>
                                <?php if ($row['status'] == 'pending') : ?>
                                  <span class="status-pill yellow"></span><span><?php echo get_phrase('pending'); ?></span>
                                <?php endif;
                                if ($row['status'] == 'completed') :
                                ?>
                                  <span class="status-pill green"></span><span><?php echo get_phrase('paid'); ?></span>
                                <?php endif; ?>
                              </td>
                              <td class="cell-with-media">
                                <img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" style="height: 25px; border-radius:50%;" class="purple"><span> <?php echo $this->crud_model->get_name('student', $row['student_id']); ?></span>
                              </td>
                              <td><?php echo $this->crud_model->get_type_name_by_id('class', $row['class_id']); ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><a class="badge badge-primary" href="javascript:void(0);"><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description; ?><?php echo number_format($row['amount'], 0, '.', ','); ?></a></td>
                              <td><span><?php echo $row['creation_timestamp']; ?></span></td>
                              <td class="bolder">
                                <a href="<?php echo base_url(); ?>admin/invoice_details/<?php echo $row['invoice_id']; ?>/" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0424_money_payment_dollar_cash" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('view_invoice'); ?>"></i></a>
                                <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_invoice/<?php echo $row['invoice_id']; ?>');" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0001_compose_write_pencil_new" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit'); ?>"></i></a>
                                <a class="delete" href="<?php echo base_url(); ?>admin/invoice/delete/<?php echo $row['invoice_id']; ?>" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0057_bin_trash_recycle_delete_garbage_full" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete'); ?>"></i></a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
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
<script type="text/javascript">
  window.onload = function() {
    $("#filter").keyup(function() {

      var filter = $(this).val(),
        count = 0;

      $('#results tr').each(function() {

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
  function get_class_sections(class_id) {
    $.ajax({
      url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
      success: function(response) {
        jQuery('#section_selector_holder').html(response);
      }
    });
  }
</script>



<script type="text/javascript">
  function get_class_sections2(class_id) {
    $.ajax({
      url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
      success: function(response) {
        jQuery('#section_selector_holder2').html(response);
      }
    });
  }
</script>