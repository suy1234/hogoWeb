<?php
return [
    [
        'table' => 'categorys',
		'type' => 'question',
		'value' => '28',
		'widget' => 'title',
		'label' => 'Số câu đạt (28/35)',
    ],[
		[
			'value' => '',
			'widget' => 'title',
			'label' => 'Tiêu đề',
		],[
			'value' => '',
			'widget' => 'content',
			'label' => 'Nội dung',
		],[
			'label' => 'Chọn danh mục',
			'widget' => 'category',
			'value' => '',
			'table' => 'categorys',
			'type' => 'question'
		],
	],[
		[
			'value' => '',
			'widget' => 'title',
			'label' => 'Tiêu đề',
		],[
			'label' => 'Chọn danh mục',
			'widget' => 'category',
			'value' => '',
			'table' => 'categorys',
			'type' => 'question'
		],[
			'value' => '',
			'widget' => 'content',
			'label' => 'Nội dung',
		],
	]
];
?>