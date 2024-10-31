<?php

namespace App\DataTables\Catalog;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Category $category) {
                return view('pages.catalog.categories.columns._actions', compact('category'));
            })
            ->editColumn('icon_path', function ($category) {
                return '<img src="' . asset($category->icon_path) . '" height="50"/>';
            })
            ->rawColumns(['icon_path', 'action'])
            ->setRowId('id');
    }

    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('categories-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>")
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->visible(false),
            Column::make('name_en')->title('Name')->addClass('text-center'),
            Column::make('name_ar')->title('Name (Arabic)')->addClass('text-right'),

            Column::make('icon_path')->title('Icon')->addClass('text-center'),
            Column::make('slug')->title('Slug')->addClass('text-center'),
            Column::make('description_en')->title('Description')->addClass('text-center'),
            Column::make('description_ar')->title('Description (Arabic)')->addClass('text-center'),

            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(120)];
    }

    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
