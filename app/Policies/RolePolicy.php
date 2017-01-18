<?php

namespace Skill\Policies;

use Skill\User;
use Skill\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;



	public function before(User $user, $ability)
	{
		if($user->isAdmin()){
			return true;
		}
	}


}
