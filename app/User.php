<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticable
{
	use Notifiable;
	protected $fillable = [
		'name', 'email', 'password'
	];

	protected $hidden=[
		'password','remember_token','api_token','permission'
	];

}
