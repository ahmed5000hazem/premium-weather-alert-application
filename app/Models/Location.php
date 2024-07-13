<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    /**
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'latitude', 'longitude'];

    /**
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * @return HasMany
     */
    public function weatherAlerts(): HasMany
    {
        return $this->hasMany(WeatherAlert::class);
    }
}
