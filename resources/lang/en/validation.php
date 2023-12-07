<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The field :attribute must be accepted.',
    'active_url' => 'The field :attribute is not a valid URL.',
    'after' => 'The :attribute field must be one day after the :date.',
    'after_or_equal' => 'The :attribute field must be the start time after or exactly equal to :date.',
    'alpha' => 'The :attribute field can only contain letters.',
    'alpha_dash' => 'The :attribute field can only contain letters, numbers and dashes.',
    'alpha_num' => 'The field :attribute can only contain letters and numbers.',
    'array' => 'The :attribute field must be an array.',
    'before' => 'The :attribute field must be one day before the :date.',
    'before_or_equal' => 'The :attribute field must be a time that starts before or exactly equals :date.',
    'between' => [
        'numeric' => 'The :attribute field must be between :min - :max.',
        'file' => 'The file size in the :attribute field must be from :min - :max kB.',
        'string' => 'The field :attribute must be from :min - :max characters.',
        'array' => 'The :attribute field must contain :min - :max elements.',
    ],
    'boolean' => 'The field :attribute must be true or false.',
    'confirmed' => 'Confirmation value in :attribute field does not match.',
    'date' => 'The :attribute field is not a date-month format.',
    'date_equals' => 'The :attribute field must be a date equal to :date.',
    'date_format' => 'The :attribute field is not the same as the :format.',
    'different' => 'The :attribute and :other fields must be different.',
    'digits' => 'The length of the :attribute field must include :digits digits.',
    'digits_between' => 'The length of the :attribute field must be between :min and :max digits.',
    'dimensions' => 'The field :attribute has an invalid size.',
    'distinct' => 'The field :attribute has a duplicate value.',
    'email' => 'The :attribute field must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The value selected in the :attribute field is invalid.',
    'file' => 'The :attribute field must be a file.',
    'filled' => 'The :attribute field cannot be empty.',
    'gt' => [
        'numeric' => 'The :attribute field value must be greater than :value.',
        'file' => 'The size of the :attribute field must be larger than :value kilobytes.',
        'string' => 'The length of the :attribute field must be more than :value characters.',
        'array' => 'Array :attribute must have more than :value elements.',
    ],
    'gte' => [
        'numeric' => 'The :attribute field value must be greater than or equal to :value.',
        'file' => 'The size of the :attribute field must be greater than or equal to :value kilobytes.',
        'string' => 'The length of the :attribute field must be greater than or equal to :value characters.',
        'array' => 'The :attribute array must have at least :value elements.',
    ],
    'image' => 'The :attribute field must be an image format.',
    'in' => 'The value selected in the :attribute field is invalid.',
    'in_array' => 'The field :attribute must be in the permission set: :other.',
    'integer' => 'The field :attribute must be an integer.',
    'ip' => 'The :attribute field must be an IP address.',
    'ipv4' => 'The :attribute field must be an IPv4 address',
    'ipv6' => 'The :attribute field must be an IPv6 address.',
    'json' => 'The :attribute field must be a JSON string.',
    'lt' => [
        'numeric' => 'The :attribute field value must be less than :value.',
        'file' => 'The size of the :attribute field must be less than :value kilobytes.',
        'string' => 'The length of the :attribute field must be less than :value characters.',
        'array' => 'Array :attribute must have less than :value elements.',
    ],
    'lte' => [
        'numeric' => 'The :attribute field value must be less than or equal to :value.',
        'file' => 'The size of the :attribute field must be less than or equal to :value kilobytes.',
        'string' => 'The length of the :attribute field must be less than or equal to :value characters.',
        'array' => 'Array :attribute cannot have more than :value elements.',
    ],
    'max' => [
        'numeric' => 'The field :attribute cannot be greater than :max.',
        'file' => 'The file size in the :attribute field cannot be larger than :max kB.',
        'string' => 'The :attribute field cannot be larger than :max characters.',
        'array' => 'The field :attribute cannot be larger than :max element.',
    ],
    'mimes' => 'The :attribute field must be a file with the format: :values.',
    'mimetypes' => 'The :attribute field must be a file with the format: :values.',
    'min' => [
        'numeric' => 'The :attribute field must be at least :min.',
        'file' => 'The file size in the :attribute field must be at least :min kB.',
        'string' => 'The :attribute field must have at least :min characters.',
        'array' => 'The :attribute field must have at least :min elements.',
    ],
    'not_in' => 'The value selected in the :attribute field is invalid.',
    'not_regex' => 'The :attribute field has an invalid format.',
    'numeric' => 'The field :attribute must be a number.',
    'present' => 'The :attribute field must be provided.',
    'regex' => 'The :attribute field has an invalid format.',
    'required' => 'The field :attribute cannot be left blank.',
    'required_if' => 'The :attribute field cannot be empty when the :other field is :value.',
    'required_unless' => 'The :attribute field cannot be left blank unless :other is :values.',
    'required_with' => 'The :attribute field cannot be empty when one of the :values has a value.',
    'required_with_all' => 'The :attribute field cannot be empty when all :values are valid.',
    'required_without' => 'The :attribute field cannot be left blank when one of the :values has no value.',
    'required_without_all' => 'The :attribute field cannot be empty when all :values are null.',
    'same' => 'The :attribute and :other fields must be the same.',
    'size' => [
        'numeric' => 'The :attribute field must be equal to :size.',
        'file' => 'The file size in the :attribute field must be equal to :size kB.',
        'string' => 'The :attribute field must contain :size characters.',
        'array' => 'The :attribute field must contain the :size element.',
    ],
    'starts_with' => 'The :attribute field must begin with one of the following values: :values',
    'string' => 'The field :attribute must be a string.',
    'timezone' => 'The :attribute field must be a valid time zone.',
    'unique' => 'The field :attribute already exists in the system.',
    'uploaded' => 'Field :attribute upload failed.',
    'url' => 'The :attribute field does not match the format of a URL.',
    'uuid' => 'The :attribute field must be a valid UUID string.',
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'status_alert' => 'Do you want to update this status.',
    'store_alert' => 'Do you want to add this :resource.',
    'delete_alert' => 'Do you want to delete this :resource.',
    'update_alert' => 'Do you want to update this :resource.',
    'permission_denied' => 'You do not have permission to access the page :permission',
    'attributes' => [
        'find' => 'Search',
        'account' => 'Account',
        'name' => 'name',
        'username' => 'username',
        'email' => 'email',
        'first_name' => 'name',
        'last_name' => 'lastname',
        'password' => 'password',
        'password_confirmation' => 'password confirmation',
        'city' => 'city',
        'country' => 'country',
        'address' => 'address',
        'phone' => 'phone number',
        'mobile' => 'mobile',
        'age' => 'age',
        'sex' => 'gender',
        'gender' => 'gender',
        'year' => 'Year',
        'month' => 'Month',
        'day' => 'Day',
        'hour' => 'hour',
        'minute' => 'minute',
        'second' => 'second',
        'title' => 'title',
        'content' => 'Content',
        'body' => 'content',
        'description' => 'description',
        'excerpt' => 'quote',
        'date' => 'date',
        'time' => 'time',
        'subject' => 'title',
        'message' => 'message',
        'available' => 'available',
        'size' => 'size',
        'success' => 'Success',
        'update_success' => 'update successful',
        'create_success' => 'new successful',
        'error' => 'Operation failed',
        'order_list' => 'View order list',
        'detail' => 'View customer details',
        'update' => 'Update',
        'personnel' => 'Employee',
        'category' => 'category',
        'export_file' => 'Export file',
        'save' => 'Save',
        'select' => '-- Please select --',
        'select_status' => '-- Select state --',
        'data_empty' => 'No data',
        'created_at' => 'Date created',
        'updated_at' => 'Updated date',
        'alert' => 'Warning!!!',
        'alert_cancel' => 'Cancel action',
        'alert_success' => 'Yes I want',
        'title' => 'Enter title',
        'description' => 'Enter description',
        'back' => 'Back',
        'reset' => 'Default',
        'build' => 'Build theme',
        'save_theme' => 'Save theme',
        'info' => 'information field',
        'fullname' => 'full name',
        'type'                  => 'type'
    ],
];
