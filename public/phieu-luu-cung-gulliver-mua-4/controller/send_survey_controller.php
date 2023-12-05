<?php
	session_start();
	require_once(MODEL_DIR.'/customer.php');
	require_once(MODEL_DIR.'/survey.php');
	require_once(MODEL_DIR.'/customer_gulliver_answer.php');
	require_once(MODEL_DIR.'/history_email.php');

	header("X-Robots-Tag: noindex, nofollow", true);

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		return response(false);
	}

	$customer = Customer::auth();
	if (empty($customer)) {
		return response(false, array('url' => url()));
		// return redirect();
	}

	if (!empty(CustomerGulliverAnswer::getCustomerGulliverAnswerById($customer['id']))) {
		return response(false, array('url' => url('cam-on.html')));
		// return redirect('cam-on.html');
	}

	if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit'])) {
		return response(false, array('url' => url('error.html')));
	}

	$entity = CustomerGulliverAnswer::findOrCreateByCustomerId($customer['id'], $_POST);
dd($entity);
	if (empty($entity)) {
		return response(false, array('url' => url('cam-on.html')));
	}

	$input = array(
		'customer_id' => $customer['id'],
		'fullname' => $customer['fullname'],
		'phone' => $customer['phone'],
		'recipient_email' => $customer['email'],
	);

	$questions = Survey::getAllSurveyAnswers();
	$answers = $_POST['answers'];
	$content = '
	<!DOCTYPE html>
	<html lang="vi">
		<head>
		</head>
		<body style="background: rgba(25, 191, 191, 0.562);">
			<div style="width: 560px;background: #fff;padding: 15px;margin: 30px auto;">
				<table style="width: 100%;">
					<thead>
						<tr>
							<td>
								<img src="https://kilala.vn/images/logo.png" style="height: 30px;" alt="" />
								<hr />
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<p style="margin: 0;">Chương trình Phiêu lưu cùng Gulliver - Mùa 4 Reloaded đã nhận được bản khảo sát của bạn.</p>
								<p style="margin: 0;">
									<strong>
										Thông tin khảo sát của bạn như sau:
									</strong>
								</p>
								<p style="margin: 0;"><strong>Mã số dự thưởng:</strong> ' . $customer['code'] . '</p>
								<p style="margin: 0;"><strong>Họ tên:</strong> ' . $customer['fullname'] . '</p>
								<p style="margin: 0;"><strong>Khu vực:</strong> ' . $customer['extend']['address'] . '</p>
								<p style="margin: 0;"><strong>Nghề nhgiệp:</strong> ' . $customer['extend']['job'] . '</p>
								<p style="margin: 0;"><strong>Điện thoại:</strong> ' . $customer['phone'] . '</p>
								<p style="margin: 0;"><strong>Email:</strong> ' . $customer['email'] . '</p>
								<p style="margin: 0;"><strong>Bạn bắt gặp quảng cáo của chương trình ở:</strong> ' . implode(", ", $customer['extend']['program']) . '</p>
								<p>
									<hr>
									NỘI DUNG KHẢO SÁT
									<hr>
								</p>
							</td>
						</tr>';
						foreach ($questions as $question) {
							if (isset($answers[$question['id']]) && !empty($answers[$question['id']])) {
								if ($question['form_name'] == 'input') {
									if (!empty($answers[$question['id']][0])) {
										$content .= '
										<tr>
											<td>
												<p style="margin: 0;"><strong>Q' . $question['order'] . ':</strong> ' . $question['name'] . '</p>
												<ul style="margin-left: 0;padding-left: 15px;padding-top: 0;margin-top: 0;">';
													$content .= '
													<li style="list-style: none;">
														' . implode(',', $answers[$question['id']]) . '
													</li>';
												$content .= '
												</ul>
											</td>
										</tr>';
									}
								} else {
									$content .= '
										<tr>
											<td>
												<p style="margin: 0;"><strong>Q' . $question['order'] . ':</strong> ' . $question['name'] . '</p>
												<ul style="margin-left: 0;padding-left: 15px;padding-top: 0;margin-top: 0;">';
													foreach ($question['answers'] as $answer) {
														if ($question['form_name'] == 'input') {
															$content .= '
																<li style="list-style: none;">
																	' . implode(',', $answers[$question['id']]) . '
																</li>';
														} else {
															if (in_array($answer['id'], $answers[$question['id']]) ) {
																$content .= '
																<li style="list-style: none;">
																	☑ ' . $answer['name'] . '
																</li>';
															} else {
																$content .= '
																<li style="list-style: none;">
																	☐ ' . $answer['name'] . '
																</li>';
															}	
														}
													}
												$content .= '
												</ul>
											</td>
										</tr>';
								}
							}
						}
				$content .= '
					</tbody>
					<tfoot>
						<tr>
							<td>
								<p style="margin-bottom: 0;">Mọi thắc mắc vui lòng liên hệ:</p>
								<hr />
								<p style="margin: 0;">
									<strong>CÔNG TY TNHH TRUYỀN THÔNG KILALA</strong>
								</p>
								<p style="margin: 0;">Tầng 3, Tòa nhà Copac Square, 12 Tôn Đản, Phường 13, Quận 4, TP.HCM</p>
								<p style="margin: 0;"><strong>Phone:</strong> (+84) 28 3827 7722  Thứ 2 – Thứ 6 | 8:30 – 17:00</p>
								<p style="margin: 0;"><strong>Email:</strong> info@kilala.vn</p>
								<p style="margin: 0;"><strong>Website:</strong> kilala.vn</p>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</body>
	</html>';
	$input['content'] = $content;

	$status = HistoryEmail::createEmail($input);
	if ($status) {
		Customer::setStatus($customer['id']);
		return response(true, array('url' => url('cam-on.html')));
		// return response(
		// 	array(
		// 		'url' => url('cam-on.html')
		// 	)
		// );
		// return redirect('cam-on.html');
	}

	return response(false, array('url' => url('error.html')));
	// return redirect('error.html');
?>
