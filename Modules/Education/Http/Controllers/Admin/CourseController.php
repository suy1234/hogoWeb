<?php

namespace Modules\Education\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Education\Entities\Courses;
use Modules\Education\Http\Requests\SaveCourseRequest;
class CourseController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Courses::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'education::courses.course';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'education::admin.courses';
    protected $routePrefix = 'admin.courses';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveCourseRequest::class;
}
