<?php

namespace App\Exports;

use App\Models\StatusUser;
use Maatwebsite\Excel\Concerns\FromCollection;

class StatusUserExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StatusUser::all();
    }
}
