<?php

namespace App\Exports\Sheets;

use App\Exports\DefaultWorksheetStyles;
use App\Models\Location;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LocationsSheet implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, ShouldAutoSize, WithStyles
{
    use DefaultWorksheetStyles;

    protected array $columnAlignment = [
        'C' => Alignment::HORIZONTAL_RIGHT,
    ];

    protected $worksheetTitle = 'Locations';

    public function query()
    {
        return Location::orderBy('name');
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Coordinates',
            'Registered',
            'Updated',
        ];
    }

    public function map($organization): array
    {
        return [
            $organization->name,
            $organization->description,
            isset($organization->latitude) && isset($organization->longitude) ? $organization->latitude . ',' . $organization->longitude : null,
            Date::dateTimeToExcel($organization->created_at->toUserTimezone()),
            Date::dateTimeToExcel($organization->updated_at->toUserTimezone()),
        ];
    }

    public function columnFormats(): array
    {
        // TODO: Format date according to user locale / settings
        return [
            'D' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'E' => NumberFormat::FORMAT_DATE_YYYYMMDD,
        ];
    }
}
