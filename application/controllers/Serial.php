<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Serial extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function generate()
    {
        $enroll = $this->db->get_where('enroll', ['no_serial' => NULL]);

        if ($enroll->num_rows() > 0) {
            $data = [];
            $no = 0;

            foreach ($enroll->result_array() as $key) {
                $data[$no++] = [
                    'enroll_id' => $key['enroll_id'],
                    'no_serial' => date('YmdHis') . $key['student_id'] . rand(0, 9)
                ];
            }

            $this->db->update_batch('enroll', $data, 'enroll_id');
        }

        echo json_encode(['status' => true, 'message' => 'success.'], JSON_PRETTY_PRINT);
    }
}
