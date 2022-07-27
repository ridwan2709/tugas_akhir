<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;?>
<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div>
    <div class="conty">
	<div class="os-tabs-w menu-shad">
		<div class="os-tabs-controls">
			<ul class="navs navs-tabs">
        <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>parents/noticeboard/"><i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>  <span>Berita</span></a>
        </li>
				<li class="navs-item">
				  <a class="navs-links active" href="<?php echo base_url();?>parents/galeri/"><i class="picons-thin-icon-thin-0618_album_picture_image_photo"></i>  <span>Galery</span></a>
				</li>
				<li class="navs-item">
				  <a class="navs-links" href="<?php echo base_url();?>parents/blog/"><i class="picons-thin-icon-thin-0075_document_file_paper_text_article_blog_template"></i>  <span>Blog</span></a>
				</li>
			 </ul>
		</div>
	</div>
  
  <div class="content-i">
    <div class="content-box">
      <h5 class="form-header">Album</h5><hr>
          <div class="row">
            <!-- <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 margintelbot" >      
              <div class="friend-item friend-groups create-group" data-mh="friend-groups-item" style="min-height:250px;">      
                <a href="javascript:void(0);" class="full-block"></a>
                <div class="content">      
                  <a data-toggle="modal" data-target="#new_post" href="javascript:void(0);" class="text-white btn btn-control bg-success"><i class="icon-feather-plus"></i></a>      
                  <div class="author-content">
                    <a  href="javascript:void(0);" class="h5 author-name">Album, Baru</a>
                    <div class="country">Buat Album Baru</div>
                  </div>
                </div>
              </div>
            </div> -->
            <?php $kategori = $this->db->get('kategori')->result_array();
			    foreach($kategori as $class):
		    ?>
            <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="ui-block" data-mh="friend-groups-item">        
                <div class="friend-item friend-groups">
                  <div class="friend-item-content">
                      <!-- <div class="more">
                        <i class="icon-feather-more-horizontal"></i>
                        <ul class="more-dropdown">
                          <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_kategori/<?php echo $class['id_kategori'];?>');"><?php echo get_phrase('edit');?></a></li>
                          <li><a href="<?php echo base_url();?>parents/galeri/delete/<?php echo $class['id_kategori'];?>" class="delete"><?php echo get_phrase('delete');?></a></li>
                        </ul>
                      </div> -->
                      <div class="friend-avatar">
                        <div class="author-thumb">
                          <img src="<?= $this->db->get_where('galeri', array('id_kategori' => $class['id_kategori']))->row()->gambar; ?>" width="120px" style="background-color:#fff; border-radius:0px;">
                        </div>
                        <div class="author-content">
                            <div class="country">Album</div>
                          <a href="<?php echo base_url();?>parents/galerifoto/<?php echo base64_encode($class['id_kategori']);?>/" class="h5 author-name"><?php echo $class['nama'];?></a>
                        </div>
                      </div>        
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach;?>
            </div>
          </div>
      </div>
    </div>
  </div>