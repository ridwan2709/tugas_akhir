<?php  $edit_data = $this->db->get_where('galeri' , array('id_galeri' => $param2))->result_array();
        foreach($edit_data as $row):
?>    
          <div class="modal-content">
            <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
            <div class="modal-header">
              <h6 class="title">Ubah Album</h6>
            </div>
            <?php echo form_open(base_url() . 'admin/galerifotos/edit/'.$row['id_galeri'].'/'.$row['id_kategori'], array('enctype' => 'multipart/form-data')); ?>
            <div class="modal-body">
                <div class="ui-block-content">
              <div class="row">
                  <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group label-floating">
                      <label class="control-label">Link Foto</label>
                      <input class="form-control" placeholder="" value="<?php echo $row['gambar'];?>" name="gambar" type="text" required>
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