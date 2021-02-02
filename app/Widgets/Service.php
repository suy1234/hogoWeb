<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class service extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'blade' => '1',
    ];

    public function run()
    {
        return view('widgets.service.'.$this->config['blade'], [
            'data' => $this->config['data']['config'],
            'id' => $this->config['data']['id'],
        ]);
    }
}
