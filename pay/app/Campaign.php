<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'campaign', 'campaign_key','register_thankyou_url','payment_thankyou_url','gg_sheet_link','start_at','end_at'
    ];

}
