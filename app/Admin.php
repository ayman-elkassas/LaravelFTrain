<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticable
{
	use Notifiable;
	protected $fillable = [
		'name', 'email', 'password'
	];

	protected $hidden=[
		'password','remember_token'
	];

}
