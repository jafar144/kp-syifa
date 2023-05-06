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
        return Pesanan::query()->whereDate('created_at', '>=', $this->from)->whereDate('created_at', '<=', $this->to);
    }
    public function headings(): array
    {
        return [
            'Id pesanan',
            'Nama pasien',
            'Telp pasien',
            'layanan',
            'Jasa',
            'Medis',
            'Keluhan',
            'Tanggal perawatan',
            'Jam perawatan',
            'Alamat',
            'Harga',
            'Ongkos',
            'Status pesanan',
            'Status pembayaran'
        ];
    }
    public function map($pesanan): array
    {
        return [
            $pesanan->id,
            $pesanan->user_pasien->nama,
            $pesanan->user_pasien->notelp,
            $pesanan->layanan->nama_layanan,
            $pesanan->status_jasa->status,
            isset($pesanan->user_jasa->nama) ? $pesanan->user_jasa->nama : '-',
            $pesanan->keluhan,
            $pesanan->tanggal_perawatan,
            $pesanan->jam_perawatan,
            $pesanan->alamat,
            $pesanan->harga==0 ? '0' : $pesanan->harga,
            $pesanan->ongkos==0 ? '0' : $pesanan->ongkos,
            $pesanan->status_pesanan->status,
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
