<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusLayanan extends Model
{
    use HasFactory;

    protected $table = "status_layanan";
    protected $primaryKey = 'id';
    public $incrementing = false;
}
