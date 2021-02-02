<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\App\Entities\AppModel;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Builder;
class CustomerITs extends AppModel
{
    protected $module = 'customer';
    protected $table = 'img_customer';
}
