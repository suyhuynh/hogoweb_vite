<?php
	session_start();
	require_once(MODEL_DIR.'/survey.php');
	require_once(MODEL_DIR.'/customer.php');

    $meta = array(
		'title' => 'Quay số chương trình “Phiêu lưu cùng Gulliver - Mùa 4 Reloaded”',
		'description' => 'Quay số chương trình “Phiêu lưu cùng Gulliver - Mùa 4 Reloaded”',
		'image' => url('assets/1200x628-gioi-thieu-khao-sat-gulliver.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url('quay-so.html')
	);


	require_once(VIEW_DIR . '/home_view.php');
?>