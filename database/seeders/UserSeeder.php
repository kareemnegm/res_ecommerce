<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::withoutEvents(function () {
            $faker = \Faker\Factory::create();

            $roles = [
                'admin',
                'customer',
                'merchant'
            ];
            for ($i = 0; $i < count($roles); $i++) {
                $user = User::create([
                    'uuid' => $faker->uuid(),
                    'country_id' => $faker->numberBetween(1, 5),
                    'email' => $roles[$i] . '@test.com',
                    'password' => Hash::make('12345678'),
                    'mobile' => '966512345' . $i,
                    'full_name' => ucwords(str_ireplace('_', ' ', $roles[$i])),
                    'id_number' => $faker->numberBetween(1, 500),
                ]);
                $user->assignRole($roles[$i]);
            }
        });   
    }
}
