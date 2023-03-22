<?php

namespace App\Exports;

use App\Models\Pesanan;
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


class PesananExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping, WithStyles
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    public function query()
    {
        // Reservation::whereBetween('reservation_from', [$from1, $to1])        
        // dd($this->to);
        return Pesanan::query()->whereBetween('created_at',[$this->from, $this->to]);
        // return Pesanan::query()->where('created_at', '>=', $this->from)->where('created_at', '<=', $this->to);
    }
    public function headings(): array
    {
        return [
            'id pesanan',
            'pasien',
            'layanan',
            'Jasa',
            'Medis',
            'keluhan',
            'tanggal perawatan',
            'jam perawatan',
            'Alamat',
            'Harga',
            'Ongkos',
            'status pesanan',
            'status pembayaran'
        ];
    }
    public function map($pesanan): array
    {
        return [
            $pesanan->id,
            $pesanan->user_pasien->nama,
            $pesanan->layanan->nama_layanan,
            $pesanan->status_jasa->status,
            isset($pesanan->user_jasa->nama) ? $pesanan->user_jasa->nama : null,
            $pesanan->keluhan,
            $pesanan->tanggal_perawatan,
            $pesanan->jam_perawatan,
            $pesanan->alamat,
            $pesanan->harga,
            $pesanan->ongkos,
            $pesanan->status_layanan->status,
            $pesanan->status_pembayaran
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
