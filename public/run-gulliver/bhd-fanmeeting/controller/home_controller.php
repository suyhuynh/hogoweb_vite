<?php
	session_start();
	require_once(MODEL_DIR.'/customer.php');
	require_once(MODEL_DIR.'/config.php');

	$config = Config::getConfig();
    $meta = array(
		'title' => 'Fan meeting “Phiêu lưu cùng Gulliver Mùa 4 Reloaded“',
		'description' => 'Hẹn hò cùng Thanh Sơn - Khả Ngân tại fan meeting “Phiêu lưu cùng Gulliver Mùa 4 Reloaded“ để có cơ hội nhận Apple Watch SE nhé.',
		'image' => url('assets/banner.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url()
	);

	$todaySurvey = strtotime(date('d-m-Y'));
	$endSurvey = strtotime('30-11-2023');
	require_once(VIEW_DIR . '/home_view.php');
?>