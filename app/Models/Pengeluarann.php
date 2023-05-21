<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Pengeluarann extends Model
{
    use HasFactory;

    protected $table = 'pengeluarann';
    // untuk melist kolom yang dapat diisi
    protected $fillable = [
        'id_pengeluarann',
        'tgl_pengeluarann',
        'jumlah',
        'id_sumber',
    ];

    public static function getViewSumber()
    {
        // query sumber
        $sql = "SELECT * FROM sumber";
        $sumber = DB::select($sql);

        return $sumber;
    }
}