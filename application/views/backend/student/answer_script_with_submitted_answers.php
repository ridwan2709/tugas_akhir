<?php
$online_exam_info = $this->db->get_where('online_exam', array('online_exam_id' => $param2))->row();
$result = $online_exam_info->online_exam_id;
$online_exam_result = $this->db->get_where('online_exam_result', array('online_exam_id' => $result,  'student_id' => $this->session->userdata('login_user_id')))->row();
$class = $this->db->get_where('class', array('class_id' => $online_exam_info->class_id))->row()->name;
$section = $this->db->get_where('section', array('section_id' => $online_exam_info->section_id))->row()->name;
$subject = $this->db->get_where('subject', array('subject_id' => $online_exam_info->subject_id))->row()->name;
$questions = $this->db->get_where('question_bank', array('online_exam_id' => $param2))->result_array();
$obtained_mark      = $this->db->get_where('online_exam_result',array('student_id' => $this->session->userdata('login_user_id')))->row()->obtained_mark;
$answers = "answers";
$total_marks = 0;
$submitted_answer_script_details = $this->db->get_where('online_exam_result', array('online_exam_id' => $param2, 'student_id' => $this->session->userdata('login_user_id')))->row_array();
$submitted_answer_script = json_decode($submitted_answer_script_details['answer_script'], true);
foreach ($questions as $question)
  $total_marks += $question['mark'];
?>
<div style="text-align: center;">
  <h3><?php echo get_phrase('results');?>: <b><?php echo $online_exam_result->obtained_mark;?></b></h3><br>
</div>
<div class="back" style="margin-top:-20px;margin-bottom:10px">		
 <a href="<?php echo base_url();?>student/online_exams/<?php echo base64_encode($online_exam_info->class_id.'-'.$online_exam_info->section_id.'-'.$online_exam_info->subject_id);?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
</div>
<?php
$count = 1; foreach ($submitted_answer_script as $row):
$question_type = $this->crud_model->get_question_details_by_id($row['question_bank_id'], 'type');
$question_title = $this->crud_model->get_question_details_by_id($row['question_bank_id'], 'question_title');
$mark = $this->crud_model->get_question_details_by_id($row['question_bank_id'], 'mark');
$submitted_answer = "";
?>
<element class="col-sm-6 col-aligncenter">
  <div class="pipeline white lined-danger">            
    <div class="pipeline-header">
      <h5>
        <b><?php echo $count++;?>. <?php echo $question_type == 'fill_in_the_blanks' ? str_replace('^', '__________', $question_title) : $question_title;?></b>
      </h5>
      <span><?php echo "Bobot Soal";?> : <?php echo $mark;?></span>
    </div>
    <?php if ($question_type == 'multiple_choice'):
      $options_json = $this->crud_model->get_question_details_by_id($row['question_bank_id'], 'options');
      $number_of_options = $this->crud_model->get_question_details_by_id($row['question_bank_id'], 'number_of_options');
      if($options_json != '' || $options_json != null)
        $options = json_decode($options_json);
      else $options = array();
      ?>
      <ul>
        <?php for ($i = 0; $i < $number_of_options; $i++): ?>
          <li><?php echo $options[$i];?></li>
        <?php endfor; ?>
      </ul>
      <?php
      if ($row['submitted_answer'] != "" || $row['submitted_answer'] != null) 
      {
        $submitted_answer = json_decode($row['submitted_answer']);
        $r = '';
        for ($i = 0; $i < count($submitted_answer); $i++) 
        {
          $x = $submitted_answer[$i];
          $r .= $options[$x-1].',';
        }
      } else {
        $submitted_answer = array();
        $r = get_phrase('no_reply');
      }
      ?>
      <i>Jawaban Anda : <br/><strong><?php echo rtrim(trim($r), ',');?></strong></i>
      <br><br><br>
      <?php
      if ($row['correct_answers'] != "" || $row['correct_answers'] != null) {
        $correct_options = json_decode($row['correct_answers']);
        $r = '';
        for ($i = 0; $i < count($correct_options); $i++) {
          $x = $correct_options[$i];
          $r .= $options[$x-1].',';
        }
      } else {
        $correct_options = array();
        $r = get_phrase('none_of_them.');
      }
      ?>
      <!-- <i>Kunci Jawaban : <br/><strong><!?php echo rtrim(trim($r), ',');?>]</strong></i> -->
    <?php elseif($question_type == 'fill_in_the_blanks'):
      if ($row['submitted_answer'] != "" || $row['submitted_answer'] != " ") {
        $submitted_answer = implode(',', json_decode($row['submitted_answer']));
      }
      else{
        $submitted_answer = get_phrase('no_reply');
      }
      $suitable_words   = implode(',', json_decode($row['correct_answers']));
      ?>

      <i>Jawaban Anda : <br/><strong><?php echo $submitted_answer;?></strong></i><br/><br/><br/>
      <!-- <i>Kunci Jawaban : <br/><strong><!?php echo $suitable_words;?>]</strong></i> -->
    <?php elseif($question_type == 'true_false'):
      if ($row['submitted_answer'] != "") {
        $submitted_answer = $row['submitted_answer'];
      }
      else{
        $submitted_answer = get_phrase('no_reply');
      }
      ?>
      <i>Jawaban Anda : <br/><strong><?php echo $submitted_answer;?></strong></i><br><br><br>
      <!-- <i>Kunci Jawaban : <br/><strong><!?php echo $row['correct_answers'];?>]</strong></i> -->
    <?php endif; ?>
  </div>
</element>
<?php endforeach;?>