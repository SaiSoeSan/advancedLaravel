<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'sai',
            'email' => 'sai@example.com'
        ]);

        User::factory()->create([
            'name' => 'soe',
            'email' => 'soe@example.com'
        ]);

        User::factory()->create([
            'name' => 'san',
            'email' => 'san@example.com',
            'role' => 'instructor'
        ]);

        User::factory()->create([
            'name' => 'Joe',
            'email' => 'joe@example.com',
            'role' => 'admin'
        ]);

        User::factory()->count(10)->create();

        User::factory()->count(10)->create([
            'role' => 'instructor'
        ]);
    }
}
