<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistArtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_arts', function (Blueprint $table) {
            $table->integer('art_id')->unsigned();
            $table->foreign('art_id')->references('art_id')->on('arts');
            $table->integer('artist_id')->unsigned();
            $table->foreign('artist_id')->references('id')->on('users');
            $table->primary(['art_id','artist_id']);
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
        Schema::dropIfExists('artist_arts');
    }
}
