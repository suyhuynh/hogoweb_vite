<?php
return [
    'sidebar' => [
        'dashboard' => 'ダッシュボード'
    ],
    'pagination' => [
        'previous' => '前',
        'next' => '次',
    ],
    'action' => [
        'index' => 'リスト',
        'create' => '新規作成',
        'edit' => '編集',
        'delete' => '削除',
        'destroy' => '削除',
        'show' => '時計',
        'view' => '時計',
        'processed' => '処理',
        'change' => '変更',
        'store' => '保存',
        'update' => '更新',
        'cancel' => 'キャンセル',
        'oki' => '同意',
        'status' => 'ステータス変更',
        'restore' => '復元',
        'permanently_delete' => '完全に削除',
        'reset' => 'リセット',
        'updateSort' => '更新ソート',
        'duplicate' => '複製',
        'export' => 'エクスポート',
    ],
    'confirm' => [
        'alert' => '',
        'title' => 'この :action フィールドが必要ですか?',
        'title_all' => '選択したすべてのフィールドを :action しますか?',
        'delete' => '本当にこの情報を削除しますか? この情報は取得できないことに注意してください。',
        'delete_cache' => 'キャッシュをクリアしてもよろしいですか?',
    ],
    'msg' => [
        'oki' => '成功',
        'error' => '操作に失敗しました',
        'resource_saved' => ':リソースは保存されました。',
        'resource_deleted' => ':resource は削除されました。',
        'permission_denied' => 'アクセスが拒否されました (許可が必要です => ":permission").',
        'customer_empty' => '顧客情報がシステムに存在しません',
        'resource_saved_error_email' => ':リソースは保存されました。 メールを送信できません',
        'resource_saved_error' => ':リソースが保存されていません',
        'error_email' => 'エラーメール送信',
        'customer_exist' => '顧客は既にシステムに存在します'
    ],
    'table' => [
        'created' => '作成日',
        'datatable_info' => '_TOTAL_ 個のエントリで _START_ から _END_ までを表示',
        'b_length_change' => '合計ラインを表示',
        'translate' => '翻訳',
        'empty_table' => '空のテーブル'
    ],
    'attributes' => [
        'please_choose' => '-- 選択してください --'
    ],
    'header' => [
        'profile' => 'アカウント',
        'logout' => 'ログアウト',
        'welcome' => 'こんにちは:ユーザー',
        'notification' => 'total notifications があります',
        'view_all' => 'すべて表示'
    ],
    'daterangepicker' => [
        "format" => "DD/MM/YYYY",
        "separator" => " - ",
        "applyLabel" => "選択",
        "cancelLabel" => "キャンセル",
        "fromLabel" => "From",
        "toLabel" => "To",
        "customRangeLabel" => "カスタム",
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
            "1月",
            "2月",
            "行進",
            "4月",
            "5月",
            "六月",
            "7月",
            "8月",
            "9月",
            "10月",
            "11月",
            "12月"
        ],
        "firstDay" => 1,
        "today" => '今日',
    ],
    'filter' => [
        'created_at' => '作成日',
        'keyword' => 'キーワード',
        'all_date' => 'すべての日付',
    ],
    'find' => 'キーワードを入力',
    'back' => '戻る',
    'status' => [
        'publish' => '公開',
        'private' => '下書きボード',
        'trash' => 'ゴミ箱'
    ],
    'dashboard' => [
        'view_more' => '詳細を見る',
        'page' => 'コンテンツページ',
        'post' => '投稿',
        'post_category' => '投稿カテゴリ',
        'contact' => '連絡先',
        'customer' => '今日の誕生日',
    ],
    'config' => [
        'title' => 'システム構成',
        'general' => '概要',
        'tranding' => 'Tranding',
        'email_template' => 'メールテンプレート',
        'account_mail' => 'メールアカウント',
        'contact' => [
            'title' => 'お問い合わせページ',
            'isPopup' => 'ポップアップとして表示',
            'msg' => [
                'success' => '成功メッセージ',
                'error' => 'エラーメッセージ',
            ]
        ],
        'form' => [
            'logo' => 'ロゴ',
            'icon' => 'アイコン',
            'company_name' => '会社名',
            'company_phone' => '電話番号',
            'company_email' => '電子メール',
            'content' => 'コンテンツ',
            'header' => 'ヘッダー',
            'footer' => 'フッター',
            'host' => 'ホスト',
            'port' => 'ポート',
            'account_email' => 'メールアカウント',
            'password' => 'パスワード',
            'cache_days' => 'キャッシュ日数',
            'max_display' => '最大表示',
            'condition' => '状態'
        ],
        'cache' => [
            'title' => 'キャッシュ',
            'delete' => 'キャッシュの消去',
            'update_module' => 'アップデートモジュール',
        ],
        'comment' => [
            'title' => 'コメント通知',
            'msg_success' => '成功したコメントの通知',
            'msg_error' => 'コメント失敗通知',
        ],
        'notify' => [
            'title' => '通知する',
            'newsletter' => 'ニュースレター',
            'account_register' => '口座登録簿',
            'forgot_password' => 'パスワードをお忘れですか',
            'contact' => 'コンタクト',
            'update_profile' => 'プロフィールを更新する',
            'report' => 'Report',
        ]
    ],
    'back_to_list' => 'リストに戻る',
    'call_admin' => 'サポートについては Kilala 管理者にお問い合わせください: (+84) 28 3827 7722 月 - 金 | 8:30～17:00',
    'indefinite' => '不定',
    'info' => '情報',
    'image' => '画像',
    'size' => 'サイズ',
    'select2_input' => '2文字以上入力してください',
    'condition_tranding' => [
        'new' => '最新',
        'desc_view' => '最高のビュー',
        'asc_view' => '最低視聴回数',
        'hot' => '熱い',
        'prioritize' => '優先順位を付ける'
    ],
    'back_to_home' => 'ホームページ',
    'publish_note'=>'「下書き」+「チェック済み」の場合にポストタイマーが機能します',
];
