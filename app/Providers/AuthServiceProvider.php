<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\User' => 'App\Policies\CheckData',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Gate

	    //simple way but not a best way
//	    Gate::define('showdata',function($user){
//	    	if($user->permission=='yes')
//		    {
//		    	return true;
//		    }
//	    	else
//		    {
//		    	return false;
//		    }
//	    });

	    //Using Policies to organize
	    Gate::define('showdata','CheckData@showData');
    }
}
