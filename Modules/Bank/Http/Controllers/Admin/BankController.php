<?php

namespace Modules\Bank\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Bank\Entities\Bank;
use Modules\Bank\Http\Requests\SaveBankRequest;
class BankController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Bank::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'bank::banks.bank';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'bank::admin.banks';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveBankRequest::class;
}
