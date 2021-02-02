<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps  = false;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'content',
        'quantity',
        'amount',
        'course',
        'campaign',
        'coupon',
        'status',
        'payment_complete_email_sent',
        'sheet_id',
        'transaction_code',
        'paid_via',
        'paid_date',
        'note',
        'referal',
        'created_date',
        'utm_source',
        'client_ip',
        'full_url',
        'order_id',
    ];
}
