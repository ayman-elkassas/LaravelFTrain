<?php

use App\News;
use Illuminate\Database\Seeder;

class NewsDB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    for ($i=0;$i<10;$i++)
	    {
		    $add=new News;
		    $add->title='news title'.rand(0,9);
		    $add->user_id=1;
		    $add->desc='news Description test num '.rand(0,9);
		    $add->content='news content test num '.rand(0,9);
		    $add->status='active';
		    $add->save();
	    }
    }
}
