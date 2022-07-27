<?php
$detail = $this->db->get_where('document', array('document_id' => $param2))->result_array();
foreach ($detail as $row) :
?>
        <div class="modal-body">
          <div class="ui-block-title" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo 'Perbarui Bahan Ajar'; ?></h6>
          </div>
          <div class="ui-block-content">
            <?php echo form_open(base_url() . 'teacher/study_material/update/' . $param3, array('enctype' => 'multipart/form-data')); ?>
            <div class="row">
              <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
              <input type="hidden" name="document_id" value="<?= $row['document_id'] ?>">
                <div class="form-group">
                  <label class="control-label"><?php echo get_phrase('description'); ?></label>
                  <textarea class="form-control ckeditor1" name="description"> <?= $row['description'] ?></textarea>
                </div>
              </div>
              <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                  <label class="control-label"><?php echo 'Lampiran'; ?></label>
                  <input class="form-control" name="file_name" placeholder="Salin link lampiran" type="text" value="<?= $row['file_name'] ?>">
                </div>
              </div>
            </div>
            <div class="form-buttons-w text-right">
              <center><button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo get_phrase('save'); ?></button></center>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
<?php endforeach; ?>