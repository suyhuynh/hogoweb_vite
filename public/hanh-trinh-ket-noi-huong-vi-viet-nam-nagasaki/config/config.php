<?php

define("BASE_URL", "https://".$_SERVER['HTTP_HOST']);
define("CONFIG_DIR", 	BASE_DIR."/config");
define("HELPER_DIR", 	BASE_DIR."/helper");
define("CONTROLLER_DIR",BASE_DIR."/controller");
define("MODEL_DIR", 	BASE_DIR."/model");
define("VIEW_DIR", 	BASE_DIR."/view");
define("VIEW_COMPONENT_DIR", 	BASE_DIR."/view/components");
define("VIEW_LAYOUT_DIR", 	BASE_DIR."/view/layouts");
define("VIEW_HOME_DIR", 	BASE_DIR."/view/home");

define("VIEW_AAA_DIR", 	BASE_DIR."/view/aaa");


// $dbhost = "localhost";
// $dbuser = "root1";
// $dbpassword = "admin09";
// $dbdatabase = "test_kilala_vn_servey_management";
// $config_sitename = "Gulliver";
// $config_format_datetime = "DD/MM/YYYY";

$dbhost = "localhost";
$dbuser = "kilala_v_db";
$dbpassword = "mysql";
$dbdatabase = "kilala_vn_servey_management";
$config_sitename = "Gulliver";
$config_format_datetime = "DD/MM/YYYY";

function dbconnect() 
{ 
	
	global $dbhost, $dbuser, $dbpassword, $dbdatabase;
	static $connect = null; 
	if ($connect === null)
	{ 
		$connect = mysqli_connect($dbhost, $dbuser, $dbpassword); 
		mysqli_select_db($connect, $dbdatabase); 
		mysqli_query($connect, "SET NAMES 'utf8'" );
	}

	return $connect; 
}

date_default_timezone_set("Asia/Ho_Chi_Minh"); 
$date_update = date("Y-m-d H:i:s");
?>