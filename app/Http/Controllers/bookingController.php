<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;
use App\Models\Pays;
use App\Models\User;

class BookingController
{

    public function index($id, Request $request)
    {
        $user = Auth::user();
        $property = Property::where("id", '=', $id)->first();
        $booking = Booking::where('property_id', $property->id)
            ->orderBy('check_out', 'desc')
            ->first();
        $checkBooking = Carbon::today()->greaterThanOrEqualTo($booking->check_out);
        return view('Hébergement.check-in', compact('property','user','checkBooking'));
    }

    public function store(Request $request)
    {
        
    }


}