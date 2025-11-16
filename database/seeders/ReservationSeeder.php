<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\User;
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
            'user_id' => 1,
            'reservation_time' => '2025-11-10 18:00:00',
            'guests' => 4,
            'note' => 'Születésnapi vacsora',
        ]);

    }
}
