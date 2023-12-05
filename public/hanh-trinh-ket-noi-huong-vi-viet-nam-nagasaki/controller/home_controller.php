<?php
	session_start();
	require_once(MODEL_DIR.'/survey.php');
	require_once(MODEL_DIR.'/customer.php');
	require_once(MODEL_DIR.'/config.php');

	$videoCode = Config::getVideo();
	$linkYoutube = Config::getLinkYoutube();
	$linkFacbook = Config::getLinkFacebook();
    $meta = array(
		'title' => 'Khảo sát hành trình kết nối hương vị Việt Nam Nagasaki - Iphone, Về Tay Ai?',
		'description' => 'Tham gia khảo sát hành trình kết nối hương vị Việt Nam - Nagasaki để có cơ hội trúng thưởng Iphone 15 nhé',
		'image' => url('assets/1200x628-hanh-trinh-ket-noi-huong-vi-viet-nam-nagasaki.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url()
	);

	$todaySurvey = strtotime(date('d-m-Y'));
	$endSurvey = strtotime('03-12-2023');
	Customer::logout();
	require_once(VIEW_DIR . '/home_view.php');
?>