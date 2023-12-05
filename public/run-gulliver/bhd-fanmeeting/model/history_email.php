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
        $input['taxonomy_type'] = 'Modules\\\Kilala\\\Entities\\\CustomerGulliverFanmeeting';
        $input['taxonomy_id'] = $data['customer_id'];
        $input['lang_code'] = 'vi';
        $input['from_name'] = 'kilala.vn';
        $input['from_email'] = 'gulliver@kilala.vn';
        $input['recipient_email'] = trim($data['recipient_email']);
        $input['subject'] = 'Xác nhận đăng ký tham gia sự kiện fan meeting của chương trình Phiêu lưu cùng Gulliver - Mùa 4 Reloaded.';
        $input['content'] = trim(addslashes(self::layoutMail($data)));
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

    private static function layoutMail($customer) {
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
                                        <p style="margin: 0;">
                                            Thân chào ' . $customer['fullname'] . ',
                                        </p>
                                        <p style="margin: 0;">
                                            Cảm ơn bạn đã đăng kí tham dự sự kiện fan meeting của chương trình Phiêu lưu cùng Gulliver - Mùa 4 Reloaded.
                                        </p>
                                        <p style="margin: 0;">
                                            <strong>
                                                Thông tin đăng ký của bạn như sau:
                                            </strong>
                                        </p>
                                        <ul>
                                            <li><strong>Họ tên:</strong> ' . $customer['fullname'] . '</li>
                                            <li><strong>Điện thoại:</strong> ' . $customer['phone'] . '</li>
                                            <li><strong>Email:</strong> ' . $customer['email'] . '</li>
                                            <li><strong>Giới tính:</strong> ' . $customer['extend']['sex'] . '</li>
                                            <li><strong>Độ tuổi:</strong> ' . $customer['extend']['old'] . '</li>
                                        </ul>

                                        <p style="margin: 0;">
                                            Ban tổ chức sẽ liên hệ với 200 bạn may mắn để xác nhận tham gia sự kiện trước ngày 29/11/2023.
                                        </p>
                                        <p>
                                            Bạn nhớ để ý email (cả hộp thư rác/spam) và giữ điện thoại luôn đổ chuông nhé.
                                        </p>
                                        <p>
                                            Trân trọng,
                                        </p>
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
            return $content;
    }
}

?>
