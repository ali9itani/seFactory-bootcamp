<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 15;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('users')->insert([ //,
                'name' => $faker->name,
                'password' => bcrypt('password'),
                'username' => 'user'.$i,
                'email' => $faker->unique()->email,
                'private_account' => $faker->boolean,
                'gender' => $faker->boolean,
                'disabled_account' => $faker->boolean,
                'phone_number' => $faker->phoneNumber,
                'bio' => $faker->word,
            ]);
        }
    }
}
