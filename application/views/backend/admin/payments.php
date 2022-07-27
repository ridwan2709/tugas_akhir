<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$kas = $this->db->query('SELECT `saldo` FROM `kas` ORDER BY `kas_id` DESC LIMIT 1')->row()->saldo;
?>
<div class="content-w">
  <?php include 'fancy.php'; ?>
  <div class="header-spacer"></div>
  <div class="conty">
    <?php include 'menuPayments.php'; ?>
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
                          <div class="col-sm-12">
                            <h2 style="float:left"><?php echo get_phrase('accounting'); ?></h2>
                          </div>
                          <hr>
                          <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="ui-block list" data-mh="friend-groups-item">
                              <div class="friend-item friend-groups">
                                <div class="friend-item-content">
                                  <div class="friend-avatar">
                                    <br><br>
                                    <i class="picons-thin-icon-thin-0383_graph_columns_growth_statistics" style="font-size:45px; color: #99bf2d;"></i>
                                    <h1 style="font-weight:bold;"><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
                                                                  $this->db->where('year', $running_year);
                                                                  $this->db->where('status', 'completed');
                                                                  $invoices  = $this->db->get('invoice')->result_array();
                                                                  $to = 0;
                                                                  foreach ($invoices as $r) {
                                                                    $to += $r['amount'];
                                                                  }
                                                                  //echo number_format($to); 

                                                                  $this->db->where('kategori', '1');
                                                                  $donasi  = $this->db->get('donasi')->result_array();
                                                                  $td = 0;
                                                                  foreach ($donasi as $rd) {
                                                                    $td += $rd['jumlah'];
                                                                  }
                                                                  echo number_format($td + $to);
                                                                  ?></h1>
                                    <div class="author-content">
                                      <div class="element-header"><b> <?php echo 'Jumlah Pemasukan'; ?></b></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="ui-block list" data-mh="friend-groups-item">
                              <div class="friend-item friend-groups">
                                <div class="friend-item-content">
                                  <div class="friend-avatar">
                                    <br><br>
                                    <i class="picons-thin-icon-thin-0384_graph_columns_drop_statistics" style="font-size:45px; color: #dd2979;"></i>
                                    <?php
                                    $this->db->where('payment_type', 'expense');
                                    $this->db->where('year', $running_year);
                                    $expenses = $this->db->get('payment')->result_array();
                                    $t = 0;
                                    foreach ($expenses as $rows) {
                                      $t += $rows['amount'];
                                    }
                                    $class_pengeluaran = "";
                                    if ($t > $to) {
                                      $class_pengeluaran = "text-danger animate__animated animate__bounceIn animate__infinite animate__slow";
                                    }
                                    ?>
                                    <h1 style="font-weight:bold;"><span class="<?= $class_pengeluaran ?>"><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
                                                                                                          echo number_format($t); ?></h1>
                                    <div class="author-content">
                                      <div class="element-header"><b> <?php echo 'Jumlah Pengeluaran'; ?></b></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="ui-block list" data-mh="friend-groups-item">
                              <div class="friend-item friend-groups">
                                <div class="friend-item-content">
                                  <div class="friend-avatar">
                                    <br><br>
                                    <i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash" style="font-size:45px; color: #f4af08 ;"></i>
                                    <h1 style="font-weight:bold;"><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
                                                                  $this->db->where('year', $running_year);
                                                                  $this->db->where('status', 'pending');
                                                                  $invoices  = $this->db->get('invoice')->result_array();
                                                                  $to = 0;
                                                                  foreach ($invoices as $r) {
                                                                    $to += $r['amount'];
                                                                  }
                                                                  echo number_format($to); ?></h1>
                                    <div class="author-content">
                                      <div class="element-header"><b> <?php echo 'Tagihan Tertunggak'; ?></b></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="ui-block list" data-mh="friend-groups-item">
                              <div class="friend-item friend-groups">
                                <div class="friend-item-content">
                                  <div class="friend-avatar">
                                    <br><br>
                                    <i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash" style="font-size:45px; color: #0084ff;"></i>
                                    <?php
                                    $class_saldo = "";
                                    if (strpos($kas['saldo'], "-") !== false) {
                                      $class_saldo = "text-danger animate__animated animate__bounceIn animate__infinite animate__slow";
                                    }
                                    ?>
                                    <h1 style="font-weight:bold;"><span class="<?= $class_saldo ?>">
                                        <?php
                                        echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description;
                                        echo number_format($kas);
                                        ?></span></h1>
                                    <div class="author-content">
                                      <div class="element-header"><b> <?php echo "Saldo Kas"; ?></b></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="element-wrapper">
                              <h6 class="element-header"><?php echo 'Tagihan Terbaru'; ?></h6>
                              <div class="element-box-tp">
                                <div class="table-responsive">
                                  <table class="table table-padded">
                                    <thead>
                                      <tr>
                                        <th><?php echo get_phrase('status'); ?></th>
                                        <th><?php echo get_phrase('student'); ?></th>
                                        <th><?php echo get_phrase('title'); ?></th>
                                        <th><?php echo get_phrase('amount'); ?></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $this->db->limit(10);
                                      $this->db->where('year', $running_year);
                                      $this->db->order_by('creation_timestamp', 'desc');
                                      $invoices = $this->db->get('invoice')->result_array();
                                      foreach ($invoices as $row) : ?>
                                        <tr>
                                          <td>
                                            <?php if ($row['status'] == 'pending') : ?>
                                              <span class="status-pill yellow"></span><span><?php echo get_phrase('pending'); ?></span>
                                            <?php endif; ?>
                                            <?php if ($row['status'] == 'completed') : ?>
                                              <span class="status-pill green"></span><span><?php echo get_phrase('paid'); ?></span>
                                            <?php endif; ?>
                                          </td>
                                          <td class="cell-with-media">
                                            <a style="color:grey" href="<?php echo base_url(); ?>admin/invoice_details/<?php echo $row['invoice_id']; ?>/"><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" style="height: 25px; border-radius: 50%;" class="purple"><span> <?php echo $this->crud_model->get_name('student', $row['student_id']); ?></span></a>
                                          </td>
                                          <td><?php echo $row['title']; ?></td>
                                          <td><a class="badge badge-primary" href="javascript:void(0);"><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description; ?><?php echo number_format($row['amount']); ?></a></td>
                                        </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>


                          <div class="col-sm-6">
                            <div class="element-wrapper">
                              <h6 class="element-header"><?php echo 'Pengeluaran Terbaru'; ?></h6>
                              <div class="element-box-tp">
                                <div class="table-responsive">
                                  <table class="table table-padded">
                                    <thead>
                                      <tr>
                                        <th><?php echo get_phrase('title'); ?></th>
                                        <th><?php echo get_phrase('category'); ?></th>
                                        <th><?php echo get_phrase('amount'); ?></th>
                                        <th><?php echo get_phrase('method'); ?></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $this->db->limit(10);
                                      $this->db->where('payment_type', 'expense');
                                      $this->db->where('year', $running_year);
                                      $this->db->order_by('timestamp', 'desc');
                                      $expenses = $this->db->get('payment')->result_array();
                                      foreach ($expenses as $row) :
                                      ?>
                                        <tr>
                                          <td><?php echo $row['title']; ?></td>
                                          <td><a class="btn btn-sm btn-rounded btn-purple text-white"><?php
                                                                                                      if ($row['expense_category_id'] != 0 || $row['expense_category_id'] != '')
                                                                                                        echo $this->db->get_where('expense_category', array('expense_category_id' => $row['expense_category_id']))->row()->name;
                                                                                                      ?></a></td>
                                          <td><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description; ?><?php echo number_format($row['amount']); ?></td>
                                          <td><a class="btn nc btn-rounded btn-sm btn-primary" style="color:white"><?php
                                                                                                                    if ($row['method'] == 1) echo get_phrase('cash');
                                                                                                                    if ($row['method'] == 2) echo get_phrase('check');
                                                                                                                    if ($row['method'] == 3) echo get_phrase('card');
                                                                                                                    ?></a></a></td>
                                        </tr>
                                      <?php endforeach; ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <br>
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