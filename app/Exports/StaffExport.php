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

class StaffExport extends DefaultValueBinder implements WithCustomValueBinder, FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Users::query()->where('status', '!=', 'P')->where('status', '!=', 'A');
    }
    public function map($staff): array
    {
        return [
            $staff->NIK,
            $staff->nama,
            $staff->jenis_kelamin,
            $staff->status_user->status,
            $staff->email,
            $staff->tanggal_lahir,
            $staff->alamat,
            $staff->notelp,
            $staff->is_active
        ];
    }    
    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'jk',
            'Status',
            'Email',
            'TTL',
            'alamat',
            'notelp',
            'aktif'
        ];
    }
    public function bindValue(Cell $cell, $staff)
    {
        if ($cell->getColumn() != 'F') {
            $cell->setValueExplicit($staff, DataType::TYPE_STRING);

            return true;
        }
        if ($cell->getRow() == 1) {
            $cell->setValueExplicit($staff, DataType::TYPE_STRING);

            return true;
        }
        if ($cell->getColumn() == 'F' && $cell->getRow() != 1) {
            $staff = date('d/m/Y',strtotime($staff));
            
            $cell->setValueExplicit($staff);

            return true;
        }

        return parent::bindValue($cell, $staff);
    }
    
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT
            
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }
}
