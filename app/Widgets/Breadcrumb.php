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
    protected $config = [];

    public function run()
    {   
        if($this->config['is_value']){
            return [
                'breadcrumb' => $this->getUrlFull($this->config['entity']),
                'img' => $this->config['entity']->img,
                'gallerys' => $this->config['entity']->gallerys,
            ];
        }
        return view('widgets.breadcrumb.'.$this->config['blade'], [
            'links' => $this->getUrlFull(1)
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
            if(!empty($data->category->parent)){
                $param[] = [
                    'title' => $data->category->parent->title,
                    'link' => url('/').'/'.$data->category->parent->alias,
                    'icon' => ''
                ];
            }
            $param[] = [
                'title' => $data->category->title,
                'link' => url('/').'/'.$data->category->alias,
                'icon' => ''
            ];
        }
        return [
            'list' => $param,
            'this_breadcrumb' => [
                'title' => $data->title,
                'link' => url('/').'/'.$data->alias,
                'icon' => ''
            ]
        ];
    }
}