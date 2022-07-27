<?php
$encode_data = $data;
$decode_data = base64_decode($encode_data);
$explode_data = explode("-", $decode_data);

/*
explode[0] = class id
explode[1] = subject id
explode[2] = student id
explode[3] = section id

*/
// ambil level student
$query = "SELECT st.first_name, en.*, sc.name, DATE_FORMAT(FROM_UNIXTIME(en.date_added), '%Y-%m-%d %H:%i:%s') AS 'date_formatted'
FROM enroll en
INNER JOIN student st ON st.student_id = en.student_id
INNER JOIN section sc ON sc.class_id = en.class_id
WHERE st.student_id = '" . $explode_data[2] . "' 
AND sc.section_id = en.section_id
AND en.date_added = (SELECT MAX(date_added) FROM enroll WHERE student_id = '" . $explode_data[2] . "')
ORDER BY date_formatted  DESC";
$r_level_student = $this->db->query($query);
$row_level_student = $r_level_student->row();
$level_student = (isset($row_level_student) ? $row_level_student->name : "");

?>
<?php $min = $this->db->get_where('academic_settings', array('type' => 'minium_mark'))->row()->description; ?>
<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
if ($tahun_ajaran == NULL) {
  $tahun_ajaran = $running_year;
}

?>
<?php
$sub = $this->db->get_where('subject', array('subject_id' => $explode_data[1]))->result_array();
foreach ($sub as $rows) :
?>
<div class="content-w">  
    <div class="conty">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div>
    <div class="cursos cta-with-media" style="background: #<?php echo $rows['color'];?>;">
      <div class="cta-content">
        <div class="user-avatar">
          <img alt="" src="<?php echo base_url();?>uploads/subject_icon/<?php echo $rows['icon'];?>" style="width:60px;">
        </div>
        <h3 class="cta-header"><?php echo $rows['name'];?> - <small><?php echo get_phrase('marks');?></small></h3>
        <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $explode_data[0]))->row()->name;?> | <?php echo $this->db->get_where('section', array('section_id' => $explode_data[1]))->row()->name;?> | TA. <?= $tahun_ajaran ?></small>
      </div>
    </div>

      <!-- Menu -->
      <?php include 'menu_akademic.php' ?>
      <!-- End Menu --> 
            <div class="content-i">   
                <div class="content-box">      
                    <div class="element-wrapper">         
                        <?php echo form_open(base_url() . 'parents/attendance_report_selector/', array('class' => 'form m-b')); ?>
                        <div class="row">                
                            <input type="hidden" name="data" value="<?php echo $data;?>">
                            <input type="hidden" name="student_id" value="<?php echo $explode_data[2];?>">
                            <div class="col-sm-4">                  
                                <div class="form-group label-floating is-select">
                                    <label class="control-label"><?php echo get_phrase('month');?></label>
                                    <div class="select">
                                        <select name="month" required="" onchange="show_year()">
                                            <option value=""><?php echo get_phrase('select');?></option>
                                            <?php
                                            for ($i = 1; $i <= 12; $i++):
                                             if ($i == 1) $m = get_phrase('january');
                                             else if ($i == 2) $m = get_phrase('february');
                                             else if ($i == 3) $m = get_phrase('march');
                                             else if ($i == 4) $m = get_phrase('april');
                                             else if ($i == 5) $m = get_phrase('may');
                                             else if ($i == 6) $m = get_phrase('june');
                                             else if ($i == 7) $m = get_phrase('july');
                                             else if ($i == 8) $m = get_phrase('august');
                                             else if ($i == 9) $m = get_phrase('september');
                                             else if ($i == 10) $m = get_phrase('october');
                                             else if ($i == 11) $m = get_phrase('november');
                                             else if ($i == 12) $m = get_phrase('december');
                                             ?>
                                             <option value="<?php echo $i; ?>"<?php if($month == $i) echo 'selected'; ?>  ><?php echo $m; ?></option>
                                         <?php endfor;?>
                                     </select>
                                 </div>
                             </div>                
                         </div>            
                      <div class="col-md-2">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo get_phrase('year');?></label>
                            <div class="select">
                                <select name="year" required="">
                                    <?php $year_options = explode('-', $running_year); ?>
                                    <option value="<?php echo $year_options[0]; ?>" <?php if($year == $year_options[0]) echo 'selected'; ?>>
                                      <?php echo $year_options[0]; ?></option>
                                      <option value="<?php echo $year_options[1]; ?>" <?php if($year == $year_options[1]) echo 'selected'; ?>>
                                        <?php echo $year_options[1]; ?></option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>    
                        <div class="col-sm-2">                 
                            <div class="form-group"> 
                                <button class="btn btn-rounded btn-success btn-upper" style="margin-top:20px"><span><?php echo get_phrase('generate');?></span></button>
                            </div>                
                        </div>             
                    </div>          
                    <?php echo form_close(); ?>


                    <?php if ($data != '' && $month != '' && $year != ''): ?>
                        <div class="element-box lined-primary shadow">              
                            <div class="row">                
                                <div class="col-7 text-left">                  
                                    <h5 class="form-header"><?php echo get_phrase('attendance_report');?></h5>
                                </div>                
                            </div>              
                            <div class="table-responsive">                
                                <table class="table table-sm table-lightborder">
                                    <thead>                    
                                        <tr class="text-center" height="50px">
                                            <th class="text-left"> <?php echo get_phrase('student');?></th>  
                                            <?php
                                            $days = date('t', mktime(0, 0, 0, $month, 1, $year));
                                            for ($i = 1; $i <= $days; $i++) {
                                                ?>                    
                                                <th class="text-center"> <?php echo $i; ?> </th>                    
                                            <?php } ?>
                                        </tr> 
                                    </thead>                  
                                    <tbody>                    
                                        <tr>                      
                                            <td><img alt="" src="<?php echo $this->crud_model->get_image_url('student', $explode_data[2]);?>" width="20px" style="border-radius:20px;margin-right:5px;"> <?php echo $this->crud_model->get_name('student', $explode_data[2]);?> </td>    
                                            <?php
                                            $status = 0;
                                            for ($i = 1; $i <= $days; $i++) {
                                                $timestamp = strtotime($i . '-' . $month . '-' . $year);
                                                $this->db->group_by('timestamp');
                                                $attendance = $this->db->get_where('attendance', array('subject_id' => $explode_data[1], 'class_id' => $explode_data[0], 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $explode_data[2]))->result_array();
                                                foreach ($attendance as $row1): 
                                                    $month_dummy = date('d', $row1['timestamp']);
                                                    if ($i == $month_dummy) $status = $row1['status'];
                                                endforeach; ?>
                                                <td class="text-center">
                                                  <?php if ($status == 1) { ?>
                                                    <div class="status-pilli green" data-title="<?php echo get_phrase('present');?>" data-toggle="tooltip"></div>
                                                <?php  } if($status == 2)  { ?>
                                                    <div class="status-pilli red" data-title="<?php echo get_phrase('absent');?>" data-toggle="tooltip"></div>
                                                <?php  } if($status == 3)  { ?>
                                                    <div class="status-pilli yellow" data-title="<?php echo get_phrase('late');?>" data-toggle="tooltip"></div>
                                                <?php  } $status =0;?>
                                            </td>                      
                                        <?php } ?>
                                    </tr>                                      
                                </tbody>                
                            </table>             
                        </div>           
                    </div>  
                <?php endif;?>       
            </div>        
        </div>        
    </div>      
</div>   
</div>
<?php endforeach ?>