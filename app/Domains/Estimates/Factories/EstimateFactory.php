<?php

namespace App\Domains\Estimates\Factories;

use App\Domains\Clients\Client;
use App\Domains\Invoicing\InvoiceRow;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Estimates\Estimate>
 */
class EstimateFactory extends Factory
{
    protected $model = \App\Domains\Estimates\Estimate::class;

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
                'price' => random_int(10_00, 100_00),
            ]));
        }

        return [
            'label' => fake()->sentence(),
            'accounting_id' => random_int(1, 100),
            'tax' => fake()->randomElement([0, 20]),
            'currency' => 'EUR',
            'action_at' => fake()->dateTimeBetween('-1 year', 'today'),
            'sent_at' => fake()->dateTimeBetween('-1 year', 'today'),
            'state' => fake()->randomElement([0, 1, 2, 3]),
            'footer' => fake()->text(),
            'rows' => $rows,
            'client_id' => Client::factory(),
            'user_id' => User::factory(),
        ];
    }
}
