<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $primaryKey = 'id';
    
    public function status_user() {
        return $this->belongsTo(StatusUser::class,'status','id');
    }

    public function phoneNumber($number) {
        return substr($number, 0, 2)." ".substr($number, 2, 3)."-".substr($number, 5, 4)."-".substr($number, 9);
    }

    public function status_active($is_active){
        return $is_active == "Y" ? "Aktif" : "Tidak Aktif";
    }
}
