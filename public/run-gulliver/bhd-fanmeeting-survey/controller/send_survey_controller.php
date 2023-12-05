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
								<p style="margin: 0;">Mã số dự thưởng khảo sát tại sự kiện fan meeting Phiêu lưu cùng Gulliver - Mùa 4 Reloaded.</p>
								<p>Thân chào <strong>' . $customer['fullname'] . '</strong>,</p>
								<p style="margin: 0;">Cảm ơn bạn đã đăng kí khảo sát tại sự kiện fan meeting của chương trình Phiêu lưu cùng Gulliver - Mùa 4 Reloaded!</p>
								<p><strong>Mã dự thưởng của bạn là:</strong> ' . $customer['code'] . '</p>
								<p style="margin: 0;">Vui lòng chuẩn bị sẵn và xuất trình mã này để nhận quà nếu may mắn trúng giải nhé!</p>
								<p style="margin: 0;">Cảm ơn bạn đã luôn đồng hành và ủng hộ chương trình Phiêu lưu cùng Gulliver - Mùa 4 Reloaded.</p>
								<br />
								<p style="margin: 0;">Chúc bạn may mắn!</p>
								<p style="margin: 0;">Trân trọng,</p>
							</td>
						</tr>
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
