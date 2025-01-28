<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            'name'=>'Jone Doe',
            'email'=>'student@gmail.com',
            'refer_code'=>12345678,
            'sts'=>1,
            'password'=>Hash::make('password'),
        ]);
    }
}
