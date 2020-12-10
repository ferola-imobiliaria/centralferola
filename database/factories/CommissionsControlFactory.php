<?php

namespace Database\Factories;

use App\CommissionsControl;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommissionsControlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommissionsControl::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stores = array('sede', 'aguas_claras', 'noroeste');

        $users = User::all();

        return [
            'uuid' => $this->faker->uuid,
            'user_id' => $users->random()->id,
            'store' => $stores[rand(0, 2)],
            'property' => $this->faker->address,
            'edifice' => $this->faker->sentence('2', true),
            'owner' => $this->faker->name,
            'owner_cpf' => $this->faker->unique()->cpf,
            'owner_phone' => $this->faker->cellphoneNumber,
            'sale_date' => '2020-' . $this->faker->date('m-d'),
            'sale_value' => $this->faker->numberBetween(500000.00, 2000000.00),
            'commission_percentage' => rand(3, 5),
            'commission_value' => $this->faker->numberBetween(30000.00, 50000.00),
            'realtor_percentage' => 10,
            'realtor_commission' => $this->faker->numberBetween(5000.00, 20000.00),
            'catcher' => $users->random()->id,
            'catcher_percentage' => 10,
            'catcher_commission' => $this->faker->numberBetween(2000.00, 10000.00),
            'exclusive' => $users->random()->id,
            'exclusive_percentage' => 5,
            'exclusive_commission' => $this->faker->numberBetween(2000.00, 10000.00),
            'supervisor' => $users->random()->id,
            'supervisor_percentage' => 2.5,
            'supervisor_commission' => $this->faker->numberBetween(1000.00, 5000.00),
            'real_estate_commission' => $this->faker->numberBetween(10000.00, 25000.00)
        ];
    }
}
