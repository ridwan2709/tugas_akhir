<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->userdata('admin_login') != 1 && $this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
    }

    function ckeditor () {
        if(isset($_FILES["upload"])){
			$ext = ".".end((explode(".", $_FILES["upload"]["name"])));
            $filename = md5(date('d-m-y H:i:s'));
			$file_public_addr = 'uploads/ckeditor_image/' . $filename . $ext;

			$success = move_uploaded_file($_FILES["upload"]["tmp_name"], $file_public_addr);
			if( $success){
				$json["uploaded"]=true;
				$json["url"]= base_url() . $file_public_addr;
                echo json_encode($json);
                return;
			}
		}

		if(!$success){
			$json["uploaded"]=false;
			$json["error"]=array("message"=>"Error Uploaded");
            echo json_encode($json);
		}
	}
}