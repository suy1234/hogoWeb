<?php

namespace Modules\Website\Services;
class Layout
{
	public function save($data)
	{
		return Layout::create([
            'page_id' => $data['id'],
            'class' => $data['row'],
            'widget' => $data['widget']
        ]);
	}
}