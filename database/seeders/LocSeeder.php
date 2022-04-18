<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'name' => 'Aryaduta',
            'code' => 'AD' 
        ]);
        Location::create([
            'name' => 'Lippo Mall',
            'code' => 'LP' 
        ]);
    }
}
