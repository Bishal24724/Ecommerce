<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorUser;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        /*
        VendorUser::factory()->create([
            'name'=>'GoldStar',
            'email' => 'vendor@gmail.com',
            'password'=>bcrypt('vendor123'),
        ]);
        */
        VendorUser::factory()->create([
            'name'=>'Addidas',
            'email' => 'addidas@gmail.com',
            'password'=>bcrypt('addidas123'),
        ]);

        VendorUser::factory()->create([
            'name'=>'Nike',
            'email' => 'nike@gmail.com',
            'password'=>bcrypt('nike123'),
        ]);
    }
}
