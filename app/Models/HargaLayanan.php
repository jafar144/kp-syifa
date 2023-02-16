<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaLayanan extends Model
{
    use HasFactory;
    protected $table = "harga_layanan";

    // protected $with = ['status_user'];

    public function layanan() {
        return $this->belongsTo(Layanan::class,'id_layanan','id');
    }

    public function status_user() {
        return $this->belongsTo(StatusUser::class,'id_status_jasa','id');
    }
}
