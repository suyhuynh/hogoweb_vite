<?php
	session_start();
	header("X-Robots-Tag: noindex, nofollow", true);

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		return response(false);
	}

	require_once(MODEL_DIR.'/config.php');
	require_once(MODEL_DIR.'/customer.php');
	require_once(MODEL_DIR.'/history_email.php');


	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$msg = array();
		if($_SERVER['Authorization'] != TOKENT) {
			$msg['error'] = 'Authenticator';
			return response(false, $msg);
		}

		// Email 
		if (empty($_POST['email'])) {
			$msg['error'] = 'Vui lòng nhập email của bạn.';
			return response(false, $msg);
		}

		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$msg['error'] = 'Email không đúng định dạng.';
			return response(false, $msg);
		}

		if ($_POST['email'] != $_POST['email_conform']) {
			$msg['error'] = 'Email không khớp. Vui lòng nhập lại.';
			return response(false, $msg);
		}

		// Phone
		if (empty($_POST['phone'])) {
			$msg['error'] = 'Vui lòng nhập số điện thoại.';
			return response(false, $msg);
		}
	
		if (empty(preg_match('/^(0[0-9]{9,10})$/', $_POST['phone']))) {
			$msg['error'] = 'Số điện thoại không hợp lệ.';
			return response(false, $msg);
		}

		if (empty($_POST['fullname'])) {
			$msg['error'] = 'Vui lòng nhập họ tên của bạn.';
			return response(false, $msg);
		}

		$input = array(
			'fullname' => trim($_POST['fullname']),
			'email' => trim($_POST['email']),
			'phone' => trim($_POST['phone']),
			'extend' => json_encode($_POST['extend']),
		);

		$checkCustomer = Customer::getCustomerByEmailOrPhone($input['phone'] , $input['email']);
		if (!empty($checkCustomer)) {
			$msg['error'] = 'Số điện thoại hoặc email đã được đăng ký.';
			return response(false, $msg);
		}

		$customer = Customer::findOrCreateByEmailOrPhone(array(
			'email' => $input['email'],
			'phone' => $input['phone'],
		), $input);

		$status = !empty($customer['fullname']);

		if (!$status) {
			$msg['error'] = 'Xin lỗi vì sự bất tiện. Hệ thống hiện đang quá tải, vui lòng thử lại sau.';
			return response(false, $msg);
		}

		// Code gui mail
		$customer['extend'] = json_decode($customer['extend'], true);
		$customer['customer_id'] = $customer['id'];
		$customer['recipient_email'] = $customer['email'];
		HistoryEmail::createEmail($customer);

		return response($status, array(
			'customer' => array(
				'fullname' => $customer['fullname'],
				'phone' => $customer['phone'],
				'email' => $customer['email']
			)
		));
	}

	return redirect('404.html');
	
?>