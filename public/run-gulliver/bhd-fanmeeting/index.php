<?php 

	$uri = trim($_SERVER['REQUEST_URI']);
	$uri = str_replace('/run-gulliver/bhd-fanmeeting', '', strtolower($uri));

    define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']. "/run-gulliver/bhd-fanmeeting");
    require_once(BASE_DIR . '/config/config.php');
    require_once(HELPER_DIR . '/common.php');

	if($uri == '/' || strpos($uri, '/index.') === 0 || strpos($uri, '/?') === 0)
	{
		require_once(CONTROLLER_DIR . '/home_controller.php');
	}
    elseif(preg_match("/^\/send\.asp/", $uri, $matches))
	{
		require_once(CONTROLLER_DIR . '/send_controller.php');
    }
	elseif(preg_match("/^\/cam-on\.html/", $uri, $matches))
	{
		require_once(CONTROLLER_DIR . '/thank_controller.php');
    }
	elseif(preg_match("/^\/error\.html/", $uri, $matches))
	{
		require_once(CONTROLLER_DIR . '/error_controller.php');
    }
	else //404
	{
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
		require_once("404.php");
	}
?>