<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fillArts();
    }

    private function fillArts()
    {
    	DB::table('arts')->insert(
		    array(
		            array('art_name' => 'Outline_of_crafts'),
					array('art_name' => 'Asemic_writing'),
					array('art_name' => 'Animation'),
					array('art_name' => 'Calligrapy'),
					array('art_name' => 'Cartoon'),
					array('art_name' => 'Ceramic_art'),
					array('art_name' => 'Collage'),
					array('art_name' => 'Comics'),
					array('art_name' => 'Conceptual_art'),
					array('art_name' => 'Decollage'),
					array('art_name' => 'Decorative_art'),
					array('art_name' => 'Fashion_design'),
					array('art_name' => 'Garden_design'),
					array('art_name' => 'Graphic_design'),
					array('art_name' => 'Motion_graphic_design'),
					array('art_name' => 'Web_design'),
					array('art_name' => 'Concept_art'),
					array('art_name' => 'Installation_art'),
					array('art_name' => 'Land_art'),
					array('art_name' => 'Mail_art'),
					array('art_name' => 'Mixed_media'),
					array('art_name' => 'Outline_of_painting'),
					array('art_name' => 'Outline_of_photography'),
					array('art_name' => 'Printmaking'),
					array('art_name' => 'Etching'),
					array('art_name' => 'Lithography'),
					array('art_name' => 'Screen-printing'),
					array('art_name' => 'Outline_of_sculpture'),
					array('art_name' => 'Typography'),
					array('art_name' => 'Video_art'),
					array('art_name' => 'Others'),
		));
    }

}
