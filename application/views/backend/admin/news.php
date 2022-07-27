<div class="content-w">
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="conty">
        <div class="os-tabs-w menu-shad">
            <div class="os-tabs-controls">
                <ul class="navs navs-tabs">
                    <li class="navs-item">
                        <a class="navs-links active" href="<?php echo base_url(); ?>admin/news/"><i class="os-icon picons-thin-icon-thin-0010_newspaper_reading_news"></i> <span>Berita</span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url(); ?>admin/galeri/"><i class="picons-thin-icon-thin-0618_album_picture_image_photo"></i> <span>Galery</span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url(); ?>admin/blog/"><i class="picons-thin-icon-thin-0075_document_file_paper_text_article_blog_template"></i> <span>Blog</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-box">


            <div class="conta iner">
                <h3><?php echo get_phrase('news'); ?></h3>
                <div class="row">
                    <?php
                    $this->db->order_by('news_id', 'desc');
                    $news = $this->db->get('news')->result_array();
                    foreach ($news as $wall) :
                    ?>
                        <div class="col col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="ui-block paddingtel">
                                <article class="hentry post has-post-thumbnail thumb-full-width">
                                    <div class="post__author author vcard inline-items">
                                        <img src="<?php echo $this->crud_model->get_image_url('admin', $wall['admin_id']); ?>" class="user-avatar circle purple" style="line-height: 0px">
                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud_model->get_name('admin', $wall['admin_id']); ?></a>
                                            <div class="post__date">
                                                <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date . " " . $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date2; ?></time>
                                            </div>
                                        </div>
                                        <div class="more">
                                            <i class="icon-options"></i>
                                            <ul class="more-dropdown">
                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_news/<?php echo $wall['news_code']; ?>');"><?php echo get_phrase('edit'); ?></a></li>
                                                <li><a class="delete" href="<?php echo base_url(); ?>admin/news/delete2/<?php echo $wall['news_code']; ?>"><?php echo get_phrase('delete'); ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php if ($wall['type'] == 'video') : ?>
                                        <hr>
                                        <p><?php echo $wall['description']; ?></p>
                                        <div class="post-thumb">
                                            <iframe src="<?php echo $wall['embed']; ?>" height="360" width="100%" frameborder="0" allowfullscreen=""></iframe>
                                        </div>
                                    <?php else : ?>
                                        <?php if (file_exists('uploads/news_images/' . $wall['news_code'] . '.jpg')) : ?>
                                            <hr>
                                            <p><?php echo $wall['description']; ?></p>
                                            <div class="post-thumb">
                                                <img id="zoom_01<?php echo $wall['news_code']; ?>" src="<?php echo base_url(); ?>uploads/news_images/<?php echo $wall['news_code']; ?>.jpg" data-zoom-image="<?php echo base_url(); ?>uploads/news_images/<?php echo $wall['news_code']; ?>.jpg">
                                            </div>
                                        <?php else : ?>
                                            <div class="wall-content">
                                                <p><?php echo $wall['description']; ?></p>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="control-block-button post-control-button">
                                        <a href="javascript:void(0);" class="btn btn-control" style="background-color:#001b3d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo get_phrase('news'); ?>">
                                            <i class="picons-thin-icon-thin-0032_flag"></i>
                                        </a>
                                    </div>
                                    <?php
                                    $id = $wall['news_id'];
                                    $this->db->limit(5);
                                    $this->db->order_by('readed_id', 'RANDOM');
                                    $this->db->where('news_code>=', $id);
                                    $checkData = $this->db->get('readed')->result_array();
                                    ?>
                                    <div class="post-additional-info inline-items">
                                        <ul class="friends-harmonic">
                                            <?php foreach ($checkData as $readed) : ?>
                                                <li>
                                                    <a href="javascript:void(0);">
                                                        <img loading="lazy" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_users/<?php echo $wall['news_id']; ?>');" title="<?php echo $this->crud_model->get_name($readed['user_type'], $readed['user_id']); ?>" src="<?php echo $this->crud_model->get_image_url($readed['user_type'], $readed['user_id']); ?>" alt="<?php echo $this->crud_model->get_name($readed['user_type'], $readed['user_id']); ?>" width="28" height="28">
                                                    </a>
                                                </li>
                                            <?php endforeach;
                                            $this->db->order_by('readed_id', 'RANDOM');
                                            $this->db->where('news_code>=', $id);
                                            $checkCountData = $this->db->get('readed')->result_array();
                                            ?>
                                        </ul>
                                        <div class="names-people-likes">
                                            <?php if (count($checkCountData) > 5) :
                                                echo 'dan ';
                                                echo count($checkCountData) - 5;
                                                echo ' orang lainnya telah melihat berita ini';
                                            elseif (count($checkCountData) > 0) :
                                                echo 'Telah melihat berita ini';
                                            else :
                                                echo 'Belum ada yang melihat berita ini'; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="comments-shared">
                                            <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <script>
                            $('#zoom_01<?php echo $wall['news_code']; ?>').elevateZoom({
                                zoomType: "inner",
                                cursor: "crosshair",
                                zoomWindowFadeIn: 500,
                                zoomWindowFadeOut: 750
                            });
                        </script>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>