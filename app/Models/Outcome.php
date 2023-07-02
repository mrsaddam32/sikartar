<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'activity_name',
        'nominal_pengeluaran',
        'tanggal_pengeluaran',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
