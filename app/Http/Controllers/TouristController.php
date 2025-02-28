<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\Ville;
use Illuminate\Http\Request;
use App\Models\Property;

class TouristController
{
    public function index(){
        $property = Property::all();
        $ville =  Ville::all();
        $pays = Pays::all();
        return view("home",compact("property","ville","pays"));
        
    }
}
