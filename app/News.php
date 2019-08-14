<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

	protected $fillable = [
		'title','photo', 'desc', 'user_id','content','status'
	];

	//to store date of deleted
	protected $date=['delete_at'];

	//Don't name relation function the same name of relation key
//	public function user_id()
//	{
//		//return one object(every user can create many of news)
//		return $this->hasOne('App\User','id','user_id');
//	}

	public function user()
	{
		//return one object(every user can create many of news)
		return $this->hasOne('App\User','id','user_id');

		//ORRRRRRRRRRRRRRRRRRRRRRRRR

		//BelongsTo() opposite of hasOne() in keys
		//start key of pk of second model in relation and next key of pk of model
//		return $this->BelongsTo('App\User','user_id','id');
	}

	public function comments()
	{
		//return array of objects (each news have many comments)
		return $this->hasMany('App\Comments','news_id','id');
	}

//	public function comment_count()
//    {
//        return $this->hasMany('App\Comments','news_id','id')->count();
//    }

	//new relation files and news
	public function files()
	{
		return $this->hasMany('App\File','news_id','id');
	}

	protected $hidden=[];

}
