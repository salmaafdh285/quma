<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $table = 'debt';
    
    // untuk melist kolom yang dapat diisi
    protected $fillable = [
        'name',
        'description',
        'amount',
        'date',
        'target_date',
        'wallet',
        
    ];
}

