<div class="content-w">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="content-i">
        <div class="content-box">
            <div class="conty">
                <div class="ui-block">
                    <div class="ui-block-content">
                        <div class="steps-w">
                            <div class="step-triggers">
                                <a class="step-trigger active" href="#stepContent1">Unduh Lembar Penerimaan Siswa Baru</a>
                            </div>
                            <div class="step-contents">
                                <div class="step-content active" id="stepContent1">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <center><img src="<?php echo base_url(); ?>uploads/mensajeseducaby.png" style="width:30%"></center>
                                        </div>
                                    </div>
                                    <div class="form-buttons-w text-center">
                                        <a target="_blank" class="btn btn-rounded btn-primary btn-lg" style="margin-top: 10px;" href="<?php echo base_url(); ?>admin/generate/<?php echo $student_id; ?>/<?php echo $pw; ?>/<?= $pw2 ?>">Unduh</a>
                                        <a class="btn btn-rounded btn-success btn-lg" style="margin-top: 10px;" href="<?php echo base_url(); ?>admin/new_student/">Siswa Baru</a>
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