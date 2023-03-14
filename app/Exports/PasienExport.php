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
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class PasienExport extends DefaultValueBinder implements WithCustomValueBinder, FromQuery, WithMapping, ShouldAutoSize, WithHeadings, WithStyles, WithColumnFormatting
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Users::query()->where('status', '=', 'P');
    }
    public function map($pasien): array
    {
        return [
            $pasien->NIK,
            $pasien->nama,
            $pasien->jenis_kelamin,
            $pasien->email,
            $pasien->tanggal_lahir,
            $pasien->alamat,
            $pasien->notelp
        ];
    }  
    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'jk',
            'Email',
            'TTL',
            'alamat',
            'notelp'
        ];
    }
    public function bindValue(Cell $cell, $pasien)
    {
        // if (is_numeric($staff->NIK)) {
        //     $cell->setValueExplicit($staff, DataType::TYPE_STRING);

        //     return true;
        // }
        if ($cell->getColumn() != 'E') {
            $cell->setValueExplicit($pasien, DataType::TYPE_STRING);

            return true;
        }
        if ($cell->getRow() == 1) {
            $cell->setValueExplicit($pasien, DataType::TYPE_STRING);

            return true;
        }
        if ($cell->getColumn() == 'E' && $cell->getRow() != 1) {
            $pasien = date('d/m/Y',strtotime($pasien));
            
            $cell->setValueExplicit($pasien);

            return true;
        }
        return parent::bindValue($cell, $pasien);
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
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT            
        ];
    }
}
