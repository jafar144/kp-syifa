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

    public function getJenisKelamin($jk){
        return $jk == "L" ? "Laki-Laki" : "Perempuan";
    }

    public function phoneNumber($number) {
        return substr($number, 0, 2)." ".substr($number, 2, 3)."-".substr($number, 5, 4)."-".substr($number, 9);
    }

    public function status_active($is_active){
        return $is_active == "Y" ? "Aktif" : "Tidak Aktif";
    }

    public function getTanggal($date){
        $tanggal = substr($date, 8, 2);
        $bulan = substr($date, 5, 2);
        $tahun = substr($date, 0, 4);

        $namaBulan = "";
        switch($bulan){

            case "01":
            $namaBulan = "Januari";
            break;

            case "02":
            $namaBulan = "Februari";
            break;

            case "03":
            $namaBulan = "Maret";
            break;

            case "04":
            $namaBulan = "April";
            break;

            case "05":
            $namaBulan = "Mei";
            break;

            case "06":
            $namaBulan = "Juni";
            break;

            case "07":
            $namaBulan = "Juli";
            break;

            case "08":
            $namaBulan = "Agustus";
            break;

            case "09":
            $namaBulan = "September";
            break;

            case "10":
            $namaBulan = "Oktober";
            break;

            case "11":
            $namaBulan = "November";
            break;

            case "12":
            $namaBulan = "Desember";
            break;

            default:
            $namaBulan = "Tidak ada bulan";

        }
        return $tanggal." ".$namaBulan." ".$tahun;
    }
}
