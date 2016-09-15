<?php

use Illuminate\Database\Seeder;
use MyMoments\User;
use MyMoments\Post;

class LikesTableSeeder extends Seeder
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
        	$random_post = Post::orderBy(DB::raw('RAND()'))->take(1)->get();
            DB::table('likes')->insert([
                'liker_id' => $random_user[0]['id'],          
                'post_id' => $random_post[0]['post_id'],
            ]);
    	}
    }
}
