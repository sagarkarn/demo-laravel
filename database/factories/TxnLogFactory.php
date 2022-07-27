<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TxnLog>
 */
class TxnLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'type' => $this->faker->randomElement(['IN', 'OUT']),
            'sub_type' => $this->faker->randomElement(['from_company', 'from_employee']),
            'bill_no' => $this->faker->optional()->uuid,
            'bill_amount' => $this->faker->randomFloat(2, 0, 100),
            'order_id' => $this->faker->uuid,
            'remarks' => $this->faker->optional()->text,
        ];
    }
}
