<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;

class BankPackage extends AbstractWidget
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
        $bank_interest_rate = (new BankInterestRate())->newQuery()->withoutGlobalScopes();
  
        $category = collect($this->config['data']['config'])->first(function ($value, $key) {
            return $value['widget'] == 'category';
        });
        if(!empty($category)){
            $bank_interest_rate = $bank_interest_rate->where('category_id', $category['value']);
        }

        $group = collect($this->config['data']['config'])->first(function ($value, $key) {
            return $value['widget'] == 'group';
        });
        if(!empty($group)){
            $bank_interest_rate = $bank_interest_rate->where('group_id', $group['value']);
        }
        $blade = !empty($this->config['data']['widget_type']) ? $this->config['data']['widget_type'] :$this->config['blade'];
        return view('widgets.bank_package.'.$blade, [
            'data' => $this->config['data']['config'],
            'id' => $this->config['data']['id'],
            'bank_interest_rates' => $bank_interest_rate->with('bank', 'category', 'group')->get()
        ]);
    }
}