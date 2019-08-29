<?php

namespace App\Exports;
use App\Candidates;

use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    public function collection()
    {
        return Candidates::all();
    }
}