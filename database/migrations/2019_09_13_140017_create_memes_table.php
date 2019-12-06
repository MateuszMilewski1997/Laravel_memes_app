<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        
        Schema::create('memes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title',50);
            $table->string('photoPath',100);
            $table->bigInteger('likes');
            $table->bigInteger('dislikes');
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('waiting_room');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memes');
    }
}
