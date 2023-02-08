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
}
