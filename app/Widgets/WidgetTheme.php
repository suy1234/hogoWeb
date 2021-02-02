<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Bank\Entities\BankInterestRate;
use DB;
use Widget;
class WidgetTheme extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */

    protected $config = [
        'data' => [],
        'blade' => 1,
    ];

    public function run()
    {
        $config = $this->config['data'];
        $dataSendView = [];
        if(!empty($config['config'])){
            $data = $config['config'];
            foreach ($data as $key => $value) {
                if(!empty($value['widget'])){
                    $dataSendView[$key] = (array) Widget::run($value['widget'], ['data' => $value, 'is_value' => true]);
                    $dataSendView[$key] = $dataSendView[$key]["\x00*\x00html"];
                }else{
                    $dataSendView[$key] = self::getDataWidget($value);
                }
            }
        }

        return view('widgets.themes.index', [
            'blade' => $config['widget_type'],
            'id' => $config['id'],
            'data' => $dataSendView
        ]);
    }

    private function getDataWidget($data)
    {
        $item = [];
        if(count($data)){
            foreach ($data as $key => $value) {
                if(!empty($value['value'])){
                    $item[$key] = (array) Widget::run($value['widget'], ['data' => $value, 'is_value' => true]);
                    $item[$key] = $item[$key]["\x00*\x00html"];
                }else{
                    $item[$key] = $value;
                }
            }
        }
        return $item;
    }
}