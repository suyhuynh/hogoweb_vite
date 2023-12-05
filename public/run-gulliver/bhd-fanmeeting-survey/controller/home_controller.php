<?php
	session_start();
	require_once(MODEL_DIR.'/survey.php');
	require_once(MODEL_DIR.'/customer.php');
	require_once(MODEL_DIR.'/config.php');

	$videoCode = Config::getVideo();
    $meta = array(
		'title' => 'Khảo sát Phiêu lưu cùng Gulliver - Iphone, Về Tay Ai?',
		'description' => 'Tham gia khảo sát Phiêu lưu cùng Gulliver mùa 4 để có cơ hội trúng thưởng Iphone 15 nhé',
		'image' => url('assets/banner.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url()
	);

	$todaySurvey = strtotime(date('d-m-Y'));
	$endSurvey = strtotime('03-12-2023');
	Customer::logout();
	require_once(VIEW_DIR . '/home_view.php');
?>