<?php
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$info = base64_decode($data);
$ex = explode('-', $info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach ($sub as $rows) :
?>

  <div class="content-w">
    <div class="conty">
      <?php $info = base64_decode($data); ?>
      <?php $ids = explode("-", $info); ?>
      <?php include 'fancy.php'; ?>
      <div class="header-spacer"></div>
      <div class="cursos cta-with-media" style="background: #<?php echo $rows['color']; ?>;">
        <div class="cta-content">
          <div class="user-avatar">
            <img alt="" src="<?php echo base_url(); ?>uploads/subject_icon/<?php echo $rows['icon']; ?>" style="width:60px;">
          </div>
          <h3 class="cta-header"><?php echo $rows['name']; ?> - <small><?php echo get_phrase('study_material'); ?></small></h3>
          <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"</small>
        </div>
      </div>
      <!-- Menu -->
        <?php include 'menu_akademic.php' ?>
      <!-- End Menu -->
      <div class="content-i">
        <div class="content-box">
          <div class="row">
            <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
              <div id="newsfeed-items-grid">
                <div class="element-wrapper">
                  <div class="element-box-tp">
                    <h6 class="element-header"><?php echo get_phrase('study_material'); ?></h6>
                    <div class="table-responsive">
                      <table class="table table-padded" style="border-spacing: 30px">
                        <tbody>
                          <?php
                          $this->db->order_by('timestamp', 'desc');
                          $study_material_info = $this->db->get_where('document', array('class_id' => $ids[0], 'subject_id' => $ids[2]))->result_array();
                          foreach ($study_material_info as $row) :
                          ?>
                            <tr>
                              <td class="text-left cell-with-media " style="background: #056ab3; color: #ffffff">
                                <?php echo $row['description'] ?>
                                <center style="padding-top: 30px">
                                  <a href="<?php echo $row['file_name']; ?>" style="color:gray;">
                                    <?php if ($row['file_type'] == 'PDF') : ?>
                                      <i class="picons-thin-icon-thin-0077_document_file_pdf_adobe_acrobat" style="font-size:20px; color:gray;"></i>
                                    <?php endif; ?>
                                    <?php if ($row['file_type'] == 'Zip') : ?>
                                      <i class="picons-thin-icon-thin-0076_document_file_zip_archive_compressed_rar" style="font-size:20px; color:gray;"></i>
                                    <?php endif; ?>
                                    <?php if ($row['file_type'] == 'RAR') : ?>
                                      <i class="picons-thin-icon-thin-0076_document_file_zip_archive_compressed_rar" style="font-size:20px; color:gray;"></i>
                                    <?php endif; ?>
                                    <?php if ($row['file_type'] == 'Doc') : ?>
                                      <i class="picons-thin-icon-thin-0078_document_file_word_office_doc_text" style="font-size:20px; color:gray;"></i>
                                    <?php endif; ?>
                                    <?php if ($row['file_type'] == 'Image') : ?>
                                      <i class="picons-thin-icon-thin-0082_image_photo_file" style="font-size:20px; color:gray;"></i>
                                    <?php endif; ?>
                                    <?php if ($row['file_type'] == 'Other' && $row['file_name'] !== "") : ?>
                                      <i class="picons-thin-icon-thin-0111_folder_files_documents" style="font-size:20px; color:#ffffff"></i>
                                      <span><?php echo '<a target="_blank" href="' . $row['file_name'] . '" class="color: #ffffff"> &nbsp;&nbsp;Buka FIle</a>'; ?></span><span class="smaller d-none">(<?php echo $row['filesize']; ?>)</span></a><?php endif; ?>
                                </center>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </main>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>