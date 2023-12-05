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

		$customers = Customer::getAllCustomerCodeFull();
		$codes = array_keys($customers);
		shuffle($codes);
		return response(true, array(
			'data' => $customers,
			'codes' => $codes
		));
	}

	return response(false, array('code' => '403'));
?>