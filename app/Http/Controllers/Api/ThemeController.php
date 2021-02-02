<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Website\Entities\Layout;
use DB;
class ThemeController extends Controller
{
    public function getConfig(Request $request)
    {
        $data = Layout::find($request->id);
        $table_data = [];
        if(!empty($data)){
            $has_database = !empty($data->widget_id) ? true : false;
        	if(empty($data->config)){
                include_once ('widgets.php');
                if(!empty($data->widget_id)){
                    $data->config = include_once (resource_path('views/widgets/themes/'.$data->widget_type.'/config.php'));
                    $has_database = true;
                }else{
                    if( is_numeric($data->widget_type)){
                        $data->config = $widgets[$data->widget][$data->widget_type];
                    }else{
                        $data->config = $widgets[$data->widget][$data->widget_type][1];
                    }   
                }
        	}
            $data_table = collect($data->config)->filter(function($item){
                return !empty($item['table']);
            });
            if(count($data_table)){
                foreach ($data_table as $table) {
                    $res_table = DB::table($table['table']);
                    if(!empty($table['type'])){
                        $res_table = $res_table->where('type', $table['type'])->where('status', 1);
                    }
                    $res_table = $res_table->get()->pluck('title', 'id');
                    $table_data[$table['table']] = $res_table;
                }   
            }
            return response()->json(['success' => true, 'has_database' => $has_database,'form' => ['config' => $data->config, 'widget' => $data->widget, 'widget_type' => $data->widget_type, 'table_data' => $table_data]]);   
        }
        return response()->json(['success' => false]);
    }

    public function save(Request $request)
    {
        if(!empty($request->id)){
            $input = $request->all();
            $input['config'] = json_encode($input['config']);unset($input['table_data']);
            return response()->json(['success' => Layout::where('id', $request->id)->update($input) ]);   
        }
        return response()->json(['success' => false]);
    }
}
