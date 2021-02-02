<?php

namespace Modules\Education\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Education\Entities\Classs;
use Modules\Education\Entities\Courses;
use Modules\Education\Entities\Subjects;
use Modules\Education\Http\Requests\SaveClassRequest;
use Modules\User\Entities\User;
class ClassController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Classs::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'education::classs.class';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'education::admin.class';
    protected $routePrefix = 'admin.classs';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveClassRequest::class;
    public function getResourceData()
    {
        return [
            'courses' => Courses::all()->pluck('title', 'id'),
            'subjects' => Subjects::all()->pluck('title', 'id'),
            'teachers' => User::where('position_id', 5)->get()->pluck('fullname', 'id'),
        ];
    }

    public function subject(Request $request)
    {
        $subject = Subjects::find($request->id);
        if(!empty($subject)){
            $date = [];
            switch ($subject->unit_id) {
                case '10':
                    $date = [
                        'graduation_exam' => date('Y-m-d', strtotime('+'.$subject->time.' month')),
                        'driving_exam_provisional' => date('Y-m-d', strtotime('+'.($subject->time + 1).' month')),
                    ];
                    break;
                default:
                    return response()->json(['success' => false]);
                    break;
            }
            return response()->json(['success' => true, 'data' => $date]);
        }
        return response()->json(['success' => false]);
    }
}
