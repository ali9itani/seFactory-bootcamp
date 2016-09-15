<?php

use Illuminate\Database\Seeder;
use MyMoments\User;
class PostsTableSeeder extends Seeder
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
            DB::table('posts')->insert([
                'post_image_link' => "link.jpg",
                'post_user_id' => $random_user[0]['id'],
                'image_caption' => $faker->word,           
                'hashtags' => "#new #good",
            ]);
        }
    }
}
