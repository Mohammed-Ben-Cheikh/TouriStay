<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes; // Add this line

class Property extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes here

    protected $fillable = [
        'user_id',
        'ville_id', // Ajout du champ
        'title',
        'description',
        'location',
        'city',
        'country',
        'price',
        'bedrooms',
        'max_guests',
        'type',
        'equipments',
        'minimum_nights',
        'available_from',
        'available_until',
        'is_available'
    ];

    protected $casts = [
        'equipments' => 'array',
        'is_available' => 'boolean',
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'available_from' => 'date',
        'available_until' => 'date'
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
 
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    // Helper method pour obtenir la ville et le pays
    public function getCityCountryAttribute()
    {
        return [
            'city' => $this->ville->nom,
            'country' => $this->ville->pays->nom
        ];
    }

    // Add methods to handle image URLs if needed
    public function getImageUrl($image)
    {
        return Storage::url($image->image_url);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')
            ->withTimestamps();
    }
}
