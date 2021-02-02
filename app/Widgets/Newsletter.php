<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;
use Modules\Website\Entities\Menu as MenuEntity;

class Newsletter extends AbstractWidget
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
        return view('widgets.newsletter.'.$this->config['blade'], [
            'id' => $config['id'],
            'data' => !empty($config['config']) ? $config['config'] : [],
        ]);
    }
}