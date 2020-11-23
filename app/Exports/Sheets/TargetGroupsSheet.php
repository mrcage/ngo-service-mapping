<?php

namespace App\Exports\Sheets;

use App\Exports\DefaultWorksheetStyles;
use App\Models\TargetGroup;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class TargetGroupsSheet implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use DefaultWorksheetStyles;

    protected $worksheetTitle = 'Target Groups';

    public function query()
    {
        return TargetGroup::orderBy('name');
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
