<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\server;
use Illuminate\Database\Eloquent\Factories\Factory;

class serverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = server::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => rand(1, 50),
            'max_players' => rand(1, 50),
            'type' => rand(1, 2),
            'name' => $this->faker->companySuffix(),
            'creator' => rand(1, 50),
        ];
    }
}
