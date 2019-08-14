<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Artisan;

class ScheduleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'myproject:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Can use to refresh project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //make any thing doing this commnad

//	    Artisan::call('view:clear');
//	    Artisan::call('cache:clear');
//	    Artisan::call('config:clear');
//	    Artisan::call('optimize');
//	    Artisan::call('key:generate');
	    $user=new User();
	    $user->name='hamada';
	    $user->email='hamada@gmail.com';
	    $user->password=bcrypt(123456);
	    $user->save();
    }
}
