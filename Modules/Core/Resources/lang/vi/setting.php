<?php
return [		
	'module' => 'Cấu hình',
	'general' => [
		'title' => 'Cấu hình chung',
		'social' => 'Liên kết mạng xã hội',
		'datetime' => 'ĐỊNH DẠNG NGÀY GIỜ',
		'register_date' => 'Ngày đăng ký',
		'contact' => [
			'title' => 'Thông tin liên hệ',
			'fullname' => 'Họ và tên',
			'phone' => 'Điện thoại',
			'email' => 'Email',
		],
		'contact_web' => 'Thông tin liên hệ'
	],
	'account_send_mail' => [
		'title' => 'Tài khoản gởi mail',
		'account' => 'Tài khoản',
		'password' => 'Mật Khẩu',
		'mail_host' => 'Mail host',
		'mail_port' => 'Mail port',
		'theme' => 'Giao diện',
		'theme_mail' => [
			'title' => 'Tiêu đề',
			'des' => 'Mô tả',
			'hotline' => 'Điện thoại',
			'logo' => 'Logo',
			'content' => 'Nội dung',
			'company' => 'Thông tin công ty',
			'coppy' => 'Coopy @',
			'background' => 'Màu nền',
		]
	],
	'social' => [
		'title' => 'Mạng xã hội',
	],
	'product' => [
		'title' => 'Sản phẩm',
		'sort' => 'Sắp xếp sản phẩm',
		'sorts' => [
			'desc' => 'Xếp giảm dần',
			'asc' => 'Xếp tăng dần'
		],
		'product_number' => 'Số sản phẩm trên dòng',
		'limit' => 'Tổng sản phẩm',
		'price_format' => 'Định dạng giá',
		'currency' => 'Tiền tệ',
	],
	'login' => [
		'title' => 'Đăng nhập',
		'is_show_modal' => 'Hiện thị thông báo',
		'content' => 'Nội dung thông báo',
		'redirect_to' => 'Link chuyển sau khi đăng nhập thành công',
	],
	'seo' => [
		'title' => 'Seo',
		'extension' => 'Hiện thị url theo dạng',
		'extension_note' => 'kenny-huynh.html',
	],
	'cache' => [
		'title' => 'Cache',
		'delete_cache' => 'Xóa cache'
	],
	'order' => [
		'title' => 'Đơn hàng',
		'delivery' => 'Cho phép chọn đối tác giao hàng'
	],
	'transport' => [
		'title' => 'Vận chuyển',
		'not_use_api' => 'Không dùng qua API tỉnh thành quận huyện',
		'not_use_district' => 'Không hiển thị quận huyện',
		'not_use_ward' => 'Không hiển thị phường xã'
	],
	'config_code' => [
		'title' => 'Cấu hình mã đơn',
		'order' => 'Mã đơn hàng',
		'payment' => 'Mã phiếu thanh toán',
	]
];