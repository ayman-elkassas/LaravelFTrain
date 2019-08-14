<?php


namespace App\Jobs;


use Thread;

class operations extends Thread
{
	public function run() {
		\Artisan::call('queue:work');
	}
}