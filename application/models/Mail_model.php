<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class mail_model extends CI_Model {

    function clear_cache()
    {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function welcome_user($id, $pass)
    {
        $user_email = $this->db->get_where('pending_users', array('user_id' => $id))->row()->email;
        $user_name = $this->db->get_where('pending_users', array('user_id' => $id))->row()->first_name . " " . $this->db->get_where('pending_users', array('user_id' => $id))->row()->last_name;
        $username = $this->db->get_where('pending_users', array('user_id' => $id))->row()->username;
        $type = $this->db->get_where('pending_users', array('user_id' => $id))->row()->type;
        $email_sub    =   "Welcome " . $user_name;
        $email_msg    =   "Hi <strong>" . $user_name . ",</strong><br><br>";
        $email_msg   .=  "A new account has been created with your email address in " . base_url() . "<br><br>";
        $email_msg   .=  "Your data are as follows:<br><br>";
        $email_msg   .=  "<strong>Name:</strong> " . $user_name . "<br/>";
        $email_msg   .=  "<strong>Email:</strong> " . $user_email . "<br/>";
        $email_msg   .=  "<strong>Username:</strong> " . $username . "<br/>";
        $email_msg   .=  "<strong>Account type:</strong> " . ucwords($type) . "<br/>";
        $email_msg   .=  "<strong>Password:</strong>". $pass ."<br/><br/>";
        $email_msg   .=  "<strong>NOTE:</strong><br/>";
        $email_msg   .=  "<strong>-</strong> At the moment you can not log in until an administrator approves your account, you will be notified about the status of your account.<br/>";
        $email_msg   .=  "<strong>-</strong> To make it easier to use the application and can get notifications when there is a new information, please download the application <a href='https://play.google.com/store/apps/details?id=com.homeschooling.permatahati' style='text-decoration:none'><strong>here</strong></a><br/> <br/>";
            
        $data = array(
            'email_msg' => $email_msg
        );
        $this->submit($user_email, $email_sub, $data, 'welcome');

    }

    function account_confirm($type = '', $id = '')
    {
        $user_email = $this->db->get_where($type, array($type . '_id' => $id))->row()->email;
        $user_name = $this->db->get_where($type, array($type . '_id' => $id))->row()->first_name . " " . $this->db->get_where($type, array($type . '_id' => $id))->row()->last_name;
        $username = $this->db->get_where($type, array($type . '_id' => $id))->row()->username;
        
        $email_sub    =   "Congratulations! ";
        $email_msg    =   "Hi <strong>" . $user_name . ",</strong><br><br>";
        $email_msg   .=  "Congratulations, your account has been approved and can be used. <br><br>";
        $email_msg   .=  "Please login by entering the username and password that you have created to use this application. Or you can see it in the email we sent earlier.<br><br>";
        $email_msg   .=  "To make it easier to use the application and can get notifications when there is a new information, please download the application <a href='https://play.google.com/store/apps/details?id=com.homeschooling.permatahati' style='text-decoration:none'><strong>here</strong></a><br/><br>";
        $email_msg   .=  "Welcome to join with us and happy using the application.<br/><br>";
        $email_msg   .=  "Thank you.<br><br>";
        $data = array(
            'email_msg' => $email_msg
        );
        $this->submit($user_email, $email_sub, $data, 'confirm');
    }

    function sendStudentMarks()
    {
        $users = $this->db->get_where('enroll' , array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $this->runningYear))->result_array();
        if(count($users) > 0)
        {
            foreach($users as $row)
            {
                $student_email = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email;
                $subject = get_phrase('student_marksheet')." [".$this->db->get_where('exam', array('exam_id' => $this->input->post('exam_id')))->row()->name."]";
                $data = array(
                    'class_id' => $row['class_id'],
                    'student_name' => $this->crud->get_name('student', $row['student_id']),
                    'type' => 'student',
                    'student_id' => $row['student_id'],
                    'section_id' => $row['section_id'],
                    'exam_id' => $this->input->post('exam_id')
                );
                if($student_email != ''){
                    $this->submit($student_email,$subject,$data,'marks');
                }
            }   
        }
    }
    
    function sendParentMarks()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row->description;
        $st = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $year))->result_array();
        if(count($st) > 0)
        {
            foreach($st as $row)
            {
                $parent_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id;
                $parent_email = $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->email;
                $subject = get_phrase('student_marksheet')." [".$this->db->get_where('exam', array('exam_id' => $this->input->post('exam_id')))->row()->name."]";
                $data = array(
                    'class_id' => $this->input->post('class_id'),
                    'type' => 'parent',
                    'student_name' => $this->crud->get_name('student', $row['student_id']),
                    'student_id' => $row['student_id'],
                    'section_id' => $this->input->post('section_id'),
                    'exam_id' => $this->input->post('exam_id')
                );
                if($parent_email != ''){
                    $this->submit($parent_email,$subject,$data,'marks');
                }
            }   
        }
    }

    function teacherSendEmail()
    {
        $subject = $this->input->post('subject');
        $data = array(
            'email_msg' => $this->input->post('content')
        );
        $users = $this->db->get_where('enroll', array('year' => $this->runningYear, 'class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id')))->result_array();
        foreach($users as $row)
        {
            if($this->input->post('receiver') == 'student'){
                if($this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->email != '')
                {
                    $this->submit($this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->email,$subject,$data,'notify');
                }
            }else if($this->input->post('receiver') == 'parent'){
                $this->db->group_by('parent_id');
                $this->db->where('student_id', $row['student_id']);
                $parent_id = $this->db->get('student')->row()->parent_id;
                if($this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->email != '')
                {
                    $this->submit($this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->email,$subject,$data,'notify');
                }
            }
        }
    }

    function resetPassword($email, $password)
    {
        $email_sub  = get_phrase('recover_your_password');
        $email_msg  = get_phrase('success_password')."<br>";
        $email_msg  .= get_phrase('new_password').": <b>". $password ."<b/><br>.";
        $data = array(
            'email_msg' => $email_msg
        );
        $this->submit($email,$email_sub,$data,'password');
    }

    function studentReport($student_name, $parent_email)
    {
        $this->mail_model->studentReport($student_name, $parent_email);
        $student = $this->db->get_where('student', array('student_id' => $this->input->post('student_id')))->row();
        $parent_id = $student->parent_id;
        $st_name = $student->first_name . " " . $student->last_name;
        $email_sub  = $this->db->get_where('email_template', array('task' => 'student_reports'))->row()->subject;
        $email_msg  = $this->db->get_where('email_template', array('task' => 'student_reports'))->row()->body;
        $STUDENT_NAME    =   $st_name;
        $parent = $this->db->get_where('parent', array('parent_id' => $parent_id))->row();
        $PARENT_NAME =   $parent ? $parent->first_name . " " . $parent->last_name : '';
        $email_msg   =   str_replace('[PARENT]', $PARENT_NAME, $email_msg);
        $email_msg   =   str_replace('[STUDENT]', $STUDENT_NAME, $email_msg);
        $email_to    =   $parent ? $parent->email : '';
        $email_data = array(
            'email_msg' => $email_msg
        );
            $this->submit($email_to,$email_sub,$email_data,'notify');
        
    }

    function sendHomeworkNotify()
    {
        $subj = $this->db->get_where('subject', array('subject_id' => $this->input->post('subject_id')))->row()->name;
        $email_sub  = $this->db->get_where('email_template', array('task' => 'new_homework'))->row()->subject;
        $email_msg   = $this->db->get_where('email_template', array('task' => 'new_homework'))->row()->body;
        $email_msg  =  str_replace('[DESCRIPTION]', $this->input->post('description'), $email_msg);
        $email_msg  =  str_replace('[TITLE]', $this->input->post('title'), $email_msg);
        $email_msg  =  str_replace('[SUBJECT]', $subj, $email_msg);
        $st = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $this->runningYear))->result_array();
        foreach($st as $r)
        {
            $email_data = array(
                'email_msg' => $email_msg
            );
            if($this->db->get_where('student' , array('student_id' => $r['student_id']))->row()->email != '')
            {
                $this->submit($this->db->get_where('student' , array('student_id' => $r['student_id']))->row()->email,$email_sub,$email_data,'notify');
            }
        }
    }

    function parentNewInvoice($student_name, $parent_email)
    {
        $email_sub  = $this->db->get_where('email_template', array('task' => 'parent_new_invoice'))->row()->subject;
        $STUDENT_NAME    =   $student_name;
        $PARENT_NAME =   $this->db->get_where('parent', array('email' => $parent_email))->row()->first_name;
        $email_msg  = $this->db->get_where('email_template', array('task' => 'parent_new_invoice'))->row()->body;
        $email_msg   =   str_replace('[PARENT]', $PARENT_NAME, $email_msg);
        $email_msg   =   str_replace('[STUDENT]', $STUDENT_NAME, $email_msg);
        $email_to    =   $parent_email;
        $data = array(
            'email_msg' => $email_msg
        );
        if($email_to != '')
        {
            $this->submit($email_to,$email_sub,$data,'notify');
        }
    }

    function studentNewInvoice($student_name, $student_email)
    {
        $email_sub  = $this->db->get_where('email_template', array('task' => 'student_new_invoice'))->row()->subject;
        $STUDENT_NAME    =   $student_name;
        $email_msg  = $this->db->get_where('email_template', array('task' => 'student_new_invoice'))->row()->body;
        $email_msg   =   str_replace('[STUDENT]', $STUDENT_NAME, $email_msg);
        $email_to    =   $student_email;
        $data = array(
            'email_msg' => $email_msg
        );
        if ($email_to != '') {
            $this->submit($email_to, $email_sub, $data, 'notify');
        }
    }

    function attendace($student_id, $parent_id)
    {
        $email_sub  = $this->db->get_where('email_template', array('task' => 'student_absences'))->row()->subject;
        $STUDENT_NAME   =   $this->crud_model->get_name('student', $student_id);
        $PARENT_NAME    =   $this->crud_model->get_name('parent', $parent_id);
        $email_msg  = $this->db->get_where('email_template', array('task' => 'student_absences'))->row()->body;
        $email_msg  =   str_replace('[PARENT]', $PARENT_NAME, $email_msg);
        $email_msg  =   str_replace('[STUDENT]', $STUDENT_NAME, $email_msg);
        $email_to   =   $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->email;
        $data = array(
            'email_msg' => $email_msg
        );
        if ($email_to != '') {
            $this->submit($email_to, $email_sub, $data, 'notify');
        }
    }

    function sendEmailNottify()
    {
        $subject = $this->input->post('subject');
        $data    = array(
            'email_msg' => $this->input->post('content')
        );
        $users = $this->db->get(''.$this->input->post('type').'')->result_array();
        foreach($users as $row)
        {
            if($row['email'] != ''){
                $this->submit($row['email'],$subject,$data,'notify');
            }
        }   
    }


    function submit($to, $subject, $message, $type)
    {
        $msg = $message['email_msg'];
        $config = Array(
            'protocol' => $this->db->get_where('settings', array('type' => 'protocol'))->row()->description,
            'smtp_host' => $this->db->get_where('settings', array('type' => 'smtp_host'))->row()->description,
            'smtp_port' => $this->db->get_where('settings', array('type' => 'smtp_port'))->row()->description,
            'smtp_user' => $this->db->get_where('settings', array('type' => 'smtp_user'))->row()->description,
            'smtp_pass' => $this->db->get_where('settings', array('type' => 'smtp_pass'))->row()->description,
            'mailtype'  => 'html', 
            'charset'   => $this->db->get_where('settings', array('type' => 'charset'))->row()->description,
            'wordwrap' => true
        );
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($this->db->get_where('settings', array('type' => 'system_email'))->row()->description, $this->db->get_where('settings', array('type' => 'system_name'))->row()->description);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($msg);

        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        }
    }
}

/* End of file mail_model.php */
