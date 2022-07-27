<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('send_notification'))
{
	function send_notification($notif, $send_to_phone = true)
	{
		$CI	=&	get_instance();
        $CI->db->insert('notification', $notif);

        $send_to = $notif['user_type'] . '_' . $notif['user_id'];
        $content = strip_tags($notif['notify']);
        if ($CI->config->item('notification_enabled')) {
            if ($send_to_phone) send_firebase_notification($send_to, $content, $notif['url']);
        }
	}
}

if ( ! function_exists('send_firebase_notification'))
{
	function send_firebase_notification($send_to, $content, $url = '')
	{
        $url = base_url($url);
        $CI	=&	get_instance();
        if (!$CI->config->item('notification_enabled')) return;
        $key = $CI->config->item('firebase_token');
        $data = [
            'to' => "/topics/$send_to",
            'notification' =>
            [
                'title' => 'HOMESCHOOLING PERMATA HATI',
                'body' => $content,
                'click_action' => 'Open_URI',
                'sound' => 'default',
            ],
            'data' =>
            [
                'uri' => $url,
            ],
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: key=$key"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
	}
}
