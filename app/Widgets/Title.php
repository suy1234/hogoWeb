<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;

class Title extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'blade' => 1,
        'is_value' => false
    ];

    public function run()
    {
        $config = $this->config['data'];
        if($this->config['is_value']){
            return $config['value'];
        }
        
        $data = $this->config['data'];
        $config = $data['config'];
        return view('widgets.title.'.$this->config['blade'], [
            'id' => $data['id'],
            'title' => !empty($config[0]) ? $config[0]['value'] : ''
        ]);
    }
}