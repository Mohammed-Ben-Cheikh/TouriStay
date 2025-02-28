<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController
{
    public function welcome()
    {
        return view('components.owner-welcome');
    }

    public function dashboard()
    {
        $properties = Property::where('user_id', Auth::id())->get();
        
        $stats = [
            'total_properties' => $properties->count(),
            'active_listings' => $properties->where('is_available', 1)->count(),
            'total_bookings' => $properties->sum('booking_count'),
            'total_revenue' => $properties->sum('total_revenue'),
        ];

        return view('owner.dashboard', compact('properties', 'stats'));
    }

    public function become_owner()
    {
        $user = Auth::user();
        $user->update([
            'role' => 'owner'
        ]);

        return redirect()->route('owner.dashboard')
            ->with('success', 'Félicitations ! Vous êtes maintenant un propriétaire sur TouriStay.');
    }
}
