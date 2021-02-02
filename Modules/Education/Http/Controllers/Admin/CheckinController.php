<?php

namespace Modules\Education\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Education\Entities\Checkins;
use Modules\User\Entities\User;
class CheckinController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Checkins::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'education::checkins.checkin';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'education::admin.checkins';
    protected $routePrefix = 'admin.checkins';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
}
