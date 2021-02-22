<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Widget\Entities\WidgetTheme;

class LayoutController extends Controller
{
    public function get(Request $request)
    {
        if(!empty($request->ids)){
            $data = WidgetTheme::whereIn('id', $request->ids)->select('css', 'js')->get();
            if(count($data)){
                // foreach ($data as $value) {
                //     $value->view += 1;
                //     $value->save();
                // }
                return response()->json(['success' => true, 'data' => $data]);
            }
        }
        return response()->json(['success' => false, 'msg' => 'Không có giá trị truyền vào']);
    }
}
