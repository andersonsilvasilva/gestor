<?php

namespace App\Imports;

use App\Models\eventos;
use Maatwebsite\Excel\Concerns\FromCollection;


class BookImport implements FromCollection
{
    public function collection()
    {
        return Eventos::all();
    }
    //
}
