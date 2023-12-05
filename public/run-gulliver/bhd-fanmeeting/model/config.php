<?php

class Config {

    public static function fillable() {
        return array(
            'config',
        );
    }

    public static function getConfig() {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `configs` WHERE `type` = 'gulliver_fanmeeting'"
        );
		$result = mysqli_fetch_assoc($sql) ;
        if (!empty($result)) {
            $result = json_decode($result['config'], true);
        }
		return $result;
    }

    public static function getVideo() {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `configs` WHERE `type` = 'gulliver'"
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

    public static function seoHomePage() {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `configs` WHERE `type` = 'gulliver_seo_home'"
        );
		$result = mysqli_fetch_assoc($sql) ;
		return $result;
    }

    public static function seoRegister() {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `configs` WHERE `type` = 'gulliver_seo_register'"
        );
		$result = mysqli_fetch_assoc($sql) ;
		return $result;
    }

    public static function seoThank() {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `configs` WHERE `type` = 'gulliver_seo_thank'"
        );
		$result = mysqli_fetch_assoc($sql);
		return $result;
    }

    public static function seoDial() {
        $sql = mysqli_query(dbconnect(),
            "SELECT * FROM `configs` WHERE `type` = 'gulliver_seo_dial'"
        );
		$result = mysqli_fetch_assoc($sql) ;
		return $result;
    }
}

?>
