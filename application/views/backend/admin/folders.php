<style>
    .no_border{
        border-radius:0px;
    }
</style><div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div>
      <div class="conty">
        <div class="all-wrapper no-padding-content solid-bg-all">
            <div class="layout-w">
              <div class="content-w">
                  <div class="content-i">
                    <div class="content-box">
                      <div class="app-email-w">
                    <div class="app-email-i">
                      <div class="ae-side-menu">
                          <div class="aem-head">
                            <a class="ae-side-menu-toggler" href="#"><i class="picons-thin-icon-thin-0293_phone_call_number_dialer" style="font-size: 19px"></i></a>
                          </div>
                          <ul class="ae-main-menu">
                              <li><a href="javascript:void(0);" data-toggle="modal" data-target="#bulkupload"><b style="font-size:20px">+</b><span> <?php echo get_phrase('folder');?></span></a></li>
                              <li><a href="<?php echo base_url();?>admin/files/"><i class="picons-thin-icon-thin-0177_puzzle_module_connect"></i><span><?php echo get_phrase('home');?></span></a></li>
                            <li><a href="<?php echo base_url();?>admin/all/"><i class="picons-thin-icon-thin-0130_structure_map_files"></i><span><?php echo get_phrase('all');?></span></a></li>
                            <li><a href="<?php echo base_url();?>admin/recent/"><i class="picons-thin-icon-thin-0117_folder_documents_revert_history"></i><span><?php echo get_phrase('recents');?></span></a></li>
                            <li class="active"><a href="<?php echo base_url();?>admin/folders/"><i class="picons-thin-icon-thin-0111_folder_files_documents"></i><span><?php echo get_phrase('folders');?></span></a></li>
                          </ul>
                      </div>
                      <div class="ae-content-w">
                          <div class="ae-co ntent">        
                            <div class="aec-full-message-w">
                                <div class="aec-full-message" style="min-height:800px;">
                                  <div class="message-head">
                                      <div class="user-w with-status status-green">
                                        
                                            <?php if($token == ""):?>    
                                            <div class="user-name">
                                                <h4 class="user-title"><?php echo get_phrase('my_folders');?></h4>
                                                <div class="user-role"><?php echo get_phrase('total_folders');?>: <?php $this->db->where('user_type','admin'); $this->db->where('user_id', $this->session->userdata('login_user_id')); echo $this->db->count_all_results('folder');?></div>
                                            </div>
                                            <?php else:?>
                                                <div class="back" style="">   
                                                 <a href="<?php echo base_url();?>admin/folders/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>  
                                             </div>
                                             <div class="user-name">
                                                <h4 class="user-title"><?php echo $this->db->get_where('folder', array('token' => $token))->row()->name;?></h4>
                                                <div class="user-role"><?php echo get_phrase('total_files');?>: <?php $this->db->where('folder_token',$token); echo $this->db->count_all_results('file');?></div>
                                            </div>
                                            <?php endif;?>
                                      </div>
                                       <?php if($token != ""):?>    
                                        <a href="<?php echo base_url();?>admin/upload_file/<?php echo $token;?>" class="btn btn-control bg-success" style="color: #fff; float:right;">
                                            <i class="picons-thin-icon-thin-0124_upload_cloud_file_sync_backup" title="Subir archivo"></i><div class="ripple-container"></div>
                                        </a>
                                       <?php endif;?>
                                  </div>
                                  <div class="message -content">   
                                  <?php if($token == ""):?>     
                                    <ul class="widget w-friend-pages-added notification-list friend-requests">
                                      <?php 
                                        $this->db->order_by('folder_id', 'desc');
                                        $folders = $this->db->get_where('folder', array('user_type' => 'admin', 'user_id' => $this->session->userdata('login_user_id')))->result_array();
                                          foreach($folders as $row):
                                      ?>
                                      <li class="inline-items">
                                        <div class="author-thumb no_border" >
                                          <img src="<?php echo base_url();?>uploads/icons/folder.svg" style="border-radius:0px;">
                                        </div>
                                        <div class="notification-event">
                                          <a href="<?php echo base_url();?>admin/folders/<?php echo $row['token'];?>" class="h6 notification-friend"><?php echo $row['name'];?></a>
                                          <span class="chat-message-item"><?php echo $row['date'];?></span><br>
                                          <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_folder/<?php echo $row['folder_id'];?>');"><i style="font-size:15px;" class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a>
                                          <a class="delete" href="<?php echo base_url();?>admin/folders/delete/<?php echo $row['folder_id'];?>"><i style="font-size:15px;" class="picons-thin-icon-thin-0057_bin_trash_recycle_delete_garbage_full"></i></a>
                                        </div>
                                        <span class="notification-icon">
                                          
                                        </span>
                                      </li>
                                    <?php endforeach;?>
                                    </ul>
                                    <?php else:?>
                                      <ul class="widget w-friend-pages-added notification-list friend-requests">
                                        <?php $this->db->where('folder_token', $token); $files = $this->db->get('file')->result_array();
                                          foreach($files as $file):
                                        ?>
                                        <li class="inline-items">
                                          <div class="author-thumb no_border">
                                            <?php 
                                              $img;
                                              $nme = strtolower($file['name']);
                                              if (strpos($nme, '.zip') !== false) 
                                                                {
                                                $img = base_url()."uploads/icons/zip.svg";
                                              }
                                              else if(strpos($nme, '.docx') !== false){
                                                $img = base_url()."uploads/icons/doc.svg";
                                              }
                                              else if(strpos($nme, '.xls') !== false || strpos($nme, '.xlsx') !== false){
                                                $img = base_url()."uploads/icons/xls.svg";
                                              }
                                              else if(strpos($nme, '.ppt') !== false){
                                                $img = base_url()."uploads/icons/ppt.svg";
                                              }
                                              else if(strpos($nme, '.jpg') !== false || strpos($nme, '.png') !== false || strpos($nme, '.jpeg') !== false){
                                                $img = base_url()."uploads/icons/img.svg";
                                              }
                                              else if(strpos($nme, '.psd') !== false){
                                                $img = base_url()."uploads/icons/psd.svg";
                                              }
                                              else if(strpos($nme, '.ai') !== false){
                                                $img = base_url()."uploads/icons/ai.svg";
                                              }
                                              else if(strpos($nme, '.txt') !== false){
                                                $img = base_url()."uploads/icons/txt.svg";
                                              }
                                              else if(strpos($nme, '.pdf') !== false){
                                                $img = base_url()."uploads/icons/pdf.svg";
                                              }
                                              else if(strpos($nme, '.mp3') !== false){
                                                $img = base_url()."uploads/icons/mp3.svg";
                                              }
                                              else if(strpos($nme, '.php') !== false){
                                                $img =  base_url()."uploads/icons/php.svg";
                                              }
                                              else{
                                                $img = base_url()."uploads/icons/other.svg";
                                              }
                                            ?>
                                           <img src="<?php echo $img;?>" style="border-radius:0px;">
                                         </div>
                                         <div class="notification-event">
                                            <a href="<?php echo base_url();?>admin/files/download/<?php echo $file['file_id'];?>" class="h6 notification-friend"><?php echo $file['name'];?> <small><b>(<?php echo str_replace("*", "", $file['size']);?>)</b></small></a>
                                           <span class="chat-message-item"><?php echo $file['date'];?></span>
                                           <br>
                                           <a href="<?php echo base_url();?>admin/files/download/<?php echo $file['file_id'];?>"><i style="font-size:15px;" class="picons-thin-icon-thin-0123_download_cloud_file_sync"></i></a>
                                           <a class="delete" href="<?php echo base_url();?>admin/files/delete/<?php echo $file['file_id'];?>"><i class="picons-thin-icon-thin-0057_bin_trash_recycle_delete_garbage_full" style="font-size:15px;"></i></a>
                                         </div>
                                       </li>
                                    <?php endforeach;?>
                                    </ul>
                                    <?php endif;?>
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
          <div class="display-type"></div>
      </div>
  </div>
</div>


 <div class="modal fade" id="bulkupload" tabindex="-1" role="dialog" aria-labelledby="bulkupload" aria-hidden="true" style="top:50px;">
      <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
        <div class="modal-content">
        <?php echo form_open(base_url() . 'admin/files/create_folder' , array('enctype' => 'multipart/form-data'));?>
          <a href="#" style="top:2px; float:right;" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
          <div class="modal-header">
            <h6 class="title"><?php echo get_phrase('new_folder');?></h6>
          </div>
          <div class="modal-body">
            <div class="form-group with-button">
              <input class="form-control" placeholder="<?php echo get_phrase('name');?>" name="name" type="text" required>
            </div>
            <button type="submit" class="btn btn-rounded btn-purple btn-lg full-width"><?php echo get_phrase('create');?></button>
          </div>
          <?php echo form_close();?>
        </div>
      </div>
    </div>