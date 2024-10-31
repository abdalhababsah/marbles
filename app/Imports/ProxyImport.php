<?php

namespace App\Imports;

use App\Models\Proxy;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class ProxyImport implements OnEachRow, SkipsEmptyRows, WithHeadingRow, WithValidation
{

    public function onRow(Row $row)
    {
        $rowData = $row->toCollection();
        Proxy::create(['ip' => $rowData->get('ip'),
            'group_id' => request('group_id')]);
    }

    public function rules(): array
    {
        return [
            'ip' => 'required',
        ];
    }
}
