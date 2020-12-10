<?php

namespace Database\Factories;

use App\Team;
use FontLib\Table\Type\name;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stores = array('sede', 'aguas_claras', 'noroeste');
        $store = array_rand($stores, 1);
        return [
            'name' => ucfirst($this->faker->word),
            'store' => $stores[$store]
        ];
    }
}
