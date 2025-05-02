<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\InvoiceRow;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estimate>
 */
class EstimateFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = '0000';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $count = random_int(1, 5);
        $rows = collect([]);
        for ($i = 0; $i < $count; $i++) {
            $rows->push(new InvoiceRow([
                'label' => fake()->sentence(),
                'quantity' => random_int(1, 10),
                'price' => random_int(1, 100),
            ]));
        }
        return [
            'label' => fake()->sentence(),
            'estimate_id' => random_int(1, 100),
            'tax' => fake()->randomElement([0, 20]),
            'currency' => 'EUR',
            'action_at' => fake()->dateTimeBetween('-1 year', 'today'),
            'sent_at' => fake()->dateTimeBetween('-1 year', 'today'),
            'state' => fake()->randomElement([0, 1, 2, 3]),
            'footer' => fake()->text(),
            'rows' => $rows,
            'client_id' => Client::factory(),
            'user_id' => User::factory()
        ];
    }

}
