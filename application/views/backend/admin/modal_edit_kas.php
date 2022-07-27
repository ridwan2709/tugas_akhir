 <?php $edit_data    =    $this->db->get_where('kas', array('kas_id' => $param2))->result_array();
    foreach ($edit_data as $row) : ?>
     <div class="modal-body">
         <div class="modal-header" style="background-color:#00579c">
             <h6 class="title" style="color:white"><?php echo "Perbaharui kas"; ?></h6>
         </div>
         <div class="ui-block-content">
             <?php echo form_open(base_url() . 'admin/kas/edit/' . $row['kas_id'], array('enctype' => 'multipart/form-data')); ?>
             <input type="hidden" name="tanggal" value="<?php echo $row['tanggal'] ?>" />

             <div class="row">
                 <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                     <div class="form-group label-floating">
                         <label class="control-label"><?php echo get_phrase('title'); ?></label>
                         <input class="form-control" type="text" name="judul" required="" value="<?php echo $row['judul']; ?>">
                     </div>
                 </div>
                 <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                     <div class="form-group label-floating">
                         <label class="control-label"><?php echo get_phrase('total'); ?></label>
                         <input class="form-control uang" type="text" required="" name="jumlah" value="<?php echo $row['jumlah']; ?>">
                     </div>
                 </div>
                 <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                     <div class="form-group label-floating is-select">
                         <label class="control-label"><?php echo get_phrase('category'); ?></label>
                         <div class="select">
                             <select name="kategori" required>
                                 <option value=""><?php echo get_phrase('select'); ?></option>
                                 <option value="1" <?php if ($row['kategori'] == 1) echo 'selected'; ?>>Kredit</option>
                                 <option value="2" <?php if ($row['kategori'] == 2) echo 'selected'; ?>>Debit</option>
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                     <div class="form-group label-floating is-select">
                         <label class="control-label"><?php echo get_phrase('method'); ?></label>
                         <div class="select">
                             <select name="metode" required>
                                 <option value=""><?php echo get_phrase('select'); ?></option>
                                 <option value="1" <?php if ($row['metode'] == 1) echo 'selected'; ?>><?php echo get_phrase('cash'); ?></option>
                                 <option value="2" <?php if ($row['metode'] == 2) echo 'selected'; ?>><?php echo "Transfer"; ?></option>
                             </select>
                         </div>
                     </div>
                 </div>

                 <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                     <div class="form-group label-floating">
                         <label class="control-label"><?php echo get_phrase('description'); ?>:</label>
                         <textarea class="form-control" name="deskripsi" rows="3" required=""><?php echo $row['deskripsi']; ?></textarea>
                         <span class="material-input"></span>
                     </div>
                 </div>
                 <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                     <button class="btn btn-rounded btn-success btn-lg " type="submit"><?php echo get_phrase('update'); ?></button>
                 </div>
             </div>
             <?php echo form_close(); ?>
         </div>
     </div>
 <?php endforeach; ?>