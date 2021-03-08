<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;
use Modules\Website\Entities\Menu as MenuEntity;

class Menu extends AbstractWidget
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
            return MenuEntity::where('parent_id', 0)->where('menu_id', $config['value'])->orderBy('order')->select('title', 'url', 'icon', 'id')->get()->toArray();
        }
        $menus = MenuEntity::where('menu_id', $config['config'][1]['value'])->get(['title', 'url', 'icon']);
        return view('widgets.menu.'.$this->config['folder'].'.'.$this->config['blade'], [
            'id' => $config['id'],
            'title' => $config['config'][0]['value'],
            'menus' => $menus,
        ]);
    }
}