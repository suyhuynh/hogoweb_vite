<?php
	session_start();
	require_once(MODEL_DIR.'/customer.php');

	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		return response(false);
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if($_SERVER['Authorization'] != 'Kilala SG9Hb1dlYiBIdeG7s25oIE5n4buNYyBTdXkgMDkzMTE1NjgxOA==') {
			return response(false, array('code' => 'Authorization'));
		}

		// if (!empty($_POST['luckyCode'])) {
		// 	$customers = Customer::updateLuckyCode($_POST['luckyCode']);
		// 	return response(true, array(
		// 		'success' => true
		// 	));
		// }
		
	}

	return response(false, array('code' => '403'));
?>