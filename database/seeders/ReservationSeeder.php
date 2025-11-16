<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::factory()->count(10)->create();
        
        Reservation::create([
            'name' => 'Kovács Péter',
            'email' => 'peter.kovacs@example.com',
            'reservation_time' => '2025-11-10 18:00:00',
            'guests' => 4,
            'note' => 'Születésnapi vacsora',
        ]);

    }
}
