<?php

class Customer {

    public static function fillable() {
        return array(
            'code',
            'type',
            'fullname',
            'phone',
            'address',
            'birthday',
            'email',
            'info',
            'status',
            'facebook',
            'google',
            'short_name',
            'extend',
            'created_at',
            'updated_at'
        );
    }

    public static function findOrCreateByEmailOrPhone($condition, $data) {
        $customer = self::getCustomerByEmailOrPhone($condition['phone'], $condition['email']);
        if (empty($customer)) {
            $data['code'] = self::generateCode();
            $data['status'] = 'registered';
            $customerId = self::create($data);
            $customer = self::getCustomerById($customerId);
        }
 
        return $customer;
    }

    public static function getAllCustomerCode() {
        $sql = mysqli_query(dbconnect(),"SELECT `code`, `fullname`, `phone` FROM `customer_gulliver_fanmeetings` WHERE `status` = 'active'");
		
		$result = array(); 
		while ($row = mysqli_fetch_assoc($sql)) {
            $row['phone'] = "*******". substr($row['phone'], -3);
			$result[] = $row;
		} 
		return $result; 
    }

    public static function getAllCustomerCodeFull() {
        $sql = mysqli_query(dbconnect(),"SELECT `code`, `fullname`, `phone` FROM `customer_gulliver_fanmeetings`");
		
		$result = array(); 
		while ($row = mysqli_fetch_assoc($sql)) {
            $row['phone'] = "*******". substr($row['phone'], -3);
			$result[$row['code']] = $row;
		} 
		return $result; 
    }

    public static function getCustomerById($id) {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `customer_gulliver_fanmeetings` WHERE `id` = $id"
        );
		$result = mysqli_fetch_assoc($sql) ;
		return $result;
    }

    public static function getCustomerByEmailOrPhone($phone, $email) {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `customer_gulliver_fanmeetings` WHERE `phone` = '" . trim($phone) . "' OR `email` = '" . trim($email) . "'"
        );
		$result = mysqli_fetch_assoc($sql) ;
		return $result;
    }

    public static function getCustomerByCode($code) {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `customer_gulliver_fanmeetings` WHERE `code` = '$code'"
        );
		$result = mysqli_fetch_assoc($sql) ;
		return $result;
    }

    public static function generateCode() {
        $code = randerCode();
        $entity = self::getCustomerByCode($code);
        if (!empty($entity)) {
            return self::generateCode();
        }
        return $code;
    }

    public static function setStatus($id) {
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `customer_gulliver_fanmeetings` 
			SET `updated_at` = '$now', `status` = 'active'
			WHERE `id` = $id";
        return mysqli_query(dbconnect(),$sql);
    }

    public static function update($id, $data) {
        if (!empty($data['birthday'])) {
            $data['birthday'] = date('Y-m-d', strtotime($data['birthday']));
        }

        $now = date('Y-m-d H:i:s');
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        $filters = self::fillable();
        $values = array();

        foreach ($filters as $key => $filter) {
            if (isset($data[$filter])) {
                $values[] = "`{$filter}` = '" . trim($data[$filter]) . "'";
            }
        }

        $sql = "UPDATE `customer_gulliver_fanmeetings` 
			SET 
            " . implode(",", $values) . "
			WHERE `id` = $id";
        return mysqli_query(dbconnect(),$sql);
    }

    private static function create($data) {
        if (!empty($data['birthday'])) {
            $data['birthday'] = date('Y-m-d', strtotime($data['birthday']));
        }

        $now = date('Y-m-d H:i:s');
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        $filters = self::fillable();
        $keys = array();
        $values = array();

        foreach ($filters as $key => $filter) {
            if (isset($data[$filter])) {
                $keys[$key] = $filter;
                $values[$key] = addslashes(trim($data[$filter]));
            }
        }

        $sql = "INSERT INTO `customer_gulliver_fanmeetings` 
		(
            `" . implode("`, `", $keys) . "`
		)
		VALUE 
		(
		    '" . implode("', '", $values) . "'
		)";

		$link = dbconnect();
		$result = mysqli_query($link, $sql);
		return mysqli_insert_id($link);
    }

    public static function auth() {
        $customer = '';
        if (!empty($_SESSION['customer'])) {
            $customer = $_SESSION['customer'];
            $customer['extend'] = json_decode($customer['extend'], true);
        }

        return $customer;
    }

    public static function logout() {
        unset($_SESSION['customer']);
        session_destroy();
    }
}

?>
