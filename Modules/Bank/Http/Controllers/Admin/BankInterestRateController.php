<?php

namespace Modules\Bank\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Bank\Entities\Bank;
use Modules\Core\Entities\Category;
use Modules\Core\Entities\Groups;
use Modules\Bank\Entities\BankInterestRate;
use Modules\Bank\Http\Requests\SaveBankInterestRateRequest;
class BankInterestRateController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = BankInterestRate::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'bank::banks.interest_rate';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'bank::admin.interest_rates';
    protected $routePrefix = 'admin.interest_rates';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveBankInterestRateRequest::class;

    public function getResourceData()
    {
        return [
            'banks' => Bank::all()->pluck('title', 'id'),
            'categorys' => Category::where('type', 'bank')->get()->pluck('title', 'id'),
            'groups' => Groups::where('type', 'bank')->get()->pluck('title', 'id'),
        ];
    }
}
