<?php

namespace Modules\Core\Admin;

use Illuminate\Contracts\Support\Responsable;

class AdminTable implements Responsable
{
    /**
     * Raw columns that will not be escaped.
     *
     * @var array
     */
    protected $rawColumns = [];

    /**
     * Raw columns that will not be escaped.
     *
     * @var array
     */
    protected $defaultRawColumns = [
        'checkbox', 'thumbnail', 'status', 'created','valid'
    ];

    /**
     * Source of the table.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $source;

    /**
     * Create a new table instance.
     *
     * @param \Illuminate\Database\Eloquent\Builder $source
     * @return void
     */
    public function __construct($source = null)
    {
        $this->source = $source;
    }

    /**
     * Make table response for the resource.
     *
     * @param mixed $source
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable();
    }

    /**
     * Create a new datatable instance;
     *
     * @param mixed $source
     * @return \Yajra\DataTables\DataTables
     */
    public function newTable()
    {
        return datatables($this->source)
            // ->addColumn('checkbox', function ($entity) {
            //     return view('admin::partials.table.checkbox', compact('entity'));
            // })
            // ->editColumn('status', function ($entity) {
            //     return $entity->is_active
            //         ?'<span class="badge badge-mark bg-success border-success"></span>'
            //         : '<span class="badge badge-mark bg-danger border-danger"></span>';
            // })
            //  ->addColumn('valid', function ($entity) {
            //    if(array_key_exists('from_date', $entity->getAttributes()) && array_key_exists('to_date', $entity->getAttributes())){
            //      return  $entity->valid()
            //         ? '<span class="badge badge-mark bg-success border-success"></span>'
            //         : '<span class="badge badge-mark bg-danger border-danger"></span>';
            //    }
            // })
            //  ->editColumn('from_date', function ($entity) {
            //     return date('d-m-Y H:i',strtotime($entity->from_date));
            // })
            //  ->editColumn('to_date', function ($entity) {
            //     return date('d-m-Y H:i',strtotime($entity->to_date));
            // })
            // ->editColumn('created', function ($entity) {
            //     return view('admin::partials.table.date')->with('date', $entity->created_at);
            // })
            ->rawColumns(array_merge($this->defaultRawColumns, $this->rawColumns))
            ->removeColumn('translations');
    }

    public function toResponse($request)
    {
        return $this->make()->toJson();
    }
}
