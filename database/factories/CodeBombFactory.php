<?php

namespace Database\Factories;

use App\Models\CodeBomb;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CodeBombFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CodeBomb::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'end' => $this->faker->dateTime(),
            'value' => rand(20, 40) / 10,
            'code' => Str::random(10),
        ];
    }
}
