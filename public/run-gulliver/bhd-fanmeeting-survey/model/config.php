<?php

class Config {

    public static function fillable() {
        return array(
            'config',
        );
    }

    public static function getVideo() {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `configs` WHERE `type` = 'gulliver_fanmeeting_survey'"
        );
		$result = mysqli_fetch_assoc($sql) ;
        if (!empty($result)) {
            $link = json_decode($result['config'], true)['video'];
            $parts = parse_url($link);
            parse_str($parts['query'], $query);
            $result = $query['v'];
        }
		return $result;
    }
}

?>
