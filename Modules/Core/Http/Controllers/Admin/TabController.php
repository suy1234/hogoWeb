<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Tab;
use Modules\Core\Http\Requests\SaveTabRequest;
class TabController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Tab::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'core::taps';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'core::admin.taps';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveTabRequest::class;
}
