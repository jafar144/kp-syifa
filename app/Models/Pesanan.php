<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = "pesanan";

    public function user_pasien() {
        return $this->belongsTo(Users::class,'NIK_pasien','NIK');
    }

    public function user_jasa() {
        return $this->belongsTo(Users::class,'NIK_jasa','NIK');
    }

    public function layanan() {
        return $this->belongsTo(Layanan::class,'id_layanan','id');
    }

    public function status_jasa() {
        return $this->belongsTo(StatusUser::class,'id_status_jasa','id');
    }

    public function status_layanan() {
        return $this->belongsTo(StatusLayanan::class,'id_status_layanan','id');
    }
}
