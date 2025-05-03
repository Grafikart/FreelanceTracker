<?php

namespace App\Domains\Clients\Factories;

use App\Domains\Clients\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Clients\Client>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;

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
        return [
            'name' => fake()->company(),
            'address' => fake()->address(),
            'user_id' => User::factory(),
        ];
    }
}
