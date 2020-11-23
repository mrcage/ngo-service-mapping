<?php

namespace App\Exports;

use App\Exports\Sheets\OrganizationsSheet;
use App\Exports\Sheets\OrganizationTypesSheet;
use App\Exports\Sheets\SectorsSheet;
use App\Exports\Sheets\TargetGroupsSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithProperties;

class DataExport implements WithMultipleSheets, WithProperties
{
    use Exportable;

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new OrganizationsSheet();
        $sheets[] = new OrganizationTypesSheet();
        $sheets[] = new SectorsSheet();
        $sheets[] = new TargetGroupsSheet();
        return $sheets;
    }

    public function properties(): array
    {
        return [
            'title'   => config('app.name') . ' Data Export',
            'creator' => config('app.name'),
        ];
    }
}
