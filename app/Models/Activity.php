<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'activity_id',
        'activity_name',
        'responsible_person',
        'activity_description',
        'activity_budget',
        'activity_status',
        'activity_location',
        'activity_start_date',
        'activity_end_date',
        'document_name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($activity) {
            $lastId = static::max('activity_id');
            $newId = $lastId ? sprintf('ACT-%04d', substr($lastId, -4) + 1) : 'ACT-0001';
            $activity->activity_id = $newId;
        });
    }

    public function outcomes()
    {
        return $this->hasMany(Outcome::class, 'activity_id', 'id');
    }
}
