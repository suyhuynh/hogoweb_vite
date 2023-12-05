<?php
	session_start();
	require_once(MODEL_DIR.'/survey.php');
	require_once(MODEL_DIR.'/customer.php');

	function checkCustomerRedirect($customer) {
		return ($customer['status'] == 'yet_surveyed') ? redirect('khao-sat.html') : redirect('cam-on.html');
	}

	$customer = Customer::auth();
	if (!empty($customer)) {
		return checkCustomerRedirect($customer);
	}

	// for ($i=10235; $i < 10555; $i++) { 
	// 	$data = array(
	// 		'fullname' => 'kilala' . $i,
	// 		'email' => 'kilala' . $i .'@kilala.vn',
	// 		'phone' => '0932323 '.$i
	// 	);

	// 	Customer::findOrCreateByEmailOrPhone(array(
	// 		'email' => $data['email'],
	// 		'phone' => $data['phone'],
	// 	), $data);
	// }
	// die;

	if (isset($_POST['submit'])) {
		$msg = array();
		if (empty($_POST['email'])) {
			$msg['email'] = 'Vui lòng nhập email';
		}
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$msg['email'] = 'Email không đúng định dạng';
		}

		if (empty($_POST['phone'])) {
			$msg['phone'] = 'Vui lòng nhập số điện thoại';
		}
	
		// if (empty(preg_match('/^(0|)[0-9]{9}$/', $_POST['phone']))) {
		// 	$msg['phone'] = 'Số điện thoại không đúng định dạng';
		// }

		if (empty($_POST['fullname'])) {
			$msg['fullname'] = 'Vui lòng nhập họ tên';
		}

		// if (empty($_POST['extend']['old'])) {
		// 	$msg['phone'] = 'Vui lòng chọn độ tuổi';
		// }

		// if (empty($_POST['extend']['old'])) {
		// 	$msg['phone'] = 'Vui lòng chọn độ tuổi';
		// }

		// if (empty($_POST['extend']['sex'])) {
		// 	$msg['phone'] = 'Vui lòng chọn giới tính';
		// }

		if (empty($_POST['extend']['job'])) {
			$msg['phone'] = 'Vui lòng chọn nghề nghiệp';
		}

		if (empty($_POST['extend']['program'])) {
			$msg['phone'] = 'Vui lòng chọn bắt gặp quảng cáo của chương trình này ở đâu';
		}
		$input = array(
			'fullname' => trim($_POST['fullname']),
			'email' => trim($_POST['email']),
			'phone' => trim($_POST['phone']),
			'extend' => json_encode($_POST['extend']),
		);

		// $checkCustomer = Customer::getCustomerByEmailOrPhone($input['phone'] , $input['email']);
		// if (!empty($checkCustomer) && $checkCustomer['status'] != 'yet_surveyed') {
		// 	$msg['phone'] = 'Số điện thoại hoặc email đã được đăng ký';
		// }
	
		if (empty($msg) && !count($msg)) {
			if (empty($_SESSION['customer'])) {
				$_SESSION['customer'] = null;
			}

			$_SESSION['customer'] = Customer::findOrCreateByEmailOrPhone(array(
				'email' => $input['email'],
				'phone' => $input['phone'],
			), $input);
			
			return checkCustomerRedirect($_SESSION['customer']);
		}
	}

    $meta = array(
		'title' => 'Đăng ký tham gia khảo sát fan meeting “Fan meeting Phiêu lưu cùng Gulliver - Mùa 4 Reloaded”',
		'description' => 'Thông tin tham gia chương trình khảo sát fan meeting “Fan meeting Phiêu lưu cùng Gulliver - Mùa 4 Reloaded”',
		'image' => url('assets/banner.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url('dang-ky.html')
	);

	require_once(VIEW_DIR . '/register_view.php');
?>