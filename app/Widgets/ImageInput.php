<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Website\Entities\Menu as MenuEntity;

class ImageInput extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'data' => [],
        'blade' => '1',
        'is_value' => false
    ];

    public function run()
    {
        $config = $this->config['data'];
        if($this->config['is_value']){
            return $config['value'];
        }
        
        $blade = !empty($config->widget_type) ? $config->widget_type : $this->config['blade'];
        return view('widgets.image_input.'.$blade,[
            'id' => @$config['id'],
            'title' => @$config['config'][0]['value'],
            'link' => @$config['config'][1]['value'],
            'img' => @$config['config'][2]['value'],
        ]);
    }
}