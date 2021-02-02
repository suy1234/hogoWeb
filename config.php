<?php
$themes = [
	'default' => [
		'font' => '',
		'font_size' => '14px',
		'post_list' => '',
		'product_list' => '',
	],
	'sidebar_product' => [
		'default' => [
			'has_show' => true,
			'style' => '1',
		],
		'widgets' => [
			[
				'widget' => 'menu',
				'sort' => 1,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Vị trí menu',
					'value' => ''
				]
			],
			[
				'widget' => 'image',
				'sort' => 2,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Hình ảnh',
					'value' => ''
				]
			],
			[
				'widget' => 'menu',
				'sort' => 3,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Vị trí menu',
					'value' => ''
				]
			],
			[
				'widget' => 'group',
				'sort' => 4,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Nhóm bài viết',
					'value' => ''
				]

			],
			[
				'widget' => 'textarea',
				'sort' => 5,
				'has_title' => true,
				'config' => [
					'title' => 'Fanpage facebook',
					'label' => 'Fanpage facebook',
					'value' => ''
				]

			],
			[
				'widget' => 'image',
				'sort' => 6,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Hình ảnh',
					'value' => ''
				]
			],
		],
	],
	'sidebar_post' => [
		'default' => [
			'has_show' => true,
			'style' => '1',
		],
		'widgets' => [
			[
				'widget' => 'menu',
				'sort' => 1,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Vị trí menu',
					'value' => ''
				]
			],
			[
				'widget' => 'image',
				'sort' => 2,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Hình ảnh',
					'value' => ''
				]
			],
			[
				'widget' => 'menu',
				'sort' => 3,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Vị trí menu',
					'value' => ''
				]
			],
			[
				'widget' => 'group',
				'sort' => 4,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Nhóm bài viết',
					'value' => ''
				]

			],
			[
				'widget' => 'textarea',
				'sort' => 5,
				'has_title' => true,
				'config' => [
					'title' => 'Fanpage facebook',
					'label' => 'Fanpage facebook',
					'value' => ''
				]

			],
			[
				'widget' => 'image',
				'sort' => 6,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Hình ảnh',
					'value' => ''
				]
			],
		],
	],
	'header' => [
		'default' => [
			'has_show' => true,
			'style' => '1',
		],
		'widgets' => [
			[
				'widget' => 'image',
				'sort' => 2,
				'config' => [
					'title' => '',
					'label' => 'Logo',
					'value' => ''
				]
			],
			[
				'widget' => 'image',
				'sort' => 2,
				'config' => [
					'title' => '',
					'label' => 'icon',
					'value' => ''
				]
			],
			[
				'widget' => 'menu',
				'sort' => 1,
				'config' => [
					'title' => '',
					'label' => 'Vị trí menu',
					'value' => ''
				]
			],
			[
				'widget' => 'title',
				'sort' => 5,
				'config' => [
					'title' => 'Tiêu đề tìm kiếm',
					'label' => 'Tiêu đề tìm kiếm',
					'value' => ''
				]

			],
		],
	],
	'fullpage' => [
		'default' => [
			'has_show' => true,
			'style' => '1',
		],
		'widgets' => [
			[
				'widget' => 'cool_call',
				'sort' => 1,
				'list' => true,
				'config' => [
					'title' => 'Liên hệ nhanh với chúng tôi',
					'label' => 'Icon Liên hệ nhanh',
					'list' => [
						[
							'title' => 'Click để gọi ngay',
							'img' => '/public/web/alocool/img/phone_callto.png',
							'link' => 'tel:0931156818',
						],
						[
							'title' => 'Chat trực tuyến',
							'img' => '/public/web/alocool/img/mgchat.png',
							'link' => '',
						],
						[
							'title' => 'Nhắn tin SMS',
							'img' => '/public/web/alocool/img/sms_cool.png',
							'link' => 'sms:0931156818',
						],
						[
							'title' => 'Nhắn tin Zalo',
							'img' => '/public/web/alocool/img/sms_zalo.png',
							'link' => 'https://zalo.me/0931156818',
						],
					] 
				]
			],
			[
				'widget' => 'social',
				'sort' => 2,
				'list' => true,
				'config' => [
					'title' => 'Mạng xã hội',
					'label' => 'Mạng xã hội',
					'list' => [
						[
							"title" => "Facebook",
							"icon" => "fa fa-facebook",
							"link" => ""
						],
						[
							"title" => "Google",
							"icon" => "fa fa-google-plus",
							"link" => ""
						],
						[
							"title" => "Youtube",
							"icon" => "fa fa-youtube",
							"link" => ""
						],
						[
							"title" => "Twitter",
							"icon" => "fa fa-twitter",
							"link" => ""
						],
						[
							"title" => "Pinterest",
							"icon" => "fa fa-pinterest",
							"link" => ""
						],
						[
							"title" => "Instagram",
							"icon" => "fa fa-instagram",
							"link" => ""
						],
						[
							"title" => "Flickr",
							"icon" => "fa fa-flickr",
							"link" => ""
						],
						[
							"title" => "Slide Share",
							"icon" => "fa fa-slideshare",
							"link" => ""
						],
						[
							"title" => "Tumblr",
							"icon" => "fa fa-tumblr",
							"link" => ""
						],
						[
							"title" => "Linked in",
							"icon" => "fa fa-linkedin",
							"link" => ""
						],
					],
				]
			],
		],
	],
	'footer' => [
		'default' => [
			'has_show' => true,
			'style' => '1',
		],
		'widgets' => [
			[
				'widget' => 'editor',
				'sort' => 1,
				'config' => [
					'title' => 'Nội dung',
					'label' => 'Nội dung',
					'value' => ''
				]
			],
			[
				'widget' => 'menu',
				'sort' => 2,
				'has_title' => true,
				'config' => [
					'title' => '',
					'label' => 'Vị trí menu',
					'value' => ''
				]
			],
			[
				'widget' => 'contact',
				'sort' => 3,
				'config' => [
					'title' => '',
					'label' => 'Liên hệ',
					'value' => ''
				]
			],
			[
				'widget' => 'textarea',
				'sort' => 5,
				'has_title' => true,
				'config' => [
					'title' => 'Fanpage facebook',
					'label' => 'Fanpage facebook',
					'value' => ''
				]

			],
		],
	],
];
?>