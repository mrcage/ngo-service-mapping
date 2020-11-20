<?php

namespace App\Exports;

use App\Models\Organization;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrganizationsExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, ShouldAutoSize, WithStyles, WithProperties
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
            'Description',
            'E-Mail',
            'Website',
            'Sectors',
            'Registered',
        ];
    }

    public function map($organization): array
    {
        return [
            $organization->name,
            $organization->description,
            $organization->email,
            $organization->website,
            $organization->sectors->pluck('name')->implode('; '),
            Date::dateTimeToExcel($organization->created_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function properties(): array
    {
        return [
            'title'   => 'List of organizations',
            'creator' => config('app.name'),
        ];
    }
}
