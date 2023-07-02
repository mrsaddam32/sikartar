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

    public static function updateSisaPemasukkan()
    {
        $totalPemasukkan = Fund::sum('jumlah_nominal');
        $totalOutcome = Outcome::sum('nominal_pengeluaran');
        $sisaPemasukkan = $totalPemasukkan - $totalOutcome;

        if ($sisaPemasukkan === 0) {
            $latestFund = Fund::latest()->first();
            $sisaPemasukkan = $latestFund->jumlah_nominal;
        }

        $lastRecord = Fund::latest()->first();
        $lastRecord->sisa_pemasukkan = $sisaPemasukkan;
        $lastRecord->save();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'sumber_dana', 'id');
    }
}
