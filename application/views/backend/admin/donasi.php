<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$count = $this->uri->segment(3) + 1;
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
                        <div class="tab-pane active" id="expenses">
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12" style="max-width: 100%">
                                <div style="margin: auto 0; float: right;">
                                    <button class="btn btn-success btn-rounded btn-upper" data-target="#kas_baru" data-toggle="modal" type="button" style="margin: auto 0;float:right;">+ <?php echo 'Donasi'; ?></button>
                                </div>
                                <br><br><br>
                                <?php
                                echo form_open(base_url('admin/donasi/cari'));
                                ?>
                                <div class="display-flex">
                                    <div class="form-group label-floating" style="background-color: #fff;flex-grow:1; margin-right:30px">
                                        <label class="control-label">Cari</label>
                                        <input class="form-control" type="text" name="cari" required="">
                                    </div>
                                    <button class="btn btn-primary mb-4">Cari</button>
                                </div>
                                <?php
                                echo form_close();
                                ?>

                            </div>
                            <div class="element-wrapper">
                                <h6 class="element-header"><?php echo 'Donasi'; ?></h6>
                                <div class="element-box-tp">
                                    <div class="row" id="results">
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo get_phrase('date'); ?></th>
                                                        <th><?php echo get_phrase('name'); ?></th>
                                                        <th><?php echo get_phrase('description'); ?></th>
                                                        <th><?php echo get_phrase('category'); ?></th>
                                                        <th><?php echo get_phrase('amount'); ?></th>
                                                        <th><?php echo get_phrase('method'); ?></th>
                                                        <th><?php echo "Saldo"; ?></th>
                                                        <th>Status</th>
                                                        <th><?php echo get_phrase('options'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($donasi as $row) :
                                                        $class_saldo = "";
                                                        if (strpos($row['saldo'], "-") !== false) {
                                                            $class_saldo = "text-danger";
                                                        }
                                                    ?>
                                                        <tr>
                                                            <td><span><?php echo $row['tanggal']; ?></span></td>
                                                            <td><?php echo $row['judul']; ?></td>
                                                            <td><?php echo $row['deskripsi']; ?></td>
                                                            <td><a class="btn btn-sm btn-rounded btn-purple text-white">
                                                                    <?php
                                                                    if ($row['kategori'] == 1) echo "Kredit";
                                                                    if ($row['kategori'] == 2) echo "Debit";
                                                                    ?></a>
                                                            </td>
                                                            <td><?php echo $this->db->get_where('settings', array('type' => 'currency'))->row()->description; ?><?php echo number_format(str_replace("-", "", $row['jumlah']), 0, '.', ','); ?></td>
                                                            <td style="text-align: center"><a class="btn nc btn-rounded btn-sm btn-primary" style="color:white"><?php
                                                                                                                                                                if ($row['metode'] == 1) echo get_phrase('cash');
                                                                                                                                                                if ($row['metode'] == 2) echo "Transfer";
                                                                                                                                                                ?></a></td>
                                                            <td><span class="<?= $class_saldo ?>"><?php echo "Rp" . number_format($row['saldo'], 0, '.', ','); ?></span></td>
                                                            <td>
                                                            <?= $row['status'] == 'Diterima' ? '<span class="badge badge-success">Diterima</span>':'<span class="badge badge-warning">Pending</span>' ?>
                                                            </td>
                                                            <td class="bolder">
                                                                <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modalEditDonasi/<?php echo $row['kas_id']; ?>');" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0001_compose_write_pencil_new" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('edit'); ?>"></i></a>
                                                                <a class="delete" href="<?php echo base_url(); ?>admin/donasi/delete/<?php echo $row['kas_id']; ?>" style="color:grey;"><i style="font-size:20px;" class="picons-thin-icon-thin-0057_bin_trash_recycle_delete_garbage_full" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('delete'); ?>"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col pagination">
                                            <?= $this->pagination->create_links(); ?>
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



<div class="modal fade" id="kas_baru" tabindex="-1" role="dialog" aria-labelledby="kas_baru" aria-hidden="true">
    <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
        <div class="modal-content">
            <?php echo form_open(base_url() . 'admin/donasi/create/'); ?>
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
            <div class="modal-header">
                <h6 class="title"><?php echo "Tambah Donasi"; ?></h6>
            </div>
            <div class="modal-body">
                <div class="form-group with-button">
                    <input class="form-control" type="text" name="judul" placeholder="<?php echo get_phrase('name'); ?>" required="">
                </div>
                <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo get_phrase('category'); ?></label>
                    <div class="select">
                        <select name="kategori" required="">
                            <option value=""><?php echo get_phrase('select'); ?></option>
                            <option value="1">Kredit</option>
                            <option value="2">Debit</option>
                        </select>
                    </div>
                </div>
                <div class="form-group with-button">
                    <textarea class="form-control" name="deskripsi" placeholder="<?php echo get_phrase('description'); ?>" required=""></textarea>
                </div>
                <div class="form-group with-button">
                    <input class="form-control uang" type="text" name="jumlah" placeholder="<?php echo get_phrase('amount'); ?>" required="">
                </div>
                <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo get_phrase('method'); ?></label>
                    <div class="select">
                        <select name="metode" required="">
                            <option value="1"><?php echo get_phrase('cash'); ?></option>
                            <option value="2"><?php echo "Transfer"; ?></option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo get_phrase('save'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>