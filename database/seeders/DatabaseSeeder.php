<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'fname'     => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'utype' => 'ADM',
        ]);
    
    }
}
