<?php

namespace Modules\Customer\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Customer\Entities\Customers;
use Modules\Customer\Http\Requests\SaveCustomerRequest;
class StudentController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Customers::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'customer::students.student';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'customer::admin.students';
    protected $routePrefix = 'admin.students';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveCustomerRequest::class;
    public function table(Request $request)
    {
        return $this->getModel()->tableStudent($request);
    }
}
