<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = "pesanan";

    public function user_pasien() {
        return $this->belongsTo(Users::class,'id_pasien','id');
    }

    public function user_jasa() {
        return $this->belongsTo(Users::class,'id_jasa','id');
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
