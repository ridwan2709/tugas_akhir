<?php
	require_once "Facebook/autoload.php";
	$FB = new \Facebook\Facebook([
		'app_id' => '221522706858480',
		'app_secret' => '217e147a89a24f2d87d20ab28f60504c',
		'default_graph_version' => 'v2.10'
	]);
	$helper = $FB->getRedirectLoginHelper();
?>
