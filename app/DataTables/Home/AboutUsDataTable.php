<?php

namespace App\DataTables\Home;

use App\Models\AboutUs;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AboutUsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (AboutUs $aboutUs) {
                return view('pages.home.about_us.columns._actions', compact('aboutUs'));
            })
            ->editColumn('image_path', function ($aboutUs) {

                return '<img src="' . asset($aboutUs->image_path) . '" height="50"/>';
            })
            ->rawColumns(['image_path', 'action'])
            ->setRowId('id');
    }

    public function query(AboutUs $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('aboutus-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>")
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(1, 'asc');
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->visible(false),
            Column::make('image_path')->title('Image')->addClass('text-center'),
            Column::make('content_en')->title('Content')->addClass('text-center'),
            Column::make('content_ar')->title('Content (Arabic)')->addClass('text-center'),

            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(120),
        ];
    }

    protected function filename(): string
    {
        return 'AboutUs_' . date('YmdHis');
    }
}
