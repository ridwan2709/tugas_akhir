<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('get_phrase'))
{

	function load_language() {
		$CI	=& get_instance();
		$CI->language_loaded = true;
		// Load database
		$CI->load->database();
        $CI->load->library('session');

		// Get language configuration
		$current_language = $CI->db->get_where('settings' , array('type' => 'language'))->row()->description;
		if ( $current_language	==	'') $current_language = 'english';
		$CI->session->set_userdata('current_language' , $current_language);

		// Load Edu lang
		$CI->lang->load('edu', strtolower($current_language));
	}

	function get_phrase($phrase = '') 
	{
		$CI	=&	get_instance();
		if (!isset($CI->language_loaded)) load_language();
		$text = $CI->lang->line($phrase);
		if ($text) {
			return $text;
		} else {
			return ucwords(str_replace('_',' ',$phrase));
		}
	}
}
