<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;

class Slider extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'blade' => 1
    ];

    public function run()
    {
        $config = $this->config['data'];
        return view('widgets.slider.'.$this->config['blade'], [
            'id' => $config['id'],
            'data' => $config['config']
        ]);
    }
}