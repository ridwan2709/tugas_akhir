<?php $blog = $this->db->get_where('tbl_tulisan' , array('tulisan_id' => $id))->result_array();
    foreach ($blog as $row):
?>
<div class="content-w">
  <div class="conty">
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
    <div class="os-tabs-w menu-shad">
		<div class="os-tabs-controls">
		  <ul class="navs navs-tabs upper">
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>student/news/"><i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i>  <span>Berita</span></a>
        </li>
				<li class="navs-item">
				  <a class="navs-links" href="<?php echo base_url();?>student/galeri/"><i class="picons-thin-icon-thin-0618_album_picture_image_photo"></i>  <span>Galery</span></a>
				</li>
				<li class="navs-item">
				  <a class="navs-links active" href="<?php echo base_url();?>student/blog/"><i class="picons-thin-icon-thin-0075_document_file_paper_text_article_blog_template"></i>  <span>Blog</span></a>
				</li>
		  </ul>
		</div>
	  </div>
    <div class="content-i">
      <div class="content-box">
          <div class="back hidden-sm-down" style="margin-top:-20px;margin-bottom:10px">		
	<a href="<?php echo base_url();?>student/blog/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
	</div>	
        <div class="row">
          <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
            <div id="newsfeed-items-grid">                
              <div class="ui-block">
                <article class="hentry post thumb-full-width">                
                  <div class="post__author author vcard inline-items">
                    <img src="<?php echo $this->crud_model->get_image_url($row['tulisan_author']); ?>" alt="author">                
                    <div class="author-date">
                      <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $row['tulisan_author'];?></a>
                    </div>                
                    <div class="more">
                      <i class="icon-options"></i>                                
                      <ul class="more-dropdown">
                        <li><a href="<?php echo base_url();?>student/edit_blog/<?php echo $row['tulisan_id'];?>/"><?php echo get_phrase('edit');?></a></li>
                        <li><a href="<?php echo base_url();?>student/blog/delete/<?php echo $row['tulisan_id'];?>/"><?php echo get_phrase('delete');?></a></li>
                      </ul>
                    </div>                
                  </div>                
                  <div class="edu-posts cta-with-media verde">
                    <div class="cta-content">
                      <h3 class="cta-header"><?php echo $row['tulisan_judul'];?></h3>  
                      <img src="<?= base_url('uploads/blog/').$row['tulisan_gambar'].'.jpg' ?>" alt="">          
                      <div class="descripcion">
                        <?php echo $row['tulisan_isi'];?>
                      </div>
                      <div class="deadtime">
                        <span><?php echo get_phrase('delivery_date');?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo $row['tulisan_tanggal'] ;?>
                      </div>
                    </div>
                  </div>               
                </article>
              </div>
            </div>
          </main>


<div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
<div class="crumina-sticky-sidebar">
    <div class="sidebar__inner ">
        <div class="ui-block ">
        <div class="ui-block-title">
            <h6 class="title"><?php echo get_phrase('information');?></h6>
        </div>
        <div class="ui-block-content">
      <div class="table-responsive">
      <table class="table table-lightbor">
        <tr>
        <th>
          Kategori:
        </th>
        <td>
          <?php echo $row['tulisan_kategori_nama'] ?>
        </td>
        </tr>
        <tr>
        <th>
          Yang Melihat:
        </th>
        <td>
          <a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white"><?php echo $row['tulisan_views'];?></a>
        </td>
        </tr>
                <tr>
                <th>
                  Jumlah Komentar :
                </th>
                <td>
                  <?php
                  $komentar_tulisan_id = $row['tulisan_id'];
                   $jumlah =  $this->db->query("SELECT COUNT(*) as jml FROM `tbl_komentar` WHERE komentar_tulisan_id = $komentar_tulisan_id")->result_array();
                  echo '<a class="btn nc btn-rounded btn-sm btn-secondary" style="color:white">'.$jumlah[0]['jml'].'</a>';
                  ?>
                </td>
                </tr>
      </table>
    </div>
    </div></div>
                    
                    </div>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach;?>