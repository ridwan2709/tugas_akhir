<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    function clear_cache()
    {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function create_video()
    {
        $img = md5(date('d/m/Y H:i:s'));
        $data['news_code']           = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['description']         = $this->input->post('description');
        $data['embed']               = $this->input->post('embed');
        $data['date']                = date('d, M');
        $data['publish_date']        = date('Y-m-d H:i:s');
        $data['admin_id']            = $this->session->userdata('login_user_id');
        $data['date2']               = date('H:i A');
        $data['type']                = "video";
        $this->db->insert('news', $data);
        return $news_code;
    }

    function update_panel_news($param2)
    {
        $data['description']         = $this->input->post('description');
        $data['date2']               = date('H:i A');
        $this->db->where('news_code', $param2);
        $this->db->update('news', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/news_images/' . $param2 . '.jpg');
    }

    function delete_news($param2)
    {
        unlink('uploads/news_images/' . $param2 . ".jpg");
        $id = $this->db->get_where('news', array('news_code' => $param2))->row()->news_id;
        $this->db->where('news_code', $param2);
        $this->db->delete('news');
    }

    function send_news_notify()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $notify['notify'] = get_phrase('new_notice_info');
        $parents = $this->db->get('parent')->result_array();
        $students = $this->db->get('student')->result_array();
        $teachers = $this->db->get('teacher')->result_array();
        $accountant = $this->db->get('accountant')->result_array();
        $librarian = $this->db->get('librarian')->result_array();
        foreach ($students as $row1) {
            $notify['user_id'] = $row1['student_id'];
            $notify['user_type'] = "student";
            $notify['url'] = "student/panel";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('student', strip_tags($notify['notify']));
        foreach ($parents as $row2) {
            $notify['user_id'] = $row2['parent_id'];
            $notify['user_type'] = "parent";
            $notify['url'] = "parents/panel";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('parent', strip_tags($notify['notify']));
        foreach ($teachers as $row3) {
            $notify['user_id'] = $row3['teacher_id'];
            $notify['user_type'] = "teacher";
            $notify['url'] = "teacher/panel";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('teacher', strip_tags($notify['notify']));
        foreach ($accountant as $row4) {
            $notify['user_id'] = $row4['accountant_id'];
            $notify['user_type'] = "accountant";
            $notify['url'] = "accountant/panel";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('accountant', strip_tags($notify['notify']));
        foreach ($librarian as $row5) {
            $notify['user_id'] = $row5['librarian_id'];
            $notify['user_type'] = "librarian";
            $notify['url'] = "librarian/panel";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['year'] = $year;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('librarian', strip_tags($notify['notify']));
    }

    function getDateFormat()
    {
        return date($this->db->get_where('settings', array('type' => 'date_format'))->row()->description);
    }

    function send_polls_notify()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $notify['notify'] = get_phrase('new_poll_notify');
        $parents = $this->db->get('parent')->result_array();
        $students = $this->db->get('student')->result_array();
        $teachers = $this->db->get('teacher')->result_array();
        $accountant = $this->db->get('accountant')->result_array();
        $librarian = $this->db->get('librarian')->result_array();
        foreach ($students as $row1) {
            $notify['user_id'] = $row1['student_id'];
            $notify['user_type'] = "student";
            $notify['url'] = "student/panel";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('student', strip_tags($notify['notify']));
        foreach ($parents as $row2) {
            $notify['user_id'] = $row2['parent_id'];
            $notify['user_type'] = "parent";
            $notify['url'] = "parents/panel";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('parent', strip_tags($notify['notify']));
        foreach ($teachers as $row3) {
            $notify['user_id'] = $row3['teacher_id'];
            $notify['user_type'] = "teacher";
            $notify['url'] = "teacher/panel";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('teacher', strip_tags($notify['notify']));
        foreach ($accountant as $row4) {
            $notify['user_id'] = $row4['accountant_id'];
            $notify['user_type'] = "accountant";
            $notify['url'] = "accountant/panel";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('accountant', strip_tags($notify['notify']));
        foreach ($librarian as $row5) {
            $notify['user_id'] = $row5['librarian_id'];
            $notify['user_type'] = "librarian";
            $notify['url'] = "librarian/panel";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['year'] = $year;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('librarian', strip_tags($notify['notify']));
    }

    function send_calendar_notify()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $notify['notify'] = get_phrase('new_event_notify');
        $parents = $this->db->get('parent')->result_array();
        $students = $this->db->get('student')->result_array();
        $teachers = $this->db->get('teacher')->result_array();
        $accountant = $this->db->get('accountant')->result_array();
        $librarian = $this->db->get('librarian')->result_array();
        foreach ($students as $row1) {
            $notify['user_id'] = $row1['student_id'];
            $notify['user_type'] = "student";
            $notify['url'] = "student/calendar";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('student', strip_tags($notify['notify']));
        foreach ($parents as $row2) {
            $notify['user_id'] = $row2['parent_id'];
            $notify['user_type'] = "parent";
            $notify['url'] = "parents/calendar";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('parent', strip_tags($notify['notify']));
        foreach ($teachers as $row3) {
            $notify['user_id'] = $row3['teacher_id'];
            $notify['user_type'] = "teacher";
            $notify['url'] = "teacher/calendar";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['year'] = $year;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('teacher', strip_tags($notify['notify']));
        foreach ($accountant as $row4) {
            $notify['user_id'] = $row4['accountant_id'];
            $notify['user_type'] = "accountant";
            $notify['url'] = "accountant/calendar";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'news';
            $notify['year'] = $year;
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('accountant', strip_tags($notify['notify']));
        foreach ($librarian as $row5) {
            $notify['user_id'] = $row5['librarian_id'];
            $notify['user_type'] = "librarian";
            $notify['url'] = "librarian/calendar";
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['year'] = $year;
            $notify['type'] = 'news';
            $notify['original_id'] = 0;
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('librarian', strip_tags($notify['notify']));
    }

    function get_correct_answer($question_bank_id = "")
    {
        $question_details = $this->db->get_where('question_bank', array('question_bank_id' => $question_bank_id))->row_array();
        return $question_details['correct_answers'];
    }

    function calculate_exam_mark($online_exam_id)
    {

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        $obtained_marks = 0;
        $online_exam_result = $this->db->get_where('online_exam_result', $checker);
        if ($online_exam_result->num_rows() == 0) {
            $data['obtained_mark'] = 0;
        } else {
            $results = $online_exam_result->row_array();
            $answer_script = json_decode($results['answer_script'], true);
            foreach ($answer_script as $row) {
                if ($row['submitted_answer'] == $row['correct_answers']) {
                    $obtained_marks = $obtained_marks + $this->get_question_details_by_id($row['question_bank_id'], 'mark');
                }
            }
            $data['obtained_mark'] = $obtained_marks;
        }
        $total_mark = $this->get_total_mark($online_exam_id);
        $query = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row_array();
        $minimum_percentage = $query['minimum_percentage'];
        $minumum_required_marks = ($total_mark * $minimum_percentage) / 100;
        if ($minumum_required_marks > $obtained_marks) {
            $data['result'] = 'fail';
        } else {
            $data['result'] = 'pass';
        }
        $this->db->where($checker);
        $this->db->update('online_exam_result', $data);
    }

    function get_question_details_by_id($question_bank_id, $column_name = "")
    {
        return $this->db->get_where('question_bank', array('question_bank_id' => $question_bank_id))->row()->$column_name;
    }

    function submit_online_exam($online_exam_id = "", $answer_script = "")
    {
        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        $updated_array = array(
            'status' => 'submitted',
            'answer_script' => $answer_script
        );
        $this->db->where($checker);
        $this->db->update('online_exam_result', $updated_array);
        $this->calculate_exam_mark($online_exam_id);
    }

    function change_online_exam_status_to_attended_for_student($online_exam_id = "")
    {
        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        if ($this->db->get_where('online_exam_result', $checker)->num_rows() == 0) {
            $inserted_array = array(
                'status' => 'attended',
                'online_exam_id' => $online_exam_id,
                'student_id' => $this->session->userdata('login_user_id'),
                'exam_started_timestamp' => strtotime("now")
            );
            $this->db->insert('online_exam_result', $inserted_array);
        }
    }

    function check_text($text)
    {
        $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
        if (preg_match($reg_exUrl, $text, $url)) {
            if (strpos($url[0], ":") === false) {
                $link = 'http://' . $url[0];
            } else {
                $link = $url[0];
            }
            echo preg_replace($reg_exUrl, '<a target="_blank" href="' . $link . '" title="' . $url[0] . '">' . $url[0] . '</a>', $text);
        } else {
            echo $text;
        }
    }

    function check_availability_for_student($online_exam_id)
    {
        $result = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $this->session->userdata('login_user_id')))->row_array();
        return $result['status'];
    }

    function parent_check_availability_for_student($online_exam_id, $student_id)
    {
        $result = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $student_id))->row_array();
        return $result['status'];
    }

    function available_exams($student_id, $subject_id)
    {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $class_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->class_id;
        $section_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->section_id;
        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id, 'status' => 'published');
        $this->db->order_by("online_exam_id", "dsc");
        $exams = $this->db->where($match)->get('online_exam')->result_array();
        return $exams;
    }

    function parent_available_exams($class_id, $section_id, $subject_id)
    {
        $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id);
        $this->db->order_by("online_exam_id", "dsc");
        $exams = $this->db->where($match)->get('online_exam')->result_array();
        return $exams;
    }

    function folderSize($dir)
    {
        $count_size = 0;
        $count = 0;
        $dir_array = scandir($dir);
        foreach ($dir_array as $key => $filename) {
            if ($filename != ".." && $filename != ".") {
                if (is_dir($dir . "/" . $filename)) {
                    $new_foldersize = $dir . "/" . $filename;
                    $count_size = $count_size + $new_foldersize;
                } else if (is_file($dir . "/" . $filename)) {
                    $count_size = $count_size + filesize($dir . "/" . $filename);
                    $count++;
                }
            }
        }
        return $count_size;
    }

    function get_birthdays()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $array_users = array();
        $query_admins = $this->db->query("SELECT admin_id, first_name, last_name, birthday FROM admin WHERE substring_index(birthday, '/', 1) = " . date('m') . "")->result_array();
        foreach ($query_admins as $row) {
            $birthDate = $row['birthday'];
            $array_admins = array('name' => $row['first_name'], 'user_id' => $row['admin_id'], 'type' => 'admin');
            array_push($array_users, $array_admins);
        }
        $query_teachers = $this->db->query("SELECT teacher_id, first_name, last_name, birthday FROM teacher WHERE substring_index(birthday, '/', 1) = " . date('m') . "")->result_array();
        foreach ($query_teachers as $row2) {
            $birthDate = $row2['birthday'];
            $time = strtotime($birthDate);
            $array_teachers = array('name' => $row2['first_name'], 'user_id' => $row2['teacher_id'], 'type' => 'teacher');
            array_push($array_users, $array_teachers);
        }
        $query_student = $this->db->query("SELECT student_id, birthday FROM student WHERE substring_index(birthday, '/', 1) = " . date('m') . "")->result_array();
        foreach ($query_student as $row5) {
            $birthDate = $row5['birthday'];
            $time = strtotime($birthDate);
            $array_stduent = array('name' => $this->crud_model->get_name('student', $row5['student_id']), 'user_id' => $row5['student_id'], 'type' => 'student');
            array_push($array_users, $array_stduent);
        }
        return $array_users;
    }


    function get_birthdays_by_month($month)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $array_users = array();
        $query_admins = $this->db->query("SELECT admin_id, first_name, last_name, birthday FROM admin WHERE substring_index(birthday, '/', 1) = " . $month . "")->result_array();
        foreach ($query_admins as $row) {
            $birthDate = $row['birthday'];
            $array_admins = array('name' => $row['first_name'], 'user_id' => $row['admin_id'], 'birthday' => $row['birthday'], 'type' => 'admin');
            array_push($array_users, $array_admins);
        }
        $query_teachers = $this->db->query("SELECT teacher_id, first_name, last_name, birthday FROM teacher WHERE substring_index(birthday, '/', 1) = " . $month . "")->result_array();
        foreach ($query_teachers as $row2) {
            $birthDate = $row2['birthday'];
            $time = strtotime($birthDate);
            $array_teachers = array('name' => $row2['first_name'], 'user_id' => $row2['teacher_id'], 'birthday' => $row2['birthday'], 'type' => 'teacher');
            array_push($array_users, $array_teachers);
        }
        $query_accountant = $this->db->query("SELECT accountant_id, first_name, last_name, birthday FROM accountant WHERE substring_index(birthday, '/', 1) = " . $month . "")->result_array();
        foreach ($query_accountant as $row3) {
            $birthDate = $row3['birthday'];
            $time = strtotime($birthDate);
            $array_accountant = array('name' => $row3['first_name'], 'user_id' => $row3['accountant_id'], 'birthday' => $row3['birthday'], 'type' => 'accountant');
            array_push($array_users, $array_accountant);
        }
        $query_librarian = $this->db->query("SELECT librarian_id, first_name, last_name, birthday FROM librarian WHERE substring_index(birthday, '/', 1) = " . $month . "")->result_array();
        foreach ($query_librarian as $row4) {
            $birthDate = $row4['birthday'];
            $time = strtotime($birthDate);
            $array_librarian = array('name' => $row4['first_name'], 'user_id' => $row4['librarian_id'], 'birthday' => $row4['birthday'], 'type' => 'librarian');
            array_push($array_users, $array_librarian);
        }
        $query_student = $this->db->query("SELECT student_id, birthday FROM student WHERE substring_index(birthday, '/', 1) = " . $month . "")->result_array();
        foreach ($query_student as $row5) {
            $birthDate = $row5['birthday'];
            $time = strtotime($birthDate);
            $array_stduent = array('name' => $this->crud_model->get_name('student', $row5['student_id']), 'birthday' => $row5['birthday'], 'user_id' => $row5['student_id'], 'type' => 'student');
            array_push($array_users, $array_stduent);
        }
        return $array_users;
    }

    function add_multiple_choice_question_to_online_exam($online_exam_id)
    {
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message', get_phrase('no_options_can_be_blank'));
            return;
        }
        foreach ($this->input->post('options') as $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message', get_phrase('no_options_can_be_blank'));
                return;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        } else {
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['number_of_options']  = html_escape($this->input->post('number_of_options'));
        $data['type']               = 'multiple_choice';
        $data['options']            = json_encode($this->input->post('options'));
        $data['correct_answers']    = json_encode($correct_answers);
        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
    }

    function add_true_false_question_to_online_exam($online_exam_id)
    {
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['type']               = 'true_false';
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['correct_answers']    = html_escape($this->input->post('true_false_answer'));
        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
    }

    function add_fill_in_the_blanks_question_to_online_exam($online_exam_id)
    {
        $postData = $this->input->post();
        $suitable_words_array = explode(',', html_escape($this->input->post('suitable_words')));
        $suitable_words = array();
        foreach ($suitable_words_array as $row) {
            array_push($suitable_words, strtolower($row));
        }
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['type']               = 'fill_in_the_blanks';
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['correct_answers']    = json_encode(array_map('trim', $suitable_words));
        $data['image']           = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('question_bank', $data);
        $image = $this->db->get_where('question_bank', array('question_bank_id' => $this->db->insert_id()))->row()->image;
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/exam_image/' . $image . '.jpg');
        return $image;
        $this->session->set_flashdata('flash_message', get_phrase('successfully_added'));
    }

    function update_true_false_question($question_id)
    {
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['correct_answers']    = html_escape($this->input->post('true_false_answer'));
        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
    }

    function get_total_mark($online_exam_id)
    {
        $added_question_info = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();
        $total_mark = 0;
        if (sizeof($added_question_info) > 0) {
            foreach ($added_question_info as $single_question) {
                $total_mark = $total_mark + $single_question['mark'];
            }
        }
        return $total_mark;
    }

    function update_fill_in_the_blanks_question($question_id)
    {
        $suitable_words_array = explode(',', html_escape($this->input->post('suitable_words')));
        $suitable_words = array();
        foreach ($suitable_words_array as $row) {
            array_push($suitable_words, strtolower($row));
        }
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['correct_answers']    = json_encode(array_map('trim', $suitable_words));

        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
    }

    function delete_question_from_online_exam($question_id)
    {
        $this->db->where('question_bank_id', $question_id);
        $this->db->delete('question_bank');
    }

    function update_multiple_choice_question($question_id)
    {
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message', get_phrase('no_options_can_be_blank'));
            return;
        }
        foreach ($this->input->post('options') as $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message', get_phrase('no_options_can_be_blank'));
                return;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        } else {
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['question_title']     = html_escape($this->input->post('question_title'));
        $data['mark']               = html_escape($this->input->post('mark'));
        $data['number_of_options']  = html_escape($this->input->post('number_of_options'));
        $data['options']            = json_encode($this->input->post('options'));
        $data['correct_answers']    = json_encode($correct_answers);
        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
    }

    function manage_online_exam_status($online_exam_id = "", $status = "")
    {
        $checker = array(
            'online_exam_id' => $online_exam_id
        );
        $updater = array(
            'status' => $status
        );

        $this->db->where($checker);
        $this->db->update('online_exam', $updater);
        $this->session->set_flashdata('flash_message', get_phrase('successfully_updated'));
    }

    public function checkUser($userData = array())
    {
        $credential = array('g_oauth' => $userData['oauth_uid']);
        $query = $this->db->get_where('admin', $credential);

        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('teacher', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('student', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('parent', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('accountant', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('librarian', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
    }

    public function checkusername($username)
    {
        $credential = array('username' => $username);
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('teacher', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('student', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('parent', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('accountant', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('librarian', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
    }

    public function checkUser2($userID)
    {
        $credential = array('fb_id' => $userID);
        $query = $this->db->get_where('admin', $credential);

        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('teacher', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('student', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('parent', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('accountant', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
        $query = $this->db->get_where('librarian', $credential);
        if ($query->num_rows() > 0) {
            return 'success';
        }
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name')
    {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    function delete_cache($uri_string = null)
    {
        $CI = &get_instance();
        $path = $CI->config->item('cache_path');
        $path = rtrim($path, DIRECTORY_SEPARATOR);
        $cache_path = ($path == '') ? APPPATH . 'cache/' : $path;
        $uri =  $CI->config->item('base_url') .
            $CI->config->item('index_page') .
            $uri_string;
        $cache_path .= md5($uri);
        return unlink($cache_path);
    }

    function count_attendance_students($status)
    {
        $timestamp   = strtotime(date('d-m-Y'));
        $this->db->where('timestamp', $timestamp);
        $this->db->where('status', $status);
        $this->db->from('attendance');
        $result = $this->db->count_all_results();
        return $result;
    }

    function clickatell($message = '', $reciever = '')
    {
        $clickatell_user       = $this->db->get_where('settings', array('type' => 'clickatell_username'))->row()->description;
        $clickatell_password   = $this->db->get_where('settings', array('type' => 'clickatell_password'))->row()->description;
        $clickatell_api_id     = $this->db->get_where('settings', array('type' => 'clickatell_api'))->row()->description;
        $clickatell_baseurl    = "http://api.clickatell.com";
        $text   = urlencode($message);
        $to     = $reciever;
        $url = "$clickatell_baseurl/http/auth?user=$clickatell_user&password=$clickatell_password&api_id=$clickatell_api_id";
        $ret = file($url);
        $sess = explode(":", $ret[0]);
        print_r($sess);
        echo '<br>';
        if ($sess[0] == "OK") {
            $sess_id = trim($sess[1]);
            $url = "$clickatell_baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";
            $ret = file($url);
            $send = explode(":", $ret[0]);
            print_r($send);
            echo '<br>';
            if ($send[0] == "ID") {
                echo "successnmessage ID: " . $send[1];
            } else {
                echo "Failed";
            }
        } else {
            echo "Authentication fail: " . $ret[0];
        }
    }

    function twilio($message = "", $reciever = "")
    {
        require_once(APPPATH . 'libraries/twilio_library/Twilio.php');
        $account_sid    = $this->db->get_where('settings', array('type' => 'twilio_account_sid'))->row()->description;
        $auth_token     = $this->db->get_where('settings', array('type' => 'twilio_auth_token'))->row()->description;
        $client         = new Services_Twilio($account_sid, $auth_token);
        $client->account->messages->create(array(
            'To'        => $reciever_phone,
            'From'      => $this->db->get_where('settings', array('type' => 'twilio_sender_phone_number'))->row()->description,
            'Body'      => $message
        ));
    }

    function tz_list()
    {
        $zones_array = array();
        $timestamp = time();
        foreach (timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone'] = $zone;
            $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
        }
        return $zones_array;
    }

    function students_reports($student_name, $parent_email)
    {
        $this->mail_model->studentReport($student_name, $parent_email);
    }

    function send_homework_notify()
    {
        $this->mail_model->sendHomeworkNotify();
    }

    function send_sms_via_msg91($message = '', $reciever_phone = '')
    {

        $authKey       = $this->db->get_where('settings', array('type' => 'msg91_key'))->row()->description;
        $senderId      = $this->db->get_where('settings', array('type' => 'msg91_sender'))->row()->description;
        $country_code  = $this->db->get_where('settings', array('type' => 'msg91_code'))->row()->description;
        $route         = $this->db->get_where('settings', array('type' => 'msg91_route'))->row()->description;
        $mobileNumber = $reciever_phone;
        $message = urlencode($message);
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route,
            'country' => $country_code
        );
        $url = "http://api.msg91.com/api/sendhttp.php";
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
    }

    function parent_new_invoice($student_name, $parent_email)
    {
        $this->mail_model->parentNewInvoice($student_name, $parent_email);
    }

    function student_new_invoice($student_name, $student_email)
    {
        $this->mail_model->studentNewInvoice($student_name, $student_email);
    }

    function attendance($student_id, $parent_id)
    {
        $this->mail_model->attendace($student_id, $parent_id);
    }

    function count_attendance_teacher($status)
    {
        $timestamp   = strtotime(date('d-m-Y'));
        $this->db->where('timestamp', $timestamp);
        $this->db->where('status', $status);
        $this->db->from('teacher_attendance');
        $result = $this->db->count_all_results();
        return $result;
    }

    function get_students($class_id)
    {
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_student_info($student_id)
    {
        $query = $this->db->get_where('student', array('student_id' => $student_id));
        return $query->result_array();
    }

    function create_post()
    {
        $data['title'] = $this->input->post('title');
        $data['type'] = $this->session->userdata('login_type');
        $data['description'] = $this->input->post('description');
        $data['class_id'] = $this->input->post('class_id');
        $data['file_name']         = $_FILES["file_name"]["name"];
        $data['section_id'] = $this->input->post('section_id');
        $data['timestamp'] = strtotime(date("d M,Y"));
        $data['subject_id'] = $this->input->post('subject_id');
        $data['teacher_id']  =   $this->session->userdata('login_user_id');
        $data['post_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('forum', $data);
        $post_code = $this->db->get_where('forum', array('post_id' => $this->db->insert_id()))->row()->post_code;
        $docs_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/forum/" . $_FILES["file_name"]["name"]);
        return $post_code;
    }

    function homework_create()
    {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['time_end'] = $this->input->post('time_end');
        $data['date_end'] = $this->input->post('date_end');
        $data['type'] = $this->input->post('type');
        $data['class_id'] = $this->input->post('class_id');
        $data['file_name']         = $_FILES["file_name"]["name"];
        $data['section_id'] = $this->input->post('section_id');
        $data['user'] = $this->session->userdata('login_type');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['uploader_type']  =   $this->session->userdata('login_type');
        $data['uploader_id']  =   $this->session->userdata('login_user_id');
        $data['homework_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('homework', $data);
        $homework_code = $this->db->get_where('homework', array('homework_id' => $this->db->insert_id()))->row()->homework_code;
        $doc_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/homework/" . $_FILES["file_name"]["name"]);
        return $homework_code;
    }

    function public_files($id)
    {
        $data['category_id'] = $id;
        $data['file']         = $_FILES["file_name"]["name"];
        $data['code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('homework', $data);
        $homework_code = $this->db->get_where('homework', array('homework_id' => $this->db->insert_id()))->row()->homework_code;
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/public/" . $_FILES["file_name"]["name"]);
    }

    function update_homework($homework_code)
    {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['time_end'] = $this->input->post('time_end');
        $this->db->where('homework_code', $homework_code);
        $this->db->update('homework', $data);
    }

    function update_post($post_code)
    {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $this->db->where('post_code', $post_code);
        $this->db->update('forum', $data);
    }

    function create_group()
    {
        $data = array();
        $data['group_message_thread_code'] = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data['created_timestamp'] = date("d M, Y H:i");
        $data['group_name'] = $this->input->post('group_name');
        if (!empty($_POST['user'])) {
            array_push($_POST['user'], $this->session->userdata('login_type') . '_' . $this->session->userdata('login_user_id'));
            $data['members'] = json_encode($_POST['user']);
        } else {
            $_POST['user'] = array();
            array_push($_POST['user'], $this->session->userdata('login_type') . '_' . $this->session->userdata('login_user_id'));
            $data['members'] = json_encode($_POST['user']);
        }
        $this->db->insert('group_message_thread', $data);
    }

    function update_group($thread_code = "")
    {
        $data = array();
        $data['group_name'] = $this->input->post('group_name');
        if (!empty($_POST['user'])) {
            array_push($_POST['user'], $this->session->userdata('login_type') . '_' . $this->session->userdata('admin_id'));
            $data['members'] = json_encode($_POST['user']);
        } else {
            $_POST['user'] = array();
            array_push($_POST['user'], $this->session->userdata('login_type') . '_' . $this->session->userdata('admin_id'));
            $data['members'] = json_encode($_POST['user']);
        }
        $this->db->where('group_message_thread_code', $thread_code);
        $this->db->update('group_message_thread', $data);
    }

    function send_reply_group_message($message_thread_code)
    {
        $message    = $this->input->post('message');
        $timestamp  = date("d M. H:iA");
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        if ($_FILES['attached_file_on_messaging']['name'] != "") {
            $data_message['attached_file_name'] = $_FILES['attached_file_on_messaging']['name'];
            $data_message['file_type'] = strtolower(pathinfo($_FILES["attached_file_on_messaging"]["name"], PATHINFO_EXTENSION));
        }
        $data_message['group_message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $this->db->insert('group_message', $data_message);
    }

    function count_unread_messages()
    {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->group_by('message_thread_code');
        $this->db->where('read_status', 0);
        $this->db->where('reciever', $current_user);
        $unread_message_counter = $this->db->get('message')->num_rows();
        return $unread_message_counter;
    }

    function create_post_message($post_code = '')
    {
        $data['message'] = $this->input->post('message');
        $data['post_id'] = $this->db->get_where('forum', array('post_code' => $post_code))->row()->post_id;
        $data['date'] = date("d M, Y H:iA");
        $data['user_type'] = $this->session->userdata('login_type');
        $data['user_id'] = $this->session->userdata('login_user_id');
        $this->db->insert('forum_message', $data);
    }

    function delete_homework($homework_code)
    {
        $file_n = $this->db->get_where('homework', array('homework_code' => $homework_code))->row()->file_name;
        unlink("uploads/homework/" . $file_n);
        $this->db->where('homework_code', $homework_code);
        $this->db->delete('homework');
    }

    function delete_post($post_code)
    {
        $this->db->where('post_code', $post_code);
        $this->db->delete('forum');
    }

    function admin_delete($admin_id)
    {
        $this->db->where('admin_id', $admin_id);
        $this->db->delete('admin');
    }

    function get_teachers()
    {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }

    function get_teacher_name($teacher_id)
    {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function update_online_exam()
    {

        $data['title'] = html_escape($this->input->post('exam_title'));
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['minimum_percentage'] = html_escape($this->input->post('minimum_percentage'));
        $data['password']    = html_escape($this->input->post('password'));
        $data['instruction'] = html_escape($this->input->post('instruction'));
        $data['exam_date'] = strtotime(html_escape($this->input->post('exam_date')));
        $data['time_start'] = html_escape($this->input->post('time_start'));
        $data['time_end'] = html_escape($this->input->post('time_end'));
        $data['duration'] = (trim($this->input->post('duration'))) ? $this->input->post('duration') : strtotime(date('Y-m-d', $data['exam_date']) . ' ' . $data['time_end']) - strtotime(date('Y-m-d', $data['exam_date']) . ' ' . $data['time_start']);

        $this->db->where('online_exam_id', $this->input->post('online_exam_id'));
        $this->db->update('online_exam', $data);
    }

    function get_student_info_by_id($student_id)
    {
        $query = $this->db->get_where('student', array('student_id' => $student_id))->row_array();
        return $query;
    }

    function get_teacher_info($teacher_id)
    {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }

    function get_subjects()
    {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id)
    {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id)
    {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_subject_name_by_id($subject_id)
    {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        return $query->name;
    }

    function get_class_name($class_id)
    {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_class_name_numeric($class_id)
    {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes()
    {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function income($month)
    {
        $income = $this->db->get_where('payment', array('month' => $month, 'payment_type' => 'income'))->result_array();
        $total = 0;
        foreach ($income as $row) {
            $total += $this->db->get_where('invoice', array('invoice_id' => $row['invoice_id']))->row()->amount;
        }
        return $total;
    }

    function expense($month)
    {
        $expese = $this->db->get_where('payment', array('month' => $month, 'payment_type' => 'expense'))->result_array();
        $total = 0;
        foreach ($expese as $row) {
            $total += $row['amount'];
        }
        return $total;
    }

    public function invoice_xy($month)
    {
        $completed = $this->db->get_where('invoice', array(
            "status" => "completed",
            "DATE_FORMAT(month, '%b') =" => trim($month),
        ))->result_array();
        $total = 0;
        foreach ($completed as $row) {
            $total += $row['amount'];
        }
        return $total;
    }

    function get_class_info($class_id)
    {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_exams()
    {
        $query = $this->db->get('exam');
        return $query->result_array();
    }

    function get_report($class_id = '', $section_id = '', $student_id = '', $tgl_awal = '' , $tgl_akhir = '')
    {
        $query = $this->db->get_where('build', array('student_id' => $student_id, 'class_id' => $class_id, 'section_id' => $section_id, 'date>=' => $tgl_awal, 'date<=' => $tgl_akhir));
        return $query->result_array();
    }

    function get_exam_info($exam_id)
    {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    function get_grades()
    {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id)
    {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_obtained_marks($exam_id, $class_id, $subject_id, $student_id)
    {
        $marks = $this->db->get_where('mark', array(
            'subject_id' => $subject_id,
            'exam_id' => $exam_id,
            'class_id' => $class_id,
            'student_id' => $student_id
        ))->result_array();

        foreach ($marks as $row) {
            echo $row['mark_obtained'];
            echo $row['labuno'];
            echo $row['labdos'];
            echo $row['labtres'];
            echo $row['labcuatro'];
            echo $row['labcinco'];
            echo $row['labseis'];
            echo $row['labsiete'];
            echo $row['labocho'];
            echo $row['labnueve'];
        }
    }

    function get_highest_marks($exam_id, $class_id, $subject_id)
    {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);
        $this->db->select_max('mark_obtained');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach ($highest_marks as $row) {
            echo $row['mark_obtained'];
        }
    }

    function get_grade($mark_obtained)
    {
        $this->db->get('grade');
        $this->db->where('mark_from <= ', $mark_obtained);
        $query = $this->db->where('mark_to >= ', $mark_obtained);
        $grades = $query->result_array();
        foreach ($grades as $ro) {
            echo $ro['grade_point'];
        }
    }

    function create_log($data)
    {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    function get_system_settings()
    {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

    function generateUsername($length = 8)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generatePassword($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function truncate($type)
    {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    function get_name($type = '', $id = '')
    {
        if (!$type || !$id) {
            return '';
        }
        $first = $this->db->get_where('' . $type . '', array($type . "_id" => $id))->row()->first_name;
        $last = $this->db->get_where('' . $type . '', array($type . "_id" => $id))->row()->last_name;
        $name = $first . " " . $last;
        return $name;
    }

    function get_image_url($type = '', $id = '')
    {
        $img = $this->db->get_where('' . $type . '', array($type . "_id" => $id))->row()->image;
        $name = strtoupper($this->db->get_where('' . $type . '', array($type . "_id" => $id))->row()->first_name);
        if (file_exists('uploads/' . $type . '_image/' . $img) && $img != "")
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $img;
        else
            $image_url = base_url() . 'uploads/avatars/' . $name[0] . '.svg';
        return $image_url;
    }

    function get_image_video($type = '', $id = '')
    {
        if (file_exists('uploads/screen/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/screen/' . $id . '.jpg';
        else $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base - floor($base)), $precision) . '' . $suffixes[floor($base)];
    }

    function save_study_material_info()
    {
        $data['type'] = $this->session->userdata('login_type');
        $data['timestamp']         = strtotime(date("Y-m-d H:i:s"));
        $data['title']             = $this->input->post('title');
        $data['description']       = $this->input->post('description');
        $data['upload_date'] = date('d M. H:iA');
        $data['publish_date'] = date('Y-m-d H:i:s');
        // $data['file_name']         = str_replace(" ", "",$_FILES["file_name"]["name"]);
        // $data['filesize']         =  $this->formatBytes($_FILES["file_name"]["size"]);
        $data['file_name']         = $this->input->post('file_name');
        $data['filesize']         = null;
        $data['wall_type'] = 'material';
        $data['file_type']         = 'Other'; //$this->input->post('file_type');
        $data['class_id']          = $this->input->post('class_id');
        $data['subject_id']         = $this->input->post('subject_id');
        $data['section_id']         = $this->input->post('section_id');
        $data['teacher_id'] = $this->session->userdata('login_user_id');
        $this->db->insert('document', $data);
        $document_id            = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . str_replace(" ", "", $_FILES["file_name"]["name"]));
    }

    function get_expense($month)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $expense = $this->db->get_where('payment', array('year' => $year, 'payment_type' => 'expense', 'month' => $month))->result_array();
        $total = 0;
        foreach ($expense as $row) {
            $total += $row['amount'];
        }
        return $total;
    }

    function get_payments($month)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $expense = $this->db->get_where('payment', array('year' => $year, 'payment_type' => 'income', 'month' => $month))->result_array();
        $total = 0;
        foreach ($expense as $row) {
            $total += $row['amount'];
        }
        return $total;
    }

    function get_completed_invoices($month)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $completed = $this->db->get_where('invoice', array(
            "year" => $year,
            "status" => "completed",
            "DATE_FORMAT(month, '%b') =" => trim($month),
        ))->result_array();
        $total = 0;
        foreach ($completed as $row) {
            $total += $row['amount'];
        }
        return $total;
    }

    function get_pending_invoices($month)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $completed = $this->db->get_where('invoice', array('year' => $year, 'status' => 'pending', 'month' => $month))->result_array();
        $total = 0;
        foreach ($completed as $row) {
            $total += $row['amount'];
        }
        return $total;
    }


    function select_study_material_info()
    {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('document')->result_array();
    }

    function create_news()
    {
        $data['news_code']           = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['description']         = $this->input->post('description');
        $data['date']                = date('d, M');
        $data['publish_date']        = date('Y-m-d H:i:s');
        $data['admin_id']        = $this->session->userdata('login_user_id');
        $data['date2']                = date('H:i A');
        $data['type']                = "news";
        $this->db->insert('news', $data);
        $news_code = $this->db->get_where('news', array('news_id' => $this->db->insert_id()))->row()->news_code;
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/news_images/' . $news_code . '.jpg');
        return $news_code;
    }

    function import_db()
    {
        $this->load->database();
        $this->db->truncate('academic_settings');
        $this->db->truncate('accountant');
        $this->db->truncate('account_role');
        $this->db->truncate('admin');
        $this->db->truncate('attendance');
        $this->db->truncate('book');
        $this->db->truncate('book_request');
        $this->db->truncate('ci_sessions');
        $this->db->truncate('class');
        $this->db->truncate('class_routine');
        $this->db->truncate('deliveries');
        $this->db->truncate('document');
        $this->db->truncate('dormitory');
        $this->db->truncate('email_template');
        $this->db->truncate('enroll');
        $this->db->truncate('events');
        $this->db->truncate('exam');
        $this->db->truncate('expense_category');
        $this->db->truncate('file');
        $this->db->truncate('folder');
        $this->db->truncate('forum');
        $this->db->truncate('forum_message');
        $this->db->truncate('grade');
        $this->db->truncate('group_message');
        $this->db->truncate('group_message_thread');
        $this->db->truncate('homework');
        $this->db->truncate('horarios_examenes');
        $this->db->truncate('invoice');
        $this->db->truncate('language');
        $this->db->truncate('librarian');
        $this->db->truncate('mark');
        $this->db->truncate('mensaje_reporte');
        $this->db->truncate('message');
        $this->db->truncate('message_thread');
        $this->db->truncate('news');
        $this->db->truncate('notice_message');
        $this->db->truncate('notification');
        $this->db->truncate('online_exam');
        $this->db->truncate('online_exam_result');
        $this->db->truncate('online_users');
        $this->db->truncate('parent');
        $this->db->truncate('payment');
        $this->db->truncate('pending_users');
        $this->db->truncate('polls');
        $this->db->truncate('poll_response');
        $this->db->truncate('question_bank');
        $this->db->truncate('question_paper');
        $this->db->truncate('reporte_alumnos');
        $this->db->truncate('reporte_mensaje');
        $this->db->truncate('reports');
        $this->db->truncate('report_response');
        $this->db->truncate('request');
        $this->db->truncate('section');
        $this->db->truncate('settings');
        $this->db->truncate('student');
        $this->db->truncate('students_request');
        $this->db->truncate('subject');
        $this->db->truncate('teacher');
        $this->db->truncate('teacher_attendance');
        $this->db->truncate('teacher_files');
        $this->db->truncate('ticket');
        $this->db->truncate('ticket_message');
        $this->db->truncate('transport');

        $file_n = $_FILES["file_name"]["name"];
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/" . $_FILES["file_name"]["name"]);
        $filename = "uploads/" . $file_n;
        $mysql_host = $this->db->hostname;
        $mysql_username = $this->db->username;
        $mysql_password = $this->db->password;
        $mysql_database = $this->db->database;
        mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connect to MySQL: ' . mysqli_error());
        mysqli_select_db($mysql_database) or die('Error to connect MySQL: ' . mysqli_error());
        $templine = '';
        $lines = file($filename);
        foreach ($lines as $line) {
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            $templine .= $line;
            if (substr(trim($line), -1, 1) == ';') {
                mysqli_query($templine) or print('Error \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
                $templine = '';
                if (mysqli_errno() == 1062) {
                    print 'no way!';
                }
            }
        }
        unlink("uploads/" . $file_n);
        $this->session->set_flashdata('flash_message', "Import success");
    }

    function delete_book($libro_id)
    {
        $this->db->where('libro_id', $libro_id);
        $this->db->delete('libreria');
    }

    function create_news_message($news_code = '')
    {
        $admins = $this->db->get('admin')->result_array();
        $notify['notify'] = "<strong>" . $this->session->userdata('name') . "</strong>" . " " . get_phrase('new_comment') . " <b>" . $this->db->get_where('news', array('news_code' => $news_code))->row()->title . "</b>";
        foreach ($admins as $row) {
            $notify['user_id'] = $row['admin_id'];
            $notify['user_type'] = "admin";
            $notify['url'] = "admin/read/" . $news_code;
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('admin', strip_tags($notify['notify']));

        $data['message']      = $this->input->post('message');
        $data['news_id']      = $this->db->get_where('news', array('news_code' => $news_code))->row()->news_id;
        $data['date']         = date("d M Y");
        $data['user_type']    = $this->session->userdata('login_type');
        $data['user_id']      = $this->session->userdata('login_user_id');
        return $this->db->insert('mensaje_reporte', $data);
    }

    function create_notice_message($notice_code = '')
    {
        $data['message']      = $this->input->post('message');
        $data['notice_id']   = $this->db->get_where('news_teacher', array('notice_code' => $notice_code))->row()->notice_id;
        $data['date']         = date("d M Y");
        $data['user_type']    = $this->session->userdata('login_type');
        $data['user_id']      = $this->session->userdata('login_user_id');
        if ($_FILES['userfile']['name'] != '')
            $data['message_file_name'] = $_FILES['userfile']['name'];
        $this->db->insert('notice_message', $data);
        if ($_FILES['userfile']['name'] != '')
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/notice_message_file/' . $_FILES['userfile']['name']);
    }

    function select_study_material_info_for_student()
    {
        $student_id = $this->session->userdata('student_id');
        $class_id   = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description))->row()->class_id;
        $this->db->order_by("timestamp", "desc");
        return $this->db->get_where('document', array('class_id' => $class_id))->result_array();
    }

    function update_study_material_info($document_id)
    {
        $data['timestamp']      = strtotime(date("Y-m-d H:i:s"));
        $data['description']    = $this->input->post('description');
        $data['file_name']         = $this->input->post('file_name');

        $this->db->where('document_id', $document_id);
        $this->db->update('document', $data);
    }

    function delete_study_material_info($document_id)
    {
        $file_n = $this->db->get_where('document', array('document_id' => $document_id))->row()->file_name;
        unlink("uploads/document/" . $file_n);
        $this->db->where('document_id', $document_id);
        $this->db->delete('document');
    }

    function send_new_private_message()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $message    = $this->input->post('message');
        $timestamp  = date("d M. H:iA");
        $reciever   = $this->input->post('reciever');
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->num_rows();
        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code                        = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender']              = $sender;
            $data_message_thread['reciever']            = $reciever;
            $data_message_thread['last_message_timestamp']            = date('Y-m-d H:i:s');
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0) {
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'reciever' => $reciever))->row()->message_thread_code;
        }
        if ($num2 > 0) {
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $reciever, 'reciever' => $sender))->row()->message_thread_code;
        }
        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['reciever']               = $reciever;
        $data_message['timestamp']              = $timestamp;
        $data_message['file_type']              = strtolower(pathinfo($_FILES["file_name"]["name"], PATHINFO_EXTENSION));
        $data_message['file_name']              = $_FILES["file_name"]["name"];
        $this->db->insert('message', $data_message);

        $name = $this->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));
        $notify['notify'] = "<strong>" . $name . "</strong>" . " " . get_phrase('new_message_notify');
        $rec = explode("-", $this->input->post('reciever'));
        $notify['user_id'] = $rec[1];
        $notify['user_type'] = $rec[0];
        $notify['url'] = $rec[0] . "/message/message_read/" . $message_thread_code . "/";
        $notify['date'] = date('d M, Y');
        $notify['time'] = date('h:i A');
        $notify['status'] = 0;
        $notify['year'] = $year;
        $notify['type'] = 'message';
        $notify['original_id'] = $this->session->userdata('login_user_id');
        $notify['original_type'] = $this->session->userdata('login_type');
        send_notification($notify, true);
    }

    function send_exam_notify()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $name = $this->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));
        $notify['notify'] = "<strong>" . $name . "</strong>" . " " . get_phrase('online_exam_notify') . " <b>" . $this->input->post('exam_title') . "</b>";
        $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $year))->result_array();
        foreach ($students as $row) {
            $notify['user_id'] = $row['student_id'];
            $notify['user_type'] = 'student';
            $notify['url'] = "student/online_exams/" . base64_encode($this->input->post('class_id') . '-' . $this->input->post('section_id') . '-' . $this->input->post('subject_id'));
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'exam';
            $notify['year'] = $year;
            $notify['class_id'] = $this->input->post('class_id');
            $notify['section_id'] = $this->input->post('section_id');
            $notify['subject_id'] = $this->input->post('subject_id');
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('student', strip_tags($notify['notify']));
    }

    function send_forum_notify()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $name = $this->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));
        $notify['notify'] = "<strong>" . $name . "</strong>" . get_phrase('added_new_forum_discussion');
        $students = $this->db->get_where('enroll', array('class_id' => $this->input->post('class_id'), 'section_id' => $this->input->post('section_id'), 'year' => $year))->result_array();
        foreach ($students as $row) {
            $notify['user_id'] = $row['student_id'];
            $notify['user_type'] = 'student';
            $notify['url'] = "student/forum/" . base64_encode($this->input->post('class_id') . '-' . $this->input->post('section_id') . '-' . $this->input->post('subject_id'));
            $notify['date'] = date('d M, Y');
            $notify['time'] = date('h:i A');
            $notify['status'] = 0;
            $notify['type'] = 'forum';
            $notify['year'] = $year;
            $notify['class_id'] = $this->input->post('class_id');
            $notify['section_id'] = $this->input->post('section_id');
            $notify['subject_id'] = $this->input->post('subject_id');
            $notify['original_id'] = $this->session->userdata('login_user_id');
            $notify['original_type'] = $this->session->userdata('login_type');
            send_notification($notify, false);
        }
        send_firebase_notification('student', strip_tags($notify['notify']));
    }

    function send_reply_message($message_thread_code)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $message    = $this->input->post('message');
        $timestamp  = date("d M. H:iA");
        $sender     = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $name = $this->get_name($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));
        $data_message['file_name']              = $_FILES["file_name"]["name"];
        $data_message['message_thread_code']    = $message_thread_code;
        $data_message['message']                = $message;
        $data_message['sender']                 = $sender;
        $data_message['timestamp']              = $timestamp;
        $data_message['reciever'] = $this->input->post('reciever');
        $data_message['file_type']              = strtolower(pathinfo($_FILES["file_name"]["name"], PATHINFO_EXTENSION));
        $this->db->insert('message', $data_message);
        $notify['notify'] = "<strong>" . $name . "</strong>" . " " . get_phrase('new_message_notify');
        $rec = explode("-", $this->input->post('reciever'));
        if ($rec[0] == "parent") {
            $reci = "parents";
        } else {
            $reci = $rec[0];
        }
        $notify['user_id'] = $rec[1];
        $notify['user_type'] = $rec[0];
        $notify['date'] = date('d M, Y');
        $notify['time'] = date('h:i A');
        $notify['url'] = $reci . "/message/message_read/" . $message_thread_code;
        $notify['status'] = 0;
        $notify['type'] = 'message';
        $notify['year'] = $year;
        $notify['original_id']   = $this->session->userdata('login_user_id');
        $notify['original_type'] = $this->session->userdata('login_type');
        send_notification($notify);
    }

    function mark_thread_messages_read($message_thread_code)
    {
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function create_report()
    {
        $data['title']          = $this->input->post('title');
        $data['report_code']    = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data['priority']       = $this->input->post('priority');
        $data['teacher_id']     = $this->input->post('teacher_id');
        $data['status']     = 0;
        $login_type             = $this->session->userdata('login_type');
        if ($login_type == 'student') $data['student_id']  = $this->session->userdata('login_user_id');
        else $data['student_id']  = $this->input->post('student_id');
        $data['timestamp']      = date("d M, Y");
        $data['description']       = $this->input->post('description');
        if ($_FILES['file']['name'] != '') $data['file']          = $_FILES['file']['name'];
        $this->db->insert('reporte_alumnos', $data);
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/reportes_alumnos/' . $_FILES['file']['name']);
    }

    function delete_report($report_code)
    {
        $this->db->where('report_code', $report_code);
        $this->db->delete('reporte_alumnos');
    }

    function count_unread_message_of_thread($message_thread_code)
    {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }

    function permission_request()
    {
        $data['teacher_id']   = $this->session->userdata('login_user_id');
        $data['description']  = $this->input->post('description');
        $data['title']        = $this->input->post('title');
        $data['start_date']   = $this->input->post('start_date');
        $data['end_date']     = $this->input->post('end_date');
        $data['file']         = $_FILES["file_name"]["name"];
        $this->db->insert('request', $data);
    }

    function alatdanbahan()
    {
        $ttl = intval(str_replace(".", "", $this->input->post('totaldana')));
        $data['teacher_id']   = $this->session->userdata('login_user_id');
        $data['description']  = $this->input->post('description');
        $data['rencana']        = $this->input->post('rencana');
        $data['jenis']   = $this->input->post('jenis');
        $data['bahanalat']     = $this->input->post('bahanalat');
        $data['totaldana']     = $ttl;
        $data['file']         = $_FILES["file_name"]["name"];
        $this->db->insert('bahandanalat', $data);
    }

    function create_backup()
    {
        $this->load->dbutil();
        $options = array(
            'format' => 'txt',
            'add_drop' => TRUE,
            'add_insert' => TRUE,
            'newline' => "\n"
        );
        $tables = array('');
        $file_name = 'system_backup';
        $backup = &$this->dbutil->backup(array_merge($options, $tables));
        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    function getInfo($type)
    {
        $query = $this->db->get_where('settings', array('type' => $type));
        return $query->row()->description;
    }
    function getDonasi()
    {
        $query = $this->db->get('donasi');
        return $query->result_array();
    }

    // LK LPA Level 1
    function lk_lpa1($week = '')
    { 
        $date = date('Y-m-d');
        if ($week) {
            $date = date('Y-m-d', strtotime($week . ' week'));
        }
        list($start_date, $end_date) = x_week_range($date);
        $result = $this->db->query("SELECT count(DISTINCT date) as date_count, `build_id`, `build`.`student_id`, `build`.`user_id`, `build`.`class_id`, `build`.`section_id`, AVG(NULLIF(adb_1a, 0)) AS adb_1a, AVG(NULLIF(adb_1b, 0)) AS adb_1b, AVG(NULLIF(adb_1c, 0)) AS adb_1c, AVG(NULLIF(adb_1d, 0)) AS adb_1d, AVG(NULLIF(adb_2a, 0)) AS adb_2a, AVG(NULLIF(adb_2b, 0)) AS adb_2b, AVG(NULLIF(adb_2c, 0)) AS adb_2c, AVG(NULLIF(adb_2d, 0)) AS adb_2d, AVG(NULLIF(adb_2e, 0)) AS adb_2e, AVG(NULLIF(adb_3a, 0)) AS adb_3a, AVG(NULLIF(adb_3b, 0)) AS adb_3b, AVG(NULLIF(adb_4a, 0)) AS adb_4a, AVG(NULLIF(adb_4b, 0)) AS adb_4b, AVG(NULLIF(adb_5a, 0)) AS adb_5a, AVG(NULLIF(adb_5b, 0)) AS adb_5b, AVG(NULLIF(adb_6a, 0)) AS adb_6a, AVG(NULLIF(adb_6b, 0)) AS adb_6b, AVG(NULLIF(adb_6c, 0)) AS adb_6c, AVG(NULLIF(adb_6d, 0)) AS adb_6d, AVG(NULLIF(adb_7a, 0)) AS adb_7a, AVG(NULLIF(adb_7b, 0)) AS adb_7b, AVG(NULLIF(adb_7c, 0)) AS adb_7c, AVG(NULLIF(adb_7d, 0)) AS adb_7d, AVG(NULLIF(adb_7e, 0)) AS adb_7e, AVG(NULLIF(adb_8a, 0)) AS adb_8a, AVG(NULLIF(adb_8b, 0)) AS adb_8b, AVG(NULLIF(adb_9a, 0)) AS adb_9a, AVG(NULLIF(adb_9b, 0)) AS adb_9b, lk_sholat_shubuh, lk_sholat_dzuhur, lk_shalat_ashar, lk_shalat_magrib, lk_shalat_isya, lk_membaca_asmaul_husna, lk_mengenal_kosakata_arab, lk_hafal_doa, lk_mengikuti_kajian, lk_membaca_quran FROM `build`
        LEFT JOIN( SELECT student_id, SUM(sholat_shubuh) AS lk_sholat_shubuh, SUM(sholat_dzuhur) AS lk_sholat_dzuhur, SUM(shalat_ashar) AS lk_shalat_ashar, SUM(shalat_magrib) AS lk_shalat_magrib, SUM(shalat_isya) AS lk_shalat_isya, SUM(membaca_asmaul_husna) AS lk_membaca_asmaul_husna, SUM(mengenal_kosakata_arab) AS lk_mengenal_kosakata_arab, SUM(hafal_doa) AS lk_hafal_doa, SUM(mengikuti_kajian) AS lk_mengikuti_kajian, SUM(membaca_quran) AS lk_membaca_quran FROM 
        (SELECT student_id, AVG(NULLIF(sholat_shubuh, 0)) AS sholat_shubuh, AVG(NULLIF(sholat_dzuhur, 0)) AS sholat_dzuhur, AVG(NULLIF(shalat_ashar, 0)) AS shalat_ashar, AVG(NULLIF(shalat_magrib, 0)) AS shalat_magrib, AVG(NULLIF(shalat_isya, 0)) AS shalat_isya, AVG(NULLIF(membaca_asmaul_husna, 0)) AS membaca_asmaul_husna, AVG(NULLIF(mengenal_kosakata_arab, 0)) AS mengenal_kosakata_arab, AVG(NULLIF(hafal_doa, 0)) AS hafal_doa, AVG(NULLIF(mengikuti_kajian, 0)) AS mengikuti_kajian, AVG(NULLIF(membaca_quran, 0)) AS membaca_quran FROM `keagamaan` WHERE `date` >= '$start_date' AND `date` <= '$end_date' GROUP BY `student_id`, `date`) as k group by student_id) AS lk
        ON lk.student_id = build.student_id WHERE `build`.`date` >= '$start_date' AND `build`.`date` <= '$end_date' GROUP BY `build`.`student_id`")->result_array();
        return $result;
    }

    // LK LPA level 2
    function lk_lpa2($week = '')
    {
        $date = date('Y-m-d');
        if ($week) {
            $date = date('Y-m-d', strtotime($week . ' week'));
        }
        list($start_date, $end_date) = x_week_range($date);
         $result = $this->db->query("SELECT count(DISTINCT date) as date_count, `build_id`, `build2`.`student_id`, `build2`.`user_id`, `build2`.`class_id`, `build2`.`section_id`, AVG(NULLIF(lpa_2_1, 0)) AS lpa_2_1, AVG(NULLIF(lpa_2_24, 0)) AS lpa_2_24, AVG(NULLIF(lpa_2_2, 0)) AS lpa_2_2, AVG(NULLIF(lpa_2_4, 0)) AS lpa_2_4, AVG(NULLIF(lpa_2_5, 0)) AS lpa_2_5, AVG(NULLIF(lpa_2_6, 0)) AS lpa_2_6, AVG(NULLIF(lpa_2_7, 0)) AS lpa_2_7, AVG(NULLIF(lpa_2_8, 0)) AS lpa_2_8, AVG(NULLIF(lpa_2_9, 0)) AS lpa_2_9, AVG(NULLIF(lpa_2_10, 0)) AS lpa_2_10, AVG(NULLIF(lpa_2_11, 0)) AS lpa_2_11, AVG(NULLIF(lpa_2_12, 0)) AS lpa_2_12, AVG(NULLIF(lpa_2_13, 0)) AS lpa_2_13, AVG(NULLIF(lpa_2_14, 0)) AS lpa_2_14, AVG(NULLIF(lpa_2_15, 0)) AS lpa_2_15, AVG(NULLIF(lpa_2_16, 0)) AS lpa_2_16, AVG(NULLIF(lpa_2_17, 0)) AS lpa_2_17, AVG(NULLIF(lpa_2_18, 0)) AS lpa_2_18, AVG(NULLIF(lpa_2_19, 0)) AS lpa_2_19, AVG(NULLIF(lpa_2_20, 0)) AS lpa_2_20, AVG(NULLIF(lpa_2_21, 0)) AS lpa_2_21, AVG(NULLIF(lpa_2_22, 0)) AS lpa_2_22, AVG(NULLIF(lpa_2_23, 0)) AS lpa_2_23, lk_sholat_wajib, lk_sholat_rawatib, lk_sholat_dhuha, lk_sholat_tahajud, lk_setor_dalil, lk_menutup_aurat, lk_ilmu_fiqih, lk_membaca_alquran, lk_bahasa_arab, lk_shaum,lk_asmaulhusna FROM `build2` LEFT JOIN( SELECT student_id, SUM(sholat_wajib) AS lk_sholat_wajib, SUM(sholat_rawatib) AS lk_sholat_rawatib, SUM(sholat_dhuha) AS lk_sholat_dhuha, SUM(sholat_tahajud) AS lk_sholat_tahajud, SUM(setor_dalil) AS lk_setor_dalil, SUM(menutup_aurat) AS lk_menutup_aurat, SUM(ilmu_fiqih) AS lk_ilmu_fiqih, SUM(membaca_alquran) AS lk_membaca_alquran, SUM(bahasa_arab) AS lk_bahasa_arab, SUM(shaum) AS lk_shaum, SUM(asmaulhusna) AS lk_asmaulhusna FROM (SELECT student_id, AVG(NULLIF(sholat_wajib, 0)) AS sholat_wajib, AVG(NULLIF(sholat_rawatib, 0)) AS sholat_rawatib, AVG(NULLIF(sholat_dhuha, 0)) AS sholat_dhuha, AVG(NULLIF(sholat_tahajud, 0)) AS sholat_tahajud, AVG(NULLIF(setor_dalil, 0)) AS setor_dalil, AVG(NULLIF(menutup_aurat, 0)) AS menutup_aurat, AVG(NULLIF(ilmu_fiqih, 0)) AS ilmu_fiqih, AVG(NULLIF(membaca_alquran, 0)) AS membaca_alquran, AVG(NULLIF(bahasa_arab, 0)) AS bahasa_arab, AVG(NULLIF(shaum, 0)) AS shaum, AVG(NULLIF(asmaulhusna,0)) AS asmaulhusna FROM `keagamaan2` WHERE `date` >= '$start_date' AND `date` <= '$end_date' GROUP BY `student_id`, `date`) as k group by student_id) AS lk ON lk.student_id = build2.student_id WHERE `build2`.`date` >= '$start_date' AND `build2`.`date` <= '$end_date' GROUP BY `build2`.`student_id`")->result_array();
         return $result;
    }

    // Penilai LK level 1
    function sql_lk1($week = '')
    {
        $date = date('Y-m-d');
        if ($week) {
            $date = date('Y-m-d', strtotime($week . ' week'));
        }
        list($start_date, $end_date) = x_week_range($date);
        
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $sqlLPA = $this->db->get('build')->result_array();
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->get('keagamaan')->result_array();
    }
    // Penilai LK level 2
    function sql_lk2($week = '')
    {
        $date = date('Y-m-d');
        if ($week) {
            $date = date('Y-m-d', strtotime($week . ' week'));
        }
        list($start_date, $end_date) = x_week_range($date);
        
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $sqlLPA2 = $this->db->get('build2')->result_array();
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->get('keagamaan2')->result_array();
    }

    function sql_lpa1($week = '')
    {
        $date = date('Y-m-d');
        if ($week) {
            $date = date('Y-m-d', strtotime($week . ' week'));
        }
        list($start_date, $end_date) = x_week_range($date);
        
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->get('build2')->result_array();
    }
    function sql_lpa2($week = '')
    {
        $date = date('Y-m-d');
        if ($week) {
            $date = date('Y-m-d', strtotime($week . ' week'));
        }
        list($start_date, $end_date) = x_week_range($date);
        
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return$this->db->get('build2')->result_array();
    }

    function update_read_news($param1)
    {
        $this->db->limit('1');
        $this->db->where('news_id >', $param1);
        $this->db->select('news_id');
        $news = $this->db->get('news')->result_array();
        $nilaiTerbesar = max($news);
        $newsId = $nilaiTerbesar['news_id'];
        $userId    = $this->session->userdata('login_user_id');
        $loginType = $this->session->userdata('login_type');
        $data['news_code'] = $newsId;
        $data['date'] = date('Y-m-d H:i:s');
        $this->db->where('user_id', $userId);
        $this->db->where('user_type', $loginType);
        $this->db->update('readed', $data);
    }

    function insert_news_readed($user_id, $type)
    {
        $this->db->order_by('news_id', 'DESC');
        $this->db->limit('3');
        $this->db->select('news_id');
        $news = $this->db->get('news')->result_array();
        $nilaiTerbesar = max($news);
        $newsId = $nilaiTerbesar['news_id'];
        $data['news_code'] = $newsId;
        $data['date'] = date('Y-m-d H:i:s');
        $data['user_id'] =  $user_id;
        $data['user_type'] =  $type;
        $this->db->insert('readed', $data);
    }
    function looking_build($student_id, $week)
    {
        
        $this->db->select('build_id,student_id,user_id,class_id,section_id,date,avg(nullif(adb_1a,0)) as adb_1a,avg(nullif(adb_1b,0)) as adb_1b,avg(nullif(adb_1c,0)) as adb_1c,avg(nullif(adb_1d,0)) as adb_1d,avg(nullif(adb_2a,0)) as adb_2a,avg(nullif(adb_2b,0)) as adb_2b,avg(nullif(adb_2c,0)) as adb_2c,avg(nullif(adb_2d,0)) as adb_2d,avg(nullif(adb_2e,0)) as adb_2e,avg(nullif(adb_3a,0)) as adb_3a,avg(nullif(adb_3b,0)) as adb_3b,avg(nullif(adb_4a,0)) as adb_4a,avg(nullif(adb_4b,0)) as adb_4b,avg(nullif(adb_5a,0)) as adb_5a,avg(nullif(adb_5b,0)) as adb_5b,avg(nullif(adb_6a,0)) as adb_6a,avg(nullif(adb_6b,0)) as adb_6b,avg(nullif(adb_6c,0)) as adb_6c,avg(nullif(adb_6d,0)) as adb_6d,avg(nullif(adb_7a,0)) as adb_7a,avg(nullif(adb_7b,0)) as adb_7b,avg(nullif(adb_7c,0)) as adb_7c,avg(nullif(adb_7d,0)) as adb_7d,avg(nullif(adb_7e,0)) as adb_7e,avg(nullif(adb_8a,0)) as adb_8a,avg(nullif(adb_8b,0)) as adb_8b,avg(nullif(adb_9a,0)) as adb_9a,avg(nullif(adb_9b,0)) as adb_9b')->where(['student_id' => $student_id])->group_by('date');
        $date = date('Y-m-d');
        if ($week) {
            $date = date('Y-m-d', strtotime($week . ' week'));
        }
        list($start_date, $end_date) = x_week_range($date);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->get('build')->result_array();
    }
    
    function looking_build2($student_id, $week)
    {
        $this->db->select('build_id,student_id,user_id,class_id,section_id,date,avg(nullif(lpa_2_1,0)) as lpa_2_1,avg(nullif(lpa_2_24,0)) as lpa_2_24,avg(nullif(lpa_2_2,0)) as lpa_2_2, avg(nullif(lpa_2_3,0)) as lpa_2_3, avg(nullif(lpa_2_4,0)) as lpa_2_4, avg(nullif(lpa_2_5,0)) as lpa_2_5, avg(nullif(lpa_2_6,0)) as lpa_2_6, avg(nullif(lpa_2_7,0)) as lpa_2_7, avg(nullif(lpa_2_8,0)) as lpa_2_8, avg(nullif(lpa_2_9,0)) as lpa_2_9, avg(nullif(lpa_2_10,0)) as lpa_2_10, avg(nullif(lpa_2_11,0)) as lpa_2_11, avg(nullif(lpa_2_12,0)) as lpa_2_12, avg(nullif(lpa_2_13,0)) as lpa_2_13, avg(nullif(lpa_2_14,0)) as lpa_2_14, avg(nullif(lpa_2_15,0)) as lpa_2_15, avg(nullif(lpa_2_16,0)) as lpa_2_16, avg(nullif(lpa_2_17,0)) as lpa_2_17, avg(nullif(lpa_2_18,0)) as lpa_2_18, avg(nullif(lpa_2_19,0)) as lpa_2_19, avg(nullif(lpa_2_20,0)) as lpa_2_20, avg(nullif(lpa_2_21,0)) as lpa_2_21, avg(nullif(lpa_2_22,0)) as lpa_2_22, avg(nullif(lpa_2_23,0)) as lpa_2_23')->where(['student_id' => $student_id])->group_by('date');
        $date = date('Y-m-d');
        if ($week) {
            $date = date('Y-m-d', strtotime($week . ' week'));
        }
        list($start_date, $end_date) = x_week_range($date);
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        return $this->db->get('build2')->result_array();
    }

    function looking_lk($student_id, $week)
    {
        $this->db->select('id,student_id,user_id,class_id,section_id,date,avg(nullif(sholat_shubuh,0)) as sholat_shubuh,avg(nullif(sholat_dzuhur,0)) as sholat_dzuhur,avg(nullif(shalat_ashar,0)) as shalat_ashar,avg(nullif(shalat_magrib,0)) as shalat_magrib,avg(nullif(shalat_isya,0)) as shalat_isya,avg(nullif(membaca_asmaul_husna,0)) as membaca_asmaul_husna,avg(nullif(mengenal_kosakata_arab,0)) as mengenal_kosakata_arab,avg(nullif(hafal_doa,0)) as hafal_doa,avg(nullif(mengikuti_kajian,0)) as mengikuti_kajian,avg(nullif(membaca_quran,0)) as membaca_quran')->where(['student_id' => $student_id])->group_by('date');
        $date = date('Y-m-d');
        if ($week) {
            $date = date('Y-m-d', strtotime($week . ' week'));
        }
        list($start_date, $end_date) = x_week_range($date); 
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
       return $this->db->get('keagamaan')->result_array();
    }
    
    function looking_lk2($student_id, $week)
    {
        $this->db->select('id,student_id,user_id,class_id,section_id,date,avg(nullif(sholat_wajib,0)) as sholat_wajib,avg(nullif(sholat_rawatib,0)) as sholat_rawatib,avg(nullif(sholat_dhuha,0)) as sholat_dhuha,avg(nullif(sholat_tahajud,0)) as sholat_tahajud,avg(nullif(setor_dalil,0)) as setor_dalil,avg(nullif(menutup_aurat,0)) as menutup_aurat,avg(nullif(ilmu_fiqih,0)) as ilmu_fiqih,avg(nullif(membaca_alquran,0)) as membaca_alquran,avg(nullif(bahasa_arab,0)) as bahasa_arab,avg(nullif(shaum,0)) as shaum,avg(nullif(asmaulhusna,0)) as asmaulhusna')->where(['student_id' => $student_id])->group_by('date');
        $date = date('Y-m-d');
        if ($week) {
            $date = date('Y-m-d', strtotime($week . ' week'));
        }
        list($start_date, $end_date) = x_week_range($date); 
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
       return $this->db->get('keagamaan2')->result_array();
    }

    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
     
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    function create_nilai($data)
    {
        // LPA
        $data_lpa = $data;
        $data_lpa['adb_1a']      = (int) $this->input->post('adb_1a');
        $data_lpa['adb_1b']      = (int) $this->input->post('adb_1b');
        $data_lpa['adb_1c']      = (int) $this->input->post('adb_1c');
        $data_lpa['adb_1d']      = (int) $this->input->post('adb_1d');
        $data_lpa['adb_2a']      = (int) $this->input->post('adb_2a');
        $data_lpa['adb_2b']      = (int) $this->input->post('adb_2b');
        $data_lpa['adb_2c']      = (int) $this->input->post('adb_2c');
        $data_lpa['adb_2d']      = (int) $this->input->post('adb_2d');
        $data_lpa['adb_2e']      = (int) $this->input->post('adb_2e');
        $data_lpa['adb_3a']      = (int) $this->input->post('adb_3a');
        $data_lpa['adb_3b']      = (int) $this->input->post('adb_3b');
        $data_lpa['adb_4a']      = (int) $this->input->post('adb_4a');
        $data_lpa['adb_3b']      = (int) $this->input->post('adb_3b');
        $data_lpa['adb_4a']      = (int) $this->input->post('adb_4a');
        $data_lpa['adb_4b']      = (int) $this->input->post('adb_4b');
        $data_lpa['adb_5a']      = (int) $this->input->post('adb_5a');
        $data_lpa['adb_5b']      = (int) $this->input->post('adb_5b');
        $data_lpa['adb_6a']      = (int) $this->input->post('adb_6a');
        $data_lpa['adb_6b']      = (int) $this->input->post('adb_6b');
        $data_lpa['adb_6c']      = (int) $this->input->post('adb_6c');
        $data_lpa['adb_6d']      = (int) $this->input->post('adb_6d');
        $data_lpa['adb_7a']      = (int) $this->input->post('adb_7a');
        $data_lpa['adb_7b']      = (int) $this->input->post('adb_7b');
        $data_lpa['adb_7c']      = (int) $this->input->post('adb_7c');
        $data_lpa['adb_7d']      = (int) $this->input->post('adb_7d');
        $data_lpa['adb_7e']      = (int) $this->input->post('adb_7e');
        $data_lpa['adb_8a']      = (int) $this->input->post('adb_8a');
        $data_lpa['adb_8b']      = (int) $this->input->post('adb_8b');
        $data_lpa['adb_9a']      = (int) $this->input->post('adb_9a');
        $data_lpa['adb_9b']      = (int) $this->input->post('adb_9b');
        // LK
        $data_lk = $data;
        $data_lk['sholat_shubuh'] = (int) $this->input->post('sholat_shubuh');
        $data_lk['sholat_dzuhur'] = (int) $this->input->post('sholat_dzuhur');
        $data_lk['shalat_ashar'] = (int) $this->input->post('shalat_ashar');
        $data_lk['shalat_magrib'] = (int) $this->input->post('shalat_magrib');
        $data_lk['shalat_isya'] = (int) $this->input->post('shalat_isya');
        $data_lk['membaca_asmaul_husna'] = (int) $this->input->post('membaca_asmaul_husna');
        $data_lk['mengenal_kosakata_arab'] = (int) $this->input->post('mengenal_kosakata_arab');
        $data_lk['hafal_doa'] = (int) $this->input->post('hafal_doa');
        $data_lk['mengikuti_kajian'] = (int) $this->input->post('mengikuti_kajian');
        $data_lk['membaca_quran'] = (int) $this->input->post('membaca_quran');
        // Insert
        $where = ['date' => $data['date'], 'user_id' => $data['user_id'], 'student_id' => $data['student_id']];
        $build = $this->db->where($where)->get('build')->num_rows();
        $lk = $this->db->where($where)->get('keagamaan')->num_rows();
        if ($build) {
            $this->db->where($where)->update('build', $data_lpa);
        } else {
            $this->db->insert('build', $data_lpa);
        }
        if ($lk) {
            $this->db->where($where)->update('keagamaan', $data_lk);
        } else {
            $this->db->insert('keagamaan', $data_lk);
        }
    }
    function create_nilai2($data)
    {
        // LPA
        $data_lpa = $data;
        $data_lpa['lpa_2_1']      = (int) $this->input->post('lpa_2-1');
        $data_lpa['lpa_2_2']      = (int) $this->input->post('lpa_2-2');
        $data_lpa['lpa_2_3']      = (int) $this->input->post('lpa_2-3');
        $data_lpa['lpa_2_4']      = (int) $this->input->post('lpa_2-4');
        $data_lpa['lpa_2_5']      = (int) $this->input->post('lpa_2-5');
        $data_lpa['lpa_2_6']      = (int) $this->input->post('lpa_2-6');
        $data_lpa['lpa_2_7']      = (int) $this->input->post('lpa_2-7');
        $data_lpa['lpa_2_8']      = (int) $this->input->post('lpa_2-8');
        $data_lpa['lpa_2_9']      = (int) $this->input->post('lpa_2-9');
        $data_lpa['lpa_2_10']      = (int) $this->input->post('lpa_2-10');
        $data_lpa['lpa_2_11']      = (int) $this->input->post('lpa_2-11');
        $data_lpa['lpa_2_12']      = (int) $this->input->post('lpa_2-12');
        $data_lpa['lpa_2_13']      = (int) $this->input->post('lpa_2-13');
        $data_lpa['lpa_2_14']      = (int) $this->input->post('lpa_2-14');
        $data_lpa['lpa_2_15']      = (int) $this->input->post('lpa_2-15');
        $data_lpa['lpa_2_16']      = (int) $this->input->post('lpa_2-16');
        $data_lpa['lpa_2_17']      = (int) $this->input->post('lpa_2-17');
        $data_lpa['lpa_2_18']      = (int) $this->input->post('lpa_2-18');
        $data_lpa['lpa_2_19']      = (int) $this->input->post('lpa_2-19');
        $data_lpa['lpa_2_20']      = (int) $this->input->post('lpa_2-20');
        $data_lpa['lpa_2_21']      = (int) $this->input->post('lpa_2-21');
        $data_lpa['lpa_2_22']      = (int) $this->input->post('lpa_2-22');
        $data_lpa['lpa_2_23']      = (int) $this->input->post('lpa_2-23');
        $data_lpa['lpa_2_24']      = (int) $this->input->post('lpa_2-24');
        // LK
        $data_lk = $data;
        $data_lk['sholat_wajib'] = (int) $this->input->post('sholat_wajib');
        $data_lk['sholat_rawatib'] = (int) $this->input->post('sholat_rawatib');
        $data_lk['sholat_dhuha'] = (int) $this->input->post('sholat_dhuha');
        $data_lk['sholat_tahajud'] = (int) $this->input->post('sholat_tahajud');
        $data_lk['setor_dalil'] = (int) $this->input->post('setor_dalil');
        $data_lk['menutup_aurat'] = (int) $this->input->post('menutup_aurat');
        $data_lk['ilmu_fiqih'] = (int) $this->input->post('ilmu_fiqih');
        $data_lk['membaca_alquran'] = (int) $this->input->post('membaca_alquran');
        $data_lk['bahasa_arab'] = (int) $this->input->post('bahasa_arab');
        $data_lk['shaum'] = (int) $this->input->post('shaum');
        $data_lk['asmaulhusna'] = (int) $this->input->post('asmaulhusna');
        // Insert
        $where = ['date' => $data['date'], 'user_id' => $data['user_id'], 'student_id' => $data['student_id']];
        $build = $this->db->where($where)->get('build2')->num_rows();
        $lk = $this->db->where($where)->get('keagamaan2')->num_rows();
        if ($build) {
            $this->db->where($where)->update('build2', $data_lpa);
        } else {
            $this->db->insert('build2', $data_lpa);
        }
        if ($lk) {
            $this->db->where($where)->update('keagamaan2', $data_lk);
        } else {
            $this->db->insert('keagamaan2', $data_lk);
        }
    }
}
