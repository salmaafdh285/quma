<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Daftar extends Model
{
    use HasFactory;

    protected $table = 'daftar';
    protected $fillable = ['id_daftar','nama','tipe','total'];

    //query nilai max dari kode perusahaan untuk generate otomatis kode perusahaan
    public static function getIdDaftar()
        {
            //query id daftar
            $sql = "SELECT (id_daftar) as id_daftar
               FROM daftar";
            $id_daftar = DB::select($sql);

        // // cacah hasilnya
        //     foreach ($id_daftar as $iddftr) {
        //      $id = $iddftr->id_daftar;
        //     }
        //  //Mengambil substring tiga digit akhir dari string list-000
        //     $noawal = substr($id,-3);
        //     $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        //     $noakhir = 'list-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); //menyambung dengan string list-001
        //     return $noakhir;

        }
}