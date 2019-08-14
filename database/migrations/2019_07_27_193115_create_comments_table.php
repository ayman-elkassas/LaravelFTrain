<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('news_id')->unsigned();
            $table->longText('comment');
            $table->timestamps();

	        //Relationships ref
	        //1-M with users
	        $table->foreign('user_id')->references('id')->on('users')
		        ->onDelete('cascade');

	        //1-M with news
	        $table->foreign('news_id')->references('id')->on('news')
		        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
