<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\User\Entities\User;
use Modules\User\Entities\Department;
use Modules\User\Entities\Position;
use Modules\User\Entities\Role;
use Modules\User\Http\Requests\SaveUserRequest;
class UserController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'user::users.user';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'user::admin.users';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveUserRequest::class;
    public function edit($id)
    {
        $user = $this->getEntity($id);
        $user->password = '';
        unset($user->permissions);
        $data = array_merge([
            $this->getResourceName() => $user,
        ], $this->getFormData('edit', $id), $this->getResourceData(), $this->getConfig());
        return view("{$this->viewPath}.edit", $data);
    }

    public function getResourceData()
    {
        $data['positions'] = Position::all()->pluck('title', 'id');
        $data['departments'] = Department::all()->pluck('title', 'id');
        $data['roles'] = Role::all()->pluck('title', 'id');
        return $data;
    }
}
