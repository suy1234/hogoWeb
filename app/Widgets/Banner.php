<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;

class Banner extends AbstractWidget
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
        $banner = !empty($this->config['data']['config']) ? $this->config['data']['config'][0]['value'][array_rand($this->config['data']['config'][0]['value'])] : [
            'title' => '',
            'link' => '',
            'image' => '',
        ];
        $blade = !empty($this->config['blade']) ? $this->config['blade'] : $this->config['data']['widget_type'];
        return view('widgets.banner.'.$blade, [
            'data' => $banner,
            'id' => @$this->config['data']['id'],
        ]);
    }
}