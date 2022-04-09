<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userCount = max((int)$this->command->ask('How many users do you want to create?',20),1);

        User::factory()->defaultAdmin()->create();
        User::factory()->count($userCount)->create();

    }
}
