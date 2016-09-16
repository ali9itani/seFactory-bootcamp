<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30);
            $table->string('email')->unique();
            $table->string('username',30)->unique();
            $table->string('password');
            // 0:male 1:female
            $table->boolean('gender')->nullable();
            // 0:public 1:private
            $table->boolean('private_account')->default(0);
            // 0:no 1:disabled
            $table->boolean('disabled_account')->default(0);
            $table->string('phone_number',30)->nullable();
            $table->string('bio',150)->nullable();
            $table->string('website',2083)->nullable();
            $table->string('image_link',2083)->default('profile-default.png');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
