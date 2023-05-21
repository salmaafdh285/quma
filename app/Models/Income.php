<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'income';
    
    // untuk melist kolom yang dapat diisi
    protected $fillable = [
        'date',
        'amount',
        'description',
        'category',
        'wallet',
        
    ];
}