<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_votes', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->foreign('post_id')->references('post_id')->on('posts');
            $table->enum('vote', ['1', '-1']);
            $table->integer('artist_id')->unsigned();
            $table->foreign('artist_id')->references('id')->on('users');
            $table->primary(['post_id','artist_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_votes');
    }
}
