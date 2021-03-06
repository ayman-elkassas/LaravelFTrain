<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('user_id')->unsigned();
	        $table->integer('news_id')->unsigned()->nullable();
	        $table->string('path');
	        $table->string('file');
	        $table->string('size');
	        $table->string('file_name');

            $table->timestamps();

	        //Relationships ref
	        $table->foreign('user_id')->references('id')->on('users')
		        ->onDelete('cascade');
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
        Schema::dropIfExists('files');
    }
}
