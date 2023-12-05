<?php
	session_start();
	require_once(MODEL_DIR.'/customer.php');
	require_once(MODEL_DIR.'/customer_gulliver_answer.php');

    $customer = Customer::auth();
	if (empty($customer)) {
		return redirect();
	}

	if (empty(CustomerGulliverAnswer::getCustomerGulliverAnswerById($customer['id']))) {
		return redirect('khao-sat.html');
	}

	$meta = array(
		'title' => 'Cảm ơn bạn đã tham gia khảo sát chương trình “Phiêu lưu cùng Gulliver - Mùa 4 Reloaded”',
		'description' => 'Cảm ơn bạn đã tham gia khảo sát chương trình “Phiêu lưu cùng Gulliver - Mùa 4 Reloaded”',
		'image' => url('assets/1200x628-gioi-thieu-khao-sat-gulliver.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url('cam-on.html')
	);

	Customer::logout();

	require_once(VIEW_DIR . '/thank_view.php');
?>