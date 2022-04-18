<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class SAseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin 01',
            'email' => 'sa@gmail.com',
            'password' => Hash::make('sa123'),
            'role' => 'sa'
        ]);
        User::create([
            'name' => 'jen',
            'email' => 'jen@gmail.com',
            'password' => Hash::make('u2s9r'),
            'role' => 'fed'
        ]);
    }
}
