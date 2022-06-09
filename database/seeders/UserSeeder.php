<?php

namespace Database\Seeders;

use Domain\Shared\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['username' => 'parspack', 'password' => bcrypt('123456')]);
    }
}
