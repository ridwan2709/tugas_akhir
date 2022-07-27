<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->model('mail_model');
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->db->get_where('settings', array('type' => 'register'))->row()->description == 0) {
            redirect(base_url(), 'refresh');
        } else {
            $this->load->view('backend/register');
        }
    }

    function search_user()
    {
        if ($_POST['c'] != "") {
            $credential = array('username' => $_POST['c']);
            $query = $this->db->get_where('admin', $credential);
            if ($query->num_rows() > 0) {
                echo 'success';
            }
            $query = $this->db->get_where('teacher', $credential);
            if ($query->num_rows() > 0) {
                echo 'success';
            }
            $query = $this->db->get_where('student', $credential);
            if ($query->num_rows() > 0) {
                echo 'success';
            }
            $query = $this->db->get_where('parent', $credential);
            if ($query->num_rows() > 0) {
                echo 'success';
            }
            $query = $this->db->get_where('accountant', $credential);
            if ($query->num_rows() > 0) {
                echo 'success';
            }
            $query = $this->db->get_where('librarian', $credential);
            if ($query->num_rows() > 0) {
                echo 'success';
            }
        }
    }

    function create_account($param1 = '')
    {
        if ($param1 == 'teacher') {
            $this->form_validation->set_rules('first_name', 'First Name', 'required', [
                'required' => 'First Name tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('last_name', 'Last Name', 'required', [
                'required' =>  'Last Name tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('since', 'Since', 'required', [
                'required' => 'Since tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('username', 'Username', 'required', [
                'required' => 'Username tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('phone', 'Phone', 'required', [
                'required' => 'Phone tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('email', 'Email', 'required', [
                'required' =>  'Email tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('sex', 'Sex', 'required', [
                'required' => 'Jenis Kelamin tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('birthday', 'Birthday', 'required', [
                'required' => 'Tanggal Lahir tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'required', [
                'required' =>  'Password tidak boleh kosong'
            ]);

            if ($this->form_validation->run() == false) {
                $data['type'] = "teachers";
                $this->load->view('backend/register', $data);
            } else {
                $data['first_name']        = $this->input->post('first_name');
                $data['last_name']        = $this->input->post('last_name');
                $data['since']     = date('d M, Y');
                $data['username']    = $this->input->post('username');
                $data['phone']       = $this->input->post('phone');
                $data['email']        = $this->input->post('email');
                $data['sex']       = $this->input->post('sex');
                $data['birthday']    = $this->input->post('birthday');
                $data['type']    = "teacher";
                $data['password']    = sha1($this->input->post('password'));
                $this->db->insert('pending_users', $data);
                $user_id = $this->db->insert_id();
                $this->mail_model->welcome_user($user_id,$this->input->post('password'));

                $notify['notify'] = "<strong>" . get_phrase('register') . ":</strong>," . " " . get_phrase('reg_teacher') . "<b>" . $this->input->post('name') . "</b>";
                $admins = $this->db->get('admin')->result_array();
                foreach ($admins as $row) {
                    $notify['user_id'] = $row['admin_id'];
                    $notify['user_type'] = 'admin';
                    $notify['url'] = "admin/pending/";
                    $notify['date'] = date('d M, Y');
                    $notify['time'] = date('h:i A');
                    $notify['status'] = 0;
                    $notify['original_id'] = "";
                    $notify['original_type'] = "";
                    send_notification($notify, false);
                }
                send_firebase_notification('admin', strip_tags($notify['notify']));

                $this->session->set_flashdata('flash_message', "Anda berhasil membuat akun, email akan segera kami kirim ketika akun Anda telah disetujui.");
                redirect(base_url() . 'login');
            }
        }
        if ($param1 == 'student') {
            $this->form_validation->set_rules('class_id', 'Class', 'required', [
                'required' =>  'Kelas tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('section_id', 'Section', 'required', [
                'required' =>  'Level tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('first_name', 'First Name', 'required', [
                'required' =>  'Nama depan tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('last_name', 'Last Name', 'required', [
                'required' =>  'Nama belakang tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('username', 'Username', 'required', [
                'required' =>   'Username tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('phone', 'Phone', 'required', [
                'required' =>  'Telepon tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('sekolah', 'Sekolah', 'required', [
                'required' =>  'Sekolah tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required', [
                'required' =>  'Tempat Lahir tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('address', 'Alamat', 'required', [
                'required' =>  'Alamat tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('email', 'Email', 'required', [
                'required' =>  'Email tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('sex', 'Sex', 'required', [
                'required' =>  'Jenis Kelamin tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('birthday', 'Birthday', 'required', [
                'required' => 'Tanggal lahir tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('roll', 'Roll', 'required', [
                'required' => 'NIS tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'required', [
                'required' =>  'Password tidak boleh kosong'
            ]);

            if ($this->form_validation->run() == false) {
                $data['type'] = "students";
                $this->load->view('backend/register', $data);
            } else {
                $data['class_id']    = $this->input->post('class_id');
                $data['section_id']  = $this->input->post('section_id');
                $data['parent_id']   = $this->input->post('parent_id');
                $data['first_name']  = $this->input->post('first_name');
                $data['last_name']   = $this->input->post('last_name');
                $data['since']       = date('d M, Y');
                $data['username']    = $this->input->post('username');
                $data['phone']       = $this->input->post('phone');
                $data['sekolah']     = $this->input->post('sekolah');
                $data['tempat_lahir'] = $this->input->post('tempat_lahir');
                $data['address']     = $this->input->post('address');
                $data['email']       = $this->input->post('email');
                $data['sex']         = $this->input->post('sex');
                $data['birthday']    = $this->input->post('birthday');
                $data['roll']        = $this->input->post('roll');
                $data['no_serial']   = date('YmdHis') . rand(0, 99);
                $data['type']        = "student";
                $data['password']    = sha1($this->input->post('password'));

                $this->db->insert('pending_users', $data);
                $user_id = $this->db->insert_id();
                $this->mail_model->welcome_user($user_id, $this->input->post('password'));
                $name = $data['first_name'] . " " . $data['last_name'];
                $notify['notify'] = "<strong>" . get_phrase('register') . ":</strong>" . " " . get_phrase('reg_student') . " <b>" . $name . "</b>";
                $admins = $this->db->get('admin')->result_array();
                foreach ($admins as $row) {
                    $notify['user_id'] = $row['admin_id'];
                    $notify['user_type'] = 'admin';
                    $notify['url'] = "admin/pending/";
                    $notify['date'] = date('d M, Y');
                    $notify['time'] = date('h:i A');
                    $notify['status'] = 0;
                    $notify['original_id'] = "";
                    $notify['original_type'] = "";
                    send_notification($notify, false);
                }
                send_firebase_notification('admin', strip_tags($notify['notify']));

                $this->session->set_flashdata('flash_message', "Anda berhasil membuat akun, email akan segera kami kirim ketika akun Anda telah disetujui.");
                redirect(base_url() . 'register', 'refresh');
            }
        }
        if ($param1 == 'parent') {
            $this->form_validation->set_rules('first_name', 'First Name', 'required', [
                'required' => 'Nama depan tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('last_name', 'Last Name', 'required', [
                'required' => 'Nama belakang tidak boleh kosong'
            ]);

            $this->form_validation->set_rules('username', 'Username', 'required', [
                'required' => 'Username tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('address', 'Address', 'required', [
                'required' => 'Alamat tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('phone', 'Phone', 'required', [
                'required' => 'Telepon tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('email', 'Email', 'required', [
                'required' => 'Email tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('profession', 'Professi', 'required', [
                'required' =>  'Profesi tidak boleh kosong'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'required', [
                'required' => 'Password tidak boleh kosong'
            ]);

            if ($this->form_validation->run() == false) {
                $data['type'] = "parents";
                $this->load->view('backend/register', $data);
            } else {
                $data['first_name']        = $this->input->post('first_name');
                $data['last_name']        = $this->input->post('last_name');
                $data['email']        = $this->input->post('email');
                $data['since']     = date('d M, Y');
                $data['username']    = $this->input->post('username');
                $data['address']    = $this->input->post('address');
                $data['phone']       = $this->input->post('phone');
                $data['profession']    = $this->input->post('profession');
                $data['type']        = "parent";
                $data['password']    = sha1($this->input->post('password'));
                $this->db->insert('pending_users', $data);
                $user_id = $this->db->insert_id();
                $this->mail_model->welcome_user($user_id, $this->input->post('password'));
                $name = $data['first_name'] . " " . $data['last_name'];
                $notify['notify'] = "<strong>" . get_phrase('register') . ":</strong>" . " " . get_phrase('reg_parent') . " <b>" . $name . "</b>";
                $admins = $this->db->get('admin')->result_array();
                foreach ($admins as $row) {
                    $notify['user_id'] = $row['admin_id'];
                    $notify['user_type'] = 'admin';
                    $notify['url'] = "admin/pending/";
                    $notify['date'] = date('d M, Y');
                    $notify['time'] = date('h:i A');
                    $notify['status'] = 0;
                    $notify['original_id'] = "";
                    $notify['original_type'] = "";
                    send_notification($notify, false);
                }
                send_firebase_notification('admin', strip_tags($notify['notify']));
                $this->session->set_flashdata('flash_message', "Anda berhasil membuat akun, email akan segera kami kirim ketika akun Anda telah disetujui.");
                redirect(base_url() . 'register', 'refresh');
            }
        }
    }
}
