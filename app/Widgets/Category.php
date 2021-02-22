<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;
use Modules\Core\Entities\Category as CategoryEntity;

class Category extends AbstractWidget
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
        $select = [
            'id', 
            'title',
            'parent_id',
            'group_ids',
            'group_type_ids',
            'description',
            'content',
            'img',
            'slider'
        ];
        $config = $this->config['data'];
        if($this->config['is_value']){
            $category = CategoryEntity::where('id', $config['value'])->select($select)->first();
            if(!empty($category)){
                switch ($config['type']) {
                    case 'question':
                        $group_type_questions = $category->questions()->with('group_type')->select('group_type_id')->groupBy('questions.group_type_id')->get()->toArray();
                        $category->group_type_questions = array_column($group_type_questions, 'group_type');
                        break;
                }
                $category = $category->toArray();
            }
            return $category;
        }
        return view('widgets.menu.'.$this->config['folder'].'.'.$this->config['blade'], [
            'id' => $config['id'],
            'title' => $config['config'][0]['value'],
            'category' => CategoryEntity::where('id', $config['value'])->select($select)->first()->toArray(),
        ]);
    }
}