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
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrganizationsExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, ShouldAutoSize, WithStyles, WithProperties
{
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

    public function styles(Worksheet $sheet)
    {
        // Sheet title
        $sheet->setTitle("Organizations");

        // Orientation
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        // Paper size
        $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);

        // Fit to page width
        $sheet->getPageSetup()->setFitToWidth(0);
        $sheet->getPageSetup()->setFitToHeight(0);

        // Header: Centered: sheet name
        $sheet->getHeaderFooter()->setOddHeader('&C&A');

        // Footer: Left: date, right: current page / number of pages
        $sheet->getHeaderFooter()->setOddFooter('&L&D&R&P / &N');

        // Print header row on each page
        $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 1);

        // Styling of header row
        $sheet->getStyle('A1:'.$sheet->getHighestColumn().'1')
            ->getFont()
            ->setBold(true);

        // Borders
        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle('A1:'.$sheet->getHighestColumn().'1')
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(Border::BORDER_MEDIUM);

        // Freeze first line
        $sheet->freezePane('B2');

        // Auto-filter
        $sheet->setAutoFilter($sheet->calculateWorksheetDimension());
    }

    public function properties(): array
    {
        return [
            'title'   => 'List of organizations',
            'creator' => config('app.name'),
        ];
    }
}
