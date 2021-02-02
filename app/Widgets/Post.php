<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Website\Entities\Post as PostEntity;

class Post extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'blade' => '1',
        'limit' => 8
    ];

    public function run()
    {
        $posts = (new PostEntity())->newQuery()->withoutGlobalScopes();

        $category = collect($this->config['data']['config'])->first(function ($value, $key) {
            return $value['widget'] == 'category';
        });
        if(!empty($category['value'])){
            $posts = $posts->where('category_id', $category['value']);
        }

        $group = collect($this->config['data']['config'])->first(function ($value, $key) {
            return $value['widget'] == 'group';
        });
        if(!empty($group['value'])){
            $posts = $posts->where('group_ids', 'link', '%"'.$group['value'].'"%');
        }

        $blade = !empty($this->config['data']['widget_type']) ? $this->config['data']['widget_type'] : $this->config['blade'];
        return view('widgets.post.'.$blade, [
            'data' => $this->config['data']['config'],
            'id' => $this->config['data']['id'],
            'posts' => collect($posts->with('seo')->limit($this->config['limit'])->get())
        ]);
    }
}