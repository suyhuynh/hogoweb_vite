<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted' => 'フィールド :attribute は受け入れられる必要があります。',
    'active_url' => 'フィールド :attribute は有効な URL ではありません。',
    'after' => ':attribute フィールドは、:date の 1 日後でなければなりません。',
    'after_or_equal' => ':attribute フィールドは、:date 以降の開始時間か、正確に等しい必要があります。',
    'alpha' => ':attribute フィールドには文字のみを含めることができます。',
    'alpha_dash' => ':attribute フィールドには、文字、数字、およびダッシュのみを含めることができます。',
    'alpha_num' => ':attribute フィールドには、文字と数字のみを含めることができます。',
    'array' => ':attribute フィールドは配列でなければなりません。',
    'before' => ':attribute フィールドは、:date の 1 日前でなければなりません。',
    'before_or_equal' => ':attribute フィールドは、:date より前に始まるか、正確に等しい時刻でなければなりません。',
    'between' => [
        'numeric' => ':attribute フィールドは :min - :max の間でなければなりません.',
        'file' => ':attribute フィールドのファイル サイズは、:min - :max kB でなければなりません。',
        'string' => 'フィールド :attribute は :min - :max 文字でなければなりません.',
        'array' => ':attribute フィールドには、:min - :max 要素が含まれている必要があります。',
    ],
    'boolean' => 'フィールド :attribute は true または false でなければなりません。',
    'confirmed' => ':attribute フィールドの確認値が一致しません。',
    'date' => ':attribute フィールドは日月形式ではありません。',
    'date_equals' => ':attribute フィールドは :date と等しい日付でなければなりません。',
    'date_format' => ':attribute フィールドは:format と同じではありません。',
    'different' => ':attribute フィールドと :other フィールドは異なる必要があります。',
    'digits' => ':attribute フィールドの長さには :digits 桁を含める必要があります。',
    'digits_between' => ':attribute フィールドの長さは、:min から :max 桁の間でなければなりません。',
    'dimensions' => 'フィールド :attribute のサイズが無効です。',
    'distinct' => 'フィールド :attribute の値が重複しています。',
    'email' => ':attribute フィールドは有効なメールアドレスでなければなりません。',
    'ends_with' => ':attribute は次のいずれかで終わる必要があります: :values',
    'exists' => ':attribute フィールドで選択された値は無効です。',
    'file' => ':attribute フィールドはファイルでなければなりません。',
    'filled' => ':attribute フィールドを空にすることはできません。',
    'gt' => [
        'numeric' => ':attribute フィールドの値は :value より大きくなければなりません。',
        'file' => ':attribute フィールドのサイズは、:value キロバイトより大きくなければなりません。',
        'string' => ':attribute フィールドの長さは :value 文字より長くなければなりません.',
        'array' => 'Array :attribute には :value 要素よりも多くの要素が必要です.',
    ],
    'gte' => [
        'numeric' => ':attribute フィールドの値は :value 以上である必要があります。',
        'file' => ':attribute フィールドのサイズは、:value キロバイト以上でなければなりません。',
        'string' => ':attribute フィールドの長さは、:value 文字以上でなければなりません。',
        'array' => ':attribute 配列には、少なくとも :value 要素が必要です。',
    ],
    'image' => ':attribute フィールドは画像形式でなければなりません。',
    'in' => ':attribute フィールドで選択された値は無効です。',
    'in_array' => 'フィールド :attribute は権限セット: :other に含まれている必要があります。',
    'integer' => 'フィールド :attribute は整数でなければなりません.',
    'ip' => ':attribute フィールドは IP アドレスでなければなりません。',
    'ipv4' => ':attribute フィールドは IPv4 アドレスでなければなりません',
    'ipv6' => ':attribute フィールドは IPv6 アドレスでなければなりません。',
    'json' => ':attribute フィールドは JSON 文字列でなければなりません。',
    'lt' => [
        'numeric' => ':attribute フィールドの値は :value 未満でなければなりません。',
        'file' => ':attribute フィールドのサイズは、:value キロバイト未満でなければなりません。',
        'string' => ':attribute フィールドの長さは :value 文字未満でなければなりません。',
        'array' => 'Array :attribute は :value 要素より少なくなければなりません.',
    ],
    'lte' => [
        'numeric' => ':attribute フィールドの値は :value 以下でなければなりません。',
        'file' => ':attribute フィールドのサイズは、:value キロバイト以下でなければなりません。',
        'string' => ':attribute フィールドの長さは、:value 文字以下でなければなりません。',
        'array' => 'Array :attribute は :value 要素を超えることはできません.',
    ],
    'max' => [
        'numeric' => 'フィールド :attribute は :max を超えることはできません。',
        'file' => ':attribute フィールドのファイル サイズは :max kB より大きくすることはできません。',
        'string' => ':attribute フィールドは :max 文字より大きくすることはできません.',
        'array' => 'フィールド :attribute は :max 要素より大きくすることはできません.',
    ],
    'mimes' => ':attribute フィールドは、:values の形式のファイルでなければなりません。',
    'mimetypes' => ':attribute フィールドは、:values の形式のファイルでなければなりません。',
    'min' => [
        'numeric' => ':attribute フィールドは少なくとも :min.',
        'file' => ':attribute フィールドのファイル サイズは少なくとも :min kB である必要があります。',
        'string' => ':attribute フィールドには、少なくとも :min 文字が必要です。',
        'array' => ':attribute フィールドには、少なくとも :min 要素が必要です。',
    ],
    'not_in' => ':attribute フィールドで選択された値は無効です。',
    'not_regex' => ':attribute フィールドの形式が無効です。',
    'numeric' => 'フィールド :attribute は数値でなければなりません.',
    'present' => ':attribute フィールドを指定する必要があります。',
    'regex' => ':attribute フィールドの形式が無効です。',
    'required' => ':attribute フィールドを空白にすることはできません。',
    'required_if' => ':other フィールドが :value の場合、:attribute フィールドを空にすることはできません。',
    'required_unless' => ':attribute フィールドは、:other が :values でない限り、空白のままにすることはできません。',
    'required_with' => ':values の 1 つに値がある場合、:attribute フィールドを空にすることはできません。',
    'required_with_all' => 'すべての :values が有効な場合、:attribute フィールドを空にすることはできません。',
    'required_without' => ':values の 1 つに値がない場合、:attribute フィールドを空白のままにすることはできません。',
    'required_without_all' => 'すべての :values が null の場合、:attribute フィールドを空にすることはできません。',
    'same' => ':attribute フィールドと :other フィールドは同じでなければなりません。',
    'size' => [
        'numeric' => ':attribute フィールドは :size と等しくなければなりません。',
        'file' => ':attribute フィールドのファイル サイズは :size kB に等しくなければなりません。',
        'string' => ':attribute フィールドには :size 文字を含める必要があります。',
        'array' => ':attribute フィールドには :size 要素が含まれている必要があります。',
    ],
    'starts_with' => ':attribute フィールドは次のいずれかの値で始まる必要があります: :values',
    'string' => 'フィールド :attribute は文字列でなければなりません。',
    'timezone' => ':attribute フィールドは有効なタイムゾーンでなければなりません.',
    'unique' => 'フィールド :attribute は既にデータベースに存在します。',
    'uploaded' => 'フィールド:属性のアップロードに失敗しました.',
    'url' => ':attribute フィールドが URL の形式と一致しません。',
    'uuid' => ':attribute フィールドは有効な UUID 文字列でなければなりません。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => '名前',
        'username' => 'ユーザー名',
        'email' => 'メール',
        'first_name' => '名前',
        'last_name' => '姓',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワードの確認',
        'city' => '都市',
        'country' => '国',
        'address' => '住所',
        'phone' => '電話番号',
        'mobile' => 'モバイル',
        'age' => '年齢',
        'sex' => '性別',
        'gender' => '性別',
        'year' => '年',
        'month' => '月',
        'day' => '日',
        'hour' => 'hour',
        'minute' => '分',
        'second' => '秒',
        'title' => 'タイトル',
        'content' => 'コンテンツ',
        'body' => '内容',
        'description' => '説明',
        'excerpt' => '引用',
        'date' => '日付',
        'time' => '時間',
        'subject' => 'タイトル',
        'message' => 'メッセージ',
        'available' => '利用可能',
        'size' => 'サイズ',
        'action' => 'アクション'
    ],
    'validation' => [
        'permission_denied' => '許可なし:permission'
    ]
];
