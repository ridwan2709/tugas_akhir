<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <div class="content-i">
      <div class="content-box">
        <div class="os-tabs-w">
          <div class="os-tabs-controls">
            <ul class="navs navs-tabs upper">
              <?php
              $n = 1;
              $children_of_parent = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
              foreach ($children_of_parent as $row) :
              ?>
                <li class="navs-item">
                  <?php $active = $n++; ?>
                  <a class="navs-links <?php if ($active == 1) echo 'active'; ?>" data-toggle="tab" href="#<?php echo $row['username']; ?>" data-student="<?= $row['student_id'] ?>" onclick="javascript:get_tagihan_belum_dibayar('<?= $row['student_id'] ?>');" style="text-decoration: none;">
                    <img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" width="25px" class="purple" style="border-radius: 50%;margin-right:5px;" />
                    <?php echo $this->crud_model->get_name('student', $row['student_id']); ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="layout-w">
        <div class="content-w">
          <div class="content-i">
            <div class="content-box">
              <div class="app-em ail-w">
                <div class="ae-conte nt-w">
                  <div class="aec-full-m essage-w">
                    <div class="aec-full -message" style="background-color:#f2f4f8;">
                      <div class="container- fluid">
                        <div class="row">
                          <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="ui-block list" data-mh="friend-groups-item" style="">
                              <div class="friend-item friend-groups">
                                <div class="friend-item-content">
                                  <div class="friend-avatar">
                                    <br><br>
                                    <i class="picons-thin-icon-thin-0425_money_payment_dollar_cash" style="font-size:45px; color: red;"></i>
                                    <div id="load_tagihan_yang_belum_dibayar" class="mt-3 mb-3"></div>
                                    <h1 style="font-weight:bold;" class="d-none">
                                      <?php
                                      echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
                                      ?>
                                      <span id="tagihan_yang_belum_dibayar"></span>
                                    </h1>
                                    <div class="author-content">
                                      <div class="element-header"><b> <?php echo 'Tagihan Yang Belum Terbayar'; ?></b></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="ui-block list" data-mh="friend-groups-item" style="">
                              <div class="friend-item friend-groups">
                                <div class="friend-item-content">
                                  <div class="friend-avatar">
                                    <br><br>
                                    <i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash" style="font-size:45px; color: #f4af08;"></i>
                                    <div id="load_faktur_yang_belum_dibayar" class="mt-3 mb-3"></div>
                                    <h1 style="font-weight:bold;" class="d-none">
                                      <span id="faktur_yang_belum_dibayar"></span>
                                    </h1>
                                    <div class="author-content">
                                      <div class="element-header"><b> <?php echo 'Faktur Yang Tertunda'; ?></b></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="ui-block list" data-mh="friend-groups-item" style="">
                              <div class="friend-item friend-groups">
                                <div class="friend-item-content">
                                  <div class="friend-avatar">
                                    <br><br>
                                    <i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash" style="font-size:45px; color: green ;"></i>
                                    <div id="load_faktur_yang_sudah_dibayar" class="mt-3 mb-3"></div>
                                    <h1 style="font-weight:bold;" class="d-none">
                                      <span id="faktur_yang_sudah_dibayar"></span>
                                    </h1>
                                    <div class="author-content">
                                      <div class="element-header"><b> <?php echo 'Faktur Yang Terbayar'; ?></b></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="ui-block list" data-mh="friend-groups-item" style="">
                              <div class="friend-item friend-groups">
                                <div class="friend-item-content">
                                  <div class="friend-avatar">
                                    <br><br>
                                    <i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash" style="font-size:45px; color: #0084ff;"></i>
                                    <div id="load_faktur_yang_sudah_dan_belum_dibayar" class="mt-3 mb-3"></div>
                                    <h1 style="font-weight:bold;" class="d-none">
                                      <span id="faktur_yang_sudah_dan_belum_dibayar"></span>
                                    </h1>
                                    <div class="author-content">
                                      <div class="element-header"><b> <?php echo 'Jumlah Faktur'; ?></b></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="tab-content">
                          <?php
                          $n = 1;
                          $children_of_parent = $this->db->get_where('student', array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                          foreach ($children_of_parent as $row3) :
                            $class_id = $this->db->get_where('enroll', array('student_id' => $row3['student_id'], 'year' => $running_year))->row()->class_id;
                            $section_id = $this->db->get_where('enroll', array('student_id' => $row3['student_id'], 'year' => $running_year))->row()->section_id;
                          ?>
                            <?php $active = $n++; ?>
                            <div class="tab-pane <?php if ($active == 1) echo 'active'; ?>" id="<?php echo $row3['username']; ?>">
                              <div class="element-wrapper">
                                <h6 class="element-header"><?php echo get_phrase('invoices'); ?></h6>
                                <div class="element-box-tp">
                                  <div class="table-responsive">
                                    <table class="table table-padded">
                                      <thead>
                                        <tr style="text-align: center;">
                                          <th><?php echo get_phrase('student'); ?></th>
                                          <th><?php echo get_phrase('title'); ?></th>
                                          <th class="text-center"><?php echo get_phrase('amount'); ?></th>
                                          <th class="text-center"><?php echo get_phrase('status'); ?></th>
                                          <th><?php echo get_phrase('date'); ?></th>
                                          <th><?php echo get_phrase('invoice'); ?></th>
                                          <th><?php echo get_phrase('make_payment'); ?></th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $invoices = $this->db->get_where('invoice', array(
                                          'student_id' => $row3['student_id']
                                        ))->result_array();
                                        foreach ($invoices as $row2) :
                                        ?>
                                          <tr>
                                            <td><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row2['student_id']); ?>" width="25px" class="purple" style="border-radius: 50%;margin-right:5px;"> <?php echo $this->crud_model->get_name('student', $row2['student_id']); ?></td>
                                            <td><?php echo $row2['title']; ?></td>
                                            <td class="text-right"><strong>
                                                <?php
                                                echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
                                                echo ". ";
                                                echo number_format($row2['amount']); ?></strong></td>
                                            <td class="text-center">
                                              <?php if ($row2['status'] == 'completed') : ?>
                                                <div class="status-pill green" data-title="Pagado" data-toggle="tooltip"></div>
                                              <?php endif;
                                              if ($row2['status'] == 'pending') : ?>
                                                <div class="status-pill red" data-title="Sin pagar" data-toggle="tooltip"></div>
                                              <?php endif; ?>
                                            </td>
                                            <td><a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white">
                                                <?php echo $row2['creation_timestamp']; ?></a></td>
                                            <td style="text-align: center"><a class="btn btn-rounded btn-primary" style="color:white" href="<?php echo base_url(); ?>parents/view_invoice/<?php echo $row2['invoice_id']; ?>"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i>
                                                <?php echo get_phrase('invoice'); ?></a></td>
                                            <td style="text-align: center">
                                              <?php echo form_open(base_url() . 'parents/invoice/' . $row2['student_id'] . '/make_payment', array('enctype' => 'multipart/form-data')); ?>
                                              <input type="hidden" name="invoice_id" value="<?php echo $row2['invoice_id']; ?>" />
                                              <button type="submit" class="btn btn-rounded btn-success" <?php if ($row2['status'] == 'completed') : ?> disabled="disabled" <?php endif; ?>>
                                                <i class="picons-thin-icon-thin-0424_money_payment_dollar_cash"></i> <?php echo get_phrase('pay_with_paypal'); ?>
                                              </button>
                                              <?php echo form_close(); ?>
                                            </td>
                                          </tr>
                                        <?php endforeach; ?>
                                      </tbody>
                                    </table>
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

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

                <script>
                  function get_tagihan_belum_dibayar(student_id) {
                    $.ajax({
                      url: "<?= site_url('parents/ajax_total_tagihan_belum_dibayar') ?>",
                      type: "POST",
                      data: {
                        student_id: student_id,
                      },
                      dataType: "JSON",
                      beforeSend: function(xhr) {
                        console.log('mengambil...');
                        // loading
                        $('#load_tagihan_yang_belum_dibayar, #load_faktur_yang_belum_dibayar, #load_faktur_yang_sudah_dibayar, #load_faktur_yang_sudah_dan_belum_dibayar').html("<div class=\"spinner-border\" role=\"status\"><span class=\"visually-hidden\">Loading...</span></div>").removeClass("d-none").next().addClass("d-none");
                      },
                      success: function(response) {
                        if (response.status) {
                          $('#load_tagihan_yang_belum_dibayar, #load_faktur_yang_belum_dibayar, #load_faktur_yang_sudah_dibayar, #load_faktur_yang_sudah_dan_belum_dibayar').addClass("d-none").next().removeClass("d-none");
                          $('#tagihan_yang_belum_dibayar').html(response.total);
                          $('#faktur_yang_belum_dibayar').html(response.banyaknya_data_belum_dibayar);
                          $('#faktur_yang_sudah_dibayar').html(response.banyaknya_data_sudah_dibayar);
                          $('#faktur_yang_sudah_dan_belum_dibayar').html(response.banyaknya_data_sudah_dan_belum_dibayar);
                        }
                      },
                    });
                  }

                  // get_tagihan_belum_dibayar('5');
                  $('.navs-item > .navs-links.active').each(function(object) {
                    var student_id = $(this).data('student');
                    // console.log(student_id);
                    get_tagihan_belum_dibayar(student_id);
                  });
                </script>