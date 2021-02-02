<?php

namespace Modules\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\App\Traits\HasCrudActions;
use Modules\Core\Entities\Category;
use Modules\Question\Entities\Question;
use Modules\Question\Http\Requests\SaveQuestionRequest;
class DashboardController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'app::apps';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'app::admin';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveQuestionRequest::class;

    public function index(Request $request)
    {
        return view('app::admin.index');
    }
}
