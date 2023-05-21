<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialStatements extends Model
{
    use HasFactory;

    protected $table = 'financialstatements';
    
    // untuk melist kolom yang dapat diisi
    protected $fillable = [
        'date',
        'description',
        'income',
        'expense',
        'saldo',
        
    ];

    // view data data-data income dan expense
    public static function viewaincomeexpense($id_financialstatements){
        // periode memiliki format YYYY-MM
         $sql = "   SELECT b.kode_akun, b.nama_akun
                    FROM jurnal a JOIN coa b 
                    ON (a.kode_akun=b.kode_akun)
                    WHERE a.id_perusahaan = ? 
                    GROUP BY b.kode_akun, b.nama_akun
                    ORDER BY 2 ASC
                ";
        $list = DB::select($sql,[$id_financialstatements]);
        return $list;
    }
}
