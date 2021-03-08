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
        'entity' => [],
    ];

    public function run()
    {
        $config = $this->config['data'];
        $dataSendView = [];
        if(!empty($config['config'])){
            $data = $config['config'];
            foreach ($data as $key => $value) {
                if(!empty($value['widget'])){
                    $dataSendView[$key] = (array) Widget::run($value['widget'], ['data' => $value, 'is_value' => true, 'entity' => $this->config['entity']]);
                    $dataSendView[$key] = $dataSendView[$key]["\x00*\x00html"];
                }else{
                    $dataSendView[$key] = self::getDataWidget($value);
                }
            }
        }

        if(!empty($config['has_database'])){
            $dataSendView['entity'] = $this->config['entity'];
        }

        if(request()->has('exam')){
            $ids = explode(',', request()->exam);
            $dataSendView['questions'] = ((array) Widget::run('exam', ['data' => ['category_id' => $ids[0], 'exam_id' => @$ids[1]], 'is_value' => true]))["\x00*\x00html"];
        }

        return view('widgets.themes.index', [
            'blade' => $config['widget_type'],
            'id' => $config['id'],
            'data' => $dataSendView,
            'entity' => $this->config['entity']
        ]);
    }

    private function getDataWidget($data)
    {
        $item = [];
        if(count($data)){
            foreach ($data as $key => $value) {
                if(!empty($value['widget'])){
                    $item[$key] = (array) Widget::run($value['widget'], ['data' => $value, 'is_value' => true, 'entity' => $this->config['entity']]);
                    $item[$key] = $item[$key]["\x00*\x00html"];
                }else{
                    $item[$key] = $value;
                }
            }
        }
        return $item;
    }
}