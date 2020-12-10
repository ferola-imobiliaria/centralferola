<?php

namespace Database\Factories;

use App\Team;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $teams = Team::all();
        $name = $this->faker->unique()->firstName . ' ' . $this->faker->lastName . ' ' . $this->faker->lastName;
        $name_short = explode(' ', $name);


        return [
            'uuid' => $this->faker->uuid,
            'name' => $name,
            'name_short' => $name_short[0] . ' ' . end($name_short),
            'email' => Str::slug($name_short[0]) . '@ferola.com.br',
            'username' => Str::slug($name_short[0]),
            'cpf' => $this->faker->unique()->cpf,
            'creci' => $this->faker->unique()->randomNumber(5),
            'phone' => $this->faker->cellphoneNumber,
            'profile' => 'realtor',
            'team_id' => $teams->random()->id,
            'password' => bcrypt(Str::slug($name_short[0])),
            'password_change' => 0,
            'photo' => null,
        ];
    }
}
