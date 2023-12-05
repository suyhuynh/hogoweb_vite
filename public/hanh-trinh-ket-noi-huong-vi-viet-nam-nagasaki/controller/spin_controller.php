<?php
	session_start();
	require_once(MODEL_DIR.'/survey.php');
	require_once(MODEL_DIR.'/customer.php');

	$meta = array(
		'title' => 'Quay số chương trình “hành trình kết nối hương vị Việt Nam - Nagasaki”',
		'description' => 'Quay số chương trình “hành trình kết nối hương vị Việt Nam - Nagasaki”',
		'image' => url('assets/1200x628-hanh-trinh-ket-noi-huong-vi-viet-nam-nagasaki.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url('quay-so.html')
	);

    // $data = 'aaaa';
	require_once(VIEW_DIR . '/spin_view.php');
?>