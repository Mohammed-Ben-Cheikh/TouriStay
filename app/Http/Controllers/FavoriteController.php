<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class FavoriteController
{
    public function index()
    {
        $favorites = auth()->user()
            ->favorites()
            ->with(['primaryImage', 'user'])
            ->paginate(10);
            // dd($favorites);
        return view('favorites.index', compact('favorites'));
    }

    public function toggleFavorite(Request $request, Property $property)
    {
        $user = auth()->user();
        
        if ($user->favorites()->where('property_id', $property->id)->exists()) {
            $user->favorites()->detach($property->id);
        } else {
            $user->favorites()->attach($property->id);
        }
    
        return redirect()->back();
    }
}
