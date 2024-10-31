<?php
namespace App\DataTables\Home;

use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\HtmlString;
class ContactUsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (ContactUs $contactUs) {
                return view('pages.home.contact_us.columns._actions', compact('contactUs'));
            })
            ->addColumn('seen', function (ContactUs $contactUs) {
                // Use Blade's @if directive to conditionally render the badge
                if ($contactUs->seen == 1) {
                    return new HtmlString('<span class="badge bg-success">Yes</span>');
                } else {
                    return new HtmlString('<span class="badge bg-danger">No</span>');
                }
            })
            ->setRowId('id');
    }

    public function query(ContactUs $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('seen', 'asc');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('contactus-table')
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
            Column::make('name')->title('Name')->addClass('text-center'),
            Column::make('email')->title('Email')->addClass('text-center'),
            Column::make('number')->title('Number')->addClass('text-center'),
            Column::make('description')->title('Description')->addClass('text-center'),
            Column::make('seen')->title('Seen')->addClass('text-center'),

            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(120),
        ];
    }

    protected function filename(): string
    {
        return 'ContactUs_' . date('YmdHis');
    }


}
