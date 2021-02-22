<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;

class CodeJs extends AbstractWidget
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
        return view('widgets.code_js.'.$this->config['blade'], [
            'id' => $config['id'],
            'data' => $config['config']
        ]);
    }
}