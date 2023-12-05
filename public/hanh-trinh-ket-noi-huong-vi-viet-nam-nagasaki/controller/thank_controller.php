<?php
	session_start();
	require_once(MODEL_DIR.'/customer.php');
	require_once(MODEL_DIR.'/customer_answer.php');
	require_once(MODEL_DIR.'/config.php');

    $customer = Customer::auth();
	if (empty($customer)) {
		return redirect();
	}

	if (empty(CustomerAnswer::getCustomerAnswerById($customer['id']))) {
		return redirect('khao-sat.html');
	}
	
	$linkFacbook = Config::getLinkFacebook();
	$meta = array(
		'title' => 'Cảm ơn bạn đã tham gia khảo sát chương trình “hành trình kết nối hương vị Việt Nam - Nagasaki”',
		'description' => 'Cảm ơn bạn đã tham gia khảo sát chương trình “hành trình kết nối hương vị Việt Nam - Nagasaki”',
		'image' => url('assets/1200x628-hanh-trinh-ket-noi-huong-vi-viet-nam-nagasaki.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url('cam-on.html')
	);

	Customer::logout();

	require_once(VIEW_DIR . '/thank_view.php');
?>