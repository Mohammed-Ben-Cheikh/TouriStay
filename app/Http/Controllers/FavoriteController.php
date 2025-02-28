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
            $message = 'L\'hébergement a été retiré de vos favoris avec succès.';
        } else {
            $user->favorites()->attach($property->id);
            $message = 'L\'hébergement a été ajouté à vos favoris avec succès.';
        }
    
        return redirect()->back()->with('success', $message);
    }
}
