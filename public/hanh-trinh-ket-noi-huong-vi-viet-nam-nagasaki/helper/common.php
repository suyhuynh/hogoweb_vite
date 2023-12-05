<?php

if (! function_exists('randerCode')) {
    function randerCode($length = 6) {
        // return substr(sha1(mt_rand()), 0, $max);

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters_length = strlen($characters);
        $output = '';
        for ($i = 0; $i < $length; $i++) {
            $output .= $characters[rand(0, $characters_length - 1)];
        }

        return $output;
    }
}

if (! function_exists('dd')) {
    function dd($array) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($array);die;
    }
}

if (! function_exists('response')) {
    function response($status, $data = array()) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(
            array_merge(
                array('success' => $status), $data
            )
        );die;
    }
}

if (! function_exists('redirect')) {
    function redirect($link = '') {
        header("Location: ". url($link));
		die();
    }
}

?>