<?php

namespace App\Exports;

use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class StaffExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function __construct($id)
    // {
    //     $this->id = $id;
    // }
    
    public function query()
    {
        // return Users::query()->where('status', $this->id);
        return Users::query()->where('status', '!=', 'P')->where('status', '!=', 'A');
    }
    public function map($staff): array
    {
        return [
            $staff->NIK,
            $staff->status_user->status
        ];
    }
    public function headings(): array
    {
        return [
            'NIK',
            'Status'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }
}
