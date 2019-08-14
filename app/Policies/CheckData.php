<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckData
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function showData(User $user)
    {
    	//Any logic and return allow or disallow (true or false)

	    if($user->permission=='yes')
	    {
		    return true;
	    }
	    else
	    {
		    return false;
	    }
    }
}
