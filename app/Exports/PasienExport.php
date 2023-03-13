<?php

namespace App\Exports;

use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection;

class PasienExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Users::all();
    }
}
