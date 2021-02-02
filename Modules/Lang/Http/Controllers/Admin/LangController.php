<?php

namespace Modules\Lang\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Traits\HasCrudActions;
use Modules\Lang\Entities\Lang;
use Modules\Lang\Http\Requests\SaveLangRequest;
class LangController extends Controller
{
    use HasCrudActions;
    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Lang::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'lang::langs.lang';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'lang::admin';
    protected $routePrefix = 'admin.langs';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveLangRequest::class;

    public function store()
    {
        $this->disableSearchSyncing();
        \DB::beginTransaction();
        $entity = $this->getModel()->create(
            $this->getRequest('store')->all()
        );
        $content = "<?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class Position extends Migration
        {
            public function up()
            {
                DB::unprepared('
                ALTER TABLE `categorys` 
                ADD COLUMN `content_".request()->code."` TEXT NULL AFTER `updated_at`,
                ADD COLUMN `description_".request()->code."` VARCHAR(512) NULL AFTER `content_".request()->code."`,
                ADD COLUMN `title_".request()->code."` VARCHAR(255) NULL AFTER `description_".request()->code."`,
                ADD COLUMN `created_by_".request()->code."` INT(5) NULL AFTER `title_".request()->code."`;
                ');
            }
            public function down()
            {
            }
        }
        ";
        $fp = fopen(database_path('migrations/') . date("Y_m_d_His")."_update_form_lang.php","wb");
        fwrite($fp,$content);
        fclose($fp);
        \DB::commit();
        $this->searchable($entity);

        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($entity);
        }
        return response()->json(['success' => true, 'resource' => $this->getLabel().' '.trans('validation.attributes.create_success'), 'url' => route("{$this->getRoutePrefix()}.index")]);
    }
}
