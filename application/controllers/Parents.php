<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Parents extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('academic_model');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function subject_dashboard($data = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_dashboard';
        $page_data['page_title']   = get_phrase('subject_marks');
        $this->load->view('backend/index', $page_data);
    }

    function subjects()
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'subjects';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }

    function birthdays()
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'birthdays';
        $page_data['page_title'] = get_phrase('birthdays');
        $this->load->view('backend/index', $page_data);
    }


    function notifications()
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']  =  'notifications';
        $page_data['page_title'] =  get_phrase('your_notifications');
        $this->load->view('backend/index', $page_data);
    }

    function calendar($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'calendar';
        $page_data['page_title'] = get_phrase('calendar_events');
        $page_data['code']   = $code;
        $this->load->view('backend/index', $page_data);
    }

    function readNews($param1 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
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


        redirect(base_url() . 'parents/panel/', 'refresh');
    }

    public function index()
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($this->session->userdata('parent_login') == 1) {
            redirect(base_url() . 'parents/panel/', 'refresh');
        }
    }

    function notification($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('notification');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'parents/notifications/', 'refresh');
        }
        if ($param1 == 'delete_all') {
            $this->db->where('user_type', $this->session->userdata('login_type'));
            $this->db->where('user_id', $this->session->userdata('login_user_id'));
            $this->db->delete('notification');
            redirect(base_url() . 'parents/notifications/', 'refresh');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
        }
    }

    function group($param1 = "group_message_home", $param2 = "")
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $max_size = 2097152;
        if ($param1 == 'group_message_read') {
            $page_data['current_message_thread_code'] = $param2;
        } else if ($param1 == 'send_reply') {
            if (!file_exists('uploads/group_messaging_attached_file/')) {
                $oldmask = umask(0);
                mkdir('uploads/group_messaging_attached_file/', 0777);
            }
            if ($_FILES['attached_file_on_messaging']['name'] != "") {
                if ($_FILES['attached_file_on_messaging']['size'] > $max_size) {
                    $this->session->set_flashdata('error_message', "2MB allowed");
                    redirect(base_url() . 'parents/group/group_message_read/' . $param2, 'refresh');
                } else {
                    $file_path = 'uploads/group_messaging_attached_file/' . $_FILES['attached_file_on_messaging']['name'];
                    move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
                }
            }
            $this->crud_model->send_reply_group_message($param2);
            $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
            redirect(base_url() . 'parents/group/group_message_read/' . $param2, 'refresh');
        }
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group';
        $page_data['page_title']                = get_phrase('message_group');
        $this->load->view('backend/index', $page_data);
    }

    function view_report($report_code = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['code'] = $report_code;
        $page_data['page_name'] = 'view_report';
        $page_data['page_title'] = get_phrase('report_details');
        $this->load->view('backend/index', $page_data);
    }

    function student_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
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

    function my_profile($param1 = "", $page_id = "")
    {
        if ($this->session->userdata('parent_login') != 1) {
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
            $this->db->where('parent_id', $this->session->userdata('login_user_id'));
            $this->db->update('parent', $data);
            $this->session->set_flashdata('flash_message', get_phrase('facebook_delete'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }
        if ($param1 == '1') {
            $this->session->set_flashdata('error_message', get_phrase('google_err'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }
        if ($param1 == '3') {
            $this->session->set_flashdata('error_message', get_phrase('facebook_err'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }
        if ($param1 == '2') {
            $this->session->set_flashdata('flash_message', get_phrase('google_true'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }
        if ($param1 == '4') {
            $this->session->set_flashdata('flash_message', get_phrase('facebook_true'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
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
            $this->db->where('parent_id', $this->session->userdata('login_user_id'));
            $this->db->update('parent', $data);

            unset($_SESSION['token']);
            unset($_SESSION['userData']);
            $gClient->revokeToken();
            $this->session->set_flashdata('flash_message', get_phrase('google_delete'));
            redirect(base_url() . 'parents/my_profile/', 'refresh');
        }
        if ($param1 == 'update') {
            if (!empty($_FILES['userfile']['tmp_name'])) {
                $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            $data['first_name']             = $this->input->post('first_name');
            $data['last_name']              = $this->input->post('last_name');
            $data['gender']                 = $this->input->post('gender');
            $data['profession']             = $this->input->post('profession');
            $data['email']                  = $this->input->post('email');
            $data['phone']                  = $this->input->post('phone');
            $data['home_phone']             = $this->input->post('home_phone');
            $data['idcard']                 = $this->input->post('idcard');
            $data['business']               = $this->input->post('business');
            $data['business_phone']         = $this->input->post('business_phone');
            $data['address']          = $this->input->post('address');
            if ($this->input->post('password') != "") {
                $data['password'] = sha1($this->input->post('password'));
            }
            $this->db->where('parent_id', $this->session->userdata('login_user_id'));
            $this->db->update('parent', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            redirect(base_url() . 'parents/parent_update/', 'refresh');
        }

        $data['output']         = $output;
        $data['page_name']              = 'my_profile';
        $data['page_title']             =  get_phrase('profile');
        $this->load->view('backend/index', $data);
    }

    function parent_update($parent_id = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
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

        $page_data['output']  = $output;
        $page_data['page_name']  = 'parent_update';
        $page_data['page_title'] = get_phrase('profile');
        $this->load->view('backend/index', $page_data);
    }

    function subject_marks($data = '', $param2 = '', $tahun_ajaran = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param2 != "") {
            $page = $param2;
        } else {
            $page = $this->db->get('exam')->first_row()->exam_id;
        }
        $page_data['exam_id'] = $page;
        $page_data['data'] = $data;
        $page_data['tahun_ajaran'] = $tahun_ajaran;
        $page_data['page_name']    = 'subject_marks';
        $page_data['page_title']   = get_phrase('marks');
        $this->load->view('backend/index', $page_data);
    }

    function online_exam_result($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name'] = 'online_exam_result';
        $page_data['param2'] = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_title'] = get_phrase('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }

    function online_exams($student_id = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $info = base64_decode($student_id);
        $ex = explode('-', $info);

        $page_data['exams'] = $this->crud_model->parent_available_exams($ex[0], $ex[0], $ex[1]);
        $page_data['page_name']  = 'online_exams';
        $page_data['data'] = $student_id;
        $page_data['page_title'] = get_phrase('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    function polls($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'response') {
            $data['poll_code'] = $this->input->post('poll_code');
            $data['answer'] = $this->input->post('answer');
            $user = $this->session->userdata('login_user_id');
            $user_type = $this->session->userdata('login_type');
            $data['user'] = $user_type . "-" . $user;
            $data['date'] = date('d M, Y');
            return $this->db->insert('poll_response', $data);
        }
    }

    function homework($student_id = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'homework';
        $page_data['data']   = $student_id;
        $page_data['page_title'] = get_phrase('homework');
        $this->load->view('backend/index', $page_data);
    }

    function study_material($task = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']              = $task;
        $page_data['page_name']  = 'study_material';
        $page_data['page_title'] =  get_phrase('study_material');
        $this->load->view('backend/index', $page_data);
    }

    function forumroom($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $page_data['post_code'] = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_name']   = 'forum_room';
        $page_data['page_title']  = get_phrase('forum');
        $this->load->view('backend/index', $page_data);
    }

    function forum_message($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') {
            $this->crud_model->create_post_message($this->input->post('post_code'));
        }
    }

    function forumroom_konseling($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $page_data['post_code'] = $param1;
        $page_data['page_name']   = 'forum_room_konseling';
        $page_data['page_title']  = get_phrase('forum');
        $this->load->view('backend/index', $page_data);
    }

    function forum($param1 = '', $param2 = '', $student_id = '')
    {
        $page_data['page_name'] = 'forum';
        $page_data['page_title'] = get_phrase('forum');
        $page_data['data']   = $param1;
        $this->load->view('backend/index', $page_data);
    }

    function homeworkroom($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['homework_code'] = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_name']   = 'homework_room';
        $page_data['page_title']  = get_phrase('homework');
        $this->load->view('backend/index', $page_data);
    }

    function view_invoice($id = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['invoice_id'] = $id;
        $page_data['page_name']  = 'view_invoice';
        $page_data['page_title'] = get_phrase('view_invoice');
        $this->load->view('backend/index', $page_data);
    }

    function examroom()
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'examroom';
        $page_data['page_title'] = "Examen";
        $this->load->view('backend/index', $page_data);
    }

    function panel()
    {
        if ($this->session->userdata('parent_login') != 1) {
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

    function teachers()
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']  = 'teachers';
        $page_data['page_title'] = get_phrase('teachers');
        $this->load->view('backend/index', $page_data);
    }

    function marks_print_view($param, $tahun_ajaran)
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect('login', 'refresh');
        }
        $ex = explode('-', base64_decode($param));
        $student_id = $ex[0];
        $exam_id = $ex[1];

        $class_id     = $this->db->get_where('enroll', array('student_id' => $ex[0], 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description))->row()->class_id;
        $class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $page_data['tahun_ajaran']    =   $tahun_ajaran;

        $this->load->view('backend/parent/marks_print_view', $page_data);
    }

    function noticeboard($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect('login', 'refresh');
        }
        $page_data['page_name'] = 'noticeboard';
        $page_data['page_title'] = get_phrase('news');
        $this->load->view('backend/index', $page_data);
    }

    function marks($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');

        $parents = $this->db->get_where('student', array('student_id' => $param1))->result_array();
        foreach ($parents as $row) {
            if ($row['parent_id'] == $this->session->userdata('login_user_id')) {
                $page_data['student_id'] = $param1;
            } else if ($row['parent_id'] != $this->session->userdata('login_user_id')) {
                redirect(base_url(), 'refresh');
            }
        }

        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('marks');
        $this->load->view('backend/index', $page_data);
    }

    function library($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect('login', 'refresh');
        }
        $id = $this->input->post('class_id');
        if ($id == '') {
            $page_data['books']      = $this->db->get('book')->result_array();
        } else {
            $page_data['books']      = $this->db->get_where('book', array('class_id' => $id))->result_array();
        }
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = get_phrase('library');
        $this->load->view('backend/index', $page_data);
    }


    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['student_id'] = $param1;
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function attendance_report()
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['month']        = date('m');
        $page_data['page_name']    = 'attendance_report';
        $page_data['page_title']   = get_phrase('attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    function report_attendance_view($data, $month = '', $year = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['month']    = $month;
        $page_data['data']    = $data;
        $page_data['year']    = $year;
        $page_data['page_name'] = 'report_attendance_view';
        $page_data['page_title'] = get_phrase('attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    function attendance_report_selector()
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $data['year']       = $this->input->post('year');
        $data['month']  = $this->input->post('month');
        $data['data']  = $this->input->post('data');
        redirect(base_url() . 'parents/report_attendance_view/' . $data['data'] . '/' . $data['month'] . '/' . $data['year'], 'refresh');
    }

    function exam_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']  = 'exam_routine';
        $page_data['page_title'] = get_phrase('exam_routine');
        $this->load->view('backend/index', $page_data);
    }

    function invoice($student_id = '', $param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'make_payment') {
            $invoice_id      = $this->input->post('invoice_id');
            $system_settings = $this->db->get_where('settings', array('type' => 'paypal_email'))->row();
            $invoice_details = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();
            $student_nis    = $this->db->get_where('enroll', array('student_id' => $student_id))->row();
            // $this->paypal->add_field('rm', 2);
            // $this->paypal->add_field('no_note', 0);
            // $this->paypal->add_field('item_name', $invoice_details->title);
            // $this->paypal->add_field('amount', $invoice_details->due);
            // $this->paypal->add_field('currency_code', $this->db->get_where('settings' , array('type' =>'currency'))->row()->description);
            // $this->paypal->add_field('custom', $invoice_details->invoice_id);
            // $this->paypal->add_field('business', $system_settings->description);
            // $this->paypal->add_field('notify_url', base_url() . 'student/invoice/');
            // $this->paypal->add_field('cancel_return', base_url() . 'student/invoice/paypal_cancel');
            // $this->paypal->add_field('return', base_url() . 'student/invoice/paypal_success');
            // $this->paypal->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
            // $this->paypal->submit_paypal_post();
            redirect('https://infradigital.io/bills?biller_code=10038&bill_key=' . $student_nis->roll, 'refresh');
        }
        if ($param1 == 'paypal_cancel') {
            redirect(base_url() . 'parents/invoice/' . $student_id, 'refresh');
        }
        if ($param1 == 'paypal_success') {
            foreach ($_POST as $key => $value) {
                $value = urlencode(stripslashes($value));
                $ipn_response = "\n$key=$value";
            }
            $data['payment_details']   = $ipn_response;
            $data['payment_timestamp'] = strtotime(date("m/d/Y"));
            $data['payment_method']    = 'paypal';
            $data['status']            = 'completed';
            $invoice_id                = $_POST['custom'];
            $this->db->where('invoice_id', $invoice_id);
            $this->db->update('invoice', $data);

            $data2['method']       =   'paypal';
            $data2['invoice_id']   =   $_POST['custom'];
            $data2['timestamp']    =   strtotime(date("m/d/Y"));
            $data2['payment_type'] =   'income';
            $data2['title']        =   $this->db->get_where('invoice', array('invoice_id' => $data2['invoice_id']))->row()->title;
            $data2['description']  =   $this->db->get_where('invoice', array('invoice_id' => $data2['invoice_id']))->row()->description;
            $data2['student_id']   =   $this->db->get_where('invoice', array('invoice_id' => $data2['invoice_id']))->row()->student_id;
            $data2['amount']       =   $this->db->get_where('invoice', array('invoice_id' => $data2['invoice_id']))->row()->amount;
            $this->db->insert('payment', $data2);
            redirect(base_url() . 'parents/invoice/' . $student_id, 'refresh');
        }
        if ($student_id == 'student') {
            redirect(base_url() . 'parents/invoice/' . $this->input->post('student_id'), 'refresh');
        }

        $parent_profile         = $this->db->get_where('parent', array('parent_id' => $this->session->userdata('parent_id')))->row();
        $page_data['student_id'] = $student_id;
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('payments');
        $this->load->view('backend/index', $page_data);
    }

    public function ajax_total_tagihan_belum_dibayar()
    {
        $post = $this->input->post();
        $student_id = $post['student_id'];
        $status = false;

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;

        $query = "SELECT student_id, amount, status FROM invoice WHERE student_id = '" . $student_id . "'";
        $invoices = $this->db->query($query);
        $row = $invoices->row();

        if (isset($row)) {
            $status = true;
        }

        $to = 0;
        $banyaknya_data_belum_dibayar = 0;
        $banyaknya_data_sudah_dibayar = 0;
        $banyaknya_data_sudah_dan_belum_dibayar = 0;
        foreach ($invoices->result_array() as $r) {
            switch ($r['status']) {
                case 'pending':
                    $to += $r['amount'];
                    $banyaknya_data_belum_dibayar++;
                    break;
                case 'completed':
                    $banyaknya_data_sudah_dibayar++;
                    break;
            }
            $banyaknya_data_sudah_dan_belum_dibayar++;
        }
        // echo number_format($to);
        $response = array(
            'status' => $status,
            'post' => $post,
            'total' => number_format($to),
            'banyaknya_data_belum_dibayar' => $banyaknya_data_belum_dibayar,
            'banyaknya_data_sudah_dibayar' => $banyaknya_data_sudah_dibayar,
            'banyaknya_data_sudah_dan_belum_dibayar' => $banyaknya_data_sudah_dan_belum_dibayar,
        );

        echo json_encode($response);
    }

    function news_message($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') {
            $this->crud_model->create_news_message($this->input->post('news_code'));
        }
    }

    function exam_results($code = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $page_data['exam_code']     = $code;
        $page_data['page_name']     = 'exam_results';
        $page_data['page_title']    = get_phrase('exam_results');
        $this->load->view('backend/index', $page_data);
    }


    function request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == "create") {
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/request/" . $_FILES["file_name"]["name"]);
            $data['student_id']   = $this->input->post('student_id');
            $data['description']  = $this->input->post('description');
            $data['parent_id']    = $this->session->userdata('login_user_id');
            $data['title']        = $this->input->post('title');
            $data['start_date']   = $this->input->post('start_date');
            $data['end_date']     = $this->input->post('end_date');
            $data['status']     = 0;
            $data['file']         = $_FILES["file_name"]["name"];
            $this->db->insert('students_request', $data);

            $notify['notify'] = "<strong>" . $this->session->userdata('name') . "</strong>" . " " . get_phrase('absence_request') . " <b>" . $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row()->first_name . "</b>";
            $admins = $this->db->get('admin')->result_array();
            foreach ($admins as $row) {
                $notify['user_id'] = $row['admin_id'];
                $notify['user_type'] = "admin";
                $notify['url'] = "admin/request/";
                $notify['date'] = date('d M, Y');
                $notify['time'] = date('h:i A');
                $notify['status'] = 0;
                $notify['original_id'] = $this->session->userdata('login_user_id');
                $notify['original_type'] = $this->session->userdata('login_type');
                send_notification($notify, false);
            }
            send_firebase_notification('admin', strip_tags($notify['notify']));
            redirect(base_url() . 'parents/request', 'refresh');
        }
        $data['page_name']  = 'request';
        $data['page_title'] = get_phrase('permissions');
        $this->load->view('backend/index', $data);
    }

    function read($code = "")
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'read';
        $page_data['page_title'] = get_phrase('noticeboard');
        $page_data['code']   = $code;
        $this->load->view('backend/index', $page_data);
    }

    function message($param1 = 'message_home', $param2 = '', $param3 = '')
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if (isset($_GET['id'])) {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'send_new') {
            $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
            $message_thread_code = $this->crud_model->send_new_private_message();
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/messages/" . $_FILES["file_name"]["name"]);
            redirect(base_url() . 'parents/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') {
            $this->session->set_flashdata('flash_message', get_phrase('reply_sent'));
            $this->crud_model->send_reply_message($param2);
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/messages/" . $_FILES["file_name"]["name"]);
            redirect(base_url() . 'parents/message/message_read/' . $param2, 'refresh');
        }
        if ($param1 == 'message_read') {
            if ($param2) {
                $page_data['current_message_thread_code'] = $param2;
                $this->crud_model->mark_thread_messages_read($param2);
            } else {
                $param1 = 'message_home';
            }
        }
        $page_data['infouser'] = $param2;
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messages');
        $this->load->view('backend/index', $page_data);
    }

    function karakter_building($week = null)
    {
        if ($this->session->userdata('parent_login') != 1) {
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

    function create_perilaku($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'send') {
            $data['student_id'] = $this->input->post('student_id');
            $user_id = $this->session->userdata('login_user_id');
            $data['user_id']    = "parent-" . $user_id;
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
            redirect(base_url() . 'parents/karakter_building/', 'refresh');
        }
    }

    function looking_karakter($student_id = '', $week = null)
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id'])) {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
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

    function get_lpa_lk_data($student_id = '')
    {
        $user_id = $this->session->userdata('login_user_id');
        $user_id = "parent-" . $user_id;
        $section = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->section_id;
        $level = $section <= 3 ? 1 : 2;
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
        $data['level'] = $level;
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    function get_class_section($class_id = '')
    {
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
        echo '<option value="">' . get_phrase('select') . '</option>';
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_class_stundets($section_id = '')
    {
        $students = $this->db->get_where('enroll', array('section_id' => $section_id))->result_array();
        echo '<option value="">' . get_phrase('select') . '</option>';
        foreach ($students as $row) {
            echo '<option value="' . $row['student_id'] . '">' . $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->first_name . " " . $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->last_name  . '</option>';
        }
    }

    function get_class_subject($class_id = '')
    {
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
        foreach ($subjects as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }
    function konseling($param1 = '', $param2 = '', $student_id = '')
    {
        $page_data['page_name'] = 'konseling';
        $page_data['page_title'] = 'Forum Konseling';
        $page_data['data']   = $param1;
        $this->load->view('backend/index', $page_data);
    }
    function laporan()
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name'] = 'laporan';
        $page_data['page_title'] = 'Laporan';
        $this->load->view('backend/index', $page_data);
    }
    function proses_laporan($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') {
            $data['title']          = $this->input->post('title');
            $data['report_code']    = substr(md5(rand(100000000, 20000000000)), 0, 7);
            $data['priority']       = $this->input->post('priority');
            $data['teacher_id']     = $this->input->post('teacher_id');
            $data['status']     = 0;
            $login_type             = $this->session->userdata('login_type');
            if ($login_type == 'parent') $data['parent_id']  = $this->session->userdata('login_user_id');
            else $data['parent_id']  = $this->input->post('parent_id');
            $data['timestamp']      = date("d M, Y");
            $data['description']       = $this->input->post('description');
            if ($_FILES['file']['name'] != '') $data['file']          = $_FILES['file']['name'];
            $this->db->insert('laporan_konseling', $data);
            move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/reportes_alumnos/' . $_FILES['file']['name']);


            $notify['notify'] = "<strong>" . $this->session->userdata('name') . "</strong>" . " " . "Melaporkan mentor" . " :" . " " . "<b>" . $this->db->get_where('teacher', array('teacher_id' => $this->input->post('teacher_id')))->row()->first_name . "</b>";
            $admins = $this->db->get('admin')->result_array();
            foreach ($admins as $row) {
                $notify['user_id'] = $row['admin_id'];
                $notify['user_type'] = "admin";
                $notify['url'] = "admin/lihat_laporan/" . $data['report_code'] . "/";
                $notify['date'] = date('d M, Y');
                $notify['time'] = date('h:i A');
                $notify['status'] = 0;
                $notify['original_id'] = $this->session->userdata('login_user_id');
                $notify['original_type'] = $this->session->userdata('login_type');
                $this->db->insert('notification', $notify);
            }
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'parents/laporan/', 'refresh');
        }

        $page_data['page_title'] =  "";
        $page_data['page_name']  = 'proses_laporan';
        $this->load->view('backend/index', $page_data);
    }
    function lihat_laporan($code  = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['code'] = $code;
        $page_data['page_name']    = 'lihat_laporan';
        $page_data['page_title']   = get_phrase('view_report');
        $this->load->view('backend/index', $page_data);
    }
    function create_report_message($code = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $data['message']      = $this->input->post('message');
        $data['report_code']  = $this->input->post('report_code');
        $data['timestamp']    = date("d M, Y");
        $data['sender_type']    = $this->session->userdata('login_type');
        $data['sender_id']      = $this->session->userdata('login_user_id');
        return $this->db->insert('reporte_mensaje', $data);
    }
    function meet_konseling($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name']  = 'meet_konseling';
        $page_data['page_title'] = get_phrase('meet');
        $this->load->view('backend/index', $page_data);
    }
    function live_konseling($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['live_id']  = $param1;
        $page_data['page_name']  = 'live_konseling';
        $page_data['page_title'] = get_phrase('live');
        $this->load->view('backend/index', $page_data);
    }
    function galeri($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'galeri';
        $page_data['page_title'] = 'Galeri';
        $this->load->view('backend/index', $page_data);
    }
    function galerifoto($id_kategori = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['kategori']  = $id_kategori;
        $page_data['page_name']  = 'galerifoto';
        $page_data['page_title'] =  'Album Foto';
        $this->load->view('backend/index', $page_data);
    }
    function blog($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1) {
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
            $data['tulisan_author']       = $this->crud_model->get_name('parent', $this->session->userdata('login_user_id'));
            $data['tulisan_img_slider']       = 0;
            $data['tulisan_slug']       = "-";
            $this->db->insert('tbl_tulisan', $data);
            $tulisan_gambar = $this->db->get_where('tbl_tulisan', array('tulisan_id' => $this->db->insert_id()))->row()->tulisan_gambar;
            move_uploaded_file($_FILES['file_name']['tmp_name'], 'uploads/blog/' . $tulisan_gambar . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'parents/blog/', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['tulisan_judul']       = $this->input->post('judul');
            $data['tulisan_isi']       = $this->input->post('isi');
            $data['tulisan_tanggal']   = date('Y-m-d H:i:s');
            $data['tulisan_kategori_nama']       = $this->input->post('kategori');
            $data['tulisan_views']       = $this->input->post('views');
            $data['tulisan_gambar']           = substr(md5(rand(100000000, 200000000)), 0, 10);
            $data['tulisan_pengguna_id']       = $this->session->userdata('login_user_id');
            $data['tulisan_author']       = $this->crud_model->get_name('parent', $this->session->userdata('login_user_id'));
            $data['tulisan_img_slider']       = $this->input->post('slider');
            $data['tulisan_slug']       = "-";
            $this->db->where('tulisan_id', $param2);
            $this->db->update('tbl_tulisan', $data);
            $tulisan_gambar = $this->db->get_where('tbl_tulisan', array('tulisan_id' => $param2))->row()->tulisan_gambar;
            move_uploaded_file($_FILES['file_name']['tmp_name'], 'uploads/blog/' . $tulisan_gambar . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updatted'));
            redirect(base_url() . 'parents/blog/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('tulisan_id', $param2);
            $this->db->delete('tbl_tulisan');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'parents/blog/', 'refresh');
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
