<?php 

	$uri = trim($_SERVER['REQUEST_URI']);
	$uri = str_replace('/phieu-luu-cung-gulliver-mua-4', '', strtolower($uri));
	$vison = '1.0.2';
	function url($alias = '') {
		return 'https://' . $_SERVER['HTTP_HOST'] . '/phieu-luu-cung-gulliver-mua-4/' . $alias;
	}

    define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']. "/phieu-luu-cung-gulliver-mua-4");
    require_once(BASE_DIR . '/config/config.php');
    require_once(HELPER_DIR . '/common.php');

	if($uri == '/' || strpos($uri, '/index.') === 0 || strpos($uri, '/?') === 0)
	{
		require_once(CONTROLLER_DIR . '/home_controller.php');
	}
	elseif(preg_match("/^\/dang-ky\.html/", $uri, $matches))
	{
		require_once(CONTROLLER_DIR . '/register_controller.php');
    }
    elseif(preg_match("/^\/khao-sat\.html/", $uri, $matches))
	{
		require_once(CONTROLLER_DIR . '/survey_controller.php');
    }
    elseif(preg_match("/^\/gui-khao-sat\.asp/", $uri, $matches))
	{
		require_once(CONTROLLER_DIR . '/send_survey_controller.php');
    }
    elseif(preg_match("/^\/cam-on\.html/", $uri, $matches))
	{
		require_once(CONTROLLER_DIR . '/thank_controller.php');
    }
    elseif(preg_match("/^\/quay-so\.html/", $uri, $matches))
	{
		require_once(CONTROLLER_DIR . '/spin_controller.php');
    }
    elseif(preg_match("/^\/process\.asp/", $uri, $matches))
	{
		require_once(CONTROLLER_DIR . '/process_controller.php');
    }
	elseif(preg_match("/^\/lucky\.asp/", $uri, $matches))
	{
		require_once(CONTROLLER_DIR . '/lucky_controller.php');
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