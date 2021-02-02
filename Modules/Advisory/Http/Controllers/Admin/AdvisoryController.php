<?php

namespace Modules\Advisory\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Advisory\Entities\Advisory;
use Modules\Advisory\Http\Requests\SaveAdvisoryRequest;
class AdvisoryController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Advisory::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'advisory::advisorys.advisory';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'advisory::admin.advisorys';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveAdvisoryRequest::class;
}
