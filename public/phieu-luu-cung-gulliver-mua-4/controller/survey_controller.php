<?php
	session_start();
	require_once(MODEL_DIR.'/survey.php');
	require_once(MODEL_DIR.'/customer.php');
	require_once(MODEL_DIR.'/customer_gulliver_answer.php');

	// $customer = Customer::auth();
	// if (empty($customer)) {
	// 	return redirect();
	// }
	// // Customer::logout();
	// // if ($customer['status'] != 'yet_surveyed') {
	// // 	return redirect('cam-on.html');
	// // }

	// if (!empty(CustomerGulliverAnswer::getCustomerGulliverAnswerById($customer['id']))) {
	// 	return redirect('cam-on.html');
	// }

	$meta = array(
		'title' => 'Câu hỏi khảo sát chương trình “Phiêu lưu cùng Gulliver - Mùa 4 Reloaded”',
		'description' => 'Câu hỏi khảo sát chương trình “Phiêu lưu cùng Gulliver - Mùa 4 Reloaded”',
		'image' => url('assets/1200x628-gioi-thieu-khao-sat-gulliver.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url('khao-sat.html')
	);

	$questions = Survey::getAllSurveyAnswers();

	require_once(VIEW_DIR . '/survey_view.php');
?>