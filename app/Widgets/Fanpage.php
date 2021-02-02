<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;
class Fanpage extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'blade' => 1,
        'folder' => ''
    ];

    public function run()
    {
        $config = $this->config['data'];
        $view = !empty($this->config['folder']) ? 'widgets.fanpage.'.$this->config['folder'].'.'.$this->config['blade'] : 'widgets.fanpage.'.$this->config['blade'];

        return view($view, [
            'id' => $config['id'],
            'title' => @$config['config'][0]['value'],
            'title_fanpage' => @$config['config'][1]['value'],
            'fanpage' => @$config['config'][2]['value'],
            'height' => @$config['config'][3]['value'],
        ]);
    }
}