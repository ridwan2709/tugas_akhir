<?php  
$running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
$edit_data = $this->db->get_where('mark' , array('mark_id' => $param2))->result_array();
$mark_id = $edit_data[0]['mark_id'];
$class_id = $edit_data[0]['class_id'];
$section_id = $edit_data[0]['section_id'];
$subject_id = $edit_data[0]['subject_id'];
?>

<div class="modal-body">
    <div class="modal-header" style="background-color:#00579c">
        <h6 class="title" style="color:white"><?php echo 'Perbarui Nilai';?></h6>
    </div>
    <?php
    foreach($edit_data as $row):
        ?>
        <div class="ui-block-content"><?php echo form_open(base_url() . 'teacher/marks_update/'.$mark_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id.'/'.$exam_id);?>
        <p style="text-align: center"><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']);?>" width="50px" style="border-radius: 10px;margin-right:5px;"><br><?php echo $this->crud_model->get_name('student', $row['student_id']);?></p>
        
        <br>
        <div class="row">

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12" style="background-color: #f2f4f8">
                <label class="control_label " style="width: 75%; padding-top: 8px"><?php echo $this->db->get_where('subject' , array('subject_id' => $param3))->row()->la1;?></label>
                <div class="f-right" style="background-color: #fff">
                    <input class="form-control " type="text" name="marks_obtained_<?php echo $row['mark_id'];?>" placeholder="-" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['mark_obtained'];?>">
                </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <label class="control_label " style="width: 75%; padding-top: 8px"><?php echo $this->db->get_where('subject' , array('subject_id' => $param3))->row()->la2;?></label>
                <div class="f-right">
                    <input class="form-control " type="text" name="lab_uno_<?php echo $row['mark_id'];?>" placeholder="-" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labuno'];?>">
                </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12" style="background-color: #f2f4f8">
                <label class="control_label " style="width: 75%; padding-top: 8px"><?php echo $this->db->get_where('subject' , array('subject_id' => $param3))->row()->la3;?></label>
                <div class="f-right" style="background-color: #fff">
                    <input class="form-control " type="text" name="lab_dos_<?php echo $row['mark_id'];?>" placeholder="-" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labdos'];?>">
                </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <label class="control_label " style="width: 75%; padding-top: 8px"><?php echo $this->db->get_where('subject' , array('subject_id' => $param3))->row()->la4;?></label>
                <div class="f-right">
                    <input class="form-control " type="text" name="lab_tres_<?php echo $row['mark_id'];?>" placeholder="-" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labtres'];?>">
                </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12" style="background-color: #f2f4f8">
                <label class="control_label " style="width: 75%; padding-top: 8px"><?php echo $this->db->get_where('subject' , array('subject_id' => $param3))->row()->la5;?></label>
                <div class="f-right" style="background-color: #fff">
                    <input class="form-control " type="text" name="lab_cuatro_<?php echo $row['mark_id'];?>" placeholder="-" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labcuatro'];?>">
                </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <label class="control_label " style="width: 75%; padding-top: 8px"><?php echo $this->db->get_where('subject' , array('subject_id' => $param3))->row()->la6;?></label>
                <div class="f-right">
                    <input class="form-control " type="text" name="lab_cinco_<?php echo $row['mark_id'];?>" placeholder="-" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labcinco'];?>">
                </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12" style="background-color: #f2f4f8">
                <label class="control_label " style="width: 75%; padding-top: 8px"><?php echo $this->db->get_where('subject' , array('subject_id' => $param3))->row()->la7;?></label>
                <div class="f-right" style="background-color: #fff">
                    <input class="form-control " type="text" name="lab_seis_<?php echo $row['mark_id'];?>" placeholder="-" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labseis'];?>">
                </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <label class="control_label " style="width: 75%; padding-top: 8px"><?php echo $this->db->get_where('subject' , array('subject_id' => $param3))->row()->la8;?></label>
                <div class="f-right">
                    <input class="form-control " type="text" name="lab_siete_<?php echo $row['mark_id'];?>" placeholder="-" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labsiete'];?>">
                </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12" style="background-color: #f2f4f8">
                <label class="control_label " style="width: 75%; padding-top: 8px"><?php echo $this->db->get_where('subject' , array('subject_id' => $param3))->row()->la9;?></label>
                <div class="f-right" style="background-color: #fff">
                    <input class="form-control " type="text" name="lab_ocho_<?php echo $row['mark_id'];?>" placeholder="-" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labocho'];?>">
                </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <label class="control_label " style="width: 75%; padding-top: 8px"><?php echo $this->db->get_where('subject' , array('subject_id' => $param3))->row()->la10;?></label>
                <div class="f-right">
                    <input class="form-control " type="text" name="lab_nueve_<?php echo $row['mark_id'];?>" placeholder="-" style="width:55px; border: 1; text-align: center;" value="<?php echo $row['labnueve'];?>">
                </div>
            </div>

            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <label class="control_label ">Komentar</label>
                <textarea class="form-control" name="comment_<?php echo $row['mark_id'];?>" id="" cols="20" rows="5"><?= $row['comment']?></textarea>
            </div>
            
        <?php endforeach;?>

        <div class="col col-sm-12 col-12" style="text-align: center;"><br><br>
            <button class="btn btn-rounded btn-success btn-lg " type="submit"><?php echo get_phrase('update');?></button>
        </div>
    </div>
    <?php echo form_close();?>

</div>
</div>
