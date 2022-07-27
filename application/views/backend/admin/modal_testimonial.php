<?php  $edit_data = $this->db->get_where('testimonials' , array('id_testimonial' => $param2))->result_array();
        foreach($edit_data as $row):
?>    
          <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
            <div class="modal-header">
              <h6 class="title">Ubah Testimoni</h6>
            </div>
            <?php echo form_open(base_url() . 'admin/testimonials/edit/'.$row['id_testimonial'], array('enctype' => 'multipart/form-data')); ?>
            <div class="modal-body">
                <div class="ui-block-content">
              <div class="row">
                  <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group label-floating">
                      <label class="control-label"><?php echo get_phrase('name');?></label>
                      <input class="form-control" placeholder="" value="<?php echo $row['nama'];?>" name="nama" type="text" required>
                    </div>
                  </div>
                  <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group label-floating">
                      <label class="control-label">Jabatan</label>
                      <input class="form-control" placeholder="" value="<?php echo $row['jabatan'];?>" name="jabatan" type="text" required>
                    </div>
                  </div>
                  <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group label-floating">
                      <label class="control-label">Link Foto</label>
                      <input class="form-control" placeholder="" value="<?php echo $row['foto'];?>" name="foto" type="text" required>
                    </div>
                  </div>
                  <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="control-label"><?php echo get_phrase('description');?></label>
                            <textarea class="form-control" name="deskripsi"><?php echo $row['deskripsi'];?></textarea>
                        </div>
                    </div> 
                  <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    <button class="btn btn-success btn-lg full-width" type="submit"><?php echo get_phrase('update');?></button>
                  </div>
                </div>
                </div>
              </div>
            <?php echo form_close();?>
          </div>
<?php endforeach; ?>