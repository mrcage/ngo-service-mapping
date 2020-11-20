<?php

namespace App\Exports\Sheets;

use App\Exports\DefaultWorksheetStyles;
use App\Models\OrganizationType;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class OrganizationTypesSheet implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use DefaultWorksheetStyles;

    protected $worksheetTitle = 'Organization Types';

    public function query()
    {
        return OrganizationType::orderBy('name');
    }

    public function headings(): array
    {
        return [
            'Name',
            'Number of organizations',
        ];
    }

    public function map($organizationType): array
    {
        return [
            $organizationType->name,
            $organizationType->organizations()->count() ?? 0,
        ];
    }
}
