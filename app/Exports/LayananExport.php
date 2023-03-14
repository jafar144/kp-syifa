<?php

namespace App\Exports;

use App\Models\Layanan;
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
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class LayananExport extends DefaultValueBinder implements WithCustomValueBinder, FromQuery, WithMapping, WithHeadings, WithStyles, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Layanan::query();
    }
    public function map($layanan): array
    {
        return [
            $layanan->id,
            $layanan->nama_layanan,
            $layanan->deskripsi,
            $layanan->use_foto,
            $layanan->show,
            $layanan->created_at,
            $layanan->updated_at
        ];
    }
    public function headings(): array
    {
        return [
            'id',
            'nama layanan',
            'deskripsi',
            'foto',
            'aktif',
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
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_DATE_DATETIME          
        ];
    }
    public function bindValue(Cell $cell, $layanan)
    {
        if ($cell->getColumn() == 'B' || $cell->getColumn() == 'C') {
            $cell->setValueExplicit($layanan, DataType::TYPE_STRING);

            return true;
        }
        if ($cell->getRow() == 1) {
            $cell->setValueExplicit($layanan, DataType::TYPE_STRING);

            return true;
        }
        if ($cell->getColumn() == 'F' && $cell->getRow() != 1) {
            $layanan=date('d/m/Y H:i:s',strtotime($layanan));
            // $staff = date('d/m/Y',strtotime($staff));            
            $cell->setValueExplicit($layanan);

            return true;
        }
        
        return parent::bindValue($cell, $layanan);
    }
}
