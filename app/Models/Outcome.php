<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'activity_id',
        'activity_name',
        'nominal_pengeluaran',
        'tanggal_pengeluaran',
    ];

    /**
     * Get the activity that owns the outcome.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'activity_id');
    }
}
