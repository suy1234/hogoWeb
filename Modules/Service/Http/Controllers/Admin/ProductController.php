<?php

namespace Modules\Service\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Service\Entities\Service;
use Modules\Service\Http\Requests\SaveServiceRequest;

class ServiceController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'service::services.service';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'service::admin';
    protected $routePrefix = 'admin.services';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveServiceRequest::class;
}
