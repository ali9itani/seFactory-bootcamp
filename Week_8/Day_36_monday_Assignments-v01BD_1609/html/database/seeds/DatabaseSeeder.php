<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /** 
     * Run the database seeds.
     *
     * @return void
     */
      public function run()
      {
    Eloquent::unguard();

        //call uses table seeder class
  		$this->call('UsersTableSeeder');
  		$this->call('PostsTableSeeder');
        //this message shown in your terminal after running db:seed command
        $this->command->info("Users/Posts tables seeded :)");
       }

}

class UsersTableSeeder extends Seeder {
 
       public function run()
       {
        //delete users table records
        DB::table('users')->delete();
        //insert some dummy records
        DB::table('users')->insert(array(
            array('name'=>'john','email'=>'john@gmail.com','password'=>'password'),
            array('name'=>'jack','email'=>'jack@gmail.com','password'=>'password'),
            array('name'=>'mark','email'=>'mark@gmail.com','password'=>'password'),
            array('name'=>'mike','email'=>'mike@gmail.com','password'=>'password'),

         ));
       }
}

class PostsTableSeeder extends Seeder {
 
       public function run()
       {
        //delete users table records
         DB::table('posts')->delete();
        //insert some dummy records
        DB::table('posts')->insert(array(
            array('title'=>'john first post','author_id'=>'1','text'=>'this is my post x222uyy3e ruhebfehbcnhirh', 'created_at' => '2011-12-31 23:59:59'),
            array('title'=>'cttyh title post','author_id'=>'1','text'=>'this is my post yuu rjnjrj ruhebfehbcnhirh', 'created_at' => '2011-12-31 23:59:59' ),
            array('title'=>'y78 title post','author_id'=>'2','text'=>'this is my post jj njnn ruhebfehbcnhirh', 'created_at' => '2011-12-31 23:59:59'),
            array('title'=>'6789 title post','author_id'=>'3','text'=>'this is my post 4567 y678 ruhebfehbcnhirh', 'created_at' => '2011-12-31 23:59:59'),
         ));
       }
}