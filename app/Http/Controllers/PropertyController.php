<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PropertyController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $citiesByCountry = [
            'France' => ['Paris', 'Nice', 'Lyon', 'Marseille'],
            'Spain' => ['Barcelona', 'Madrid', 'Valencia', 'Seville']
        ];
        
        $query = Property::with(['primaryImage', 'images']);

        // Filtre par ville
        if ($request->has('city') && $request->city) {
            $query->where('city', 'like', "%{$request->city}%");
        }

        // Filtre par pays
        if ($request->has('country') && $request->country) {
            $query->where('country', $request->country);
        }

        // Filtre par note minimum
        if ($request->has('rating') && $request->rating) {
            $query->where('rating', '>=', $request->rating);
        }

        // Filtre pour les équipements
        if ($request->has('equipments')) {
            $requestedEquipments = (array) $request->equipments;
            $query->where(function($q) use ($requestedEquipments) {
                foreach ($requestedEquipments as $equipment) {
                    $q->whereJsonContains('equipments->'.$equipment, true);
                }
            });
        }

        // Filtre par prix
        if ($request->has('price')) {
            $priceRange = explode('-', $request->price);
            if (count($priceRange) == 2) {
                $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
            } elseif ($request->price == '201+') {
                $query->where('price', '>=', 201);
            }
        }

        // Filtre par nombre de chambres
        if ($request->has('bedrooms') && $request->bedrooms) {
            if ($request->bedrooms == '4+') {
                $query->where('bedrooms', '>=', 4);
            } else {
                $query->where('bedrooms', $request->bedrooms);
            }
        }

        // Filtre par type
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        $apartments = $query->paginate(9);

        return view('apartments.index', [
            'apartments' => $apartments,
            'citiesByCountry' => $citiesByCountry
        ]);
    }

    public function show($id)
    {
        $apartment = Property::with(['images', 'user'])->findOrFail($id);
        return view('apartments.show', compact('apartment'));
    }

    public function create()
    {
        return view('apartments.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'price' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer|min:1',
            'type' => 'required|string',
            'equipments' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $property = Property::create([
            'user_id' => Auth::id(),
            ...$validated,
            'rating' => null,
            'is_available' => true
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');
                $property->images()->create([
                    'image_url' => $path,
                    'is_primary' => $index === 0 // First image is primary
                ]);
            }
        }

        return redirect()->route('apartments.show', $property)
            ->with('success', 'Property created successfully.');
    }

    public function edit(Property $property)
    {
        $this->authorize('update', $property);
        return view('apartments.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $this->authorize('update', $property);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'price' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer|min:1',
            'type' => 'required|string',
            'equipments' => 'required|array',
            'images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $property->update($validated);

        if ($request->hasFile('images')) {
            // Delete old images if replace_images is true
            if ($request->boolean('replace_images')) {
                foreach ($property->images as $image) {
                    Storage::disk('public')->delete($image->image_url);
                }
                $property->images()->delete();
            }

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');
                $property->images()->create([
                    'image_url' => $path,
                    'is_primary' => $index === 0 && $request->boolean('replace_images')
                ]);
            }
        }

        return redirect()->route('apartments.show', $property)
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);

        // Delete all associated images from storage
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_url);
        }

        $property->delete();

        return redirect()->route('apartments.index')
            ->with('success', 'Property deleted successfully.');
    }
}
