<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\WeatherAlert;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeatherAlert>
 */
class WeatherAlertFactory extends Factory
{

    protected $model = WeatherAlert::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location_id' => Location::factory(),
            'alert_type' => $this->faker->randomElement(['Alert']),
            'message' => $this->faker->sentence,
            'event' => $this->faker->word,
        ];
    }
}
