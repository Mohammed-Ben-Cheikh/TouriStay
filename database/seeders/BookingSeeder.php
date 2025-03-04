<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Insertion de 4 réservations pour chaque propriété
        DB::table('bookings')->insert([
            // Réservations pour property_id = 1
            [
                'user_id' => 1,
                'property_id' => 1,
                'check_in' => Carbon::parse('2025-03-01'),
                'check_out' => Carbon::parse('2025-03-05'),
                'guests' => 2,
                'total_price' => 150.00,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'property_id' => 1,
                'check_in' => Carbon::parse('2025-03-06'),
                'check_out' => Carbon::parse('2025-03-10'),
                'guests' => 3,
                'total_price' => 180.00,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'property_id' => 1,
                'check_in' => Carbon::parse('2025-03-11'),
                'check_out' => Carbon::parse('2025-03-15'),
                'guests' => 1,
                'total_price' => 100.00,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'property_id' => 1,
                'check_in' => Carbon::parse('2025-03-16'),
                'check_out' => Carbon::parse('2025-03-20'),
                'guests' => 2,
                'total_price' => 160.00,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Réservations pour property_id = 2
            [
                'user_id' => 2,
                'property_id' => 2,
                'check_in' => Carbon::parse('2025-03-01'),
                'check_out' => Carbon::parse('2025-03-05'),
                'guests' => 2,
                'total_price' => 200.00,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'property_id' => 2,
                'check_in' => Carbon::parse('2025-03-06'),
                'check_out' => Carbon::parse('2025-03-10'),
                'guests' => 4,
                'total_price' => 250.00,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'property_id' => 2,
                'check_in' => Carbon::parse('2025-03-11'),
                'check_out' => Carbon::parse('2025-03-15'),
                'guests' => 3,
                'total_price' => 210.00,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'property_id' => 2,
                'check_in' => Carbon::parse('2025-03-16'),
                'check_out' => Carbon::parse('2025-03-20'),
                'guests' => 2,
                'total_price' => 220.00,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Réservations pour property_id = 3
            [
                'user_id' => 1,
                'property_id' => 3,
                'check_in' => Carbon::parse('2025-03-01'),
                'check_out' => Carbon::parse('2025-03-05'),
                'guests' => 3,
                'total_price' => 180.00,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'property_id' => 3,
                'check_in' => Carbon::parse('2025-03-06'),
                'check_out' => Carbon::parse('2025-03-10'),
                'guests' => 1,
                'total_price' => 100.00,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'property_id' => 3,
                'check_in' => Carbon::parse('2025-03-11'),
                'check_out' => Carbon::parse('2025-03-15'),
                'guests' => 2,
                'total_price' => 150.00,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'property_id' => 3,
                'check_in' => Carbon::parse('2025-03-16'),
                'check_out' => Carbon::parse('2025-03-20'),
                'guests' => 4,
                'total_price' => 220.00,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

