<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('mail_model');
        $this->load->model('academic_model');
        $this->load->model('Crud_model');
        $this->load->library('session','unit_test');
        $this->load->helper('idn_helper');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($this->session->userdata('admin_login') == 1) {
            redirect(base_url() . 'admin/panel/', 'refresh');
        }
    }

    //Update SMTP Settings function.
    function smtp($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'update') {
            // $this->crud_model->updateSMTP();
            $data['description'] = strip_tags($this->input->post('protocol'));
            $this->db->where('type', 'protocol');
            $this->db->update('settings', $data);

            $data['description'] = strip_tags($this->input->post('smtp_host'));
            $this->db->where('type', 'smtp_host');
            $this->db->update('settings', $data);

            $data['description'] = strip_tags($this->input->post('smtp_port'));
            $this->db->where('type', 'smtp_port');
            $this->db->update('settings', $data);

            $data['description'] = strip_tags($this->input->post('smtp_user'));
            $this->db->where('type', 'smtp_user');
            $this->db->update('settings', $data);

            $data['description'] = strip_tags($this->input->post('smtp_pass'));
            $this->db->where('type', 'smtp_pass');
            $this->db->update('settings', $data);

            $data['description'] = strip_tags($this->input->post('charset'));
            $this->db->where('type', 'charset');
            $this->db->update('settings', $data);
            $this->session->set_flashdata('flash_message', get_phrase('success_update'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'smtp';
        $page_data['page_title'] = get_phrase('smtp_settings');
        $this->load->view('backend/index', $page_data);
    }

    function send_marks($param1 = '', $param2 = '')
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if ($param1 == 'email') {
            if ($this->input->post('receiver') == 'student') {
                $this->mail_model->sendStudentMarks();
            } else {
                $this->mail_model->sendParentMarks();
            }
            $this->session->set_flashdata('flash_message', get_phrase('marks_sent'));
            redirect(base_url() . 'admin/grados/', 'refresh');
        }
    }

    function live_konseling($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['live_id']  = $param1;
        $page_data['page_name']  = 'live_konseling';
        $page_data['page_title'] = get_phrase('live');
        $this->load->view('backend/index', $page_data);
    }

    function meet_konseling($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->academic_model->createLiveClass();
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/meet_konseling/' . $param2, 'refresh');
        }
        if ($param1 == 'update') {
            $this->academic_model->updateLiveClass($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/meet_konseling/' . $param3, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('live_id', $param2);
            $this->db->delete('live');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/meet_konseling/' . $param3, 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name']  = 'meet_konseling';
        $page_data['page_title'] = get_phrase('meet');
        $this->load->view('backend/index', $page_data);
    }

    function panel($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id'])) {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'panel';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function news($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->crud_model->create_news();
            $this->crud_model->send_news_notify();
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/panel/', 'refresh');
        }
        if ($param1 == 'update_panel') {
            $this->crud_model->update_panel_news($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/panel/', 'refresh');
        }
        if ($param1 == 'create_video') {
            $this->crud_model->create_video();
            $this->crud_model->send_news_notify();
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/panel/', 'refresh');
        }
        if ($param1 == 'update_news') {
            $this->crud_model->update_panel_news($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/news/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud_model->delete_news($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/panel/', 'refresh');
        }
        if ($param1 == 'delete2') {
            $this->crud_model->delete_news($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/news/', 'refresh');
        }
        $page_data['page_name'] = 'news';
        $page_data['page_title'] = get_phrase('news');
        $this->load->view('backend/index', $page_data);
    }

    function message($param1 = 'message_home', $param2 = '', $param3 = '')
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($this->session->userdata('admin_login') != 1) {
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
            redirect(base_url() . 'admin/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') {
            $this->session->set_flashdata('flash_message', get_phrase('reply_sent'));
            $this->crud_model->send_reply_message($param2);
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/messages/" . $_FILES["file_name"]["name"]);
            redirect(base_url() . 'admin/message/message_read/' . $param2, 'refresh');
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

    function group($param1 = "group_message_home", $param2 = "", $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $max_size = 2097152;
        if ($param1 == "create_group") {
            $this->crud_model->create_group();
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/group/', 'refresh');
        } elseif ($param1 == "delete_group") {
            $this->db->where('group_message_thread_code', $param2);
            $this->db->delete('group_message');
            $this->db->where('group_message_thread_code', $param2);
            $this->db->delete('group_message_thread');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/group/', 'refresh');
        } elseif ($param1 == "edit_group") {
            $this->crud_model->update_group($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/group/', 'refresh');
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
                    redirect(base_url() . 'admin/group/group_message_read/' . $param2, 'refresh');
                } else {
                    $file_path = 'uploads/group_messaging_attached_file/' . $_FILES['attached_file_on_messaging']['name'];
                    move_uploaded_file($_FILES['attached_file_on_messaging']['tmp_name'], $file_path);
                }
            }

            $this->crud_model->send_reply_group_message($param2);
            $this->session->set_flashdata('flash_message', get_phrase('message_sent'));
            redirect(base_url() . 'admin/group/group_message_read/' . $param2, 'refresh');
        }
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group';
        $page_data['page_title']                = get_phrase('message_group');
        $this->load->view('backend/index', $page_data);
    }

    function pending($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'pending';
        $page_data['page_title'] = get_phrase('pending_users');
        $this->load->view('backend/index', $page_data);
    }

    function students_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id']   = $this->input->post('class_id');
        $page_data['section_id']   = $this->input->post('section_id');
        $page_data['page_name']   = 'students_report';
        $page_data['page_title']  = get_phrase('students_report');
        $this->load->view('backend/index', $page_data);
    }

    function general_reports($class_id = '', $section_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']   = 'general_reports';
        $page_data['class_id']   = $this->input->post('class_id');
        $page_data['section_id']   = $this->input->post('section_id');
        $page_data['page_title']  = get_phrase('general_reports');
        $this->load->view('backend/index', $page_data);
    }

    function all($class_id = '', $section_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']   = 'all';
        $page_data['page_title']  = get_phrase('my_files');
        $this->load->view('backend/index', $page_data);
    }

    function birthdays()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'birthdays';
        $page_data['page_title'] = get_phrase('birthdays');
        $this->load->view('backend/index', $page_data);
    }

    function upload($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'upload';
        $page_data['page_title'] = get_phrase('upload_files');
        $this->load->view('backend/index', $page_data);
    }

    function recent()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  =  'recent';
        $page_data['page_title'] =  get_phrase('recent_files');
        $this->load->view('backend/index', $page_data);
    }

    function notifications($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('notification');
            redirect(base_url() . 'admin/notifications/', 'refresh');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
        }
        if ($param1 == 'delete_all') {
            $this->db->where('user_type', $this->session->userdata('login_type'));
            $this->db->where('user_id', $this->session->userdata('login_user_id'));
            $this->db->delete('notification');
            redirect(base_url() . 'admin/notifications/', 'refresh');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
        }
        $page_data['page_name']  =  'notifications';
        $page_data['page_title'] =  get_phrase('your_notifications');
        $this->load->view('backend/index', $page_data);
    }

    function query()
    {
        if ($_POST['b'] != "") {
            $this->db->like('name', $_POST['b']);
            $query = $this->db->get_where('student')->result_array();
            if (count($query) > 0) {
                foreach ($query as $row) {
                    echo '<p style="text-align: left; color:#fff; font-size:14px;"><a style="text-align: left; color:#fff; font-weight: bold;" href="' . base_url() . 'admin/student_portal/' . $row['student_id'] . '/">' . $row['name'] . '</a>' . " &nbsp;" . $status . "" . "</p>";
                }
            } else {
                echo '<p class="col-md-12" style="text-align: left; color: #fff; font-weight: bold; ">' . get_phrase('no_results') . '</p>';
            }
        }
    }

    function new_student($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name']  = 'new_student';
        $page_data['page_title'] = get_phrase('admissions');
        $this->load->view('backend/index', $page_data);
    }

    function grade($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('point');
            $data['mark_from']   = $this->input->post('from');
            $data['mark_upto']   = $this->input->post('to');
            $this->db->insert('grade', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/grade/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['name']        = $this->input->post('name');
            $data['grade_point'] = $this->input->post('point');
            $data['mark_from']   = $this->input->post('from');
            $data['mark_upto']   = $this->input->post('to');
            $this->db->where('grade_id', $param2);
            $this->db->update('grade', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/grade/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('grade_id', $param2);
            $this->db->delete('grade');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/grade/', 'refresh');
        }
        $page_data['page_name']  = 'grade';
        $page_data['page_title'] = get_phrase('grades');
        $this->load->view('backend/index', $page_data);
    }

    function users($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'permissions') {
            $data['permissions'] = $this->input->post('messages');
            $this->db->where('type', 'messages');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('admins');
            $this->db->where('type', 'admins');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('parents');
            $this->db->where('type', 'parents');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('teachers');
            $this->db->where('type', 'teachers');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('students');
            $this->db->where('type', 'students');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('accountants');
            $this->db->where('type', 'accountants');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('librarians');
            $this->db->where('type', 'librarians');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('library');
            $this->db->where('type', 'library');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('academic');
            $this->db->where('type', 'academic');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('attendance');
            $this->db->where('type', 'attendance');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('calendar');
            $this->db->where('type', 'calendar');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('files');
            $this->db->where('type', 'files');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('polls');
            $this->db->where('type', 'polls');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('notifications');
            $this->db->where('type', 'notifications');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('admissions');
            $this->db->where('type', 'admissions');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('behavior');
            $this->db->where('type', 'behavior');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('news');
            $this->db->where('type', 'news');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('school_bus');
            $this->db->where('type', 'school_bus');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('classrooms');
            $this->db->where('type', 'classrooms');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('accounting');
            $this->db->where('type', 'accounting');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('schedules');
            $this->db->where('type', 'schedules');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('system_reports');
            $this->db->where('type', 'system_reports');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('academic_settings');
            $this->db->where('type', 'academic_settings');
            $this->db->update('account_role', $data);

            $data['permissions'] = $this->input->post('settings');
            $this->db->where('type', 'settings');
            $this->db->update('account_role', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/users/', 'refresh');
        }
        $page_data['page_name']                 = 'users';
        $page_data['page_title']                = get_phrase('users');
        $this->load->view('backend/index', $page_data);
    }

    function add_build()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']                 = 'users';
        $page_data['page_title']                = get_phrase('Tambah Data');
        $this->load->view('backend/index', $page_data);
    }

    function admins($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $md5 = md5(date('d-m-y H:i:s'));
            $data['first_name']         = $this->input->post('first_name');
            $data['last_name']         = $this->input->post('last_name');
            $data['username']     = $this->input->post('username');
            $data['password']     = sha1($this->input->post('password'));
            $data['email']        = $this->input->post('email');
            $data['birthday']     = $this->input->post('datetimepicker');
            $data['gender']     = $this->input->post('gender');
            $data['phone']     = $this->input->post('phone');
            $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            $data['address']     = $this->input->post('address');
            $data['since']     = date('d M, Y');
            $data['owner_status'] = $this->input->post('owner_status');
            $this->db->insert('admin', $data);
            $admin_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/admins/', 'refresh');
        }
        if ($param1 == 'update') {
            $md5 = md5(date('d-m-y H:i:s'));
            $data['first_name']         = $this->input->post('first_name');
            $data['last_name']         = $this->input->post('last_name');
            $data['username']     = $this->input->post('username');
            $data['email']        = $this->input->post('email');
            if ($this->input->post('datetimepicker') != "") {
                $data['birthday']     = $this->input->post('datetimepicker');
            }
            $data['gender']     = $this->input->post('gender');
            $data['phone']     = $this->input->post('phone');
            $data['address']     = $this->input->post('address');
            if ($this->input->post('password') != "") {
                $data['password']     = sha1($this->input->post('password'));
            }
            if ($_FILES['userfile']['size'] > 0) {
                $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            $data['owner_status'] = $this->input->post('owner_status');
            $this->db->where('admin_id', $param2);
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/admins/', 'refresh');
        }
        if ($param1 == 'update_profile') {
            $data['first_name']         = $this->input->post('first_name');
            $data['last_name']         = $this->input->post('last_name');
            $data['username']     = $this->input->post('username');
            $data['email']        = $this->input->post('email');
            $data['profession']        = $this->input->post('profession');
            $data['idcard']        = $this->input->post('idcard');
            if ($this->input->post('datetimepicker') != "") {
                $data['birthday']     = $this->input->post('datetimepicker');
            }
            if (!empty($_FILES['userfile']['tmp_name'])) {
                $data['image']     = md5(date('d-m-y H:i:s')) . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            $data['gender']     = $this->input->post('gender');
            $data['phone']     = $this->input->post('phone');
            $data['address']     = $this->input->post('address');
            if ($this->input->post('password') != "") {
                $data['password']     = sha1($this->input->post('password'));
            }
            $data['owner_status'] = $this->input->post('owner_status');
            $this->db->where('admin_id', $param2);
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . md5(date('d-m-y H:i:s')) . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/admin_update/' . $param2 . '/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('admin_id', $param2);
            $this->db->delete('admin');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/admins/', 'refresh');
        }
        $page_data['page_name']     = 'admins';
        $page_data['page_title']    = get_phrase('admins');
        $this->load->view('backend/index', $page_data);
    }

    function students($id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $id = $this->input->post('class_id');
        if ($id == '') {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['page_name']   = 'students';
        $page_data['page_title']  = get_phrase('students');
        $page_data['class_id']  = $id;
        $this->load->view('backend/index', $page_data);
    }

    function admin_profile($admin_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'admin_profile';
        $page_data['page_title'] =  get_phrase('profile');
        $page_data['admin_id']  =  $admin_id;
        $this->load->view('backend/index', $page_data);
    }


    function admin_update($admin_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'admin_update';
        $page_data['page_title'] =  get_phrase('update_information');
        $page_data['admin_id']  =  $admin_id;
        $this->load->view('backend/index', $page_data);
    }

    function update_account($admin_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
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
        $page_data['page_name']  = 'update_account';
        $page_data['output']  = $output;
        $page_data['page_title'] =  get_phrase('profile');
        $this->load->view('backend/index', $page_data);
    }

    function teachers($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'accept') {
            $pending = $this->db->get_where('pending_users', array('user_id' => $param2))->result_array();
            foreach ($pending as $row) {
                $data['first_name'] = $row['first_name'];
                $data['last_name'] = $row['last_name'];
                $data['email'] = $row['email'];
                $data['username'] = $row['username'];
                $data['sex'] = $row['sex'];
                $data['password'] = $row['password'];
                $data['phone'] = $row['phone'];
                $data['since'] = $row['since'];
                $this->db->insert('teacher', $data);
                $teacher_id = $this->db->insert_id();
                $this->crud_model->insert_news_readed($teacher_id, 'teacher');
                $this->mail_model->account_confirm('teacher', $teacher_id);
            }
            $this->db->where('user_id', $param2);
            $this->db->delete('pending_users');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/teachers/', 'refresh');
        }
        if ($param1 == 'create') {
            $md5 = md5(date('d-m-y H:i:s'));
            $data['first_name']        = $this->input->post('first_name');
            $data['last_name']        = $this->input->post('last_name');
            $data['sex']         = $this->input->post('gender');
            $data['email']       = $this->input->post('email');
            $data['phone']       = $this->input->post('phone');
            $data['idcard']      = $this->input->post('idcard');
            $data['since']      = date('d M, Y');
            $data['birthday']    = $this->input->post('datetimepicker');
            $data['address']     = $this->input->post('address');
            $data['username']     = $this->input->post('username');
            if (!empty($_FILES['userfile']['tmp_name'])) {
                $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            $data['password']     = sha1($this->input->post('password'));
            $this->db->insert('teacher', $data);
            $teacher_id = $this->db->insert_id();
            $this->crud_model->insert_news_readed($teacher_id, 'teacher');
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/teachers/', 'refresh');
        }
        if ($param1 == 'update') {
            $md5 = md5(date('d-m-y H:i:s'));
            $data['first_name']        = $this->input->post('first_name');
            $data['last_name']        = $this->input->post('last_name');
            $data['email']       = $this->input->post('email');
            $data['phone']       = $this->input->post('phone');
            $data['idcard']      = $this->input->post('idcard');
            $data['address']     = $this->input->post('address');
            $data['username']     = $this->input->post('username');
            if (!empty($_FILES['userfile']['tmp_name'])) {
                $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            if ($this->input->post('password') != "") {
                $data['password']     = sha1($this->input->post('password'));
            }
            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            redirect(base_url() . 'admin/teachers/', 'refresh');
        }
        if ($param1 == 'update_profile') {
            $md5 = md5(date('d-m-y H:i:s'));
            $data['first_name']        = $this->input->post('first_name');
            $data['last_name']        = $this->input->post('last_name');
            $data['email']       = $this->input->post('email');
            $data['phone']       = $this->input->post('phone');
            $data['idcard']      = $this->input->post('idcard');
            $data['birthday']    = $this->input->post('datetimepicker');
            $data['address']     = $this->input->post('address');
            $data['username']     = $this->input->post('username');
            $data['idcard']     = $this->input->post('idcard');
            $data['tempatLahir']     = $this->input->post('tempatLahir');
            $data['pendidikanTerakhir'] = $this->input->post('pendidikanTerakhir');
            if ($_FILES['userfile']['name'] != "") {
                $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            if ($this->input->post('password') != "") {
                $data['password']     = sha1($this->input->post('password'));
            }
            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            redirect(base_url() . 'admin/teacher_update/' . $param2 . '/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/teachers/', 'refresh');
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teachers';
        $page_data['page_title'] = get_phrase('teachers');
        $this->load->view('backend/index', $page_data);
    }

    function teacher_profile($teacher_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'teacher_profile';
        $page_data['page_title'] =  get_phrase('profile');
        $page_data['teacher_id']  =  $teacher_id;
        $this->load->view('backend/index', $page_data);
    }

    function teacher_update($teacher_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'teacher_update';
        $page_data['page_title'] =  get_phrase('update_information');
        $page_data['teacher_id']  =  $teacher_id;
        $this->load->view('backend/index', $page_data);
    }

    function teacher_schedules($teacher_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'teacher_schedules';
        $page_data['page_title'] =  get_phrase('teacher_schedules');
        $page_data['teacher_id']  =  $teacher_id;
        $this->load->view('backend/index', $page_data);
    }

    function teacher_subjects($teacher_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'teacher_subjects';
        $page_data['page_title'] =  get_phrase('teacher_subjects');
        $page_data['teacher_id']  =  $teacher_id;
        $this->load->view('backend/index', $page_data);
    }

    function parents($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $md5 = md5(date('d-m-y H:i:s'));
            $data['first_name']             = $this->input->post('first_name');
            $data['last_name']              = $this->input->post('last_name');
            $data['gender']                 = $this->input->post('gender');
            $data['profession']             = $this->input->post('profession');
            $data['email']                  = $this->input->post('email');
            $data['phone']                  = $this->input->post('phone');
            $data['home_phone']             = $this->input->post('home_phone');
            $data['since']             = date('d M, Y');
            $data['idcard']                 = $this->input->post('idcard');
            $data['business']               = $this->input->post('business');
            $data['business_phone']         = $this->input->post('business_phone');
            $data['address']          = $this->input->post('address');
            $data['username']     = $this->input->post('username');
            $data['password']     = sha1($this->input->post('password'));
            $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            $this->db->insert('parent', $data);
            $parent_id     =   $this->db->insert_id();
            $this->crud_model->insert_news_readed($parent_id, 'parent');
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/parents/', 'refresh');
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
            $data['username']     = $this->input->post('username');
            if ($this->input->post('password') != "") {
                $data['password'] = sha1($this->input->post('password'));
            }
            $this->db->where('parent_id', $param2);
            $this->db->update('parent', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            redirect(base_url() . 'admin/parents/', 'refresh');
        }
        if ($param1 == 'update_profile') {
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
            $data['username']     = $this->input->post('username');
            if ($this->input->post('password') != "") {
                $data['password'] = sha1($this->input->post('password'));
            }
            $this->db->where('parent_id', $param2);
            $this->db->update('parent', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/parent_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            redirect(base_url() . 'admin/parent_update/' . $param2 . '/', 'refresh');
        }
        if ($param1 == 'accept') {
            $pending = $this->db->get_where('pending_users', array('user_id' => $param2))->result_array();
            foreach ($pending as $row) {
                $data['first_name'] = $row['first_name'];
                $data['last_name'] = $row['last_name'];
                $data['email'] = $row['email'];
                $data['username'] = $row['username'];
                $data['profession'] = $row['profession'];
                $data['since'] = $row['since'];
                $data['password'] = $row['password'];
                $data['phone'] = $row['phone'];
                $this->db->insert('parent', $data);
                $parent_id = $this->db->insert_id();
                $this->crud_model->insert_news_readed($parent_id, 'parent');
                $this->mail_model->account_confirm('parent', $parent_id);
            }
            $this->db->where('user_id', $param2);
            $this->db->delete('pending_users');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/parents/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('parent_id', $param2);
            $this->db->delete('parent');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/parents/', 'refresh');
        }
        $page_data['page_title']  = get_phrase('parents');
        $page_data['page_name']  = 'parents';
        $this->load->view('backend/index', $page_data);
    }

    function notify($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'send_emails') {
            $this->mail_model->sendEmailNotify();
        }
        if ($param1 == 'sms') {
            $sms_status = $this->db->get_where('settings', array('type' => 'sms_status'))->row()->description;
            $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $class_id   =   $this->input->post('class_id');
            $receiver   =   $this->input->post('receiver');
            if ($receiver == 'student') {
                $users = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $year))->result_array();
            } else {
                $users = $this->db->get('' . $this->input->post('receiver') . '')->result_array();
            }
            $message = $this->input->post('message');
            foreach ($users as $row) {
                if ($receiver == 'student') {
                    $phones = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->phone;
                } else {
                    $phones = $row['phone'];
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
            redirect(base_url() . 'admin/notify/', 'refresh');
        }
        $page_data['page_name']  = 'notify';
        $page_data['page_title'] = get_phrase('notifications');
        $this->load->view('backend/index', $page_data);
    }

    function parent_profile($parent_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['parent_id']  = $parent_id;
        $page_data['page_name']  = 'parent_profile';
        $page_data['page_title'] = get_phrase('profile');
        $this->load->view('backend/index', $page_data);
    }

    function parent_update($parent_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['parent_id']  = $parent_id;
        $page_data['page_name']  = 'parent_update';
        $page_data['page_title'] = get_phrase('update_information');
        $this->load->view('backend/index', $page_data);
    }

    function parent_childs($parent_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['parent_id']  = $parent_id;
        $page_data['page_name']  = 'parent_childs';
        $page_data['page_title'] = get_phrase('parent_childs');
        $this->load->view('backend/index', $page_data);
    }

    function delete_student($student_id = '', $class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $tables = array('student', 'attendance', 'enroll', 'invoice', 'mark', 'payment', 'students_request', 'reporte_alumnos');
        $this->db->delete($tables, array('student_id' => $student_id));
        $threads = $this->db->get('message_thread')->result_array();
        if (count($threads) > 0) {
            foreach ($threads as $row) {
                $sender = explode('-', $row['sender']);
                $receiver = explode('-', $row['reciever']);
                if (($sender[0] == 'student' && $sender[1] == $student_id) || ($receiver[0] == 'student' && $receiver[1] == $student_id)) {
                    $thread_code = $row['message_thread_code'];
                    $this->db->delete('message', array('message_thread_code' => $thread_code));
                    $this->db->delete('message_thread', array('message_thread_code' => $thread_code));
                }
            }
        }
        $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
        redirect(base_url() . 'admin/students/', 'refresh');
    }

    function database($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'restore') {
            $this->crud_model->import_db();
            $this->session->set_flashdata('flash_message', get_phrase('restored'));
            redirect(base_url() . 'admin/database/', 'refresh');
        }
        if ($param1 == 'create') {
            $this->crud_model->create_backup();
            $this->session->set_flashdata('flash_message', get_phrase('backup_created'));
            redirect(base_url() . 'admin/database/', 'refresh');
        }
        $page_data['page_name']                 = 'database';
        $page_data['page_title']                = get_phrase('database');
        $this->load->view('backend/index', $page_data);
    }

    function sms($param1 = '', $param2 = '')
    {
        if ($param1 == 'update') {
            $data['description'] = $this->input->post('sms_status');
            $this->db->where('type', 'sms_status');
            $this->db->update('settings', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/sms/', 'refresh');
        }
        if ($param1 == 'msg91') {
            $data['description'] = $this->input->post('msg91_key');
            $this->db->where('type', 'msg91_key');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('msg91_sender');
            $this->db->where('type', 'msg91_sender');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('msg91_route');
            $this->db->where('type', 'msg91_route');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('msg91_code');
            $this->db->where('type', 'msg91_code');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/sms/', 'refresh');
        }
        if ($param1 == 'clickatell') {
            $data['description'] = $this->input->post('clickatell_username');
            $this->db->where('type', 'clickatell_username');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type', 'clickatell_password');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('clickatell_api');
            $this->db->where('type', 'clickatell_api');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/sms/', 'refresh');
        }
        if ($param1 == 'twilio') {
            $data['description'] = $this->input->post('twilio_account');
            $this->db->where('type', 'twilio_account');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('authentication_token');
            $this->db->where('type', 'authentication_token');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('registered_phone');
            $this->db->where('type', 'registered_phone');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/sms/', 'refresh');
        }
        if ($param1 == 'services') {
            $data['description'] = $this->input->post('absences');
            $this->db->where('type', 'absences');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('students_reports');
            $this->db->where('type', 'students_reports');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('p_new_invoice');
            $this->db->where('type', 'p_new_invoice');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('new_homework');
            $this->db->where('type', 'new_homework');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('s_new_invoice');
            $this->db->where('type', 's_new_invoice');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/sms/', 'refresh');
        }
        $page_data['page_name']  = 'sms';
        $page_data['page_title'] = get_phrase('sms');
        $this->load->view('backend/index', $page_data);
    }

    function landingPage($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'status') {
            $data['description'] = $this->input->post('lp_status');
            $this->db->where('type', 'lp_status');
            $this->db->update('settings', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/landingPage/', 'refresh');
        }

        if ($param1 == 'banner') {
            $data['description'] = $this->input->post('banner');
            $this->db->where('type', 'banner');
            $this->db->update('settings', $data);
            $name = 'banner';
            move_uploaded_file($_FILES['banner']['tmp_name'], 'uploads/' . $name . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/landingPage/', 'refresh');
        }

        if ($param1 == 'imgCenter') {
            $data['description'] = $this->input->post('imgCenter');
            $this->db->where('type', 'imgCenter');
            $this->db->update('settings', $data);
            $name = 'imgCenter';
            move_uploaded_file($_FILES['imgCenter']['tmp_name'], 'uploads/' . $name . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/landingPage/', 'refresh');
        }
        if ($param1 == 'wave') {
            $data['description'] = $this->input->post('wave1');
            $this->db->where('type', 'wave1');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('wave2');
            $this->db->where('type', 'wave2');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('wave3');
            $this->db->where('type', 'wave3');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('wave4');
            $this->db->where('type', 'wave4');
            $this->db->update('settings', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/landingPage/', 'refresh');
        }
        $page_data['page_name']  = 'landingPage';
        $page_data['page_title'] = 'landing page';
        $this->load->view('backend/index', $page_data);
    }
    function delete_banner()
    {
        unlink('uploads/banner.jpg');
        $this->db->where('type', 'banner');
        $this->db->update('settings', 'description');
        $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
        redirect(base_url() . 'admin/landingPage/', 'refresh');
    }

    function delete_imgCenter()
    {
        unlink('uploads/imgCenter.jpg');
        $this->db->where('type', 'imgCenter');
        $this->db->update('settings', 'description');
        $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
        redirect(base_url() . 'admin/landingPage/', 'refresh');
    }

    function email($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'template') {
            $data['subject'] = $this->input->post('subject');
            $data['body'] = $this->input->post('body');
            $this->db->where('email_template_id', $param2);
            $this->db->update('email_template', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/email/', 'refresh');
        }
        $page_data['page_name']  = 'email';
        $page_data['current_email_template_id']  = 1;
        $page_data['page_title'] = get_phrase('email_settings');
        $this->load->view('backend/index', $page_data);
    }

    function view_teacher_report()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'view_teacher_report';
        $page_data['page_title'] = get_phrase('teacher_report');
        $this->load->view('backend/index', $page_data);
    }

    function translate($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'update') {
            $page_data['edit_profile']  = $param2;
        }
        if ($param1 == 'update_phrase') {
            $language   =   $param2;
            $total_phrase   =   $this->input->post('total_phrase');
            for ($i = 1; $i <= $total_phrase; $i++) {
                $this->db->where('phrase_id', $i);
                $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
            }
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/translate/update/' . $language, 'refresh');
        }
        if ($param1 == 'add') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);
            move_uploaded_file($_FILES['file_name']['tmp_name'], 'style/flags/' . $this->input->post('language') . '.png');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/translate/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $language        = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('flash_message', "");
            redirect(base_url() . 'admin/translate/', 'refresh');
        }
        $page_data['page_name']  = 'translate';
        $page_data['page_title'] = get_phrase('translate');
        $this->load->view('backend/index', $page_data);
    }

    function polls($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['question'] = $this->input->post('question');
            foreach ($this->input->post('options') as $row) {
                $data['options'] .= $row . ',';
            }
            $data['user'] = $this->input->post('user');
            $data['status'] = 1;
            $data['date'] = date('d M');
            $data['date2'] = date('h:i A');
            $data['admin_id']        = $this->session->userdata('login_user_id');
            $data['type'] = "polls";
            $data['publish_date']        = date('Y-m-d H:i:s');
            $data['poll_code'] = substr(md5(rand(0, 1000000)), 0, 7);
            $this->crud_model->send_polls_notify();
            $this->db->insert('polls', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/panel/', 'refresh');
        }
        if ($param1 == 'create_wall') {
            $data['question'] = $this->input->post('question');
            foreach ($this->input->post('options') as $row) {
                $data['options'] .= $row . ',';
            }
            $data['user'] = $this->input->post('user');
            $data['status'] = 1;
            $data['date'] = date('d M');
            $this->crud_model->send_polls_notify();
            $data['date2'] = date('h:i A');
            $data['admin_id']        = $this->session->userdata('login_user_id');
            $data['type'] = "polls";
            $data['publish_date']        = date('Y-m-d H:i:s');
            $data['poll_code'] = substr(md5(rand(0, 1000000)), 0, 7);
            $this->db->insert('polls', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/polls/', 'refresh');
        }
        if ($param1 == 'response') {
            $data['poll_code'] = $this->input->post('poll_code');
            $data['answer'] = $this->input->post('answer');
            $data['date2'] = date('h:i A');
            $user = $this->session->userdata('login_user_id');
            $user_type = $this->session->userdata('login_type');
            $data['user'] = $user_type . "-" . $user;
            $data['date'] = date('d M, Y');
            $this->db->insert('poll_response', $data);
        }
        if ($param1 == 'delete') {
            $this->db->where('poll_code', $param2);
            $this->db->delete('polls');
            $this->db->where('poll_code', $param2);
            $this->db->delete('poll_response');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/panel/', 'refresh');
        }
        if ($param1 == 'delete2') {
            $this->db->where('poll_code', $param2);
            $this->db->delete('polls');
            $this->db->where('poll_code', $param2);
            $this->db->delete('poll_response');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/polls/', 'refresh');
        }
        $page_data['page_name']  = 'polls';
        $page_data['page_title'] = get_phrase('polls');
        $this->load->view('backend/index', $page_data);
    }

    function view_poll($code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['code'] = $code;
        $page_data['page_name']  = 'view_poll';
        $page_data['page_title'] = get_phrase('poll_details');
        $this->load->view('backend/index', $page_data);
    }

    function new_poll($code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'new_poll';
        $page_data['page_title'] = get_phrase('new_poll');
        $this->load->view('backend/index', $page_data);
    }

    function admissions($param1 = '', $param2 = '', $param3 = '')
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($_GET['id'] != "") {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'reject') {
            $this->db->where('user_id', $param2);
            $this->db->delete('pending_users');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/pending/', 'refresh');
        }
        $page_data['page_name']  = 'admissions';
        $page_data['page_title'] = get_phrase('admissions');
        $this->load->view('backend/index', $page_data);
    }

    function get_class_area()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $id = $this->input->post('class_id');
        redirect(base_url() . 'admin/students_area/' . $id . "/", 'refresh');
    }

    function student_portal($student_id, $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class_id     = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description))->row()->class_id;
        $page_data['page_name']  = 'student_portal';
        $page_data['page_title'] =  get_phrase('student_portal');
        $page_data['student_id'] =  $student_id;
        $page_data['class_id']   =   $class_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_update($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_update';
        $page_data['page_title'] =  get_phrase('student_portal');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_marks($student_id = '', $param1 = '', $tahun_ajaran = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'project') {
            $this->db->where('student_id', $student_id);
            $this->db->where('year', $tahun_ajaran);
            $this->db->update('enroll', array('project' => $this->input->post('project')));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/student_marks/' . $student_id . '?year=' . $tahun_ajaran);
        }
        $page_data['page_name']  = 'student_marks';
        $page_data['page_title'] =  get_phrase('student_marks');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_attendance_report_selector()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['month']  = $this->input->post('month');
        $data['section_id'] = $this->input->post('section_id');
        redirect(base_url() . 'admin/student_profile_attendance/' . $this->input->post('student_id') . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['month'] . '/' . $data['year'] . '/', 'refresh');
    }

    function student_profile_attendance($student_id = '', $param1 = '', $param2 = '', $param3 = '', $param4 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_profile_attendance';
        $page_data['page_title'] =  get_phrase('student_attendance');
        $page_data['student_id'] =  $student_id;
        $page_data['class_id'] =  $param1;
        $page_data['section_id'] =  $param2;
        $page_data['month'] =  $param3;
        $page_data['year'] =  $param4;
        $this->load->view('backend/index', $page_data);
    }

    function student_profile_report($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_profile_report';
        $page_data['page_title'] =  get_phrase('behavior');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function student_info($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_info';
        $page_data['page_title'] =  get_phrase('student_portal');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function get_sections($class_id = '')
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/student_bulk_sections', $page_data);
    }

    function my_account($param1 = "", $page_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        include_once 'src/Google_Client.php';
        include_once 'src/contrib/Google_Oauth2Service.php';
        $clientId = $this->db->get_where('settings', array('type' => 'google_sync'))->row()->description; //Google client ID
        $clientSecret = $this->db->get_where('settings', array('type' => 'google_login'))->row()->description; //Google client secret
        $redirectURL = base_url() . 'auth/sync/';
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
            $this->db->where('admin_id', $this->session->userdata('login_user_id'));
            $this->db->update('admin', $data);
            $this->session->set_flashdata('flash_message', get_phrase('facebook_delete'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == '1') {
            $this->session->set_flashdata('error_message', get_phrase('google_err'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == '3') {
            $this->session->set_flashdata('error_message', get_phrase('facebook_err'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == '2') {
            $this->session->set_flashdata('flash_message', get_phrase('google_true'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == '4') {
            $this->session->set_flashdata('flash_message', get_phrase('facebook_true'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
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
            $this->db->where('admin_id', $this->session->userdata('login_user_id'));
            $this->db->update('admin', $data);

            unset($_SESSION['token']);
            unset($_SESSION['userData']);
            $gClient->revokeToken();
            $this->session->set_flashdata('flash_message', get_phrase('google_delete'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == 'update_profile') {
            $data['first_name']         = $this->input->post('first_name');
            $data['last_name']         = $this->input->post('last_name');
            $data['username']     = $this->input->post('username');
            $data['email']        = $this->input->post('email');
            $data['profession']        = $this->input->post('profession');
            $data['idcard']        = $this->input->post('idcard');
            if ($this->input->post('datetimepicker') != "") {
                $data['birthday']     = $this->input->post('datetimepicker');
            }
            if (!empty($_FILES['userfile']['tmp_name'])) {
                $data['image']     = md5(date('d-m-y H:i:s')) . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            $data['gender']     = $this->input->post('gender');
            $data['phone']     = $this->input->post('phone');
            $data['address']     = $this->input->post('address');
            if ($this->input->post('password') != "") {
                $data['password']     = sha1($this->input->post('password'));
            }
            $this->db->where('admin_id', $this->session->userdata('login_user_id'));
            $this->db->update('admin', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . md5(date('d-m-y H:i:s')) . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/update_account/', 'refresh');
        }

        $data['page_name']              = 'my_account';
        $data['output']         = $output;
        $data['page_title']             = get_phrase('profile');
        $this->load->view('backend/index', $data);
    }

    function create_report_message($code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
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

    function view_report($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id'])) {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'update') {
            $data['status'] = 1;
            $this->db->where('report_code', $param2);
            $this->db->update('reporte_alumnos', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/view_report/' . $param2, 'refresh');
        }
        $page_data['report_code'] = $param1;
        $page_data['page_title'] =   get_phrase('report_details');
        $page_data['page_name']  = 'view_report';
        $this->load->view('backend/index', $page_data);
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
            redirect(base_url() . 'admin/forum_konseling/', 'refresh');
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
            redirect(base_url() . 'admin/edit_forum_konseling/' . $param2, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud_model->delete_post($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/forum_konseling/' . $param3 . "/", 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'forum_konseling';
        $page_data['page_title'] = get_phrase('forum');
        $this->load->view('backend/index', $page_data);
    }

    function edit_forum_konseling($code = '')
    {
        $page_data['page_name']  = 'edit_forum_konseling';
        $page_data['page_title'] = get_phrase('update_forum');
        $page_data['code']   = $code;
        $this->load->view('backend/index', $page_data);
    }


    function forumroom_konseling($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
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

    function forum_message_diskusi($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') {
            echo $this->input->post('message');
            $this->crud_model->create_post_message($this->input->post('post_code'));
        }
    }

    function get_class_students_mass($class_id = '')
    {
        $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description))->result_array();
        echo '
        <div class="col-sm-12">';
        foreach ($students as $row) {
            $idn = $this->db->get_where('student', array('student_id' => $row['student_id'], 'idn' => 1))->row()->student_id;
            if ($row['student_id'] != $idn) {
                continue;
            }
            echo '<div class="custom-control custom-checkbox">';
            echo '<input checked type="checkbox" name="student_id[]" id="' . $row['student_id'] . '" value="' . $row['student_id'] . '" class="custom-control-input"> <label for="' . $row['student_id'] . '" class="custom-control-label">' . $this->crud_model->get_name('student', $row['student_id'])  . '</label>';
            echo '</div>';
        }
        echo '</div>';
    }

    function search_query($search_key = '')
    {
        if ($_POST) {
            redirect(base_url() . 'admin/search_results?query=' . base64_encode($this->input->post('search_key')), 'refresh');
        }
    }

    function search_results()
    {
        if ($this->session->userdata('admin_login') != 1) {
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

    function looking_report($report_code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
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

    function looking_karakter($student_id = '', $week = null)
    {
        if ($this->session->userdata('admin_login') != 1) {
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

    function request_student($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id'])) {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == "accept") {

            $data['status'] = 1;
            $this->db->update('students_request', $data, array('request_id' => $param2));
            $student = $this->db->get_where('students_request', array('request_id' => $param2))->row()->student_id;
            $parent = $this->db->get_where('students_request', array('request_id' => $param2))->row()->parent_id;
            $notify['notify'] = "<strong>" .  $this->crud_model->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id')) . "</strong>" . " " . get_phrase('absence_approved_for') . " <b>" . $this->db->get_where('student', array('student_id' => $student))->row()->first_name . "</b>";
            $notify['user_id'] = $parent;
            $notify['user_type'] = "parent";
            $notify['url'] = "parents/request";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/request/', 'refresh');
        }

        if ($param1 == "reject") {
            $data['status'] = 2;
            $this->db->update('students_request', $data, array('request_id' => $param2));

            $parent = $this->db->get_where('students_request', array('request_id' => $param2))->row()->parent_id;
            $student = $this->db->get_where('students_request', array('request_id' => $param2))->row()->student_id;
            $notify['notify'] = "<strong>" . $this->crud_model->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id')) . "</strong>" . " " . get_phrase('absence_rejected_for') . " <b>" . $this->db->get_where('student', array('student_id' => $student))->row()->first_name . "</b>";
            $notify['user_id'] = $parent;
            $notify['user_type'] = "parent";
            $notify['url'] = "parents/request";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify);
            $this->session->set_flashdata('flash_message', get_phrase('rejected_successfully'));
            redirect(base_url() . 'admin/request/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('report_code', $param2);
            $this->db->delete('report_response');
            $this->db->where('code', $param2);
            $this->db->delete('reports');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/request_student/', 'refresh');
        }
        if ($param1 == 'delete_teacher') {
            $this->db->where('report_code', $param2);
            $this->db->delete('reporte_alumnos');
            $this->db->where('report_code', $param2);
            $this->db->delete('reporte_mensaje');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/request_student/', 'refresh');
        }
        $data['page_name']  = 'request_student';
        $data['page_title'] = get_phrase('reports');
        $this->load->view('backend/index', $data);
    }


    //Download admission sheet function.
    function download_file($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['pw2']  = $param3;
        $page_data['pw']  = $param2;
        $page_data['student_id']  = $param1;
        $page_data['page_name']  = 'download_file';
        $page_data['page_title'] = 'Unduh Berkas';
        $this->load->view('backend/index', $page_data);
    }
    function generate($student_id, $pw, $pw2 = '')
    {
        $data = array(
            'student_id' => $student_id,
            'pw' => $pw,
            'pw2' => $pw2
        );
        $today = date('d-m-Y_h:i:s');
        $html = $this->load->view('backend/downloadsheet.php', $data, TRUE);
        $stylesheet = file_get_contents(base_url() . 'assets/css/css1.css');
        $pdfFilePath = "student_sheet-" . $today . ".pdf";
        $this->load->library('M_pdf');
        $mpdf = new mPDF('utf-8', 'A4', 0, '', 10, 10, 10, 0, 0, 'L');
        $mpdf->packTableData = false;
        $mpdf->WriteHTML($stylesheet, 1);
        $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $mpdf->WriteHTML($html, 2);
        $mpdf->Output($pdfFilePath, "I");
    }

    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if ($param1 == 'excel') {
            return false;
            // $objPHPExcel = new PHPExcel();
            // $objPHPExcel->setActiveSheetIndex(0);
            // $objPHPExcel->getActiveSheet()->setCellValue('A1', get_phrase('first_name'));
            // $objPHPExcel->getActiveSheet()->setCellValue('B1', get_phrase('last_name'));
            // $objPHPExcel->getActiveSheet()->setCellValue('C1', get_phrase('username'));
            // $objPHPExcel->getActiveSheet()->setCellValue('D1', get_phrase('email'));
            // $objPHPExcel->getActiveSheet()->setCellValue('E1', get_phrase('phone'));
            // $objPHPExcel->getActiveSheet()->setCellValue('F1', get_phrase('gender'));
            // $objPHPExcel->getActiveSheet()->setCellValue('G1', get_phrase('class'));
            // $objPHPExcel->getActiveSheet()->setCellValue('H1', get_phrase('section'));
            // $objPHPExcel->getActiveSheet()->setCellValue('I1', get_phrase('parent'));

            // $a = 2;
            // $b = 2;
            // $c = 2;
            // $d = 2;
            // $e = 2;
            // $f = 2;
            // $g = 2;
            // $h = 2;
            // $i = 2;

            // $query = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $running_year))->result_array();
            // foreach ($query as $row) {
            //     $objPHPExcel->getActiveSheet()->setCellValue('A' . $a++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->first_name);
            //     $objPHPExcel->getActiveSheet()->setCellValue('B' . $b++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->last_name);
            //     $objPHPExcel->getActiveSheet()->setCellValue('C' . $c++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->username);
            //     $objPHPExcel->getActiveSheet()->setCellValue('D' . $d++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email);
            //     $objPHPExcel->getActiveSheet()->setCellValue('E' . $e++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->phone);
            //     $objPHPExcel->getActiveSheet()->setCellValue('F' . $f++, $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->sex);
            //     $objPHPExcel->getActiveSheet()->setCellValue('G' . $g++, $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name);
            //     $objPHPExcel->getActiveSheet()->setCellValue('H' . $h++, $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name);
            //     $parent_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id;
            //     $objPHPExcel->getActiveSheet()->setCellValue('I' . $i++, $this->crud_model->get_name('parent', $parent_id));
            // }
            // $objPHPExcel->getActiveSheet()->setTitle('Estudiantes');

            // header("Pragma: public");
            // header("Expires: 0");
            // header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            // header("Content-Type: application/force-download");
            // header("Content-Type: application/octet-stream");
            // header("Content-Type: application/download");
            // header('Content-Type: application/vnd.ms-excel');
            // header('Content-Disposition: attachment;filename="export_students_' . date('d-m-y:h:i:s') . '.xlsx"');
            // header("Content-Transfer-Encoding: binary ");
            // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            // $objWriter->setOffice2003Compatibility(true);
            // $objWriter->save('php://output');
        }
        if ($param1 == 'addmission') {
            $md5 = md5(date('d-m-Y H:i:s'));
            $data['first_name']           = $this->input->post('first_name');
            $data['last_name']           = $this->input->post('last_name');
            $name = $data['first_name'] . ' ' . $data['last_name'];
            $data['birthday']       = $this->input->post('datetimepicker');
            $data['username']       = $this->input->post('username');
            $data['student_session'] = 1;
            $data['email']          = $this->input->post('email');
            $data['since']           = date("d M,Y");
            $data['phone']          = $this->input->post('phone');
            $data['tempat_lahir']          = $this->input->post('tempat_hahir');
            $data['sex']            = $this->input->post('gender');
            $data['password']       = sha1($this->input->post('password'));
            $data['address']        = $this->input->post('address');
            $data['transport_id']  = $this->input->post('transport_id');
            $data['dormitory_id']  = $this->input->post('dormitory_id');
            $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            if ($this->input->post('account') != '1') {
                $data['parent_id']      = $this->input->post('parent_id');
                $parent_phone = $this->db->get_where('parent', array('parent_id' => $data['parent_id']))->row('phone');
                $parent_email = $this->db->get_where('parent', array('parent_id' => $data['parent_id']))->row('email');
            } else if ($this->input->post('account') == '1') {
                $data3['first_name']             = $this->input->post('parent_first_name');
                $data3['last_name']              = $this->input->post('parent_last_name');
                $data3['gender']                 = $this->input->post('parent_gender');
                $data3['profession']             = $this->input->post('parent_profession');
                $data3['email']                  = $this->input->post('parent_email');
                $parent_email = $data3['email'];
                $data3['phone']                  = $this->input->post('parent_phone');
                $parent_phone = $data3['phone'];
                $data3['home_phone']             = $this->input->post('parent_home_phone');
                $data3['idcard']                 = $this->input->post('parent_idcard');
                $data3['business']               = $this->input->post('parent_business');
                $data3['since']           = date("d M,Y");
                $data3['business_phone']         = $this->input->post('parent_business_phone');
                $data3['address']          = $this->input->post('parent_address');
                $data3['username']     = $this->input->post('parent_username');
                $data3['password']     = sha1($this->input->post('parent_password'));
                $data3['image']     = "";
                $this->db->insert('parent', $data3);
                $parent_id = $this->db->insert_id();
                $this->crud_model->insert_news_readed($parent_id, 'parent');
                $data['parent_id']      = $parent_id;
            }
            $data['diseases']  = $this->input->post('diseases');
            $data['allergies']  = $this->input->post('allergies');
            $data['doctor']  = $this->input->post('doctor');
            $data['doctor_phone']  = $this->input->post('doctor_phone');
            $data['authorized_person']  = $this->input->post('auth_person');
            $data['authorized_phone']  = $this->input->post('auth_phone');
            $data['note']  = $this->input->post('note');
            $note = $data['note'];
            $this->db->insert('student', $data);
            $student_id = $this->db->insert_id();
            $this->crud_model->insert_news_readed($student_id, 'student');
            $data4['student_id']     = $student_id;
            $data4['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
            $data4['class_id']       = $this->input->post('class_id');
            if ($this->input->post('section_id') != '') {
                $data4['section_id'] = $this->input->post('section_id');
            }
            $data4['roll']           = $this->input->post('roll');
            $roll = $data4['roll'];
            $data4['date_added']     = strtotime(date("Y-m-d H:i:s"));
            $data4['year']           = $running_year;
            $this->db->insert('enroll', $data4);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            // insert to idn
            $input_to_idn = idn_post_student($name, $roll, $student_id, $parent_phone, $parent_email, $note);

            if ($this->input->post('download_pdf') == '1') {
                if ($this->input->post('account') != '1') {
                    redirect(base_url() . 'admin/download_file/' . $student_id . '/' . base64_encode($this->input->post('password')), 'refresh');
                } else {
                    redirect(base_url() . 'admin/download_file/' . $student_id . '/' . base64_encode($this->input->post('password')) . '/' . base64_encode($this->input->post('parent_password')), 'refresh');
                }
            } else {
                redirect(base_url() . 'admin/new_student/', 'refresh');
            }
        }
        if ($param1 == 'do_update') {
            $md5 = md5(date('d-m-Y H:i:s'));
            $data['first_name']      = $this->input->post('first_name');
            $data['last_name']       = $this->input->post('last_name');
            $data['birthday']        = $this->input->post('datetimepicker');
            $data['email']           = $this->input->post('email');
            $data['tempat_lahir']           = $this->input->post('tempat_lahir');
            $data['sekolah']           = $this->input->post('sekolah');
            $data['phone']           = $this->input->post('phone');
            $data['sex']             = $this->input->post('gender');
            $data['username']        = $this->input->post('username');
            if ($this->input->post('password') != "") {
                $data['password'] = sha1($this->input->post('password'));
            }
            $data['address']         = $this->input->post('address');
            $data['transport_id']    = $this->input->post('transport_id');
            $data['dormitory_id']    = $this->input->post('dormitory_id');
            $data['diseases']    = $this->input->post('diseases');
            $data['allergies']    = $this->input->post('allergies');
            $data['doctor']    = $this->input->post('doctor');
            $data['doctor_phone']    = $this->input->post('doctor_phone');
            $data['authorized_person']    = $this->input->post('auth_person');
            $data['authorized_phone']    = $this->input->post('auth_phone');
            $data['note']    = $this->input->post('note');
            if ($_FILES['userfile']['size'] > 0) {
                $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            $data['parent_id']       = $this->input->post('parent_id');
            $data['student_session'] = $this->input->post('student_session');
            $this->db->where('student_id', $param2);
            $this->db->update('student', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));

            $data2['roll'] = $this->input->post('roll');
            $data2['class_id'] = $this->input->post('class_id');
            $data2['section_id'] = $this->input->post('section_id');
            $this->db->where('student_id', $param2);
            $this->db->update('enroll', $data2);

            // insert to idn
            $name = $data['first_name'] . ' ' . $data['last_name'];
            $roll = $data2['roll'];
            $parent_phone = $this->db->get_where('parent', array('parent_id' => $data['parent_id']))->row('phone');
            $parent_email = $this->db->get_where('parent', array('parent_id' => $data['parent_id']))->row('email');
            $note = $data['note'];
            $update_to_idn = idn_put_student($name, $roll, $student_id, $parent_phone, $parent_email, $note);

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->crud_model->clear_cache();
            redirect(base_url() . 'admin/student_update/' . $param2 . '/', 'refresh');
        }
        if ($param1 == 'do_updates') {
            $md5 = md5(date('d-m-Y H:i:s'));
            $data['first_name']            = $this->input->post('first_name');
            $data['last_name']            = $this->input->post('last_name');
            $data['username']        = $this->input->post('username');
            $data['phone']           = $this->input->post('phone');
            $data['address']         = $this->input->post('address');
            $data['parent_id']       = $this->input->post('parent_id');
            $data['student_session'] = $this->input->post('student_session');
            $data['email']           = $this->input->post('email');
            if ($_FILES['userfile']['size'] > 0) {
                $data['image']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            if ($this->input->post('password') != "") {
                $data['password'] = sha1($this->input->post('password'));
            }
            $this->db->where('student_id', $param2);
            $this->db->update('student', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            redirect(base_url() . 'admin/students/', 'refresh');
        }
        if ($param1 == 'insert_idn') {
            $student_id = $this->db->get_where('enroll', array('roll' => $param2))->row('student_id');
            $student = $this->db->get_where('student', array('student_id' => $student_id))->row();

            $name = $student->first_name . ' ' . $student->last_name;
            $roll = $param2;
            $parent_phone = $this->db->get_where('parent', array('parent_id' => $student->parent_id))->row('phone');
            $parent_email = $this->db->get_where('parent', array('parent_id' => $student->parent_id))->row('email');
            $note = $student->note;
            $insert_to_idn = idn_post_student($name, $roll, $student_id, $parent_phone, $parent_email, $note);
            $this->db->where('student_id', $student_id);
            $this->db->update('student', array('idn' => 1));
            if ($insert_to_idn) {
                $this->session->set_flashdata('flash_message', 'Data terintegrasi dengan IDN');
            } else {
                $this->session->set_flashdata('flash_message', 'Data gagal terintegrasi dengan IDN');
            }
            redirect(base_url() . 'admin/students/', 'refresh');
        }

        if ($param1 == 'sync_idn') {
            $students = $this->db->get_where('enroll', array('class_id' => $param2, 'year' => $running_year))->result_array();
            foreach ($students as $row) {
                $get_from_idn = idn_get_student($row['roll']);
                $status = $get_from_idn['status'];
                if ($status == 'OK') {
                    $this->db->where('student_id', $row['student_id']);
                    $this->db->update('student', array('idn' => 1));
                } else {
                    $this->db->where('student_id', $row['student_id']);
                    $this->db->update('student', array('idn' => 0));
                }
            }
            $this->session->set_flashdata('flash_message', 'Data sudah sinkron dengan IDN');
            redirect(base_url() . 'admin/students/', 'refresh');
        }

        if ($param1 == 'accept') {
            $pending = $this->db->get_where('pending_users', array('user_id' => $param2))->result_array();
            foreach ($pending as $row) {
                $data['first_name'] = $row['first_name'];
                $data['last_name'] = $row['last_name'];
                $data['address'] = $row['address'];
                $data['email'] = $row['email'];
                $data['sekolah'] = $row['sekolah'];
                $data['username'] = $row['username'];
                $data['sex'] = $row['sex'];
                $data['password'] = $row['password'];
                $data['birthday'] = $row['birthday'];
                $data['tempat_lahir'] = $row['tempat_lahir'];
                $data['phone'] = $row['phone'];
                $data['since'] = $row['since'];
                $data['date'] = date('d M, Y');
                $this->db->insert('student', $data);
                $student_id = $this->db->insert_id();
                $this->crud_model->insert_news_readed($student_id, 'student');

                $data2['student_id']     = $student_id;
                $data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
                $data2['class_id']       = $row['class_id'];
                $data2['section_id']     = $row['section_id'];
                $data2['roll']           = $row['roll'];
                $data2['no_serial']           = $row['no_serial'];
                $data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
                $data2['year']           = $running_year;
                $this->db->insert('enroll', $data2);
                $this->mail_model->account_confirm('student', $student_id);
            }
            $this->db->where('user_id', $param2);
            $this->db->delete('pending_users');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/students/', 'refresh');
        }
        if ($param1 == 'bulk') {
            $path = $_FILES["upload_student"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $data['first_name']    =  $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $data['last_name']     =  $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $data['email']         =  $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $data['phone']         =  $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $data['sex']           =  $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $data['username']      =  $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $data['password']      =  sha1($worksheet->getCellByColumnAndRow(6, $row)->getValue());
                    $data['address']       =  $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $data['since']         =  date('d M, Y');
                    if ($data['first_name'] != "") {
                        $this->db->insert('student', $data);
                        $student_id = $this->db->insert_id();
                        $this->crud_model->insert_news_readed($student_id, 'student');
                        $data2['enroll_code']   =   substr(md5(rand(0, 1000000)), 0, 7);
                        $data2['student_id']    =   $student_id;
                        $data2['class_id']      =   $this->input->post('class_id');
                        if ($this->input->post('section_id') != '') {
                            $data2['section_id']    =   $this->input->post('section_id');
                        }
                        $data2['roll']          =   $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $data2['date_added']    =   strtotime(date("Y-m-d H:i:s"));
                        $data2['year']          =   $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
                        $this->db->insert('enroll', $data2);
                    }
                }
            }
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/students/', 'refresh');
        }
    }

    function student_promotion($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'promote') {
            $running_year  =   $this->input->post('running_year');
            $from_class_id =   $this->input->post('promotion_from_class_id');

            $cek_enroll = $this->db->get_where('enroll', ['class_id' => $from_class_id, 'year' => $this->input->post('promotion_year')])->num_rows();
            if ($cek_enroll === 0) {
                $students_of_promotion_class =   $this->db->get_where('enroll', array('class_id' => $from_class_id, 'year' => $running_year))->result_array();
                foreach ($students_of_promotion_class as $row) {

                    $enroll_data['enroll_code']     =   substr(md5(rand(0, 1000000)), 0, 7);
                    $enroll_data['student_id']      =   $row['student_id'];
                    $enroll_data['section_id']       =   $row['section_id'];
                    $enroll_data['class_id']        =   $this->input->post('promotion_to_class_id');
                    $enroll_data['year']            =   $this->input->post('promotion_year');
                    $enroll_data['no_serial']       = date('YmdHis') . $row['student_id'] . date(0, 9);
                    $enroll_data['date_added']      =   strtotime(date("Y-m-d H:i:s"));
                    $this->db->insert('enroll', $enroll_data);
                }
            }
            $this->session->set_flashdata('flash_message', get_phrase('successfully_promoted'));
            redirect(base_url() . 'admin/student_promotion', 'refresh');
        }
        $page_data['page_title']    = get_phrase('student_promotion');
        $page_data['page_name']  = 'student_promotion';
        $this->load->view('backend/index', $page_data);
    }

    function get_students_to_promote($class_id_from = '', $class_id_to  = '', $running_year  = '', $promotion_year = '')
    {
        $page_data['class_id_from']     =   $class_id_from;
        $page_data['class_id_to']       =   $class_id_to;
        $page_data['running_year']      =   $running_year;
        $page_data['promotion_year']    =   $promotion_year;
        $this->load->view('backend/admin/student_promotion_selector', $page_data);
    }

    function view_marks($student_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $year =  $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $class_id     = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $year))->row()->class_id;
        $page_data['class_id']   =   $class_id;
        $page_data['page_name']  = 'view_marks';
        $page_data['page_title'] = get_phrase('marks');
        $page_data['student_id']   = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    function subject_marks($data = '', $tahun_ajaran = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_marks';
        $page_data['tahun_ajaran']    = $tahun_ajaran;
        $page_data['page_title']   = get_phrase('subject_marks');
        $this->load->view('backend/index', $page_data);
    }

    function subject_dashboard($data = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_dashboard';
        $page_data['page_title']   = get_phrase('subject_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function courses($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $md5 = md5(date('d-m-y H:i:s'));
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['color']   = $this->input->post('color');
            $data['icon']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['about'] = $this->input->post('about');
            $data['year']       = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $this->db->insert('subject', $data);
            $subject_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/subject_icon/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/cursos/' . base64_encode($param2) . "/", 'refresh');
        }
        if ($param1 == 'create_relasi_mapel_guru') {
            $md5 = md5(date('d-m-y H:i:s'));
            $subject_id = $this->input->post('relasi_subject_id');
            $teacher_id = $this->input->post('relasi_teacher_id');
            $q_mg = $this->db->from('relasi_mapel_guru')->where('subject_id', $subject_id)->where('teacher_id', $teacher_id);
            $r_mg = $q_mg->get();
            $row_mg = $r_mg->row();

            // cek apakah mapel dan guru sudah ada
            if (isset($row_mg)) {
                $this->session->set_flashdata('flash_message', 'Mata Pelajaran untuk mentor berikut sudah ada!');
            } else {
                $data['subject_id'] = $subject_id;
                $data['teacher_id'] = $teacher_id;
                $this->db->insert('relasi_mapel_guru', $data);
                $subject_id = $this->db->insert_id();
                $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            }
            redirect(base_url() . 'admin/cursos/' . base64_encode($param2) . "/", 'refresh');
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
            redirect(base_url() . 'admin/upload_marks/' . base64_encode($class_id . "-" . $this->input->post('section_id') . "-" . $param2) . '/', 'refresh');
        }
        if ($param1 == 'update') {
            $class_id = $this->db->get_where('subject', array('subject_id' => $param2))->row()->class_id;
            $md5 = md5(date('d-m-y H:i:s'));
            $data['color']   = $this->input->post('color');
            if ($_FILES['userfile']['size'] > 0) {
                $data['icon']     = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
            }
            $data['section_id']   = $this->input->post('section_id');
            $data['name'] = $this->input->post('name');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['about'] = $this->input->post('about');
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/subject_icon/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/cursos/' . base64_encode($class_id . "-" . $this->input->post('section_id') . '-' . $param2) . "/", 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('relasi_mapel_guru');
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/cursos/' . base64_encode($param2) . "/", 'refresh');
        }
        $class = $this->input->post('class_id');
        if ($class == '') {
            $class = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['class_id']   = $class;
        $page_data['subjects']   = $this->db->get_where('subject', array('class_id' => $param1))->result_array();
        $page_data['page_name']  = 'coursess';
        $page_data['page_title'] = get_phrase('subjects');
        $this->load->view('backend/index', $page_data);
    }

    public function cek_relasi_pelajaran_guru()
    {
        $status = false;
        $post = $this->input->post();

        $subject_id = $post['relasi_subject_id'];
        $teacher_id = $post['relasi_teacher_id'];
        $q_mg = $this->db->from('relasi_mapel_guru')->where('subject_id', $subject_id)->where('teacher_id', $teacher_id);
        $r_mg = $q_mg->get();
        $row_mg = $r_mg->row();
        // cek apakah mapel dan guru sudah ada
        if (isset($row_mg)) {
            $status = true;
        }

        $response = array(
            'status' => $status,
            'post' => $post,
        );

        echo json_encode($response);
    }

    public function get_ex_teacher_by_subject()
    {
        $status = false;
        $post = $this->input->post();
        $q_s = $this->db->from('subject s')->where('s.subject_id', $post['relasi_subject_id']);
        $r_s = $q_s->get();
        $row_s = $r_s->row();
        $array_teacher_id = array();
        $data = array();

        if (isset($row_s)) {
            $status = true;

            foreach ($r_s->result() as $key => $value) {
                array_push($array_teacher_id, $value->teacher_id);
            }

            $q_rmp = $this->db->select('t.teacher_id, t.first_name, t.last_name')->from('teacher t')->join('subject s', 's.teacher_id = t.teacher_id', 'left')->join('relasi_mapel_guru rmg', 'rmg.teacher_id = t.teacher_id', 'left')->where_not_in('t.teacher_id', $array_teacher_id)->group_by('t.teacher_id');
            $r_rmp = $q_rmp->get();
            $teachers = $r_rmp->result();

            $data[] = "<option value=\"\">-- Pilih --</option>";
            foreach ($teachers as $row) {
                $data[] = "<option value=\"" . $row->teacher_id . "\">" . $row->first_name . " " . $row->last_name . "</option>";
            }
        }

        $response = array(
            'status' => $status,
            'post' => $post,
            'array_teacher_id' => $array_teacher_id,
            'data' => $data,
        );

        echo json_encode($response);
    }

    public function hapus_relasi_pelajaran_guru()
    {
        $status = false;
        $post = $this->input->post();

        $this->db->delete('relasi_mapel_guru', array(
            'id_relasi' => $post['id_relasi'],
        ));

        if ($this->db->affected_rows()) {
            $status = true;
        }

        $response = array(
            'status' => $status,
            'post' => $post,
        );

        echo json_encode($response);
    }

    function online_exam_result($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name'] = 'online_exam_result';
        $page_data['param2'] = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_title'] = get_phrase('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }

    function manage_classes($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $data['teacher_id']   = $this->input->post('teacher_id');
            $this->db->insert('class', $data);
            $class_id = $this->db->insert_id();
            $data2['class_id']  =   $class_id;
            $data2['name']      =   'A';
            $this->db->insert('section', $data2);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/grados/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['name']         = $this->input->post('name');
            $data['teacher_id']   = $this->input->post('teacher_id');
            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/grados/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/grados/', 'refresh');
        }
        $page_data['classes']    = $this->db->get('class')->result_array();
        $page_data['page_name']  = 'manage_class';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }

    function get_subject($class_id = '')
    {
        $subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
        foreach ($subject as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function upload_book()
    {
        $data['libro_code'] =   substr(md5(rand(0, 1000000)), 0, 7);
        $data['nombre']                 =   $this->input->post('nombre');
        $data['autor']                  =   $this->input->post('autor');
        $data['description']            =   $this->input->post('description');
        $data['class_id']               =   $this->input->post('class_id');
        $data['subject_id']             =   $this->input->post('subject_id');
        $data['uploader_type']          =   $this->session->userdata('login_type');
        $data['uploader_id']            =   $this->session->userdata('login_user_id');
        $data['year']                   =   $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $data['timestamp']              =   strtotime(date("Y-m-d H:i:s"));
        $files = $_FILES['file_name'];
        $this->load->library('upload');
        $config['upload_path']   =  'uploads/libreria/';
        $config['allowed_types'] =  '*';
        $_FILES['file_name']['name']     = $files['name'];
        $_FILES['file_name']['type']     = $files['type'];
        $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
        $_FILES['file_name']['size']     = $files['size'];
        $this->upload->initialize($config);
        $this->upload->do_upload('file_name');
        $data['file_name'] = $_FILES['file_name']['name'];
        $this->db->insert('libreria', $data);
        redirect(base_url() . 'index.php?admin/virtual_library/' . $data['class_id'], 'refresh');
    }

    function download_book($libro_code = '')
    {
        $file_name = $this->db->get_where('libreria', array('libro_code' => $libro_code))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("uploads/libreria/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }

    function delete_book($libro_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $this->crud_model->delete_book($libro_id);
        redirect(base_url() . 'admin/virtual_library/' . $data['class_id'], 'refresh');
    }

    function section($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class = $this->input->post('class_id');
        if ($class == '') {
            $class = $this->db->get('class')->first_row()->class_id;
        }
        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->where('section_id', $param2);
            $this->db->update('section', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/section/', 'refresh');
        }
        $page_data['page_name']  = 'section';
        $page_data['page_title'] = get_phrase('sections');
        $page_data['class_id']   = $class;
        $this->load->view('backend/index', $page_data);
    }

    function sections($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['name']       =   $this->input->post('name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->db->insert('section', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/section/' . $data['class_id'] . "/", 'refresh');
        }
        if ($param1 == 'edit') {
            $data['name']       =   $this->input->post('name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->db->where('section_id', $param2);
            $this->db->update('section', $data);
            redirect(base_url() . 'admin/section/' . $data['class_id'], 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('section_id', $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/section/', 'refresh');
        }
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
        $this->db->group_by('student_id');
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

    // function get_class_students($section_id = '')
    // {
    //     $students = $this->db->get_where('enroll', array(
    //         'section_id' => $section_id,
    //         'year' => $this->db->get_where('settings', array(
    //             'type' => 'running_year'
    //         ))->row()->description,
    //     ))->result_array();
    //     foreach ($students as $row) {
    //         $idn = $this->db->get_where('student', array('student_id' => $row['student_id'], 'idn' => 1))->row()->student_id;
    //         if($row['student_id'] != $idn){
    //             continue;
    //         }
    //         echo '<option value="' . $row['student_id'] . '">' . $this->crud_model->get_name('student', $row['student_id']) . '</option>';
    //     }
    // }

    function get_class_students($section_id = '')
    {
        $students = $this->db->get_where('enroll', array(
            'section_id' => $section_id,
            'year' => $this->db->get_where('settings', array(
                'type' => 'running_year'
            ))->row()->description,
        ))->result_array();
        foreach ($students as $row) {
            $idn = $this->db->get_where('student', array('student_id' => $row['student_id'], 'idn' => 1))->row()->student_id;
            echo '<option value="' . $row['student_id'] . '">' . $this->crud_model->get_name('student', $row['student_id']) . '</option>';
        }
    }
    function semesters($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['name']    = $this->input->post('name');
            $this->db->insert('exam', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/semesters/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['name']    = $this->input->post('name');
            $this->db->where('exam_id', $param2);
            $this->db->update('exam', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/semesters/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/semesters/', 'refresh');
        }
        $page_data['exams']      = $this->db->get('exam')->result_array();
        $page_data['page_name']  = 'semester';
        $page_data['page_title'] = get_phrase('semesters');
        $this->load->view('backend/index', $page_data);
    }

    function update_book($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['book_id'] = $param1;
        $page_data['page_name']  =   'update_book';
        $page_data['page_title'] = get_phrase('update_book');
        $this->load->view('backend/index', $page_data);
    }

    function upload_marks($datainfo = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
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
        if ($this->session->userdata('admin_login') != 1) {
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
                'exam_id' => $data['exam_id'],
                'class_id' => $data['class_id'],
                'section_id' => $data['section_id'],
                'student_id' => $row['student_id'],
                'subject_id' => $data['subject_id'],
                'year' => $data['year']
            );

            $query = $this->db->get_where('mark', $verify_data);
            if ($query->num_rows() < 1) {
                $data['student_id'] = $row['student_id'];
                $this->db->insert('mark', $data);
            }
        }
        redirect(base_url() . 'admin/marks_upload/' . $data['exam_id'] . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'], 'refresh');
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
        redirect(base_url() . 'admin/upload_marks/' . $info . '/' . $exam_id . '/', 'refresh');
    }

    function tab_sheet($class_id = '', $exam_id = '', $section_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['section_id']    = $this->input->post('section_id');
            $page_data['class_id']   = $this->input->post('class_id');
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'admin/tab_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' . $page_data['section_id'], 'refresh');
            } else {
                redirect(base_url() . 'admin/tab_sheet/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['section_id']   = $section_id;
        $page_data['page_info'] = 'Exam marks';
        $page_data['page_name']  = 'tab_sheet';
        $page_data['page_title'] = get_phrase('tabulation_sheet');
        $this->load->view('backend/index', $page_data);
    }

    function tab_sheet_print($class_id  = '', $section_id = '', $subject_id = '', $exam_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id'] = $class_id;
        $page_data['exam_id']  = $exam_id;
        $page_data['section_id']  = $section_id;
        $page_data['subject_id']  = $subject_id;
        $this->load->view('backend/admin/tab_sheet_print', $page_data);
    }

    function marks_get_subject($class_id = '')
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/marks_get_subject', $page_data);
    }

    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['class_id']       = $this->input->post('class_id');
            if ($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            $subject_id = $this->input->post('subject_id');
            $teacher_id = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->teacher_id;
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['day']            = $this->input->post('day');
            if ($this->input->post('ending_ampm') == 1) {
                $sts = "AM";
            } else {
                $sts = "PM";
            }
            $data['amend']            = $sts;
            if ($this->input->post('starting_ampm') == 1) {
                $st = "AM";
            } else {
                $st = "PM";
            }
            $data['amend']            = $sts;
            $data['amstart']            = $st;
            $data['day']            = $this->input->post('day');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['year']           = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $this->db->insert('class_routine', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/class_routine_view/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            if ($this->input->post('ending_ampm') == 1) {
                $sts = "AM";
            } else {
                $sts = "PM";
            }
            $data['amend']            = $sts;
            if ($this->input->post('starting_ampm') == 1) {
                $st = "AM";
            } else {
                $st = "PM";
            }
            $data['amstart']            = $st;
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $this->db->where('class_routine_id', $param2);
            $this->db->update('class_routine', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/class_routine_view/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('class_routine_id', $param2);
            $this->db->delete('class_routine');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/class_routine_view/' . $class_id, 'refresh');
        }
    }

    function exam_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['class_id']       = $this->input->post('class_id');
            if ($this->input->post('section_id') != '') {
                $data['section_id'] = $this->input->post('section_id');
            }
            if ($this->input->post('ending_ampm') == 1) {
                $sts = "AM";
            } else {
                $sts = "PM";
            }
            $data['amend']            = $sts;
            if ($this->input->post('starting_ampm') == 1) {
                $st = "AM";
            } else {
                $st = "PM";
            }
            $data['amend']            = $sts;
            $data['amstart']            = $st;
            $data['teacher_id']     = $this->db->get_where('subject', array('subject_id' => $this->input->post('subject_id')))->row()->teacher_id;
            $data['subject_id']     = $this->input->post('subject_id');
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['fecha']          = $this->input->post('datetimepicker');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $this->db->insert('horarios_examenes', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/looking_routine/', 'refresh');
        }
        if ($param1 == 'update') {
            if ($this->input->post('ending_ampm') == 1) {
                $sts = "AM";
            } else {
                $sts = "PM";
            }
            $data['amend']            = $sts;
            if ($this->input->post('starting_ampm') == 1) {
                $st = "AM";
            } else {
                $st = "PM";
            }
            $data['amend']            = $sts;
            $data['amstart']            = $st;
            $data['time_start']     = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end']       = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end_min']   = $this->input->post('time_end_min');
            $data['day']            = $this->input->post('day');
            $data['year']           = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $this->db->where('horario_id', $param2);
            $this->db->update('horarios_examenes', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/looking_routine/', 'refresh');
        }
        if ($param1 == 'delete') {
            $class_id = $this->db->get_where('horarios_examenes', array('horario_id' => $param2))->row()->class_id;
            $this->db->where('horario_id', $param2);
            $this->db->delete('horarios_examenes');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/looking_routine/', 'refresh');
        }
    }

    function looking_routine()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $id = $this->input->post('class_id');
        if ($id == '') {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['page_name']  = 'looking_routine';
        $page_data['id']  =   $id;
        $page_data['page_title'] = get_phrase('exam_routine');
        $this->load->view('backend/index', $page_data);
    }

    function add_exam_routine()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'add_exam_routine';
        $page_data['page_title'] = get_phrase('add_exam_routine');
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_add()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'class_routine_add';
        $page_data['page_title'] = "";
        $this->load->view('backend/index', $page_data);
    }

    function class_routine_view($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $id = $this->input->post('class_id');
        if ($id == '') {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        if ($param1 == 'update') {
            $id = $_POST['Event'][0];
            $start = $_POST['Event'][1];
            $end = $_POST['Event'][2];

            $data['start'] = $start;
            $data['end'] = $end;
            $this->db->where('id', $id);
            $this->db->update('events', $data);
            echo 1;
        }
        $page_data['page_name']  = 'class_routine_view';
        $page_data['id']  =   $id;
        $page_data['page_title'] = get_phrase('class_routine');
        $this->load->view('backend/index', $page_data);
    }

    function get_class_section_subject($class_id = '')
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/class_routine_section_subject_selector', $page_data);
    }

    function section_subject_edit($class_id  = '', $class_routine_id = '')
    {
        $page_data['class_id']          =   $class_id;
        $page_data['class_routine_id']  =   $class_routine_id;
        $this->load->view('backend/admin/class_routine_section_subject_edit', $page_data);
    }

    function attendance()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  =  'attendance';
        $page_data['page_title'] =  get_phrase('attendance');
        $this->load->view('backend/index', $page_data);
    }

    function manage_attendance($param1 = '', $class_id = '', $section_id = '', $timestamp = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($this->input->post('date') == '') {
            $date = date('m/d/Y');
        } else {
            $date = $this->input->post('date');
        }
        $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_attendance';
        $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['data'] = $param1;
        $page_data['date'] = $date;
        $page_data['page_title'] = get_phrase('attendance');
        $this->load->view('backend/index', $page_data);
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
        ))->result();
        echo $this->db->last_query();

        if (!$query) {
            $this->academic_model->saveAttendance($class_id, $section_id, $subject_id, $year, $timestamp);
            echo $this->db->last_query();
        } else {
            $this->academic_model->updateAttendance($class_id, $section_id, $subject_id, $year, $timestamp);
            echo $this->db->last_query();
        }
        // redirect(base_url() . 'admin/manage_attendance/' . $param);
    }

    function get_sectionss($class_id = '')
    {
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_section($class_id = '')
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('backend/admin/manage_attendance_section_holder', $page_data);
    }

    function attendance_report($param1 = '', $param2 = '', $param3 = '', $param4 = '')
    {
        if ($param1 == 'check') {
            $data['class_id']   = $this->input->post('class_id');
            $data['year']       = $this->input->post('year');
            $data['month']  = $this->input->post('month');
            $data['section_id'] = $this->input->post('section_id');
            redirect(base_url() . 'admin/attendance_report/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['month'] . '/' . $data['year'], 'refresh');
        }
        $page_data['class_id'] = $param1;
        $page_data['month']    = $param3;
        $page_data['year']    = $param4;
        $page_data['section_id'] = $param2;
        $page_data['page_name']    = 'attendance_report';
        $page_data['page_title']   = get_phrase('attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    function get_class_studentss($section_id = '')
    {
        $students = $this->db->get_where('enroll', array('section_id' => $section_id))->result_array();
        foreach ($students as $row) {
            echo '<option value="' . $row['student_id'] . '">' . $this->crud_model->get_name('student', $row['student_id'])  . '</option>';
        }
    }

    function tabulation_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id']   = $this->input->post('class_id');
        $page_data['section_id']   = $this->input->post('section_id');
        $page_data['subject_id']   = $this->input->post('subject_id');
        $page_data['page_name']   = 'tabulation_report';
        $page_data['page_title']  = get_phrase('tabulation_report');
        $this->load->view('backend/index', $page_data);
    }

    function accounting_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']   = 'accounting_report';
        $page_data['page_title']  = get_phrase('accounting_report');
        $this->load->view('backend/index', $page_data);
    }

    function marks_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'generate') {
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/marks_report/', 'refresh');
        }
        $page_data['class_id']   = $this->input->post('class_id');
        $page_data['section_id']   = $this->input->post('section_id');
        $page_data['student_id']   = $this->input->post('student_id');
        $page_data['tgl_awal']   = $this->input->post('tgl_awal').'-1';
        $page_data['tgl_akhir']   = $this->input->post('tgl_akhir').'-1';
        $page_data['data_report'] = $this->Crud_model->get_report($page_data['class_id'], $page_data['section_id'], $page_data['student_id'], $page_data['tgl_awal'], $page_data['tgl_akhir']);
    
        $page_data['page_name']   = 'marks_report';
        $page_data['page_title']  = get_phrase('marks_report');
        $this->load->view('backend/index', $page_data);
    }

    

    function academic_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['description'] = $this->input->post('report_teacher');
            $this->db->where('type', 'students_reports');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('minium_mark');
            $this->db->where('type', 'minium_mark');
            $this->db->update('academic_settings', $data);
            if ($this->input->post('routine') == "1") {
                $routine =  $this->input->post('routine');
            } else {
                $routine = 2;
            }
            $data['description'] = $routine;
            $this->db->where('type', 'routine');
            $this->db->update('academic_settings', $data);
            $data['description'] = $this->input->post('terms');
            $this->db->where('type', 'terms');
            $this->db->update('academic_settings', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/academic_settings/', 'refresh');
        }
        $page_data['page_name']  = 'academic_settings';
        $page_data['page_title'] = get_phrase('academic_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function marks_report_print_view($param)
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $decode = base64_decode($param);
        $ex = explode('.', $decode);
        $student_id = $ex[0];
        $exam_id = $ex[1];
        $class_id = $ex[2];
        $section_id = $ex[3];
        $tgl_awal = $ex[4];
        $tgl_akhir = $ex[5];

        $page_data['tgl_awal']   = $this->input->post('tgl_awal').'-1';
        $page_data['tgl_akhir']   = $this->input->post('tgl_akhir').'-1';
        $page_data['student_id'] =   $student_id;
        $page_data['tgl_awal'] =   $tgl_awal;
        $page_data['tgl_akhir'] =   $tgl_akhir;
        $page_data['exam_id']    =   $exam_id;
        $page_data['class_id']   =   $class_id;
        $page_data['section_id']   =   $section_id;
        $page_data['data_report'] = $this->Crud_model->get_report($class_id, $section_id, $student_id, $tgl_awal, $tgl_akhir);
        $page_data['page_title']  = get_phrase('marks_report');
        $this->load->view('backend/admin/marks_report_print_view', $page_data);
    }

    function report_attendance_view($class_id = '', $section_id = '', $month = '', $year = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['month']    = $month;
        $page_data['year']    = $year;
        $page_data['page_name'] = 'report_attendance_view';
        $section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = get_phrase('attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    function create_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
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
            $one = 'admin';
            $two = $this->session->userdata('login_user_id');
            $data['user_id']    = $one . "-" . $two;
            $data['title']      = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['file'] = $_FILES["file_name"]["name"];
            $data['date'] = date('d M, Y');
            $data['priority'] = $this->input->post('priority');
            $data['status'] = 0;
            $data['code'] = substr(md5(rand(0, 1000000)), 0, 7);
            $this->db->insert('reports', $data);
            $this->crud_model->students_reports($this->input->post('student_id'), $parent_id);
            move_uploaded_file($_FILES["file_name"]["tmp_name"], 'uploads/report_files/' . $_FILES["file_name"]["name"]);

            $notify = $this->db->get_where('settings', array('type' => 'students_reports'))->row()->description;
            if ($notify == 1) {
                $message = "A behavioral report has been created for " . $student_name;
                $sms_status = $this->db->get_where('settings', array('type' => 'sms_status'))->row()->description;
                if ($sms_status == 'msg91') {
                    $result = $this->crud_model->send_sms_via_msg91($message, $parent_phone);
                } else if ($sms_status == 'twilio') {
                    $this->crud_model->twilio($message, "" . $parent_phone . "");
                } else if ($sms_status == 'clickatell') {
                    $this->crud_model->clickatell($message, $parent_phone);
                }
            }
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/request_student/', 'refresh');
        }
        if ($param1 == 'response') {
            $data['report_code'] = $this->input->post('report_code');
            $data['message'] = $this->input->post('message');
            $data['date'] = date('d M, Y');
            $data['sender_type'] = $this->session->userdata('login_type');
            $data['sender_id'] = $this->session->userdata('login_user_id');
            $this->db->insert('report_response', $data);
        }
        if ($param1 == 'update') {
            $notify['notify'] =  "<b>" . $this->db->get_where('reports', array('code' => $param2))->row()->title . "</b>" . " " . get_phrase('report_solved');

            $user = $this->db->get_where('reports', array('code' => $param2))->row()->user_id;
            $final = explode("-", $user);
            $user_type = $final[0];
            $user_id = $final[1];
            $student_id = $this->db->get_where('reports', array('code' => $param2))->row()->student_id;
            $parent_id  = $this->db->get_where('student', array('student_id' => $student_id))->row()->parent_id;

            $notify['user_id'] = $user_id;
            $notify['user_type'] = $user_type;
            $notify['url'] = $user_type . "/view_report/" . $param2;
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify);

            $notify2['notify'] = $notify['notify'];
            $notify2['user_id'] = $parent_id;
            $notify2['user_type'] = 'parent';
            $notify2['url'] = "parents/view_report/" . $param2;
            $notify2['date'] = date('d M, Y');
            $notify2['time'] = date('h:i A');
            $notify2['status'] = 0;
            $notify2['original_id'] = $this->session->userdata('login_user_id');
            $notify2['original_type'] = $this->session->userdata('login_type');
            send_notification($notify2);

            $data['status'] = 1;
            $this->db->where('code', $param2);
            $this->db->update('reports', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/looking_report/' . $param2, 'refresh');
        }
    }
    function create_perilaku($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'send') {
            $data['student_id'] = $this->input->post('student_id');
            $user_id = $this->session->userdata('login_user_id');
            $data['user_id']    = "admin-" . $user_id;
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
            redirect(base_url() . 'admin/karakter_building/', 'refresh');
        }
    }


    function calendar($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id'])) {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'create') {
            if (isset($_POST['title']) && isset($_POST['deskripsi']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])) {
                $title = addslashes($_POST['title']);
                $deskripsi = addslashes($_POST['deskripsi']);
                $start = $_POST['start'];
                $end = $_POST['end'];
                $color = $_POST['color'];
                $this->db->query("INSERT INTO events(title, deskripsi, start, end, color) values ('$title', '$deskripsi', '$start', '$end', '$color')");
                $this->crud_model->send_calendar_notify();
            }
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/calendar/', 'refresh');
        }
        if ($param1 == 'update') {
            if (isset($_POST['delete']) && isset($_POST['id'])) {
                $id = $_POST['id'];
                $query = $this->db->query("DELETE FROM events WHERE id = $id");
                if ($query == false) {
                    die('Erreur prepare');
                }
                $res = $query;
                if ($res == false) {
                    die('Erreur execute');
                }
            } elseif (isset($_POST['title']) && isset($_POST['deskripsi']) && isset($_POST['color']) && isset($_POST['id'])) {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $deskripsi = $_POST['deskripsi'];
                $color = $_POST['color'];
                $start = $_POST['start'];
                $end = $_POST['end'];
                $query = $this->db->query("UPDATE events SET  title = '$title', deskripsi = '$deskripsi', color = '$color', start = '$start', end = '$end' WHERE id = '$id' ");
                if ($query == false) {
                    die('Erreur prepare');
                }
                $sth = $query;
                if ($sth == false) {
                    die('Erreur execute');
                }
            }
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/calendar/', 'refresh');
        }
        if ($param1 == 'update_date') {
            if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])) {
                $id = $_POST['Event'][0];
                $start = $_POST['Event'][1];
                $end = $_POST['Event'][2];
                $query = $this->db->query("UPDATE events SET  start = '$start', end = '$end' WHERE id = $id ");
                if ($query == false) {
                    die('Erreur prepare');
                } else {
                    die('OK');
                }
            }
        }
        $page_data['page_name']  = 'calendar';
        $page_data['page_title'] = get_phrase('calendar');
        $this->load->view('backend/index', $page_data);
    }

    function attendance_report_selector()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['month']  = $this->input->post('month');
        $data['section_id'] = $this->input->post('section_id');
        redirect(base_url() . 'admin/report_attendance_view/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['month'] . '/' . $data['year'], 'refresh');
    }

    function students_payments($id = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name']  = 'students_payments';
        $page_data['page_title'] = get_phrase('student_payments');
        $this->load->view('backend/index', $page_data);
    }

    function payments($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'payments';
        $page_data['page_title'] = get_phrase('payments');
        $this->load->view('backend/index', $page_data);
    }

    function expense($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $jumlah = $this->input->post('amount');
        $jml = intval(str_replace(".", "", $jumlah));
        if ($param1 == 'create') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['description']         =   $this->input->post('description');
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $jml;
            $data['month']              =   date('m');
            $data['timestamp']           =   $this->input->post('timestamp');
            $data['month']             =   date('M');
            $data['year']                =   $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $this->db->insert('payment', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            redirect(base_url() . 'admin/expense', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['title']               =   $this->input->post('title');
            $data['expense_category_id'] =   $this->input->post('expense_category_id');
            $data['description']         =   $this->input->post('description');
            $data['payment_type']        =   'expense';
            $data['method']              =   $this->input->post('method');
            $data['amount']              =   $jml;
            $data['year']                =   $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $this->db->where('payment_id', $param2);
            $this->db->update('payment', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/expense', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('payment_id', $param2);
            $this->db->delete('payment');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/expense/', 'refresh');
        }
        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = get_phrase('expense');
        $this->load->view('backend/index', $page_data);
    }

    function expense_category($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'create') {
            $data['name']   =   $this->input->post('name');
            $this->db->insert('expense_category', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/expense');
        }
        if ($param1 == 'update') {
            $data['name']   =   $this->input->post('name');
            $this->db->where('expense_category_id', $param2);
            $this->db->update('expense_category', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/expense');
        }
        if ($param1 == 'delete') {
            $this->db->where('expense_category_id', $param2);
            $this->db->delete('expense_category');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/expense');
        }
        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = get_phrase('expense');
        $this->load->view('backend/index', $page_data);
    }

    public function update_jumlah_dan_saldo_sesudah($row)
    {
        // setelah menghapus update semua jumlah dan saldo setelahnya
        $kategori_this = $row->kategori;
        $kas_id_this = $row->kas_id;
        $jumlah_this = $row->jumlah;
        $saldo_this = $row->saldo;

        // ambil semua data sesudah
        $r_get_next = $this->db->from('kas')->where('kas_id >= ' . $kas_id_this)->order_by('kas_id', 'asc')->get();
        $row_get_next = $r_get_next->row();

        if (isset($row_get_next)) {
            $saldo_prev = 0; // default
            $jumlah_prev = 0;
            $i = 0;
            foreach ($r_get_next->result() as $key => $value) {
                $kas_id_next = $value->kas_id;
                $kategori_next = $value->kategori;

                // ambil 1 data sebelumnya
                $r_get_prev = $this->db->from('kas')->where("kas_id = (SELECT MAX(kas_id) FROM kas WHERE kas_id < '" . $kas_id_next . "')")->limit(1)->get();
                $row_get_prev = $r_get_prev->row();

                if (isset($row_get_prev)) {
                    if ($row_get_prev->kategori == '1') { // debit
                        $jumlah_prev = (int) abs($row_get_prev->jumlah);
                    } elseif ($row_get_prev->kategori == '2') { // kredit
                        $jumlah_prev = (int) -1 * abs($row_get_prev->jumlah);
                    }
                    $saldo_prev = (int) ($row_get_prev->saldo);
                }

                // deteksi kategori
                if ($kategori_next == '1') { //debit = plus
                    $jumlah_next = (int) abs($value->jumlah);
                } elseif ($kategori_next == '2') { //kredit = minus
                    $jumlah_next = (int) -1 * abs($value->jumlah); // merubah jumlah menjadi negative
                }
                $saldo_next = (int) ($jumlah_next + $saldo_prev);

                $kategori_prev = $kategori_next;
                $kas_id_prev = $row_get_prev->kas_id;

                if ($value->kas_id == $kas_id_this) { // update jumlah dan saldo yang akan dihapus
                } else { // update semua jumlah dan saldo sesudahnya
                    $this->db->update('kas', array(
                        'jumlah' => $jumlah_next,
                        'saldo' => $saldo_next,
                    ), array(
                        'kas_id' => $value->kas_id,
                    ));
                }
                $i++;
            }
        }
    }

    function kas($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $cari = $this->input->post('cari');
        $jumlah = $this->input->post('jumlah');
        $jml = intval(str_replace(".", "", $jumlah));
        $this->db->order_by('kas_id', 'desc');
        $saldo_awal = $this->db->get('kas')->row()->saldo;

        // page
        $jumlah_data = $this->db->get('kas')->num_rows();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/kas/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 20;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $limit = $config['per_page'];
        if ($param1 == 'cari') {
            $this->db->order_by('kas_id', 'desc');
            $this->db->like('judul', $cari);
            $this->db->where('is_deleted', '0'); // yang belum dihapus
            $page_data['kas'] = $this->db->get('kas', $limit, $from)->result_array();
        } else {
            $this->db->order_by('kas_id', 'desc');
            $this->db->where('is_deleted', '0'); // yang belum dihapus
            $page_data['kas'] = $this->db->get('kas', $limit, $from)->result_array();
        }


        $kategori = $this->input->post('kategori');
        if ($kategori == 1) {
            $saldo = $saldo_awal + $jml;
        } else {
            $saldo = $saldo_awal - $jml;
        }

        if ($param1 == 'create') {
            $data['judul']               =   $this->input->post('judul');
            $data['kategori']       =   $this->input->post('kategori');
            $data['deskripsi']         =   $this->input->post('deskripsi');
            $data['metode']              =   $this->input->post('metode');
            $data['jumlah']              =   $jml;
            $data['tanggal']           =   date('d/m/Y');
            $data['tahun']                =   $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $data['saldo']                =   $saldo;
            $this->db->insert('kas', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            redirect(base_url() . 'admin/kas', 'refresh');
        }
        if ($param1 == 'edit') {
            // deteksi kategori
            if ($this->input->post('kategori') == '1') { //debit = plus
                $jumlah_x = (int) abs($jml);
            } elseif ($this->input->post('kategori') == '2') { //kredit = minus
                $jumlah_x = (int) -1 * abs($jml); // merubah jumlah menjadi negative
            }

            // ambil 1 data sebelumnya
            $r_get_y = $this->db->from('kas')->where("kas_id = (SELECT MAX(kas_id) FROM kas WHERE kas_id < '" . $param2 . "')")->limit(1)->get();
            $row_get_y = $r_get_y->row();

            if (isset($row_get_y)) { // jika ada data sebelumnya
                $saldo_x = (int) $jumlah_x + $row_get_y->saldo;
            }

            $data['judul']               =   $this->input->post('judul');
            $data['kategori']       =   $this->input->post('kategori');
            $data['deskripsi']         =   $this->input->post('deskripsi');
            $data['metode']              =   $this->input->post('metode');
            $data['jumlah']              =   $jumlah_x;
            $data['tanggal']           =   $this->input->post('tanggal');
            $data['tahun']                =   $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $data['saldo']                =   $saldo_x;

            $r_this_data = $this->db->from('kas')->where('kas_id', $param2)->get();
            $row_this_data = $r_this_data->row();

            if (isset($row_this_data)) {
                // 1 data sebelumnya
                $saldo_prev = 0;
                $r_get_prev = $this->db->from('kas')->where("kas_id = (SELECT MAX(kas_id) FROM kas WHERE kas_id < '" . $param2 . "')")->limit(1)->get();
                $row_get_prev = $r_get_prev->row();
                if (isset($row_get_prev)) {
                    $saldo_prev = $row_get_prev->saldo;
                }
                $this->db->update('kas', $data, array(
                    'kas_id' => $param2,
                ));

                $this->update_jumlah_dan_saldo_sesudah($row_this_data);
            }

            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/kas', 'refresh');
        }
        if ($param1 == 'delete') {
            $r_this_data = $this->db->from('kas')->where('kas_id', $param2)->get();
            $row_this_data = $r_this_data->row();

            if (isset($row_this_data)) {
                // 1 data sebelumnya
                $saldo_prev = 0;
                $r_get_prev = $this->db->from('kas')->where("kas_id = (SELECT MAX(kas_id) FROM kas WHERE kas_id < '" . $param2 . "')")->limit(1)->get();
                $row_get_prev = $r_get_prev->row();
                if (isset($row_get_prev)) {
                    $saldo_prev = $row_get_prev->saldo;
                }
                $this->db->update('kas', array(
                    'is_deleted' => '1',
                    'jumlah' => 0,
                    'saldo' => $saldo_prev,
                ), array(
                    'kas_id' => $param2,
                ));

                $this->update_jumlah_dan_saldo_sesudah($row_this_data);
            }

            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));

            redirect(base_url() . 'admin/kas/', 'refresh');
        }
        $page_data['page_name']  = 'kas';
        $page_data['page_title'] = 'Kas';
        $this->load->view('backend/index', $page_data);
    }

    function donasi($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $cari = $this->input->post('cari');
        $jumlah = $this->input->post('jumlah');
        $jml = intval(str_replace(".", "", $jumlah));
        $this->db->order_by('kas_id', 'desc');
        $saldo_awal = $this->db->get('donasi')->row()->saldo;

        // page
        $jumlah_data = $this->db->get('kas')->num_rows();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/donasi/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 20;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $limit = $config['per_page'];
        if ($param1 == 'cari') {
            $this->db->order_by('kas_id', 'desc');
            $this->db->like('judul', $cari);
            $this->db->where('is_deleted', '0'); // yang belum dihapus
            $page_data['donasi'] = $this->db->get('donasi', $limit, $from)->result_array();
        } else {
            $this->db->order_by('kas_id', 'desc');
            $this->db->where('is_deleted', '0'); // yang belum dihapus
            $page_data['donasi'] = $this->db->get('donasi', $limit, $from)->result_array();
        }


        $kategori = $this->input->post('kategori');
        if ($kategori == 1) {
            $saldo = $saldo_awal + $jml;
        } else {
            $saldo = $saldo_awal - $jml;
        }

        if ($param1 == 'create') {
            $data['judul']               =   $this->input->post('judul');
            $data['kategori']       =   $this->input->post('kategori');
            $data['deskripsi']         =   $this->input->post('deskripsi');
            $data['metode']              =   $this->input->post('metode');
            $data['jumlah']              =   $jml;
            $data['tanggal']           =   date('d/m/Y');
            $data['tahun']                =   $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $data['saldo']                =   $saldo;
            $this->db->insert('donasi', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            redirect(base_url() . 'admin/donasi', 'refresh');
        }
        if ($param1 == 'edit') {
            // deteksi kategori
            if ($this->input->post('kategori') == '1') { //debit = plus
                $jumlah_x = (int) abs($jml);
            } elseif ($this->input->post('kategori') == '2') { //kredit = minus
                $jumlah_x = (int) -1 * abs($jml); // merubah jumlah menjadi negative
            }

            // ambil 1 data sebelumnya
            $saldo_terakhir = $this->db->from('donasi')->where("kas_id = (SELECT MAX(kas_id) FROM kas WHERE kas_id < '" . $param2 . "')")->limit(1)->get()->row();

            if (isset($saldo_terakhir)) { // jika ada data sebelumnya
                $saldo_x = (int) $jumlah_x + $saldo_terakhir->saldo;
            }

            //status
            if ($this->input->post('status') == 1) {
                $status = 'Diterima';
            } else {
                $status = 'Pending';
            }

            $data['judul']          =   $this->input->post('judul');
            $data['kategori']       =   $this->input->post('kategori');
            $data['deskripsi']      =   $this->input->post('deskripsi');
            $data['metode']         =   $this->input->post('metode');
            // $data['jumlah']         =   $jumlah_x;
            $data['tanggal']        =   $this->input->post('tanggal');
            $data['tahun']          =   $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            // $data['saldo']          =   $saldo_x;
            $data['status']         =   $status;


            $r_this_data = $this->db->from('donasi')->where('kas_id', $param2)->get();
            $row_this_data = $r_this_data->row();

            if (isset($row_this_data)) {
                // 1 data sebelumnya
                $saldo_prev = 0;
                $r_get_prev = $this->db->from('donasi')->where("kas_id = (SELECT MAX(kas_id) FROM kas WHERE kas_id < '" . $param2 . "')")->limit(1)->get();
                $row_get_prev = $r_get_prev->row();
                if (isset($row_get_prev)) {
                    $saldo_prev = $row_get_prev->saldo;
                }
                $this->db->update('donasi', $data, array(
                    'kas_id' => $param2,
                ));

                $this->update_jumlah_dan_saldo_sesudah($row_this_data);
            }

            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/donasi', 'refresh');
        }
        if ($param1 == 'delete') {
            $r_this_data = $this->db->from('donasi')->where('kas_id', $param2)->get();
            $row_this_data = $r_this_data->row();

            if (isset($row_this_data)) {
                // 1 data sebelumnya
                $saldo_prev = 0;
                $r_get_prev = $this->db->from('donasi')->where("kas_id = (SELECT MAX(kas_id) FROM kas WHERE kas_id < '" . $param2 . "')")->limit(1)->get();
                $row_get_prev = $r_get_prev->row();
                if (isset($row_get_prev)) {
                    $saldo_prev = $row_get_prev->saldo;
                }
                $this->db->update('donasi', array(
                    'is_deleted' => '1',
                    'jumlah' => 0,
                    'saldo' => $saldo_prev,
                ), array(
                    'kas_id' => $param2,
                ));

                $this->update_jumlah_dan_saldo_sesudah($row_this_data);
            }

            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));

            redirect(base_url() . 'admin/donasi/', 'refresh');
        }
        $page_data['page_name']  = 'donasi';
        $page_data['page_title'] = 'Donasi';
        $this->load->view('backend/index', $page_data);
    }

    function teacher_attendance()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  =  'teacher_attendance';
        $page_data['page_title'] =  get_phrase('teacher_attendance');
        $this->load->view('backend/index', $page_data);
    }

    function teacher_attendance_report()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['month']        =  date('m');
        $page_data['page_name']    = 'teacher_attendance_report';
        $page_data['page_title']   = get_phrase('teacher_attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    function teacher_report_selector()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $data['year']       = $this->input->post('year');
        $data['month']      = $this->input->post('month');
        $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
        redirect(base_url() . 'admin/teacher_report_view/' . $data['month'] . '/' . $data['year'], 'refresh');
    }

    function teacher_report_view($month = '', $year = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['month']    = $month;
        $page_data['year']    = $year;
        $page_data['page_name'] = 'teacher_report_view';
        $page_data['page_title'] = get_phrase('teacher_attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    function attendance_teacher()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $data['year']       = $this->input->post('year');
        $originalDate = $this->input->post('timestamp');
        $newDate = date("d-m-Y", strtotime($originalDate));
        $data['timestamp']  = strtotime($newDate);
        redirect(base_url() . 'admin/teacher_attendance_view/' . $data['timestamp'], 'refresh');
    }

    function attendance_update2($timestamp = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $teacher_id = $this->db->get_where('teacher', array('idcard' => $this->input->post('id')))->row()->teacher_id;
        $data['teacher_id'] = $teacher_id;
        $data['running_year'] = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $data['timestamp'] = $timestamp;
        $attendance_of = $this->db->get_where('teacher_attendance', array('year' => $data['running_year'], 'timestamp' => $timestamp))->result_array();
        if ($attendance_of) {
            $attendance_status = 1;
            $this->db->where('timestamp', $data['timestamp']);
            $this->db->where('year', $data['running_year']);
            $this->db->where('teacher_id', $data['teacher_id']);
            $update = $this->db->update('teacher_attendance', array('status' => $attendance_status));
            if ($update) {
                echo 'sukses';
            }
        } else {
            $teacher = $this->db->get_where('teacher')->result_array();
            foreach ($teacher as $row) {
                $attn_data['status']   = '';
                $attn_data['teacher_id']   = $row['teacher_id'];
                $attn_data['year']       = $data['running_year'];
                $attn_data['timestamp']  = $data['timestamp'];
                $this->db->insert('teacher_attendance', $attn_data);
            }
            $attendance_status = 1;
            $this->db->where('timestamp', $data['timestamp']);
            $this->db->where('year', $data['running_year']);
            $this->db->where('teacher_id', $data['teacher_id']);
            $update = $this->db->update('teacher_attendance', array('status' => $attendance_status));

            if ($update) {
                echo 'sukses';
            }
        }
    }

    function attendance_update3($timestamp = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $attendance_of = $this->db->get_where('teacher_attendance', array('year' => $running_year, 'timestamp' => $timestamp))->result_array();
        if ($attendance_of) {
            foreach ($attendance_of as $row) {
                $attendance_status = $this->input->post('status_' . $row['teacher_id'] . '_' . $timestamp);
                $this->db->where('attendance_id', $row['attendance_id']);
                $this->db->update('teacher_attendance', array('status' => $attendance_status));
            }
        } else {
            $data['year']       = $this->input->post('year');
            $teacher = $this->db->get_where('teacher')->result_array();
            foreach ($teacher as $row) {
                $attn_data['status']   = $this->input->post('status_' . $row['teacher_id'] . '_' . $data['timestamp']);
                $attn_data['teacher_id']   = $row['teacher_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $timestamp;
                $this->db->insert('teacher_attendance', $attn_data);
            }
        }

        $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
        redirect(base_url() . 'admin/teacher_attendance_view/' . $timestamp, 'refresh');
    }

    function teacher_attendance_view($timestamp = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'teacher_attendance_view';
        $page_data['page_title'] = get_phrase('teacher_attendance');
        $this->load->view('backend/index', $page_data);
    }

    function school_bus($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['driver_name'] = $this->input->post('driver_name');
            $data['driver_phone'] = $this->input->post('driver_phone');
            $data['route']        = $this->input->post('route');
            $data['route_fare']        = $this->input->post('route_fare');
            $this->db->insert('transport', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/school_bus/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['route_name']        = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
            $data['driver_name'] = $this->input->post('driver_name');
            $data['driver_phone'] = $this->input->post('driver_phone');
            $data['route']        = $this->input->post('route');
            $data['route_fare']        = $this->input->post('route_fare');
            $this->db->where('transport_id', $param2);
            $this->db->update('transport', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/school_bus', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('transport_id', $param2);
            $this->db->delete('transport');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/school_bus/', 'refresh');
        }
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name']  = 'school_bus';
        $page_data['page_title'] = get_phrase('school_bus');
        $this->load->view('backend/index', $page_data);
    }

    function classrooms($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {

            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['name']           = $this->input->post('name');
            $data['number']         = $this->input->post('number');
            $this->db->insert('dormitory', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/classrooms/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['name']           = $this->input->post('name');
            $this->db->where('dormitory_id', $param2);
            $this->db->update('dormitory', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/classrooms/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('dormitory_id', $param2);
            $this->db->delete('dormitory');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/classrooms/', 'refresh');
        }
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['page_name']   = 'classroom';
        $page_data['page_title']  = get_phrase('classrooms');
        $this->load->view('backend/index', $page_data);
    }

    function social($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'login') {
            $data['description'] = $this->input->post('social_login');
            $this->db->where('type', 'social_login');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('google_login');
            $this->db->where('type', 'google_login');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('google_sync');
            $this->db->where('type', 'google_sync');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }

        if (count($data) >= 1) {
            $this->db->update_batch('student', $data, 'student_id');
        }
    }

    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['description'] = $this->input->post('system_name');
            $this->db->where('type', 'system_name');
            $this->db->update('settings', $data);

            $data['description'] = strip_tags($this->input->post('logs'));
            $this->db->where('type', 'logs');
            $this->db->update('settings', $data);

            $data['description'] = strip_tags($this->input->post('calendar'));
            $this->db->where('type', 'calendar');
            $this->db->update('settings', $data);

            $data['description'] = strip_tags($this->input->post('date_format'));
            $this->db->where('type', 'date_format');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type', 'language');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('timezone');
            $this->db->where('type', 'timezone');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('register');
            $this->db->where('type', 'register');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type', 'system_title');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type', 'address');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type', 'phone');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('facebook');
            $this->db->where('type', 'facebook');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('twitter');
            $this->db->where('type', 'twitter');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('instagram');
            $this->db->where('type', 'instagram');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('youtube');
            $this->db->where('type', 'youtube');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type', 'currency');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type', 'paypal_email');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type', 'system_email');
            $this->db->update('settings', $data);


            $data['description'] = $this->input->post('running_year');
            $this->db->where('type', 'running_year');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        if ($param1 == 'skin') {
            $md5 = md5(date('d-m-y H:i:s'));

            if ($_FILES['favicon']['size'] > 0) {
                $data['description'] = $md5 . str_replace(' ', '', $_FILES['favicon']['name']);
                $this->db->where('type', 'favicon');
                $this->db->update('settings', $data);
                move_uploaded_file($_FILES['favicon']['tmp_name'], 'uploads/' . $md5 . str_replace(' ', '', $_FILES['favicon']['name']));
            }

            if ($_FILES['logow']['size'] > 0) {
                $data['description'] = $md5 . str_replace(' ', '', $_FILES['logow']['name']);
                $this->db->where('type', 'logow');
                $this->db->update('settings', $data);
                move_uploaded_file($_FILES['logow']['tmp_name'], 'uploads/' . $md5 . str_replace(' ', '', $_FILES['logow']['name']));
            }

            if ($_FILES['icon_white']['size'] > 0) {
                $data['description'] = $md5 . str_replace(' ', '', $_FILES['icon_white']['name']);
                $this->db->where('type', 'icon_white');
                $this->db->update('settings', $data);
                move_uploaded_file($_FILES['icon_white']['tmp_name'], 'uploads/' . $md5 . str_replace(' ', '', $_FILES['icon_white']['name']));
            }

            if ($_FILES['userfile']['size'] > 0) {
                $data['description'] = $md5 . str_replace(' ', '', $_FILES['userfile']['name']);
                $this->db->where('type', 'logo');
                $this->db->update('settings', $data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/' . $md5 . str_replace(' ', '', $_FILES['userfile']['name']));
            }

            if ($_FILES['bglogin']['size'] > 0) {
                $data['description'] = $md5 . str_replace(' ', '', $_FILES['bglogin']['name']);
                $this->db->where('type', 'bglogin');
                $this->db->update('settings', $data);
                move_uploaded_file($_FILES['bglogin']['tmp_name'], 'uploads/' . $md5 . str_replace(' ', '', $_FILES['bglogin']['name']));
            }

            if ($_FILES['logocolor']['size'] > 0) {
                $data['description'] = $md5 . str_replace(' ', '', $_FILES['logocolor']['name']);
                $this->db->where('type', 'logocolor');
                $this->db->update('settings', $data);
                move_uploaded_file($_FILES['logocolor']['tmp_name'], 'uploads/' . $md5 . str_replace(' ', '', $_FILES['logocolor']['name']));
            }

            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        if ($param1 == 'social') {
            $data['description'] = $this->input->post('facebook');
            $this->db->where('type', 'facebook');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('twitter');
            $this->db->where('type', 'twitter');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('instagram');
            $this->db->where('type', 'instagram');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('youtube');
            $this->db->where('type', 'youtube');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function grados($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'grados';
        $page_data['page_title'] = get_phrase('classes');
        $this->load->view('backend/index', $page_data);
    }

    function cursos($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id']  = $class_id;
        $page_data['page_name']  = 'cursos';
        $page_data['page_title'] =  get_phrase('subjects');
        $this->load->view('backend/index', $page_data);
    }

    function library($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            if ($this->input->post('type')  == 'ebook') {
                $data['name']        = $this->input->post('name');
                $data['description'] = $this->input->post('description');
                $data['price']       = $this->input->post('price');
                $data['author']      = $this->input->post('author');
                $data['class_id']    = $this->input->post('class_id');
                $data['type']        = $this->input->post('type');
                $data['total_copies']      = $this->input->post('total_copies');
                $data['status']      = $this->input->post('status');
                $data['file_name']   = $this->input->post('file_name');
                $this->db->insert('book', $data);
                $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
                redirect(base_url() . 'admin/library/', 'refresh');
            } else {
                $data['name']        = $this->input->post('name');
                $data['description'] = $this->input->post('description');
                $data['price']       = $this->input->post('price');
                $data['author']      = $this->input->post('author');
                $data['class_id']    = $this->input->post('class_id');
                $data['total_copies']      = $this->input->post('total_copies');
                $data['type']        = $this->input->post('type');
                $data['status']      = $this->input->post('status');
                $this->db->insert('book', $data);
                $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
                redirect(base_url() . 'admin/library/', 'refresh');
            }
        }
        if ($param1 == 'update') {
            if ($this->input->post('type')  == 'ebook') {
                $data['name']        = $this->input->post('name');
                $data['description'] = $this->input->post('description');
                $data['price']       = $this->input->post('price');
                $data['author']      = $this->input->post('author');
                $data['class_id']    = $this->input->post('class_id');
                $data['type']        = $this->input->post('type');
                $data['total_copies']      = $this->input->post('total_copies');
                $data['file_name']   = $this->input->post('file_name');
                $data['status']      = $this->input->post('status');
                $this->db->where('book_id', $param2);
                $this->db->update('book', $data);
                $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
                redirect(base_url() . 'admin/library/' . $param2, 'refresh');
            } else {
                $data['name']        = $this->input->post('name');
                $data['description'] = $this->input->post('description');
                $data['price']       = $this->input->post('price');
                $data['author']      = $this->input->post('author');
                $data['class_id']    = $this->input->post('class_id');
                $data['total_copies']      = $this->input->post('total_copies');
                $data['type']        = $this->input->post('type');
                $data['status']      = $this->input->post('status');
                $this->db->where('book_id', $param2);
                $this->db->update('book', $data);
                $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
                redirect(base_url() . 'admin/update_book/' . $param2, 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/library', 'refresh');
        }
        $id = $this->input->post('class_id');
        if ($id == '') {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['id']  = $id;
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = get_phrase('library');
        $this->load->view('backend/index', $page_data);
    }

    function marks_print_view($student_id  = '', $exam_id = '', $section_id = '', $tahun_ajaran = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class_id = "";
        $section_d = "";
        $row = $this->db->get_where('enroll', array(
            'student_id' => $student_id,
            'year' => $this->db->get_where('settings', array(
                'type' => 'running_year'
            ))->row()->description
        ))->row();
        if (isset($row)) {
            $class_id = $row->class_id;
            $section_id = $row->section_id;
        }
        $class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $page_data['tahun_ajaran']    =   $tahun_ajaran;
        $page_data['section_id'] =   $section_id;
        $this->load->view('backend/admin/marks_print_view', $page_data);
    }

    function upload_file($param1 = '', $param2 = '')
    {
        $page_data['token']  = $param1;
        $page_data['page_name']  = 'upload_file';
        $page_data['page_title'] = get_phrase('library');
        $this->load->view('backend/index', $page_data);
    }

    function folders($task = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($task == 'update') {
            $user_folder = md5($this->session->userdata('login_user_id'));
            $old_folder = $this->db->get_where('folder', array('folder_id' => $param2))->row()->name;
            rename('uploads/users/admin/' . $user_folder . '/' . $old_folder, 'uploads/users/admin/' . $user_folder . '/' . $this->input->post('name'));

            $data['name'] = $this->input->post('name');
            $data['token'] = base64_encode($this->input->post('name'));
            $this->db->where('folder_id', $param2);
            $this->db->update('folder', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/folders/', 'refresh');
        }
        if ($task == 'delete') {
            $user_folder = md5($this->session->userdata('login_user_id'));
            $folder = $this->db->get_where('folder', array('folder_id' => $param2))->row()->name;
            $this->deleteDir('uploads/users/admin/' . $user_folder . '/' . $folder);
            $this->db->where('folder_id', $param2);
            $this->db->delete('folder');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/folders/', 'refresh');
        }
        $page_data['page_title']             = get_phrase('my_folders');
        $page_data['token']   = $task;
        $page_data['page_name']   = 'folders';
        $this->load->view('backend/index', $page_data);
    }

    function deleteDir($path  = '')
    {
        return is_file($path) ? @unlink($path) :
            array_map(__FUNCTION__, glob($path . '/*')) == @rmdir($path);
    }

    function files($task = "", $code = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
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
                $data = file_get_contents("uploads/users/admin/" . $user_folder . "/" . $folder_name . '/' . $file_name);
            } else {
                $data = file_get_contents("uploads/users/admin/" . $user_folder . '/' . $file_name);
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
                $data['user_type'] = 'admin';
                $data['token'] = base64_encode($data['name']);
                $data['date'] = date('d M, Y H:iA');
                $this->db->insert('folder', $data);
                mkdir('uploads/users/' . $this->session->userdata('login_type') . '/' . $folder . '/' . $data['name'], 0777, true);
                $this->session->set_flashdata('flash_message', get_phrase('successfully_uploaded'));
                redirect(base_url() . 'admin/folders/', 'refresh');
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('folder_already_exist'));
                redirect(base_url() . 'admin/files/', 'refresh');
            }
        }
        if ($task == 'delete') {
            $user_folder = md5($this->session->userdata('login_user_id'));

            $file_name = $this->db->get_where('file', array('file_id' => $code))->row()->name;
            $folder = $this->db->get_where('file', array('file_id' => $code))->row()->folder_token;
            $folder_name = $this->db->get_where('folder', array('token' => $folder))->row()->name;
            if ($folder != "") {
                unlink("uploads/users/admin/" . $user_folder . "/" . $folder_name . '/' . $file_name);
            } else {
                unlink("uploads/users/admin/" . $user_folder . '/' . $file_name);
            }
            $this->db->where('file_id', $code);
            $this->db->delete('file');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/all/');
        }
        $data['page_name']              = 'files';
        $data['page_title']             = get_phrase('my_files');
        $this->load->view('backend/index', $data);
    }

    function karakter_building($week = null)
    {
        if ($this->session->userdata('admin_login') != 1) {
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

    function get_lpa_lk_data($student_id = '')
    {
        $user_id = $this->session->userdata('login_user_id');
        $user_id = "admin-" . $user_id;
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
        if ($this->session->userdata('admin_login') != 1) {
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


        redirect(base_url() . 'admin/exam_results/' . $id . '/', 'refresh');
    }
    function update_attended($id = '', $student_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $this->db->set('status', 'attended');
        $this->db->set('result', null);
        $this->db->set('obtained_mark', '');
        $this->db->where('online_exam_id', $id);
        $this->db->where('student_id', $student_id);
        $this->db->update('online_exam_result');

        redirect(base_url() . 'admin/exam_results/' . $id . '/', 'refresh');
    }
    function lihat_laporan($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id'])) {
            $notify['status'] = 1;
            $this->db->where('id', $_GET['id']);
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'update') {
            $data['status'] = 1;
            $this->db->where('report_code', $param2);
            $this->db->update('laporan_konseling', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
            redirect(base_url() . 'admin/lihat_laporan/' . $param2, 'refresh');
        }
        $page_data['report_code'] = $param1;
        $page_data['page_title'] =   get_phrase('report_details');
        $page_data['page_name']  = 'lihat_laporan';
        $this->load->view('backend/index', $page_data);
    }
    function testimonials($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['nama']               =   $this->input->post('nama');
            $data['jabatan'] =   $this->input->post('jabatan');
            $data['deskripsi']         =   $this->input->post('deskripsi');
            $data['foto']         =   $this->input->post('foto');
            $this->db->insert('testimonials', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            redirect(base_url() . 'admin/testimonials', 'refresh');
        }
        if ($param1 == 'edit') {
            $md5 = substr(md5(rand(100000000, 200000000)), 0, 10);
            $data['nama']               =   $this->input->post('nama');
            $data['jabatan'] =   $this->input->post('jabatan');
            $data['deskripsi']         =   $this->input->post('deskripsi');
            $data['foto']         =   $this->input->post('foto');
            $this->db->where('id_testimonial', $param2);
            $this->db->update('testimonials', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            redirect(base_url() . 'admin/testimonials', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id_testimonial', $param2);
            $this->db->delete('testimonials');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/testimonials/', 'refresh');
        }
        $page_data['page_name']  = 'testimonials';
        $page_data['page_title'] = 'Testimoni';
        $this->load->view('backend/index', $page_data);
    }
    function management($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['nama']               =   $this->input->post('nama');
            $data['jabatan'] =   $this->input->post('jabatan');
            $data['foto']         =   $this->input->post('foto');
            $this->db->insert('management', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            redirect(base_url() . 'admin/management', 'refresh');
        }
        if ($param1 == 'edit') {
            $md5 = substr(md5(rand(100000000, 200000000)), 0, 10);
            $data['nama']               =   $this->input->post('nama');
            $data['jabatan'] =   $this->input->post('jabatan');
            $data['foto']         =   $this->input->post('foto');
            $this->db->where('id_management', $param2);
            $this->db->update('management', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            redirect(base_url() . 'admin/management', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('management', $param2);
            $this->db->delete('management');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/testimonials/', 'refresh');
        }
        $page_data['page_name']  = 'management';
        $page_data['page_title'] = 'Management';
        $this->load->view('backend/index', $page_data);
    }

    function galeri($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['nama']               =   $this->input->post('nama');
            $this->db->insert('kategori', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));

            redirect(base_url() . 'admin/galeri', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['nama']             =   $this->input->post('nama');
            $this->db->where('id_kategori', $param2);
            $this->db->update('kategori', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));

            redirect(base_url() . 'admin/galeri', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id_kategori', $param2);
            $this->db->delete('kategori');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/galeri/', 'refresh');
        }
        $page_data['page_name']  = 'galeri';
        $page_data['page_title'] = 'Galeri';
        $this->load->view('backend/index', $page_data);
    }

    function galerifoto($id_kategori = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['kategori']  = $id_kategori;
        $page_data['page_name']  = 'galerifoto';
        $page_data['page_title'] =  'Album Foto';
        $this->load->view('backend/index', $page_data);
    }
    function galerifotos($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['id_kategori'] = $param2;
            $data['gambar']       = $this->input->post('gambar');
            $data['video']       = $this->input->post('video');
            $data['tgl_update']   = date('d-m-Y');
            $this->db->insert('galeri', $data);
            redirect(base_url() . 'admin/galerifoto/' . base64_encode($param2) . "/", 'refresh');
        }
        if ($param1 == 'edit') {
            $data['gambar']       = $this->input->post('gambar');
            $data['video']       = $this->input->post('video');
            $data['tgl_update']   = date('d-m-Y');
            $this->db->where('id_galeri', $param2);
            $this->db->update('galeri', $data);
            redirect(base_url() . 'admin/galerifoto/' . base64_encode($param3) . "/", 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id_galeri', $param2);
            $this->db->delete('galeri');

            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/galerifoto/' . base64_encode($param3) . "/", 'refresh');
        }
        redirect(base_url() . 'admin/galerifoto/' . base64_encode($param2) . "/", 'refresh');
    }

    function blog($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['tulisan_gambar']           = substr(md5(rand(100000000, 200000000)), 0, 10);
            $data['tulisan_judul']       = $this->input->post('judul');
            $data['tulisan_isi']       = $this->input->post('isi');
            $data['tulisan_tanggal']   = date('Y-m-d H:i:s');
            $data['tulisan_kategori_nama']       = $this->input->post('kategori');
            $data['tulisan_views']       = 0;
            $data['tulisan_pengguna_id']       = $this->session->userdata('login_user_id');
            $data['tulisan_author']       = $this->crud_model->get_name('admin', $this->session->userdata('login_user_id'));
            $data['tulisan_img_slider']       = 0;
            $data['tulisan_slug']       = "-";
            $this->db->insert('tbl_tulisan', $data);
            $tulisan_gambar = $this->db->get_where('tbl_tulisan', array('tulisan_id' => $this->db->insert_id()))->row()->tulisan_gambar;
            move_uploaded_file($_FILES['file_name']['tmp_name'], 'uploads/blog/' . $tulisan_gambar . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/blog/', 'refresh');
        }
        if ($param1 == 'edit') {
            $data['tulisan_judul']       = $this->input->post('judul');
            $data['tulisan_isi']       = $this->input->post('isi');
            $data['tulisan_tanggal']   = date('Y-m-d H:i:s');
            $data['tulisan_kategori_nama']       = $this->input->post('kategori');
            $data['tulisan_views']       = $this->input->post('views');
            $data['tulisan_gambar']           = substr(md5(rand(100000000, 200000000)), 0, 10);
            $data['tulisan_pengguna_id']       = $this->session->userdata('login_user_id');
            $data['tulisan_author']       = $this->crud_model->get_name('admin', $this->session->userdata('login_user_id'));
            $data['tulisan_img_slider']       = $this->input->post('slider');
            $data['tulisan_slug']       = "-";
            $this->db->where('tulisan_id', $param2);
            $this->db->update('tbl_tulisan', $data);
            $tulisan_gambar = $this->db->get_where('tbl_tulisan', array('tulisan_id' => $param2))->row()->tulisan_gambar;
            move_uploaded_file($_FILES['file_name']['tmp_name'], 'uploads/blog/' . $tulisan_gambar . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updatted'));
            redirect(base_url() . 'admin/blog/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('tulisan_id', $param2);
            $this->db->delete('tbl_tulisan');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/blog/', 'refresh');
        }
        // page
        $jumlah_data = $this->db->get('kas')->num_rows();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/blog/';
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 20;
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $limit = $config['per_page'];
        $this->db->order_by('tulisan_id', 'desc');
        $page_data['blog'] = $this->db->get('tbl_tulisan', $limit, $from)->result_array();
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

    function komentar($param1 = '', $id_komentar = '', $id_tulisan = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'publish') {
            $data['komentar_status'] = 1;

            $this->db->where('komentar_id', $id_komentar);
            $query = $this->db->update('tbl_komentar', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_updatted'));
            redirect(base_url() . 'admin/baca_blog/' . $id_tulisan . '/', 'refresh');
        }
        if ($param1 == 'balas') {
            $nama = $this->crud_model->get_name('admin', $this->session->userdata('login_user_id'));
            $email = htmlspecialchars($this->input->post('email', TRUE), ENT_QUOTES);
            $komentar = nl2br(htmlspecialchars($this->input->post('isi', TRUE), ENT_QUOTES));
            $data = array(
                'komentar_nama'             => $nama,
                'komentar_email'             => '',
                'komentar_isi'                 => $komentar,
                'komentar_status'         => 1,
                'komentar_tulisan_id'    => $id_tulisan,
                'komentar_parent'       => $id_komentar
            );

            $this->db->insert('tbl_komentar', $data);
            $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
            redirect(base_url() . 'admin/baca_blog/' . $id_tulisan . '/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('komentar_id', $id_komentar);
            $this->db->delete('tbl_komentar');
            $this->session->set_flashdata('flash_message', get_phrase('successfully_deleted'));
            redirect(base_url() . 'admin/baca_blog/' . $id_tulisan . '/', 'refresh');
        }
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
