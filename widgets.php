<?php
$widgets = [
	'menu' => [
		'sidebar' => [
			1 => [

			]
		],
		'footer' => [
			1 => [
				[
					'value' => '',
					'widget' => 'title',
					'label' => 'Tiêu đề',
				],[
					'label' => 'Chọn menu',
					'widget' => 'menu',
					'value' => '',
				]
				
			]
		],
		'post' => [
			1 => [
				[
					'value' => '',
					'widget' => 'title',
					'label' => 'Tiêu đề',
				],[
					'label' => 'Chọn menu',
					'widget' => 'menu',
					'value' => '',
				]
				
			]
		]
	],
	'header' => [
		1 => [
			[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tiêu đề website',
			],[
				'value' => '',
				'widget' => 'textarea',
				'label' => 'Mô tả ngắn',
			],[
				'value' => '',
				'widget' => 'image',
				'label' => 'Icon Tap',
			],[
				'value' => '',
				'widget' => 'image',
				'label' => 'Logo',
			],[
				'value' => '',
				'widget' => 'image',
				'label' => 'Logo mobile',
			],[
				'value' => '',
				'widget' => 'image',
				'label' => 'Icon menu',
			],[
				'label' => 'Chọn menu',
				'widget' => 'menu',
				'value' => '',
			],[
				'value' => 'Nhập từ khóa tìm kiếm',
				'widget' => 'title',
				'label' => 'Placeholder thanh tìm kiếm',
			]
		]
	],
	'fanpage' => [
		1 => [
			[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tiêu đề',
			],[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tên fanpage',
			],[
				'value' => '',
				'widget' => 'title',
				'label' => 'Đường dẫn fanpage',
			],[
				'value' => '350',
				'widget' => 'title',
				'label' => 'Chiều cao fanpage',
			]
		],
	],
	'content' => [
		1 => [
			[
				'label' => 'Nội dung',
				'widget' => 'content',
				'value' => '',
			]
		],
	],
	'social' => [
		'1' => [
			[
				'label' => 'fa fa-facebook',
				'widget' => 'form_icon',
				'value' => ''
			],
			[
				'label' => 'fa fa-twitter',
				'widget' => 'form_icon',
				'value' => ''
			],
			[
				'label' => 'fa fa-pinterest',
				'widget' => 'form_icon',
				'value' => ''
			],
			[
				'label' => 'fa fa-google-plus',
				'widget' => 'form_icon',
				'value' => ''
			],
			[
				'label' => 'fa fa-youtube',
				'widget' => 'form_icon',
				'value' => ''
			],
			[
				'label' => 'fa fa-instagram',
				'widget' => 'form_icon',
				'value' => ''
			],
		]
	],
	'newsletter' => [
		1 => [
			[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tiêu đề',
			],
			[
				'value' => '',
				'widget' => 'title',
				'label' => 'Input placeholder',
			],
			[
				'value' => '',
				'widget' => 'icon',
				'label' => 'Icon',
			],
			[
				'value' => '',
				'widget' => 'textarea',
				'label' => 'Ghi chú',
			],
		]
	],
	'image' => [
		1 => [
			[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tiêu đề',
			],[
				'value' => '',
				'widget' => 'title',
				'label' => 'Đường dẫn',
			],[
				'value' => '',
				'widget' => 'image',
				'label' => 'Logo mobile',
			],
		]
	],
	'slider' => [
		1 => [
			[
				'value' => '',
				'widget' => 'slider',
				'data' => [
					[
						[
							'value' => '',
							'widget' => 'title',
							'label' => 'Tiêu đề',
						],[
							'value' => '',
							'widget' => 'textarea',
							'label' => 'Mô tả',
						],[
							'value' => '',
							'widget' => 'title',
							'label' => 'Đường dẫn',
						],[
							'value' => '',
							'widget' => 'title',
							'label' => 'Nút xem chi tiết',
						],[
							'value' => '',
							'widget' => 'image',
							'label' => 'Logo mobile',
						],
					]
				]
			]
		]
	],
	'bank_package' => [
		'1' => [
			[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tiêu đề',
			],[
				'value' => '',
				'widget' => 'category',
				'label' => 'Danh mục',
				'type' => 'bank',
				'table' => 'categorys'
			],[
				'value' => '',
				'widget' => 'group',
				'label' => 'Nhóm',
				'type' => 'bank',
				'table' => 'groups'
			]
		],
		'2' => [
			[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tiêu đề',
			],[
				'label' => 'Nội dung',
				'widget' => 'content',
				'value' => '',
			],[
				'value' => '',
				'widget' => 'category',
				'label' => 'Danh mục',
				'type' => 'bank',
				'table' => 'categorys'
			],[
				'value' => '',
				'widget' => 'group',
				'label' => 'Nhóm',
				'type' => 'bank',
				'table' => 'groups'
			]
		],
	],
	'title' => [
		'1' => [
			[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tiêu đề',
			]
		],
	],
	'contact_form' => [
		'1' => [
			[
				'value' => '',
				'widget' => 'image',
				'label' => 'Ảnh nền',
			],[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tiêu đề',
			],[
				'value' => '',
				'widget' => 'title',
				'label' => 'Nút',
			],[
				'label' => 'Nội dung',
				'widget' => 'content',
				'value' => '',
			]
		],
	],
	'service' => [
		'1' => [
			'img' => '',
			'link' => '',
			'title' => '',
			'description' => '',
			'items' => [
				[
					'img' => '',
					'title' => '',
					'link' => '',
					'description' => '',
				]
			]
		],
	],
	'post' => [
		'1' => [
			[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tiêu đề',
			],[
				'value' => '',
				'widget' => 'category',
				'label' => 'Danh mục',
				'type' => 'post',
				'table' => 'categorys'
			],[
				'value' => '',
				'widget' => 'group',
				'label' => 'Nhóm',
				'type' => 'post',
				'table' => 'groups'
			]
		],
	],
	'banner' => [
		'1' => [
			[
				'value' => [],
				'widget' => 'banner',
				'label' => 'Ảnh',
			]
		]
	],
	'menu_sidebar' => [
		1 => [
			[
				'value' => '',
				'widget' => 'title',
				'label' => 'Tiêu đề',
			],[
				'value' => '',
				'widget' => 'menu',
				'label' => 'Menu',
				'table' => 'menus'
			]
		]
	],
];
?>