<?php

namespace Modules\Education\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Education\Entities\Subjects;
use Modules\Education\Http\Requests\SaveSubjectRequest;
use Modules\Core\Entities\Units;
class SubjectController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Subjects::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'education::subjects.subject';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'education::admin.subjects';
    protected $routePrefix = 'admin.subjects';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveSubjectRequest::class;

    public function getResourceData()
    {
        return [
            'units' => Units::where('type', 'question')->get()->pluck('title', 'id'),
        ];
    }
}
