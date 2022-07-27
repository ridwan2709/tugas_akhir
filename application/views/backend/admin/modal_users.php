    <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo 'Yang Telah Melihat Berita Ini'; ?></h6>
        </div>
        <div class="ui-block-content">
            <div class="row">
                <div class="table-responsive">
                    <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td><?php echo get_phrase('name'); ?></td>
                                <td><?php echo get_phrase('user_type'); ?></td>
                                <td><?php echo get_phrase('date'); ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = (int) $param2;
                            $this->db->where('news_code>=', $id);
                            $check = $this->db->get('readed')->result_array();  
                            $count = 1;
                            foreach ($check as $row) : ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><img src="<?php echo $this->crud_model->get_image_url($row['user_type'], $row['user_id']); ?>" class="user-avatar circle purple" style="line-height: 0px"> &nbsp &nbsp <?php echo $this->crud_model->get_name($row['user_type'], $row['user_id']); ?></td>
                                    <td><span class="badge badge-info"><?php echo $row['user_type']; ?></span></td>
                                    <td><?php echo $row['date']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>