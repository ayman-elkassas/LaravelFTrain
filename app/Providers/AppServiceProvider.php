<?php

namespace App\Providers;

use App\News;
use function foo\func;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
	    Schema::defaultStringLength(200);
//	    News::saved(function ($user)
//	    {
//		    if ( ! $user->isValid()) {
//			    return false;
//		    }
//	    });
	    //to enable fk constrains
	    Schema::enableForeignKeyConstraints();

	    //share data
	    //**************Singleton*******************
	    app()->singleton('simple',function(){
		    return 'Hey I am singleton!!!';
//		    return view('home');
	    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
