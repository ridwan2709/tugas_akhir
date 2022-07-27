<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    function index()
    {
        $this->load->library('session');
        $data['fancy_notify'] = $this->getFancy_notif();
        $this->db->select('judul, jumlah, tanggal');
        $this->db->where('kategori', '1');
        $this->db->order_by('kas_id', 'desc');
        $this->db->limit(10);
        $query = $this->db->get('donasi');
        $data['donasi'] = $query->result_array();

        $this->load->view('home', $data);
    }

    public function getFancy_notif()
    {
        $this->db->order_by('id', 'desc');
        $n = $this->db->get_where('notification', array('user_id' => $this->session->userdata('login_user_id'), 'user_type' => $this->session->userdata('login_type'), 'status' => '0'));
        return $n->num_rows();
    }
}
