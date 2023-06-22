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
        'tanggal_pemasukan',
    ];
}
