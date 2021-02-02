<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;

class ContactForm extends AbstractWidget
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
        $data = $this->config['data'];
        $config = $data['config'];
        return view('widgets.contact_form.'.$this->config['blade'], [
            'id' => $data['id'],
            'data' => $data['config'],
            'link' => ''
        ]);
    }
}