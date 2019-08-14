<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('photo');
            $table->integer('user_id')->unsigned();
            $table->longText('content');
            $table->text('desc');
            //enum is field that take value from determine values
            $table->enum('status',['active','pending','offline']);
            $table->softDeletes();
            $table->timestamps();

            //Relationships ref
	        $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('news');
    }
}
