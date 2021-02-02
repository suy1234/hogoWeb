<?php

namespace Modules\Education\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Education\Entities\Schedules;
use Modules\User\Entities\User;
use Modules\Education\Entities\Subjects;
use Modules\Education\Http\Requests\SaveScheduleRequest;
class ScheduleController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Schedules::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'education::schedules.schedule';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'education::admin.schedules';
    protected $routePrefix = 'admin.schedules';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveScheduleRequest::class;

    public function getResourceData()
    {
        return [
            'users' => User::where('position_id', 5)->get()->pluck('fullname', 'id'),
            'subjects' => Subjects::get()->pluck('title', 'id'),
        ];
    }
}
