<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(ReservationSeeder::class);
    }
}
