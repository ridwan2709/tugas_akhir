<div class="content-w">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="conty">
        <div class="os-tabs-w menu-shad">
            <div class="os-tabs-controls">
                <ul class="navs navs-tabs upper">
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url(); ?>admin/system_settings/"><i class="os-icon picons-thin-icon-thin-0050_settings_panel_equalizer_preferences"></i><span><?php echo get_phrase('system_settings'); ?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url(); ?>admin/sms/"><i class="os-icon picons-thin-icon-thin-0287_mobile_message_sms"></i><span><?php echo get_phrase('sms'); ?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url(); ?>admin/email/"><i class="os-icon picons-thin-icon-thin-0315_email_mail_post_send"></i><span><?php echo get_phrase('email_settings'); ?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links active" href="<?php echo base_url(); ?>admin/landingPage/"><i class="picons-thin-icon-thin-0327_computer_screen_settings_preferences"></i><span><?php echo 'Pengaturan Landing Page'; ?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url(); ?>admin/translate/"><i class="os-icon picons-thin-icon-thin-0307_chat_discussion_yes_no_pro_contra_conversation"></i><span><?php echo get_phrase('translate'); ?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url(); ?>admin/database/"><i class="picons-thin-icon-thin-0356_database"></i><span><?php echo get_phrase('database'); ?></span></a>
                    </li>
                </ul>
            </div>
        </div><br>
        <div class="all-wrapper no-padding-content solid-bg-all">
            <div class="layout-w">
                <div class="content-w">
                    <div class="content-i">
                        <div class="content-box">
                            <div class="col-sm-12">
                                <?php echo form_open(base_url() . 'admin/landingPage/status', array('enctype' => 'multipart/form-data')); ?>
                                <div class="element-box shadow shadow lined-purple" style="border-radius:10px;">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="form-group label-floating is-select">
                                                <label class="control-label"><?php echo 'Modifikasi Hero Landing Page'; ?></label>
                                                <div class="select">
                                                    <select name="lp_status">
                                                        <?php $status = $this->db->get_where('settings', array('type' => 'lp_status'))->row()->description; ?>
                                                        <option value="deactivate" <?php if ($status == 'deactivate') echo 'selected'; ?>>Nonaktif</option>
                                                        <option value="active" <?php if ($status == 'active') echo 'selected'; ?>>Aktif</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="element-box shadow shadow lined-primary" style="border-radius:10px; padding-bottom: 40px">
                                            <?php echo form_open(base_url() . 'admin/landingPage/banner', array('enctype' => 'multipart/form-data')); ?>
                                            <h3 class="form-header">Gambar Banner</h3><br>
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <div class="form-group" style="margin-bottom:-15px;">
                                                        <input class="form-control" type="file" name="banner" style="padding-top: 10px;" value="banner.jpg">
                                                        <input class="form-control" type="text" name="banner" required="" value="<?= base_url('uploads/banner.jpg'); ?>" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group label-floating" style="text-align: center;">
                                                        <img src="<?= $this->db->get_where('settings', array('type' => 'banner'))->row()->description; ?>">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-buttons-w">
                                                <a href="<?= base_url('admin/delete_banner'); ?>" style="float: left;" class='btn btn-rounded btn-danger'><i class='fa fa-trash-alt'></i></a>
                                                <button class="btn btn-rounded btn-primary" type="submit" style="float: right;"> <i class="fa fa-save"></i></button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="element-box shadow lined-warning" style="border-radius:10px; padding-bottom: 40px">
                                            <?php echo form_open(base_url() . 'admin/landingPage/imgCenter', array('enctype' => 'multipart/form-data')); ?>
                                            <h3 class="form-header">Gambar Tengah</h3><br>
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <div class="form-group" style="margin-bottom:-15px;">
                                                        <input class="form-control" type="file" name="imgCenter" style="padding-top: 10px;" value="imgCenter.jpg">
                                                        <input class="form-control" type="text" name="imgCenter" required="" value="<?= base_url('uploads/imgCenter.jpg'); ?>" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group label-floating" style="text-align: center;">
                                                        <img src="<?= $this->db->get_where('settings', array('type' => 'imgCenter'))->row()->description; ?>">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-buttons-w">
                                                <a href="<?= base_url('admin/delete_imgCenter'); ?>" style="float: left;" class='btn btn-rounded btn-danger'><i class='fa fa-trash-alt'></i></a>
                                                <button class="btn btn-rounded btn-warning" type="submit" style="float: right;"> <i class="fa fa-save"></i> </button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="element-box shadow lined-success" style="border-radius:10px;">
                                            <?php echo form_open(base_url() . 'admin/landingPage/wave', array('enctype' => 'multipart/form-data')); ?>
                                            <h3 class="form-header">Warna Gelombang</h3><br>
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Wave 1</label>
                                                    <input class="jscolor" value="<?= $this->db->get_where('settings', array('type' => 'wave1'))->row()->description; ?>" type="text" name="wave1" required="">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Wave 2</label>
                                                    <input class="jscolor" value="<?= $this->db->get_where('settings', array('type' => 'wave2'))->row()->description; ?>" type="text" name="wave2" required="">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Wave 3</label>
                                                    <input class="jscolor" value="<?= $this->db->get_where('settings', array('type' => 'wave3'))->row()->description; ?>" type="text" name="wave3" required="">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Wave 4</label>
                                                    <input class="jscolor" value="<?= $this->db->get_where('settings', array('type' => 'wave4'))->row()->description; ?>" type="text" name="wave4" required="">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="form-buttons-w text-right">
                                                <button class="btn btn-rounded btn-success" type="submit"> <i class="fa fa-save"></i> </button>
                                            </div>
                                            <?php echo form_close(); ?>
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
<script>
    $(document).ready(function() {
        $('#status').on('change', function() {

        });
    });
</script>