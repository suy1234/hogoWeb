<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Website\Entities\Menu;

class MenuSidebar extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'blade' => 1,
    ];

    public function run()
    {
        $config = $this->config['data'];
        $menus = Menu::where('menu_id', $config['config'][1]['value'])->get(['title', 'url', 'icon']);
        return view('widgets.menu.sidebar.'.$this->config['blade'], [
            'id' => $config['id'],
            'title' => $config['config'][0]['value'],
            'menus' => $menus,
        ]);
    }
}