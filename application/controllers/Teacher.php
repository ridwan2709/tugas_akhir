<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Teacher extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('mail_model');
        $this->load->model('academic_model');
        $this->load->library('session');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function live($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['live_id']  = $param1;
        $page_data['page_name']  = 'live';
        $page_data['page_title'] = get_phrase('live');
        $this->load->view('backend/index', $page_data);
    }

    function meet($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->academic_model->createLiveClass();
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/meet/' . $param2, 'refresh');
        }
        if ($param1 == 'update') {
            $this->academic_model->updateLiveClass($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/meet/' . $param3, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('live_id', $param2);
            $this->db->delete('live');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/meet/' . $param3, 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name']  = 'meet';
        $page_data['page_title'] = get_phrase('meet');
        $this->load->view('backend/index', $page_data);
    }

    function online_exam_result($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name'] = 'online_exam_result';
        $page_data['param2'] = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_title'] = get_phrase('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }

    public function index()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($this->session->userdata('teacher_login') == 1) {
            redirect(base_url() . 'teacher/panel/', 'refresh');
        }
    }

    function manage_online_exam_status($online_exam_id = "", $status = "", $data = '')
    {
        $this->crud_model->manage_online_exam_status($online_exam_id, $status);
        redirect(base_url() . 'teacher/online_exams/' . $data . "/", 'refresh');
    }

    function new_exam($data = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $data;
        $page_data['page_name']  = 'new_exam';
        $page_data['page_title'] = get_phrase('homework_details');
        $this->load->view('backend/index', $page_data);
    }

    function panel()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'panel';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function grados($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'update_labs') {
            $data['la1'] = $this->input->post('la1');
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/marks_upload/' . $this->input->post('exam_id') . "/" . $class_id . "/" . $this->input->post('section_id') . "/" . $param2, 'refresh');
        }
        $page_data['class_id']   = $class_id;
        $page_data['subjects']   = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
        $page_data['page_name']  = 'grados';
        $page_data['page_title'] = get_phrase('classes');
        $this->load->view('backend/index', $page_data);
    }

    function group($param1 = "group_message_home", $param2 = "")
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $max_size = 2097152;
        if ($param1 == "create_group") {
            $this->crud_model->create_group();
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/group/', 'refresh');
        } elseif ($param1 == "delete_group") {
            $this->db->where('group_message_thread_code', $param2);
            $this->db->delete('group_message');
            $this->db->where('group_message_thread_code', $param2);
            $this->db->delete('group_message_thread');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/group/', 'refresh');
        } elseif ($param1 == "edit_group") {
            $this->crud_model->update_group($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/group/', 'refresh');
        } else if ($param1 == 'group_message_read') {
            $page_data['current_message_thread_code'] = $param2;
        } else if ($param1 == 'create_message_group') {
            $page_data['current_message_thread_code'] = $param2;
        } else if ($param1 == 'update_group') {
            $page_data['current_message_thread_code'] = $param2;
        } else if ($param1 == 'send_reply') {
            if (!file_exists('uploads/group_messaging_attached_file/')) {
                $oldmask = umask(0);
                mkdir('uploads/group_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
                if ($_FILES['attached_file_on_messaging']['size'] > $max_size) {
                    $this->session->set_flashdata('error_message', "2MB Allowed");
                    redirect(base_url() . 'teacher/group/group_message_read/' . $param2, 'refresh');
                } else {
                    $file_path = 'uploads/group_messaging_attached_file/' . $_FILES['attached_file_on_messaging']['name'];
                    move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
                }
            }
            $this->crud_model->send_reply_group_message($param2);
            $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
            redirect(base_url() . 'teacher/group/group_message_read/' . $param2, 'refresh');
        }
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group';
        $page_data['page_title']                = get_phrase('message_group');
        $this->load->view('backend/index', $page_data);
    }

    function marks_print_view($student_id  = '', $exam_id = '', $tahun_ajaran = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class_id     = $this->db->get_where('enroll', array(
            'student_id' => $student_id, 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
        ))->row()->class_id;
        $class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['tahun_ajaran']   =   $tahun_ajaran;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/teacher/marks_print_view', $page_data);
    }

    function view_marks($student_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $year =  $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $class_id     = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $year))->row()->class_id;
        $page_data['class_id']   =   $class_id;
        $page_data['page_name']  = 'view_marks';
        $page_data['page_title'] = get_phrase('view_marks');
        $page_data['student_id']   = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function polls($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'response') {
            $data['poll_code'] = $this->input->post('poll_code');
            $data['answer'] = $this->input->post('answer');
            $user = $this->session->userdata('login_user_id');
            $user_type = $this->session->userdata('login_type');
            $data['user'] = $user_type . "-" . $user;
            $data['date'] = date('d M, Y');
            $this->db->insert('poll_response', $data);
        }
    }

    function my_routine()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'my_routine';
        $page_data['page_title'] = get_phrase('teacher_routine');
        $this->load->view('backend/index', $page_data);
    }

    function student_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'send') {
            $parent_id = $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->parent_id;
            $student_name = $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->first_name;
            $parent_phone = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->phone;
            $parent_email = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->email;
            $data['student_id'] = $this->input->post('student_id');
            $data['class_id']   = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');
            $one = 'teacher';
            $two = $this->session->userdata('login_user_id');
            $data['user_id']    = $one . "-" . $two;
            $data['title']      = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['file'] = $_FILES["file"]["name"];
            $data['date'] = date('d M, Y');
            $data['priority'] = $this->input->post('priority');
            $data['status'] = 0;
            $data['code'] = substr(md5(rand(0, 1000000)), 0, 7);
            $this->db->insert('reports', $data);
            // $this->crud_model->students_reports($this->input->post('student_id'), $parent_id);
            move_uploaded_file($_FILES["file"]["tmp_name"], 'uploads/report_files/' . $_FILES["file"]["name"]);
            $name = $this->crud_model->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));
            $notifys['notify'] = "<strong>" . $name . "</strong>" . " " . get_phrase('student_report_notify') . ":" . " " . "<b>" . $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->first_name . "</b>";
            $admins = $this->db->get('admin')->result_array();
            foreach ($admins as $row) {
                $notifys['user_id'] = $row['admin_id'];
                $notifys['user_type'] = "admin";
                $notifys['url'] = "admin/looking_report/" . $data['code'];
                $notifys['date'] = date('d M, Y');
                $notifys['time'] = date('h:i A');
                $notifys['status'] = 0;
                $notifys['original_id'] = $this->session->userdata('login_user_id');
                $notifys['original_type'] = $this->session->userdata('login_type');
                send_notification($notifys, false);
            }
            send_firebase_notification('admin', strip_tags($notifys['notify']));
            $notify = $this->db->get_where('settings', array('type' => 'students_reports'))->row()->description;
            if ($notify == 1) {
                $message = "A behavioral report has been created for " . $student_name;
                $sms_status = $this->db->get_where('settings', array('type' => 'sms_status'))->row()->description;
                if ($sms_status == 'msg91') {
                    $this->crud_model->send_sms_via_msg91($message, $parent_phone);
                } else if ($sms_status == 'twilio') {
                    $this->crud_model->twilio($message, $parent_phone);
                } else if ($sms_status == 'clickatell') {
                    $this->crud_model->clickatell($message, $parent_phone);
                }
            }
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/student_report/', 'refresh');
        }
        if ($param1 == 'response') {
            $data['report_code'] = $this->input->post('report_code');
            $data['message'] = $this->input->post('message');
            $data['date'] = date('d M, Y');
            $data['sender_type'] = $this->session->userdata('login_type');
            $data['sender_id'] = $this->session->userdata('login_user_id');
            $this->db->insert('report_response', $data);
        }
        $page_data['page_name']  = 'student_report';
        $page_data['page_title'] = get_phrase('reports');
        $this->load->view('backend/index', $page_data);
    }

    function view_report($report_code = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['code'] = $report_code;
        $page_data['page_name'] = 'view_report';
        $page_data['page_title'] = get_phrase('report_details');
        $this->load->view('backend/index', $page_data);
    }

    function student_portal($student_id, $param1 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class_id     = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description))->row()->class_id;
        $page_data['page_name']  = 'student_portal';
        $page_data['page_title'] =  get_phrase('student_portal');
        $page_data['student_id'] =  $student_id;
        $page_data['class_id']   =   $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_profile_report($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_profile_report';
        $page_data['page_title'] =  get_phrase('behavior');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function looking_report($report_code = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id'])) {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['code'] = $report_code;
        $page_data['page_name'] = 'looking_report';
        $page_data['page_title'] = get_phrase('report_details');
        $this->load->view('backend/index', $page_data);
    }

    function birthdays()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'birthdays';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }

    function calendar($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'calendar';
        $page_data['page_title'] = get_phrase('calendar');
        $this->load->view('backend/index', $page_data);
    }

    function readNews($param1 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $this->db->limit('1');
        $this->db->where('news_id >', $param1);
        $this->db->select('news_id');
        $news = $this->db->get('news')->result_array();
        $nilaiTerbesar = max($news);
        $newsId = $nilaiTerbesar['news_id'];
        $userId    = $this->session->userdata('login_user_id');
        $loginType = $this->session->userdata('login_type');

        if (!$param1) {
            $data['user_id']       = $userId;
            $data['date']          = date('Y-m-d H:i:s');
            $data['user_type']     = $loginType;
            $data['news_code'] = $newsId;
            $this->db->insert('readed', $data);
        } else {
            $data['news_code'] = $newsId;
            $data['date'] = date('Y-m-d H:i:s');
            $this->db->where('user_id', $userId);
            $this->db->where('user_type', $loginType);
            $this->db->update('readed', $data);
        }


        redirect(base_url() . 'teacher/panel/', 'refresh');
    }

    function news()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'news';
        $page_data['page_title'] = get_phrase('news');
        $this->load->view('backend/index', $page_data);
    }

    function courses($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'update_labs') {
            $class_id = $this->db->get_where('subject', array('subject_id' => $param2))->row()->class_id;
            $data['la1'] = $this->input->post('la1');
            $data['la2'] = $this->input->post('la2');
            $data['la3'] = $this->input->post('la3');
            $data['la4'] = $this->input->post('la4');
            $data['la5'] = $this->input->post('la5');
            $data['la6'] = $this->input->post('la6');
            $data['la7'] = $this->input->post('la7');
            $data['la8'] = $this->input->post('la8');
            $data['la9'] = $this->input->post('la9');
            $data['la10'] = $this->input->post('la10');
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/upload_marks/' . base64_encode($class_id . "-" . $this->input->post('section_id') . "-" . $param2) . '/', 'refresh');
        }
        if ($param1 == 'update') {
            $class_id = $this->db->get_where('subject', array('subject_id' => $param2))->row()->class_id;
            $md5 = md5(date('d-m-y H:i:s'));
            $data['color']   = $this->input->post('color');
            if ($_FILES['userfile']['size'] > 0) {
                $data['icon']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            $data['section_id']   = $this->input->post('section_id');
            $data['about'] = $this->input->post('about');
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/subject_icon/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/cursos/' . base64_encode($class_id . "-" . $this->input->post('section_id') . '-' . $param2) . "/", 'refresh');
        }
        $page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject', array('class_id' => $param1))->result_array();
        $page_data['page_name']  = 'coursess';
        $page_data['page_title'] = get_phrase('subjects');
        $this->load->view('backend/index', $page_data);
    }

    function tab_sheet($class_id = '', $exam_id = '', $section_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['section_id'] = $this->input->post('section_id');
            $page_data['class_id']   = $this->input->post('class_id');
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'teacher/tab_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' . $page_data['section_id'], 'refresh');
            } else {
                redirect(base_url() . 'teacher/tab_sheet/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['section_id'] = $section_id;
        $page_data['class_id']   = $class_id;
        $page_data['page_info']  = 'Exam marks';
        $page_data['page_name']  = 'tab_sheet';
        $page_data['page_title'] = get_phrase('tabulation_sheet');
        $this->load->view('backend/index', $page_data);
    }

    function tab_sheet_print($class_id  = '', $exam_id = '', $section_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id'] = $class_id;
        $page_data['exam_id']  = $exam_id;
        $page_data['section_id']  = $section_id;
        $this->load->view('backend/teacher/tab_sheet_print', $page_data);
    }

    function cuadros($grado = '', $seccion = '', $curso = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['grado']  = $grado;
        $page_data['seccion']  = $seccion;
        $page_data['curso']  = $curso;
        $this->load->view('backend/teacher/cuadros', $page_data);
    }

    function get_class_section($class_id = '')
    {
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
        echo '<option value="">' . get_phrase('select') . '</option>';
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_class_subject($class_id = '')
    {
        $subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
        foreach ($subject as $row) {
            if ($this->session->userdata('login_user_id') == $row['teacher_id']) {
                echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
            }
        }
    }
    function get_class_stundets($section_id = '')
    {
        $this->db->group_by('student_id');
        $students = $this->db->get_where('enroll', array('section_id' => $section_id))->result_array();
        echo '<option value="">' . get_phrase('select') . '</option>';
        foreach ($students as $row) {
            echo '<option value="' . $row['student_id'] . '">' . $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->first_name . " " . $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->last_name  . '</option>';
        }
    }

    function teacher_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teachers';
        $page_data['page_title'] = get_phrase('teachers');
        $this->load->view('backend/index', $page_data);
    }

    function students_area($id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect('login', 'refresh');
        }
        $id = $this->input->post('class_id');
        if ($id == '') {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['page_name']   = 'students_area';
        $page_data['page_title']  = get_phrase('students');
        $page_data['class_id']  = $id;
        $this->load->view('backend/index', $page_data);
    }

    function subject($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject', array(
            'class_id' => $param1,
            'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description
        ))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('subjects');
        $this->load->view('backend/index', $page_data);
    }

    function exam_routine($class_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'viendo_horarios';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = get_phrase('exam_routine');
        $this->load->view('backend/index', $page_data);
    }

    function upload_marks($datainfo = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param2 != "") {
            $page = $param2;
        } else {
            $page = $this->db->get('exam')->first_row()->exam_id;
        }

        $info = base64_decode($datainfo);
        $ex = explode('-', $info);

        $data['exam_id']    = $page;
        $data['class_id']   = $ex[0];
        $data['section_id'] = $ex[1];
        $data['subject_id'] = $ex[2];
        $data['year']       = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $students = $this->db->get_where('enroll', array('class_id' => $data['class_id'], 'section_id' => $data['section_id'], 'year' => $data['year']))->result_array();
        foreach ($students as $row) {
            $verify_data = array(
                'exam_id' => $data['exam_id'], 'class_id' => $data['class_id'], 'section_id' => $data['section_id'],
                'student_id' => $row['student_id'], 'subject_id' => $data['subject_id'], 'year' => $data['year']
            );
            $query = $this->db->get_where('mark', $verify_data);
            if ($query->num_rows() < 1) {
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark', $data);
            }
        }
        $page_data['exam_id'] = $page;
        $page_data['data'] = $datainfo;
        $page_data['page_name']  =   'upload_marks';
        $page_data['page_title'] = get_phrase('upload_marks');
        $this->load->view('backend/index', $page_data);
    }

    function marks_selector()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $data['exam_id']    = $this->input->post('exam_id');
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['year']       = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $students = $this->db->get_where('enroll', array('class_id' => $data['class_id'], 'section_id' => $data['section_id'], 'year' => $data['year']))->result_array();
        foreach ($students as $row) {
            $verify_data = array(
                'exam_id' => $data['exam_id'], 'class_id' => $data['class_id'], 'section_id' => $data['section_id'],
                'student_id' => $row['student_id'], 'subject_id' => $data['subject_id'], 'year' => $data['year']
            );

            $query = $this->db->get_where('mark', $verify_data);
            if ($query->num_rows() < 1) {
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark', $data);
            }
        }
        redirect(base_url() . 'teacher/marks_upload/' . $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'], 'refresh');
    }

    function teacher_update()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        include_once 'src/Google_Client.php';
        include_once 'src/contrib/Google_Oauth2Service.php';
        $clientId = $this->db->get_where('settings', array('type' => 'google_sync'))->row()->description; //Google client ID
        $clientSecret = $this->db->get_where('settings', array('type' => 'google_login'))->row()->description; //Google client secret
        $redirectURL = base_url() . 'auth/sync/'; //Callback URL
        //Call Google API
        $gClient = new Google_Client();
        $gClient->setApplicationName('google');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);
        $authUrl = $gClient->createAuthUrl();
        $output = filter_var($authUrl, FILTER_SANITIZE_URL);

        $page_data['page_name']  = 'teacher_update';
        $page_data['page_title'] =  get_phrase('profile');
        $page_data['output']         = $output;
        $this->load->view('backend/index', $page_data);
    }

    function marks_update($mark_id = '', $class_id = '', $section_id = '', $subject_id = '', $exam_id = '')
    {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $marks_of_students = $this->db->get_where('mark', array('mark_id' => $mark_id))->result_array();
        foreach ($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_' . $row['mark_id']);
            $labouno = $this->input->post('lab_uno_' . $row['mark_id']);
            $labodos = $this->input->post('lab_dos_' . $row['mark_id']);
            $labotres = $this->input->post('lab_tres_' . $row['mark_id']);
            $labocuatro = $this->input->post('lab_cuatro_' . $row['mark_id']);
            $labocinco = $this->input->post('lab_cinco_' . $row['mark_id']);
            $laboseis = $this->input->post('lab_seis_' . $row['mark_id']);
            $labosiete = $this->input->post('lab_siete_' . $row['mark_id']);
            $laboocho = $this->input->post('lab_ocho_' . $row['mark_id']);
            $labonueve = $this->input->post('lab_nueve_' . $row['mark_id']);
            $comment = $this->input->post('comment_' . $row['mark_id']);
            $labototal = $obtained_marks + $labouno + $labodos + $labotres + $labocuatro + $labocinco + $laboseis + $labosiete + $laboocho + $labonueve + $labfinal;
            $this->db->where('mark_id', $row['mark_id']);
            $this->db->update('mark', array(
                'mark_obtained' => $obtained_marks, 'labuno' => $labouno, 'labdos' => $labodos, 'labtres' => $labotres, 'labcuatro' => $labocuatro, 'labcinco' => $labocinco, 'labseis' => $laboseis, 'labsiete' => $labosiete, 'labocho' => $laboocho, 'labnueve' => $labonueve, 'labtotal' => $labototal, 'comment' => $comment
            ));
        }
        $info = base64_encode($class_id . '-' . $section_id . '-' . $subject_id);
        $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
        redirect(base_url() . 'teacher/upload_marks/' . $info . '/' . $exam_id . '/', 'refresh');
    }

    function subject_marks($data = '', $tahun_ajaran)
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $data;
        $page_data['tahun_ajaran'] = $tahun_ajaran;
        $page_data['page_name']    = 'subject_marks';
        $page_data['page_title']   = get_phrase('subject_marks');
        $this->load->view('backend/index', $page_data);
    }

    function files($task = "", $code = "")
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($task == 'download') {
            $user_folder = md5($this->session->userdata('login_user_id'));
            $file_name = $this->db->get_where('file', array('file_id' => $code))->row()->name;
            $folder = $this->db->get_where('file', array('file_id' => $code))->row()->folder_token;
            $folder_name = $this->db->get_where('folder', array('token' => $folder))->row()->name;
            $this->load->helper('download');
            if ($folder != "") {
                $data = file_get_contents("uploads/users/teacher/" . $user_folder . "/" . $folder_name . '/' . $file_name);
            } else {
                $data = file_get_contents("uploads/users/teacher/" . $user_folder . '/' . $file_name);
            }
            $name = $file_name;
            force_download($name, $data);
        }
        if ($task == 'create_folder') {
            $folder = md5($this->session->userdata('login_user_id'));
            if (!file_exists('uploads/users/' . $this->session->userdata('login_type') . '/' . $folder)) {
                mkdir('uploads/users/' . $this->session->userdata('login_type') . '/' . $folder, 0777, true);
            }
            if (!file_exists('uploads/users/' . $this->session->userdata('login_type') . '/' . $folder . '/' . $this->input->post('name'))) {
                $data['name'] = $this->input->post('name');
                $data['user_id'] = $this->session->userdata('login_user_id');
                $data['user_type'] = 'teacher';
                $data['token'] = base64_encode($data['name']);
                $data['date'] = date('d M, Y H:iA');
                $this->db->insert('folder', $data);
                mkdir('uploads/users/' . $this->session->userdata('login_type') . '/' . $folder . '/' . $data['name'], 0777, true);
                $this->session->set_flashdata('flash_message', get_phrase('successfully_uploaded'));
                redirect(base_url() . 'teacher/folders/', 'refresh');
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('folder_already_exist'));
                redirect(base_url() . 'teacher/files/', 'refresh');
            }
        }
        if ($task == 'delete') {
            $user_folder = md5($this->session->userdata('login_user_id'));

            $file_name = $this->db->get_where('file', array('file_id' => $code))->row()->name;
            $folder = $this->db->get_where('file', array('file_id' => $code))->row()->folder_token;
            $folder_name = $this->db->get_where('folder', array('token' => $folder))->row()->name;
            if ($folder != "") {
                unlink("uploads/users/teacher/" . $user_folder . "/" . $folder_name . '/' . $file_name);
            } else {
                unlink("uploads/users/teacher/" . $user_folder . '/' . $file_name);
            }
            $this->db->where('file_id', $code);
            $this->db->delete('file');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/all/');
        }
        $data['page_name']              = 'files';
        $data['page_title']             = get_phrase('your_files');
        $this->load->view('backend/index', $data);
    }

    function folders($task = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($task == 'update') {
            $user_folder = md5($this->session->userdata('login_user_id'));
            $old_folder = $this->db->get_where('folder', array('folder_id' => $param2))->row()->name;
            rename('uploads/users/teacher/' . $user_folder . '/' . $old_folder, 'uploads/users/teacher/' . $user_folder . '/' . $this->input->post('name'));

            $data['name'] = $this->input->post('name');
            $data['token'] = base64_encode($this->input->post('name'));
            $this->db->where('folder_id', $param2);
            $this->db->update('folder', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/folders/', 'refresh');
        }
        if ($task == 'delete') {
            $user_folder = md5($this->session->userdata('login_user_id'));
            $folder = $this->db->get_where('folder', array('folder_id' => $param2))->row()->name;
            $this->deleteDir('uploads/users/teacher/' . $user_folder . '/' . $folder);
            $this->db->where('folder_id', $param2);
            $this->db->delete('folder');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/folders/', 'refresh');
        }
        $page_data['page_title']             = get_phrase('folders');
        $page_data['token']   = $task;
        $page_data['page_name']   = 'folders';
        $this->load->view('backend/index', $page_data);
    }

    function deleteDir($path)
    {
        return is_file($path) ? @unlink($path) :
            array_map(__FUNCTION__, glob($path . '/*')) == @rmdir($path);
    }

    function marks_get_subject($class_id = '')
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/teacher/marks_get_subject', $page_data);
    }

    function homework($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
            $year =  $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['time_end'] = $this->input->post('time_end');
            $data['date_end'] = $this->input->post('date_end');
            $data['type'] = $this->input->post('type');
            $data['wall_type'] = 'homework';
            $data['publish_date'] = date('Y-m-d H:i:s');
            $data['upload_date'] = date('d M. H:iA');
            $data['year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $data['status'] = $this->input->post('status');
            $data['class_id'] = $this->input->post('class_id');
            $data['file_name']         = $_FILES["file_name"]["name"];
            $data['section_id'] = $this->input->post('section_id');
            $data['user'] = $this->session->userdata('login_type');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['uploader_type']  =   $this->session->userdata('login_type');
            $data['uploader_id']  =   $this->session->userdata('login_user_id');
            $data['homework_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
            $this->db->insert('homework', $data);
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/homework/" . $_FILES["file_name"]["name"]);

            $homework_code = $data['homework_code'];
            $class_id = $this->input->post('class_id');
            $subject_id = $this->input->post('subject_id');
            $section_id = $this->input->post('section_id');
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $notify['notify'] = "<strong>" . $this->crud_model->get_name('teacher', $this->session->userdata('login_user_id')) . "</strong>" . " " . get_phrase('new_homework_notify') . " <b>" . $this->input->post('title') . "</b>";
            $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $year))->result_array();
            foreach ($students as $row) {
                $notify['user_id'] = $row['student_id'];
                $notify['user_type'] = 'student';
                $notify['url'] = "student/homeworkroom/" . $homework_code;
                $notify['date'] = date('d M, Y');
                $notify['year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
                $notify['class_id'] = $this->input->post('class_id');
                $notify['subject_id'] = $this->input->post('subject_id');
                $notify['time'] = date('h:i A');
                $notify['status'] = 0;
                $notify['original_id'] = $this->session->userdata('login_user_id');
                $notify['original_type'] = $this->session->userdata('login_type');
                send_notification($notify, false);
            }
            send_firebase_notification('student', strip_tags($notify['notify']));

            $this->crud_model->send_homework_notify();
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/homeworkroom/' . $homework_code, 'refresh');
        }
        if ($param1 == 'update') {
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['time_end'] = $this->input->post('time_end');
            $data['date_end'] = $this->input->post('date_end');
            $data['user'] = $this->session->userdata('login_type');
            $data['status'] = $this->input->post('status');
            $data['type'] = $this->input->post('type');
            $this->db->where('homework_code', $param2);
            $this->db->update('homework', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/homework_edit/' . $param2, 'refresh');
        }
        if ($param1 == 'review') {
            $this->academic_model->reviewHomework();
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/homework_details/' . $param2, 'refresh');
        }
        if ($param1 == 'single') {
            $student_id = $this->db->get_where('deliveries', array('id' => $this->input->post('id')))->row()->student_id;
            $code = $this->db->get_where('deliveries', array('id' => $this->input->post('id')))->row()->homework_code;
            $title = $this->db->get_where('homework', array('homework_code' => $code))->row()->title;

            $data['teacher_comment'] = $this->input->post('comment');
            $data['mark'] = $this->input->post('mark');
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('deliveries', $data);

            $notify['notify'] = "<strong>" . $this->crud_model->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id')) . "</strong>" . " " . get_phrase('homework_rated') . " <b>" . $title . ".</b>";
            $notify['user_id'] = $student_id;
            $notify['user_type'] = 'student';
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['url'] = "student/homeworkroom/" . $code;
            $notify['status'] = 0;
            $notify['original_id']   = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify);


            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/single_homework/' . $this->input->post('id'), 'refresh');
        }
        if ($param1 == 'edit') {
            $this->crud_model->update_homework($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/homeworkroom/edit/' . $param2, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud_model->delete_homework($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/homework/' . $param3 . "/", 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'homework';
        $page_data['page_title'] = get_phrase('homework');
        $this->load->view('backend/index', $page_data);
    }
    function delete_delivery($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 != '') {
            $this->academic_model->deleteDelivery($param1);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/homework_details/' . $param2 . '/', 'refresh');
        }
    }

    function notify($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'send_emails') {
            $this->mail_model->teacherSendEmail();

            $this->session->set_flashdata('flash_message', get_phrase('sent_successfully'));
            redirect(base_url() . 'teacher/notify/', 'refresh');
        }
        if ($param1 == 'sms') {
            $sms_status = $this->db->get_where('settings', array('type' => 'sms_status'))->row()->description;
            $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $class_id   =   $this->input->post('class_id');
            $section_id   =   $this->input->post('section_id');
            $receiver   =   $this->input->post('receiver');
            $users = $this->db->get_where('enroll', array('class_id' => $class_id, 'section_id' => $section_id, 'year' => $year))->result_array();
            $message = $this->input->post('message');
            foreach ($users as $row) {
                if ($receiver == 'student') {
                    $phones = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->phone;
                } else {
                    $this->db->group_by('parent_id');
                    $parent_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id;
                    $phones = $this->db->get_where('parent', array('parent_id' => $row['parent_id']))->row()->phone;
                }
                if ($sms_status == 'twilio') {
                    $this->crud_model->twilio($message, $phones);
                } else if ($sms_status == 'clickatell') {
                    $this->crud_model->clickatell($message, $phones);
                } else if ($sms_status == 'msg91') {
                    $this->crud_model->send_sms_via_msg91($message, $phones);
                }
            }
            $this->session->set_flashdata('flash_message', get_phrase('sent_successfully'));
            redirect(base_url() . 'teacher/notify/', 'refresh');
        }
        $page_data['page_name']  = 'notify';
        $page_data['page_title'] = get_phrase('notifications');
        $this->load->view('backend/index', $page_data);
    }

    function subject_dashboard($data = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_dashboard';
        $page_data['page_title']   = get_phrase('subject_marks');
        $this->load->view('backend/index', $page_data);
    }

    function cursos($class_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id']  = $class_id;
        $page_data['page_name']  = 'cursos';
        $page_data['page_title'] = get_phrase('subjects');
        $this->load->view('backend/index', $page_data);
    }

    function upload_file($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['token']  = $param1;
        $page_data['page_name']  = 'upload_file';
        $page_data['page_title'] = get_phrase('library');
        $this->load->view('backend/index', $page_data);
    }

    function recent()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  =  'recent';
        $page_data['page_title'] =  get_phrase('recent_files');
        $this->load->view('backend/index', $page_data);
    }

    function all($class_id = '', $section_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']   = 'all';
        $page_data['page_title']  = get_phrase('my_files');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine($class_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'class_routine';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = get_phrase('Class-Routine');
        $this->load->view('backend/index', $page_data);
    }

    function my_account($param1 = "", $page_id = "")
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
      
        include_once 'src/Google_Client.php';
        include_once 'src/contrib/Google_Oauth2Service.php';
        $clientId = $this->db->get_where('settings', array('type' => 'google_sync'))->row()->description; //Google client ID
        $clientSecret = $this->db->get_where('settings', array('type' => 'google_login'))->row()->description; //Google client secret
        $redirectURL = base_url() . 'auth/sync/'; //Callback URL
        //Call Google API
        $gClient = new Google_Client();
        $gClient->setApplicationName('google');
        $gClient->setClientId($clientId);
        $gClient->setClientSecret($clientSecret);
        $gClient->setRedirectUri($redirectURL);
        $google_oauthV2 = new Google_Oauth2Service($gClient);
        $authUrl = $gClient->createAuthUrl();
        $output = filter_var($authUrl, FILTER_SANITIZE_URL);
        if ($param1 == 'remove_facebook') {
            $data['fb_token']    =  "";
            $data['fb_id']    =  "";
            $data['fb_photo']    =  "";
            $data['fb_name']       =  "";
            $data['femail'] = "";
            unset($_SESSION['access_token']);
            unset($_SESSION['userData']);
            $this->db->where('teacher_id', $this->session->userdata('login_user_id'));
            $this->db->update('teacher', $data);
            $this->session->set_flashdata('flash_message', get_phrase('facebook_delete'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if ($param1 == '1') {
            $this->session->set_flashdata('error_message', get_phrase('google_err'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if ($param1 == '3') {
            $this->session->set_flashdata('error_message', get_phrase('facebook_err'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if ($param1 == '2') {
            $this->session->set_flashdata('flash_message', get_phrase('google_true'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if ($param1 == '4') {
            $this->session->set_flashdata('flash_message', get_phrase('facebook_true'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if ($param1 == 'remove_google') {
            include_once 'src/Google_Client.php';
            include_once 'src/contrib/Google_Oauth2Service.php';
            $gClient = new Google_Client();
            $gClient->setApplicationName('google');
            $gClient->setClientId($clientId);
            $gClient->setClientSecret($clientSecret);
            $gClient->setRedirectUri($redirectURL);
            $google_oauthV2 = new Google_Oauth2Service($gClient);
            $data['g_oauth'] = "";
            $data['g_fname'] = "";
            $data['g_lname'] = "";
            $data['g_picture'] = "";
            $data['link'] = "";
            $data['g_email'] = "";
            $this->db->where('teacher_id', $this->session->userdata('login_user_id'));
            $this->db->update('teacher', $data);

            unset($_SESSION['token']);
            unset($_SESSION['userData']);
            $gClient->revokeToken();
            $this->session->set_flashdata('flash_message', get_phrase('google_delete'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if ($param1 == 'update_profile') {
            $md5 = md5(date('d-m-y H:i:s'));
            $data['first_name']        = $this->input->post('first_name');
            $data['last_name']        = $this->input->post('last_name');
            $data['email']       = $this->input->post('email');
            $data['phone']       = $this->input->post('phone');
            $data['idcard']      = $this->input->post('idcard');
            $data['birthday']    = $this->input->post('birthday');
            $data['address']     = $this->input->post('address');
            $data['username']     = $this->input->post('username');
            $data['tempatLahir']     = $this->input->post('tempatLahir');
            $data['pendidikanTerakhir'] = $this->input->post('pendidikanTerakhir');
            if ($_FILES['userfile']['name'] != "") {
                $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            if ($this->input->post('password') != "") {
                $data['password']     = sha1($this->input->post('password'));
            }
            $this->db->where('teacher_id', $this->session->userdata('login_user_id'));
            $this->db->update('teacher', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            redirect(base_url() . 'teacher/teacher_update/', 'refresh');
        }

        $data['page_name']              = 'my_account';
        $data['output']         = $output;
        $data['page_title']             = get_phrase('profile');
        $this->load->view('backend/index', $data);
    }

    function manage_attendance($class_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        $page_data['page_name']  =  'manage_attendance';
        $page_data['class_id']   =  $class_id;
        $page_data['page_title'] =  get_phrase('attendance');
        $this->load->view('backend/index', $page_data);
    }

    function manage_attendance_view($param1 = '', $class_id = '', $section_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $originalDate = $this->input->post('timestamp');
        $newDate = date("d-m-Y", strtotime($originalDate));
        $data['timestamp']  = strtotime($newDate);
        $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        $page_data['data'] = $param1;
        $page_data['class_id'] = $class_id;
        $page_data['page_name'] = 'manage_attendance_view';
        $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('attendance') . ' ' . $class_name . ' : ' . get_phrase('section') . ' ' . $section_name;
        $this->load->view('backend/index', $page_data);
    }

    function attendance_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $originalDate = $this->input->post('timestamp');
        $newDate = date("d-m-Y", strtotime($originalDate));
        $data['timestamp']  = strtotime($newDate);
        $data['section_id'] = $this->input->post('section_id');
        $query = $this->db->get_where('attendance', array(
            'class_id' => $data['class_id'],
            'section_id' => $data['section_id'],
            'year' => $data['year'],
            'timestamp' => $data['timestamp']
        ));
        if ($query->num_rows() < 1) {
            $students = $this->db->get_where('enroll', array('class_id' => $data['class_id'], 'section_id' => $data['section_id'], 'year' => $data['year']))->result_array();
            foreach ($students as $row) {
                $attn_data['class_id']   = $data['class_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['section_id'] = $data['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance', $attn_data);
            }
        }
        redirect(base_url() . 'teacher/manage_attendance_view/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['timestamp'], 'refresh');
    }

    function attendance_update($class_id = '', $section_id = '', $timestamp = '')
    {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $attendance_of_students = $this->db->get_where('attendance', array('class_id' => $class_id, 'section_id' => $section_id, 'year' => $running_year, 'timestamp' => $timestamp))->result_array();
        foreach ($attendance_of_students as $row) {
            $attendance_status = $this->input->post('status_' . $row['attendance_id']);
            $this->db->where('attendance_id', $row['attendance_id']);
            $this->db->update('attendance', array('status' => $attendance_status));
        }
        $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
        redirect(base_url() . 'teacher/manage_attendance_view/' . $class_id . '/' . $section_id . '/' . $timestamp, 'refresh');
    }
    function attendance_insert($timestamp = '', $param = '')
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $subject_id = $this->input->post('subject_id');
        $student_id = $this->input->post('student_id');

        $query = $this->db->get_where('attendance', array(
            'class_id' => $class_id,
            'section_id' => $section_id,
            'subject_id' => $subject_id,
            'year' => $year,
            'timestamp' => $timestamp,
            'student_id' => $student_id,
            'teacher_id' => $this->session->userdata('login_user_id')
        ))->result();

        if (!$query) {
            $this->academic_model->saveAttendance($class_id, $section_id, $subject_id, $year, $timestamp);
        } else {
            $this->academic_model->updateAttendance($class_id, $section_id, $subject_id, $year, $timestamp);
        }
        redirect(base_url() . 'teacher/manage_attendance_view/' . $param);
    }

    function study_material($task = "", $document_id = "", $data = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($task == "create") {
            $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $this->crud_model->save_study_material_info();
            $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $year))->result_array();
            $this->session->set_flashdata('flash_message', get_phrase('successfully_uploaded'));
            redirect(base_url() . 'teacher/study_material/' . $document_id . "/", 'refresh');
        }
        if ($task == "update") {
            $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $id = $this->input->post('document_id');
            $this->crud_model->update_study_material_info($id);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/study_material/' . $document_id . "/", 'refresh');
        }
        if ($task == "delete") {
            $this->crud_model->delete_study_material_info($document_id);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/study_material/' . $data . "/");
        }
        $page_data['data'] = $task;
        $page_data['page_name']              = 'study_material';
        $page_data['page_title']             = get_phrase('study_material');
        $this->load->view('backend/index', $page_data);
    }

    function library($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        $id = $this->input->post('class_id');
        if ($id == '') {
            $page_data['book'] = $this->db->get('book')->result_array();
        } else {
            $page_data['book'] = $this->db->get_where('book', array('class_id' => $id))->result_array();
        }
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = get_phrase('library');
        $this->load->view('backend/index', $page_data);
    }

    function query($search_key = '')
    {
        if ($_POST) {
            redirect(base_url() . 'teacher/search_results?query=' . base64_encode($this->input->post('search_key')), 'refresh');
        }
    }

    function search_results()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['query'] == "") {
            redirect(base_url(), 'refresh');
        }
        $page_data['search_key'] =  $_GET['query'];
        $page_data['page_name']  =  'search_results';
        $page_data['page_title'] =  get_phrase('search_results');
        $this->load->view('backend/index', $page_data);
    }

    function notifications()
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']  =  'notifications';
        $page_data['page_title'] =  get_phrase('your_notifications');
        $this->load->view('backend/index', $page_data);
    }

    function message($param1 = 'message_home', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/messages/" . $_FILES["file_name"]["name"]);
            $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
            redirect(base_url() . 'teacher/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/messages/" . $_FILES["file_name"]["name"]);
            $this->session->set_flashdata('flash_message', get_phrase('reply_sent'));
            redirect(base_url() . 'teacher/message/message_read/' . $param2, 'refresh');
        }
        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;
            $this->crud_model->mark_thread_messages_read($param2);
        }
        $page_data['infouser'] = $param2;
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messages');
        $this->load->view('backend/index', $page_data);
    }

    function request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == "create") {
            $this->crud_model->permission_request();
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/request/" . $_FILES["file_name"]["name"]);

            $notify['notify'] = "<strong>" .  $this->crud_model->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id')) . "</strong>" . " " . get_phrase('absense_teacher');
            $admins = $this->db->get('admin')->result_array();
            foreach ($admins as $row) {
                $notify['user_id'] = $row['admin_id'];
                $notify['user_type'] = "admin";
                $notify['url'] = "admin/request";
                $notify['date'] = date('d M, Y');
                $notify['time'] = date('h:i A');
                $notify['status'] = 0;
                $notify['original_id'] = $this->session->userdata('login_user_id');
                $notify['original_type'] = $this->session->userdata('login_type');
                send_notification($notify, false);
            }
            send_firebase_notification('admin', strip_tags($notify['notify']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/request', 'refresh');
        }

        $data['page_name']  = 'request';
        $data['page_title'] = get_phrase('permissions');
        $this->load->view('backend/index', $data);
    }

    function alatdanbahan($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == "create") {
            $this->crud_model->alatdanbahan();
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/request/" . $_FILES["file_name"]["name"]);

            $notify['notify'] = "<strong>" .  $this->crud_model->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id')) . "</strong>" . " " . 'telah mengajukan biaya, alat dan bahan';
            $admins = $this->db->get('admin')->result_array();
            foreach ($admins as $row) {
                $notify['user_id'] = $row['admin_id'];
                $notify['user_type'] = "admin";
                $notify['url'] = "admin/alatdanbahan";
                $notify['date'] = date('d M, Y');
                $notify['time'] = date('h:i A');
                $notify['status'] = 0;
                $notify['original_id'] = $this->session->userdata('login_user_id');
                $notify['original_type'] = $this->session->userdata('login_type');
                send_notification($notify, false);
            }
            send_firebase_notification('admin', strip_tags($notify['notify']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/alatdanbahan', 'refresh');
        }

        $data['page_name']  = 'alatdanbahan';
        $data['page_title'] = 'Alat dan Bahan';
        $this->load->view('backend/index', $data);
    }

    function homeworkroom($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'file') {
            $page_data['room_page']    = 'homework_file';
            $page_data['homework_code'] = $param2;
        } else if ($param1 == 'details') {
            $page_data['room_page'] = 'homework_details';
            $page_data['homework_code'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['room_page'] = 'homework_edit';
            $page_data['homework_code'] = $param2;
        }

        $page_data['homework_code'] =   $param1;
        $page_data['page_name']   = 'homework_room';
        $page_data['page_title']  = get_phrase('homework');
        $this->load->view('backend/index', $page_data);
    }

    function homework_file($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $homework_code = $this->db->get_where('homework', array('homework_id'))->row()->homework_code;
        if ($param1 == 'upload') {
            $this->crud_model->upload_homework_file($param2);
        } else if ($param1 == 'download') {
            $this->crud_model->download_homework_file($param2);
        } else if ($param1 == 'delete') {
            $this->crud_model->delete_homework_file($param2);
            redirect(base_url() . 'teacher/homeworkroom/details/' . $homework_code, 'refresh');
        }
    }

    function forum($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
            $year =  $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['class_id'] = $this->input->post('class_id');
            $data['type'] = $this->session->userdata('login_type');
            $data['publish_date'] = date('Y-m-d H:i:s');
            $data['upload_date'] = date('d M. H:iA');
            $data['wall_type'] = "forum";
            $data['section_id'] = $this->input->post('section_id');
            if ($this->input->post('post_status') != "1") {
                $data['post_status'] = 0;
            } else {
                $data['post_status'] = $this->input->post('post_status');
            }
            $data['timestamp'] = date("d M, Y H:iA");
            $data['subject_id'] = $this->input->post('subject_id');
            $data['file_name']         = $_FILES["userfile"]["name"];
            $data['teacher_id']  =   $this->session->userdata('login_user_id');
            $data['post_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
            $this->db->insert('forum', $data);

            $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $year))->result_array();
            foreach ($students as $row) {
                $notify['notify'] = "<strong>" . $this->crud_model->get_name('teacher', $this->session->userdata('login_user_id')) . "</strong>" . " " . get_phrase('create_a_discussion_forum');
                $notify['user_id'] = $row['student_id'];
                $notify['user_type'] = 'student';
                $notify['type'] = 'forum';
                $notify['url'] = "student/forumroom/" . $data['post_code'];
                $notify['date'] = date('d M, Y');
                $notify['year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
                $notify['class_id'] = $this->input->post('class_id');
                $notify['subject_id'] = $this->input->post('subject_id');
                $notify['time'] = date('h:i A');
                $notify['status'] = 0;
                $notify['original_id'] = $this->session->userdata('login_user_id');
                $notify['original_type'] = $this->session->userdata('login_type');
                send_notification($notify, false);
            }
            send_firebase_notification('student', strip_tags($notify['notify']));
            move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/forum/" . $_FILES["userfile"]["name"]);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/forum/' . $param2 . "/", 'refresh');
        }
        if ($param1 == 'update') {
            if ($this->input->post('post_status') != "1") {
                $data['post_status'] = 0;
            } else {
                $data['post_status'] = $this->input->post('post_status');
            }
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['type'] = $this->session->userdata('login_type');
            $data['timestamp'] = date("d M,Y H:iA");
            $data['teacher_id']  =   $this->session->userdata('login_user_id');
            $this->db->where('post_code', $param2);
            $this->db->update('forum', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/edit_forum/' . $param2, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud_model->delete_post($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/forum/' . $param3 . "/", 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'forum';
        $page_data['page_title'] = get_phrase('forum');
        $this->load->view('backend/index', $page_data);
    }

    function single_homework($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['answer_id'] = $param1;
        $page_data['page_name'] = 'single_homework';
        $page_data['page_title'] = get_phrase('homework');
        $this->load->view('backend/index', $page_data);
    }

    function create_online_exam($info = '')
    {
        $year =  $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $data['publish_date'] = date('Y-m-d H:i:s');
        $data['uploader_type'] = $this->session->userdata('login_type');
        $data['wall_type'] = "exam";
        $data['uploader_id'] = $this->session->userdata('login_user_id');
        $data['upload_date'] = date('d M. H:iA');
        $data['password']    = $this->input->post('password');
        $data['code']  = substr(md5(uniqid(rand(), true)), 0, 7);
        $data['title'] = html_escape($this->input->post('exam_title'));
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['minimum_percentage'] = html_escape($this->input->post('minimum_percentage'));
        $data['instruction'] = html_escape($this->input->post('instruction'));
        $data['exam_date'] = strtotime(html_escape($this->input->post('exam_date')));
        $data['time_start'] = html_escape($this->input->post('time_start') . ":00");
        $data['time_end'] = html_escape($this->input->post('time_end') . ":00");
        $data['duration'] = ($this->input->post('duration')) ? html_escape($this->input->post('duration')) : 0;
        $data['running_year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $this->db->insert('online_exam', $data);

        $notifys['notify'] = "<strong>" . $this->crud_model->get_name('teacher', $this->session->userdata('login_user_id')) . "</strong>" . " " . get_phrase('add_a_new_online_exam_titled') . " <b>" . $this->input->post('exam_title') . "</b>";
        $admins = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $year))->result_array();
        foreach ($admins as $row) {
            $notifys['user_id'] = $row['student_id'];
            $notifys['user_type'] = "student";
            $notifys['url'] = "student/online_exams";
            $notifys['date'] = date('d M, Y');
            $notifys['time'] = date('h:i A');
            $notifys['class_id'] = $this->input->post('class_id');
            $notifys['subject_id'] = $this->input->post('subject_id');
            $notifys['type'] = "exam";
            $notifys['status'] = 0;
            $notifys['year'] = $year;
            $notifys['original_id'] = $this->session->userdata('login_user_id');
            $notifys['original_type'] = $this->session->userdata('login_type');
            send_notification($notifys, false);
        }
        send_firebase_notification('admin', strip_tags($notifys['notify']));
        $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
        redirect(base_url() . 'admin/online_exams/' . $info . "/", 'refresh');
    }

    function manage_exams($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('online_exam_id', $param2);
            $this->db->delete('online_exam');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/online_exams/' . $param3 . "/", 'refresh');
        }
    }

    function homework_details($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['homework_code'] = $param1;
        $page_data['page_name']  = 'homework_details';
        $page_data['page_title'] = get_phrase('homework_details');
        $this->load->view('backend/index', $page_data);
    }

    function update_online_exam_question($question_id = "", $task = "", $online_exam_id = "")
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(site_url('login'), 'refresh');
        $online_exam_id = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $type = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->type;
        if ($task == "update") {
            if ($type == 'multiple_choice') {
                $this->crud_model->update_multiple_choice_question($question_id);
            } elseif ($type == 'true_false') {
                $this->crud_model->update_true_false_question($question_id);
            } elseif ($type == 'fill_in_the_blanks') {
                $this->crud_model->update_fill_in_the_blanks_question($question_id);
            }
            redirect(base_url() . 'teacher/examroom/' . $online_exam_id, 'refresh');
        }
        $page_data['question_id'] = $question_id;
        $page_data['page_name'] = 'update_online_exam_question';
        $page_data['page_title'] = get_phrase('update_questions');
        $this->load->view('backend/index', $page_data);
    }

    function online_exams($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'edit') {
            if ($this->input->post('class_id') > 0 && $this->input->post('section_id') > 0 && $this->input->post('subject_id') > 0) {
                $this->crud_model->update_online_exam();
                $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
                redirect(base_url() . 'teacher/exam_edit/' . $this->input->post('online_exam_id'), 'refresh');
            } else {
                $this->session->set_flashdata('error_message', get_phrase('error'));
                redirect(base_url() . 'teacher/exam_edit/' . $this->input->post('online_exam_id'), 'refresh');
            }
        }
        if ($param1 == 'questions') {
            $this->crud_model->add_questions();
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/exam_questions/' . $param2, 'refresh');
        }
        if ($param1 == 'delete_questions') {
            $this->db->where('question_id', $param2);
            $this->db->delete('questions');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/exam_questions/' . $param3, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud_model->delete_exam($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/online_exams/', 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'online_exams';
        $page_data['page_title'] = get_phrase('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    function examroom($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']   = 'exam_room';
        $page_data['online_exam_id']  = $param1;
        $page_data['page_title']  = get_phrase('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    function exam_questions($exam_code = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['exam_code'] = $exam_code;
        $page_data['page_name'] = 'exam_questions';
        $page_data['page_title'] = get_phrase('exam_questions');
        $this->load->view('backend/index', $page_data);
    }

    function delete_question_from_online_exam($question_id = '')
    {
        $online_exam_id = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $this->crud_model->delete_question_from_online_exam($question_id);
        $this->session->set_flashdata('flash_message', "Eliminada");
        redirect(base_url() . 'teacher/examroom/' . $online_exam_id, 'refresh');
    }

    function manage_online_exam_question($online_exam_id = "", $task = "", $type = "")
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');

        if ($task == 'add') {
            if ($type == 'multiple_choice') {
                $this->crud_model->add_multiple_choice_question_to_online_exam($online_exam_id);
            } elseif ($type == 'true_false') {
                $this->crud_model->add_true_false_question_to_online_exam($online_exam_id);
            } elseif ($type == 'fill_in_the_blanks') {
                $this->crud_model->add_fill_in_the_blanks_question_to_online_exam($online_exam_id);
            }
            redirect(base_url() . 'teacher/examroom/' . $online_exam_id, 'refresh');
        }
    }

    function manage_multiple_choices_options()
    {
        $page_data['number_of_options'] = $this->input->post('number_of_options');
        $this->load->view('backend/teacher/manage_multiple_choices_options', $page_data);
    }

    function load_question_type($type = '', $online_exam_id = '')
    {
        $page_data['question_type'] = $type;
        $page_data['online_exam_id'] = $online_exam_id;
        $this->load->view('backend/teacher/online_exam_add_' . $type, $page_data);
    }

    function exam_results($exam_code = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['online_exam_id'] = $exam_code;
        $page_data['page_name'] = 'exam_results';
        $page_data['page_title'] = get_phrase('exams_results');
        $this->load->view('backend/index', $page_data);
    }

    function exam_edit($exam_code = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['online_exam_id'] = $exam_code;
        $page_data['page_name'] = 'exam_edit';
        $page_data['page_title'] = get_phrase('update_exam');
        $this->load->view('backend/index', $page_data);
    }

    function homework_edit($homework_code = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['homework_code'] = $homework_code;
        $page_data['page_name'] = 'homework_edit';
        $page_data['page_title'] = get_phrase('homework');
        $this->load->view('backend/index', $page_data);
    }

    function forumroom($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'comment') {
            $page_data['room_page']    = 'comments';
            $page_data['post_code'] = $param2;
        } else if ($param1 == 'posts') {
            $page_data['room_page'] = 'post';
            $page_data['post_code'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['room_page'] = 'post_edit';
            $page_data['post_code'] = $param2;
        }

        $page_data['page_name']   = 'forum_room';
        $page_data['post_code']   = $param1;
        $page_data['page_title']  = get_phrase('forum');
        $this->load->view('backend/index', $page_data);
    }

    function notification($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('notification');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/notifications/', 'refresh');
        }
        if ($param1 == 'delete_all') {
            $this->db->where('user_type', $this->session->userdata('login_type'));
            $this->db->where('user_id', $this->session->userdata('login_user_id'));
            $this->db->delete('notification');
            redirect(base_url() . 'teacher/notifications/', 'refresh');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
        }
    }

    function edit_forum($code = '')
    {
        $page_data['page_name']  = 'edit_forum';
        $page_data['page_title'] = get_phrase('update_forum');
        $page_data['code']   = $code;
        $this->load->view('backend/index', $page_data);
    }

    function forum_message($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') {
            $this->crud_model->create_post_message($this->input->post('post_code'));
        }
    }

    function karakter_building($week = null)
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $data['result'] = $this->crud_model->lk_lpa1($week);
        $data['result2'] = $this->crud_model->lk_lpa2($week);
        $data['sqlLK1'] = $this->crud_model->sql_lk1($week);
        $data['sqlLK2'] = $this->crud_model->sql_lk2($week);
        $data['sqlLPA1'] = $this->crud_model->sql_lpa1($week);
        $data['sql:PA2'] = $this->crud_model->sql_lpa2($week);
        $data['week']  = $week;
        $data['page_name']  = 'karakter_building';
        $data['page_title'] = get_phrase('character building');
        $this->load->view('backend/index', $data);
    }


    function looking_karakter($student_id = '', $week = null)
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['build'] = $this->crud_model->looking_build($student_id, $week);
        $page_data['build2'] = $this->crud_model->looking_build2($student_id, $week);
        $page_data['lk_data'] = $this->crud_model->looking_lk($student_id, $week);
        $page_data['lk_data2'] = $this->crud_model->looking_lk2($student_id, $week);
        $page_data['week'] = $week;
        $page_data['student_id'] = $student_id;
        $page_data['page_name'] = 'looking_karakter';
        $page_data['page_title'] = get_phrase('report_details');
        $this->load->view('backend/index', $page_data);
    }

    function create_perilaku($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'send') {
            $data['student_id'] = $this->input->post('student_id');
            $user_id = $this->session->userdata('login_user_id');
            $data['user_id']    = "teacher-" . $user_id;
            $data['class_id']   = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');
            $data['date'] = date('Y-m-d');
            if ($data['section_id'] == 1 or $data['section_id'] == 2 or $data['section_id'] == 3) { 
                //level 1
                $this->crud_model->create_nilai($data);

            } else { 
                // level2
                $this->crud_model->create_nilai2($data);
            }

            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/karakter_building/', 'refresh');
        }
    }


    function get_lpa_lk_data($student_id = '')
    {
        $user_id = $this->session->userdata('login_user_id');
        $user_id = "teacher-" . $user_id;
        $level = $this->input->get('level') ?: 1;
        if ($level == 2) {
            $data_lpa = $this->db->where(['student_id' => $student_id, 'date' => date('Y-m-d'), 'user_id' => $user_id])->get('build2')->row_array();
            $data_lk = $this->db->where(['student_id' => $student_id, 'date' => date('Y-m-d'), 'user_id' => $user_id])->get('keagamaan2')->row_array();
        } else {
            $data_lpa = $this->db->where(['student_id' => $student_id, 'date' => date('Y-m-d'), 'user_id' => $user_id])->get('build')->row_array();
            $data_lk = $this->db->where(['student_id' => $student_id, 'date' => date('Y-m-d'), 'user_id' => $user_id])->get('keagamaan')->row_array();
        }
        $data = $data_lpa;
        if ($data_lk) {
            $data_lk['lk_id'] = $data_lk['id'];
            unset($data_lk['id']);
            $data = array_merge($data_lpa, $data_lk);
        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
    function input_nilai($id = '', $student_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $online_exam_info = $this->db->get_where('online_exam', array('online_exam_id' => $id))->row();
        $result = $online_exam_info->online_exam_id;
        $nilai_minimal = (int)$online_exam_info->minimum_percentage;
        $online_exam_result = $this->db->get_where('online_exam_result', array('online_exam_id' => $result, 'student_id' => $student_id))->row();
        $nilai_maksimal = 0;
        $questions = $this->db->get_where('question_bank', array('online_exam_id' => $id))->result_array();
        foreach ($questions as $q) {
            $nilai_maksimal += $q['mark'];
        }
        $nilai = $this->input->post();
        $id_exam = $online_exam_result->online_exam_result_id;
        $jumlah_nilai = array_sum($nilai);
        $persentase = $nilai_minimal / 100;
        $nilai_persentase = $nilai_maksimal * $persentase;
        if ($jumlah_nilai >= $nilai_persentase) {
            $status = "pass";
        } else {
            $status = "fail";
        }
        $this->db->set('obtained_mark', $jumlah_nilai);
        $this->db->set('result', $status);
        $this->db->where('online_exam_result_id', $id_exam);
        $this->db->update('online_exam_result');

        redirect(base_url() . 'teacher/exam_results/' . $id . '/', 'refresh');
    }
    function update_attended($id = '', $student_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $this->db->set('status', 'attended');
        $this->db->set('result', null);
        $this->db->set('obtained_mark', '');
        $this->db->where('online_exam_id', $id);
        $this->db->where('student_id', $student_id);
        $this->db->update('online_exam_result');

        redirect(base_url() . 'teacher/exam_results/' . $id . '/', 'refresh');
    }
    function forum_konseling($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['class_id'] = $this->input->post('class_id');
            $data['type'] = $this->session->userdata('login_type');
            $data['section_id'] = $this->input->post('section_id');
            if ($this->input->post('post_status') != "1") {
                $data['post_status'] = 0;
            } else {
                $data['post_status'] = $this->input->post('post_status');
            }
            $data['publish_date'] = date('Y-m-d H:i:s');
            $data['upload_date'] = date('d M. H:iA');
            $data['wall_type'] = "forum";
            $data['timestamp'] = date("d M, Y H:iA");
            $data['subject_id'] = $this->input->post('subject_id');
            $data['file_name']         = $_FILES["userfile"]["name"];
            $data['teacher_id']  =   $this->session->userdata('login_user_id');
            $data['post_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
            $this->db->insert('forum', $data);
            $this->crud_model->send_forum_notify();
            move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/forum/" . $_FILES["userfile"]["name"]);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/forum_konseling/', 'refresh');
        }
        if ($param1 == 'update') {
            if ($this->input->post('post_status') != "1") {
                $data['post_status'] = 0;
            } else {
                $data['post_status'] = $this->input->post('post_status');
            }
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['type'] = $this->session->userdata('login_type');
            $data['timestamp'] = date("d M,Y H:iA");
            $data['teacher_id']  =   $this->session->userdata('login_user_id');
            $this->db->where('post_code', $param2);
            $this->db->update('forum', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'teacher/edit_forum_konseling/' . $param2, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud_model->delete_post($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/forum_konseling/' . $param3 . "/", 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'forum_konseling';
        $page_data['page_title'] = get_phrase('forum');
        $this->load->view('backend/index', $page_data);
    }
    function edit_forum_konseling($code = '')
    {
        $page_data['page_name']  = 'edit_forum_diskusi';
        $page_data['page_title'] = get_phrase('update_forum');
        $page_data['code']   = $code;
        $this->load->view('backend/index', $page_data);
    }
    function forumroom_konseling($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'comment') {
            $page_data['room_page']    = 'comments';
            $page_data['post_code'] = $param2;
        } else if ($param1 == 'posts') {
            $page_data['room_page'] = 'post';
            $page_data['post_code'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['room_page'] = 'post_edit';
            $page_data['post_code'] = $param2;
        }
        $page_data['page_name']   = 'forum_room_konseling';
        $page_data['post_code']   = $param1;
        $page_data['page_title']  = get_phrase('forum');
        $this->load->view('backend/index', $page_data);
    }
    function forum_message_diskusi($param1 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') {
            $this->crud_model->create_post_message($this->input->post('post_code'));
        }
    }
    function meet_konseling($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name']  = 'meet_konseling';
        $page_data['page_title'] = get_phrase('meet');
        $this->load->view('backend/index', $page_data);
    }
    function live_konseling($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['live_id']  = $param1;
        $page_data['page_name']  = 'live_konseling';
        $page_data['page_title'] = get_phrase('live');
        $this->load->view('backend/index', $page_data);
    }
    function galeri($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['nama']               =   $this->input->post('nama');
            $this->db->insert('kategori', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            redirect(base_url() . 'teacher/galeri', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['nama']             =   $this->input->post('nama');
            $this->db->where('id_kategori', $param2);
            $this->db->update('kategori', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            redirect(base_url() . 'teacher/galeri', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id_kategori', $param2);
            $this->db->delete('kategori');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/galeri/', 'refresh');
        }
        $page_data['page_name']  = 'galeri';
        $page_data['page_title'] = 'Galeri';
        $this->load->view('backend/index', $page_data);
    }
    function galerifoto($id_kategori = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['kategori']  = $id_kategori;
        $page_data['page_name']  = 'galerifoto';
        $page_data['page_title'] =  'Album Foto';
        $this->load->view('backend/index', $page_data);
    }
    function galerifotos($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['id_kategori'] = $param2;
            $data['gambar']       = $this->input->post('gambar');
            $data['tgl_update']   = date('d-m-Y');
            $this->db->insert('galeri', $data);
            redirect(base_url() . 'teacher/galerifoto/' . base64_encode($param2) . "/", 'refresh');
        }
        if ($param1 == 'edit') {
            $data['gambar']       = $this->input->post('gambar');
            $data['tgl_update']   = date('d-m-Y');
            $this->db->where('id_galeri', $param2);
            $this->db->update('galeri', $data);
            redirect(base_url() . 'teacher/galerifoto/' . base64_encode($param3) . "/", 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id_galeri', $param2);
            $this->db->delete('galeri');

            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/galerifoto/' . base64_encode($param3) . "/", 'refresh');
        }
        redirect(base_url() . 'teacher/galerifoto/' . base64_encode($param2) . "/", 'refresh');
    }

    function blog($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['tulisan_judul']       = $this->input->post('judul');
            $data['tulisan_isi']       = $this->input->post('isi');
            $data['tulisan_tanggal']   = date('Y-m-d H:i:s');
            $data['tulisan_kategori_nama']       = $this->input->post('kategori');
            $data['tulisan_views']       = 0;
            $data['tulisan_gambar']           = substr(md5(rand(100000000, 200000000)), 0, 10);
            $data['tulisan_pengguna_id']       = $this->session->userdata('login_user_id');
            $data['tulisan_author']       = $this->crud_model->get_name('teacher', $this->session->userdata('login_user_id'));
            $data['tulisan_img_slider']       = 0;
            $data['tulisan_slug']       = "-";
            $this->db->insert('tbl_tulisan', $data);
            $tulisan_gambar = $this->db->get_where('tbl_tulisan', array('tulisan_id' => $this->db->insert_id()))->row()->tulisan_gambar;
            move_uploaded_file($_FILES['file_name']['tmp_name'], 'uploads/blog/' . $tulisan_gambar . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'teacher/blog/', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['tulisan_judul']       = $this->input->post('judul');
            $data['tulisan_isi']       = $this->input->post('isi');
            $data['tulisan_tanggal']   = date('Y-m-d H:i:s');
            $data['tulisan_kategori_nama']       = $this->input->post('kategori');
            $data['tulisan_views']       = $this->input->post('views');
            $data['tulisan_gambar']           = substr(md5(rand(100000000, 200000000)), 0, 10);
            $data['tulisan_pengguna_id']       = $this->session->userdata('login_user_id');
            $data['tulisan_author']       = $this->crud_model->get_name('teacher', $this->session->userdata('login_user_id'));
            $data['tulisan_img_slider']       = $this->input->post('slider');
            $data['tulisan_slug']       = "-";
            $this->db->where('tulisan_id', $param2);
            $this->db->update('tbl_tulisan', $data);
            $tulisan_gambar = $this->db->get_where('tbl_tulisan', array('tulisan_id' => $param2))->row()->tulisan_gambar;
            move_uploaded_file($_FILES['file_name']['tmp_name'], 'uploads/blog/' . $tulisan_gambar . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updatted'));
            redirect(base_url() . 'teacher/blog/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('tulisan_id', $param2);
            $this->db->delete('tbl_tulisan');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'teacher/blog/', 'refresh');
        }
        $page_data['page_name'] = 'blog';
        $page_data['page_title'] = 'Blog';
        $this->load->view('backend/index', $page_data);
    }
    function edit_blog($id = '')
    {
        $page_data['page_name']  = 'edit_blog';
        $page_data['page_title'] = 'Edit Blog';
        $page_data['id']   = $id;
        $this->load->view('backend/index', $page_data);
    }
    function baca_blog($id = '')
    {
        $page_data['page_name']  = 'baca_blog';
        $page_data['page_title'] = 'Baca Blog';
        $page_data['id']   = $id;
        $this->load->view('backend/index', $page_data);
    }
    function edit_karakter($param = '')
    {
        $decode = base64_decode($param);
        $ex = explode('-',  $decode);

        $page_data['class_id'] = $ex[0];
        $page_data['section_id'] = $ex[1];
        $page_data['student_id'] = $ex[2];
        $page_data['user_id'] = $ex[3];
        $page_data['page_name']  = 'edit_karakter';
        $page_data['page_title'] = 'Ubah Nilai Karakter';
        $this->load->view('backend/index', $page_data);
    }
}
