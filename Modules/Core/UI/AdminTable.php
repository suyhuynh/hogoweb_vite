<?php

namespace Modules\Core\UI;

use Illuminate\Contracts\Support\Responsable;
use Carbon\Carbon;

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
        'checkbox', 'thumbnail', 'status', 'created','valid', 'created_text', 'status_text', 'action'
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
            ->with([
                'start' => request()->start
            ])
            ->orderColumn('id', function ($query, $order) {
                $query->orderBy('id', $order);
            })
            ->addColumn('checkbox', function ($entity) {
                return view('core::layouts.partials.checkbox', compact('entity'));
            })
            ->addColumn('created_text', function ($entity) {
                return Carbon::parse($entity->created_at)->format('d-m-Y');
            })
            ->rawColumns(array_merge($this->defaultRawColumns, $this->rawColumns))
            ->removeColumn('translations');
    }

    public function toResponse($request)
    {
        return $this->make()->toJson();
    }
}