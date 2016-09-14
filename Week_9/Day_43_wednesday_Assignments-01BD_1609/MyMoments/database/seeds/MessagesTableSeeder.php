<?php

use Illuminate\Database\Seeder;
use MyMoments\User;

class MessagesTableSeeder extends Seeder
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
        	$random_user = User::orderBy(DB::raw('RAND()'))->take(1)->get();
        	$random_user2 = User::orderBy(DB::raw('RAND()'))->take(1)->get();
            DB::table('messages')->insert([
                'message_text' => $faker->word,
                'user_id' => $random_user[0]['id'],          
                'sender_id' => $random_user2[0]['id'],
                'created_at' => $faker->dateTime,
            ]);
        }
    }
}
