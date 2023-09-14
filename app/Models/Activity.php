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

    /**
     * The 'booting' method of the model.
     * 
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($activity) {
            $lastId = static::max('activity_id');
            $newId = $lastId ? sprintf('ACT-%04d', substr($lastId, -4) + 1) : 'ACT-0001';
            $activity->activity_id = $newId;
        });
    }

    /**
     * Get the outcomes for the activity.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outcomes()
    {
        return $this->hasMany(Outcome::class, 'activity_id', 'activity_id');
    }

    /**
     * Get the users for the activity.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'activity_user', 'activity_id', 'user_id');
    }

    /**
     * Get the images for the activity.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'activity_id', 'activity_id');
    }
}
