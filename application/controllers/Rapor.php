<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class rapor extends CI_Controller
{
    function index()
    {
        $this->load->library('session');
        $data['fancy_notify'] = $this->getFancy_notif();
        $this->load->view('rapor', $data);
    }

    public function show($no_serial = null)
    {
        $this->load->library('session');

        if ($no_serial == null) {
            redirect(base_url('rapor'));
        }

        $student = $this->db->get_where('enroll', ['no_serial' => $no_serial]);

        if ($student->num_rows() == 0) {
            $this->session->set_flashdata('failed', "Maaf, No. Serial Rapor <b>" . $no_serial . "</b> tidak ada dalam database kami.");
            redirect(base_url('rapor'));
        }

        $student_id = $student->row()->student_id;
        $tahun_ajaran = $student->row()->year;

        $data['fancy_notify'] = $this->getFancy_notif();
        $data['no_serial'] = $no_serial;
        $data['student_id'] = $student_id;
        $data['tahun_ajaran'] = $tahun_ajaran;


        $this->load->view('result', $data);
    }

    public function cetak($param)
    {
        $this->load->database();
        $ex = explode('-', base64_decode($param));

        $student_id = $ex[0];
        $exam_id = $ex[1];

        $class_id     = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description))->row()->class_id;

        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('cetak', $page_data);
    }

    public function getFancy_notif()
    {
        $this->db->order_by('id', 'desc');
        $n = $this->db->get_where('notification', array('user_id' => $this->session->userdata('login_user_id'), 'user_type' => $this->session->userdata('login_type'), 'status' => '0'));
        return $n->num_rows();
    }

    public function search_serial()
    {
        $this->load->library('session');
        $data['fancy_notify'] = $this->getFancy_notif();
        $this->load->view('result', $data);
    }

    public function barcode($text)
    {
        $this->load->library('barcode');

        Barcode::generate($text);
    }

    public function qrcode($text, $ukuran = 2)
    {
        include './application/libraries/phpqrcode/qrlib.php';

        QRcode::png(base_url('rapor/show') . "/" . $text, null, QR_ECLEVEL_L, $ukuran, 1);
    }
}
