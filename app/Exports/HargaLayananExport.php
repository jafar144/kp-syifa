<?php

namespace App\Exports;

use App\Models\HargaLayanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class HargaLayananExport implements FromQuery, WithMapping, WithHeadings, WithStyles, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return HargaLayanan::query();
    }
    public function map($hargalayanan): array
    {
        return [
            $hargalayanan->id,
            isset($hargalayanan->layanan->nama_layanan) ? $hargalayanan->layanan->nama_layanan : null,
            isset($hargalayanan->status_user->status) ? $hargalayanan->status_user->status : null,
            $hargalayanan->harga,
            $hargalayanan->created_at,
            $hargalayanan->updated_at
        ];
    }
    public function headings(): array
    {
        return [
            'id',
            'nama layanan',
            'jasa',
            'harga',
            'created at',
            'updated at'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_DATE_DATETIME,
            'F' => NumberFormat::FORMAT_DATE_DATETIME          
        ];
    }
}
