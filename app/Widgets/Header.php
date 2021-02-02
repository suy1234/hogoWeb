<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;
use Modules\Website\Entities\Menu as MenuEntity;
class Header extends AbstractWidget
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
        return view('widgets.header.'.$this->config['blade'], [
            'id' => $config['id'],
            'data' => !empty($config['config']) ? $config['config'] : '',
            'menu' => !empty($config['config'][6]) ? MenuEntity::where('menu_id', $config['config'][6]['value'])->get(['title', 'url', 'icon']) : [],
        ]);
    }
}