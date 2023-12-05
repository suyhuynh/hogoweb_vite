<?php
	session_start();
	require_once(MODEL_DIR.'/customer.php');
	require_once(MODEL_DIR.'/customer_answer.php');

    $customer = Customer::auth();
	if (empty($customer)) {
		return redirect();
	}
	Customer::logout();
	$meta = array(
		'title' => 'Thông báo lổi',
		'description' => 'Thông báo lổi',
		'image' => url('assets/1200x628-hanh-trinh-ket-noi-huong-vi-viet-nam-nagasaki.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url('error.html')
	);
	require_once(VIEW_DIR . '/error_view.php');
?>