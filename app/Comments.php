<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //
	protected $table='comments';
	protected $fillable=[
		'user_id','news_id','comment'
	];

//	public function user_id()
//	{
//		return $this->hasOne('App\User','id','user_id');
//	}

	public function user()
	{
		return $this->hasOne('App\User','id','user_id');
	}

	public function news_id()
	{
		return $this->hasOne('App\News','id','news_id');
	}
}
