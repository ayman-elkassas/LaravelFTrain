<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
	protected $table='files';
	protected $fillable=[
		'user_id',
		'news_id',
		'file',
		'path',
		'size',
		'file_name',
	];
}
