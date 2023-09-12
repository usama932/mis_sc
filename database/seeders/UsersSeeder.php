<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $demoUser = User::create([
            'name'              => "Usama Qayyum",
            'email'             => 'usama.qayyum@savethechildren.org',
            'password'          => Hash::make('12341234'),
            'email_verified_at' => now(),
        ]);

    }
}
