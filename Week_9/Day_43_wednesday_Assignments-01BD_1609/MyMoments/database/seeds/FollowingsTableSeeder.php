<?php

use Illuminate\Database\Seeder;
use MyMoments\User;

class FollowingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 15;

        for ($i = 0; $i < $limit; $i++) {
        	$random_user = User::orderBy(DB::raw('RAND()'))->take(1)->get();
        	$random_user2 = User::orderBy(DB::raw('RAND()'))->take(1)->get();
            DB::table('followings')->insert([
                'follower_id' => $random_user[0]['id'],          
                'Followed_id' => $random_user2[0]['id'],

            ]);
        }
    }
}
