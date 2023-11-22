<?php

return [
    'name' 					=> 'Core',
	'status_class'			 => [
		0 						=> 'danger',
		-1 						=> 'danger',
		1 						=> 'success',
		2 						=> 'primary',
		3 						=> 'info',
		4 						=> 'warning',
		5 						=> 'success',
		6 						=> 'primary',
		7 						=> 'info',
		8 						=> 'warning',
		9 						=> 'warning',
	],
	'payment_status_class' 	=> [
		'paid' 					=> 'success',
		'unpaid' 				=> 'light',
		'partial' 				=> 'primary',
		'error' 				=> 'warning',
		'cancel'				=> 'danger',
	],
	'html_tags' 			=> [
		'text',
		'email',
		'number',
		'select',
		'textarea',
		'content',
		'color',
		'image',
		'code_html',
		'banner',
		'link',
	]
];
