<?php

namespace App\Http\Controllers\Admin;
use App\Traits\RestControllerTrait;
use  App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Http\Request;
use App\Transaction;
use App\Coupon;

class CampaignController extends AdminBaseController
{
    use RestControllerTrait;
    const MODEL = 'App\Campaign';
    protected $validationRules = ['campaign' => 'required', 'start_at' => 'required', 'end_at' => 'required'];

    public function transactions($campaign_id){
        $data= Transaction::where('campaign_id',$campaign_id)->get();
        return view('admin.campaign.transactions',compact('data'));
    }

     public function coupons($campaign_id){
        $data= Coupon::where('campaign_id',$campaign_id)->get();
        return view('admin.campaign.coupon.index',compact('data','campaign_id'));
    }

    public function createCoupon($campaign_id){
        return view('admin.campaign.coupon.create',compact('campaign_id'));
    }

     public function storeCoupon($campaign_id,Request $request){
        $request->campaign_id = $campaign_id;
        // Coupon::create($request->all());
        return redirect('/admin/campaign/'.$campaign_id.'/coupons');
    }
}


