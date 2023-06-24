<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = [
        'sumber_dana',
        'jumlah_nominal',
        'tanggal_pemasukkan',
        'total_pemasukkan',
    ];

    public static function updateTotalPemasukkan()
    {
        $totalPemasukkan = Fund::sum('jumlah_nominal');
        $lastRecord = Fund::latest()->first();
        $lastRecord->total_pemasukkan = $totalPemasukkan;
        $lastRecord->save();
    }
}
