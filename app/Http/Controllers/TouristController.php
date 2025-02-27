<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class TouristController
{
    public function index(){
        $property = Property::all();
        return view("home",compact("property"));
        
    }
}
