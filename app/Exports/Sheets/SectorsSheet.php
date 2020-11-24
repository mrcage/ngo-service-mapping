<?php

namespace App\Exports\Sheets;

use App\Exports\DefaultWorksheetStyles;
use App\Models\Sector;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class SectorsSheet implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use DefaultWorksheetStyles;

    protected $worksheetTitle = 'Sectors';

    public function query()
    {
        return Sector::orderBy('name');
    }

    public function headings(): array
    {
        return [
            'Name',
            'Number of services',
        ];
    }

    public function map($sector): array
    {
        return [
            $sector->name,
            $sector->services()->count() ?? 0,
        ];
    }
}
