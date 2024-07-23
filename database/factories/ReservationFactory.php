<?php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date' => fake()->dateTimeBetween('2024-01-01','2024-12-31'),
            'end_date' => fake()->dateTimeBetween('2024-01-01','2024-12-31'),
            'status'=>fake()->randomElement(['pending','confirmed','canceled']),
            'user_id'=>User::all()->random()->id,
            'destination_id'=>Destination::all()->random()->id,
            'hotel_id'=>Hotel::all()->random()->id
        ];  
    }
}
