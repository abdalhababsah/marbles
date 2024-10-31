<?php

namespace App\DataTables\Catalog;

use App\Models\VariantType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VariantTypesDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (VariantType $variantType) {
                return view('pages.catalog.variant_types.columns._actions', compact('variantType'));
            })
            ->setRowId('id');
    }

    public function query(VariantType $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('variant-types-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>")
            ->orderBy(1); // Adjust order by column index as needed
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->visible(false),
            Column::make('name_en')->title('Name (English)')->addClass('d-flex align-items-center'),
            Column::make('name_ar')->title('Name (Arabic)')->addClass('text-center'),

            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(120),
        ];
    }

    protected function filename(): string
    {
        return 'VariantTypes_' . date('YmdHis');
    }
}
