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
            $menus = MenuEntity::where('menu_id', $this->config['is_value'])->get(['title', 'url', 'icon']);
            return $menus->toArray();
        }
        $menus = MenuEntity::where('menu_id', $config['config'][1]['value'])->get(['title', 'url', 'icon']);
        return view('widgets.menu.'.$this->config['folder'].'.'.$this->config['blade'], [
            'id' => $config['id'],
            'title' => $config['config'][0]['value'],
            'menus' => $menus,
        ]);
    }
}