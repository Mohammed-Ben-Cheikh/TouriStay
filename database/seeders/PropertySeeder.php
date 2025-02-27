<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $user = User::first() ?? User::factory()->create();

        $properties = [
            [
                'user_id' => $user->id,
                'title' => 'Appartement Paris Centre',
                'description' => 'Magnifique appartement au cœur de Paris, proche de tous commerces.',
                'location' => '15 Rue de Rivoli',
                'city' => 'Paris',
                'country' => 'France',
                'price' => 120.00,
                'bedrooms' => 2,
                'max_guests' => 4,
                'type' => 'apartment',
                'rating' => 4.8,
                'reviews_count' => 42,
                'equipments' => [
                    'wifi' => true,
                    'parking' => true,
                    'kitchen' => true,
                    'tv' => true,
                    'aircon' => true
                ],
                'is_available' => true,
                'available_from' => now(),
                'available_until' => now()->addMonths(3),
                'minimum_nights' => 2
            ],
            [
                'user_id' => $user->id,
                'title' => 'Villa Barcelona Mar',
                'description' => 'Superbe villa avec vue sur la mer Méditerranée.',
                'location' => 'Passeig Marítim',
                'city' => 'Barcelone',
                'country' => 'Espagne',
                'price' => 250.00,
                'bedrooms' => 4,
                'max_guests' => 8,
                'type' => 'villa',
                'rating' => 4.9,
                'reviews_count' => 28,
                'equipments' => [
                    'wifi' => true,
                    'parking' => true,
                    'kitchen' => true,
                    'tv' => true,
                    'aircon' => true,
                    'pool' => true
                ],
                'is_available' => true,
                'available_from' => now()->addDays(5),
                'available_until' => now()->addMonths(6),
                'minimum_nights' => 3
            ]
        ];

        foreach ($properties as $property) {
            Property::create($property);
        }
    }
}
