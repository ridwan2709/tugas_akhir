<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pdb extends CI_Controller
{
    function index()
    {
        $this->load->library('session');
        $data['fancy_notify'] = $this->getFancy_notif();
        $this->load->view('pdb', $data);
    }

    public function getFancy_notif()
    {
        $this->db->order_by('id', 'desc');
        $n = $this->db->get_where('notification', array('user_id' => $this->session->userdata('login_user_id'), 'user_type' => $this->session->userdata('login_type'), 'status' => '0'));
        return $n->num_rows();
    }
}
