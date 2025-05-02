<?php

namespace Database\Seeders;

use App\Models\Estimate;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()
            ->hasClients(10)
            ->create([
                'name' => 'John doe',
                'email' => 'john@doe.fr',
            ]);

        Estimate::factory(30)
            ->recycle($user)
            ->recycle($user->clients)
            ->create();
    }
}
