<?php
	session_start();
	require_once(MODEL_DIR.'/survey.php');
	require_once(MODEL_DIR.'/customer.php');
	require_once(MODEL_DIR.'/customer_answer.php');

	// $customer = Customer::auth();
	// if (empty($customer)) {
	// 	return redirect();
	// }

	// if ($customer['status'] != 'yet_surveyed') {
	// 	return redirect('cam-on.html');
	// }

	$meta = array(
		'title' => 'Câu hỏi khảo sát chương trình “hành trình kết nối hương vị Việt Nam - Nagasaki”',
		'description' => 'Câu hỏi khảo sát chương trình “hành trình kết nối hương vị Việt Nam - Nagasaki”',
		'image' => url('assets/1200x628-hanh-trinh-ket-noi-huong-vi-viet-nam-nagasaki.jpg'),
		'published_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s'),
		'url' => url('khao-sat.html')
	);

	$questions = Survey::getAllSurveyAnswers();

	require_once(VIEW_DIR . '/survey_view.php');
?>