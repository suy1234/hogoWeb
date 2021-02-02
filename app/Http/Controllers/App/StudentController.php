<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Customer\Entities\Customers;
class StudentController extends Controller
{
    public function test(){
        $customer = Customers::first();
        $customer->avatar = !empty($customer->avatar) ? $customer->avatar : '';
        return response()->json(['success' => true, 'data' => $customer]);
    }
    public function register(Request $request)
    {
        $data = $request->all();
        $data['type'] = 'student';
        $data['avatar'] = upload($data['avatar'], $data['fullname'], 'uploads/student/avatar');
        $data['cmnd_back'] = upload($data['cmnd_back'], $data['fullname'], 'uploads/cmnd/back');
        $data['cmnd_front'] = upload($data['cmnd_front'], $data['fullname'], 'uploads/cmnd/front');
        $customer = new Customers();
        $data = collect($data)->only([
            "address",
            "avatar",
            "cmnd_back",
            "cmnd_front",
            "email",
            "fullname",
            "note",
            "password",
            "phone"
        ]);
        \DB::beginTransaction();
            $customer = $customer->create($data->toArray());
        \DB::commit();
        if(!empty($customer->id)){
            return response()->json(['success' => true, 'data' => $customer]);
        }
        else{
            return response()->json(['success' => false, 'msg' => trans('Có lỗi trong quá trình tạo tài khoản vui long kiểm tra lại')]);
        }
    }
}
