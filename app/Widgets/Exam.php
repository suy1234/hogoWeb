<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;
use Modules\Question\Entities\Question;

class Exam extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'blade' => 1,
        'folder' => 'folder',
        'value' => '',
        'is_value' => false,
    ];

    public function run()
    {
        $config = $this->config['data'];
        if($this->config['is_value']){
            $questions = Question::with('answers', 'group_type')->where('group_type_id', $config['value'])->select('title', 'content', 'img', 'category_id', 'group_id', 'group_type_id', 'id')->get();
            return $questions->toArray();
        }
        $menus = MenuEntity::where('menu_id', $config['config'][1]['value'])->get(['title', 'url', 'icon']);
        return view('widgets.menu.'.$this->config['folder'].'.'.$this->config['blade'], [
            'id' => $config['id'],
            'title' => $config['config'][0]['value'],
            'menus' => $menus,
        ]);
    }
}