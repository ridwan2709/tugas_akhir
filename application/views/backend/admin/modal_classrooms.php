<?php 
    $students = $this->db->get_where('student' , array('dormitory_id' => $param2))->result_array();
?>
<div class="modal-body">
    <div class="modal-header" style="background-color:#00579c">
        <h6 class="title" style="color:white"><?php echo get_phrase('students');?></h6>
    </div>
    <div class="ui-block-content">
        <div class="row">
            <div class="table-responsive">
                <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td><?php echo get_phrase('name');?></td>
                            <td><?php echo get_phrase('email');?></td>
                            <td><?php echo get_phrase('phone');?></td>
                            <td><?php echo get_phrase('class');?></td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $count = 1;
                        foreach($students as $row):
                    ?>
                        <?php $class_id = $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->class_id;?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="user-avatar circle purple" style="line-height: 0px"> &nbsp; <?php echo $this->crud_model->get_name('student', $row['student_id']);?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>