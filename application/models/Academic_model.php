<?php

defined('BASEPATH') or exit('No direct script access allowed');

class academic_model extends CI_Model
{
    private $runningYear = '';
    function __construct()
    {
        $this->load->database();
        $this->runningYear = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    }
    function clear_cache()
    {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function countOnlineExams($class_id, $section_id, $subject_id)
    {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id, 'status' => 'published');
        $exams = $this->db->where($match)->get('online_exam')->num_rows();
        return $exams;
    }

    function countHomeworks($class_id, $section_id, $subject_id)
    {
        $homeworks = $this->db->get_where('homework', array('class_id' => $class_id, 'status' => 1, 'section_id' => $section_id, 'subject_id' => $subject_id))->num_rows();
        return $homeworks;
    }

    function countForums($class_id, $section_id, $subject_id)
    {
        $forums = $this->db->get_where('forum', array('class_id' => $class_id, 'section_id' => $section_id, 'post_status' => 1, 'subject_id' => $subject_id))->num_rows();
        return $forums;
    }

    function countMaterial($class_id, $section_id, $subject_id)
    {
        $study_material = $this->db->get_where('document', array('class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id))->num_rows();
        return $study_material;
    }

    function countLive($class_id, $section_id, $subject_id)
    {
        $this->db->where('class_id', $class_id);
        $this->db->where('section_id', $section_id);
        $this->db->where('subject_id', $subject_id);
        $lives = $this->db->get('live')->num_rows();
        return $lives;
    }

    function createLiveClass()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $data['user_type'] = $this->session->userdata('login_type');
        $data['title']             = $this->input->post('title');
        $data['description']       = $this->input->post('description');
        $data['upload_date'] = date('d M. H:iA');
        $data['date'] = $this->input->post('start_date');
        $data['time'] = $this->input->post('start_time');
        $data['publish_date'] = date('Y-m-d H:i:s');
        $data['year'] = $year;
        $data['room']        =  md5(date('d-m-Y H:i:s')) . substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['wall_type'] = 'live';
        $data['class_id']          = $this->input->post('class_id');
        $data['subject_id']         = $this->input->post('subject_id');
        $data['section_id']         = $this->input->post('section_id');
        $data['user_id'] = $this->session->userdata('login_user_id');
        $data['liveType']       = $this->input->post('livetype');
        if ($this->input->post('livetype') == '2') {
            $data['siteUrl']    = $this->input->post('siteUrl');
        }
        $this->db->insert('live', $data);
    }

    function updateLiveClass($id)
    {
        $data['title']              = $this->input->post('title');
        $data['description']        = $this->input->post('description');
        $data['date']               = $this->input->post('start_date');
        $data['time']               = $this->input->post('start_time');
        if ($this->input->post('livetype') == '2') {
            $data['siteUrl']       = $this->input->post('siteUrl');
        }
        $data['wall_type'] = 'live';
        $this->db->where('live_id', $id);
        $this->db->update('live', $data);
    }

    function saveLiveAttendance($liveId)
    {
        $query = $this->db->get_where('attendance_live', array('live_id' => $liveId, 'student_id' => $this->session->userdata('login_user_id')));
        if ($query->num_rows() == 0) {
            $data['student_id']  = $this->session->userdata('login_user_id');
            $data['date']        = date($this->db->get_where('settings', array('type' => 'date_format'))->row()->description) . ' ' . date('H:i A');
            $data['live_id']     = $liveId;
            $data['year']        = $this->runningYear;
            $this->db->insert('attendance_live', $data);
        }
    }


    function saveAttendance($class_id, $section_id, $subject_id, $year, $timestamp, $liveId='')
    {
        $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'section_id' => $section_id, 'year' => $year))->result_array();
            foreach ($students as $row) {
                $status = $this->input->post('status_'. $row['student_id']. '_' .$timestamp );
                if ($status == NULL) {
                    continue;
                }
                if ($liveId AND $row['student_id'] == $this->session->userdata('login_user_id')) {
                    $attn_data['status'] = 1;
                }else{
                    $attn_data['status']     = $status;
                }
                $attn_data['class_id']   = $class_id;
                $attn_data['year']       = $year;
                $attn_data['timestamp']  = $timestamp;
                $attn_data['section_id'] = $section_id;
                $attn_data['subject_id'] = $subject_id;
                $attn_data['teacher_id'] = $this->session->userdata('login_user_id');
                $attn_data['student_id'] = $row['student_id'];
                $attn_data['keterangan'] = $this->input->post('ket_' . $row['student_id'] . '_' . $timestamp).' ('.$this->session->userdata('name').')';
                $attn_data['live_id'] = $liveId;
                $attn_data['date'] = date('H:i');
                $this->db->insert('attendance', $attn_data);
            }
    }

    function updateAttendance($class_id, $section_id, $subject_id, $year, $timestamp, $liveId='')
    {
        $data_attn = $this->db->get_where('attendance', array('class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id, 'year' => $year))->result_array();
        foreach ($data_attn as $row) {
            if ($liveId AND $row['student_id'] == $this->session->userdata('login_user_id')) {
                $attn = 1;
                $keterangan = '-'.'('.$this->session->userdata('name').')';
            }else{
                $attn = $this->input->post('status_'. $row['student_id']. '_' .$timestamp );
                $keterangan = $this->input->post('ket_' . $row['student_id'] . '_' . $timestamp).' ('.$this->session->userdata('name').')';
            }
            $this->db->where('attendance_id', $row['attendance_id']);
            $this->db->update('attendance', array('status' => $attn, 'keterangan' => $keterangan));
        }
    }

    function reviewHomework()
    {
        $id = $this->input->post('answer_id');
        $mark = $this->input->post('mark');
        $comment = $this->input->post('comment');
        $entries = sizeof($mark);
        for ($i = 0; $i < $entries; $i++) {
            $data['mark']    = $mark[$i];
            $data['teacher_comment'] = $comment[$i];
            $this->db->where('id', $id[$i]);
            $this->db->update('deliveries', $data);
        }
    }

    public function deleteDelivery($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('deliveries');
    }

    function sendFileHomework($homeworkCode)
    {
        ini_set('memory_limit', '200M');
        ini_set('upload_max_filesize', '200M');
        ini_set('post_max_size', '200M');
        ini_set('max_input_time', 3600);
        ini_set('max_execution_time', 3600);

        $name = substr(md5(rand(0, 1000000)), 0, 7) . $_FILES["file_name"]["name"];;
        $data['homework_code']   = $homeworkCode;
        $data['student_id']      = $this->session->userdata('login_user_id');
        $data['date']            = date('d-m-Y H:i:s');
        $data['class_id']        = $this->input->post('class_id');
        $data['section_id']      = $this->input->post('section_id');
        $data['file_name']       =  $name;
        $data['student_comment'] = $this->input->post('comment');
        $data['subject_id']      = $this->input->post('subject_id');
        $data['status'] = 1;
        $this->db->insert('deliveries', $data);
        $delivery = $this->db->insert_id();
        include 'class.fileuploader.php';
        $FileUploader = new FileUploader('files', array(
            'uploadDir' => './uploads/homework_delivery/',
            'replaced' => true,
        ));
        $datax = $FileUploader->upload();
        for ($i = 0; $i < count($datax['files']); $i++) {
            $insert_data['file']          = $datax['files'][$i]['name'];
            $insert_data['homework_code'] = $homeworkCode;
            $insert_data['student_id']    = $this->session->userdata('login_user_id');
            $insert_data['delivery_id']   = $delivery;
            $this->db->insert('homework_files', $insert_data);
        }
    }

    public function getOtherLiveClasses($liveId, $classId, $sectionId)
    {
        $this->db->order_by('live_id', 'desc');
        $this->db->where('live_id !=', $liveId);
        $this->db->where('class_id', $classId);
        $this->db->where('section_id', $sectionId);
        $info = $this->db->get('live')->result_array();
        return $info;
    }

    public function getOtherLiveClassesForTeacher($liveId, $classId, $sectionId, $subjectId)
    {
        $this->db->order_by('live_id', 'desc');
        $this->db->where('live_id !=', $liveId);
        $this->db->where('class_id', $classId);
        $this->db->where('section_id', $sectionId);
        $this->db->where('subject_id', $subjectId);
        $info = $this->db->get('live')->result_array();
        return $info;
    }
}

/* End of file academic_model.php */
