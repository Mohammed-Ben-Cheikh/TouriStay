<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'pays_id', 'image_path'];

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'ville_id');
    }

    // Helper method pour obtenir le nombre de propriétés
    public function getPropertiesCountAttribute()
    {
        return $this->properties()->count();
    }
}
