
<?php 
    $komentar = $this->db->get_where('tbl_komentar' , array('komentar_id' => $param2, 'komentar_parent' => 0))->result_array();
    foreach($komentar as $data):
?>
      <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white">Balas Komentar</h6>
        </div>
        <div class="ui-block-content">
              <?php echo form_open(base_url() . 'admin/komentar/balas/'.$data['komentar_id'].'/'.$data['komentar_tulisan_id'], array('enctype' => 'multipart/form-data')); ?>
                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                    <input style="background-color:white" class="form-control" weight="auto" disabled value="<?= $data['komentar_nama']?>">
                                </div>
                            </div>
                            
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="control-label">Komentar</label>
                                    <textarea style="background-color:white" class="form-control" weight="auto" disabled><?= $data['komentar_isi']?></textarea>
                                </div>
                            </div>

                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="control-label">Balasan</label>
                                    <textarea class="form-control" name="isi"></textarea>
                                </div>
                            </div>
                            </div>
                            <div class="form-button-w text-right">
                                <button class="btn btn-success btn-rounded" type="submit">Balas</button>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
    <?php endforeach;?>
 