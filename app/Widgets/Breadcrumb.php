<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;
class Breadcrumb extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'data_view' => [],
        'blade' => '1',
    ];

    public function run()
    {   
        return view('widgets.breadcrumb.'.$this->config['blade'], [
            'links' => $this->getUrlFull($this->config['data_view'])
        ]);
    }

    public function getUrlFull($data)
    {
        $param = [
            [
                'title' => 'Trang chủ',
                'link' => url('/'),
                'icon' => ''
            ],
        ];
        if(!empty($data->category)){
            $param[] = [
                'title' => $data->category->title,
                'link' => url('/').'/'.$data->category->alias,
                'icon' => ''
            ];
        }

        $param[] = [
            'title' => $data->title,
            'link' => url('/').'/'.$data->alias,
            'icon' => ''
        ];
        return $param;
    }
}