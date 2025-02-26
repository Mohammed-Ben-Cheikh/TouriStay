<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'location',
        'city',
        'country',
        'price',
        'bedrooms',
        'type',
        'rating',
        'equipments',
        'description',
        'is_available'
    ];

    protected $casts = [
        'equipments' => 'array',
        'is_available' => 'boolean',
        'price' => 'decimal:2',
        'rating' => 'decimal:1'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Unknown User'
        ]);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true);
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
