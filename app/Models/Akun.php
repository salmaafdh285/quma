<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// tambahan
use Illuminate\Support\Facades\DB;

class Akun extends Model
{
    use HasFactory;

    protected $table = 'akun';
    protected $fillable = ['header_akun','kode_akun','nama_akun'];

    // query nilai max dari kode akun untuk generate otomatis kode akun
    public static function getKodeAkun()
    {
        // query kode akun
        $sql = "SELECT (kode_akun) as kode_akun
                FROM akun";
        $kodeakun = DB::select($sql);

        // // cacah hasilnya
        // foreach ($kodeakun as $kdakn) {
        //     $kd = $kdakn->kode_akun;
        // }
        // // Mengambil substring tiga digit akhir dari string PR-000
        // $noawal = substr($kd,-3);
        // $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        // $noakhir = ''.str_pad($noakhir,3,"0",STR_PAD_LEFT); //menyambung dengan string PR-001
        // return $noakhir;

    }
}
