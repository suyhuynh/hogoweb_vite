<?php

class CustomerGulliverAnswer {

    public static function fillable() {
        return array(
            'customer_id',
            'answers',
            'created_at',
            'updated_at'
        );
    }

    public static function findOrCreateByCustomerId($customerId, $input) {
        $status = false;
        $customer_gulliver_answer = self::getCustomerGulliverAnswerById($customerId);
        if (empty($customer_gulliver_answer)) {
            $input['customer_id'] = $customerId;
            $status = self::create($input);
        }

        return $status;
    }

    public static function getCustomerGulliverAnswerById($customerId) {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `customer_gulliver_answers` WHERE `customer_id` = $customerId"
        );
		$result = mysqli_fetch_assoc($sql) ;
		return $result;
    }

    private static function create($data) {
        $now = date('Y-m-d H:i:s');
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        $filters = self::fillable();
        $keys = array();
        $values = array();
    
        foreach ($filters as $key => $filter) {
            if (isset($data[$filter])) {
                $keys[$key] = $filter;
                if ($filter == 'answers') {
                    $data[$filter] = json_encode($data[$filter]);
                }
                $values[$filter] = $data[$filter];
            }
        }

        $sql = "INSERT INTO `customer_gulliver_answers` 
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
}

?>
