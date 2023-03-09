<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusUser extends Model
{
    use HasFactory;

    protected $table = "status_user";
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function users() {
        return $this->hasMany(Users::class,'id','status');
    }

    public function status_active($is_active){
        return $is_active == "Y" ? "Aktif" : "Tidak Aktif";
    }
}
