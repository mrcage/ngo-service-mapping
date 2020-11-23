<?php

namespace App\Exports\Sheets;

use App\Exports\DefaultWorksheetStyles;
use App\Models\Organization;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrganizationsSheet implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, ShouldAutoSize, WithStyles
{
    use DefaultWorksheetStyles;

    protected $worksheetTitle = 'Organizations';

    public function query()
    {
        return Organization::orderBy('name');
    }

    public function headings(): array
    {
        return [
            'Name',
            'Type',
            'Description',
            'E-Mail',
            'Website',
            'Sectors',
            'Registered',
            'Updated',
        ];
    }

    public function map($organization): array
    {
        return [
            $organization->name,
            $organization->type->name,
            $organization->description,
            $organization->email,
            $organization->website,
            $organization->sectors->pluck('name')->implode('; '),
            Date::dateTimeToExcel($organization->created_at->toUserTimezone()),
            Date::dateTimeToExcel($organization->updated_at->toUserTimezone()),
        ];
    }

    public function columnFormats(): array
    {
        // TODO: Format date according to user locale / settings
        return [
            'G' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'H' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }
}
