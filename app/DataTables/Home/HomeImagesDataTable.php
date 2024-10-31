<?php

namespace App\DataTables\Home;

use App\Models\Home;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Storage;

class HomeImagesDataTable extends DataTable
{
public function dataTable(QueryBuilder $query): EloquentDataTable
{
return (new EloquentDataTable($query))
->addColumn('action', function (Home $home) {
return view('pages.home.images.columns._actions', compact('home'));
})
->editColumn('image_path', function ($home) {

    return '<img src="' . asset($home->image_path) . '" height="50"/>';

})
->rawColumns(['image_path', 'action'])
->setRowId('id');
}

public function query(Home $model): QueryBuilder
{
return $model->newQuery();
}

public function html(): HtmlBuilder
{
return $this->builder()
->setTableId('homeimages-table')
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
    Column::make('image_title_en')->title('Image Title')->addClass('text-center'),
    Column::make('image_title_ar')->title('Image Title (Arabic)')->addClass('text-center'),

    Column::make('sort_order')->title('Sort Order')->addClass('text-center'),
Column::computed('action')
    ->addClass('text-end text-nowrap')
->exportable(false)
->printable(false)
->width(120)
];
}

protected function filename(): string
{
return 'HomeImages_' . date('YmdHis');
}
}
