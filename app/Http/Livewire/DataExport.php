<?php

namespace App\Http\Livewire;

use App\Exports\DataExport as ExportsDataExport;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class DataExport extends PageComponent
{
    protected $view = 'livewire.data-export';

    protected $title = 'Data Export';

    public $formats = [
        'xlsx' => 'Excel Spreadsheet (XLSX)',
        'ods' => 'OpenDocument Spreadsheet (ODS)',
        'csv' => 'Comma-separated values (CSV)',
        'html' => 'Web Page (HTML)',
    ];

    public $format = 'xlsx';

    public function submit()
    {
        $this->validate([
            'format' => Rule::in(array_keys($this->formats)),
        ]);

        $filename = config('app.name') . ' Data Export.' . $this->format;
        return Excel::download(new ExportsDataExport, $filename);
    }
}
