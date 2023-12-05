<?php

class HistoryEmail {

    public static function fillable() {
        return array(
            'lang_code',
            'taxonomy_type',
            'taxonomy_id',
            'from_name',
            'from_email',
            'recipient_email',
            'subject',
            'bcc_email',
            'content',
            'fail_msg',
            'retry_times',
            'status',
            'send_at',
            'delivered_at',
            'bounced_at',
            'created_at',
            'updated_at'
        );
    }

    public static function createEmail($data = array()) {
        $input = array();
        $input['taxonomy_type'] = 'Modules\\\Kilala\\\Entities\\\CustomerGulliverFanmeetingSurvey';
        $input['taxonomy_id'] = $data['customer_id'];
        $input['lang_code'] = 'vi';
        $input['from_name'] = 'kilala.vn';
        $input['from_email'] = 'gulliver@kilala.vn';
        $input['recipient_email'] = trim($data['recipient_email']);
        $input['subject'] = 'Mã số dự thưởng fan meeting Phiêu lưu cùng Gulliver - Mùa 4 Reloaded';
        $input['content'] = trim(addslashes($data['content']));
        $input['status'] = 'sending';

        $now = date('Y-m-d H:i:s');
        $input['send_at'] = $now;
        $input['created_at'] = $now;
        $input['updated_at'] = $now;

        return self::create($input);
    }

    private static function create($data) {
        $sql = "INSERT INTO `history_emails` 
		(
            `" . implode("`, `", array_keys($data)) . "`
		)
		VALUE 
		(
		    '" . implode("', '", array_values($data)) . "'
		)";

		$link = dbconnect();
		mysqli_query($link, $sql);
		return mysqli_insert_id($link);
    }
}

?>
