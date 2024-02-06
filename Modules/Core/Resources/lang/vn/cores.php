<?php
return [
    'sidebar' => [
        'dashboard' => 'Dashboard'
    ],
    'pagination' => [
        'previous' => 'Previous',
        'next' => 'Next',
    ],
    'action' => [
        'index' => 'Danh sách',
        'create' => 'Tạo mới',
        'edit' => 'Chỉnh sửa',
        'delete' => 'Xóa',
        'destroy' => 'Xóa',
        'show' => 'Xem',
        'view' => 'Xem',
        'processed' => 'Xử lý',
        'change' => 'Thay đổi',
        'store' => 'Lưu',
        'update' => 'Cập nhật',
        'cancel' => 'Hủy',
        'oki' => 'Đồng ý',
        'status' => 'Trạng thái',
        'restore' => 'Khôi phục',
        'permanently_delete' => 'Xoá vĩnh viễn',
        'reset' => 'Reset',
        'updateSort' => 'Cập nhật sắp xếp',
        'duplicate' => 'Copy',
        'export' => 'Xuất',
    ],
    'confirm' => [
        'alert' => '',
        'title' => 'Bạn có muốn :action trường thông tin này không?',
        'title_all' => 'Bạn có muốn :action tất cả các trường đã chọn không?',
        'delete' => 'Bạn chắc chắn muốn xóa thông tin này? Lưu ý thông tin này không thể lấy lại.',
        'delete_cache' => 'Bạn chắc chắn muốn xóa cache không?',
    ],
    'msg' => [
        'oki' => 'Thành công',
        'error' => 'Thao tác thất bại',
        'resource_saved' => ':resource đã đuợc lưu.',
        'resource_deleted' => ':resource đã được xóa.',
        'permission_denied' => 'Từ chối truy cập (yêu cầu quyền => ":permission").',
        'customer_empty' => 'Thông tin khách hàng chưa tồn tại trong hệ thống',
        'resource_saved_error_email' => ':resource đã đuợc lưu. Không gửi mail được',
        'resource_saved_error' => ':resource chưa được lưu',
        'error_email' => 'Gửi mail lỗi',
        'customer_exist' => 'Khách hàng đã tồn tại trong hệ thống'
    ],
    'table' => [
        'created' => 'Ngày tạo',
        'datatable_info' => 'Hiển thị _START_ đến _END_ trong _TOTAL_ mục',
        'b_length_change' => 'Hiển thị :total dòng',
        'translate' => 'Dịch',
        'empty_table' => 'Không có dữ liệu'
    ],
    'attributes' => [
        'please_choose' => '-- Vui lòng chọn --'
    ],
    'header' => [
        'profile' => 'Tài khoản',
        'logout' => 'Đăng xuất',
        'welcome' => 'Chào :user',
        'notification' => 'Bạn đang có :total thông báo',
        'view_all' => 'Xem tất cả'
    ],
    'daterangepicker' => [
        "format" => "DD/MM/YYYY",
        "separator" => " - ",
        "applyLabel" => "Chọn",
        "cancelLabel" => "Hủy",
        "fromLabel" => "Từ",
        "toLabel" => "Đến",
        "customRangeLabel" => "Custom",
        "daysOfWeek" => [
            "CN",
            "T2",
            "T3",
            "T4",
            "T5",
            "T6",
            "T7"
        ],
        "monthNames" => [
            "Tháng 1",
            "Tháng 2",
            "Tháng 3",
            "Tháng 4",
            "Tháng 5",
            "Tháng 6",
            "Tháng 7",
            "Tháng 8",
            "Tháng 9",
            "Tháng 10",
            "Tháng 11",
            "Tháng 12"
        ],
        "firstDay" => 1,
        "today" => 'Today',
    ],
    'filter' => [
        'created_at' => 'Ngày tạo',
        'keyword' => 'Từ khóa',
        'all_date' => 'Tất cả các ngày',
    ],
    'find' => 'Nhập từ khóa',
    'back' => 'Trở lại',
    'status' => [
		'publish' => 'Xuất bản',
		'private' => 'Bản nháp',
		'trash' => 'Rác'
	],
    'dashboard' => [
        'view_more' => 'Xem chi tiết',
        'page' => 'Trang nội dung',
        'post' => 'Bài viết',
        'post_category' => 'Danh mục bài viết',
        'contact' => 'Liên hệ',
        'customer' => 'Sinh nhật hôm nay',
    ],
    'config' => [
        'title' => 'Cấu hình hệ thống',
        'general' => 'Tổng quan',
        'tranding' => 'Tranding',
        'email_template' => 'Email template',
        'account_mail' => 'Tài khoản gửi mail',
        'contact' => [
            'title' => 'Trang liên hệ',
            'isPopup' => 'Hiển thị dạng Popup',
            'msg' => [
                'success' => 'Thông báo thành công',
                'error' => 'Thông báo lỗi',
            ]
        ],
        'form' => [
            'logo' => 'Logo',
            'icon' => 'Icon',
            'company_name' => 'Tên công ty',
            'company_phone' => 'Số điện thoại',
            'company_email' => 'Email',
            'content' => 'Nội dung',
            'header' => 'Header',
            'footer' => 'Footer',
            'host' => 'Host',
            'port' => 'Port',
            'account_email' => 'Tài khoản mail',
            'password' => 'Mật khẩu',
            'cache_days' => 'Số ngày cache',
            'max_display' => 'Hiển thị tối đa',
            'condition' => 'Điều kiện'
        ],
        'cache' => [
            'title' => 'Cache',
            'delete' => 'Xóa cache',
            'update_module' => 'Update module',
        ],
        'comment' => [
            'title' => 'Thông báo bình luận',
            'msg_success' => 'Thông báo bình luận thành công',
            'msg_error' => 'Thông báo bình luận thất bại',
        ],
        'notify' => [
            'title' => 'Thông báo',
            'newsletter' => 'Đăng ký nhận tin',
            'account_register' => 'Đăng ký tài khoản',
            'forgot_password' => 'Quên mật khẩu',
            'contact' => 'Liên hệ',
            'update_profile' => 'Cập nhật thông tin',
            'report' => 'Report',
        ]
    ],
    'back_to_list' => 'BACK TO LIST',
    'call_admin' => 'Liên hệ admin Kilala để được hỗ trợ: (+84) 28 3827 7722  Thứ 2 – Thứ 6 | 8:30 – 17:00',
    'indefinite' => 'Không thời hạn',
    'info' => 'Thông tin',
    'image' => 'Hình ảnh',
    'size' => 'Size',
    'select2_input' => 'Vui lòng nhập 2 ký tự trở lên',
    'condition_tranding' => [
        'new' => 'Mới nhất',
        'desc_view' => 'Lượt xem cao nhất',
        'asc_view' => 'Lượt xem thấp nhất',
        'hot' => 'Hot',
        'prioritize' => 'Ưu tiên'
    ],
    'back_to_home' => 'Trang chủ',
    'publish_note'=>'Hẹn giờ đăng hoạt động khi là "bản nháp" + "đã tick"'
];
