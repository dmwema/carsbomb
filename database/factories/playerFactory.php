<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $server_count = rand(1, 10);
        $servers = [];

        for ($i = 0; $i < $server_count; $i++) {
            $server_id = rand(1, 50);
            while(in_array($server_id, $servers)) {
                $server_id = rand(1, 50);
            }
            $server[] = $server_id;
        }

        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'lastgame' => rand(1, 50),
            'servers' => serialize($servers),
            'birthday' => $this->faker->date($format = 'Y-m-d', '2000-01-01'),
            'adress' => $this->faker->address(),
            'pseudo' => $this->faker->userName(),
            'image' => $this->faker->imageUrl(),
            'parent' => rand(1, 50),
            'identity' => $this->faker->imageUrl(),
            'firstname' => $this->faker->firstName(),
            'rib' => $this->faker->firstName(),
            'rib_str' => Str::random(10),
            'status' => rand(1, 3),
            'type' => rand(1, 2),
        ];
    }
}
