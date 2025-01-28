<?php

namespace Database\Seeders;

use App\Models\WebContent;
use Illuminate\Database\Seeder;

class WebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebContent::create([
            'address'=>'Savar, Dhaka',
            'whatsapp'=>'01898776454',
            'email'=>'example@gmail.com',
            'charge'=>'60',
            'bkash'=>'01898776451',
            'nagad'=>'01898776452',
            'rocket'=>'01898776453',
        ]);
    }
}
