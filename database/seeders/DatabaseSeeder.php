<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'), // ugyanazt csinálja mint a Hash::make('admin')
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Mozso',
            'email' => 'mozso@example.com',
            'is_admin' => false,
        ]);

        // User::factory(10)->create();
        $this->call(ReservationSeeder::class);
    }
}
