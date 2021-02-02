<?php

namespace Modules\Customer\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Customer\Entities\Customers;
use Modules\Customer\Entities\CustomerITs;
use Modules\Customer\Exports\Customer;
use Modules\Customer\Http\Requests\SaveCustomerRequest;
use Modules\Customer\Exports\ExportCustomer;

class CustomerController extends Controller
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
    protected $label = 'customer::customers.customer';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'customer::admin';
    protected $routePrefix = 'admin.customers';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveCustomerRequest::class;

    public function index(Request $request)
    {
        if ($request->has('table')) {
            return $this->getModel()->table($request);
        }
        if ($request->has('export')) {
            return $this->export($request);
        }
        $data = $this->getResourceData();

        return view("{$this->viewPath}.index", $data);
    }

    public function export($request)
    {
        $request->request->add(['filter' => $request]);
        return (new ExportCustomer($request))->download('kh-'.date('d-m-Y-h-i-s').'.xlsx');
    }
}
