<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
class ContentView extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'data_view' => [],
        'blade' => 1,
    ];

    public function run()
    {
        $config = $this->config['data'];
        return view('widgets.content_view.'.$this->config['blade'], [
            'id' => $config['id'],
            'data' => $this->config['data_view'],
        ]);
    }
}