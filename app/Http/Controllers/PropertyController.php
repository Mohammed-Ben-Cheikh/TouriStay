<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Pays;

class PropertyController
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $citiesByCountry = Pays::with('villes')
            ->get()
            ->mapWithKeys(function ($country) {
                return [
                    $country->nom => $country->villes->map(function ($ville) {
                        return [
                            'id' => $ville->id,
                            'nom' => $ville->nom
                        ];
                    })->all()
                ];
            });

        $query = Property::with(['primaryImage', 'images', 'ville.pays']);

        // Filtre par pays
        if ($request->has('country') && $request->country) {
            $query->whereHas('ville.pays', function ($q) use ($request) {
                $q->where('nom', $request->country);
            });
        }

        // Filtre par ville
        if ($request->has('city') && $request->city) {
            $query->whereHas('ville', function ($q) use ($request) {
                $q->where('ville_id', '=', $request->city);
            });
        }

        // Filtre par note minimum
        if ($request->has('rating') && $request->rating) {
            $query->where('rating', '>=', $request->rating);
        }

        // Filtre pour les équipements
        if ($request->has('equipments')) {
            $requestedEquipments = (array) $request->equipments;
            $query->where(function ($q) use ($requestedEquipments) {
                foreach ($requestedEquipments as $equipment) {
                    $q->whereJsonContains('equipments->' . $equipment, true);
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

        // Get authenticated user
        $user = auth()->user();

        $apartments = $query->paginate(6)
            ->through(function ($property) use ($user) {
                // Add isFavorited property
                $property->isFavorited = $user ? $user->favorites()->where('property_id', $property->id)->exists() : false;
                return $property;
            });

        return view('hébergement.index', [
            'apartments' => $apartments,
            'citiesByCountry' => $citiesByCountry
        ]);
    }

    public function show($id)
    {
        if (!is_numeric($id) || (int) $id != $id) {
            abort(404);
        }

        $apartment = Property::with(['images', 'user'])->findOrFail($id);
        return view('hébergement.show', compact('apartment'));
    }

    public function create()
    {
        $citiesByCountry = Pays::with('villes')
            ->get()
            ->mapWithKeys(function ($country) {
                return [
                    $country->nom => $country->villes->map(function ($ville) {
                        return [
                            'id' => $ville->id,
                            'nom' => $ville->nom
                        ];
                    })->all()
                ];
            });
        return view('hébergement.create', compact('citiesByCountry'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'You must be logged in to create a property.');
        }

        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'ville_id' => 'required|exists:villes,id',
            'price' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer|min:1|max:10',
            'max_guests' => 'required|integer|min:1|max:10',
            'type' => 'required|string',
            'equipments' => 'array',
            'minimum_nights' => 'required|integer|min:1',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'available_from' => 'required|date',
            'available_until' => 'required|date|after:available_from'
        ]);

        try {
            \DB::beginTransaction();

            // Create property with basic info
            $property = Property::create([
                'user_id' => Auth::id(),
                'ville_id' => $request->ville_id,
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
                'price' => $request->price,
                'bedrooms' => $request->bedrooms,
                'max_guests' => $request->max_guests,
                'type' => $request->type,
                'equipments' => $request->equipments ?? [],
                'minimum_nights' => $request->minimum_nights,
                'rating' => null,
                'is_available' => true,
                'available_from' => $request->available_from,
                'available_until' => $request->available_until
            ]);

            // Process images
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                // Track which images to skip (if any were deleted in the UI)
                $deletedIndices = [];
                if ($request->has('deleted_images')) {
                    $deletedIndices = explode(',', $request->deleted_images);
                }

                foreach ($images as $index => $image) {
                    // Skip deleted images
                    if (in_array((string) $index, $deletedIndices)) {
                        continue;
                    }

                    $fileName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                    $folderPath = "properties/{$property->id}";

                    // Make sure the directory exists
                    Storage::disk('public')->makeDirectory($folderPath);

                    // Store the image
                    $path = $image->storeAs($folderPath, $fileName, 'public');

                    // Create the image record
                    $property->images()->create([
                        'image_url' => $path,
                        'is_primary' => $index === 0 // First image is primary
                    ]);
                }
            }

            \DB::commit();

            // Redirect with success
            return redirect()->route('hébergements.show', $property)
                ->with('success', 'Property created successfully!');

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error creating property: ' . $e->getMessage());

            // Clean up any images already uploaded
            if (isset($property) && $property->id) {
                Storage::disk('public')->deleteDirectory('properties/' . $property->id);
            }

            return back()->withInput()
                ->with('error', 'An error occurred while creating the property: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        if (!is_numeric($id) || (int) $id != $id) {
            abort(404);
        }

        $property = Property::with('images')->findOrFail($id);

        // Check if current user is the owner of the property
        if (auth()->user()->id !== $property->user_id) {
            return redirect()->route('owner.dashboard')
                ->with('error', 'Vous n\'êtes pas autorisé à modifier cette propriété.');
        }

        return view('Hébergement.edit', compact('property'));
    }

    public function update(Request $request, $id)
    {
        if (!is_numeric($id) || (int) $id != $id) {
            abort(404);
        }

        $property = Property::findOrFail($id);

        // Check if current user is the owner of the property
        if (auth()->user()->id !== $property->user_id) {
            return redirect()->route('owner.dashboard')
                ->with('error', 'Vous n\'êtes pas autorisé à modifier cette propriété.');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'ville_id' => 'required|exists:villes,id',
            'price' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer|min:1|max:10',
            'max_guests' => 'required|integer|min:1|max:10',
            'type' => 'required|string',
            'equipments' => 'array',
            'minimum_nights' => 'required|integer|min:1',
            'is_available' => 'boolean',
            'available_from' => 'required|date',
            'available_until' => 'required|date|after:available_from'
        ]);

        try {
            \DB::beginTransaction();

            // Update property with basic info
            $property->update($validated);

            // Handle image upload if provided
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $folderPath = "properties/{$property->id}";

                    // Make sure the directory exists
                    Storage::disk('public')->makeDirectory($folderPath);

                    // Store the image
                    $path = $image->storeAs($folderPath, $fileName, 'public');

                    // Create image record
                    $property->images()->create([
                        'image_url' => $path,
                        'is_primary' => false // New images are not primary by default
                    ]);
                }
            }

            \DB::commit();
            return redirect()->route('owner.dashboard')->with('success', 'Property updated successfully!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withInput()->with('error', 'Error updating property: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        if (!is_numeric($id) || (int) $id != $id) {
            abort(404);
        }

        $property = Property::findOrFail($id);

        // Check if current user is the owner of the property
        if (auth()->user()->id !== $property->user_id) {
            return redirect()->route('owner.dashboard')
                ->with('error', 'Vous n\'êtes pas autorisé à supprimer cette propriété.');
        }

        // Check if the property has bookings
        if ($property->bookings()->count() > 0) {
            return redirect()->route('owner.dashboard')
                ->with('error', 'Impossible de supprimer une propriété avec des réservations existantes.');
        }

        // Use soft delete instead of force delete
        $property->delete();

        return redirect()->route('owner.dashboard')
            ->with('success', 'Propriété supprimée avec succès.');
    }
}
